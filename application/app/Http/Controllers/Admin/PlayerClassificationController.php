<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\PlayerRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlayerClassificationController extends Controller
{
    public function player_classification( Request $req)
    {
//      dd($req);

       $applicant_detailss = DB::table('player_applicant_application_basic')
        ->select('player_applicant_application_basic.player_register_id','player_applicant_application_basic.player_application_no','player_applicant_application_basic.blood_group_applicant','player_applicant_application_basic.father_name','player_applicant_application_basic.sports_type','player_applicant_application_basic.address','player_applicant_application_basic.nationality','player_applicant_application_basic.religion','player_applicant_application_basic.vehicle_number','player_applicant_application_basic.aadhar_card','player_applicant_application_basic.final_submission_date','player_registration.name','player_registration.dob','player_registration.mobile','player_registration.email','player_applicant_application_basic.district_id')
        ->join('player_registration', 'player_registration.id','=','player_applicant_application_basic.player_register_id');
        if ($req->sport_id){
          $applicant_detailss->where( 'player_applicant_application_basic.sports_type', $req->sport_id);
        }
        if ($req->city_filter){
          $applicant_detailss->where( 'player_applicant_application_basic.district_id', $req->city_filter);
        }
        $applicant_details=$applicant_detailss->orderBy('player_applicant_application_basic.id', 'DESC')->get(); 
        $districts = DB::table('cities')->select('city', 'id')->where('state_id', '23')->get();
        $sports = DB::table('sport_type')->orderBy('name')->get();
      return view('admin.player_classification.player_applicant_list',compact('applicant_details','sports','districts'));
    
    }

     public function player_classification_view_details($id){
      $decodeid = base64_decode($id);  
      $player_applicationview = DB::table('player_applicant_application_basic')
      ->select('player_applicant_application_basic.player_register_id','player_applicant_application_basic.player_application_no','player_applicant_application_basic.blood_group_applicant','player_applicant_application_basic.father_name','player_applicant_application_basic.sports_type','player_applicant_application_basic.address','player_applicant_application_basic.district_id','player_applicant_application_basic.nationality','player_applicant_application_basic.religion','player_applicant_application_basic.vehicle_number','player_applicant_application_basic.aadhar_card','player_applicant_application_basic.final_submission_date','player_registration.name','player_registration.dob','player_registration.mobile','player_registration.email','player_applicant_application_basic.profile_image','player_applicant_application_basic.applicant_sign')
      ->join('player_registration', 'player_registration.id','=','player_applicant_application_basic.player_register_id')
      ->where('player_register_id', $decodeid)->orderBy('player_applicant_application_basic.id', 'DESC')->get();  
      return view('admin.player_classification.player_applicant_view_details',compact('player_applicationview'));

     }

     
  
}