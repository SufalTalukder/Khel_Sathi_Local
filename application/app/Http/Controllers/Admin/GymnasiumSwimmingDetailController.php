<?php

namespace App\Http\Controllers\Admin;
use App\Events\SmsMail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;

use App\Models\GymnasiumSwimming;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GymnasiumSwimmingDetailController extends Controller
{
  

  public function gymnasium_swimming_list(){
    //$applicationview = DB::table('gymnasium_swimming_basic_detail')->orderBy('id', 'DESC')->get();
    //SELECT r.id, r.type, r.application_no, r.name, r.status_preview, r.final_submit_date, r.application_status, d.district_id, d.vehicle_no FROM gymnasium_swimming_registration r JOIN gymnasium_swimming_basic_detail d ON d.user_id = r.id ORDER BY d.user_id DESC;
    $applicationview= DB::select('SELECT r.id, r.type, r.application_no, r.name, r.status_preview, r.final_submit_date, r.application_status,d.user_id, r.status_preview, d.district_id, d.vehicle_no FROM gymnasium_swimming_registration r JOIN gymnasium_swimming_basic_detail d ON d.user_id = r.id ORDER BY d.user_id DESC');
      
    
    return view('admin.gymnasium_swimming.gymnasium_swimming_list', compact('applicationview'));
    }
    public function gymnasium_swimming_view_details($id){  
       //$applicationview = DB::table('gymnasium_swimming_basic_detail')->where('user_id',$id)->first();
       $applicationview = DB::select('SELECT r.id, r.type, r.gender, r.application_no, r.name, r.dob, r.status_preview, r.final_submit_date, r.application_status, d.user_id, r.status_preview, d.district_id, d.vehicle_no, d.father_name, d.nationality, d.aadhar, d.religion, d.sport_id, d.blood_group,d.profile_picture,d.signature, d.address,d.pin_code FROM gymnasium_swimming_registration r JOIN gymnasium_swimming_basic_detail d ON d.user_id = r.id WHERE d.user_id = '.$id);
      // dd($applicationview);
       $award = DB::table('gymnasium_swimming_award')->where('user_id', $id)->get();
       return view('admin.gymnasium_swimming.gymnasium_swimming_view_details', compact('applicationview','award'));
    }

    public function gymnasium_swimming_list_search( Request $req)
    {

       $applicant_detailss = DB::table('gymnasium_swimming_basic_detail')
       ->join('gymnasium_swimming_registration', 'gymnasium_swimming_registration.id','=','gymnasium_swimming_basic_detail.user_id')
        ->select('gymnasium_swimming_registration.*','gymnasium_swimming_registration.id as play_id','gymnasium_swimming_basic_detail.*')
        ->where('gymnasium_swimming_registration.status_preview', 2);   
        
        if ($req->city_filter){
          $applicant_detailss->where( 'gymnasium_swimming_basic_detail.district_id', $req->city_filter);
        }
        
        $applicationview=$applicant_detailss->orderBy('gymnasium_swimming_registration.name')->get();
        $districts = DB::table('cities')->select('city', 'id')->where('state_id', '23')->get();
        $sports = DB::table('sport_type')->orderBy('name')->get();
      return view('admin.gymnasium_swimming.gymnasium_swimming_list',compact('applicationview','sports','districts'));

    }

}
