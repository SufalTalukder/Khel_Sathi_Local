<?php

namespace App\Http\Controllers\Admin;
use App\Events\SmsMail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EklavyaKreedaKosh;
use Illuminate\Support\Facades\Hash;

use App\Models\GymnasiumSwimming;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class EklavyaKreedaKendraController extends Controller
{

    public function eklavya_kreeda_kendra_list(){
     $applicationview = DB::table('eklavya_krida_kosh_basic_detail')->orderBy('id', 'DESC')->get();
     
     $districts = DB::table('cities')->select('city', 'id')->where('state_id', '23')->get();
     
     return view('admin.eklavya_kreeda_kendra.eklavya_kreeda_list', compact('applicationview','districts'));
    }
    
    public function eklavya_kreeda_view_details($id){
     
       $applicationview = DB::table('eklavya_krida_kosh_basic_detail')->where('user_id',$id)->first();
       $applicationview = DB::select('SELECT r.id, r.application_no, r.name, r.mobile, r.email, r.status_preview, r.final_submit_date, r.application_status, d.user_id, d.purpose, d.father_name, d.account_no , d.mother_name, d.gender, d.dob, d.aadhaar, d.nationality, d.phone, d.profile_picture, d.signature, d.high_school_certificate, d.domicile_certificate, d.highest_qualification_certificate, d.permanent_address, d.permanent_district, d.permanent_pin, d.correspondance_address, d.correspondance_district, d.correspondance_state, d.correspondance_pin, d.bank_name, d.ifsc_code, d.front_page_of_passbook FROM eklavya_krida_kosh_registration r JOIN eklavya_krida_kosh_basic_detail d ON d.user_id = r.id WHERE d.user_id = '.$id);
       //SELECT r.id, r.application_no, r.name, r.mobile, r.email, r.status_preview, r.final_submit_date, r.application_status, d.user_id, d.purpose, d.father_name, d.mother_name, d.gender, d.dob, d.aadhaar, d.nationality, d.phone, d.profile_picture, d.signature, d.high_school_certificate, d.domicile_certificate, d.highest_qualification_certificate, d.permanent_address, d.permanent_district, d.permanent_pin, d.correspondance_address, d.correspondance_district, d.correspondance_state, d.correspondance_pin, d.bank_name, d.ifsc_code, d.front_page_of_passbook FROM eklavya_krida_kosh_registration r JOIN eklavya_krida_kosh_basic_detail d ON d.user_id = r.id;
      // dd($applicationview);
        $award = DB::table('eklavya_krida_kosh_award')->where('user_id', $id)->get();
        return view('admin.eklavya_kreeda_kendra.eklavya_kreeda_details', compact('applicationview','award'));
    }
    public function eklavya_kreeda_list_search( Request $req)
    {

       $applicant_detailss = DB::table('eklavya_krida_kosh_basic_detail')
       ->join('eklavya_krida_kosh_registration', 'eklavya_krida_kosh_registration.id','=','eklavya_krida_kosh_basic_detail.user_id')
        ->select('eklavya_krida_kosh_registration.*','eklavya_krida_kosh_registration.id as play_id','eklavya_krida_kosh_basic_detail.*')
        ->where('eklavya_krida_kosh_registration.status_preview', 2);
      
        if ($req->city_filter){
          $applicant_detailss->where( 'eklavya_krida_kosh_basic_detail.permanent_district', $req->city_filter);
        }
       
        $applicationview=$applicant_detailss->orderBy('eklavya_krida_kosh_registration.name')->get();
        $districts = DB::table('cities')->select('city', 'id')->where('state_id', '23')->get();
        $sports = DB::table('sport_type')->orderBy('name')->get();
      return view('admin.eklavya_kreeda_kendra.eklavya_kreeda_list',compact('applicationview','sports','districts'));

    }

}


?>
