<?php

namespace App\Http\Controllers;

use App\Events\ChangePasswordLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Events\SmsMail;
use App\Models\PlayerCoach;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PlayerCoachController extends Controller
{


       //registration
       public function player_register()
       {

        $Code1 = rand(11, 99);
        $Code2 = rand(11, 99);
        $capchaCode = $Code1 +  $Code2;
        session()->put('capchaCode', $capchaCode);
           return view('player.player_registration',  compact('capchaCode','Code1','Code2'));
       }



       public function player_registrationStore(Request $request)
       {
           $checkEmail_for_registered = DB::table('player_coach_registration')->where('email', $request->email)->first();
           if ($checkEmail_for_registered && $checkEmail_for_registered->type == $request->type && $checkEmail_for_registered->otp_verify == 0) {
            //$otp = 123456;
             $otp = rand(111111, 999999);
               session()->put('email', $request->email);
               session()->put('mobile', $request->mobile);
               session()->put('form_type', 1);
               SmsMail::dispatch([
                   "otp" => $otp,
                   "email" => $request->email,
                   "mobile" => $request->mobile
               ], 1);
               $data = [
                   'name' => $request->name,
                   'dob' => $request->dob,
                   'email' => $request->email,
                   'mobile' => $request->mobile,
                   'otp' => $otp,
                   'type' => $request->type,
               ];
               DB::table('player_coach_registration')->where('id', $checkEmail_for_registered->id)->update($data);
               return redirect()->route('playerotp')->with('success', ' OTP Sent Successfully./ओटीपी सफलतापूर्वक अग्रेषित कर दिया गया है।');
               //return redirect('playerotp'.base64_encode($checkEmail_for_registered->id))->with('error', 'Oops! Varification is pending for this email id, Please varify the OTP.');
           }elseif($checkEmail_for_registered && $checkEmail_for_registered->type != $request->type){
            if($checkEmail_for_registered->type == 1){
                $typee = 'player';
            }else{
                $typee = 'coach';
            }

            return redirect()->back()->with('error', 'Already register as ' .$typee. ' with this email Id.');
           }
           $request->validate([
               'name' => 'required|max:100',
               'dob' => 'required',
               'gender' => 'required',
               'type' => 'required',
               'email' => 'required|email',
               'captchacode' => 'required',
               'captcha' => 'required',
               'mobile' => 'required|numeric|digits:10',
           ]);

           if ($request->captcha != $request->captchacode) {
               return redirect()->back()->with('error', 'Oops! Invalid Captcha Code.');
           }
           $otp = rand(111111, 999999);
            //$otp = 123456;
           $randomPassword = rand(11111111,99999999);
           $data = [
               'name' => $request->name,
               'dob' => $request->dob,
               'type' => $request->type,
               'gender' => $request->gender,
               'email' => $request->email,
               'mobile' => $request->mobile,
               'otp' => $otp,
               'decoded_password' => $randomPassword,
               'password' => Hash::make($randomPassword),
               'status_preview' => 1,
           ];

           $user = PlayerCoach::where('email', $request->email)->where('otp_verify', 0)->first();
           if ($user) {
               $user->update($data);
               session()->put('email', $request->email);
               session()->put('mobile', $request->mobile);
               session()->put('form_type', 1);
               SmsMail::dispatch([
                   "otp" => $otp,
                   "email" => $request->email,
                   "mobile" => $request->mobile
               ], 1);

               return redirect()->route('playerotp')->with('success', ' OTP Sent Successfully./ओटीपी सफलतापूर्वक अग्रेषित कर दिया गया है।');
           }

           $user = PlayerCoach::where('email', $request->email)->first();
           if ($user) {
               return back()->withErrors([
                   'email' => 'Email Already exist.',
               ])->onlyInput('email');
           }

           $registerUser = PlayerCoach::create($data);

           session()->put('email', $request->email);
           session()->put('mobile', $request->mobile);
           session()->put('form_type', 1);
           SmsMail::dispatch([
               "otp" => $otp,
               "email" => $request->email,
               "mobile" => $request->mobile
           ], 1);

           return redirect()->route('playerotp')->with('success', ' OTP Sent Successfully./ओटीपी सफलतापूर्वक अग्रेषित कर दिया गया है।');
       }


       public function player_otp()
       {
           return view('player.player_otp');
       }



       public function player_otpStore(Request $req)
       {
           $otp = $req->otp1 . $req->otp2 . $req->otp3 . $req->otp4 . $req->otp5 . $req->otp6;
           $email = session()->get('email');

           $user = PlayerCoach::where('email', $email)->where('otp', $otp)->first();

           if ($user) {
               $user->otp_verify = 1;
               $user->save();
               SmsMail::dispatch(["id" => $user->id],  17);
               return redirect()->route('playerlogin')->with("success", "Successfully Registered on the Portal./पोर्टल पर सफलतापूर्वक पंजीकृत हो गए हैं।");
           }
           return redirect()->back()->with('error', 'Oops! Invalid OTP  Please try again .');
       }


       public function player_login()
       {
        $Code1 = rand(11, 99);
        $Code2 = rand(11, 99);
        $capchaCode = $Code1 +  $Code2;
        session()->put('capchaCode', $capchaCode);
           return view('player.player_login', compact('capchaCode','Code1','Code2'));
       }

       public function cp_refresh()
       {

           // $capchaCode = rand(11111, 99999);
           // session()->put('capchaCode', $capchaCode);

           $Code1 = rand(11, 99);
           $Code2 = rand(11, 99);
           $capchaCode = $Code1 +  $Code2;
           session()->put('capchaCode', $capchaCode);
           $data['capchaCode']=$capchaCode;
           $data['Code1']=$Code1;
           $data['Code2']=$Code2;
           return response()->json($data);
       }


       public function player_resendotp()
       {
           //$otp = 123456;
            $otp = rand(111111, 999999);

           PlayerCoach::where('email', session()->get('email'))->update(
               ["otp" => $otp]
           );

           SmsMail::dispatch([
               "otp" => $otp,
               "email" => session()->get('email'),
               "mobile" => session()->get('mobile')
           ], 1);
           return redirect()->back()->with('success', 'Otp Resend Successfully');
       }

       public function player_loginStore(Request $request)
       {
           $request->validate([
               'email' => 'required|email',
               'password' => 'required',
               'captcha' => 'required',

           ]);
           $user = PlayerCoach::where('email', $request->email)->where('otp_verify', 0)->first();
           if ($user) {
               return Redirect()->route('playerregistration')->with('error', 'Please Register First.');
           }

           if ($request->captcha != $request->captchacode) {
               return back()->withErrors([
                   'captcha' => 'Oops! Invalid Captcha Code.',
               ])->onlyInput('captcha');
           }

           $credentials = $request->validate([
               'email' => 'required|email',
               'password' => 'required',

           ]);
           Auth::guard('player')->attempt($credentials);
           if (Auth::guard('player')->attempt($credentials)) {
            PlayerCoach::where('email', $request->email)->first()->update(['last_login' => date('Y-m-d H:i:s')]);

               if (Auth::guard('player')->user()->change_password_status == 1) {
                   return redirect()->route('playerdashboard')->with('success', 'Logged In Successfully./सफलतापूर्वक लॉगिन हो गए हैं।');
               } else {
                   return redirect()->route('playerchangepassword')->with('success', 'Logged In Successfully./सफलतापूर्वक लॉगिन हो गए हैं।');
               }
           }

           return back()->withErrors([
               'email' => 'The provided credentials does not match our records.',
           ])->onlyInput('email');
       }


       public function player_changepassword()
    {
        return view('player.player_updatepassword');
    }

    //changepasswordStore
    public function player_changepasswordStore(Request $request)
    {
        $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required|min:8|different:oldpassword',
            'confirmpassword' => 'required|min:8|same:newpassword',
        ]);

        // if ($request->confirmpassword != $request->newpassword) {
        //     return back()->withErrors([
        //         'confirmpassword' => 'Oops! Confirm Password Does not Match.',
        //     ])->onlyInput('confirmpassword');
        // }
        $user = Auth::guard('player')->user();
        if ($user->decoded_password != $request->oldpassword) {
            return back()->withErrors([
                'oldpassword' => 'Oops! Old Password Does not Match.',
            ])->onlyInput('oldpassword');
        }



        $checkold =  DB::table('change_password_log')->where('type', 5)->where('email',Auth::guard('player')->user()->email )->where('user_id',Auth::guard('player')->user()->id)->take(3)->orderByDesc('id')->get();


        if($checkold){
            foreach ($checkold as $key => $value) {
                if($value->password == $request->newpassword){

                    return back()->with(
                        'error','Already used this Password.',
                    );


                }
            }
        }
        ChangePasswordLog::dispatch(5, Auth::guard('player')->user()->id,Auth::guard('player')->user()->email, $request->newpassword );

        $userUpdate = PlayerCoach::find($user->id);



        $data = [
            'decoded_password' => $request->newpassword,
            'password' => Hash::make($request->newpassword),
            'change_password_status' => 1
        ];

        $userUpdate->update($data);
        Auth::guard('player')->logout();
        return Redirect()->route('playerlogin')->with('success', 'Password Changed Successfully./पासवर्ड सफलतापूर्वक बदल दिया गया है।');
    }


    public function player_logout()
    {
        Auth::guard('player')->logout();
        return Redirect()->route('playerlogin')->with('success', 'User Logout successfully.');
    }


    public function player_forgotpassword()
    {
        return view('player.player_forgotpassword');
    }

    public function player_dashboard()
    {
        $player_applicationview =DB::table('player_coach_basic_detail')->where('user_id', Auth::guard('player')->user()->id)->first();

        if(!$player_applicationview){
            return redirect()->route('playerapplication');
        }
        if (Auth::guard('player')->user()->change_password_status != 1) {
            return redirect()->back(); }



        return view('player.player_dashboard',compact('player_applicationview'));
    }



    public function player_application()
    {

        if(Auth::guard('player')->user()->status_preview == 2){
            return redirect()->back();
        }
        if (Auth::guard('player')->user()->change_password_status != 1) {
            return redirect()->back(); }
        $playersummary =DB::table('player_coach_basic_detail')->where('user_id', Auth::guard('player')->user()->id)->first();
        $sports = DB::table('sport_type')->orderBy('name', 'ASC')->get();
        $districts = DB::table('cities')->select('city', 'id')->where('state_id', '23')->get();
         $qualification = DB::table('player_coach_qualification')->where('user_id', Auth::guard('player')->user()->id)->get();
         $award = DB::table('player_coach_award')->where('user_id', Auth::guard('player')->user()->id)->get();



        return view('player.player_application', compact('playersummary','sports','districts', 'qualification', 'award'));
    }



    public function player_forgotStore(Request $req)
    {
        $user = PlayerCoach::where('email', $req->email)->first();
        //dd($user);
        if ($user != "") {
            //dd($reply->mobile);
           SmsMail::dispatch(["id" => $user->id],  17);
            return redirect()->route('playerlogin')->with('success', "Password has been sent on the registered Mobile No./Email ID./पासवर्ड पंजीकृत मोबाइल नंबर/ईमेल आईडी पर भेज दिया गया है।");
        }
        return redirect()->route('playerforgotpassword')->with('error', "Email does not exists");
    }




    public function qualicationStore(Request $request){

        $validation = Validator::make($request->all(), [
           'upload_file'=> 'required|mimes:png,jpg,jpeg,pdf|max:2048',
           'qualification'=> 'required',
        ], msg());

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
            $check = DB::table('player_coach_qualification')->where('user_id', Auth::guard('player')->user()->id)->where('qualification', $request->qualification)->get();
            if ( $check->count() > 0 )
             return response()->json(['error' => true, 'msg' => 'Same qualification already uploaded.']);

            if ($request->hasFile('upload_file')){
                $upload_file = moveFile('qualification/images', $request->upload_file);
            }

            $data = [
              'user_id'=> Auth::guard('player')->user()->id,
              'qualification'=>$request->qualification,
              'upload_file'=>$upload_file,
            ];

            DB::table('player_coach_qualification')->insert($data);

            $dataQual=  DB::table('player_coach_qualification')->where('user_id', Auth::guard('player')->user()->id)->get();
            return response()->json(['error' => false, 'msg' => 'Qualication Detail Added Successfully','dataQual'=> $dataQual ]);





    }



    public function qualicationdelete($id){
       $qual = DB::table('player_coach_qualification')->find($id);



        $image_path = "public/qualification/images/".$qual->upload_file;
        if(File::exists($image_path)) {
            File::delete($image_path);
        }



        DB::table('player_coach_qualification')->delete($id);

        $count = DB::table('player_coach_qualification')->where('user_id',Auth::guard('player')->user()->id)->get()->count();

        return response()->json(['error' => false, 'msg' => 'Qualication Detail Remove Successfully', 'count'=>$count]);



    }




    public function awardStore(Request $request){

        $validation = Validator::make($request->all(), [
           'upload_file'=> 'required|mimes:png,jpg,jpeg,pdf|max:2048',
           'award'=> 'required',
        ], msg());

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

            if ($request->hasFile('upload_file')){
                $upload_file = moveFile('award/images', $request->upload_file);
            }

            $data = [
              'user_id'=> Auth::guard('player')->user()->id,
              'award'=>$request->award,
              'upload_file'=>$upload_file,
            ];

            DB::table('player_coach_award')->insert($data);

            $dataQual=  DB::table('player_coach_award')->where('user_id', Auth::guard('player')->user()->id)->get();
            return response()->json(['error' => false, 'msg' => 'Award Detail Added Successfully','dataQual'=> $dataQual ]);





    }



    public function awarddelete($id){
       $aw = DB::table('player_coach_award')->find($id);
        $image_path = "public/award/images/".$aw->upload_file;
        if(File::exists($image_path)) {
            File::delete($image_path);
        }

        DB::table('player_coach_award')->delete($id);

        $count = DB::table('player_coach_award')->where('user_id',Auth::guard('player')->user()->id)->get()->count();

        return response()->json(['error' => false, 'msg' => 'Award Detail Remove Successfully', 'count'=>$count]);



    }



    public function basicDetailStore(Request $request){

        $validation = Validator::make($request->all(), [
            'profile_picture'=> 'mimes:png,jpg,jpeg|max:2048',
            'signature'=> 'mimes:png,jpg,jpeg|max:2048',
            'father_name'=> 'required',
            'nationality'=> 'required',
            'aadhar'=> 'required',
            'religion'=> 'required',
            'sport_id'=> 'required',
            'blood_group'=> 'required',
            'address'=> 'required',
            'district_id'=> 'required',
            'pin_code'=> 'required',


         ], msg());

         if ($validation->fails())
             return redirect()->back()->with('error' , $validation->errors()->first());

             $dataqualification=  DB::table('player_coach_qualification')->where('user_id', Auth::guard('player')->user()->id)->get();


             if ($dataqualification->count() == 0){
                 return redirect()->back()->with('error' , 'Please Fill Qualification Details');

             }
             $dataaward=  DB::table('player_coach_award')->where('user_id', Auth::guard('player')->user()->id)->get();
             if ($dataaward->count() == 0){
                 return redirect()->back()->with('error' , 'Please Fill Award Details');

             }

             $data = [
                'user_id'=>Auth::guard('player')->user()->id,
               'father_name'=> $request->father_name,
               'nationality'=> $request->nationality,
               'aadhar'=> $request->aadhar,
               'religion'=> $request->religion,
               'vehicle_no'=> $request->vehicle_no,
               'sport_id'=> $request->sport_id,
               'blood_group'=> $request->blood_group,
               'address'=> $request->address,
               'district_id'=> $request->district_id,
               'pin_code'=> $request->pin_code,


            ];
            $user_basic = DB::table('player_coach_basic_detail')->where('user_id',Auth::guard('player')->user()->id)->first();

             if ($request->hasFile('profile_picture')){
                $profile_picture = moveFile('player_coach_storage/profile_picture', $request->profile_picture);
                $data['profile_picture']= $profile_picture;

            }

            if ($request->hasFile('signature')){
                $signature = moveFile('player_coach_storage/signature', $request->signature);
                $data['signature']= $signature;


            }

       if($user_basic){


        $profile_picturee = "public/player_coach_storage/profile_picture/".$user_basic->profile_picture;


       if($request->hasFile('profile_picture') && File::exists($profile_picturee)) {
            File::delete($profile_picturee);
        }
        $signaturee = "public/player_coach_storage/signature/".$user_basic->signature;

        if($request->hasFile('signature') && File::exists($signaturee)) {
            File::delete($signaturee);
        }

            DB::table('player_coach_basic_detail')->where('user_id',Auth::guard('player')->user()->id)->update($data);


            $msg = "Basic Detail Updated Successfully";
        }else{
            DB::table('player_coach_basic_detail')->insert($data);
            $msg = "Basic Detail Submitted Successfully";
        }


        return redirect()->route('playerapplicationpreview')->with('success', $msg);


    }


    public function player_applicationpreview()
    {

        $player_applicationview = DB::table('player_coach_basic_detail')->where('user_id',Auth::guard('player')->user()->id)->first();

        $qualification = DB::table('player_coach_qualification')->where('user_id', Auth::guard('player')->user()->id)->get();
        $award = DB::table('player_coach_award')->where('user_id', Auth::guard('player')->user()->id)->get();

            return view('player.player_applicationpreview', compact('player_applicationview','qualification','award'));



    }



    public function applicant_applicationFinalSubmit(){
        DB::table('player_coach_registration')->where('id',Auth::guard('player')->user()->id)->update(['status_preview'=> 2, 'application_no'=> date('Y').sprintf("%08d", Auth::guard('player')->user()->id), 'final_submit_date'=> date("Y/m/d"), 'application_status'=> 1]);

        return response()->json(['error' => false, 'msg' => 'Final Submitted  Successfully', 'url'=>route('playerapplicationpreview')]);

    }



    public function admin_player( Request $req)
    {


       $applicant_detailss = DB::table('player_coach_basic_detail')
       ->join('player_coach_registration', 'player_coach_registration.id','=','player_coach_basic_detail.user_id')
        ->select('player_coach_registration.*','player_coach_registration.id as play_id','player_coach_basic_detail.*')
        ->where('player_coach_registration.status_preview', 2)
        ->where('player_coach_registration.type', 1);


        if ($req->sport_id){
          $applicant_detailss->where( 'player_coach_basic_detail.sport_id', $req->sport_id);
        }
        if ($req->city_filter){
          $applicant_detailss->where( 'player_coach_basic_detail.district_id', $req->city_filter);
        }
        if ($req->status){
            $applicant_detailss->where( 'player_coach_registration.application_status', $req->status);
          }
        $applicant_details=$applicant_detailss->orderBy('player_coach_registration.name')->get();
        $districts = DB::table('cities')->select('city', 'id')->where('state_id', '23')->get();
        $sports = DB::table('sport_type')->orderBy('name')->get();
      return view('admin.player_coach.player_applicant_list',compact('applicant_details','sports','districts'));

    }


    public function admin_coach( Request $req)
    {


       $applicant_detailss = DB::table('player_coach_basic_detail')
       ->join('player_coach_registration', 'player_coach_registration.id','=','player_coach_basic_detail.user_id')
        ->select('player_coach_registration.*','player_coach_registration.id as play_id','player_coach_basic_detail.*')
        ->where('player_coach_registration.status_preview', 2)
        ->where('player_coach_registration.type', 2);

        if ($req->sport_id){
          $applicant_detailss->where( 'player_coach_basic_detail.sport_id', $req->sport_id);
        }
        if ($req->city_filter){
          $applicant_detailss->where( 'player_coach_basic_detail.district_id', $req->city_filter);
        }
        if ($req->status){
            $applicant_detailss->where( 'player_coach_registration.application_status', $req->status);
          }
        $applicant_details=$applicant_detailss->orderBy('player_coach_registration.name')->get();
        $districts = DB::table('cities')->select('city', 'id')->where('state_id', '23')->get();
        $sports = DB::table('sport_type')->orderBy('name')->get();
      return view('admin.player_coach.coach_applicant_list',compact('applicant_details','sports','districts'));

    }

     public function player_coach_view_details($id){

      $player_applicationview = DB::table('player_coach_basic_detail')
      ->join('player_coach_registration', 'player_coach_registration.id','=','player_coach_basic_detail.user_id')
      ->select('player_coach_registration.*','player_coach_registration.id as play_id','player_coach_basic_detail.*')
     ->where('player_coach_registration.id' , $id)->first();

     $qualification = DB::table('player_coach_qualification')->where('user_id', $id)->get();
     $award = DB::table('player_coach_award')->where('user_id', $id)->get();

      return view('admin.player_coach.player_applicant_view_details',compact('player_applicationview','qualification', 'award'));

     }




     public function admin_player_status( $status)
     {


        $applicant_details = DB::table('player_coach_basic_detail')
        ->join('player_coach_registration', 'player_coach_registration.id','=','player_coach_basic_detail.user_id')
         ->select('player_coach_registration.*','player_coach_registration.id as play_id','player_coach_basic_detail.*')
         ->where('player_coach_registration.status_preview', 2)
         ->where('player_coach_registration.type', 1)
         ->where('player_coach_registration.application_status', $status)
          ->orderBy('player_coach_registration.name')->get();
         $districts = DB::table('cities')->select('city', 'id')->where('state_id', '23')->get();
         $sports = DB::table('sport_type')->orderBy('name')->get();
       return view('admin.player_coach.player_applicant_list',compact('applicant_details','sports','districts'));

     }


     public function admin_coach_status( $status)
     {


        $applicant_details = DB::table('player_coach_basic_detail')
        ->join('player_coach_registration', 'player_coach_registration.id','=','player_coach_basic_detail.user_id')
         ->select('player_coach_registration.*','player_coach_registration.id as play_id','player_coach_basic_detail.*')
         ->where('player_coach_registration.status_preview', 2)
         ->where('player_coach_registration.type', 2)
         ->where('player_coach_registration.application_status', $status)
          ->orderBy('player_coach_registration.name')->get();
         $districts = DB::table('cities')->select('city', 'id')->where('state_id', '23')->get();
         $sports = DB::table('sport_type')->orderBy('name')->get();
       return view('admin.player_coach.coach_applicant_list',compact('applicant_details','sports','districts'));

     }



     public function player_coach_application_status($id,$status){
        DB::table('player_coach_registration')->where('id',$id)->update(['application_status'=> $status]);

        return redirect()->back()->with('success', '');
     }




















}
