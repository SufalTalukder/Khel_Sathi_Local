<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Models\Adminuser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Events\UserLoggedIn;
use App\Events\SmsMail;
use PhpParser\Node\Stmt\Else_;
use App\Models\DivisionModel;
class CollegeAdmin extends Controller
{

  public function index()
  {
    session()->put('filter_hostel', '');

    $division = DB::table('hostel_division_master')->get();
    $sports = DB::table('sport_onlineadmission')->where('status', 1);

    if (Auth::guard('admin')->user()->id == 40) {
      $sports->whereIn('id', [25, 5, 7]);
    }
    ;


    if (Auth::guard('admin')->user()->id == 41) {
      $sports->whereIn('id', [8, 9]);
    }
    ;

    $sports = $sports->orderBy('name', 'asc')->get();
    $divisions = DivisionModel::select('division_name', 'id');

    if (Auth::guard('admin')->user()->admin_role == 19) {


      if (Auth::guard('admin')->user()->id == 143) {
        $divisions->whereIn('id', [25, 28, 30]);

      } elseif (Auth::guard('admin')->user()->id == 144) {
        $divisions->whereIn('id', [26, 31]);
      } elseif (Auth::guard('admin')->user()->id == 145) {
        $divisions->whereIn('id', [36, 40]);
      } elseif (Auth::guard('admin')->user()->id == 146) {
        $divisions->whereIn('id', [29, 38]);
      } elseif (Auth::guard('admin')->user()->id == 147) {
        $divisions->whereIn('id', [18, 24, 32]);
      } elseif (Auth::guard('admin')->user()->id == 148) {
        $divisions->whereIn('id', [27, 37]);
      } elseif (Auth::guard('admin')->user()->id == 149) {
        $divisions->whereIn('id', [35, 39]);
      } elseif (Auth::guard('admin')->user()->id == 150) {
        $divisions->whereIn('id', [33, 34]);
      }


    }


    $divisions = $divisions->get();
    $check = DB::table('hostel_div_district_mapping')
      ->select(DB::raw('group_concat(district_id) as district_id'));


    if (Auth::guard('admin')->user()->admin_role == 19) {


      if (Auth::guard('admin')->user()->id == 143) {
        $check->whereIn('division_id', [25, 28, 30]);

      } elseif (Auth::guard('admin')->user()->id == 144) {
        $check->whereIn('division_id', [26, 31]);
      } elseif (Auth::guard('admin')->user()->id == 145) {
        $check->whereIn('division_id', [36, 40]);
      } elseif (Auth::guard('admin')->user()->id == 146) {
        $check->whereIn('division_id', [29, 38]);
      } elseif (Auth::guard('admin')->user()->id == 147) {
        $check->whereIn('division_id', [18, 24, 32]);
      } elseif (Auth::guard('admin')->user()->id == 148) {
        $check->whereIn('division_id', [27, 37]);
      } elseif (Auth::guard('admin')->user()->id == 149) {
        $check->whereIn('division_id', [35, 39]);
      } elseif (Auth::guard('admin')->user()->id == 150) {
        $check->whereIn('division_id', [33, 34]);
      }


    } else {
      $check->where('division_id', Auth::guard('admin')->user()->division_id);
    }











    $check = $check->get();
    $district = DB::table('cities')->where('state_id', 23);
    $abc = 0;
    if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 6) {
      $abc = 1;
    }
    if ($abc == 0) {
      $district->whereIn('id', explode(',', $check[0]->district_id));
    }


    $district = $district->orderBy('city', 'asc')->get();

    // $registrations = DB::table('admission_registration_login as rg')
    //                                         ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
    //                                         ->join('online_admission_communication_details as comm', 'rg.id', '=', 'comm.user_id')
    //                              ->join('online_admission_education_document_details as edu', 'rg.id', '=', 'edu.user_id')
    //                                         ->join('cities', 'cities.id', '=', 'comm.p_district')
    //                                             ->leftjoin('hostel_div_district_mapping','cities.id','=','hostel_div_district_mapping.district_id')
    //                                         ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
    //                                         ->leftJoin('sub_sport_type', 'basic.sub_sport_type', '=', 'sub_sport_type.id')


    //                                         ->join('online_admission_payment_response_details as payment_response', 'payment_response.uniquechallan', '=', 'rg.challan_no')

    //                                         ->select('rg.application_no','rg.query_status','rg.pen_no','edu.updise_code','rg.enroll_no','rg.trial_type' ,'rg.fullname', 'basic.sub_sport_type','basic.trial_division','rg.email','rg.mobile','sub_sport_type.sub_type','rg.aadhar_no','sport_onlineadmission.name','rg.final_status','rg.id as register_id', 'rg.challan_no','rg.created_at', 'basic.sport_college','payment_response.uniquechallan','payment_response.transDate', 'basic.father_name');
    //                                         $registrations->where('rg.payment_status', 1);




    //                                         if(Auth::guard('admin')->user()->id==40 ){


    //                                             $registrations->whereIn( 'sport_onlineadmission.id',[25,5,7] );
    //                                         } ;


    //                                         if(Auth::guard('admin')->user()->id==41 ){
    //                                             $registrations->whereIn( 'sport_onlineadmission.id',[8,9]);
    //                                         } ;

    //                                         $abc=0;
    //                                         if(Auth::guard('admin')->user()->admin_role==1 || Auth::guard('admin')->user()->admin_role == 6 || Auth::guard('admin')->user()->admin_role == 19){
    //                                             $abc=1;
    //                                         }
    //                                                                                     if($abc==0){
    //                                                                                          $registrations->where( 'hostel_div_district_mapping.division_id',Auth::guard('admin')->user()->division_id);
    //                                                                                     }



    //                                                                                     if(Auth::guard('admin')->user()->admin_role == 19){


    //                                                                                       if(Auth::guard('admin')->user()->id == 143){
    //                                                                                         $registrations->whereIn( 'hostel_div_district_mapping.division_id',[25, 28, 30]);

    //                                                                                       }elseif(Auth::guard('admin')->user()->id == 144){
    //                                                                                         $registrations->whereIn( 'hostel_div_district_mapping.division_id',[26,31]);
    //                                                                                       }elseif(Auth::guard('admin')->user()->id == 145){
    //                                                                                         $registrations->whereIn( 'hostel_div_district_mapping.division_id',[36,40]);
    //                                                                                       }elseif(Auth::guard('admin')->user()->id == 146){
    //                                                                                         $registrations->whereIn( 'hostel_div_district_mapping.division_id',[29,38]);
    //                                                                                       }elseif(Auth::guard('admin')->user()->id == 147){
    //                                                                                         $registrations->whereIn( 'hostel_div_district_mapping.division_id',[18, 24,32]);
    //                                                                                       }elseif(Auth::guard('admin')->user()->id == 148){
    //                                                                                         $registrations->whereIn( 'hostel_div_district_mapping.division_id',[27,37]);
    //                                                                                       }elseif(Auth::guard('admin')->user()->id == 149){
    //                                                                                         $registrations->whereIn( 'hostel_div_district_mapping.division_id',[35,39]);
    //                                                                                       }elseif(Auth::guard('admin')->user()->id == 150){
    //                                                                                         $registrations->whereIn( 'hostel_div_district_mapping.division_id',[33,34]);
    //                                                                                       }


    //                                                                                     }


    //                                         $registrations->where('rg.session_year', '2026');

    //                                         $data=$registrations->where('payment_response.status', 'success')->groupBy('rg.id')->orderBy('rg.fullname' , 'asc')->get();
    $data = [];
    return view('collegeadmin.dashboard', ['registrations' => $data, 'sports' => $sports, 'district' => $district, 'divisions' => $divisions, 'division' => $division]);
  }




  public function filter(Request $request)
  {

    session()->put('filter_hostel', $request->all());
    $division = DB::table('hostel_division_master')->get();
    $divisions = DivisionModel::select('division_name', 'id');

    if (Auth::guard('admin')->user()->admin_role == 19) {


      if (Auth::guard('admin')->user()->id == 143) {
        $divisions->whereIn('id', [25, 28, 30]);

      } elseif (Auth::guard('admin')->user()->id == 144) {
        $divisions->whereIn('id', [26, 31]);
      } elseif (Auth::guard('admin')->user()->id == 145) {
        $divisions->whereIn('id', [36, 40]);
      } elseif (Auth::guard('admin')->user()->id == 146) {
        $divisions->whereIn('id', [29, 38]);
      } elseif (Auth::guard('admin')->user()->id == 147) {
        $divisions->whereIn('id', [18, 24, 32]);
      } elseif (Auth::guard('admin')->user()->id == 148) {
        $divisions->whereIn('id', [27, 37]);
      } elseif (Auth::guard('admin')->user()->id == 149) {
        $divisions->whereIn('id', [35, 39]);
      } elseif (Auth::guard('admin')->user()->id == 150) {
        $divisions->whereIn('id', [33, 34]);
      }


    }


    $divisions = $divisions->get();
    $sports = DB::table('sport_onlineadmission')->where('status', 1);

    if (Auth::guard('admin')->user()->id == 40) {
      $sports->whereIn('id', [25, 5, 7]);
    }
    ;


    if (Auth::guard('admin')->user()->id == 41) {
      $sports->whereIn('id', [8, 9]);
    }
    ;

    $sports = $sports->orderBy('name', 'asc')->get();
    $check = DB::table('hostel_div_district_mapping')
      ->select(DB::raw('group_concat(district_id) as district_id'));


    if (Auth::guard('admin')->user()->admin_role == 19) {


      if (Auth::guard('admin')->user()->id == 143) {
        $check->whereIn('division_id', [25, 28, 30]);

      } elseif (Auth::guard('admin')->user()->id == 144) {
        $check->whereIn('division_id', [26, 31]);
      } elseif (Auth::guard('admin')->user()->id == 145) {
        $check->whereIn('division_id', [36, 40]);
      } elseif (Auth::guard('admin')->user()->id == 146) {
        $check->whereIn('division_id', [29, 38]);
      } elseif (Auth::guard('admin')->user()->id == 147) {
        $check->whereIn('division_id', [18, 24, 32]);
      } elseif (Auth::guard('admin')->user()->id == 148) {
        $check->whereIn('division_id', [27, 37]);
      } elseif (Auth::guard('admin')->user()->id == 149) {
        $check->whereIn('division_id', [35, 39]);
      } elseif (Auth::guard('admin')->user()->id == 150) {
        $check->whereIn('division_id', [33, 34]);
      }


    } else {
      $check->where('division_id', Auth::guard('admin')->user()->division_id);
    }











    $check = $check->get();

    $district = DB::table('cities')->where('state_id', 23);
    $abc = 0;
    if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 6) {
      $abc = 1;
    }
    if ($abc == 0) {
      $district->whereIn('id', explode(',', $check[0]->district_id));
    }


    $district = $district->orderBy('city', 'asc')->get();
    $registrations = DB::table('admission_registration_login as rg')
      ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
      ->join('online_admission_communication_details as comm', 'rg.id', '=', 'comm.user_id')
      ->join('online_admission_education_document_details as edu', 'rg.id', '=', 'edu.user_id')
      ->join('cities', 'cities.id', '=', 'comm.p_district')
      ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
      ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
      ->leftJoin('sub_sport_type', 'basic.sub_sport_type', '=', 'sub_sport_type.id')
      ->join('online_admission_payment_response_details as payment_response', 'payment_response.user_id', '=', 'rg.id')
      ->select('rg.application_no', 'rg.query_status', 'rg.pen_no', 'edu.updise_code', 'rg.enroll_no', 'rg.trial_type', 'rg.fullname', 'basic.sub_sport_type', 'basic.trial_division', 'rg.email', 'rg.mobile', 'sub_sport_type.sub_type', 'rg.aadhar_no', 'sport_onlineadmission.name', 'rg.final_status', 'rg.id as register_id', 'rg.challan_no', 'rg.created_at', 'basic.*', 'payment_response.uniquechallan', 'payment_response.transDate', 'basic.father_name');
    $registrations->where('rg.payment_status', 1);



    if (Auth::guard('admin')->user()->id == 40) {


      $registrations->whereIn('sport_onlineadmission.id', [25, 5, 7]);
    }
    ;


    if (Auth::guard('admin')->user()->id == 41) {
      $registrations->whereIn('sport_onlineadmission.id', [8, 9]);
    }
    ;
    $abc = 0;
    if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 6 || Auth::guard('admin')->user()->admin_role == 19) {
      $abc = 1;
    }
    if ($abc == 0) {
      $registrations->where('hostel_div_district_mapping.division_id', Auth::guard('admin')->user()->division_id);
    }



    if (Auth::guard('admin')->user()->admin_role == 19) {


      if (Auth::guard('admin')->user()->id == 143) {
        $registrations->whereIn('hostel_div_district_mapping.division_id', [25, 28, 30]);

      } elseif (Auth::guard('admin')->user()->id == 144) {
        $registrations->whereIn('hostel_div_district_mapping.division_id', [26, 31]);
      } elseif (Auth::guard('admin')->user()->id == 145) {
        $registrations->whereIn('hostel_div_district_mapping.division_id', [36, 40]);
      } elseif (Auth::guard('admin')->user()->id == 146) {
        $registrations->whereIn('hostel_div_district_mapping.division_id', [29, 38]);
      } elseif (Auth::guard('admin')->user()->id == 147) {
        $registrations->whereIn('hostel_div_district_mapping.division_id', [18, 24, 32]);
      } elseif (Auth::guard('admin')->user()->id == 148) {
        $registrations->whereIn('hostel_div_district_mapping.division_id', [27, 37]);
      } elseif (Auth::guard('admin')->user()->id == 149) {
        $registrations->whereIn('hostel_div_district_mapping.division_id', [35, 39]);
      } elseif (Auth::guard('admin')->user()->id == 150) {
        $registrations->whereIn('hostel_div_district_mapping.division_id', [33, 34]);
      }


    }












    if ($request->isMethod('post')) {

      if ($request->has('action')) {
        $registrations->where('rg.final_status', $request->action);
      }




      if ($request->query_marked) {
        $registrations->where('rg.query_status', $request->query_marked);
      }




      if ($request->has('trial_type') && $request->trial_type != null) {
        if ($request->trial_type == 2) {
          $registrations->whereIn('rg.trial_type', [2, 3, 5]);

        } else {
          $registrations->where('rg.trial_type', $request->trial_type);
        }

      }

      if ($request->subsport) {
        $registrations->where('sub_sport_type.id', $request->subsport);
      }



      if ($request->has('district_id') && $request->district_id != null) {

        $registrations->where('comm.p_district', $request->district_id);
      }

      if ($request->has('division_id') && $request->division_id != null) {






        $checkk = DB::table('hostel_div_district_mapping')
          ->select(DB::raw('group_concat(district_id) as district_id'))->where('division_id', $request->division_id)->get();

        $registrations->whereIn('comm.p_district', explode(',', $checkk[0]->district_id));
      }

      if ($request->has('sport_id') && $request->sport_id != null) {

        $registrations->where('sport_onlineadmission.id', $request->sport_id);
      }

      // dd($registrations);



      if ($request->from_Date != '') {
        $fromDate = Carbon::parse($request->from_Date)->format('Y-m-d');

        $registrations->whereRaw("
                                STR_TO_DATE(payment_response.transDate, '%a %b %d %H:%i:%s IST %Y') >= ?", [$fromDate]);
      }

      if ($request->to_Date != '') {
        $toDate = Carbon::parse($request->to_Date)->format('Y-m-d');

        $registrations->whereRaw("
                                STR_TO_DATE(payment_response.transDate, '%a %b %d %H:%i:%s IST %Y') <= ?", [$toDate]);
      }

      if ($request->from_Date != '' && $request->to_Date != '') {
        if ($fromDate > $toDate) {
          return redirect()->back()->with("error", "From Date should not be greater than To Date Field");
        } elseif ($fromDate == $toDate) {
          $registrations->whereRaw("
                                    DATE(STR_TO_DATE(payment_response.transDate, '%a %b %d %H:%i:%s IST %Y')) = ?", [$toDate]);
        } else {
          $registrations->whereRaw("
                                    STR_TO_DATE(payment_response.transDate, '%a %b %d %H:%i:%s IST %Y') BETWEEN ? AND ?", [$fromDate, $toDate]);
        }
      }





    }



    $data = $registrations->where('rg.session_year', config('app.session_year'))->where('payment_response.status', 'success')->groupBy('rg.id')->orderBy('rg.fullname', 'asc')->get();

    return view('collegeadmin.dashboard', ['registrations' => $data, 'sports' => $sports, 'district' => $district, 'divisions' => $divisions, 'division' => $division]);
  }

  public function filteraccepted(Request $request)
  {
    $division = DB::table('hostel_division_master')->get();
    $divisions = DivisionModel::select('division_name', 'id')->get();

    $sports = DB::table('sport_onlineadmission')->where('status', 1)->orderBy('name', 'asc')->get();
    $check = DB::table('hostel_div_district_mapping')
      ->select(DB::raw('group_concat(district_id) as district_id'))->where('division_id', Auth::guard('admin')->user()->division_id)->get();
    $district = DB::table('cities')->where('state_id', 23);
    $abc = 0;
    if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 6) {
      $abc = 1;
    }
    if ($abc == 0) {
      $district->where('id', explode(',', $check[0]->district_id));
    }


    $district = $district->orderBy('city', 'asc')->get();
    $registrations = DB::table('admission_registration_login as rg')
      ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
      ->join('online_admission_education_document_details as edu', 'rg.id', '=', 'edu.user_id')
      ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
      ->leftJoin('sub_sport_type', 'basic.sub_sport_type', '=', 'sub_sport_type.id')
      ->where('rg.payment_status', 1)
      ->join('online_admission_payment_response_details as payment_response', 'payment_response.uniquechallan', '=', 'rg.challan_no')
      ->select('rg.application_no', 'rg.query_status', 'rg.pen_no', 'edu.updise_code', 'rg.enroll_no', 'rg.trial_type', 'rg.fullname', 'basic.sub_sport_type', 'basic.trial_division', 'rg.email', 'rg.mobile', 'sub_sport_type.sub_type', 'rg.aadhar_no', 'sport_onlineadmission.name', 'rg.final_status', 'rg.id as register_id', 'rg.challan_no', 'rg.created_at', 'basic.*', 'payment_response.uniquechallan', 'payment_response.transDate', 'basic.father_name');



    $abc = 0;
    if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 6) {
      $abc = 1;
    }
    if ($abc == 0) {
      $registrations->where('basic.trial_division', Auth::guard('admin')->user()->division_id);
    }

    if ($request->has('sport_id')) {
      $registrations->where('sport_onlineadmission.id', 'LIKE', '%' . $request->sport_id . '%');
    }


    $registrations->where('rg.final_status', 2);


    if ($request->from_Date != '')
      $registrations->whereDate('rg.created_at', '>=', ymd($request->from_Date));

    if ($request->to_Date != '')
      $registrations->whereDate('rg.created_at', '<=', ymd($request->to_Date));

    if ($request->from_Date != '' && $request->to_Date != '') {


      if (ymd($request->from_Date) > ymd($request->to_Date)) {

        return redirect()->back()->with("error", "From Date should not be greater than To Date Field");

      } else {


        $registrations->whereBetween('rg.created_at', [ymd($request->from_Date), ymd($request->to_Date)]);
      }





    }

    $data = $registrations->where('rg.session_year', config('app.session_year'))->where('payment_response.status', 'success')->groupBy('rg.id')->orderBy('rg.fullname', 'asc')->get();



    return view('collegeadmin.dashboard', ['registrations' => $data, 'sports' => $sports, 'status' => 2, 'district' => $district, 'divisions' => $divisions, 'division' => $division]);
  }



  public function filterpending(Request $request)
  {
    $division = DB::table('hostel_division_master')->get();

    $check = DB::table('hostel_div_district_mapping')
      ->select(DB::raw('group_concat(district_id) as district_id'))->where('division_id', Auth::guard('admin')->user()->division_id)->get();
    $district = DB::table('cities')->where('state_id', 23);
    $abc = 0;
    if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 6) {
      $abc = 1;
    }
    if ($abc == 0) {
      $district->where('id', explode(',', $check[0]->district_id));
    }


    $district = $district->orderBy('city', 'asc')->get();
    $divisions = DivisionModel::select('division_name', 'id')->get();
    $sports = DB::table('sport_onlineadmission')->where('status', 1)->orderBy('name', 'asc')->get();
    $registrations = DB::table('admission_registration_login as rg')
      ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
      ->join('online_admission_education_document_details as edu', 'rg.id', '=', 'edu.user_id')
      ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
      ->leftJoin('sub_sport_type', 'basic.sub_sport_type', '=', 'sub_sport_type.id')
      ->join('online_admission_payment_response_details as payment_response', 'payment_response.uniquechallan', '=', 'rg.challan_no')
      ->where('rg.payment_status', 1)

      ->select('rg.application_no', 'rg.query_status', 'rg.pen_no', 'edu.updise_code', 'rg.enroll_no', 'rg.trial_type', 'rg.fullname', 'basic.sub_sport_type', 'basic.trial_division', 'rg.email', 'rg.mobile', 'sub_sport_type.sub_type', 'rg.aadhar_no', 'sport_onlineadmission.name', 'rg.final_status', 'rg.id as register_id', 'rg.challan_no', 'rg.created_at', 'basic.*', 'payment_response.uniquechallan', 'payment_response.transDate', 'basic.father_name');


    if ($request->has('sport_id')) {
      $registrations->where('sport_onlineadmission.id', 'LIKE', '%' . $request->sport_id . '%');
    }
    $abc = 0;
    if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 6) {
      $abc = 1;
    }
    if ($abc == 0) {
      $registrations->where('basic.trial_division', Auth::guard('admin')->user()->division_id);
    }

    $registrations->where('rg.final_status', 1);


    if ($request->from_Date != '')
      $registrations->whereDate('rg.created_at', '>=', ymd($request->from_Date));

    if ($request->to_Date != '')
      $registrations->whereDate('rg.created_at', '<=', ymd($request->to_Date));

    if ($request->from_Date != '' && $request->to_Date != '') {
      if (ymd($request->from_Date) > ymd($request->to_Date)) {

        return redirect()->back()->with("error", "From Date should not be greater than To Date Field");

      } else {
        $registrations->whereBetween('rg.created_at', [ymd($request->from_Date), ymd($request->to_Date)]);
      }





    }

    $data = $registrations->where('rg.session_year', config('app.session_year'))->where('payment_response.status', 'success')->groupBy('rg.id')->orderBy('rg.fullname', 'asc')->get();

    return view('collegeadmin.dashboard', ['registrations' => $data, 'sports' => $sports, 'status' => 1, 'district' => $district, 'divisions' => $divisions, 'division' => $division]);
  }




  public function filterrejected(Request $request)
  {
    $division = DB::table('hostel_division_master')->get();
    $divisions = DivisionModel::select('division_name', 'id')->get();
    $check = DB::table('hostel_div_district_mapping')
      ->select(DB::raw('group_concat(district_id) as district_id'))->where('division_id', Auth::guard('admin')->user()->division_id)->get();
    $district = DB::table('cities')->where('state_id', 23);
    $abc = 0;
    if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 6) {
      $abc = 1;
    }
    if ($abc == 0) {
      $district->where('id', explode(',', $check[0]->district_id));
    }


    $district = $district->orderBy('city', 'asc')->get();
    $sports = DB::table('sport_onlineadmission')->where('status', 1)->orderBy('name', 'asc')->get();
    $registrations = DB::table('admission_registration_login as rg')
      ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
      ->join('online_admission_education_document_details as edu', 'rg.id', '=', 'edu.user_id')
      ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
      ->leftJoin('sub_sport_type', 'basic.sub_sport_type', '=', 'sub_sport_type.id')
      ->join('online_admission_payment_response_details as payment_response', 'payment_response.uniquechallan', '=', 'rg.challan_no')
      ->where('rg.payment_status', 1)
      ->select('rg.application_no', 'rg.query_status', 'rg.pen_no', 'edu.updise_code', 'rg.enroll_no', 'rg.trial_type', 'rg.fullname', 'basic.sub_sport_type', 'basic.trial_division', 'rg.email', 'rg.mobile', 'sub_sport_type.sub_type', 'rg.aadhar_no', 'sport_onlineadmission.name', 'rg.final_status', 'rg.id as register_id', 'rg.challan_no', 'rg.created_at', 'basic.*', 'payment_response.uniquechallan', 'payment_response.transDate', 'basic.father_name');






    if ($request->has('sport_id')) {
      $registrations->where('sport_onlineadmission.id', 'LIKE', '%' . $request->sport_id . '%');
    }
    $abc = 0;
    if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 6) {
      $abc = 1;
    }
    if ($abc == 0) {

      $registrations->where('basic.trial_division', Auth::guard('admin')->user()->division_id);
    }
    $registrations->where('rg.final_status', 3);


    if ($request->from_Date != '')
      $registrations->whereDate('rg.created_at', '>=', ymd($request->from_Date));

    if ($request->to_Date != '')
      $registrations->whereDate('rg.created_at', '<=', ymd($request->to_Date));

    if ($request->from_Date != '' && $request->to_Date != '') {
      if (ymd($request->from_Date) > ymd($request->to_Date)) {

        return redirect()->back()->with("error", "From Date should not be greater than To Date Field");

      } else {
        $registrations->whereBetween('rg.created_at', [ymd($request->from_Date), ymd($request->to_Date)]);
      }





    }

    $data = $registrations->where('rg.session_year', config('app.session_year'))->where('payment_response.status', 'success')->groupBy('rg.id')->orderBy('rg.fullname', 'asc')->get();

    return view('collegeadmin.dashboard', ['registrations' => $data, 'sports' => $sports, 'status' => 3, 'district' => $district, 'divisions' => $divisions, 'division' => $division]);
  }


  public function registerUuserDetails($id)
  {

    $data = DB::table('admission_registration_login as rg')
      ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
      ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
      ->join('online_admission_education_document_details as education', 'rg.id', '=', 'education.user_id')
      ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
      ->join('cities', 'communication.p_district', '=', 'cities.id')

      ->select('rg.id as id', 'rg.*', 'rg.application_no as application_no', 'basic.*', 'communication.*', 'education.*', 'sport_onlineadmission.name', 'cities.trial_location')
      ->where('rg.id', $id)->where('rg.payment_status', 1)->first();






    return view('collegeadmin.online_admission_details', compact('data'));
  }

  //badmintontrialList
  public function badmintontrialList(Request $request)
  {


    $validation = Validator::make($request->all(), [

      'high_double_service_mark' => 'required|numeric|max:7.5',

      'smash_mark' => 'required|numeric|max:7.5',

      'drop_mark' => 'required|numeric|max:7.5',

      'backhand_mark' => 'required|numeric|max:7.5',

      'test_score_mark' => 'required|numeric|max:30',
      'game_technique' => 'required|numeric|max:20',
      'sport_test_mark' => 'required|numeric|max:50',
      'total_obtain_mark' => 'required|numeric|max:100',
      'remark' => 'required|max:255',


    ]);

    if ($validation->fails())
      return response()->json(['error' => true, 'msg' => $validation->errors()->first(), "application_no" => $request->application_no]);


    $data = [
      'sport_id' => $request->sport_id,
      'trial_type' => $request->trial_type,

      'application_no' => $request->application_no,
      'applicant_id' => $request->applicant_id,
      'high_double_service_mark' => $request->high_double_service_mark,
      'smash_mark' => $request->smash_mark,
      'drop_mark' => $request->drop_mark,
      'backhand_mark' => $request->backhand_mark,
      'test_score_mark' => $request->test_score_mark,
      'game_technique' => $request->game_technique,
      'sport_test_mark' => $request->sport_test_mark,
      'total_obtain_mark' => $request->total_obtain_mark,
      'remark' => $request->remark,
      'addedby' => Auth::guard('admin')->user()->id,
      'date' => date("Y-m-d H:i:s")

    ];

    $id = DB::table('online_admission_badminton_trial')->insertGetId($data);


    if ($request->sport_test_mark >= 20 && $request->total_obtain_mark - $request->sport_test_mark >= 20 && $request->trial_type == 1) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 2,
        'skill_trial_one_marks' => $request->sport_test_mark

      ]);
    } elseif (($request->sport_test_mark < 20 || $request->total_obtain_mark - $request->sport_test_mark < 20) && $request->trial_type == 1) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 4,
        'final_status' => 3,
        'skill_trial_one_marks' => $request->sport_test_mark

      ]);
    }

    if ($request->sport_test_mark >= 20 && $request->total_obtain_mark - $request->sport_test_mark >= 20 && $request->trial_type == 2) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark
      ]);
    } elseif (($request->sport_test_mark < 20 || $request->total_obtain_mark - $request->sport_test_mark < 20) && $request->trial_type == 2) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 5,
        'final_status' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark
      ]);
    }

    return response()->json(["error" => false, "msg" => "Sport Trial Data Submit Successfully", "application_no" => $request->application_no]);
  }






  public function judotrialList(Request $request)
  {


    $validation = Validator::make($request->all(), [

      'straight_work_throw_mark' => 'required|numeric|max:7.5',

      'hip_leg_hand_techniquec_mark' => 'required|numeric|max:7.5',

      'throw_count_mark' => 'required|numeric|max:7.5',

      'throw_combination_mark' => 'required|numeric|max:7.5',

      'test_score_mark' => 'required|numeric|max:30',
      'game_technique' => 'required|numeric|max:20',
      'sport_test_mark' => 'required|numeric|max:50',
      'total_obtain_mark' => 'required|numeric|max:100',
      'remark' => 'required|max:255',


    ]);

    if ($validation->fails())
      return response()->json(['error' => true, 'msg' => $validation->errors()->first(), "application_no" => $request->application_no]);


    $data = [
      'sport_id' => $request->sport_id,
      'trial_type' => $request->trial_type,

      'application_no' => $request->application_no,
      'applicant_id' => $request->applicant_id,
      'straight_work_throw_mark' => $request->straight_work_throw_mark,
      'hip_leg_hand_techniquec_mark' => $request->hip_leg_hand_techniquec_mark,
      'throw_count_mark' => $request->throw_count_mark,
      'throw_combination_mark' => $request->throw_combination_mark,
      'test_score_mark' => $request->test_score_mark,
      'game_technique' => $request->game_technique,
      'sport_test_mark' => $request->sport_test_mark,
      'total_obtain_mark' => $request->total_obtain_mark,
      'remark' => $request->remark,
      'addedby' => Auth::guard('admin')->user()->id,
      'date' => date("Y-m-d H:i:s")

    ];

    $id = DB::table('online_admission_judo_trial')->insertGetId($data);
    if ($request->sport_test_mark >= 20 && $request->total_obtain_mark - $request->sport_test_mark >= 20 && $request->trial_type == 1) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 2,
        'skill_trial_one_marks' => $request->sport_test_mark

      ]);
    } elseif (($request->sport_test_mark < 20 || $request->total_obtain_mark - $request->sport_test_mark < 20) && $request->trial_type == 1) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 4,
        'final_status' => 3,
        'skill_trial_one_marks' => $request->sport_test_mark

      ]);
    }

    if ($request->sport_test_mark >= 20 && $request->total_obtain_mark - $request->sport_test_mark >= 20 && $request->trial_type == 2) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark
      ]);
    } elseif (($request->sport_test_mark < 20 || $request->total_obtain_mark - $request->sport_test_mark < 20) && $request->trial_type == 2) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 5,
        'final_status' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark
      ]);
    }


    return response()->json(["error" => false, "msg" => "Sport Trial Data Submit Successfully", "application_no" => $request->application_no]);
  }




  public function kustitrialList(Request $request)
  {


    $validation = Validator::make($request->all(), [

      'ground_position_mark' => 'required|numeric|max:15',

      'front_position_back_position_mark' => 'required|numeric|max:15',



      'test_score_mark' => 'required|numeric|max:30',
      'game_technique' => 'required|numeric|max:20',
      'sport_test_mark' => 'required|numeric|max:50',
      'total_obtain_mark' => 'required|numeric|max:100',
      'remark' => 'required|max:255',


    ]);

    if ($validation->fails())
      return response()->json(['error' => true, 'msg' => $validation->errors()->first(), "application_no" => $request->application_no]);


    $data = [
      'sport_id' => $request->sport_id,
      'trial_type' => $request->trial_type,

      'application_no' => $request->application_no,
      'applicant_id' => $request->applicant_id,
      'ground_position_mark' => $request->ground_position_mark,
      'front_position_back_position_mark' => $request->front_position_back_position_mark,

      'test_score_mark' => $request->test_score_mark,
      'game_technique' => $request->game_technique,
      'sport_test_mark' => $request->sport_test_mark,
      'total_obtain_mark' => $request->total_obtain_mark,
      'remark' => $request->remark,
      'addedby' => Auth::guard('admin')->user()->id,
      'date' => date("Y-m-d H:i:s")

    ];

    $id = DB::table('online_admission_kusti_trial')->insertGetId($data);
    if ($request->sport_test_mark >= 20 && $request->total_obtain_mark - $request->sport_test_mark >= 20 && $request->trial_type == 1) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 2,
        'skill_trial_one_marks' => $request->sport_test_mark

      ]);
    } elseif (($request->sport_test_mark < 20 || $request->total_obtain_mark - $request->sport_test_mark < 20) && $request->trial_type == 1) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 4,
        'final_status' => 3,
        'skill_trial_one_marks' => $request->sport_test_mark

      ]);
    }

    if ($request->sport_test_mark >= 20 && $request->total_obtain_mark - $request->sport_test_mark >= 20 && $request->trial_type == 2) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark
      ]);
    } elseif (($request->sport_test_mark < 20 || $request->total_obtain_mark - $request->sport_test_mark < 20) && $request->trial_type == 2) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 5,
        'final_status' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark
      ]);
    }
    return response()->json(["error" => false, "msg" => "Sport Trial Data Submit Successfully", "application_no" => $request->application_no]);
  }


  //volleyBalltrialList
  public function volleyBalltrialList(Request $request)
  {

    $validation = Validator::make($request->all(), [

      'under_hand_mark' => 'required|numeric|max:7.5',

      'upper_hand_mark' => 'required|numeric|max:7.5',

      'service_mark' => 'required|numeric|max:7.5',

      'smash_mark' => 'required|numeric|max:7.5',

      'test_score_mark' => 'required|numeric|max:30',
      'game_technique' => 'required|numeric|max:20',
      'sport_test_mark' => 'required|numeric|max:50',
      'total_obtain_mark' => 'required|numeric|max:100',
      'remark' => 'required|max:255',


    ]);

    if ($validation->fails())
      return response()->json(['error' => true, 'msg' => $validation->errors()->first(), "application_no" => $request->application_no]);


    $data = [
      'sport_id' => $request->sport_id,

      'trial_type' => $request->trial_type,
      'application_no' => $request->application_no,
      'applicant_id' => $request->applicant_id,
      'under_hand_mark' => $request->under_hand_mark,
      'upper_hand_mark' => $request->upper_hand_mark,
      'service_mark' => $request->service_mark,
      'smash_mark' => $request->smash_mark,
      'test_score_mark' => $request->test_score_mark,
      'game_technique' => $request->game_technique,
      'sport_test_mark' => $request->sport_test_mark,
      'total_obtain_mark' => $request->total_obtain_mark,
      'remark' => $request->remark,
      'addedby' => Auth::guard('admin')->user()->id,
      'date' => date("Y-m-d H:i:s")

    ];

    $id = DB::table('online_admission_volleyball_trial')->insertGetId($data);
    if ($request->sport_test_mark >= 20 && $request->total_obtain_mark - $request->sport_test_mark >= 20 && $request->trial_type == 1) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 2,
        'skill_trial_one_marks' => $request->sport_test_mark

      ]);
    } elseif (($request->sport_test_mark < 20 || $request->total_obtain_mark - $request->sport_test_mark < 20) && $request->trial_type == 1) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 4,
        'final_status' => 3,
        'skill_trial_one_marks' => $request->sport_test_mark

      ]);
    }

    if ($request->sport_test_mark >= 20 && $request->total_obtain_mark - $request->sport_test_mark >= 20 && $request->trial_type == 2) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark
      ]);
    } elseif (($request->sport_test_mark < 20 || $request->total_obtain_mark - $request->sport_test_mark < 20) && $request->trial_type == 2) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 5,
        'final_status' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark
      ]);
    }
    return response()->json(["error" => false, "msg" => "Sport Trial Data Submit Successfully", "application_no" => $request->application_no]);


  }


  //footballkeepertrialList
  public function footballkeepertrialList(Request $request)
  {
    $validation = Validator::make($request->all(), [

      'grip_mark' => 'required|numeric|max:7.5',

      'dive_mark' => 'required|numeric|max:7.5',

      'patch_mark' => 'required|numeric|max:7.5',

      'kick_mark' => 'required|numeric|max:7.5',

      'test_score_mark' => 'required|numeric|max:30',
      'game_technique' => 'required|numeric|max:20',
      'sport_test_mark' => 'required|numeric|max:50',
      'total_obtain_mark' => 'required|numeric|max:100',
      'remark' => 'required|max:255',


    ]);

    if ($validation->fails())
      return response()->json(['error' => true, 'msg' => $validation->errors()->first(), "application_no" => $request->application_no]);


    $data = [
      'sport_id' => $request->sport_id,

      'trial_type' => $request->trial_type,
      'application_no' => $request->application_no,
      'applicant_id' => $request->applicant_id,
      'grip_mark' => $request->grip_mark,
      'dive_mark' => $request->dive_mark,
      'patch_mark' => $request->patch_mark,
      'kick_mark' => $request->kick_mark,
      'test_score_mark' => $request->test_score_mark,
      'game_technique' => $request->game_technique,
      'sport_test_mark' => $request->sport_test_mark,
      'total_obtain_mark' => $request->total_obtain_mark,
      'remark' => $request->remark,
      'addedby' => Auth::guard('admin')->user()->id,
      'date' => date("Y-m-d H:i:s")

    ];

    $id = DB::table('online_admission_football_goalkeeper_trial')->insertGetId($data);

    if ($request->sport_test_mark >= 20 && $request->total_obtain_mark - $request->sport_test_mark >= 20 && $request->trial_type == 1) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 2,
        'skill_trial_one_marks' => $request->sport_test_mark

      ]);
    } elseif (($request->sport_test_mark < 20 || $request->total_obtain_mark - $request->sport_test_mark < 20) && $request->trial_type == 1) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 4,
        'final_status' => 3,
        'skill_trial_one_marks' => $request->sport_test_mark

      ]);
    }

    if ($request->sport_test_mark >= 20 && $request->total_obtain_mark - $request->sport_test_mark >= 20 && $request->trial_type == 2) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark
      ]);
    } elseif (($request->sport_test_mark < 20 || $request->total_obtain_mark - $request->sport_test_mark < 20) && $request->trial_type == 2) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 5,
        'final_status' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark
      ]);
    }

    return response()->json(["error" => false, "msg" => "Sport Trial Data Submit Successfully", "application_no" => $request->application_no]);


  }


  //footballtrialList
  public function footballtrialList(Request $request)
  {
    $validation = Validator::make($request->all(), [

      'kick_mark' => 'required|numeric|max:7.5',

      'dribble_tackle_mark' => 'required|numeric|max:7.5',

      'head_mark' => 'required|numeric|max:7.5',

      'control_pad_mark' => 'required|numeric|max:7.5',

      'test_score_mark' => 'required|numeric|max:30',
      'game_technique' => 'required|numeric|max:20',
      'sport_test_mark' => 'required|numeric|max:50',
      'total_obtain_mark' => 'required|numeric|max:100',
      'remark' => 'required|max:255',


    ]);

    if ($validation->fails())
      return response()->json(['error' => true, 'msg' => $validation->errors()->first(), "application_no" => $request->application_no]);


    $data = [
      'sport_id' => $request->sport_id,
      'trial_type' => $request->trial_type,

      'application_no' => $request->application_no,
      'applicant_id' => $request->applicant_id,
      'kick_mark' => $request->kick_mark,
      'dribble_tackle_mark' => $request->dribble_tackle_mark,
      'head_mark' => $request->head_mark,
      'control_pad_mark' => $request->control_pad_mark,
      'test_score_mark' => $request->test_score_mark,
      'game_technique' => $request->game_technique,
      'sport_test_mark' => $request->sport_test_mark,
      'total_obtain_mark' => $request->total_obtain_mark,
      'remark' => $request->remark,
      'addedby' => Auth::guard('admin')->user()->id,
      'date' => date("Y-m-d H:i:s")

    ];

    $id = DB::table('online_admission_football_trial')->insertGetId($data);


    if ($request->sport_test_mark >= 20 && $request->total_obtain_mark - $request->sport_test_mark >= 20 && $request->trial_type == 1) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 2,
        'skill_trial_one_marks' => $request->sport_test_mark

      ]);
    } elseif (($request->sport_test_mark < 20 || $request->total_obtain_mark - $request->sport_test_mark < 20) && $request->trial_type == 1) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 4,
        'final_status' => 3,
        'skill_trial_one_marks' => $request->sport_test_mark

      ]);
    }

    if ($request->sport_test_mark >= 20 && $request->total_obtain_mark - $request->sport_test_mark >= 20 && $request->trial_type == 2) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark
      ]);
    } elseif (($request->sport_test_mark < 20 || $request->total_obtain_mark - $request->sport_test_mark < 20) && $request->trial_type == 2) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 5,
        'final_status' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark
      ]);
    }

    return response()->json(["error" => false, "msg" => "Sport Trial Data Submit Successfully", "application_no" => $request->application_no]);


  }



  //===============================================



  //hockeytrialList
  public function hockeytrialList(Request $request){

    $validation = Validator::make($request->all(), [

      'hit_mark' => 'required|numeric|max:7.5',

      'push_mark' => 'required|numeric|max:7.5',

      'scoop_mark' => 'required|numeric|max:7.5',

      'dribbling_mark' => 'required|numeric|max:7.5',

      'test_score_mark' => 'required|numeric|max:30',
      'game_technique' => 'required|numeric|max:20',
      'sport_test_mark' => 'required|numeric|max:50',
      'total_obtain_mark' => 'required|numeric|max:100',
      'remark' => 'required|max:255',


    ]);

    if ($validation->fails())
      return response()->json(['error' => true, 'msg' => $validation->errors()->first(), "application_no" => $request->application_no]);


    $data = [
      'sport_id' => $request->sport_id,
      'trial_type' => $request->trial_type,

      'application_no' => $request->application_no,
      'applicant_id' => $request->applicant_id,
      'hit_mark' => $request->hit_mark,
      'push_mark' => $request->push_mark,
      'scoop_mark' => $request->scoop_mark,
      'dribbling_mark' => $request->dribbling_mark,
      'test_score_mark' => $request->test_score_mark,
      'game_technique' => $request->game_technique,
      'sport_test_mark' => $request->sport_test_mark,
      'total_obtain_mark' => $request->total_obtain_mark,
      'remark' => $request->remark,
      'addedby' => Auth::guard('admin')->user()->id,
      'date' => date("Y-m-d H:i:s")

    ];

    $id = DB::table('online_admission_hockey_trial')->insertGetId($data);
    if ($request->sport_test_mark >= 20 && $request->total_obtain_mark - $request->sport_test_mark >= 20 && $request->trial_type == 1) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 2,
        'skill_trial_one_marks' => $request->sport_test_mark

      ]);
    } elseif (($request->sport_test_mark < 20 || $request->total_obtain_mark - $request->sport_test_mark < 20) && $request->trial_type == 1) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 4,
        'final_status' => 3,
        'skill_trial_one_marks' => $request->sport_test_mark

      ]);
    }

    if ($request->sport_test_mark >= 20 && $request->total_obtain_mark - $request->sport_test_mark >= 20 && $request->trial_type == 2) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark
      ]);
    } elseif (($request->sport_test_mark < 20 || $request->total_obtain_mark - $request->sport_test_mark < 20) && $request->trial_type == 2) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 5,
        'final_status' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark
      ]);
    }
    return response()->json(["error" => false, "msg" => "Sport Trial Data Submit Successfully", "application_no" => $request->application_no]);
  }



  //hockeykeepertrialList
  public function hockeykeepertrialList(Request $request)
  {

    $validation = Validator::make($request->all(), [

      'kick_mark' => 'required|numeric|max:6',
      'pad_mark' => 'required|numeric|max:6',

      'stop_mark' => 'required|numeric|max:6',

      'high_push_mark' => 'required|numeric|max:6',

      'himmat_mark' => 'required|numeric|max:6',

      'test_score_mark' => 'required|numeric|max:30',
      'game_technique' => 'required|numeric|max:20',
      'sport_test_mark' => 'required|numeric|max:50',
      'total_obtain_mark' => 'required|numeric|max:100',
      'remark' => 'required|max:255',


    ]);

    if ($validation->fails())
      return response()->json(['error' => true, 'msg' => $validation->errors()->first(), "application_no" => $request->application_no]);


    $data = [
      'sport_id' => $request->sport_id,

      'trial_type' => $request->trial_type,
      'application_no' => $request->application_no,
      'applicant_id' => $request->applicant_id,
      'kick_mark' => $request->kick_mark,
      'pad_mark' => $request->pad_mark,
      'stop_mark' => $request->stop_mark,
      'high_push_mark' => $request->high_push_mark,
      'himmat_mark' => $request->himmat_mark,
      'test_score_mark' => $request->test_score_mark,
      'game_technique' => $request->game_technique,
      'sport_test_mark' => $request->sport_test_mark,
      'total_obtain_mark' => $request->total_obtain_mark,
      'remark' => $request->remark,
      'addedby' => Auth::guard('admin')->user()->id,
      'date' => date("Y-m-d H:i:s")

    ];

    $id = DB::table('online_admission_hockey_goalkeeper_trial')->insertGetId($data);

    if ($request->sport_test_mark >= 20 && $request->total_obtain_mark - $request->sport_test_mark >= 20 && $request->trial_type == 1) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 2,
        'skill_trial_one_marks' => $request->sport_test_mark

      ]);
    } elseif (($request->sport_test_mark < 20 || $request->total_obtain_mark - $request->sport_test_mark < 20) && $request->trial_type == 1) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 4,
        'final_status' => 3,
        'skill_trial_one_marks' => $request->sport_test_mark

      ]);
    }

    if ($request->sport_test_mark >= 20 && $request->total_obtain_mark - $request->sport_test_mark >= 20 && $request->trial_type == 2) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark
      ]);
    } elseif (($request->sport_test_mark < 20 || $request->total_obtain_mark - $request->sport_test_mark < 20) && $request->trial_type == 2) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 5,
        'final_status' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark
      ]);
    }


    return response()->json(["error" => false, "msg" => "Sport Trial Data Submit Successfully", "application_no" => $request->application_no]);
  }



  //kabadditrialList
  public function kabadditrialList(Request $request)
  {
    $validation = Validator::make($request->all(), [

      'raid_mark' => 'required|numeric|max:7.5',
      'kick_skill_mark' => 'required|numeric|max:7.5',

      'pakad_mark' => 'required|numeric|max:7.5',

      'covering_mark' => 'required|numeric|max:7.5',

      'test_score_mark' => 'required|numeric|max:30',
      'game_technique' => 'required|numeric|max:20',
      'sport_test_mark' => 'required|numeric|max:50',
      'total_obtain_mark' => 'required|numeric|max:100',
      'remark' => 'required|max:255',


    ]);

    if ($validation->fails())
      return response()->json(['error' => true, 'msg' => $validation->errors()->first(), "application_no" => $request->application_no]);


    $data = [
      'sport_id' => $request->sport_id,
      'trial_type' => $request->trial_type,

      'application_no' => $request->application_no,
      'applicant_id' => $request->applicant_id,
      'raid_mark' => $request->raid_mark,
      'kick_skill_mark' => $request->kick_skill_mark,
      'pakad_mark' => $request->pakad_mark,
      'covering_mark' => $request->covering_mark,

      'test_score_mark' => $request->test_score_mark,
      'game_technique' => $request->game_technique,
      'sport_test_mark' => $request->sport_test_mark,
      'total_obtain_mark' => $request->total_obtain_mark,
      'remark' => $request->remark,
      'addedby' => Auth::guard('admin')->user()->id,
      'date' => date("Y-m-d H:i:s")

    ];

    $id = DB::table('online_admission_kabbadi_trial')->insertGetId($data);

    if ($request->sport_test_mark >= 20 && $request->total_obtain_mark - $request->sport_test_mark >= 20 && $request->trial_type == 1) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 2,
        'skill_trial_one_marks' => $request->sport_test_mark

      ]);
    } elseif (($request->sport_test_mark < 20 || $request->total_obtain_mark - $request->sport_test_mark < 20) && $request->trial_type == 1) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 4,
        'final_status' => 3,
        'skill_trial_one_marks' => $request->sport_test_mark

      ]);
    }

    if ($request->sport_test_mark >= 20 && $request->total_obtain_mark - $request->sport_test_mark >= 20 && $request->trial_type == 2) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark
      ]);
    } elseif (($request->sport_test_mark < 20 || $request->total_obtain_mark - $request->sport_test_mark < 20) && $request->trial_type == 2) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 5,
        'final_status' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark
      ]);
    }

    return response()->json(["error" => false, "msg" => "Sport Trial Data Submit Successfully", "application_no" => $request->application_no]);

  }

  //swimmingtrialList
  public function swimmingtrialList(Request $request)
  {
    $validation = Validator::make($request->all(), [

      'free_stroke_mark' => 'required|numeric|max:5',
      'back_stroke_mark' => 'required|numeric|max:5',

      'breast_stroke_mark' => 'required|numeric|max:5',

      'butter_fly_mark' => 'required|numeric|max:5',
      'glaiding_mark' => 'required|numeric|max:5',

      'start_mark' => 'required|numeric|max:5',

      'test_score_mark' => 'required|numeric|max:30',
      'game_technique' => 'required|numeric|max:20',
      'sport_test_mark' => 'required|numeric|max:50',
      'total_obtain_mark' => 'required|numeric|max:100',
      'remark' => 'required|max:255',


    ]);

    if ($validation->fails())
      return response()->json(['error' => true, 'msg' => $validation->errors()->first(), "application_no" => $request->application_no]);


    $data = [
      'sport_id' => $request->sport_id,
      'trial_type' => $request->trial_type,

      'application_no' => $request->application_no,
      'applicant_id' => $request->applicant_id,
      'free_stroke_mark' => $request->free_stroke_mark,
      'back_stroke_mark' => $request->back_stroke_mark,
      'breast_stroke_mark' => $request->breast_stroke_mark,
      'butter_fly_mark' => $request->butter_fly_mark,
      'glaiding_mark' => $request->glaiding_mark,
      'start_mark' => $request->start_mark,

      'test_score_mark' => $request->test_score_mark,
      'game_technique' => $request->game_technique,
      'sport_test_mark' => $request->sport_test_mark,
      'total_obtain_mark' => $request->total_obtain_mark,
      'remark' => $request->remark,
      'addedby' => Auth::guard('admin')->user()->id,
      'date' => date("Y-m-d H:i:s")

    ];

    $id = DB::table('online_admission_swimming_trial')->insertGetId($data);
    if ($request->sport_test_mark >= 20 && $request->total_obtain_mark - $request->sport_test_mark >= 20 && $request->trial_type == 1) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 2,
        'skill_trial_one_marks' => $request->sport_test_mark

      ]);
    } elseif (($request->sport_test_mark < 20 || $request->total_obtain_mark - $request->sport_test_mark < 20) && $request->trial_type == 1) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 4,
        'final_status' => 3,
        'skill_trial_one_marks' => $request->sport_test_mark

      ]);
    }

    if ($request->sport_test_mark >= 20 && $request->total_obtain_mark - $request->sport_test_mark >= 20 && $request->trial_type == 2) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark
      ]);
    } elseif (($request->sport_test_mark < 20 || $request->total_obtain_mark - $request->sport_test_mark < 20) && $request->trial_type == 2) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 5,
        'final_status' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark
      ]);
    }


    return response()->json(["error" => false, "msg" => "Sport Trial Data Submit Successfully", "application_no" => $request->application_no]);
  }


  //athleticsrunnertrialList
  public function athleticsrunnertrialList(Request $request)
  {
    $validation = Validator::make($request->all(), [

      'stance_mark' => 'required|numeric|max:7.5',
      'start_mark' => 'required|numeric|max:7.5',

      'action_mark' => 'required|numeric|max:7.5',

      'finish_mark' => 'required|numeric|max:7.5',

      'test_score_mark' => 'required|numeric|max:30',
      'game_technique' => 'required|numeric|max:20',
      'sport_test_mark' => 'required|numeric|max:50',
      'total_obtain_mark' => 'required|numeric|max:100',
      'remark' => 'required|max:255',


    ]);

    if ($validation->fails())
      return response()->json(['error' => true, 'msg' => $validation->errors()->first(), "application_no" => $request->application_no]);


    $data = [
      'sport_id' => $request->sport_id,

      'trial_type' => $request->trial_type,
      'application_no' => $request->application_no,
      'applicant_id' => $request->applicant_id,
      'stance_mark' => $request->stance_mark,
      'start_mark' => $request->start_mark,
      'action_mark' => $request->action_mark,
      'finish_mark' => $request->finish_mark,

      'test_score_mark' => $request->test_score_mark,
      'game_technique' => $request->game_technique,
      'sport_test_mark' => $request->sport_test_mark,
      'total_obtain_mark' => $request->total_obtain_mark,
      'remark' => $request->remark,
      'addedby' => Auth::guard('admin')->user()->id,
      'date' => date("Y-m-d H:i:s")

    ];

    $id = DB::table('online_admission_athletics_runner_trial')->insertGetId($data);

    if ($request->sport_test_mark >= 20 && $request->total_obtain_mark - $request->sport_test_mark >= 20 && $request->trial_type == 1) {

      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 2,
        'skill_trial_one_marks' => $request->sport_test_mark

      ]);

    } elseif (($request->sport_test_mark < 20 || $request->total_obtain_mark - $request->sport_test_mark < 20) && $request->trial_type == 1) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 4,
        'final_status' => 3,
        'skill_trial_one_marks' => $request->sport_test_mark

      ]);
    }

    dd($request->applicant_id, 2, $request->sport_test_mark, $request->total_obtain_mark);
    dd($request->applicant_id);
    if ($request->sport_test_mark >= 20 && $request->total_obtain_mark - $request->sport_test_mark >= 20 && $request->trial_type == 2) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark
      ]);
    } elseif (($request->sport_test_mark < 20 || $request->total_obtain_mark - $request->sport_test_mark < 20) && $request->trial_type == 2) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 5,
        'final_status' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark
      ]);
    }

    return response()->json(["error" => false, "msg" => "Sport Trial Data Submit Successfully", "application_no" => $request->application_no]);
  }




  //athleticsthrowertrialList
  public function athleticsthrowertrialList(Request $request)
  {
    $validation = Validator::make($request->all(), [

      'stance_mark' => 'required|numeric|max:7.5',
      'action_mark' => 'required|numeric|max:7.5',
      'execution_mark' => 'required|numeric|max:7.5',



      'follow_throw_mark' => 'required|numeric|max:7.5',

      'test_score_mark' => 'required|numeric|max:30',
      'game_technique' => 'required|numeric|max:20',
      'sport_test_mark' => 'required|numeric|max:50',
      'total_obtain_mark' => 'required|numeric|max:100',
      'remark' => 'required|max:255',


    ]);

    if ($validation->fails())
      return response()->json(['error' => true, 'msg' => $validation->errors()->first(), "application_no" => $request->application_no]);


    $data = [
      'sport_id' => $request->sport_id,

      'trial_type' => $request->trial_type,
      'application_no' => $request->application_no,
      'applicant_id' => $request->applicant_id,
      'stance_mark' => $request->stance_mark,
      'execution_mark' => $request->execution_mark,
      'action_mark' => $request->action_mark,
      'follow_throw_mark' => $request->follow_throw_mark,

      'test_score_mark' => $request->test_score_mark,
      'game_technique' => $request->game_technique,
      'sport_test_mark' => $request->sport_test_mark,
      'total_obtain_mark' => $request->total_obtain_mark,
      'remark' => $request->remark,
      'addedby' => Auth::guard('admin')->user()->id,
      'date' => date("Y-m-d H:i:s")

    ];

    $id = DB::table('online_admission_athletics_thrower_trial')->insertGetId($data);

    if ($request->sport_test_mark >= 20 && $request->total_obtain_mark - $request->sport_test_mark >= 20 && $request->trial_type == 1) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 2,
        'skill_trial_one_marks' => $request->sport_test_mark

      ]);
    } elseif (($request->sport_test_mark < 20 || $request->total_obtain_mark - $request->sport_test_mark < 20) && $request->trial_type == 1) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 4,
        'final_status' => 3,
        'skill_trial_one_marks' => $request->sport_test_mark

      ]);
    }

    if ($request->sport_test_mark >= 20 && $request->total_obtain_mark - $request->sport_test_mark >= 20 && $request->trial_type == 2) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark
      ]);
    } elseif (($request->sport_test_mark < 20 || $request->total_obtain_mark - $request->sport_test_mark < 20) && $request->trial_type == 2) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 5,
        'final_status' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark
      ]);
    }

    return response()->json(["error" => false, "msg" => "Sport Trial Data Submit Successfully", "application_no" => $request->application_no]);
  }



  //      //kushtitrialList
//   public function kushtitrialList()
//   {
//     $trialType = 5;

  //        $sports = DB::table('sport_type')->where('status', 1)->orderBy('name', 'asc')->get();
//     return view('collegeadmin.trialListApplicant',compact('trialType', 'sports'));
//   }




  //   //swimmingtrialList
//   public function swimmingtrialList()
//   {
//     $trialType = 6;

  //        $sports = DB::table('sport_type')->where('status', 1)->orderBy('name', 'asc')->get();
//     return view('collegeadmin.trialListApplicant',compact('trialType', 'sports'));
//   }






  //athleticsjumpertrialList
  public function athleticsjumpertrialList(Request $request)
  {
    // $trialType = 9;

    $validation = Validator::make($request->all(), [

      'approach_mark' => 'required|numeric|max:7.5',
      't_a_mark' => 'required|numeric|max:7.5',

      'action_mark' => 'required|numeric|max:7.5',

      'landing_mark' => 'required|numeric|max:7.5',

      'test_score_mark' => 'required|numeric|max:30',
      'game_technique' => 'required|numeric|max:20',
      'sport_test_mark' => 'required|numeric|max:50',
      'total_obtain_mark' => 'required|numeric|max:100',
      'remark' => 'required|max:255',


    ]);

    if ($validation->fails())
      return response()->json(['error' => true, 'msg' => $validation->errors()->first(), "application_no" => $request->application_no]);


    $data = [
      'sport_id' => $request->sport_id,
      'trial_type' => $request->trial_type,

      'application_no' => $request->application_no,
      'applicant_id' => $request->applicant_id,
      'approach_mark' => $request->approach_mark,
      't_a_mark' => $request->t_a_mark,
      'action_mark' => $request->action_mark,
      'landing_mark' => $request->landing_mark,

      'test_score_mark' => $request->test_score_mark,
      'game_technique' => $request->game_technique,
      'sport_test_mark' => $request->sport_test_mark,
      'total_obtain_mark' => $request->total_obtain_mark,
      'remark' => $request->remark,
      'addedby' => Auth::guard('admin')->user()->id,
      'date' => date("Y-m-d H:i:s")

    ];

    $id = DB::table('online_admission_athletics_jumper_trial')->insertGetId($data);

    if ($request->sport_test_mark >= 20 && $request->total_obtain_mark - $request->sport_test_mark >= 20 && $request->trial_type == 1) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 2,
        'skill_trial_one_marks' => $request->sport_test_mark

      ]);
    } elseif (($request->sport_test_mark < 20 || $request->total_obtain_mark - $request->sport_test_mark < 20) && $request->trial_type == 1) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 4,
        'final_status' => 3,
        'skill_trial_one_marks' => $request->sport_test_mark

      ]);
    }

    if ($request->sport_test_mark >= 20 && $request->total_obtain_mark - $request->sport_test_mark >= 20 && $request->trial_type == 2) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark
      ]);
    } elseif (($request->sport_test_mark < 20 || $request->total_obtain_mark - $request->sport_test_mark < 20) && $request->trial_type == 2) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 5,
        'final_status' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark
      ]);
    }

    return response()->json(["error" => false, "msg" => "Sport Trial Data Submit Successfully", "application_no" => $request->application_no]);

  }



  //cricketbatsmantrialList
  public function cricketbatsmantrialList(Request $request)
  {
    //  $trialType = 10;
    $validation = Validator::make($request->all(), [

      'grip_stance_backlift_mark' => 'required|numeric|max:7.5',
      'ball_select_mark' => 'required|numeric|max:7.5',

      'front_foot_back_foot_mark' => 'required|numeric|max:7.5',

      'front_foot_back_foot_drive_mark' => 'required|numeric|max:7.5',

      'test_score_mark' => 'required|numeric|max:30',
      'game_technique' => 'required|numeric|max:20',
      'sport_test_mark' => 'required|numeric|max:50',
      'total_obtain_mark' => 'required|numeric|max:100',
      'remark' => 'required|max:255',


    ]);

    if ($validation->fails())
      return response()->json(['error' => true, 'msg' => $validation->errors()->first(), "application_no" => $request->application_no]);


    $data = [
      'sport_id' => $request->sport_id,

      'trial_type' => $request->trial_type,
      'application_no' => $request->application_no,
      'applicant_id' => $request->applicant_id,
      'grip_stance_backlift_mark' => $request->grip_stance_backlift_mark,
      'ball_select_mark' => $request->ball_select_mark,
      'front_foot_back_foot_mark' => $request->front_foot_back_foot_mark,
      'front_foot_back_foot_drive_mark' => $request->front_foot_back_foot_drive_mark,

      'test_score_mark' => $request->test_score_mark,
      'game_technique' => $request->game_technique,
      'sport_test_mark' => $request->sport_test_mark,
      'total_obtain_mark' => $request->total_obtain_mark,
      'remark' => $request->remark,
      'addedby' => Auth::guard('admin')->user()->id,
      'date' => date("Y-m-d H:i:s")

    ];

    $id = DB::table('online_admission_cricket_batsman_trial')->insertGetId($data);

    if ($request->sport_test_mark >= 20 && $request->total_obtain_mark - $request->sport_test_mark >= 20 && $request->trial_type == 1) {











      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 2,
        'skill_trial_one_marks' => $request->sport_test_mark

      ]);


    } elseif (($request->sport_test_mark < 20 || $request->total_obtain_mark - $request->sport_test_mark < 20) && $request->trial_type == 1) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 4,
        'final_status' => 3,
        'skill_trial_one_marks' => $request->sport_test_mark

      ]);
    }

    if ($request->sport_test_mark >= 20 && $request->total_obtain_mark - $request->sport_test_mark >= 20 && $request->trial_type == 2) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark
      ]);
    } elseif (($request->sport_test_mark < 20 || $request->total_obtain_mark - $request->sport_test_mark < 20) && $request->trial_type == 2) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 5,
        'final_status' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark
      ]);
    }


    return response()->json(["error" => false, "msg" => "Sport Trial Data Submit Successfully", "application_no" => $request->application_no]);
  }
  //cricketballertrialList

  public function cricketballertrialList(Request $request)
  {
    // $trialType = 11;


    $validation = Validator::make($request->all(), [

      'runup_action_followthrough_mark' => 'required|numeric|max:7.5',
      'swing_spin_mark' => 'required|numeric|max:7.5',

      'line_length_mark' => 'required|numeric|max:7.5',

      'speed_flight_mark' => 'required|numeric|max:7.5',

      'test_score_mark' => 'required|numeric|max:30',
      'game_technique' => 'required|numeric|max:20',
      'sport_test_mark' => 'required|numeric|max:50',
      'total_obtain_mark' => 'required|numeric|max:100',
      'remark' => 'required|max:255',


    ]);

    if ($validation->fails())
      return response()->json(['error' => true, 'msg' => $validation->errors()->first(), "application_no" => $request->application_no]);


    $data = [
      'trial_type' => $request->trial_type,
      'sport_id' => $request->sport_id,
      'application_no' => $request->application_no,
      'applicant_id' => $request->applicant_id,
      'runup_action_followthrough_mark' => $request->runup_action_followthrough_mark,
      'swing_spin_mark' => $request->swing_spin_mark,
      'line_length_mark' => $request->line_length_mark,
      'speed_flight_mark' => $request->speed_flight_mark,
      'test_score_mark' => $request->test_score_mark,
      'game_technique' => $request->game_technique,
      'sport_test_mark' => $request->sport_test_mark,
      'total_obtain_mark' => $request->total_obtain_mark,
      'remark' => $request->remark,
      'addedby' => Auth::guard('admin')->user()->id,
      'date' => date("Y-m-d H:i:s")

    ];

    $id = DB::table('online_admission_cricket_bowler_trial')->insertGetId($data);

    if ($request->sport_test_mark >= 20 && $request->total_obtain_mark - $request->sport_test_mark >= 20 && $request->trial_type == 1) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 2,
        'skill_trial_one_marks' => $request->sport_test_mark

      ]);
    } elseif (($request->sport_test_mark < 20 || $request->total_obtain_mark - $request->sport_test_mark < 20) && $request->trial_type == 1) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 4,
        'final_status' => 3,
        'skill_trial_one_marks' => $request->sport_test_mark

      ]);
    }

    if ($request->sport_test_mark >= 20 && $request->total_obtain_mark - $request->sport_test_mark >= 20 && $request->trial_type == 2) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark
      ]);
    } elseif (($request->sport_test_mark < 20 || $request->total_obtain_mark - $request->sport_test_mark < 20) && $request->trial_type == 2) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 5,
        'final_status' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark
      ]);
    }


    return response()->json(["error" => false, "msg" => "Sport Trial Data Submit Successfully", "application_no" => $request->application_no]);
  }


  //cricketkeepertrialList

  public function cricketkeepertrialList(Request $request)
  {
    //  $trialType = 12;

    $validation = Validator::make($request->all(), [

      'stumping_mark' => 'required|numeric|max:7.5',
      'gathering_mark' => 'required|numeric|max:7.5',

      'off_stumping_gathering_mark' => 'required|numeric|max:7.5',

      'on_stumping_gathering_mark' => 'required|numeric|max:7.5',

      'test_score_mark' => 'required|numeric|max:30',
      'game_technique' => 'required|numeric|max:20',
      'sport_test_mark' => 'required|numeric|max:50',
      'total_obtain_mark' => 'required|numeric|max:100',
      'remark' => 'required|max:255',


    ]);

    if ($validation->fails())
      return response()->json(['error' => true, 'msg' => $validation->errors()->first(), "application_no" => $request->application_no]);


    $data = [
      'trial_type' => $request->trial_type,
      'sport_id' => $request->sport_id,
      'application_no' => $request->application_no,
      'applicant_id' => $request->applicant_id,
      'stumping_mark' => $request->stumping_mark,
      'gathering_mark' => $request->gathering_mark,
      'off_stumping_gathering_mark' => $request->off_stumping_gathering_mark,
      'on_stumping_gathering_mark' => $request->on_stumping_gathering_mark,
      'test_score_mark' => $request->test_score_mark,
      'game_technique' => $request->game_technique,
      'sport_test_mark' => $request->sport_test_mark,
      'total_obtain_mark' => $request->total_obtain_mark,
      'remark' => $request->remark,
      'addedby' => Auth::guard('admin')->user()->id,
      'date' => date("Y-m-d H:i:s")

    ];

    $id = DB::table('online_admission_cricket_wicket_keeper_trial')->insertGetId($data);


    if ($request->sport_test_mark >= 20 && $request->total_obtain_mark - $request->sport_test_mark >= 20 && $request->trial_type == 1) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 2,
        'skill_trial_one_marks' => $request->sport_test_mark

      ]);
    } elseif (($request->sport_test_mark < 20 || $request->total_obtain_mark - $request->sport_test_mark < 20) && $request->trial_type == 1) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 4,
        'final_status' => 3,
        'skill_trial_one_marks' => $request->sport_test_mark

      ]);
    }

    if ($request->sport_test_mark >= 20 && $request->total_obtain_mark - $request->sport_test_mark >= 20 && $request->trial_type == 2) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark
      ]);
    } elseif (($request->sport_test_mark < 20 || $request->total_obtain_mark - $request->sport_test_mark < 20) && $request->trial_type == 2) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 5,
        'final_status' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark
      ]);
    }


    return response()->json(["error" => false, "msg" => "Sport Trial Data Submit Successfully", "application_no" => $request->application_no]);
  }





  //   //judotrialList
//   public function judotrialList()
//   {

  //     $trialType = 14;
//        $sports = DB::table('sport_type')->where('status', 1)->orderBy('name', 'asc')->get();
//     return view('collegeadmin.trialListApplicant',compact('trialType', 'sports'));
//   }




  //     //gymnasticboystrialList
  public function gymnasticboystrialList(Request $request)
  {
    $validation = Validator::make($request->all(), [

      'floor_exercise_mark' => 'required|numeric|max:5',
      'pommel_horse_mark' => 'required|numeric|max:5',

      'ring_mark' => 'required|numeric|max:5',

      'vaulving_horse_mark' => 'required|numeric|max:5',
      'parallel_bar_mark' => 'required|numeric|max:5',

      'horizontal_bar_mark' => 'required|numeric|max:5',

      'test_score_mark' => 'required|numeric|max:30',
      'game_technique' => 'required|numeric|max:20',
      'sport_test_mark' => 'required|numeric|max:50',
      'total_obtain_mark' => 'required|numeric|max:100',
      'remark' => 'required|max:255',


    ]);

    if ($validation->fails())
      return response()->json(['error' => true, 'msg' => $validation->errors()->first(), "application_no" => $request->application_no]);


    $data = [
      'trial_type' => $request->trial_type,
      'sport_id' => $request->sport_id,
      'application_no' => $request->application_no,
      'applicant_id' => $request->applicant_id,
      'floor_exercise_mark' => $request->floor_exercise_mark,
      'pommel_horse_mark' => $request->pommel_horse_mark,
      'ring_mark' => $request->ring_mark,
      'vaulving_horse_mark' => $request->vaulving_horse_mark,
      'parallel_bar_mark' => $request->parallel_bar_mark,
      'horizontal_bar_mark' => $request->horizontal_bar_mark,
      'test_score_mark' => $request->test_score_mark,
      'game_technique' => $request->game_technique,
      'sport_test_mark' => $request->sport_test_mark,
      'total_obtain_mark' => $request->total_obtain_mark,
      'remark' => $request->remark,
      'addedby' => Auth::guard('admin')->user()->id,
      'date' => date("Y-m-d H:i:s")

    ];

    $id = DB::table('online_admission_gymnastic_boy_trial')->insertGetId($data);


    if ($request->sport_test_mark >= 20 && $request->total_obtain_mark - $request->sport_test_mark >= 20 && $request->trial_type == 1) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 2,
        'skill_trial_one_marks' => $request->sport_test_mark

      ]);
    } elseif (($request->sport_test_mark < 20 || $request->total_obtain_mark - $request->sport_test_mark < 20) && $request->trial_type == 1) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 4,
        'final_status' => 3,
        'skill_trial_one_marks' => $request->sport_test_mark

      ]);
    }

    if ($request->sport_test_mark >= 20 && $request->total_obtain_mark - $request->sport_test_mark >= 20 && $request->trial_type == 2) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark
      ]);
    } elseif (($request->sport_test_mark < 20 || $request->total_obtain_mark - $request->sport_test_mark < 20) && $request->trial_type == 2) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 5,
        'final_status' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark
      ]);
    }

    return response()->json(["error" => false, "msg" => "Sport Trial Data Submit Successfully", "application_no" => $request->application_no]);

  }
  //gymnasticgirlstrialList
  public function gymnasticgirlstrialList(Request $request)
  {
    $validation = Validator::make($request->all(), [

      'balancing_beam_mark' => 'required|numeric|max:7.5',
      'uneven_bar_mark' => 'required|numeric|max:7.5',

      'floor_exercise_mark' => 'required|numeric|max:7.5',

      'vaulving_horse_mark' => 'required|numeric|max:7.5',

      'test_score_mark' => 'required|numeric|max:30',
      'game_technique' => 'required|numeric|max:20',
      'sport_test_mark' => 'required|numeric|max:50',
      'total_obtain_mark' => 'required|numeric|max:100',
      'remark' => 'required|max:255',


    ]);

    if ($validation->fails())
      return response()->json(['error' => true, 'msg' => $validation->errors()->first(), "application_no" => $request->application_no]);


    $data = [
      'trial_type' => $request->trial_type,
      'sport_id' => $request->sport_id,
      'application_no' => $request->application_no,
      'applicant_id' => $request->applicant_id,
      'balancing_beam_mark' => $request->balancing_beam_mark,
      'uneven_bar_mark' => $request->uneven_bar_mark,
      'floor_exercise_mark' => $request->floor_exercise_mark,
      'vaulving_horse_mark' => $request->vaulving_horse_mark,
      'test_score_mark' => $request->test_score_mark,
      'game_technique' => $request->game_technique,
      'sport_test_mark' => $request->sport_test_mark,
      'total_obtain_mark' => $request->total_obtain_mark,
      'remark' => $request->remark,
      'addedby' => Auth::guard('admin')->user()->id,
      'date' => date("Y-m-d H:i:s")

    ];

    $id = DB::table('online_admission_gymnastic_girl_trial')->insertGetId($data);

    if ($request->sport_test_mark >= 20 && $request->total_obtain_mark - $request->sport_test_mark >= 20 && $request->trial_type == 1) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 2,
        'skill_trial_one_marks' => $request->sport_test_mark

      ]);
    } elseif (($request->sport_test_mark < 20 || $request->total_obtain_mark - $request->sport_test_mark < 20) && $request->trial_type == 1) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 4,
        'final_status' => 3,
        'skill_trial_one_marks' => $request->sport_test_mark

      ]);
    }

    if ($request->sport_test_mark >= 20 && $request->total_obtain_mark - $request->sport_test_mark >= 20 && $request->trial_type == 2) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark
      ]);
    } elseif (($request->sport_test_mark < 20 || $request->total_obtain_mark - $request->sport_test_mark < 20) && $request->trial_type == 2) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([
        'trial_type' => 5,
        'final_status' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark
      ]);
    }

    return response()->json(["error" => false, "msg" => "Sport Trial Data Submit Successfully", "application_no" => $request->application_no]);

  }

  public function trialList()
  {
    $trialType = 18;

    $sports = DB::table('sport_onlineadmission')->where('status', 1)->orderBy('name', 'asc')->get();
    $division = DB::table('hostel_division_master')->orderBy('division_name', 'asc')->get();
    $trial_venue = DB::table('cities')->groupBy('trial_location')->get();

    return view('collegeadmin.trialListApplicant', compact('trialType', 'sports', 'division'));
  }

  public function trialListtwo()
  {
    $trialType = 18;
    $division = DB::table('hostel_division_master')->orderBy('division_name', 'asc')->get();

    ;
    $sports = DB::table('sport_onlineadmission')->where('status', 1)->orderBy('name', 'asc')->get();
    return view('collegeadmin.trialListTwoApplicant', compact('trialType', 'sports', 'division'));
  }


  public function get_subsport(Request $req)
  {
    $id = $req->sport;
    $all_sport = DB::table('sub_sport_type')->where('sport_id', $id)->get();

    $gender = "";


    if ($id == 6 || $id == 10 || $id == 43 || $id == 25) {
      $gender = 3;
    } elseif ($id == 4 || $id == 3 || $id == 42 || $id == 8 || $id == 9) {
      $gender = 1;
    } elseif ($id == 7) {
      $gender = 2;

    } elseif ($id == 5) {
      $gender = 4;

    }




    return response()->json(["sub_type" => $all_sport, "gender" => $gender]);

  }


  //filter trial List


  public function filtertrialList(Request $request)
  {

    if ($request->sport) {
      $sport = strtolower(sport_name($request->sport));
    } else {
      $sport = '';
    }
    if ($request->subsport) {
      $subsport = strtolower(get_subSportName($request->subsport));
    } else {
      $subsport = '';
    }

    $division = DB::table('hostel_division_master');




















    $division = $division->orderBy('division_name', 'asc')->get();

    $filtsubSport = $request->subsport;

    $trial_venue = DB::table('cities')->where('state_id', 23)->groupBy('trial_location')->get();


    $filterData = [
      'sport_id' => $request->sport,
      'subSport' => $request->subsport,
      'gender' => $request->gender,
      'division_id' => $request->division_id
    ];

    $subSport = $request->subsport;





    $gender = $request->gender;

    $sports = DB::table('sport_onlineadmission')->where('status', 1);

    //  if(Auth::guard('admin')->user()->id==40 ){
    //      $sports->whereIn('id',[25,5,7]);
    //  } ;


    //  if(Auth::guard('admin')->user()->id==41 ){
    //      $sports->whereIn('id',[8,9]);
    //  } ;

    $sports = $sports->orderBy('name', 'asc')->get();

    if ($request->sport == 6 && $request->subsport == 20 && $gender == 3) {
      $trialType = 2;

      $applicants1 = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('sub_sport_type', 'basic.sub_sport_type', '=', 'sub_sport_type.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')

        ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')

        ->where('rg.payment_status', 1)
        ->where('rg.final_status', 2)
        ->where('basic.sub_sport_type', $request->subsport)
      ;
      if ($request->division_id && $request->division_id != null) {
        $applicants1->where('hostel_division_master.id', $request->division_id);
      }











      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants1->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants1->where('cities.trial_location', $request->trial_location);
      }


      if ($request->gender_result && $request->gender_result != null) {
        $applicants1->where('basic.gender', $request->gender_result);
      }


      if ($request->trial_result && $request->trial_result != null) {
        $applicants1->where('rg.trial_type', $request->trial_result);
      }



      $applicants1->where('rg.session_year', config('app.session_year'))->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'hostel_division_master.id', 'cities.trial_location', 'basic.admission_seeking')->groupBy('rg.application_no')
      ;


      $applicants = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('sub_sport_type', 'basic.sub_sport_type', '=', 'sub_sport_type.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')

        ->where('rg.payment_status', 1)
        ->whereIn('rg.trial_type', [3, 4, 5])


        ->where('basic.sub_sport_type', $request->subsport)

        ->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'hostel_division_master.id', 'cities.trial_location', 'basic.admission_seeking')
        ->union($applicants1)
      ;
      if ($request->division_id && $request->division_id != null) {


        $applicants->where('hostel_division_master.id', $request->division_id);
      }















      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants->where('cities.trial_location', $request->trial_location);
      }


      if ($request->gender_result && $request->gender_result != null) {
        $applicants->where('basic.gender', $request->gender_result);
      }


      $applicants = $applicants->where('rg.session_year', config('app.session_year'))->groupBy('rg.application_no')->get();


    } elseif ($request->sport == 6 && $request->subsport == 21 && $gender == 3) {
      $trialType = 1;



      $applicants1 = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('sub_sport_type', 'basic.sub_sport_type', '=', 'sub_sport_type.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')

        ->where('rg.final_status', 2)

        ->where('basic.sub_sport_type', $request->subsport)
      ;
      if ($request->division_id && $request->division_id != null) {
        $applicants1->where('hostel_division_master.id', $request->division_id);
      }










      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants1->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants1->where('cities.trial_location', $request->trial_location);
      }

      if ($request->trial_result && $request->trial_result != null) {
        $applicants1->where('rg.trial_type', $request->trial_result);
      }
      if ($request->gender_result && $request->gender_result != null) {
        $applicants1->where('basic.gender', $request->gender_result);
      }
      $abc = 0;




      $applicants1->where('rg.session_year', config('app.session_year'))->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'hostel_division_master.id', 'cities.trial_location', 'basic.admission_seeking')->groupBy('rg.application_no')
      ; # code...

      $applicants = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('sub_sport_type', 'basic.sub_sport_type', '=', 'sub_sport_type.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')

        ->where('rg.payment_status', 1)
        ->whereIn('rg.trial_type', [3, 4, 5])

        ->where('basic.sub_sport_type', $request->subsport)


        ->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'hostel_division_master.id', 'cities.trial_location', 'basic.admission_seeking')
        ->union($applicants1);

      ;
      if ($request->division_id && $request->division_id != null) {


        $applicants->where('hostel_division_master.id', $request->division_id);
      }

      if (Auth::guard('admin')->user()->admin_role == 19) {




      }


      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants->where('cities.trial_location', $request->trial_location);
      }
      if ($request->gender_result && $request->gender_result != null) {
        $applicants->where('basic.gender', $request->gender_result);
      }
      if ($request->trial_result && $request->trial_result != null) {
        $applicants->where('rg.trial_type', $request->trial_result);
      }

      $abc = 0;


      $applicants = $applicants->where('rg.session_year', config('app.session_year'))->groupBy('rg.application_no')->get();
    } elseif ($request->sport == 43 && $subsport == '' && $gender == 3) {
      $trialType = 3;



      $applicants1 = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')

        ->where('rg.payment_status', 1)
        ->where('rg.final_status', 2)
        ->where('basic.sport_type', $request->sport)
      ;
      if ($request->division_id && $request->division_id != null) {
        $applicants1->where('hostel_division_master.id', $request->division_id);
      }








      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants1->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants1->where('cities.trial_location', $request->trial_location);
      }
      if ($request->trial_result && $request->trial_result != null) {
        $applicants1->where('rg.trial_type', $request->trial_result);
      }
      if ($request->gender_result && $request->gender_result != null) {
        $applicants1->where('basic.gender', $request->gender_result);
      }

      $abc = 0;



      $applicants1->where('rg.session_year', config('app.session_year'))->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'hostel_division_master.id', 'cities.trial_location', 'basic.admission_seeking')->groupBy('rg.application_no')

      ;   # code...

      $applicants = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')

        ->where('rg.payment_status', 1)
        ->whereIn('rg.trial_type', [3, 4, 5])
        ->where('basic.sport_type', $request->sport)
        ->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'hostel_division_master.id', 'cities.trial_location', 'basic.admission_seeking')
        ->union($applicants1)


      ;
      if ($request->division_id && $request->division_id != null) {


        $applicants->where('hostel_division_master.id', $request->division_id);
      }






      if (Auth::guard('admin')->user()->admin_role == 19) {




      }
      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants->where('cities.trial_location', $request->trial_location);
      }
      if ($request->gender_result && $request->gender_result != null) {
        $applicants->where('basic.gender', $request->gender_result);
      }
      if ($request->trial_result && $request->trial_result != null) {
        $applicants->where('rg.trial_type', $request->trial_result);
      }
      $abc = 0;


      $applicants = $applicants->where('rg.session_year', config('app.session_year'))->groupBy('rg.application_no')->get();


    } elseif ($request->sport == 10 && $subsport == '' && $gender == 3) {
      $trialType = 4;




      $applicants1 = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')

        ->where('rg.payment_status', 1)
        ->where('rg.final_status', 2)
        ->where('basic.sport_type', $request->sport)
      ;
      if ($request->division_id && $request->division_id != null) {
        $applicants1->where('hostel_division_master.id', $request->division_id);
      }
















      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants1->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants1->where('cities.trial_location', $request->trial_location);
      }
      if ($request->trial_result && $request->trial_result != null) {
        $applicants1->where('rg.trial_type', $request->trial_result);
      }

      if ($request->gender_result && $request->gender_result != null) {
        $applicants1->where('basic.gender', $request->gender_result);
      }
      $abc = 0;




      $applicants1->where('rg.session_year', config('app.session_year'))->select('rg.application_no', 'rg.enroll_no', 'basic.height', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'hostel_division_master.id', 'cities.trial_location', 'basic.admission_seeking')->groupBy('rg.application_no')
      ;

      $applicants = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')

        ->where('rg.payment_status', 1)
        ->whereIn('rg.trial_type', [3, 4, 5])
        ->where('basic.sport_type', $request->sport)
        ->select('rg.application_no', 'rg.enroll_no', 'basic.height', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'hostel_division_master.id', 'cities.trial_location', 'basic.admission_seeking')
        ->union($applicants1)
      ;
      if ($request->division_id && $request->division_id != null) {


        $applicants->where('hostel_division_master.id', $request->division_id);
      }



      if (Auth::guard('admin')->user()->admin_role == 19) {




      }







      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants->where('cities.trial_location', $request->trial_location);
      }
      if ($request->gender_result && $request->gender_result != null) {
        $applicants->where('basic.gender', $request->gender_result);
      }

      if ($request->trial_result && $request->trial_result != null) {
        $applicants->where('rg.trial_type', $request->trial_result);
      }
      $abc = 0;





      $applicants = $applicants->where('rg.session_year', config('app.session_year'))->groupBy('rg.application_no')->get();

      # code...
    } elseif ($request->sport == 9 && $subsport == '' && $gender == 1) {
      $trialType = 6;



      $applicants1 = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')

        ->where('rg.final_status', 2)
        ->where('basic.sport_type', $request->sport)
      ;
      $abc = 0;
      if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 6 || Auth::guard('admin')->user()->admin_role == 19) {
        $abc = 1;
      }



      if (Auth::guard('admin')->user()->admin_role == 19) {


        if (Auth::guard('admin')->user()->id == 143) {
          $applicants1->whereIn('hostel_div_district_mapping.division_id', [25, 28, 30]);

        } elseif (Auth::guard('admin')->user()->id == 144) {
          $applicants1->whereIn('hostel_div_district_mapping.division_id', [26, 31]);
        } elseif (Auth::guard('admin')->user()->id == 145) {
          $applicants1->whereIn('hostel_div_district_mapping.division_id', [36, 40]);
        } elseif (Auth::guard('admin')->user()->id == 146) {
          $applicants1->whereIn('hostel_div_district_mapping.division_id', [29, 38]);
        } elseif (Auth::guard('admin')->user()->id == 147) {
          $applicants1->whereIn('hostel_div_district_mapping.division_id', [18, 24, 32]);
        } elseif (Auth::guard('admin')->user()->id == 148) {
          $applicants1->whereIn('hostel_div_district_mapping.division_id', [27, 37]);
        } elseif (Auth::guard('admin')->user()->id == 149) {
          $applicants1->whereIn('hostel_div_district_mapping.division_id', [35, 39]);
        } elseif (Auth::guard('admin')->user()->id == 150) {
          $applicants1->whereIn('hostel_div_district_mapping.division_id', [33, 34]);
        }


      }






      if ($request->gender_result && $request->gender_result != null) {
        $applicants1->where('basic.gender', $request->gender_result);
      }
      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants1->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants1->where('cities.trial_location', $request->trial_location);
      }

      if ($request->division_id && $request->division_id != null) {
        $applicants1->where('hostel_division_master.id', $request->division_id);
      }
      if ($request->trial_result && $request->trial_result != null) {
        $applicants1->where('rg.trial_type', $request->trial_result);
      }

      $applicants1->where('rg.session_year', config('app.session_year'))->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'hostel_division_master.id', 'cities.trial_location', 'basic.admission_seeking')->groupBy('rg.application_no')
      ;   # code...


      $applicants = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')

        ->where('rg.payment_status', 1)
        ->whereIn('rg.trial_type', [3, 4, 5])
        ->where('basic.sport_type', $request->sport)
        ->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'hostel_division_master.id', 'cities.trial_location', 'basic.admission_seeking')
        ->union($applicants1)
      ;
      if ($request->division_id && $request->division_id != null) {


        $applicants->where('hostel_division_master.id', $request->division_id);
      }








      if (Auth::guard('admin')->user()->admin_role == 19) {




      }
      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants->where('cities.trial_location', $request->trial_location);
      }
      if ($request->trial_result && $request->trial_result != null) {
        $applicants->where('rg.trial_type', $request->trial_result);
      }
      if ($request->gender_result && $request->gender_result != null) {
        $applicants->where('basic.gender', $request->gender_result);
      }
      $abc = 0;


      $applicants = $applicants->where('rg.session_year', config('app.session_year'))->groupBy('rg.application_no')->get();
    } elseif ($request->sport == 4 && $request->subsport == 22 && $gender == 1) {
      $trialType = 7;

      $applicants1 = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('sub_sport_type', 'basic.sub_sport_type', '=', 'sub_sport_type.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftJoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftJoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
        ->where('rg.payment_status', 1)
        ->where('rg.final_status', 2)
        ->where('basic.sub_sport_type', $request->subsport);

      if ($request->division_id && $request->division_id != null) {
        $applicants1->where('hostel_division_master.id', $request->division_id);
      }


      if (Auth::guard('admin')->user()->admin_role == 19) {


        if (Auth::guard('admin')->user()->id == 143) {
          $applicants1->whereIn('hostel_div_district_mapping.division_id', [25, 28, 30]);

        } elseif (Auth::guard('admin')->user()->id == 144) {
          $applicants1->whereIn('hostel_div_district_mapping.division_id', [26, 31]);
        } elseif (Auth::guard('admin')->user()->id == 145) {
          $applicants1->whereIn('hostel_div_district_mapping.division_id', [36, 40]);
        } elseif (Auth::guard('admin')->user()->id == 146) {
          $applicants1->whereIn('hostel_div_district_mapping.division_id', [29, 38]);
        } elseif (Auth::guard('admin')->user()->id == 147) {
          $applicants1->whereIn('hostel_div_district_mapping.division_id', [18, 24, 32]);
        } elseif (Auth::guard('admin')->user()->id == 148) {
          $applicants1->whereIn('hostel_div_district_mapping.division_id', [27, 37]);
        } elseif (Auth::guard('admin')->user()->id == 149) {
          $applicants1->whereIn('hostel_div_district_mapping.division_id', [35, 39]);
        } elseif (Auth::guard('admin')->user()->id == 150) {
          $applicants1->whereIn('hostel_div_district_mapping.division_id', [33, 34]);
        }


      }


      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants1->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants1->where('cities.trial_location', $request->trial_location);
      }

      if ($request->trial_result && $request->trial_result != null) {
        $applicants1->where('rg.trial_type', $request->trial_result);
      }

      if ($request->gender_result && $request->gender_result != null) {
        $applicants1->where('basic.gender', $request->gender_result);
      }

      $abc = 0;
      if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 6 || Auth::guard('admin')->user()->admin_role == 19) {
        $abc = 1;
      }

      if ($abc == 0) {
        $applicants1->where('hostel_division_master.id', Auth::guard('admin')->user()->division_id);
      }

      $applicants1->where('rg.session_year', config('app.session_year'))
        ->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'hostel_division_master.id', 'cities.trial_location', 'basic.admission_seeking')
        ->groupBy('rg.application_no');

      $applicants = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('sub_sport_type', 'basic.sub_sport_type', '=', 'sub_sport_type.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftJoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftJoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
        ->where('rg.payment_status', 1)
        ->whereIn('rg.trial_type', [4, 5])
        ->where('basic.sub_sport_type', $request->subsport)
        ->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'hostel_division_master.id', 'cities.trial_location', 'basic.admission_seeking')
        ->union($applicants1);

      if ($request->division_id && $request->division_id != null) {
        $applicants->where('hostel_division_master.id', $request->division_id);
      }





      if (Auth::guard('admin')->user()->admin_role == 19) {


        if (Auth::guard('admin')->user()->id == 143) {
          $applicants->whereIn('hostel_div_district_mapping.division_id', [25, 28, 30]);

        } elseif (Auth::guard('admin')->user()->id == 144) {
          $applicants->whereIn('hostel_div_district_mapping.division_id', [26, 31]);
        } elseif (Auth::guard('admin')->user()->id == 145) {
          $applicants->whereIn('hostel_div_district_mapping.division_id', [36, 40]);
        } elseif (Auth::guard('admin')->user()->id == 146) {
          $applicants->whereIn('hostel_div_district_mapping.division_id', [29, 38]);
        } elseif (Auth::guard('admin')->user()->id == 147) {
          $applicants->whereIn('hostel_div_district_mapping.division_id', [18, 24, 32]);
        } elseif (Auth::guard('admin')->user()->id == 148) {
          $applicants->whereIn('hostel_div_district_mapping.division_id', [27, 37]);
        } elseif (Auth::guard('admin')->user()->id == 149) {
          $applicants->whereIn('hostel_div_district_mapping.division_id', [35, 39]);
        } elseif (Auth::guard('admin')->user()->id == 150) {
          $applicants->whereIn('hostel_div_district_mapping.division_id', [33, 34]);
        }


      }
      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants->where('cities.trial_location', $request->trial_location);
      }

      if ($request->trial_result && $request->trial_result != null) {
        $applicants->where('rg.trial_type', $request->trial_result);
      }

      if ($request->gender_result && $request->gender_result != null) {
        $applicants->where('basic.gender', $request->gender_result);
      }

      $abc = 0;
      if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 6) {
        $abc = 1;
      }

      if ($abc == 0) {
        $applicants->where('hostel_division_master.id', Auth::guard('admin')->user()->division_id);
      }

      $applicants = $applicants->where('rg.session_year', config('app.session_year'))
        ->groupBy('rg.application_no')
        ->get();


    } elseif ($request->sport == 3 && $request->subsport == 24 && $gender == 1) {
      $trialType = 10;



      $applicants1 = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('sub_sport_type', 'basic.sub_sport_type', '=', 'sub_sport_type.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
        ->where('rg.payment_status', 1)

        ->where('rg.final_status', 2)
        ->where('rg.session_year', config('app.session_year'))
        ->where('basic.sub_sport_type', $request->subsport);
      if ($request->division_id && $request->division_id != null) {
        $applicants1->where('hostel_division_master.id', $request->division_id);
      }








      if (Auth::guard('admin')->user()->admin_role == 19) {


        if (Auth::guard('admin')->user()->id == 143) {
          $applicants1->whereIn('hostel_div_district_mapping.division_id', [25, 28, 30]);

        } elseif (Auth::guard('admin')->user()->id == 144) {
          $applicants1->whereIn('hostel_div_district_mapping.division_id', [26, 31]);
        } elseif (Auth::guard('admin')->user()->id == 145) {
          $applicants1->whereIn('hostel_div_district_mapping.division_id', [36, 40]);
        } elseif (Auth::guard('admin')->user()->id == 146) {
          $applicants1->whereIn('hostel_div_district_mapping.division_id', [29, 38]);
        } elseif (Auth::guard('admin')->user()->id == 147) {
          $applicants1->whereIn('hostel_div_district_mapping.division_id', [18, 24, 32]);
        } elseif (Auth::guard('admin')->user()->id == 148) {
          $applicants1->whereIn('hostel_div_district_mapping.division_id', [27, 37]);
        } elseif (Auth::guard('admin')->user()->id == 149) {
          $applicants1->whereIn('hostel_div_district_mapping.division_id', [35, 39]);
        } elseif (Auth::guard('admin')->user()->id == 150) {
          $applicants1->whereIn('hostel_div_district_mapping.division_id', [33, 34]);
        }


      }



      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants1->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants1->where('cities.trial_location', $request->trial_location);
      }

      if ($request->trial_result && $request->trial_result != null) {
        $applicants1->where('rg.trial_type', $request->trial_result);
      }

      if ($request->gender_result && $request->gender_result != null) {
        $applicants1->where('basic.gender', $request->gender_result);
      }
      $abc = 0;
      if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 6 || Auth::guard('admin')->user()->admin_role == 19) {
        $abc = 1;
      }



      $applicants1->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id  as register_id', 'cities.city', 'hostel_division_master.id', 'cities.trial_location', 'basic.admission_seeking')->groupBy('rg.application_no');

      $applicants = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('sub_sport_type', 'basic.sub_sport_type', '=', 'sub_sport_type.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->join('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->join('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
        ->where('rg.payment_status', 1)

        ->whereIn('rg.trial_type', [3, 4, 5])
        ->where('rg.final_status', 3)
        ->where('rg.session_year', config('app.session_year'))
        ->where('basic.sub_sport_type', $request->subsport)
        ->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'hostel_division_master.id', 'cities.trial_location', 'basic.admission_seeking')
        ->union($applicants1);
      //  $applicants->where('hostel_division_master.id', $request->division_id);

      if ($request->division_id && $request->division_id != null) {


        $applicants->where('hostel_division_master.id', $request->division_id);
      }






      if (Auth::guard('admin')->user()->admin_role == 19) {


        if (Auth::guard('admin')->user()->id == 143) {
          $applicants->whereIn('hostel_div_district_mapping.division_id', [25, 28, 30]);

        } elseif (Auth::guard('admin')->user()->id == 144) {
          $applicants->whereIn('hostel_div_district_mapping.division_id', [26, 31]);
        } elseif (Auth::guard('admin')->user()->id == 145) {
          $applicants->whereIn('hostel_div_district_mapping.division_id', [36, 40]);
        } elseif (Auth::guard('admin')->user()->id == 146) {
          $applicants->whereIn('hostel_div_district_mapping.division_id', [29, 38]);
        } elseif (Auth::guard('admin')->user()->id == 147) {
          $applicants->whereIn('hostel_div_district_mapping.division_id', [18, 24, 32]);
        } elseif (Auth::guard('admin')->user()->id == 148) {
          $applicants->whereIn('hostel_div_district_mapping.division_id', [27, 37]);
        } elseif (Auth::guard('admin')->user()->id == 149) {
          $applicants->whereIn('hostel_div_district_mapping.division_id', [35, 39]);
        } elseif (Auth::guard('admin')->user()->id == 150) {
          $applicants->whereIn('hostel_div_district_mapping.division_id', [33, 34]);
        }


      }
      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants->where('cities.trial_location', $request->trial_location);
      }
      if ($request->gender_result && $request->gender_result != null) {
        $applicants->where('basic.gender', $request->gender_result);
      }
      if ($request->trial_result && $request->trial_result != null) {
        $applicants->where('rg.trial_type', $request->trial_result);
      }
      $abc = 0;
      if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 6 || Auth::guard('admin')->user()->admin_role == 19) {
        $abc = 1;
      }

      $applicants = $applicants->groupBy('rg.application_no')->get();






      //trial_type
    } elseif ($request->sport == 3 && $request->subsport == 26 && $gender == 1) {
      $trialType = 12;



      $applicants1 = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('sub_sport_type', 'basic.sub_sport_type', '=', 'sub_sport_type.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')

        ->where('rg.payment_status', 1)
        ->where('rg.final_status', 2)
        ->where('rg.session_year', config('app.session_year'))
        ->where('basic.sub_sport_type', $request->subsport)
      ;
      if ($request->division_id && $request->division_id != null) {
        $applicants1->where('hostel_division_master.id', $request->division_id);
      }





      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants1->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants1->where('cities.trial_location', $request->trial_location);
      }
      if ($request->trial_result && $request->trial_result != null) {
        $applicants1->where('rg.trial_type', $request->trial_result);
      }
      if ($request->gender_result && $request->gender_result != null) {
        $applicants1->where('basic.gender', $request->gender_result);
      }
      $abc = 0;



      $applicants1->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'hostel_division_master.id', 'cities.trial_location', 'basic.admission_seeking')->groupBy('rg.application_no');




      $applicants = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('sub_sport_type', 'basic.sub_sport_type', '=', 'sub_sport_type.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')

        ->where('rg.payment_status', 1)
        ->where('rg.session_year', config('app.session_year'))

        ->where('basic.sub_sport_type', $request->subsport)
        ->whereIn('rg.trial_type', [3, 4, 5])
        ->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'hostel_division_master.id', 'cities.trial_location', 'basic.admission_seeking')
        ->union($applicants1);
      if ($request->division_id && $request->division_id != null) {


        $applicants->where('hostel_division_master.id', $request->division_id);
      }
      if (Auth::guard('admin')->user()->admin_role == 19) {


        if (Auth::guard('admin')->user()->id == 143) {
          $applicants->whereIn('hostel_div_district_mapping.division_id', [25, 28, 30]);

        } elseif (Auth::guard('admin')->user()->id == 144) {
          $applicants->whereIn('hostel_div_district_mapping.division_id', [26, 31]);
        } elseif (Auth::guard('admin')->user()->id == 145) {
          $applicants->whereIn('hostel_div_district_mapping.division_id', [36, 40]);
        } elseif (Auth::guard('admin')->user()->id == 146) {
          $applicants->whereIn('hostel_div_district_mapping.division_id', [29, 38]);
        } elseif (Auth::guard('admin')->user()->id == 147) {
          $applicants->whereIn('hostel_div_district_mapping.division_id', [18, 24, 32]);
        } elseif (Auth::guard('admin')->user()->id == 148) {
          $applicants->whereIn('hostel_div_district_mapping.division_id', [27, 37]);
        } elseif (Auth::guard('admin')->user()->id == 149) {
          $applicants->whereIn('hostel_div_district_mapping.division_id', [35, 39]);
        } elseif (Auth::guard('admin')->user()->id == 150) {
          $applicants->whereIn('hostel_div_district_mapping.division_id', [33, 34]);
        }


      }

      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants->where('cities.trial_location', $request->trial_location);
      }

      if ($request->gender_result && $request->gender_result != null) {
        $applicants->where('basic.gender', $request->gender_result);
      }
      if ($request->trial_result && $request->trial_result != null) {
        $applicants->where('rg.trial_type', $request->trial_result);
      }
      $abc = 0;
      if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 6 || Auth::guard('admin')->user()->admin_role == 19) {
        $abc = 1;
      }
      if ($abc == 0) {
        $applicants->where('hostel_division_master.id', Auth::guard('admin')->user()->division_id);
      }
      $applicants = $applicants->groupBy('rg.application_no')->get();



    } elseif ($request->sport == 3 && $request->subsport == 25 && $gender == 1) {
      $trialType = 11;



      $applicants1 = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('sub_sport_type', 'basic.sub_sport_type', '=', 'sub_sport_type.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
        ->where('rg.session_year', config('app.session_year'))
        ->where('rg.payment_status', 1)
        ->where('rg.final_status', 2)
        ->where('basic.sub_sport_type', $request->subsport)
      ;
      if ($request->division_id && $request->division_id != null) {
        $applicants1->where('hostel_division_master.id', $request->division_id);
      }




      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants1->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants1->where('cities.trial_location', $request->trial_location);
      }

      if ($request->trial_result && $request->trial_result != null) {
        $applicants1->where('rg.trial_type', $request->trial_result);
      }

      if ($request->gender_result && $request->gender_result != null) {
        $applicants1->where('basic.gender', $request->gender_result);
      }
      $abc = 0;




      $applicants1->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'hostel_division_master.id', 'cities.trial_location', 'basic.admission_seeking')->groupBy('rg.application_no')
      ;


      $applicants = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('sub_sport_type', 'basic.sub_sport_type', '=', 'sub_sport_type.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')

        ->where('rg.payment_status', 1)
        ->where('rg.session_year', config('app.session_year'))
        ->where('basic.sub_sport_type', $request->subsport)
        ->whereIn('rg.trial_type', [3, 4, 5])
        ->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'hostel_division_master.id', 'cities.trial_location', 'basic.admission_seeking')
        ->union($applicants1);
      if ($request->division_id && $request->division_id != null) {


        $applicants->where('hostel_division_master.id', $request->division_id);
      }




      if (Auth::guard('admin')->user()->admin_role == 19) {




      }
      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants->where('cities.trial_location', $request->trial_location);
      }
      if ($request->trial_result && $request->trial_result != null) {
        $applicants->where('rg.trial_type', $request->trial_result);
      }

      if ($request->gender_result && $request->gender_result != null) {
        $applicants->where('basic.gender', $request->gender_result);
      }
      $abc = 0;


      $applicants = $applicants->groupBy('rg.application_no')->get();






    } elseif ($request->sport == 42 && $request->subsport == 11 && $gender == 1) {
      $trialType = 9;



      $applicants1 = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('sub_sport_type', 'basic.sub_sport_type', '=', 'sub_sport_type.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
        ->where('rg.session_year', config('app.session_year'))
        ->where('rg.payment_status', 1)
        ->where('rg.final_status', 2)
        ->where('basic.sub_sport_type', $request->subsport)

      ;
      if ($request->division_id && $request->division_id != null) {
        $applicants1->where('hostel_division_master.id', $request->division_id);
      }





      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants1->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants1->where('cities.trial_location', $request->trial_location);
      }
      if ($request->gender_result && $request->gender_result != null) {
        $applicants1->where('basic.gender', $request->gender_result);
      }
      if ($request->trial_result && $request->trial_result != null) {
        $applicants1->where('rg.trial_type', $request->trial_result);
      }

      $abc = 0;





      $applicants1->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'hostel_division_master.id', 'cities.trial_location', 'basic.admission_seeking')->groupBy('rg.application_no')
      ;


      $applicants = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('sub_sport_type', 'basic.sub_sport_type', '=', 'sub_sport_type.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')

        ->where('rg.payment_status', 1)
        ->whereIn('rg.trial_type', [3, 4, 5])
        ->where('basic.sub_sport_type', $request->subsport)
        ->where('rg.session_year', config('app.session_year'))
        ->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'hostel_division_master.id', 'cities.trial_location', 'basic.admission_seeking')
        ->union($applicants1)
      ;
      if ($request->division_id && $request->division_id != null) {


        $applicants->where('hostel_division_master.id', $request->division_id);
      }

      if (Auth::guard('admin')->user()->admin_role == 19) {




      }

      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants->where('cities.trial_location', $request->trial_location);
      }

      if ($request->gender_result && $request->gender_result != null) {
        $applicants->where('basic.gender', $request->gender_result);
      }
      if ($request->trial_result && $request->trial_result != null) {
        $applicants->where('rg.trial_type', $request->trial_result);
      }
      $abc = 0;


      $applicants = $applicants->groupBy('rg.application_no')->get();
    } elseif ($request->sport == 7 && $subsport == '' && $gender == 2) {
      $trialType = 14;



      $applicants1 = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
        ->where('rg.session_year', config('app.session_year'))
        ->where('rg.payment_status', 1)
        ->where('basic.gender', 2)
        ->where('rg.final_status', 2)
        ->where('basic.sport_type', $request->sport)
        ->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'hostel_division_master.id', 'cities.trial_location', 'basic.admission_seeking')->groupBy('rg.application_no')
      ;

      if ($request->division_id && $request->division_id != null) {


        $applicants1->where('hostel_division_master.id', $request->division_id);
      }

      if (Auth::guard('admin')->user()->admin_role == 19) {


        if (Auth::guard('admin')->user()->id == 143) {
          $applicants1->whereIn('hostel_div_district_mapping.division_id', [25, 28, 30]);

        } elseif (Auth::guard('admin')->user()->id == 144) {
          $applicants1->whereIn('hostel_div_district_mapping.division_id', [26, 31]);
        } elseif (Auth::guard('admin')->user()->id == 145) {
          $applicants1->whereIn('hostel_div_district_mapping.division_id', [36, 40]);
        } elseif (Auth::guard('admin')->user()->id == 146) {
          $applicants1->whereIn('hostel_div_district_mapping.division_id', [29, 38]);
        } elseif (Auth::guard('admin')->user()->id == 147) {
          $applicants1->whereIn('hostel_div_district_mapping.division_id', [18, 24, 32]);
        } elseif (Auth::guard('admin')->user()->id == 148) {
          $applicants1->whereIn('hostel_div_district_mapping.division_id', [27, 37]);
        } elseif (Auth::guard('admin')->user()->id == 149) {
          $applicants1->whereIn('hostel_div_district_mapping.division_id', [35, 39]);
        } elseif (Auth::guard('admin')->user()->id == 150) {
          $applicants1->whereIn('hostel_div_district_mapping.division_id', [33, 34]);
        }


      }


      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants1->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants1->where('cities.trial_location', $request->trial_location);
      }

      if ($request->gender_result && $request->gender_result != null) {
        $applicants1->where('basic.gender', $request->gender_result);
      }
      if ($request->trial_result && $request->trial_result != null) {
        $applicants1->where('rg.trial_type', $request->trial_result);
      }
      $abc = 0;
      if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 6 || Auth::guard('admin')->user()->admin_role == 19) {
        $abc = 1;
      }
      if ($abc == 0) {
        $applicants1->where('hostel_division_master.id', Auth::guard('admin')->user()->division_id);
      }


      $applicants = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
        ->where('rg.session_year', config('app.session_year'))
        ->where('rg.payment_status', 1)
        ->where('basic.gender', 2)
        ->whereIn('rg.trial_type', [3, 4, 5])
        ->where('basic.sport_type', $request->sport)
        ->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'hostel_division_master.id', 'cities.trial_location', 'basic.admission_seeking')
        ->union($applicants1)
      ;
      if ($request->division_id && $request->division_id != null) {


        $applicants->where('hostel_division_master.id', $request->division_id);
      }
      if (Auth::guard('admin')->user()->admin_role == 19) {




      }

      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants->where('cities.trial_location', $request->trial_location);
      }
      if ($request->gender_result && $request->gender_result != null) {
        $applicants->where('basic.gender', $request->gender_result);
      }
      if ($request->trial_result && $request->trial_result != null) {
        $applicants->where('rg.trial_type', $request->trial_result);
      }

      if (Auth::guard('admin')->user()->admin_role != 1 || Auth::guard('admin')->user()->admin_role != 6) {

        $applicants->where('hostel_division_master.id', Auth::guard('admin')->user()->division_id);
      }
      $applicants = $applicants->groupBy('rg.application_no')->get();
      # code...
    } elseif ($request->sport == 8 && $subsport == '' && $gender == 1) {
      $trialType = 13;



      $applicants1 = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
        ->where('rg.session_year', config('app.session_year'))
        ->where('rg.payment_status', 1)
        ->where('rg.final_status', 2)
        ->where('basic.sport_type', $request->sport)
      ;
      if ($request->division_id && $request->division_id != null) {
        $applicants1->where('hostel_division_master.id', $request->division_id);
      }




      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants1->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants1->where('cities.trial_location', $request->trial_location);
      }
      if ($request->trial_result && $request->trial_result != null) {
        $applicants1->where('rg.trial_type', $request->trial_result);
      }

      if ($request->gender_result && $request->gender_result != null) {
        $applicants1->where('basic.gender', $request->gender_result);
      }
      $abc = 0;



      $applicants1->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'hostel_division_master.id', 'cities.trial_location', 'basic.admission_seeking')->groupBy('rg.application_no')
      ;


      $applicants = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
        ->where('rg.session_year', config('app.session_year'))
        ->where('rg.payment_status', 1)
        ->whereIn('rg.trial_type', [3, 4, 5])
        ->where('basic.sport_type', $request->sport)
        ->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'hostel_division_master.id', 'cities.trial_location', 'basic.admission_seeking')
        ->union($applicants1)
      ;
      if ($request->division_id && $request->division_id != null) {


        $applicants->where('hostel_division_master.id', $request->division_id);
      }
      if (Auth::guard('admin')->user()->admin_role == 19) {




      }

      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants->where('cities.trial_location', $request->trial_location);
      }

      if ($request->gender_result && $request->gender_result != null) {
        $applicants->where('basic.gender', $request->gender_result);
      }
      if ($request->trial_result && $request->trial_result != null) {
        $applicants->where('rg.trial_type', $request->trial_result);
      }
      $abc = 0;


      $applicants = $applicants->groupBy('rg.application_no')->get();

    } elseif ($request->sport == 25 && $subsport == '' && $gender == 3) {
      $trialType = 5;




      $applicants1 = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
        ->where('rg.session_year', config('app.session_year'))
        ->where('rg.payment_status', 1)
        ->where('rg.final_status', 2)
        ->where('basic.sport_type', $request->sport)
      ;
      if ($request->division_id && $request->division_id != null) {
        $applicants1->where('hostel_division_master.id', $request->division_id);
      }







      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants1->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants1->where('cities.trial_location', $request->trial_location);
      }

      if ($request->gender_result && $request->gender_result != null) {
        $applicants1->where('basic.gender', $request->gender_result);
      }
      $abc = 0;

      if ($abc == 0) {

        $applicants1->where('hostel_division_master.id', Auth::guard('admin')->user()->division_id);
      }


      $applicants1->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'hostel_division_master.id', 'cities.trial_location', 'basic.admission_seeking')->groupBy('rg.application_no')
      ;    # code...


      $applicants = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
        ->where('rg.session_year', config('app.session_year'))
        ->where('rg.payment_status', 1)
        ->whereIn('rg.trial_type', [3, 4, 5])
        ->where('basic.sport_type', $request->sport)
        ->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'hostel_division_master.id', 'cities.trial_location', 'basic.admission_seeking')
        ->union($applicants1)
      ;
      if ($request->division_id && $request->division_id != null) {


        $applicants->where('hostel_division_master.id', $request->division_id);
      }
      if (Auth::guard('admin')->user()->admin_role == 19) {




      }

      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants->where('cities.trial_location', $request->trial_location);
      }
      if ($request->gender_result && $request->gender_result != null) {
        $applicants->where('basic.gender', $request->gender_result);
      }
      if ($request->trial_result && $request->trial_result != null) {
        $applicants->where('rg.trial_type', $request->trial_result);
      }

      $abc = 0;


      $applicants = $applicants->groupBy('rg.application_no')->get();
    } elseif ($request->sport == 42 && $request->subsport == 10 && $gender == 1) {
      $trialType = 15;



      $applicants1 = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('sub_sport_type', 'basic.sub_sport_type', '=', 'sub_sport_type.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
        ->where('rg.session_year', config('app.session_year'))
        ->where('rg.payment_status', 1)
        ->where('rg.final_status', 2)
        ->where('basic.sub_sport_type', $request->subsport)

      ;
      if ($request->division_id && $request->division_id != null) {
        $applicants1->where('hostel_division_master.id', $request->division_id);
      }






      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants1->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants1->where('cities.trial_location', $request->trial_location);
      }
      if ($request->gender_result && $request->gender_result != null) {
        $applicants1->where('basic.gender', $request->gender_result);
      }
      if ($request->trial_result && $request->trial_result != null) {
        $applicants1->where('rg.trial_type', $request->trial_result);
      }
      $abc = 0;




      $applicants1->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'hostel_division_master.id', 'cities.trial_location', 'basic.admission_seeking')->groupBy('rg.application_no')
      ;

      $applicants = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('sub_sport_type', 'basic.sub_sport_type', '=', 'sub_sport_type.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
        ->where('rg.session_year', config('app.session_year'))
        ->where('rg.payment_status', 1)
        ->whereIn('rg.trial_type', [3, 4, 5])
        ->where('basic.sub_sport_type', $request->subsport)

        ->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'hostel_division_master.id', 'cities.trial_location', 'basic.admission_seeking')
        ->union($applicants1)
      ;
      if ($request->division_id && $request->division_id != null) {


        $applicants->where('hostel_division_master.id', $request->division_id);
      }









      if (Auth::guard('admin')->user()->admin_role == 19) {




      }
      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants->where('cities.trial_location', $request->trial_location);
      }
      if ($request->gender_result && $request->gender_result != null) {
        $applicants->where('basic.gender', $request->gender_result);
      }
      if ($request->trial_result && $request->trial_result != null) {
        $applicants->where('rg.trial_type', $request->trial_result);
      }
      $abc = 0;


      $applicants = $applicants->groupBy('rg.application_no')->get();
    } elseif ($request->sport == 42 && $request->subsport == 12 && $gender == 1) {
      $trialType = 19;



      $applicants1 = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('sub_sport_type', 'basic.sub_sport_type', '=', 'sub_sport_type.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
        ->where('rg.session_year', config('app.session_year'))
        ->where('rg.payment_status', 1)
        ->where('rg.final_status', 2)
        ->where('basic.sub_sport_type', $request->subsport)

      ;
      if ($request->division_id && $request->division_id != null) {
        $applicants1->where('hostel_division_master.id', $request->division_id);
      }








      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants1->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants1->where('cities.trial_location', $request->trial_location);
      }
      if ($request->gender_result && $request->gender_result != null) {
        $applicants1->where('basic.gender', $request->gender_result);
      }
      if ($request->trial_result && $request->trial_result != null) {
        $applicants1->where('rg.trial_type', $request->trial_result);
      }
      $abc = 0;



      $applicants1->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id', 'cities.city', 'hostel_division_master.id', 'cities.trial_location', 'basic.admission_seeking')->groupBy('rg.application_no')
      ;

      $applicants = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('sub_sport_type', 'basic.sub_sport_type', '=', 'sub_sport_type.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
        ->where('rg.session_year', config('app.session_year'))
        ->where('rg.payment_status', 1)
        ->whereIn('rg.trial_type', [3, 4, 5])
        ->where('basic.sub_sport_type', $request->subsport)

        ->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'hostel_division_master.id', 'cities.trial_location', 'basic.admission_seeking')
        ->union($applicants1)
      ;
      if ($request->division_id && $request->division_id != null) {


        $applicants->where('hostel_division_master.id', $request->division_id);
      }









      if (Auth::guard('admin')->user()->admin_role == 19) {




      }





      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants->where('cities.trial_location', $request->trial_location);
      }

      if ($request->gender_result && $request->gender_result != null) {
        $applicants->where('basic.gender', $request->gender_result);
      }

      if ($request->trial_result && $request->trial_result != null) {
        $applicants->where('rg.trial_type', $request->trial_result);
      }
      $abc = 0;


      $applicants = $applicants->groupBy('rg.application_no')->get();
    } elseif ($request->sport == 5 && $subsport == '' && $gender == 1) {
      $trialType = 16;



      $applicants1 = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
        ->where('rg.session_year', config('app.session_year'))
        ->where('rg.payment_status', 1)
        ->where('rg.final_status', 2)
        ->where('basic.gender', 1)
        ->where('basic.sport_type', $request->sport)
      ;
      if ($request->division_id && $request->division_id != null) {
        $applicants1->where('hostel_division_master.id', $request->division_id);
      }













      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants1->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants1->where('cities.trial_location', $request->trial_location);
      }
      if ($request->gender_result && $request->gender_result != null) {
        $applicants1->where('basic.gender', $request->gender_result);
      }
      $abc = 0;




      $applicants1->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'hostel_division_master.id', 'cities.trial_location', 'basic.admission_seeking')->groupBy('rg.application_no')
      ;
      # code...

      $applicants = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
        ->where('rg.session_year', config('app.session_year'))
        ->where('rg.payment_status', 1)
        ->whereIn('rg.trial_type', [3, 4, 5])
        ->where('basic.gender', 1)
        ->where('basic.sport_type', $request->sport)
        ->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'hostel_division_master.id', 'cities.trial_location', 'basic.admission_seeking')
        ->union($applicants1)
      ;
      if ($request->division_id && $request->division_id != null) {


        $applicants->where('hostel_division_master.id', $request->division_id);
      }










      if (Auth::guard('admin')->user()->admin_role == 19) {




      }
      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants->where('cities.trial_location', $request->trial_location);
      }
      if ($request->gender_result && $request->gender_result != null) {
        $applicants->where('basic.gender', $request->gender_result);
      }

      if ($request->trial_result && $request->trial_result != null) {
        $applicants->where('rg.trial_type', $request->trial_result);
      }
      $abc = 0;


      $applicants = $applicants->groupBy('rg.application_no')->get();
    } elseif ($request->sport == 5 && $subsport == '' && $gender == 2) {
      $trialType = 17;



      $applicants1 = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
        ->where('rg.session_year', config('app.session_year'))
        ->where('rg.payment_status', 1)
        ->where('rg.final_status', 2)
        ->where('basic.gender', 2)
        ->where('basic.sport_type', $request->sport)
      ;
      if ($request->division_id && $request->division_id != null) {
        $applicants1->where('hostel_division_master.id', $request->division_id);
      }





      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants1->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants1->where('cities.trial_location', $request->trial_location);
      }
      if ($request->gender_result && $request->gender_result != null) {
        $applicants1->where('basic.gender', $request->gender_result);
      }
      $abc = 0;




      $applicants1->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'hostel_division_master.id', 'cities.trial_location', 'basic.admission_seeking')->groupBy('rg.application_no')
      ;

      $applicants = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
        ->where('rg.session_year', config('app.session_year'))
        ->where('rg.payment_status', 1)
        ->whereIn('rg.trial_type', [3, 4, 5])
        ->where('basic.gender', 2)
        ->where('basic.sport_type', $request->sport)
        ->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'hostel_division_master.id', 'cities.trial_location', 'basic.admission_seeking')
        ->union($applicants1)
      ;
      if ($request->division_id && $request->division_id != null) {


        $applicants->where('hostel_division_master.id', $request->division_id);
      }





      if (Auth::guard('admin')->user()->admin_role == 19) {




      }
      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants->where('cities.trial_location', $request->trial_location);
      }
      if ($request->gender_result && $request->gender_result != null) {
        $applicants->where('basic.gender', $request->gender_result);
      }
      if ($request->trial_result && $request->trial_result != null) {
        $applicants->where('rg.trial_type', $request->trial_result);
      }
      $abc = 0;


      $applicants = $applicants->groupBy('rg.application_no')->get();
      # code...
    } elseif ($request->sport == 4 && $request->subsport == 23 && $gender == 1) {
      $trialType = 8;




      $applicants1 = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('sub_sport_type', 'basic.sub_sport_type', '=', 'sub_sport_type.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftJoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftJoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
        ->where('rg.session_year', config('app.session_year'))
        ->where('rg.payment_status', 1)
        ->where('rg.final_status', 2)
        ->where('basic.sub_sport_type', $request->subsport);

      if ($request->division_id) {
        $applicants1->where('hostel_division_master.id', $request->division_id);
      }






      if (Auth::guard('admin')->user()->admin_role == 19) {


        if (Auth::guard('admin')->user()->id == 143) {
          $applicants1->whereIn('hostel_div_district_mapping.division_id', [25, 28, 30]);

        } elseif (Auth::guard('admin')->user()->id == 144) {
          $applicants1->whereIn('hostel_div_district_mapping.division_id', [26, 31]);
        } elseif (Auth::guard('admin')->user()->id == 145) {
          $applicants1->whereIn('hostel_div_district_mapping.division_id', [36, 40]);
        } elseif (Auth::guard('admin')->user()->id == 146) {
          $applicants1->whereIn('hostel_div_district_mapping.division_id', [29, 38]);
        } elseif (Auth::guard('admin')->user()->id == 147) {
          $applicants1->whereIn('hostel_div_district_mapping.division_id', [18, 24, 32]);
        } elseif (Auth::guard('admin')->user()->id == 148) {
          $applicants1->whereIn('hostel_div_district_mapping.division_id', [27, 37]);
        } elseif (Auth::guard('admin')->user()->id == 149) {
          $applicants1->whereIn('hostel_div_district_mapping.division_id', [35, 39]);
        } elseif (Auth::guard('admin')->user()->id == 150) {
          $applicants1->whereIn('hostel_div_district_mapping.division_id', [33, 34]);
        }


      }


      if ($request->admission_seeking) {
        $applicants1->where('basic.admission_seeking', $request->admission_seeking);
      }
      if ($request->trial_location) {
        $applicants1->where('cities.trial_location', $request->trial_location);
      }
      if ($request->trial_result) {
        $applicants1->where('rg.trial_type', $request->trial_result);
      }
      if ($request->gender_result) {
        $applicants1->where('basic.gender', $request->gender_result);
      }

      $abc = 0;
      if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 6 || Auth::guard('admin')->user()->admin_role == 19) {
        $abc = 1;
      }
      if ($abc == 0) {
        $applicants1->where('hostel_division_master.id', Auth::guard('admin')->user()->division_id);
      }

      $applicants1->select(
        'rg.application_no',
        'rg.enroll_no',
        'hostel_division_master.division_name',
        'basic.gender',
        'rg.dob',
        'rg.fullname',
        'rg.id as register_id',
        'cities.city',
        'hostel_division_master.id as division_id',
        'cities.trial_location',
        'basic.admission_seeking'
      )->groupBy('rg.application_no');


      // Second query
      $applicants = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('sub_sport_type', 'basic.sub_sport_type', '=', 'sub_sport_type.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftJoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftJoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
        ->where('rg.session_year', config('app.session_year'))
        ->where('rg.payment_status', 1)
        ->whereIn('rg.trial_type', [3, 4, 5])
        ->where('basic.sub_sport_type', $request->subsport)
        ->select(
          'rg.application_no',
          'rg.enroll_no',
          'hostel_division_master.division_name',
          'basic.gender',
          'rg.dob',
          'rg.fullname',
          'rg.id as register_id',
          'cities.city',
          'hostel_division_master.id',
          'cities.trial_location',
          'basic.admission_seeking'
        )
        ->union($applicants1);

      if ($request->division_id) {
        $applicants->where('hostel_division_master.id', $request->division_id);
      }





      if (Auth::guard('admin')->user()->admin_role == 19) {


        if (Auth::guard('admin')->user()->id == 143) {
          $applicants->whereIn('hostel_div_district_mapping.division_id', [25, 28, 30]);

        } elseif (Auth::guard('admin')->user()->id == 144) {
          $applicants->whereIn('hostel_div_district_mapping.division_id', [26, 31]);
        } elseif (Auth::guard('admin')->user()->id == 145) {
          $applicants->whereIn('hostel_div_district_mapping.division_id', [36, 40]);
        } elseif (Auth::guard('admin')->user()->id == 146) {
          $applicants->whereIn('hostel_div_district_mapping.division_id', [29, 38]);
        } elseif (Auth::guard('admin')->user()->id == 147) {
          $applicants->whereIn('hostel_div_district_mapping.division_id', [18, 24, 32]);
        } elseif (Auth::guard('admin')->user()->id == 148) {
          $applicants->whereIn('hostel_div_district_mapping.division_id', [27, 37]);
        } elseif (Auth::guard('admin')->user()->id == 149) {
          $applicants->whereIn('hostel_div_district_mapping.division_id', [35, 39]);
        } elseif (Auth::guard('admin')->user()->id == 150) {
          $applicants->whereIn('hostel_div_district_mapping.division_id', [33, 34]);
        }


      }
      if ($request->admission_seeking) {
        $applicants->where('basic.admission_seeking', $request->admission_seeking);
      }
      if ($request->trial_location) {
        $applicants->where('cities.trial_location', $request->trial_location);
      }
      if ($request->trial_result) {
        $applicants->where('rg.trial_type', $request->trial_result);
      }
      if ($request->gender_result) {
        $applicants->where('basic.gender', $request->gender_result);
      }
      $abc = 0;
      if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 6) {
        $abc = 1;
      }
      if ($abc == 0) {
        $applicants->where('hostel_division_master.id', Auth::guard('admin')->user()->division_id);
      }

      $applicants = $applicants->groupBy('rg.application_no')->get();




    } else {
      $trialType = 18;



      $applicants = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->where('rg.payment_status', 1)
        ->where('rg.final_status', 2)
        // ->whereIn('rg.trial_type', [1,2,4])
        ->where('basic.sport_type', $request->sport)
        ->select('rg.application_no', 'rg.enroll_no', 'rg.id as register_id', 'rg.dob', 'rg.fullname', 'cities.city', 'cities.trial_location', 'basic.admission_seeking')
        ->get();
    }




    $noteligible = DB::select("select rg.fullname , basic.gender, basic.sport_type , basic.gender , basic.height from `admission_registration_login` as `rg` join `online_admission_basic_details` as `basic` on `rg`.`id` = `basic`.`user_id` where basic.sport_type = 10 AND rg.trial_type = 1 AND ((basic.gender = 1 AND basic.height < 165) OR (basic.gender = 2 AND basic.height < 155))");
    // dd($trial_location);
    return view('collegeadmin.trialListApplicant', compact('trialType', 'sports', 'applicants', 'filterData', 'filtsubSport', 'subSport', 'division', 'noteligible', 'trial_venue'));


  }


  public function trialresultreport()
  {
    $sports = DB::table('sport_onlineadmission')->where('status', 1)->orderBy('name', 'asc')->get();

    $applicants = DB::table('admission_registration_login as rg')
      ->join('online_admission_trial_applicant as trial', 'rg.application_no', '=', 'trial.application_no')
      ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
      ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
      ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')

      ->join('cities', 'communication.p_district', '=', 'cities.id')
      ->where('rg.payment_status', 1)
      ->where('rg.session_year', config('app.session_year'))
      ->select('rg.application_no', 'rg.enroll_no', 'rg.dob', 'rg.fullname', 'rg.id', 'cities.city', 'basic.trial_division', 'trial.*', 'sport_onlineadmission.name')
      ->get();


    return view('collegeadmin.trialresultreport', compact('applicants', 'sports'));
  }

  public function filtertrialresultreport(Request $request)
  {

    $sports = DB::table('sport_onlineadmission')->where('status', 1);
    // 
//     if(Auth::guard('admin')->user()->id==40 ){
//         $sports->whereIn('id',[25,5,7]);
//     } ;
// 
// 
//     if(Auth::guard('admin')->user()->id==41 ){
//         $sports->whereIn('id',[8,9]);
//     } ;

    $sports = $sports->orderBy('name', 'asc')->get();

    $sportId = $request->sport;

    $applicants = DB::table('admission_registration_login as rg')
      ->join('online_admission_trial_applicant as trial', 'rg.application_no', '=', 'trial.application_no')
      ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
      ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
      ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')

      ->join('cities', 'communication.p_district', '=', 'cities.id')
      ->where('rg.payment_status', 1)
      ->where('rg.session_year', config('app.session_year'))
      ->where('sport_onlineadmission.id', $request->sport)
      ->select('rg.application_no', 'rg.enroll_no', 'rg.dob', 'rg.fullname', 'rg.id', 'cities.city', 'basic.trial_division', 'trial.*', 'sport_onlineadmission.name')
      ->get();


    return view('collegeadmin.trialresultreport', compact('applicants', 'sports', 'sportId'));
  }



  public function filtertrialListtwo(Request $request)
  {
    if ($request->sport) {
      $sport = strtolower(sport_name($request->sport));
    } else {
      $sport = '';
    }
    if ($request->subsport) {
      $subsport = strtolower(get_subSportName($request->subsport));
    } else {
      $subsport = '';
    }


    $filtsubSport = $request->subsport;



    $filterData = [
      'sport_id' => $request->sport,
      'subSport' => $request->subsport,
      'gender' => $request->gender,
      'division_id' => $request->division_id
    ];

    $subSport = $request->subsport;





    $gender = $request->gender;

    $sports = DB::table('sport_onlineadmission')->where('status', 1);

    if (Auth::guard('admin')->user()->id == 40) {
      $sports->whereIn('id', [25, 5, 7]);
    }
    ;


    if (Auth::guard('admin')->user()->id == 41) {
      $sports->whereIn('id', [8, 9]);
    }
    ;

    $sports = $sports->orderBy('name', 'asc')->get();
    $division = DB::table('hostel_division_master');



    if (Auth::guard('admin')->user()->admin_role == 19) {


      if (Auth::guard('admin')->user()->id == 143) {
        $division->whereIn('id', [25, 28, 30]);

      } elseif (Auth::guard('admin')->user()->id == 144) {
        $division->whereIn('id', [26, 31]);
      } elseif (Auth::guard('admin')->user()->id == 145) {
        $division->whereIn('id', [36, 40]);
      } elseif (Auth::guard('admin')->user()->id == 146) {
        $division->whereIn('id', [29, 38]);
      } elseif (Auth::guard('admin')->user()->id == 147) {
        $division->whereIn('id', [18, 24, 32]);
      } elseif (Auth::guard('admin')->user()->id == 148) {
        $division->whereIn('id', [27, 37]);
      } elseif (Auth::guard('admin')->user()->id == 149) {
        $division->whereIn('id', [35, 39]);
      } elseif (Auth::guard('admin')->user()->id == 150) {
        $division->whereIn('id', [33, 34]);
      }


    }



    $division = $division->orderBy('division_name', 'asc')->get();


    if ($request->sport == 6 && $request->subsport == 20 && $gender == 3) {
      $trialType = 2;

      $applicants = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('sub_sport_type', 'basic.sub_sport_type', '=', 'sub_sport_type.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
        ->where('rg.session_year', config('app.session_year'))
        ->where('rg.payment_status', 1)
        ->where('basic.sub_sport_type', $request->subsport)
        ->whereIn('rg.trial_type', [2, 3, 5])
        ->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'basic.trial_division', DB::raw('rg.physical_trial_two_marks + rg.skill_trial_two_marks as total'), 'cities.trial_location', 'basic.admission_seeking');
      if ($request->division_id && $request->division_id != null) {


        $applicants->where('hostel_division_master.id', $request->division_id);
      }

      if (Auth::guard('admin')->user()->admin_role == 19) {




      }




      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants->where('cities.trial_location', $request->trial_location);
      }




      if ($request->gender_result && $request->gender_result != null) {
        $applicants->where('basic.gender', $request->gender_result);
      }
      $abc = 0;


      $applicants = $applicants->orderBy('total', 'desc')->orderBy('rg.skill_trial_two_marks', 'desc')->orderBy('rg.dob', 'asc')->get();
    } elseif ($request->sport == 6 && $request->subsport == 21 && $gender == 3) {
      $trialType = 1;



      $applicants = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('sub_sport_type', 'basic.sub_sport_type', '=', 'sub_sport_type.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
        ->where('rg.session_year', config('app.session_year'))
        ->where('rg.payment_status', 1)
        ->where('basic.sub_sport_type', $request->subsport)
        ->whereIn('rg.trial_type', [2, 3, 5])
        ->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'basic.trial_division', DB::raw('rg.physical_trial_two_marks + rg.skill_trial_two_marks as total'), 'cities.trial_location', 'basic.admission_seeking');
      ;
      if ($request->division_id && $request->division_id != null) {


        $applicants->where('hostel_division_master.id', $request->division_id);
      }
      if (Auth::guard('admin')->user()->admin_role == 19) {




      }
      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants->where('cities.trial_location', $request->trial_location);
      }

      if ($request->gender_result && $request->gender_result != null) {
        $applicants->where('basic.gender', $request->gender_result);
      }
      $abc = 0;


      $applicants = $applicants->orderBy('total', 'desc')->orderBy('rg.skill_trial_two_marks', 'desc')->orderBy('rg.dob', 'asc')->get(); # code...
    } elseif ($request->sport == 43 && $subsport == '' && $gender == 3) {
      $trialType = 3;



      $applicants = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
        ->where('rg.session_year', config('app.session_year'))
        ->where('rg.payment_status', 1)
        ->where('basic.sport_type', $request->sport)

        ->whereIn('rg.trial_type', [2, 3, 5])
        ->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'basic.trial_division', DB::raw('rg.physical_trial_two_marks + rg.skill_trial_two_marks as total'), 'cities.trial_location', 'basic.admission_seeking');
      if ($request->division_id && $request->division_id != null) {


        $applicants->where('hostel_division_master.id', $request->division_id);
      }
      if (Auth::guard('admin')->user()->admin_role == 19) {




      }
      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants->where('cities.trial_location', $request->trial_location);
      }

      if ($request->gender_result && $request->gender_result != null) {
        $applicants->where('basic.gender', $request->gender_result);
      }
      $abc = 0;
      if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 6 || Auth::guard('admin')->user()->admin_role == 19) {
        $abc = 1;
      }
      if ($abc == 0) {
        $applicants->where('hostel_division_master.id', Auth::guard('admin')->user()->division_id);
      }
      $applicants = $applicants->orderBy('total', 'desc')->orderBy('rg.skill_trial_two_marks', 'desc')->orderBy('rg.dob', 'asc')->get();  # code...
    } elseif ($request->sport == 10 && $subsport == '' && $gender == 3) {
      $trialType = 4;




      $applicants = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
        ->where('rg.session_year', config('app.session_year'))
        ->where('rg.payment_status', 1)
        ->where('basic.sport_type', $request->sport)
        ->whereIn('rg.trial_type', [2, 3, 5])
        ->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'basic.trial_division', DB::raw('rg.physical_trial_two_marks + rg.skill_trial_two_marks as total'), 'cities.trial_location', 'basic.admission_seeking');
      if ($request->division_id && $request->division_id != null) {


        $applicants->where('hostel_division_master.id', $request->division_id);
      }
      if (Auth::guard('admin')->user()->admin_role == 19) {




      }
      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants->where('cities.trial_location', $request->trial_location);
      }

      if ($request->gender_result && $request->gender_result != null) {
        $applicants->where('basic.gender', $request->gender_result);
      }
      $abc = 0;


      $applicants = $applicants->orderBy('total', 'desc')->orderBy('rg.skill_trial_two_marks', 'desc')->orderBy('rg.dob', 'asc')->get();

      # code...
    } elseif ($request->sport == 9 && $subsport == '' && $gender == 1) {
      $trialType = 6;



      $applicants = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
        ->where('rg.session_year', config('app.session_year'))
        ->where('rg.payment_status', 1)
        ->where('basic.sport_type', $request->sport)
        ->whereIn('rg.trial_type', [2, 3, 5])
        ->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'basic.trial_division', DB::raw('rg.physical_trial_two_marks + rg.skill_trial_two_marks as total'), 'cities.trial_location', 'basic.admission_seeking');
      ;
      if ($request->division_id && $request->division_id != null) {


        $applicants->where('hostel_division_master.id', $request->division_id);
      }
      if (Auth::guard('admin')->user()->admin_role == 19) {




      }
      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants->where('cities.trial_location', $request->trial_location);
      }

      if ($request->gender_result && $request->gender_result != null) {
        $applicants->where('basic.gender', $request->gender_result);
      }

      $abc = 0;


      $applicants = $applicants->orderBy('total', 'desc')->orderBy('rg.skill_trial_two_marks', 'desc')->orderBy('rg.dob', 'asc')->get(); # code...
    } elseif ($request->sport == 4 && $request->subsport == 22 && $gender == 1) {
      $trialType = 7;



      $applicants = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')


        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('sub_sport_type', 'basic.sub_sport_type', '=', 'sub_sport_type.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
        ->where('rg.session_year', config('app.session_year'))
        ->where('rg.payment_status', 1)
        ->whereIn('rg.trial_type', [2, 3, 5])
        ->where('basic.sub_sport_type', $request->subsport)
        ->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'basic.trial_division', DB::raw('rg.physical_trial_two_marks + rg.skill_trial_two_marks as total'), 'cities.trial_location', 'basic.admission_seeking');
      ;
      if ($request->division_id && $request->division_id != null) {


        $applicants->where('hostel_division_master.id', $request->division_id);
      }
      if (Auth::guard('admin')->user()->admin_role == 19) {




      }
      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants->where('cities.trial_location', $request->trial_location);
      }
      if ($request->gender_result && $request->gender_result != null) {
        $applicants->where('basic.gender', $request->gender_result);
      }
      $abc = 0;


      $applicants = $applicants->orderBy('total', 'desc')->orderBy('rg.skill_trial_two_marks', 'desc')->orderBy('rg.dob', 'asc')->get();
    } elseif ($request->sport == 3 && $request->subsport == 24 && $gender == 1) {
      $trialType = 10;



      $applicants = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('sub_sport_type', 'basic.sub_sport_type', '=', 'sub_sport_type.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->join('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->join('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
        ->where('rg.session_year', config('app.session_year'))
        ->where('rg.payment_status', 1)
        ->whereIn('rg.trial_type', [2, 3, 5])
        ->where('basic.sub_sport_type', $request->subsport)

        ->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'basic.trial_division', DB::raw('rg.physical_trial_two_marks + rg.skill_trial_two_marks as total'), 'cities.trial_location', 'basic.admission_seeking');
      if ($request->division_id && $request->division_id != null) {


        $applicants->where('hostel_division_master.id', $request->division_id);
      }
      if (Auth::guard('admin')->user()->admin_role == 19) {




      }
      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants->where('cities.trial_location', $request->trial_location);
      }


      if ($request->gender_result && $request->gender_result != null) {
        $applicants->where('basic.gender', $request->gender_result);
      }

      $abc = 0;
      if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 6 || Auth::guard('admin')->user()->admin_role == 19) {
        $abc = 1;
      }
      if ($abc == 0) {
        $applicants->where('hostel_division_master.id', Auth::guard('admin')->user()->division_id);
      }



      $applicants = $applicants->where(function ($query) {
        $query->where(function ($subQuery) {
          $subQuery->where('basic.admission_seeking', "6th")
            ->where(DB::raw('rg.physical_trial_one_marks + rg.skill_trial_one_marks'), '>=', 48.5);
        })->orWhere(function ($subQuery) {
          $subQuery->where('basic.admission_seeking', "7th")
            ->where(DB::raw('rg.physical_trial_one_marks + rg.skill_trial_one_marks'), '>=', 51);
        });
      });
      $applicants = $applicants->orderBy('total', 'desc')->orderBy('rg.skill_trial_two_marks', 'desc')->orderBy('rg.dob', 'asc')->get();
    } elseif ($request->sport == 3 && $request->subsport == 26 && $gender == 1) {
      $trialType = 12;



      $applicants = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('sub_sport_type', 'basic.sub_sport_type', '=', 'sub_sport_type.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
        ->where('rg.session_year', config('app.session_year'))
        ->where('rg.payment_status', 1)
        ->whereIn('rg.trial_type', [2, 3, 5])
        ->where('basic.sub_sport_type', $request->subsport)

        ->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'basic.trial_division', DB::raw('rg.physical_trial_two_marks + rg.skill_trial_two_marks as total'), 'cities.trial_location', 'basic.admission_seeking');
      if ($request->division_id && $request->division_id != null) {


        $applicants->where('hostel_division_master.id', $request->division_id);
      }
      if (Auth::guard('admin')->user()->admin_role == 19) {




      }
      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants->where('cities.trial_location', $request->trial_location);
      }


      if ($request->gender_result && $request->gender_result != null) {
        $applicants->where('basic.gender', $request->gender_result);
      }
      $abc = 0;
      if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 6 || Auth::guard('admin')->user()->admin_role == 19) {
        $abc = 1;
      }
      if ($abc == 0) {
        $applicants->where('hostel_division_master.id', Auth::guard('admin')->user()->division_id);
      }



      $applicants = $applicants->orderBy('total', 'desc')->orderBy('rg.skill_trial_two_marks', 'desc')->orderBy('rg.dob', 'asc')->get();
    } elseif ($request->sport == 3 && $request->subsport == 25 && $gender == 1) {
      $trialType = 11;



      $applicants = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('sub_sport_type', 'basic.sub_sport_type', '=', 'sub_sport_type.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
        ->where('rg.session_year', config('app.session_year'))
        ->where('rg.payment_status', 1)
        ->whereIn('rg.trial_type', [2, 3, 5])
        ->where('basic.sub_sport_type', $request->subsport)

        ->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'basic.trial_division', DB::raw('rg.physical_trial_two_marks + rg.skill_trial_two_marks as total'), 'cities.trial_location', 'basic.admission_seeking');
      if ($request->division_id && $request->division_id != null) {


        $applicants->where('hostel_division_master.id', $request->division_id);
      }
      if (Auth::guard('admin')->user()->admin_role == 19) {




      }
      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants->where('cities.trial_location', $request->trial_location);
      }
      if ($request->gender_result && $request->gender_result != null) {
        $applicants->where('basic.gender', $request->gender_result);
      }

      $abc = 0;
      if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 6 || Auth::guard('admin')->user()->admin_role == 19) {
        $abc = 1;
      }
      if ($abc == 0) {

        $applicants->where('hostel_division_master.id', Auth::guard('admin')->user()->division_id);
      }



      $applicants = $applicants->where(function ($query) {
        $query->where(function ($subQuery) {
          $subQuery->where('basic.admission_seeking', "6th")
            ->where(DB::raw('rg.physical_trial_one_marks + rg.skill_trial_one_marks'), '>=', 41);
        })->orWhere(function ($subQuery) {
          $subQuery->where('basic.admission_seeking', "7th")
            ->where(DB::raw('rg.physical_trial_one_marks + rg.skill_trial_one_marks'), '>=', 53);
        });
      });
      $applicants = $applicants->orderBy('total', 'desc')->orderBy('rg.skill_trial_two_marks', 'desc')->orderBy('rg.dob', 'asc')->get();
    } elseif ($request->sport == 42 && $request->subsport == 11 && $gender == 1) {
      $trialType = 9;



      $applicants = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('sub_sport_type', 'basic.sub_sport_type', '=', 'sub_sport_type.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
        ->where('rg.session_year', config('app.session_year'))
        ->where('rg.payment_status', 1)
        ->whereIn('rg.trial_type', [2, 3, 5])
        ->where('basic.sub_sport_type', $request->subsport)
        ->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'basic.trial_division', DB::raw('rg.physical_trial_two_marks + rg.skill_trial_two_marks as total'), 'cities.trial_location', 'basic.admission_seeking');
      if ($request->division_id && $request->division_id != null) {


        $applicants->where('hostel_division_master.id', $request->division_id);
      }
      if (Auth::guard('admin')->user()->admin_role == 19) {




      }
      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants->where('cities.trial_location', $request->trial_location);
      }

      if ($request->gender_result && $request->gender_result != null) {
        $applicants->where('basic.gender', $request->gender_result);
      }

      $abc = 0;
      if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 6 || Auth::guard('admin')->user()->admin_role == 19) {
        $abc = 1;
      }
      if ($abc == 0) {
        $applicants->where('hostel_division_master.id', Auth::guard('admin')->user()->division_id);
      }
      $applicants = $applicants->orderBy('total', 'desc')->orderBy('rg.skill_trial_two_marks', 'desc')->orderBy('rg.dob', 'asc')->get();
    } elseif ($request->sport == 42 && $request->subsport == 12 && $gender == 1) {
      $trialType = 19;



      $applicants = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('sub_sport_type', 'basic.sub_sport_type', '=', 'sub_sport_type.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
        ->where('rg.session_year', config('app.session_year'))
        ->where('rg.payment_status', 1)
        ->whereIn('rg.trial_type', [2, 3, 5])
        ->where('basic.sub_sport_type', $request->subsport)

        ->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'basic.trial_division', DB::raw('rg.physical_trial_two_marks + rg.skill_trial_two_marks as total'), 'cities.trial_location', 'basic.admission_seeking');
      if ($request->division_id && $request->division_id != null) {


        $applicants->where('hostel_division_master.id', $request->division_id);
      }
      if (Auth::guard('admin')->user()->admin_role == 19) {


        if (Auth::guard('admin')->user()->id == 143) {
          $applicants->whereIn('hostel_div_district_mapping.division_id', [25, 28, 30]);

        } elseif (Auth::guard('admin')->user()->id == 144) {
          $applicants->whereIn('hostel_div_district_mapping.division_id', [26, 31]);
        } elseif (Auth::guard('admin')->user()->id == 145) {
          $applicants->whereIn('hostel_div_district_mapping.division_id', [36, 40]);
        } elseif (Auth::guard('admin')->user()->id == 146) {
          $applicants->whereIn('hostel_div_district_mapping.division_id', [29, 38]);
        } elseif (Auth::guard('admin')->user()->id == 147) {
          $applicants->whereIn('hostel_div_district_mapping.division_id', [18, 24, 32]);
        } elseif (Auth::guard('admin')->user()->id == 148) {
          $applicants->whereIn('hostel_div_district_mapping.division_id', [27, 37]);
        } elseif (Auth::guard('admin')->user()->id == 149) {
          $applicants->whereIn('hostel_div_district_mapping.division_id', [35, 39]);
        } elseif (Auth::guard('admin')->user()->id == 150) {
          $applicants->whereIn('hostel_div_district_mapping.division_id', [33, 34]);
        }


      }
      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants->where('cities.trial_location', $request->trial_location);
      }

      if ($request->gender_result && $request->gender_result != null) {
        $applicants->where('basic.gender', $request->gender_result);
      }

      $abc = 0;
      if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 6 || Auth::guard('admin')->user()->admin_role == 19) {
        $abc = 1;
      }
      if ($abc == 0) {
        $applicants->where('hostel_division_master.id', Auth::guard('admin')->user()->division_id);
      }
      $applicants = $applicants->orderBy('total', 'desc')->orderBy('rg.skill_trial_two_marks', 'desc')->orderBy('rg.dob', 'asc')->get();
    } elseif ($request->sport == 7 && $subsport == '' && $gender == 2) {
      $trialType = 14;



      $applicants = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
        ->where('rg.session_year', config('app.session_year'))
        ->where('rg.payment_status', 1)
        ->where('basic.gender', 2)
        ->where('basic.sport_type', $request->sport)
        ->whereIn('rg.trial_type', [2, 3, 5])
        ->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'basic.trial_division', DB::raw('rg.physical_trial_two_marks + rg.skill_trial_two_marks as total'), 'cities.trial_location', 'basic.admission_seeking');



      if ($request->division_id && $request->division_id != null) {


        $applicants->where('hostel_division_master.id', $request->division_id);
      }
      if (Auth::guard('admin')->user()->admin_role == 19) {




      }
      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants->where('cities.trial_location', $request->trial_location);
      }
      if ($request->gender_result && $request->gender_result != null) {
        $applicants->where('basic.gender', $request->gender_result);
      }
      $abc = 0;
      if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 6 || Auth::guard('admin')->user()->admin_role == 19) {
        $abc = 1;
      }
      if ($abc == 0) {
        $applicants->where('hostel_division_master.id', Auth::guard('admin')->user()->division_id);
      }
      $applicants = $applicants->orderBy('total', 'desc')->orderBy('rg.skill_trial_two_marks', 'desc')->orderBy('rg.dob', 'asc')->get();
      # code...
    } elseif ($request->sport == 8 && $subsport == '' && $gender == 1) {
      $trialType = 13;



      $applicants = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
        ->where('rg.session_year', config('app.session_year'))
        ->where('rg.payment_status', 1)
        ->where('basic.sport_type', $request->sport)
        ->whereIn('rg.trial_type', [2, 3, 5])
        ->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'basic.trial_division', DB::raw('rg.physical_trial_two_marks + rg.skill_trial_two_marks as total'), 'cities.trial_location', 'basic.admission_seeking');
      if ($request->division_id && $request->division_id != null) {


        $applicants->where('hostel_division_master.id', $request->division_id);
      }
      if (Auth::guard('admin')->user()->admin_role == 19) {




      }
      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants->where('cities.trial_location', $request->trial_location);
      }
      if ($request->gender_result && $request->gender_result != null) {
        $applicants->where('basic.gender', $request->gender_result);
      }

      $abc = 0;
      if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 6 || Auth::guard('admin')->user()->admin_role == 19) {
        $abc = 1;
      }
      if ($abc == 0) {
        $applicants->where('hostel_division_master.id', Auth::guard('admin')->user()->division_id);
      }
      $applicants = $applicants->orderBy('total', 'desc')->orderBy('rg.skill_trial_two_marks', 'desc')->orderBy('rg.dob', 'asc')->get();
      # code...
    } elseif ($request->sport == 25 && $subsport == '' && $gender == 3) {
      $trialType = 5;




      $applicants = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
        ->where('rg.session_year', config('app.session_year'))
        ->where('rg.payment_status', 1)
        ->where('basic.sport_type', $request->sport)
        ->whereIn('rg.trial_type', [2, 3, 5])
        ->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'basic.trial_division', DB::raw('rg.physical_trial_two_marks + rg.skill_trial_two_marks as total'), 'cities.trial_location', 'basic.admission_seeking');
      if ($request->division_id && $request->division_id != null) {


        $applicants->where('hostel_division_master.id', $request->division_id);
      }
      if (Auth::guard('admin')->user()->admin_role == 19) {




      }
      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants->where('cities.trial_location', $request->trial_location);
      }

      if ($request->gender_result && $request->gender_result != null) {
        $applicants->where('basic.gender', $request->gender_result);
      }
      $abc = 0;
      if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 6 || Auth::guard('admin')->user()->admin_role == 19) {
        $abc = 1;
      }
      if ($abc == 0) {
        $applicants->where('hostel_division_master.id', Auth::guard('admin')->user()->division_id);
      }
      $applicants = $applicants->orderBy('total', 'desc')->orderBy('rg.skill_trial_two_marks', 'desc')->orderBy('rg.dob', 'asc')->get();   # code...
    } elseif ($request->sport == 42 && $request->subsport == 10 && $gender == 1) {
      $trialType = 15;



      $applicants = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('sub_sport_type', 'basic.sub_sport_type', '=', 'sub_sport_type.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
        ->where('rg.session_year', config('app.session_year'))
        ->where('rg.payment_status', 1)
        ->where('basic.sub_sport_type', $request->subsport)
        ->whereIn('rg.trial_type', [2, 3, 5])
        ->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'basic.trial_division', DB::raw('rg.physical_trial_two_marks + rg.skill_trial_two_marks as total'), 'cities.trial_location', 'basic.admission_seeking');
      if ($request->division_id && $request->division_id != null) {


        $applicants->where('hostel_division_master.id', $request->division_id);
      }
      if (Auth::guard('admin')->user()->admin_role == 19) {




      }
      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants->where('cities.trial_location', $request->trial_location);
      }
      if ($request->gender_result && $request->gender_result != null) {
        $applicants->where('basic.gender', $request->gender_result);
      }
      $abc = 0;
      if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 6 || Auth::guard('admin')->user()->admin_role == 19) {
        $abc = 1;
      }
      if ($abc == 0) {
        $applicants->where('hostel_division_master.id', Auth::guard('admin')->user()->division_id);
      }
      $applicants = $applicants->orderBy('total', 'desc')->orderBy('rg.skill_trial_two_marks', 'desc')->orderBy('rg.dob', 'asc')->get();
    } elseif ($request->sport == 5 && $subsport == '' && $gender == 1) {
      $trialType = 16;



      $applicants = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
        ->where('rg.session_year', config('app.session_year'))
        ->where('basic.gender', 1)
        ->where('rg.payment_status', 1)
        ->where('basic.sport_type', $request->sport)
        ->whereIn('rg.trial_type', [2, 3, 5])
        ->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'basic.trial_division', DB::raw('rg.physical_trial_two_marks + rg.skill_trial_two_marks as total'), 'cities.trial_location', 'basic.admission_seeking');
      if ($request->division_id && $request->division_id != null) {


        $applicants->where('hostel_division_master.id', $request->division_id);
      }
      if (Auth::guard('admin')->user()->admin_role == 19) {




      }
      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants->where('cities.trial_location', $request->trial_location);
      }

      if ($request->gender_result && $request->gender_result != null) {
        $applicants->where('basic.gender', $request->gender_result);
      }
      $abc = 0;
      if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 6 || Auth::guard('admin')->user()->admin_role == 19) {
        $abc = 1;
      }
      if ($abc == 0) {
        $applicants->where('hostel_division_master.id', Auth::guard('admin')->user()->division_id);
      }
      $applicants = $applicants->orderBy('total', 'desc')->orderBy('rg.skill_trial_two_marks', 'desc')->orderBy('rg.dob', 'asc')->get();
      # code...
    } elseif ($request->sport == 5 && $subsport == '' && $gender == 2) {
      $trialType = 17;



      $applicants = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
        ->where('rg.session_year', config('app.session_year'))
        ->where('basic.gender', 2)
        ->where('rg.payment_status', 1)
        ->where('basic.sport_type', $request->sport)
        ->whereIn('rg.trial_type', [2, 3, 5])
        ->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'basic.trial_division', DB::raw('rg.physical_trial_two_marks + rg.skill_trial_two_marks as total'), 'cities.trial_location', 'basic.admission_seeking');
      if ($request->division_id && $request->division_id != null) {


        $applicants->where('hostel_division_master.id', $request->division_id);
      }
      if (Auth::guard('admin')->user()->admin_role == 19) {




      }
      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants->where('cities.trial_location', $request->trial_location);
      }
      if ($request->gender_result && $request->gender_result != null) {
        $applicants->where('basic.gender', $request->gender_result);
      }
      $abc = 0;
      if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 6 || Auth::guard('admin')->user()->admin_role == 19) {
        $abc = 1;
      }
      if ($abc == 0) {
        $applicants->where('hostel_division_master.id', Auth::guard('admin')->user()->division_id);
      }
      $applicants = $applicants->orderBy('total', 'desc')->orderBy('rg.skill_trial_two_marks', 'desc')->orderBy('rg.dob', 'asc')->get();
      # code...
    } elseif ($request->sport == 4 && $request->subsport == 23 && $gender == 1) {
      $trialType = 8;




      $applicants = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('sub_sport_type', 'basic.sub_sport_type', '=', 'sub_sport_type.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
        ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
        ->where('rg.session_year', config('app.session_year'))
        ->where('rg.payment_status', 1)
        ->where('basic.sub_sport_type', $request->subsport)
        ->whereIn('rg.trial_type', [2, 3, 5])
        ->select('rg.application_no', 'rg.enroll_no', 'hostel_division_master.division_name', 'basic.gender', 'rg.dob', 'rg.fullname', 'rg.id as register_id', 'cities.city', 'basic.trial_division', DB::raw('rg.physical_trial_two_marks + rg.skill_trial_two_marks as total'), 'cities.trial_location', 'basic.admission_seeking');
      if ($request->division_id && $request->division_id != null) {


        $applicants->where('hostel_division_master.id', $request->division_id);
      }
      if (Auth::guard('admin')->user()->admin_role == 19) {




      }
      if ($request->admission_seeking && $request->admission_seeking != null) {
        $applicants->where('basic.admission_seeking', $request->admission_seeking);
      }

      if ($request->trial_location && $request->trial_location != null) {
        $applicants->where('cities.trial_location', $request->trial_location);
      }

      if ($request->gender_result && $request->gender_result != null) {
        $applicants->where('basic.gender', $request->gender_result);
      }

      $abc = 0;

      if ($abc == 0) {

        $applicants->where('hostel_division_master.id', Auth::guard('admin')->user()->division_id);
      }
      $applicants = $applicants->orderBy('total', 'desc')->orderBy('rg.skill_trial_two_marks', 'desc')->orderBy('rg.dob', 'asc')->get();



    } else {
      $trialType = 18;



      $applicants = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
        ->join('cities', 'communication.p_district', '=', 'cities.id')
        ->where('rg.session_year', config('app.session_year'))
        ->where('rg.payment_status', 1)
        ->where('basic.sport_type', $request->sport)
        ->whereIn('rg.trial_type', [2, 3, 5])
        ->select('rg.application_no', 'rg.enroll_no', 'rg.id as register_id', 'rg.dob', 'rg.fullname', 'rg.id', 'cities.city', 'basic.trial_division', DB::raw('rg.physical_trial_one_marks + rg.skill_trial_one_marks as total'), 'cities.trial_location', 'basic.admission_seeking')
        ->get();
    }


    $noteligible = DB::select("select rg.fullname , basic.gender, basic.sport_type , basic.gender , basic.height from `admission_registration_login` as `rg` join `online_admission_basic_details` as `basic` on `rg`.`id` = `basic`.`user_id` where basic.sport_type = 10 AND rg.trial_type = 1 AND ((basic.gender = 1 AND basic.height < 165) OR (basic.gender = 2 AND basic.height < 155))");

    $trial_venue = DB::table('cities')->where('state_id', 23)->groupBy('trial_location')->get();

    return view('collegeadmin.trialListTwoApplicant', compact('trialType', 'sports', 'applicants', 'filterData', 'filtsubSport', 'subSport', 'division', 'noteligible', 'trial_venue'));
  }


  // trialListApplicantStore


  public function trialListApplicantStore(Request $request)
  {


    $validation = Validator::make($request->all(), [
      'hundred_mt_time' => 'required',
      'hundred_mt_mark' => 'required|numeric|max:10',
      'eight_hundred_mt_time' => 'required',
      'eight_hundred_mt_mark' => 'required|numeric|max:10',
      'broad_jump_distance' => 'required',
      'broad_jump_mark' => 'required|numeric|max:10',
      'shuttle_run_time' => 'required',
      'shuttle_run_mark' => 'required|numeric|max:10',
      'ball_throw_distance' => 'required',
      'ball_throw_mark' => 'required|numeric|max:10',
      'physical_total_mark' => 'required|numeric|max:50'
    ], [
      'hundred_mt_time.required' => 'Please Fill the hundred mt time Field',

      'hundred_mt_mark.required' => 'Please Fill the hundred mt marks Field',

      'eight_hundred_mt_time.required' => 'Please Fill the eight hundred mt time Field',
      'eight_hundred_mt_mark.required' => 'Please Fill the eight hundred mt marks Field',
      'broad_jump_distance.required' => 'Please Fill the broad jump distance Field',
      'broad_jump_mark.required' => 'Please Fill the broad jump marks Field',
      'shuttle_run_time.required' => 'Please Fill the shuttle run time Field',
      'shuttle_run_mark.required' => 'Please Fill the shuttle run mark Field',
      'ball_throw_distance.required' => 'Please Fill the ball throw distance Field',
      'ball_throw_mark.required' => 'Please Fill the ball throw marks Field',
      'physical_total_mark.required' => 'Please Fill the physical total marks Field',
    ]);

    if ($validation->fails())
      return response()->json(['error' => true, 'msg' => $validation->errors()->first(), "application_no" => $request->application_no]);


    $totalmark = $request->hundred_mt_mark + $request->eight_hundred_mt_mark + $request->broad_jump_mark + $request->shuttle_run_mark + $request->ball_throw_mark;


    if ($totalmark != $request->physical_total_mark)
      return response()->json(['error' => true, 'msg' => 'Please Check Physical Total Marks Field', "application_no" => $request->application_no]);

    $data = [
      'sport_id' => $request->sport_id,
      'gender' => $request->gender,
      'trial_type' => $request->trial_type,
      'sub_sport_id' => $request->subsport_id,
      'application_no' => $request->application_no,
      'applicant_id' => $request->applicant_id,
      'hundred_mt_time' => $request->hundred_mt_time,
      'hundred_mt_mark' => $request->hundred_mt_mark,
      'eight_hundred_mt_time' => $request->eight_hundred_mt_time,
      'eight_hundred_mt_mark' => $request->eight_hundred_mt_mark,
      'broad_jump_distance' => $request->broad_jump_distance,
      'broad_jump_mark' => $request->broad_jump_mark,
      'shuttle_run_time' => $request->shuttle_run_time,
      'shuttle_run_mark' => $request->shuttle_run_mark,
      'ball_throw_distance' => $request->ball_throw_distance,
      'ball_throw_mark' => $request->ball_throw_mark,
      'physical_total_mark' => $request->physical_total_mark,
      'addedby' => Auth::guard('admin')->user()->id,
      'date' => date("Y-m-d H:i:s")
    ];






    $id = DB::table('online_admission_trial_applicant')->insertGetId($data);


    if ($request->trial_type == 1) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([

        'physical_trial_one_marks' => $request->physical_total_mark

      ]);
    } elseif ($request->trial_type == 2) {
      $user = DB::table('admission_registration_login')->where('id', $request->applicant_id)->update([

        'physical_trial_two_marks' => $request->physical_total_mark

      ]);
    }















    return response()->json(["error" => false, "msg" => "Trial Data Submit Successfully", "application_no" => $request->application_no]);



  }

  //cricketbatsmantrialList
  public function crickettrialList()
  {
    return view('collegeadmin.crikettrialList');
  }





  //okeytrialList ==========================
  public function okeytrialList()
  {
    return view('collegeadmin.okeytrialList');
  }


  //gymnastictrialList
  public function gymnastictrialList()
  {
    return view('collegeadmin.gymnastictrialList');
  }




  //===============


  public function signOuts()
  {
    UserLoggedIn::dispatch(Auth::guard('admin')->user()->id, 2, 1, 'admin');
    Auth::guard('admin')->logout();
    return Redirect('/admin/login');
  }

  public function changePassword()
  {
    return view('superadmin.changePassword');
  }

  public function profile()
  {
    return view('superadmin.profile');
  }


  public function accepted(Request $request)
  {


    $user = DB::table('admission_registration_login')->where('id', $request->user_id)->update([
      'final_status' => 2,
      'comment' => $request->comment
    ]);



    $user = DB::table('admission_registration_login as rg')

      ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
      ->join('cities', 'communication.p_district', '=', 'cities.id')
      ->where('rg.id', $request->user_id)->first();




    $message = 'Your Application with Application No. ' . $user->enroll_no . ' on Khel Sathi Portal has been accepted. You are shortlisted for the trials being held from ' . dmy($user->trial_from_date) . ' to ' . dmy($user->trial_to_date) . ' at ' . $user->trial_location . '. - Omninet';
    regectsms($user->mobile, $message);






    return response()->json(["error" => false, "msg" => "Application Accepted successfully."]);


  }
  public function rejected(Request $request)
  {


    $user = DB::table('admission_registration_login')->where('id', $request->user_id)->update([
      'final_status' => 3,
      'comment' => $request->comment
    ]);

    $user = DB::table('admission_registration_login')->where('id', $request->user_id)->first();
    $message = 'With ref. to Application No. ' . $user->enroll_no . 'on Khel Sathi Portal, we regret to inform you that your candidature for admission has been rejected. -Omninet Technologies Pvt. Ltd.';
    regectsms($user->mobile, $message);
    return response()->json(["error" => false, "msg" => "Application Rejected successfully."]);

  }











  public function collegewisecount()
  {

    $colleges = DB::Select("SELECT scm.college_name ,count(CASE when arl.payment_status = 1 then 1  end) as total,count(CASE when oabd.gender = 1 then 1 end and CASE when arl.payment_status = 1 then 1 end) as male , count(CASE when oabd.gender = 2 then 1 end and CASE when arl.payment_status = 1 then 1 end) as female FROM `sports_college_master` as scm left join online_admission_basic_details as oabd on SUBSTRING_INDEX(oabd.sport_college, ',', 1)= scm.id left join admission_registration_login as arl on arl.id=oabd.user_id where 1 group by scm.id ORDER BY college_name asc");

    $total = DB::select(" SELECT count(CASE when arl.payment_status = 1 then 1 end) as total,count(CASE when oabd.gender = 1 then 1 end and CASE when arl.payment_status = 1 then 1 end) as male , count(CASE when oabd.gender = 2 then 1 end and CASE when arl.payment_status = 1 then 1 end) as female FROM `sports_college_master` as scm left join online_admission_basic_details as oabd on SUBSTRING_INDEX(oabd.sport_college, ',', 1)= scm.id left join admission_registration_login as arl on arl.id=oabd.user_id where 1");
    return view('collegeadmin.collegewisecount', compact('colleges', 'total'));
  }

  public function sportwisecount()
  {

    $sports = DB::Select("SELECT st.name ,count(CASE when arl.payment_status = 1 then 1 end) as total,count(CASE when oabd.gender = 1 then 1 end and CASE when arl.payment_status = 1 then 1 end) as male , count(CASE when oabd.gender = 2 then 1 end and CASE when arl.payment_status = 1 then 1 end) as female FROM `sport_onlineadmission` as st left join online_admission_basic_details as oabd on oabd.sport_type = st.id left join admission_registration_login as arl on arl.id=oabd.user_id where 1 group by st.id ORDER BY name asc");

    $total = DB::select(" SELECT count(CASE when arl.payment_status = 1 then 1 end) as total,count(CASE when oabd.gender = 1 then 1 end and CASE when arl.payment_status = 1 then 1 end) as male , count(CASE when oabd.gender = 2 then 1 end and CASE when arl.payment_status = 1 then 1 end) as female FROM `sport_onlineadmission` as st left join online_admission_basic_details as oabd on oabd.sport_type = st.id left join admission_registration_login as arl on arl.id=oabd.user_id where 1");
    return view('collegeadmin.sportwisecount', compact('sports', 'total'));
  }

  public function districtwisecount()
  {

    $districts = DB::Select("SELECT cities.city ,count(CASE when arl.payment_status = 1 then 1 end) as total,count(CASE when oabd.gender = 1 then 1 end and CASE when arl.payment_status = 1 then 1 end) as male , count(CASE when oabd.gender = 2 then 1 end and CASE when arl.payment_status = 1 then 1 end) as female FROM `cities`  left join online_admission_communication_details as oacd on oacd.p_district= cities.id left join admission_registration_login as arl on arl.id=oacd.user_id  left join online_admission_basic_details as oabd on arl.id=oabd.user_id where 1 and  cities.state_id = 23 group by cities.id   ORDER BY city asc");


    $total = DB::select(" SELECT count(CASE when arl.payment_status = 1 then 1 end) as total,count(CASE when oabd.gender = 1 then 1 end and CASE when arl.payment_status = 1 then 1 end) as male , count(CASE when oabd.gender = 2 then 1 end and CASE when arl.payment_status = 1 then 1 end) as female FROM `cities` left join online_admission_communication_details as oacd on oacd.p_district= cities.id left join admission_registration_login as arl on arl.id=oacd.user_id left join online_admission_basic_details as oabd on arl.id=oabd.user_id where 1 and cities.state_id = 23");

    return view('collegeadmin.districtwisecount', compact('districts', 'total'));
  }



  public function online_admission_query_mark(Request $request)
  {
    $user = DB::table('admission_registration_login')->where('id', $request->user_id)->update([
      'query_status' => 1,
      'query_mark' => $request->query_mark
    ]);

    return redirect()->back()->with('success', 'Query Marked Successfully.');

  }

  public function change_trial_division(Request $req)
  {


    $validation = Validator::make($req->all(), [
      'trial_division' => 'required',

    ]);

    if ($validation->fails())
      return redirect()->back()->with(['error', $validation->errors()->first()]);

    $user = DB::table('online_admission_basic_details')->where('user_id', $req->user_id)->update([
      'trial_division' => $req->trial_division,

    ]);

    return redirect()->back()->with('success', 'Trial division changed successfully.');


  }



  public function online_admission_edit($id)
  {
    $sport_type = DB::table('sport_onlineadmission')->where('status', 1)->orderBy('name')->get();
    $sport_college = DB::table('sports_college_master')->get();
    $state = DB::table('states')->get();
    $city = DB::table('cities')->where('state_id', '=', 23)->get();
    $division = DB::table('hostel_division_master')->get();
    $user = DB::table('admission_registration_login')->where('id', $id)->first();
    $basic_detail = DB::table('online_admission_basic_details')->where('user_id', '=', $id)->first();
    $commun_detail = DB::table('online_admission_communication_details')->where('user_id', '=', $id)->first();
    $education_detail = DB::table('online_admission_education_document_details')->where('user_id', '=', $id)->first();
    return view('collegeadmin.online_admission_details_edit', compact('division', 'user', 'sport_type', 'sport_college', 'state', 'city', 'basic_detail', 'commun_detail', 'education_detail'));


  }

  public function online_admission_update(Request $req, $id)
  {

    $validation = Validator::make($req->all(), [
      'sport_college' => 'required',
      'sport_type' => 'required',
      'category' => 'required',
      'height' => 'required|numeric',

      'blood_group' => 'required',
      'identification_marks' => 'required',

      'disease' => 'required',
      'gender' => 'required',

      'mother_name' => 'required',

      'mother_occupation' => 'required',
      'father_name' => 'required',

      'father_occupation' => 'required',

    ], [
      'sport_college.required' => 'Please select college in which you are seeking admission?/कृपया विद्यालय का चयन करें जिसमें आप प्रवेश चाह रहे हैं?',
      'sport_type.required' => '	Please select name of Sports in which you are seeking admission?/कृपया खेल का चयन करें जिसमें आप प्रवेश चाह रहे हैं?',
      'category.required' => 'Please Select Category./कृपया श्रेणी का चयन करें।',
      'gender.required' => 'Please Select Gender./कृपया लिंग का चयन करें।',
      'height.required' => 'Please Enter Height (in Centimetre)./कृपया लंबाई (सेंटीमीटर में) भरें।',

      'blood_group.required' => 'Please Select Blood Group./कृपया ब्लड ग्रुप का चयन करें।',
      'identification_marks.required' => 'Please Enter Identification Mark./कृपया पहचान चिह्न भरें।',
      'disease.required' => '	Please answer that whether the applicant is suffering from Skin Disease/Fits/Other Disease?/कृपया उत्तर दें कि क्या आवेदक चर्म रोग/मिर्गी/अन्य किसी रोग से ग्रसित है?',
      'mother_name.required' => 'Please Enter Mother’s Name./कृपया माता का नाम भरें।',

      'mother_occupation.required' => 'Please Enter Mother’s Occupation./कृपया माता का व्यवसाय भरें।',
      'father_name.required' => '	Please Enter Father’s Name./कृपया पिता का नाम भरें।',

      'father_occupation.required' => 'Please Enter Father’s Occupation./कृपया पिता का व्यवसाय भरें।',



    ]);






    if ($validation->fails())
      return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);





    $validation = Validator::make(
      $req->all(),
      [
        'p_gram' => 'required',
        'p_post' => 'required',
        'p_thana' => 'required',
        'p_state' => 'required',
        'p_district' => 'required',
        'p_mobile' => 'required|numeric',
        'p_alternate_mobile' => 'required|numeric',
        'p_email' => 'required|email',
        'c_gram' => 'required',
        'c_post' => 'required',
        'c_thana' => 'required',
        'c_state' => 'required',
        'c_district' => 'required',
        'c_mobile' => 'required|numeric',
        'c_alternate_mobile' => 'required|numeric',
        'c_email' => 'required|email'

      ],
      [
        'p_gram.required' => ' Please Enter Street/Village Name./कृपया मोहल्ला/ग्राम का नाम भरें।',
        'p_post.required' => 'Please Enter Post Office./कृपया डाक घर भरें।',
        'p_thana.required' => 'Please Enter Police Station./कृपया पुलिस थाना भरें।',
        'p_state.required' => 'Please Select State./कृपया राज्य का चयन करें।',

        'p_district.required' => 'Please Select District./कृपया जनपद का चयन करें।',
        'p_mobile.required' => 'Please Enter Mobile No./कृपया मोबाइल नंबर भरें।',
        'p_alternate_mobile' => 'Please Enter Alternative Mobile No./कृपया वैकल्पिक मोबाइल नंबर भरें।',
        'p_email' => 'Please Enter Email ID./कृपया ईमेल आईडी भरें।',
        'c_gram.required' => 'Please Enter Street/Village Name./कृपया मोहल्ला/ग्राम का नाम भरें।',
        'c_post.required' => 'Please Enter Post Office./कृपया डाक घर भरें।',
        'c_thana.required' => 'Please Enter Police Station./कृपया पुलिस थाना भरें।',
        'c_state.required' => 'Please Select State./कृपया राज्य का चयन करें।',
        'c_district.required' => 'Please Select District./कृपया जनपद का चयन करें।',
        'c_mobile.required' => 'Please Enter Mobile No./कृपया मोबाइल नंबर भरें।',
        'c_alternate_mobile' => 'Please Enter Alternative Mobile No./कृपया वैकल्पिक मोबाइल नंबर भरें।',
        'c_email' => 'Please Enter Email ID./कृपया ईमेल आईडी भरें।',




      ]
    );

    if ($validation->fails())
      return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);


    $validation = Validator::make($req->all(), [
      'updise_code' => 'required',
      'school' => 'required',
      'class' => 'required',
      'year_of_passing' => 'required',
      'obtained_marks' => 'required|numeric',
      'maximum_marks' => 'required|numeric',
      'grade_percentage' => 'required'

    ]);

    if ($validation->fails())
      return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);



    if ($req->hasFile('mother_aadhar')) {
      $mother_aadhar = moveFile('onlineAdmission/images', $req->mother_aadhar);
    } else {
      $mother_aadhar = $req->mother_aadhar1;
    }

    if ($req->hasFile('father_aadhar')) {
      $father_aadhar = moveFile('onlineAdmission/images', $req->father_aadhar);
    } else {
      $father_aadhar = $req->father_aadhar1;
    }

    $status = [
      'user_id' => $id,
      'application_no' => DB::table('online_admission_basic_details')->where('user_id', $id)->first()->application_no,
      'sport_college' => implode(",", $req->sport_college),
      'sport_type' => $req->sport_type,

      'category' => $req->category,
      'sub_category' => $req->sub_category,
      'height' => $req->height,
      'weight' => $req->weight,
      'blood_group' => $req->blood_group,
      'identification_marks' => $req->identification_marks,
      'gender' => $req->gender,
      'trial_division' => $req->trial_division,

      'disease' => $req->disease,
      'mother_name' => $req->mother_name,

      'mother_occupation' => $req->mother_occupation,
      'father_name' => $req->father_name,

      'father_occupation' => $req->father_occupation,

      'mother_aadhar' => $mother_aadhar,
      'father_aadhar' => $father_aadhar
    ];






    $status['sub_sport_type'] = $req->sub_type;



    if (DB::table('online_admission_basic_details')->where('user_id', $id)->exists()) {

      $check = DB::table('online_admission_basic_details')->where('user_id', $id)->update($status);
    }


    if ($req->p_alternate_mobile == $req->p_mobile) {
      return response()->json(["error" => true, "msg" => 'In Permanent Address Mobile no. and Alternate mobile no. should not be same. ']);
      ;
    }

    if ($req->c_alternate_mobile == $req->c_mobile) {
      return response()->json(["error" => true, "msg" => 'In Correspondence Address Mobile no. and Alternate mobile no. should not be same. ']);
      ;
    }


    $status = [
      'user_id' => $id,
      'application_no' => DB::table('online_admission_communication_details')->where('user_id', $id)->first()->application_no,
      'p_gram' => $req->p_gram,
      'p_post' => $req->p_post,
      'p_thana' => $req->p_thana,
      'p_state' => $req->p_state,
      'p_district' => $req->p_district,
      'p_mobile' => $req->p_mobile,
      'p_alternate_mobile' => $req->p_alternate_mobile,
      'p_email' => $req->p_email,
      'c_gram' => $req->c_gram,
      'c_post' => $req->c_post,
      'c_thana' => $req->c_thana,
      'c_state' => $req->c_state,
      'c_district' => $req->c_district,
      'c_mobile' => $req->c_mobile,
      'c_alternate_mobile' => $req->c_alternate_mobile,
      'c_email' => $req->c_email
    ];

    if (DB::table('online_admission_communication_details')->where('user_id', $id)->exists()) {
      $check = DB::table('online_admission_communication_details')->where('user_id', $id)->update($status);

    }


    $status = [
      'user_id' => $id,
      'application_no' => DB::table('online_admission_education_document_details')->where('user_id', $id)->first()->application_no,
      'school' => $req->school,
      'updise_code' => $req->updise_code,
      'class' => $req->class,
      'year_of_passing' => $req->year_of_passing,
      'obtained_marks' => $req->obtained_marks,
      'maximum_marks' => $req->maximum_marks,
      'grade_percentage' => $req->grade_percentage

    ];

    if (DB::table('online_admission_education_document_details')->where('user_id', $id)->exists()) {
      $check = DB::table('online_admission_education_document_details')->where('user_id', $id)->update($status);

    }


    if ($req->hasFile('applicant_photograph')) {
      $applicant_photograph = moveFile('onlineAdmission/images', $req->applicant_photograph);
    } else {
      $applicant_photograph = $req->applicant_photograph1;
    }

    if ($req->hasFile('applicant_signature')) {
      $applicant_signature = moveFile('onlineAdmission/images', $req->applicant_signature);
    } else {
      $applicant_signature = $req->applicant_signature1;
    }

    if ($req->hasFile('applicant_aadhar_birth_certificate')) {
      $applicant_aadhar_birth_certificate = moveFile('onlineAdmission/images', $req->applicant_aadhar_birth_certificate);
    } else {
      $applicant_aadhar_birth_certificate = $req->applicant_aadhar_birth_certificate1;
    }

    if ($req->hasFile('applicant_birth_certificate')) {
      $applicant_birth_certificate = moveFile('onlineAdmission/images', $req->applicant_birth_certificate);
    } else {
      $applicant_birth_certificate = $req->applicant_birth_certificate1;
    }






    if ($req->hasFile('medical_certificate')) {
      $medical_certificate = moveFile('onlineAdmission/images', $req->medical_certificate);
    }

    if ($req->hasFile('education_certificate')) {
      $education_certificate = moveFile('onlineAdmission/images', $req->education_certificate);
    } else {
      $education_certificate = $req->education_certificate1;
    }

    $status = [
      'applicant_photograph' => $applicant_photograph,
      'applicant_signature' => $applicant_signature,
      'applicant_aadhar_birth_certificate' => $applicant_aadhar_birth_certificate,
      'applicant_birth_certificate' => $applicant_birth_certificate,
      'document_type' => $req->document_type,
      'education_certificate' => $education_certificate,

    ];
    if ($req->hasFile('medical_certificate')) {
      $status['medical_certificate'] = $medical_certificate;
    }

    if ($req->hasFile('affidavit')) {
      $affidavit = moveFile('onlineAdmission/images', $req->affidavit);
      $status['affidavit'] = $affidavit;
    }
    $check = DB::table('online_admission_education_document_details')->where('user_id', $id)->update($status);

    return response()->json(["error" => false, "msg" => "Update Successfully.", "url" => url('collegeadmin/dashboard')]);







  }





  public function online_admission_absent(Request $request)
  {

    $division = DB::table('hostel_division_master')->get();
    $sports = DB::table('sport_onlineadmission')->where('status', 1)->where('status', 1)->orderBy('name', 'asc')->get();
    $divisions = DivisionModel::select('division_name', 'id')->get();
    $check = DB::table('hostel_div_district_mapping')
      ->select(DB::raw('group_concat(district_id) as district_id'))->where('division_id', Auth::guard('admin')->user()->division_id)->get();
    $district = DB::table('cities')->where('state_id', 23);
    $abc = 0;
    if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 6) {
      $abc = 1;
    }
    if ($abc == 0) {
      $district->whereIn('id', explode(',', $check[0]->district_id));
    }


    $district = $district->orderBy('city', 'asc')->get();
    if ($request->isMethod('post')) {
      $registrations = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as comm', 'rg.id', '=', 'comm.user_id')

        ->join('online_admission_education_document_details as edu', 'rg.id', '=', 'edu.user_id')

        ->join('cities', 'cities.id', '=', 'comm.p_district')

        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')

        ->leftJoin('sub_sport_type', 'basic.sub_sport_type', '=', 'sub_sport_type.id')
        ->leftJoin('online_admission_trial_applicant', 'rg.application_no', '=', 'online_admission_trial_applicant.application_no')
        ->select('rg.application_no', 'rg.query_status', 'rg.pen_no', 'edu.updise_code', 'rg.enroll_no', 'rg.trial_type', 'rg.fullname', 'basic.sub_sport_type', 'basic.trial_division', 'rg.email', 'rg.mobile', 'sub_sport_type.sub_type', 'rg.aadhar_no', 'sport_onlineadmission.name', 'rg.final_status', 'rg.id', 'rg.challan_no', 'rg.created_at', );
      $registrations->where('rg.payment_status', 1)
        ->where('rg.session_year', config('app.session_year'));
      $abc = 0;
      if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 6 || Auth::guard('admin')->user()->admin_role == 19) {
        $abc = 1;
      }
      if ($abc == 0) {
        $registrations->where('basic.trial_division', Auth::guard('admin')->user()->division_id);
      }



      if ($request->has('action')) {
        $registrations->where('rg.final_status', $request->action);
      }



      if ($request->subsport) {
        $registrations->where('sub_sport_type.id', $request->subsport);
      }
      if ($request->trial_type) {

        if ($request->trial_type == 1) {
          $registrations->where('rg.trial_type', 1);
        } elseif ($request->trial_type == 2) {
          $registrations->where('rg.trial_type', 2);
        }
      }



      if ($request->has('district_id') && $request->district_id != null) {

        $registrations->where('comm.p_district', $request->district_id);
      }

      if ($request->has('division_id') && $request->division_id != null) {


        $registrations->where('basic.trial_division', $request->division_id);
      }

      if ($request->has('sport_id') && $request->sport_id != null) {

        $registrations->where('sport_onlineadmission.id', $request->sport_id);
      }








      $registrations->whereDate('rg.created_at', '>=', ymd('2023-06-09'))->where('rg.session_year', config('app.session_year'));

      $data = $registrations->orderBy('rg.fullname', 'asc')->get();


    } else {
      $data = [];
    }

    return view('collegeadmin.online_admission_absent', ['registrations' => $data, 'sports' => $sports, 'district' => $district, 'divisions' => $divisions, 'division' => $division]);






  }





  public function division_level_merit_list(Request $request)
  {







    $divisions = DB::table('hostel_division_master');



    if (Auth::guard('admin')->user()->admin_role == 19) {


      if (Auth::guard('admin')->user()->id == 143) {
        $divisions->whereIn('id', [25, 28, 30]);

      } elseif (Auth::guard('admin')->user()->id == 144) {
        $divisions->whereIn('id', [26, 31]);
      } elseif (Auth::guard('admin')->user()->id == 145) {
        $divisions->whereIn('id', [36, 40]);
      } elseif (Auth::guard('admin')->user()->id == 146) {
        $divisions->whereIn('id', [29, 38]);
      } elseif (Auth::guard('admin')->user()->id == 147) {
        $divisions->whereIn('id', [18, 24, 32]);
      } elseif (Auth::guard('admin')->user()->id == 148) {
        $divisions->whereIn('id', [27, 37]);
      } elseif (Auth::guard('admin')->user()->id == 149) {
        $divisions->whereIn('id', [35, 39]);
      } elseif (Auth::guard('admin')->user()->id == 150) {
        $divisions->whereIn('id', [33, 34]);
      }


    }



    $divisions = $divisions->orderBy('division_name', 'asc')->get();








    $sports = DB::table('sport_onlineadmission')->where('status', 1)->orderBy('name', 'asc')->get();






    $check = DB::table('hostel_div_district_mapping')
      ->select(DB::raw('group_concat(district_id) as district_id'));


    if (Auth::guard('admin')->user()->admin_role == 19) {


      if (Auth::guard('admin')->user()->id == 143) {
        $check->whereIn('division_id', [25, 28, 30]);

      } elseif (Auth::guard('admin')->user()->id == 144) {
        $check->whereIn('division_id', [26, 31]);
      } elseif (Auth::guard('admin')->user()->id == 145) {
        $check->whereIn('division_id', [36, 40]);
      } elseif (Auth::guard('admin')->user()->id == 146) {
        $check->whereIn('division_id', [29, 38]);
      } elseif (Auth::guard('admin')->user()->id == 147) {
        $check->whereIn('division_id', [18, 24, 32]);
      } elseif (Auth::guard('admin')->user()->id == 148) {
        $check->whereIn('division_id', [27, 37]);
      } elseif (Auth::guard('admin')->user()->id == 149) {
        $check->whereIn('division_id', [35, 39]);
      } elseif (Auth::guard('admin')->user()->id == 150) {
        $check->whereIn('division_id', [33, 34]);
      }


    } else {
      $check->where('division_id', Auth::guard('admin')->user()->division_id);
    }











    $check = $check->get();
    $district = DB::table('cities')->where('state_id', 23);
    $abc = 0;
    if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 6) {
      $abc = 1;
    }
    if ($abc == 0) {
      $district->whereIn('id', explode(',', $check[0]->district_id));
    }


    $district = $district->orderBy('city', 'asc')->get();















    $registrations = DB::table('admission_registration_login as rg')
      ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
      ->join('online_admission_communication_details as comm', 'rg.id', '=', 'comm.user_id')
      ->join('online_admission_education_document_details as edu', 'rg.id', '=', 'edu.user_id')
      ->join('cities', 'comm.p_district', '=', 'cities.id')
      ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
      ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
      ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
      ->leftJoin('sub_sport_type', 'basic.sub_sport_type', '=', 'sub_sport_type.id')

      ->select(
        'rg.application_no',
        'rg.id',
        'rg.fullname',
        'basic.sub_sport_type',
        'rg.dob',
        'basic.gender',
        'rg.mobile',
        'sub_sport_type.sub_type',
        'sport_onlineadmission.name',
        DB::raw('COALESCE(rg.physical_trial_one_marks, 0) as physical_trial_one_marks'),
        DB::raw('COALESCE(rg.skill_trial_one_marks, 0) as skill_trial_one_marks'),
        DB::raw('COALESCE(rg.physical_trial_one_marks, 0) + COALESCE(rg.skill_trial_one_marks, 0) as total')
        ,
        'basic.admission_seeking'
      );
    $registrations->where('rg.payment_status', 1)->where('rg.session_year', config('app.session_year'));
    $abc = 0;
    if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 6 || Auth::guard('admin')->user()->admin_role == 19) {
      $abc = 1;
    }
    if ($abc == 0) {
      $registrations->where('hostel_division_master.id', Auth::guard('admin')->user()->division_id);
    }


    if (Auth::guard('admin')->user()->admin_role == 19) {


      if (Auth::guard('admin')->user()->id == 143) {
        $registrations->whereIn('hostel_div_district_mapping.division_id', [25, 28, 30]);

      } elseif (Auth::guard('admin')->user()->id == 144) {
        $registrations->whereIn('hostel_div_district_mapping.division_id', [26, 31]);
      } elseif (Auth::guard('admin')->user()->id == 145) {
        $registrations->whereIn('hostel_div_district_mapping.division_id', [36, 40]);
      } elseif (Auth::guard('admin')->user()->id == 146) {
        $registrations->whereIn('hostel_div_district_mapping.division_id', [29, 38]);
      } elseif (Auth::guard('admin')->user()->id == 147) {
        $registrations->whereIn('hostel_div_district_mapping.division_id', [18, 24, 32]);
      } elseif (Auth::guard('admin')->user()->id == 148) {
        $registrations->whereIn('hostel_div_district_mapping.division_id', [27, 37]);
      } elseif (Auth::guard('admin')->user()->id == 149) {
        $registrations->whereIn('hostel_div_district_mapping.division_id', [35, 39]);
      } elseif (Auth::guard('admin')->user()->id == 150) {
        $registrations->whereIn('hostel_div_district_mapping.division_id', [33, 34]);
      }


    }







    if ($request->isMethod('post')) {

      if ($request->has('action')) {
        $registrations->where('rg.final_status', $request->action);
      }


      if ($request->subsport) {
        $registrations->where('sub_sport_type.id', $request->subsport);
      }
      if ($request->gender) {
        $registrations->where('basic.gender', $request->gender);
      }



      if ($request->has('division_id') && $request->division_id != null) {


        $registrations->where('hostel_division_master.id', $request->division_id);
      }

      if ($request->has('sport_id') && $request->sport_id != null) {

        $registrations->where('sport_onlineadmission.id', $request->sport_id);
      }

      if ($request->has('admission_seeking') && $request->admission_seeking != null) {

        $registrations->where('basic.admission_seeking', $request->admission_seeking);
      }


    }
    $registrations->where('rg.session_year', config('app.session_year'));
    $registrations->where(function ($query) {
      $query->whereIn('rg.trial_type', [1, 2])
        ->orWhere(function ($q) {
          $q->where('rg.trial_type', 3)
            ->whereNotNull('rg.physical_trial_one_marks');
        });
    });




    $data = $registrations->orderBy('total', 'desc')->orderBy('skill_trial_one_marks', 'desc')->orderBy('physical_trial_one_marks', 'desc')->orderBy('rg.dob', 'asc')->get();




    return view('collegeadmin.division_level_merit_list', ['registrations' => $data, 'sports' => $sports, 'district' => $district, 'divisions' => $divisions]);

  }




  public function college_sport_admission_matrix(Request $request)
  {


    $college = DB::table('sports_college_master')->select('college_name', 'id')->get();
    $sports = DB::table('sport_onlineadmission')->where('status', 1)->orderBy('name', 'asc')->get();


    if ($request->isMethod('POST')) {


      $validation = Validator::make($request->all(), [

        'sport' => 'required',
        'college' => 'required',
        'gender' => 'required',
        'seats' => 'required',
        'class' => 'required',
      ]);

      if ($validation->fails())
        return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

      $data = [
        'sport_id' => $request->sport,
        'sub_sport_id' => $request->subsport,
        'college_id' => $request->college,
        'gender' => $request->gender,
        'seats' => $request->seats,
        'class' => $request->class,
        'created_by' => Auth::guard('admin')->user()->id,
      ];


      DB::table('online_admission_college_matrix')->insertGetId($data);


      return response()->json(['error' => false, 'msg' => 'Added Successfully', 'url' => url('collegeadmin/college_sport_admission_matrix')]);
    }
    $online_admission_college_matrix = DB::table('online_admission_college_matrix')
      ->leftJoin('sport_onlineadmission', 'online_admission_college_matrix.sport_id', '=', 'sport_onlineadmission.id')
      ->leftJoin('sports_college_master', 'online_admission_college_matrix.college_id', '=', 'sports_college_master.id')
      ->leftJoin('sub_sport_type', 'online_admission_college_matrix.sub_sport_id', '=', 'sub_sport_type.id')
      ->select('sport_onlineadmission.name', 'sports_college_master.college_name', 'sub_sport_type.sub_type', 'online_admission_college_matrix.seats', 'online_admission_college_matrix.gender', 'online_admission_college_matrix.class')
      ->get();
    return view("collegeadmin.college_sport_admission_matrix", compact('college', 'sports', 'online_admission_college_matrix'));

  }












  public function getAllAdmissionRegister()
  {


    $registrations = DB::table('admission_registration_login as rg')


      ->join('online_admission_payment_response_details as payment_response', 'payment_response.uniquechallan', '=', 'rg.challan_no')

      ->select('rg.application_no', 'rg.query_status', 'rg.pen_no', 'rg.enroll_no', 'rg.trial_type', 'rg.fullname', 'rg.email', 'rg.mobile', 'rg.aadhar_no', 'rg.final_status', 'rg.id as register_id', 'rg.challan_no');





    $registrations->where('rg.session_year', config('app.session_year'));

    $data = $registrations->groupBy('rg.id')->orderBy('rg.fullname', 'asc')->get();

    return view('collegeadmin.dashboard_all_registered_student', ['registrations' => $data]);
  }







}
