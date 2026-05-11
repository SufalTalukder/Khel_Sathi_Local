<?php

namespace App\Http\Controllers\Player;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\PlayerApplcation;
use Illuminate\Support\Facades\DB;
use voku\helper\ASCII;
use Yajra\DataTables\Facades\DataTables;
use Exception;
class PlayerApplication extends Controller
{
    public function player_application()
    {
        $playersummary = Auth::guard('player')->user();
        $sports = DB::table('sport_type')->orderBy('name', 'ASC')->get();
        $districts = DB::table('cities')->select('city', 'id')->where('state_id', '23')->get();

        $applicantdata = DB::table('player_applicant_application_basic')->where('player_register_id',Auth::guard('player')->user()->id)->first();
        if($applicantdata){
            return view('player.player_application', compact('playersummary','sports','applicantdata','districts')); 
        }
        return view('player.player_application', compact('playersummary','sports','districts'));        
    }

    //applicationpreiew
    public function player_applicationpreview()
    {
        $playersummary_view = Auth::guard('player')->user();       
        $player_applicationview = DB::table('player_applicant_application_basic')->where('player_register_id',$playersummary_view->id)->get();
       
        if (Auth::guard('player')->user()->change_password_status == 1) {
            return view('player.player_applicationpreview', compact('playersummary_view','player_applicationview'));
        } else {
            return redirect()->route('playerchangepassword')->with('success', 'Logged In Successfully./सफलतापूर्वक लॉगिन हो गए हैं।');
        }

        
    }

    public function applicant_applicationbasicForm(Request $request)
    {     
        // dd($request);
        $validated = $request->validate([
            'blood_group_applicant' => 'required',
            'father_name' => 'required|max:100',
            'sports_type' => 'required',
            'district_id' => 'required',
            'address' => 'required|max:200',
            'nationality' => 'required',
            'adhar_number' => 'required',
            'religion' => 'required',            
        ],[
            'blood_group_applicant.required' => 'Please select Blood Group is required',
            'father_name.required' => 'Name of the Father Name is required',
            'sports_type.required' => 'Please select sports type is required',
            'district_id.required' => 'Please select District is required',
            'address.required' => 'Address of the Player is required',
            'nationality.required' => 'Please Select nationality is required',
            'adhar_number.required' => 'Adhar Number is required',
            'religion.required' => 'Religion is required'            
        ]);

   try {
        $master_id = Auth::guard('player')->user()->id;
        $check_users = DB::table('player_applicant_application_basic')->where('player_register_id',$master_id)->first();
        //$get_application_count = DB::table('player_applicant_application_basic')->count();
        $cnt =  $master_id + 1;                             
        $count_certificate = $cnt;
        $tpcnt = sprintf("%04d", $count_certificate);  
        $sub_date = date('Y-m-d H:i:s'); 
       // dd($d);    
        $data = [
                'player_register_id' => $master_id,                
                'player_application_no' =>  'SP'.$tpcnt,
                'blood_group_applicant' => $request->blood_group_applicant,
                'father_name' => $request->father_name,
                'sports_type' => $request->sports_type,
                'address' => $request->address,
                'district_id' => $request->district_id,
                'nationality' => $request->nationality,
                'religion' => $request->religion,
                'vehicle_number' => $request->vehicle_number,
                'aadhar_card' => $request->adhar_number,
                'submit_status' =>  1,
                'final_submission_date' => $sub_date                            
        ];

        if($request->file('applicant_sign')) {       
            $filetaken = $request->file('applicant_sign');
            $file_pathtaken = time().$filetaken->getClientOriginalName();
            $filetaken->move(public_path('playerapplicant/applicant_sign'), $file_pathtaken);
            $data['applicant_sign'] = $file_pathtaken;           
        } 
        if($request->file('profile_image')) {       
            $filetaken = $request->file('profile_image');
            $file_pathtaken = time().$filetaken->getClientOriginalName();
            $filetaken->move(public_path('playerapplicant/profile_image'), $file_pathtaken);
            $data['profile_image'] = $file_pathtaken;          
        }       
       // dd($data);
       if(!empty($check_users->player_register_id)){       
        $updatedata = DB::table('player_applicant_application_basic')->where('player_register_id',$master_id)->update($data);
        return redirect()->route('playerapplicationpreview')->with("success", "Successfully Updated.");
    
    }else{
        $insertid = DB::table('player_applicant_application_basic')->insertGetId($data);
        return redirect()->route('playerapplicationpreview')->with("success", "Successfully Registered on the Portal./पोर्टल पर सफलतापूर्वक पंजीकृत हो गए हैं।");
       }

        
        //dd( $insertid);

       
       
    } catch (Exception $e) {
         return redirect()->back()->with("error", "Oops! Server Side Issue, Please Check After Some Time.");
    }
       
    }
   
    public function applicant_applicationFinalSubmit(){       
        $master_id = Auth::guard('player')->user()->id;    
       
       $check_users = DB::table('player_applicant_application_basic')->where('player_register_id',$master_id)->first();
     
       if(!empty($check_users->id)){
        //,'final_submission_date' => date('d-m-Y')
              $update_count = DB::table('player_applicant_application_basic')->where('player_register_id', $master_id)->update(['submit_status'=> 2]);
                 return redirect('player/dashboard')->with("success", "Submitted Successfully.");
             }

     }
    public function applicant_payment(){       
       return view('player.player_finalpayment');
    }

    //dashboard
    public function player_dashboard()
    {
        $applicant_id = Auth::guard('player')->user()->id;
       // dd($applicant_id);
        $check_applicant = DB::table('player_applicant_application_basic')->where('player_register_id',$applicant_id)->first();
        $check_register = DB::table('player_registration')->where('id',$applicant_id)->first();

        return view('player.player_dashboard',compact('applicant_id','check_applicant','check_register'));
    }

   
}