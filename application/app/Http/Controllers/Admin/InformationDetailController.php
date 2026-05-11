<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\InformationMaster;
use App\Models\HostelMaster;
use App\Models\SportsInfrastructure;
use App\Models\OrganizedCompetition;
use App\Models\MonthlyInformationModel;
use App\Models\informationHonorableModel;
use App\Models\DivisionModel;
use App\Models\Information_financial;
use Illuminate\Support\Facades\Auth;
use Exception;
use DateTime;

class InformationDetailController extends Controller
{





  /** anurag information  */

  //project under construction bindu 1

  public function projects_under_construction(Request $req)
  {
    
    if ($req->method() == "POST") {
      // dd($req->all());
      $validation = Validator::make($req->all(), [
        'district_name' => 'required',
        'month_name' => 'required',
        'year' => 'required',
        'project_name' => 'required',
        'name_of_executing_agency' => 'required',
        'original_cost' => 'required',
        // 'revised_cost_of_the_project' => 'required',
        // 'date_of_project_approval' => 'required',
        // 'date_of_executing_agency' => 'required', 
        'total_sanctioned_amount' => 'required',
        // 'residual_amount_due' => 'required',
        // 'project_start_date' => 'required',
        // 'project_completion_date' => 'required',
        // 'rescheduled_date' => 'required',
        'total_expenditure' => 'required',
        'overall_physical' => 'required'
      ]);

      if ($validation->fails()) {
        return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
      }

    $data=[
          'month_name' => $req->month_name,
          'year' => $req->year,
          'district_id' => $req->district_name,
          'tehsil_id' => $req->tehsil_name,
          'project_name' => $req->project_name,
          'name_of_executing_agency' => $req->name_of_executing_agency,
          'original_cost' => $req->original_cost,
          'revised_cost_of_the_project' => $req->revised_cost_of_the_project,
          'date_of_project_approval' => $req->date_of_project_approval,
          'date_of_executing_agency' => $req->date_of_executing_agency,
          'residual_amount_due' => $req->residual_amount_due,
          'project_start_date' => $req->project_start_date,
          'project_completion_date' => $req->project_completion_date,
          'rescheduled_date' => $req->rescheduled_date,
          'total_expenditure' => $req->total_expenditure,
          'total_sanctioned_amount' => $req->total_sanctioned_amount,
          'overall_physical' => $req->overall_physical,
          'comment' => $req->comment
        ];
        if($req->id){
          DB::table('information_project_under_construction')->where('id',$req->id)->update($data);
          return response()->json(['error' => false, 'msg' => "Data Update sucessfully",'url'=>route('projects_under_construction')]);
        }else{
          DB::table('information_project_under_construction')->insert($data);
          return response()->json(['error' => false, 'msg' => "Data Saved sucessfully",'url'=>route('projects_under_construction')]);
        }
      
    }
    $district_id_financial = Auth::guard('admin')->user()->district_id;

    $admin_id = Auth::guard('admin')->user()->admin_role;
    $sports = DB::table('sport_type')->orderBy('name', 'ASC')->get();

    $division_id = 0;
    $tehsils = DB::table('tehsil_master')->select('Tehsil_Name', 'id')->where('dist_id', $district_id_financial)->get();
    $underConstructionInformation = DB::table('information_project_under_construction')
      ->join('hostel_div_district_mapping', 'information_project_under_construction.district_id', '=', 'hostel_div_district_mapping.district_id');

    if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 18) {
      $division = DB::table('hostel_division_master')->select('division_name', 'id')->orderBy('division_name')->get();
      $districts = DB::table('cities')->select('city', 'id')->where('state_id', '23')->orderBy('city')->get();
    } elseif (Auth::guard('admin')->user()->admin_role == 9) {
      $division = DB::table('hostel_division_master')
        ->join('hostel_div_district_mapping', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
        ->select('hostel_division_master.division_name', 'hostel_division_master.id')->where('hostel_div_district_mapping.district_id', $district_id_financial)->orderBy('division_name')->get();
      $districts = DB::table('cities')->select('city', 'id')->where('id',  $district_id_financial)->get();
      $underConstructionInformation->where('information_project_under_construction.district_id',  $district_id_financial);
    } elseif (Auth::guard('admin')->user()->admin_role == 2) {
      $division_id = Auth::guard('admin')->user()->division_id;
      $district_list = DB::table('hostel_div_district_mapping')->where('division_id', $division_id)->get();
      $division = DB::table('hostel_division_master')->select('division_name', 'id')->where('hostel_division_master.id', $division_id)->orderBy('division_name')->get();
      $district_id = [];
      foreach ($district_list as $key => $item) {
        $district_id[] = $item->district_id;
      }
      $districts = DB::table('cities')->select('city', 'id')->whereIn('id',  $district_id)->get();
      $underConstructionInformation = DB::table('information_project_under_construction')
        ->join('hostel_div_district_mapping', 'information_project_under_construction.district_id', '=', 'hostel_div_district_mapping.district_id')
        ->whereIn('information_project_under_construction.district_id',  $district_id);
    }

    if (isset($req->district_name)) {
      $underConstructionInformation = $underConstructionInformation->where('information_project_under_construction.district_id', $req->district_name);
    }
    if (isset($req->division_name)) {
      $underConstructionInformation = $underConstructionInformation->where('hostel_div_district_mapping.division_id', $req->division_name);
    }
    // from
    if (isset($req->from_year)) {
      $from_year = $req->from_year;
      if($req->from_year != 'all'){
        $underConstructionInformation = $underConstructionInformation->where('information_project_under_construction.year', $req->from_year);
      }
    }
    else{
      $from_year = date('Y');
      $underConstructionInformation = $underConstructionInformation->where('information_project_under_construction.year', date('Y'));
    }

    if (isset($req->from_month)) {
      $from_month = $req->from_month;
      if($req->from_month != 'all'){
      $underConstructionInformation = $underConstructionInformation->where('information_project_under_construction.month_name','>=',$req->from_month);
      }
    }
    else{
      $from_month = date('m');
      $underConstructionInformation = $underConstructionInformation->where('information_project_under_construction.month_name', date('m'));
    }

    // to
    if (isset($req->to_month)) {
      $to_month = $req->to_month;
      if($req->to_month != 'all'){
      $underConstructionInformation = $underConstructionInformation->where('information_project_under_construction.month_name','<=',$req->to_month);
      }
    }
    else{
      $to_month = date('m');
      $underConstructionInformation = $underConstructionInformation->where('information_project_under_construction.month_name', date('m'));
    }
    // if (isset($req->to_year)) {
    //   $to_year = $req->to_year;
    //   if($req->to_year != 'all'){
    //     $underConstructionInformation = $underConstructionInformation->where('information_project_under_construction.year','<=', $req->to_year);
    //   }
    // }
    // else{
    //   $to_year = date('Y');
    //   $underConstructionInformation = $underConstructionInformation->where('information_project_under_construction.year', date('Y'));
    // }


//     if ($req->from_date != '') {
//       $underConstructionInformation = $underConstructionInformation->whereDate('project_start_date', '>=', ymd($req->from_date));
//     }
// 
//     if ($req->to_date != '') {
//       $underConstructionInformation = $underConstructionInformation->whereDate('project_start_date', '<=', ymd($req->to_date));
//     }


    if ($req->from_date != '' && $req->to_date != '') {
      $underConstructionInformation = $underConstructionInformation->whereBetween('project_start_date', [ymd($req->from_date), ymd($req->to_date)]);
    }


    $underConstructionInformation = $underConstructionInformation->select('information_project_under_construction.*')
 
    
       ->orderBy('hostel_div_district_mapping.division_id', 'ASC')
    ->orderBy('hostel_div_district_mapping.district_id', 'ASC')
    ->orderBy('year', 'DESC')->orderBy('month_name', 'DESC')
    ->get();
    $ed_data =false;
    if($req->id){
      $ed_data = DB::table('information_project_under_construction')->where('id',$req->id)->first();
    }
    // $st="";
    // if ($underConstructionInformation->exists()){
    //   $st=$underConstructionInformation->take(1)->first()->project_start_date;
    // }
    // dd($ed_data);
    return view('admin.information_details.projects_under_construction', ['underConstructionInformation' => $underConstructionInformation, 'division' => $division, 'districts' => $districts, 'tehsils' => $tehsils, 'division_id' => $division_id, 'district_id_financial' => $district_id_financial, 'admin_id' => $admin_id, 'sports' => $sports,'ed_data'=>$ed_data,'from_year'=>$from_year ,'from_month'=>$from_month,'to_month'=>$to_month ]);
  }

  public function nodal_officer(Request $req)
  {

    if ($req->method() == "POST") {
      // dd($req->all());
      $validation = Validator::make($req->all(), [
        'district_name' => 'required',
        'head_office_name' => 'required',
        'officer_name' => 'required',
        'officer_designation' => 'required',
        'officer_mobile' => 'required',
        'month' => 'required',
        'year' => 'required',
      ]);

      if ($validation->fails()) {
        return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
      }
      $data=[
        'month_name' => $req->month,
        'year' => $req->year,
        'district_id' => $req->district_name,
        'head_office_name' => $req->head_office_name,
        'officer_name' => $req->officer_name,
        'officer_designation' => $req->officer_designation,
        'officer_mobile' => $req->officer_mobile
      ];

      // return response()->json(['error' => false, 'msg' => "Data saved sucessfully"]);
      if($req->id){
        DB::table('information_nodal_officer')->where('id',$req->id)->update($data);
        return response()->json(['error' => false, 'msg' => "Data Update sucessfully",'url'=>route('nodal_officer')]);
      }else{
        DB::table('information_nodal_officer')->insert($data);
        return response()->json(['error' => false, 'msg' => "Data Saved sucessfully",'url'=>route('nodal_officer')]);
      }
    }

    $district_id_financial = Auth::guard('admin')->user()->district_id;

    $admin_id = Auth::guard('admin')->user()->admin_role;
    $sports = DB::table('sport_type')->orderBy('name', 'ASC')->get();
    $division_id = 0;
    $tehsils = DB::table('tehsil_master')->select('Tehsil_Name', 'id')->where('dist_id', $district_id_financial)->get();
    $nodal_officer = DB::table('information_nodal_officer')
      ->join('hostel_div_district_mapping', 'information_nodal_officer.district_id', '=', 'hostel_div_district_mapping.district_id');
    if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 18) {
      $districts = DB::table('cities')->select('city', 'id')->where('state_id', '23')->orderBy('city')->get();
      $division = DB::table('hostel_division_master')->select('division_name', 'id')->orderBy('division_name')->get();
    } elseif (Auth::guard('admin')->user()->admin_role == 9) {
      $districts = DB::table('cities')->select('city', 'id')->where('id',  $district_id_financial)->get();
      $division = DB::table('hostel_division_master')
      ->join('hostel_div_district_mapping','hostel_division_master.id','=','hostel_div_district_mapping.division_id')
      ->select('hostel_division_master.division_name','hostel_division_master.id')->where('hostel_div_district_mapping.district_id',$district_id_financial)->orderBy('division_name')->get();
      $nodal_officer->where('information_nodal_officer.district_id',  $district_id_financial);
    } elseif (Auth::guard('admin')->user()->admin_role == 2) {
      $division_id = Auth::guard('admin')->user()->division_id;
      $division = DB::table('hostel_division_master')->select('division_name','id')->where('hostel_division_master.id',$division_id)->orderBy('division_name')->get();
      $district_list = DB::table('hostel_div_district_mapping')->where('division_id', $division_id)->get();
      $district_id = [];
      foreach ($district_list as $key => $item) {
        $district_id[] = $item->district_id;
      }
      $districts = DB::table('cities')->select('city', 'id')->whereIn('id',  $district_id)->get();
      $nodal_officer->whereIn('information_nodal_officer.district_id',  $district_id);
    }

    if (isset($req->district_name)) {
      $nodal_officer->where('information_nodal_officer.district_id', $req->district_name);
    }
   
    if (isset($req->division_name)) {
       $nodal_officer->where('hostel_div_district_mapping.division_id', $req->division_name);
    }
    // if (isset($req->year)) {
    //    $nodal_officer->where('information_nodal_officer.year', $req->year);
    // }
    // if (isset($req->month)) {
    //    $nodal_officer->where('information_nodal_officer.month_name', $req->month);
    // }
    if (isset($req->year)) {
      $s_year = $req->year;
      if($req->year != 'all'){
        $nodal_officer->where('information_nodal_officer.year', $req->year);
      }
    }
    else{
      $s_year = date('Y');
      $nodal_officer->where('information_nodal_officer.year', date('Y'));
    }
    // if (isset($req->month)) {
    //   $s_month = $req->month;
    //   if($req->month != 'all'){
    //     $nodal_officer->where('information_nodal_officer.month_name', $req->month);
    //   }
    // }
    // else{
    //   $s_month = date('m');
    //   $nodal_officer->where('information_nodal_officer.month_name', date('m'));
    // }
    if (isset($req->from_month)) {
      $from_month = $req->from_month;
      if($req->from_month != 'all'){
      $nodal_officer->where('information_nodal_officer.month_name','>=',$req->from_month);
      }
    }
    else{
      $from_month = date('m');
      $nodal_officer->where('information_nodal_officer.month_name', date('m'));
    }

    // to
    if (isset($req->to_month)) {
      $to_month = $req->to_month;
      if($req->to_month != 'all'){
      $nodal_officer->where('information_nodal_officer.month_name','<=',$req->to_month);
      }
    }
    else{
      $to_month = date('m');
      $nodal_officer->where('information_nodal_officer.month_name', date('m'));
    }
    if ($req->from_date != '') {
      $nodal_officer->whereDate('created_on', '>=', ymd($req->from_date));
    }

    if ($req->to_date != '') {
      $nodal_officer->whereDate('created_on', '<=', ymd($req->to_date));
    }


    if ($req->from_date != '' && $req->to_date != '') {
      $nodal_officer->whereBetween('created_on', [ymd($req->from_date), ymd($req->to_date)]);
    }

    $nodal_officer = $nodal_officer->select('information_nodal_officer.*')->orderBy('hostel_div_district_mapping.division_id', 'ASC')->orderBy('hostel_div_district_mapping.district_id', 'ASC')
    ->orderBy('year', 'DESC')->orderBy('month_name', 'DESC')
    ->get();
    $ed_data =false;
    if($req->id){
      $ed_data = DB::table('information_nodal_officer')->where('id',$req->id)->first();
    }
    return view('admin.information_details.nodal_officer', ['division' => $division, 'nodal_officer' => $nodal_officer, 'districts' => $districts, 'tehsils' => $tehsils, 'division_id' => $division_id, 'district_id_financial' => $district_id_financial, 'admin_id' => $admin_id, 'sports' => $sports,'ed_data'=>$ed_data,'s_year'=>$s_year ,'from_month'=>$from_month,'to_month'=>$to_month]);
  }

  public function khelo_india_yojana(Request $req)
  {

    if ($req->method() == "POST") {
      // dd($req->all());
      $validation = Validator::make($req->all(), [
        'month' => 'required',
        'year' => 'required',
        'yojna_name' => 'required',
        'name_of_executing_agency' => 'required',
        'approval_amount' => 'required',
        'unreleased_amount' => 'required',
        // 'date_of_unreleased_amount' => 'required',
        'residual_due_amount' => 'required',
        // 'date_of_yojna_start' => 'required',
        // 'date_of_yojna_complete' => 'required',
        'material_progress' => 'required',
        'financial_progress' => 'required',
        // 'comment' => 'required',
        'district_name' => 'required'
      ]);

      if ($validation->fails()) {
        return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
      }

          $data=[
            'month' => $req->month,
            'year' => $req->year,
            'yojna_name' => $req->yojna_name,
            'name_of_executing_agency' => $req->name_of_executing_agency,
            'approval_amount' => $req->approval_amount,
            'unreleased_amount' => $req->unreleased_amount,
            'date_of_unreleased_amount' => $req->date_of_unreleased_amount,
            'residual_due_amount' => $req->residual_due_amount,
            'date_of_yojna_start' => $req->date_of_yojna_start,
            'date_of_yojna_complete' => $req->date_of_yojna_complete,
            'material_progress' => $req->material_progress,
            'financial_progress' => $req->financial_progress,
            'comment' => $req->comment,
            'district_id' => $req->district_name
          ];
      

      if($req->id){
        DB::table('information_khelo_india_yojana')->where('id',$req->id)->update($data);
        return response()->json(['error' => false, 'msg' => "Data Update sucessfully",'url'=>route('khelo_india_yojana')]);
      }else{
        DB::table('information_khelo_india_yojana')->insert($data);
        return response()->json(['error' => false, 'msg' => "Data Saved sucessfully",'url'=>route('khelo_india_yojana')]);
      }
      return response()->json(['error' => false, 'msg' => "Data saved sucessfully"]);
    }

    $district_id_financial = Auth::guard('admin')->user()->district_id;
    $division_id = 0;
    $khelo_india_data = DB::table('information_khelo_india_yojana')
      ->join('hostel_div_district_mapping', 'information_khelo_india_yojana.district_id', '=', 'hostel_div_district_mapping.district_id');
    if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 18) {
      $division = DB::table('hostel_division_master')->select('division_name','id')->orderBy('division_name')->get();
      $districts = DB::table('cities')->select('city', 'id')->where('state_id', '23')->orderBy('city')->get();
    } elseif (Auth::guard('admin')->user()->admin_role == 9) {
      $districts = DB::table('cities')->select('city', 'id')->where('id',  $district_id_financial)->get();
      $division = DB::table('hostel_division_master')
      ->join('hostel_div_district_mapping','hostel_division_master.id','=','hostel_div_district_mapping.division_id')
      ->select('hostel_division_master.division_name','hostel_division_master.id')->where('hostel_div_district_mapping.district_id',$district_id_financial)->orderBy('division_name')->get();
      $khelo_india_data->where('information_khelo_india_yojana.district_id',  $district_id_financial);
    } elseif (Auth::guard('admin')->user()->admin_role == 2) {
      $division_id = Auth::guard('admin')->user()->division_id;
      $division = DB::table('hostel_division_master')->select('division_name','id')->where('hostel_division_master.id',$division_id)->orderBy('division_name')->get();
      $district_list = DB::table('hostel_div_district_mapping')->where('division_id', $division_id)->get();
      $district_id = [];
      foreach ($district_list as $key => $item) {
        $district_id[] = $item->district_id;
      }
      $districts = DB::table('cities')->select('city', 'id')->whereIn('id',  $district_id)->get();
      $khelo_india_data->whereIn('information_khelo_india_yojana.district_id',  $district_id);
    }

    /** filter start */
    if (isset($req->district_name)) {
      $khelo_india_data->where('information_khelo_india_yojana.district_id', $req->district_name);
    }

    if (isset($req->division_name)) {
      $khelo_india_data->where('hostel_div_district_mapping.division_id', $req->division_name);
    }
   
    // if (isset($req->year)) {
    //   $s_year = $req->year;
    //   if($req->year != 'all'){
    //     $khelo_india_data->where('information_khelo_india_yojana.year', $req->year);
    //   }
    // }
    // else{
    //   $s_year = date('Y');
    //   $khelo_india_data->where('information_khelo_india_yojana.year', date('Y'));
    // }

    // if (isset($req->month)) {
    //   $s_month = $req->month;
    //   if($req->month != 'all'){
    //     $khelo_india_data->where('information_khelo_india_yojana.month', $req->month);
    //   }
    // }
    // else{
    //   $s_month = date('m');
    //   $khelo_india_data->where('information_khelo_india_yojana.month', date('m'));
    // }

    

//     if ($req->from_date != '') {
//       $khelo_india_data->whereDate('created_on', '>=', ymd($req->from_date));
//     }
// 
//     if ($req->to_date != '') {
//       $khelo_india_data->whereDate('created_on', '<=', ymd($req->to_date));
//     }
// 
//     if ($req->from_date != '' && $req->to_date != '') {
//       $khelo_india_data->whereBetween('created_on', [ymd($req->from_date), ymd($req->to_date)]);
//     }

// from
    if (isset($req->from_year)) {
      $from_year = $req->from_year;
      if($req->from_year != 'all'){
        $khelo_india_data = $khelo_india_data->where('information_khelo_india_yojana.year', $req->from_year);
      }
    }
    else{
      $from_year = date('Y');
      $khelo_india_data = $khelo_india_data->where('information_khelo_india_yojana.year', date('Y'));
    }

    if (isset($req->from_month)) {
      $from_month = $req->from_month;
      if($req->from_month != 'all'){
      $khelo_india_data = $khelo_india_data->where('information_khelo_india_yojana.month','>=',$req->from_month);
      }
    }
    else{
      $from_month = date('m');
      $khelo_india_data = $khelo_india_data->where('information_khelo_india_yojana.month', date('m'));
    }

    // to
    if (isset($req->to_month)) {
      $to_month = $req->to_month;
      if($req->to_month != 'all'){
      $khelo_india_data = $khelo_india_data->where('information_khelo_india_yojana.month','<=',$req->to_month);
      }
    }
    else{
      $to_month = date('m');
      $khelo_india_data = $khelo_india_data->where('information_khelo_india_yojana.month', date('m'));
    }
    // if (isset($req->to_year)) {
    //   $to_year = $req->to_year;
    //   if($req->to_year != 'all'){
    //     $khelo_india_data = $khelo_india_data->where('information_khelo_india_yojana.year','<=', $req->to_year);
    //   }
    // }
    // else{
    //   $to_year = date('Y');
    //   $khelo_india_data = $khelo_india_data->where('information_khelo_india_yojana.year', date('Y'));
    // }

    /** filter end */

    $khelo_india_data = $khelo_india_data->select('information_khelo_india_yojana.*')->orderBy('hostel_div_district_mapping.division_id', 'ASC')->orderBy('hostel_div_district_mapping.district_id', 'ASC')
    ->orderBy('year', 'DESC')->orderBy('month', 'DESC')
    ->get();
    $ed_data =false;
    if($req->id){
      $ed_data = DB::table('information_khelo_india_yojana')->where('id',$req->id)->first();
    }
    return view('admin.information_details.khelo_india_yojana', ['division' => $division,'districts' => $districts, 'khelo_india_data' => $khelo_india_data, 'division_id' => $division_id, 'district_id_financial' => $district_id_financial,'ed_data'=>$ed_data,'from_year'=>$from_year ,'from_month'=>$from_month,'to_month'=>$to_month ]);
  }


  public function khelo_india_yojana_two(Request $req)
  {

    if ($req->method() == "POST") {
      // dd($req->all());
      $validation = Validator::make($req->all(), [
        'month' => 'required',
        'year' => 'required',
        'district_name' => 'required',
        'yojna_name' => 'required',
        'name_of_executing_agency' => 'required',
        'approved_year' => 'required',
        'government_approved' => 'required',
        'unreleased_amount' => 'required',
        'expected_amount' => 'required',

      ]);

      if ($validation->fails()) {
        return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
      }

        $data=[
          'month' => $req->month,
          'year' => $req->year,
          'district_id' => $req->district_name,
          'yojna_name' => $req->yojna_name,
          'name_of_executing_agency' => $req->name_of_executing_agency,
          'approved_year' => $req->approved_year,
          'government_approved' => $req->government_approved,
          'unreleased_amount' => $req->unreleased_amount,
          'expected_amount' => $req->expected_amount
        ];

      if($req->id){
        DB::table('information_khelo_india_yojana_two')->where('id',$req->id)->update($data);
        return response()->json(['error' => false, 'msg' => "Data Update sucessfully",'url'=>route('khelo_india_yojana_two')]);
      }else{
        DB::table('information_khelo_india_yojana_two')->insert($data);
        return response()->json(['error' => false, 'msg' => "Data Saved sucessfully",'url'=>route('khelo_india_yojana_two')]);
      }
      // return response()->json(['error' => false, 'msg' => "Data saved sucessfully"]);
    }

    $district_id_financial = Auth::guard('admin')->user()->district_id;
    $division_id = 0;
    $khelo_india_yojana_two = DB::table('information_khelo_india_yojana_two')
      ->join('hostel_div_district_mapping', 'information_khelo_india_yojana_two.district_id', '=', 'hostel_div_district_mapping.district_id');
    if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 18) {
      $districts = DB::table('cities')->select('city', 'id')->where('state_id', '23')->orderBy('city')->get();
      $division = DB::table('hostel_division_master')->select('division_name','id')->orderBy('division_name')->get();
    } elseif (Auth::guard('admin')->user()->admin_role == 9) {
      $districts = DB::table('cities')->select('city', 'id')->where('id',  $district_id_financial)->get();
      $division = DB::table('hostel_division_master')
      ->join('hostel_div_district_mapping','hostel_division_master.id','=','hostel_div_district_mapping.division_id')
      ->select('hostel_division_master.division_name','hostel_division_master.id')->where('hostel_div_district_mapping.district_id',$district_id_financial)->orderBy('division_name')->get();
      $khelo_india_yojana_two->where('information_khelo_india_yojana_two.district_id',  $district_id_financial);
    } elseif (Auth::guard('admin')->user()->admin_role == 2) {
      $division_id = Auth::guard('admin')->user()->division_id;
      $division = DB::table('hostel_division_master')->select('division_name','id')->where('hostel_division_master.id',$division_id)->orderBy('division_name')->get();
      $district_list = DB::table('hostel_div_district_mapping')->where('division_id', $division_id)->get();
      $district_id = [];
      foreach ($district_list as $key => $item) {
        $district_id[] = $item->district_id;
      }
      $districts = DB::table('cities')->select('city', 'id')->whereIn('id',  $district_id)->get();
      $khelo_india_yojana_two->whereIn('information_khelo_india_yojana_two.district_id',  $district_id);
    }

    /** filter start */
    if (isset($req->district_name)) {
      $khelo_india_yojana_two->where('information_khelo_india_yojana_two.district_id', $req->district_name);
    }

    if (isset($req->division_name)) {
      $khelo_india_yojana_two->where('hostel_div_district_mapping.division_id', $req->division_name);
    }
//     if (isset($req->year)) {
//       $s_year = $req->year;
//       if($req->year != 'all'){
//         $khelo_india_yojana_two->where('information_khelo_india_yojana_two.year', $req->year);
//       }
//     }
//     else{
//       $s_year = date('Y');
//       $khelo_india_yojana_two->where('information_khelo_india_yojana_two.year', date('Y'));
//     }
// 
//     if (isset($req->month)) {
//       $s_month = $req->month;
//       if($req->month != 'all'){
//         $khelo_india_yojana_two->where('information_khelo_india_yojana_two.month', $req->month);
//       }
//     }
//     else{
//       $s_month = date('m');
//       $khelo_india_yojana_two->where('information_khelo_india_yojana_two.month', date('m'));
//     }
//     if ($req->from_date != '') {
//       $khelo_india_yojana_two->whereDate('created_on', '>=', ymd($req->from_date));
//     }
// 
//     if ($req->to_date != '') {
//       $khelo_india_yojana_two->whereDate('created_on', '<=', ymd($req->to_date));
//     }
// 
//     if ($req->from_date != '' && $req->to_date != '') {
//       $khelo_india_yojana_two->whereBetween('created_on', [ymd($req->from_date), ymd($req->to_date)]);
//     }
      if (isset($req->from_year)) {
        $from_year = $req->from_year;
        if($req->from_year != 'all'){
          $khelo_india_yojana_two = $khelo_india_yojana_two->where('information_khelo_india_yojana_two.year','>=', $req->from_year);
        }
      }
      else{
        $from_year = date('Y');
        $khelo_india_yojana_two = $khelo_india_yojana_two->where('information_khelo_india_yojana_two.year', date('Y'));
      }

      if (isset($req->from_month)) {
        $from_month = $req->from_month;
        if($req->from_month != 'all'){
        $khelo_india_yojana_two = $khelo_india_yojana_two->where('information_khelo_india_yojana_two.month','>=',$req->from_month);
        }
      }
      else{
        $from_month = date('m');
        $khelo_india_yojana_two = $khelo_india_yojana_two->where('information_khelo_india_yojana_two.month', date('m'));
      }

      // to
      if (isset($req->to_month)) {
        $to_month = $req->to_month;
        if($req->to_month != 'all'){
        $khelo_india_yojana_two = $khelo_india_yojana_two->where('information_khelo_india_yojana_two.month','<=',$req->to_month);
        }
      }
      else{
        $to_month = date('m');
        $khelo_india_yojana_two = $khelo_india_yojana_two->where('information_khelo_india_yojana_two.month', date('m'));
      }
      // if (isset($req->to_year)) {
      //   $to_year = $req->to_year;
      //   if($req->to_year != 'all'){
      //     $khelo_india_yojana_two = $khelo_india_yojana_two->where('information_khelo_india_yojana_two.year','<=', $req->to_year);
      //   }
      // }
      // else{
      //   $to_year = date('Y');
      //   $khelo_india_yojana_two = $khelo_india_yojana_two->where('information_khelo_india_yojana_two.year', date('Y'));
      // }
    /** filter end */

    $khelo_india_yojana_two = $khelo_india_yojana_two->select('information_khelo_india_yojana_two.*')->orderBy('hostel_div_district_mapping.division_id', 'ASC')->orderBy('hostel_div_district_mapping.district_id', 'ASC')
    ->orderBy('year', 'DESC')->orderBy('month', 'DESC')
    ->get();
    $ed_data =false;
    if($req->id){
      $ed_data = DB::table('information_khelo_india_yojana_two')->where('id',$req->id)->first();
    }
    return view('admin.information_details.khelo_india_yojana_two', ['division' => $division,'districts' => $districts, 'khelo_india_yojana_two' => $khelo_india_yojana_two, 'division_id' => $division_id, 'district_id_financial' => $district_id_financial,'ed_data'=>$ed_data,'from_year'=>$from_year ,'from_month'=>$from_month,'to_month'=>$to_month ]);
  }

  public function rajasv_praptiya(Request $req)
  {

 
    if ($req->method() == "POST") {
      // dd($req->all());
      $validation = Validator::make($req->all(), [
        'month_name' => 'required',
        'year' => 'required',
        'district_id' => 'required',
        'prasikshan' => 'required',
        'aarakshan' => 'required',
        'chatravas' => 'required',
        'shokiya' => 'required',
        'tarantal' => 'required',
        'any_praptiya' => 'required',
        'mah_me_rajasv_praptiya' => 'required',
        'pichala_yog' => 'required',
        'varsh_ka_pragami_yog' => 'required',
        'vigat_varsh_isi_mah_tak' => 'required',
        'increment' => 'required',
        'decrement' => 'required',
      ]);

      if ($validation->fails()) {
        return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
      }

      $data=[
        'month_name' => $req->month_name,
        'year' => $req->year,
        'district_id' => $req->district_id,
        'prasikshan' => $req->prasikshan,
        'aarakshan' => $req->aarakshan,
        'chatravas' => $req->chatravas,
        'shokiya' => $req->shokiya,
        'tarantal' => $req->tarantal,
        'any_praptiya' => $req->any_praptiya,
        'mah_me_rajasv_praptiya' => $req->mah_me_rajasv_praptiya,
        'pichala_yog' => $req->pichala_yog,
        'varsh_ka_pragami_yog' => $req->varsh_ka_pragami_yog,
        'vigat_varsh_isi_mah_tak' => $req->vigat_varsh_isi_mah_tak,
        'increment' => $req->increment,
        'decrement' => $req->decrement
      ];

  

      if($req->id){
        DB::table('information_rajasv_praptiya')->where('id',$req->id)->update($data);
        return response()->json(['error' => false, 'msg' => "Data Update sucessfully",'url'=>route('rajasv_praptiya')]);
      }else{
        DB::table('information_rajasv_praptiya')->insert($data);
        return response()->json(['error' => false, 'msg' => "Data Saved sucessfully",'url'=>route('rajasv_praptiya')]);
      }
      // return response()->json(['error' => false, 'msg' => "Data saved sucessfully"]);
    }

    $district_id_departmental = Auth::guard('admin')->user()->district_id;

    $admin_id = Auth::guard('admin')->user()->admin_role;
    $sports = DB::table('sport_type')->orderBy('name', 'ASC')->get();
    $divisions = DivisionModel::select('division_name', 'id')->get();
    $division_id = 0;
    $tehsils = DB::table('tehsil_master')->select('Tehsil_Name', 'id')->where('dist_id', $district_id_departmental)->get();
    $rajasv_praptiya = DB::table('information_rajasv_praptiya')
      ->join('hostel_div_district_mapping', 'information_rajasv_praptiya.district_id', '=', 'hostel_div_district_mapping.district_id');
    if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 18) {
      $division = DB::table('hostel_division_master')->select('division_name','id')->orderBy('division_name')->get();
      $districts = DB::table('cities')->select('city', 'id')->where('state_id', '23')->orderBy('city')->get();
    } elseif (Auth::guard('admin')->user()->admin_role == 9) {
      $division = DB::table('hostel_division_master')
      ->join('hostel_div_district_mapping','hostel_division_master.id','=','hostel_div_district_mapping.division_id')
      ->select('hostel_division_master.division_name','hostel_division_master.id')->where('hostel_div_district_mapping.district_id',$district_id_departmental)->orderBy('division_name')->get();
      $districts = DB::table('cities')->select('city', 'id')->where('id',  $district_id_departmental)->get();
      $rajasv_praptiya->where('information_rajasv_praptiya.district_id',  $district_id_departmental);
    } elseif (Auth::guard('admin')->user()->admin_role == 2) {
      $division_id = Auth::guard('admin')->user()->division_id;
      $division = DB::table('hostel_division_master')->select('division_name','id')->where('hostel_division_master.id',$division_id)->orderBy('division_name')->get();
      $district_list = DB::table('hostel_div_district_mapping')->where('division_id', $division_id)->get();
      $district_id = [];
      foreach ($district_list as $key => $item) {
        $district_id[] = $item->district_id;
      }
      $rajasv_praptiya->whereIn('information_rajasv_praptiya.district_id',  $district_id);
      $districts = DB::table('cities')->select('city', 'id')->whereIn('id',  $district_id)->get();
    }
    /** filter start */
    if (isset($req->district_name)) {
      $rajasv_praptiya->where('information_rajasv_praptiya.district_id', $req->district_name);
    }
    if (isset($req->division_name)) {
      $rajasv_praptiya->where('hostel_div_district_mapping.division_id', $req->division_name);
    }
    // dd( $req->from_date);
    
    
    if(!empty($req->from_date) && $req->from_date !== 'all') {
        $from = DateTime::createFromFormat('d-m-Y', $req->from_date);
        $fromYear = $from->format('Y');
        $fromMonth = $from->format('m');

        $rajasv_praptiya->where(function ($query) use ($fromYear, $fromMonth) {
            $query->where('information_rajasv_praptiya.year', '>', $fromYear)
                  ->orWhere(function ($q) use ($fromYear, $fromMonth) {
                      $q->where('information_rajasv_praptiya.year', '=', $fromYear)
                        ->where('information_rajasv_praptiya.month_name', '>=', $fromMonth);
                  });
        });
    }elseif(empty($req->from_date)){
        $fromYear =  date('Y');
        $fromMonth =  date('m');
        $rajasv_praptiya->where(function ($query) use ($fromYear, $fromMonth) {
            $query->where('information_rajasv_praptiya.year', '>', $fromYear)
                  ->orWhere(function ($q) use ($fromYear, $fromMonth) {
                      $q->where('information_rajasv_praptiya.year', '=', $fromYear)
                        ->where('information_rajasv_praptiya.month_name', '=', $fromMonth);
                  });
        });
    }

    if(!empty($req->to_date) && $req->to_date !== 'all') {
        $to = DateTime::createFromFormat('d-m-Y', $req->to_date);
        $toYear = $to->format('Y');
        $toMonth = $to->format('m');

        $rajasv_praptiya->where(function ($query) use ($toYear, $toMonth) {
            $query->where('information_rajasv_praptiya.year', '<', $toYear)
                  ->orWhere(function ($q) use ($toYear, $toMonth) {
                      $q->where('information_rajasv_praptiya.year', '=', $toYear)
                        ->where('information_rajasv_praptiya.month_name', '<=', $toMonth);
                  });
        });
    }elseif(empty($req->to_date)){
        $toYear =  date('Y');
        $toMonth =  date('m');
        $rajasv_praptiya->where(function ($query) use ($toYear, $toMonth) {
            $query->where('information_rajasv_praptiya.year', '>', $toYear)
                  ->orWhere(function ($q) use ($toYear, $toMonth) {
                      $q->where('information_rajasv_praptiya.year', '=', $toYear)
                        ->where('information_rajasv_praptiya.month_name', '=', $toMonth);
                  });
        });
    }
    // else{
    //   $f_year = date('Y');
    //   $rajasv_praptiya->where('information_rajasv_praptiya.year', date('Y'));
    // }

    // if (isset($req->to_year)) {
    //   $t_year = $req->to_year;
    //   if($req->to_year != 'all'){
    //     $rajasv_praptiya->where('information_rajasv_praptiya.year','<=',$req->to_year);
    //   }
    // }
    // else{
    //   $t_year = date('Y');
    //   $rajasv_praptiya->where('information_rajasv_praptiya.year', date('Y'));
    // }
    // if (isset($req->month)) {
    //   $s_month = $req->month;
    //   if($req->month != 'all'){
    //     $rajasv_praptiya->where('information_rajasv_praptiya.month_name', $req->month);
    //   }
    // }
    // else{
    //   $s_month = date('m');
    //   $rajasv_praptiya->where('information_rajasv_praptiya.month_name', date('m'));
    // }

    // if (isset($req->from_month)) {
    //   $from_month = $req->from_month;
    //   if($req->from_month != 'all'){
    //   $rajasv_praptiya->where('information_rajasv_praptiya.month_name','>=',$req->from_month);
    //   }
    // }
    // else{
    //   $from_month = date('m');
    //   $rajasv_praptiya->where('information_rajasv_praptiya.month_name', date('m'));
    // }

    // to
    // if (isset($req->to_month)) {
    //   $to_month = $req->to_month;
    //   if($req->to_month != 'all'){
    //   $rajasv_praptiya->where('information_rajasv_praptiya.month_name','<=',$req->to_month);
    //   }
    // }
    // else{
    //   $to_month = date('m');
    //   $rajasv_praptiya->where('information_rajasv_praptiya.month_name', date('m'));
    // }

    // if ($req->from_date != '') {
    //   $rajasv_praptiya->whereDate('created_at', '>=', ymd($req->from_date));
    // }

    // if ($req->to_date != '') {
    //   $rajasv_praptiya->whereDate('created_at', '<=', ymd($req->to_date));
    // }

    // if ($req->from_date != '' && $req->to_date != '') {
    //   $rajasv_praptiya->whereBetween('created_at', [ymd($req->from_date), ymd($req->to_date)]);
    // }
    /** filter end */
    $rajasv_praptiya = $rajasv_praptiya->select('information_rajasv_praptiya.*')->orderBy('hostel_div_district_mapping.division_id', 'ASC')->orderBy('hostel_div_district_mapping.district_id', 'ASC')
    ->orderBy('year', 'ASC')->orderBy('month_name', 'ASC')
    ->get();
    $ed_data =false;
    if($req->id){
      $ed_data = DB::table('information_rajasv_praptiya')->where('id',$req->id)->first();
    }
    return view('admin.information_details.rajasv_praptiya', ['division' => $division,'rajasv_praptiya' => $rajasv_praptiya, 'districts' => $districts, 'divisions' => $divisions, 'tehsils' => $tehsils, 'division_id' => $division_id, 'district_id_departmental' => $district_id_departmental, 'admin_id' => $admin_id, 'sports' => $sports,'ed_data'=>$ed_data]);
  }


  public function kreeda_chatravas(Request $req)
  {

    if ($req->method() == "POST") {
      // dd($req->all());
      $validation = Validator::make($req->all(), [
        'month_name' => 'required',
        'year' => 'required',
        'district_id' => 'required',
        'sport_id' => 'required',
        'accepted_number' => 'required',
        'current_number' => 'required',
        'national_achievement' => 'required',
        'international_achievement' => 'required'
      ]);

      if ($validation->fails()) {
        return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
      }

      $data=[
        'month_name' => $req->month_name,
        'year' => $req->year,
        'district_id' => $req->district_id,
        'sport_id' => $req->sport_id,
        'accepted_number' => $req->accepted_number,
        'current_number' => $req->current_number,
        'national_achievement' => $req->national_achievement,
        'international_achievement' => $req->international_achievement,
        'comment' => $req->comment
      ];

      if($req->id){
        DB::table('information_kreeda_chatravas')->where('id',$req->id)->update($data);
        return response()->json(['error' => false, 'msg' => "Data Update sucessfully",'url'=>route('kreeda_chatravas')]);
      }else{
        DB::table('information_kreeda_chatravas')->insert($data);
        return response()->json(['error' => false, 'msg' => "Data Saved sucessfully",'url'=>route('kreeda_chatravas')]);
      }
      // return response()->json(['error' => false, 'msg' => "Data saved sucessfully"]);
    }

    $district_id_departmental = Auth::guard('admin')->user()->district_id;

    $admin_id = Auth::guard('admin')->user()->admin_role;
    $sports = DB::table('sport_type')->orderBy('name', 'ASC')->get();
    $divisions = DivisionModel::select('division_name', 'id')->get();
    $division_id = 0;
    $tehsils = DB::table('tehsil_master')->select('Tehsil_Name', 'id')->where('dist_id', $district_id_departmental)->get();
    $kreeda_chatravas = DB::table('information_kreeda_chatravas')
      ->join('hostel_div_district_mapping', 'information_kreeda_chatravas.district_id', '=', 'hostel_div_district_mapping.district_id');
    if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 18) {
      $division = DB::table('hostel_division_master')->select('division_name','id')->orderBy('division_name')->get();
      $districts = DB::table('cities')->select('city', 'id')->where('state_id', '23')->orderBy('city')->get();
    } elseif (Auth::guard('admin')->user()->admin_role == 9) {
      $districts = DB::table('cities')->select('city', 'id')->where('id',  $district_id_departmental)->get();
      $division = DB::table('hostel_division_master')
      ->join('hostel_div_district_mapping','hostel_division_master.id','=','hostel_div_district_mapping.division_id')
      ->select('hostel_division_master.division_name','hostel_division_master.id')->where('hostel_div_district_mapping.district_id',$district_id_departmental)->orderBy('division_name')->get();
      $kreeda_chatravas->where('information_kreeda_chatravas.district_id',  $district_id_departmental);
    } elseif (Auth::guard('admin')->user()->admin_role == 2) {
      $division_id = Auth::guard('admin')->user()->division_id;
      $division = DB::table('hostel_division_master')->select('division_name','id')->where('hostel_division_master.id',$division_id)->orderBy('division_name')->get();
      $district_list = DB::table('hostel_div_district_mapping')->where('division_id', $division_id)->get();
      $district_id = [];
      foreach ($district_list as $key => $item) {
        $district_id[] = $item->district_id;
      }
      $kreeda_chatravas->whereIn('information_kreeda_chatravas.district_id',  $district_id);
      $districts = DB::table('cities')->select('city', 'id')->whereIn('id',  $district_id)->get();
    }
    /** filter start */
    if (isset($req->district_name)) {
      $kreeda_chatravas->where('information_kreeda_chatravas.district_id', $req->district_name);
    }
    if (isset($req->division_name)) {
      $kreeda_chatravas->where('hostel_div_district_mapping.division_id', $req->division_name);
    }
    if (isset($req->year)) {
      $s_year = $req->year;
      if($req->year != 'all'){
        $kreeda_chatravas->where('information_kreeda_chatravas.year', $req->year);
      }
    }
    else{
      $s_year = date('Y');
      $kreeda_chatravas->where('information_kreeda_chatravas.year', date('Y'));
    }
    // if (isset($req->month)) {
    //   $s_month = $req->month;
    //   if($req->month != 'all'){
    //     $kreeda_chatravas->where('information_kreeda_chatravas.month_name', $req->month);
    //   }
    // }
    // else{
    //   $s_month = date('m');
    //   $kreeda_chatravas->where('information_kreeda_chatravas.month_name', date('m'));
    // }
    if (isset($req->from_month)) {
      $from_month = $req->from_month;
      if($req->from_month != 'all'){
      $kreeda_chatravas->where('information_kreeda_chatravas.month_name','>=',$req->from_month);
      }
    }
    else{
      $from_month = date('m');
      $kreeda_chatravas->where('information_kreeda_chatravas.month_name', date('m'));
    }

    // to
    if (isset($req->to_month)) {
      $to_month = $req->to_month;
      if($req->to_month != 'all'){
      $kreeda_chatravas->where('information_kreeda_chatravas.month_name','<=',$req->to_month);
      }
    }
    else{
      $to_month = date('m');
      $kreeda_chatravas->where('information_kreeda_chatravas.month_name', date('m'));
    }
    if ($req->from_date != '') {
      $kreeda_chatravas->whereDate('created_at', '>=', ymd($req->from_date));
    }

    if ($req->to_date != '') {
      $kreeda_chatravas->whereDate('created_at', '<=', ymd($req->to_date));
    }

    if ($req->from_date != '' && $req->to_date != '') {
      $kreeda_chatravas->whereBetween('created_at', [ymd($req->from_date), ymd($req->to_date)]);
    }
    /** filter end */
    $kreeda_chatravas = $kreeda_chatravas->select('information_kreeda_chatravas.*')->orderBy('hostel_div_district_mapping.division_id', 'ASC')->orderBy('hostel_div_district_mapping.district_id', 'ASC')
    ->orderBy('year', 'DESC')->orderBy('month_name', 'DESC')
    ->get();
    $ed_data =false;
    if($req->id){
      $ed_data = DB::table('information_kreeda_chatravas')->where('id',$req->id)->first();
    }
    return view('admin.information_details.kreeda_chatravas', ['division' => $division,'kreeda_chatravas' => $kreeda_chatravas, 'districts' => $districts, 'divisions' => $divisions, 'tehsils' => $tehsils, 'division_id' => $division_id, 'district_id_departmental' => $district_id_departmental, 'admin_id' => $admin_id, 'sports' => $sports,'ed_data'=>$ed_data,'s_year'=>$s_year ,'to_month'=>$to_month,'from_month'=>$from_month]);
  }

  public function prashikshan(Request $req)
  {

    if ($req->method() == "POST") {
      // dd($req->all());
      $validation = Validator::make($req->all(), [
        'month_name' => 'required',
        'year' => 'required',
        'district_id' => 'required',
        'sport_id' => 'required',
        'instructor_name' => 'required',
        'departmental_part_time' => 'required',
        'standard_number' => 'required',
        'current_boys' => 'required',
        'current_girls' => 'required',
        'sum_boys_girls' => 'required',
        'national_achievement' => 'required',
        'international_achievement' => 'required',
      ]);

      if ($validation->fails()) {
        return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
      }


      $data=[
        'month_name' => $req->month_name,
        'year' => $req->year,
        'district_id' => $req->district_id,
        'sport_id' => $req->sport_id,
        'instructor_name' => $req->instructor_name,
        'departmental_part_time' => $req->departmental_part_time,
        'standard_number' => $req->standard_number,
        'current_boys' => $req->current_boys,
        'current_girls' => $req->current_girls,
        'sum_boys_girls' => $req->current_girls + $req->current_boys,
        'national_achievement' => $req->national_achievement,
        'international_achievement' => $req->international_achievement,
        'comment' => $req->comment,
      ];
      if($req->id){
        DB::table('information_prashikshan')->where('id',$req->id)->update($data);
        return response()->json(['error' => false, 'msg' => "Data Update sucessfully",'url'=>route('prashikshan')]);
      }else{
        DB::table('information_prashikshan')->insert($data);
        return response()->json(['error' => false, 'msg' => "Data Saved sucessfully",'url'=>route('prashikshan')]);
      }
      // return response()->json(['error' => false, 'msg' => "Data saved sucessfully"]);
    }

    $district_id_departmental = Auth::guard('admin')->user()->district_id;

    $admin_id = Auth::guard('admin')->user()->admin_role;
    $sports = DB::table('sport_type')->orderBy('name', 'ASC')->get();
    $divisions = DivisionModel::select('division_name', 'id')->get();
    $division_id = 0;
    $tehsils = DB::table('tehsil_master')->select('Tehsil_Name', 'id')->where('dist_id', $district_id_departmental)->get();
    $prashikshan = DB::table('information_prashikshan')
      ->join('hostel_div_district_mapping', 'information_prashikshan.district_id', '=', 'hostel_div_district_mapping.district_id');
    if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 18) {
      $division = DB::table('hostel_division_master')->select('division_name','id')->orderBy('division_name')->get();
      $districts = DB::table('cities')->select('city', 'id')->where('state_id', '23')->orderBy('city')->get();
    } elseif (Auth::guard('admin')->user()->admin_role == 9) {
      $districts = DB::table('cities')->select('city', 'id')->where('id',  $district_id_departmental)->get();
      $division = DB::table('hostel_division_master')
      ->join('hostel_div_district_mapping','hostel_division_master.id','=','hostel_div_district_mapping.division_id')
      ->select('hostel_division_master.division_name','hostel_division_master.id')->where('hostel_div_district_mapping.district_id',$district_id_departmental)->orderBy('division_name')->get();
      $prashikshan->where('information_prashikshan.district_id',  $district_id_departmental);
    } elseif (Auth::guard('admin')->user()->admin_role == 2) {
      $division_id = Auth::guard('admin')->user()->division_id;
      $division = DB::table('hostel_division_master')->select('division_name','id')->where('hostel_division_master.id',$division_id)->orderBy('division_name')->get();
      $district_list = DB::table('hostel_div_district_mapping')->where('division_id', $division_id)->get();
      $district_id = [];
      foreach ($district_list as $key => $item) {
        $district_id[] = $item->district_id;
      }
      $prashikshan->whereIn('information_prashikshan.district_id',  $district_id);
      $districts = DB::table('cities')->select('city', 'id')->whereIn('id',  $district_id)->get();
    }
    /** filter start */
    if (isset($req->district_name)) {
      $prashikshan->where('information_prashikshan.district_id', $req->district_name);
    }
    if (isset($req->division_name)) {
      $prashikshan->where('hostel_div_district_mapping.division_id', $req->division_name);
    }
    if (isset($req->year)) {
      $s_year = $req->year;
      if($req->year != 'all'){
        $prashikshan->where('information_prashikshan.year', $req->year);
      }
    }
    else{
      $s_year = date('Y');
      $prashikshan->where('information_prashikshan.year', date('Y'));
    }
    // if (isset($req->month)) {
    //   $s_month = $req->month;
    //   if($req->month != 'all'){
    //     $prashikshan->where('information_prashikshan.month_name', $req->month);
    //   }
    // }
    // else{
    //   $s_month = date('m');
    //   $prashikshan->where('information_prashikshan.month_name', date('m'));
    // }
    if (isset($req->from_month)) {
      $from_month = $req->from_month;
      if($req->from_month != 'all'){
      $prashikshan->where('information_prashikshan.month_name','>=',$req->from_month);
      }
    }
    else{
      $from_month = date('m');
      $prashikshan->where('information_prashikshan.month_name', date('m'));
    }

    // to
    if (isset($req->to_month)) {
      $to_month = $req->to_month;
      if($req->to_month != 'all'){
      $prashikshan->where('information_prashikshan.month_name','<=',$req->to_month);
      }
    }
    else{
      $to_month = date('m');
      $prashikshan->where('information_prashikshan.month_name', date('m'));
    }
    if ($req->from_date != '') {
      $prashikshan->whereDate('created_at', '>=', ymd($req->from_date));
    }

    if ($req->to_date != '') {
      $prashikshan->whereDate('created_at', '<=', ymd($req->to_date));
    }

    if ($req->from_date != '' && $req->to_date != '') {
      $prashikshan->whereBetween('created_at', [ymd($req->from_date), ymd($req->to_date)]);
    }
    /** filter end */
    $prashikshan = $prashikshan->select('information_prashikshan.*')->orderBy('hostel_div_district_mapping.division_id', 'ASC')->orderBy('hostel_div_district_mapping.district_id', 'ASC')
    ->orderBy('year', 'DESC')->orderBy('month_name', 'DESC')
    ->get();
    $ed_data =false;
    if($req->id){
      $ed_data = DB::table('information_prashikshan')->where('id',$req->id)->first();
    }
    return view('admin.information_details.prashikshan', ['division' => $division,'prashikshan' => $prashikshan, 'districts' => $districts, 'divisions' => $divisions, 'tehsils' => $tehsils, 'division_id' => $division_id, 'district_id_departmental' => $district_id_departmental, 'admin_id' => $admin_id, 'sports' => $sports,'ed_data'=>$ed_data,'s_year'=>$s_year ,'to_month'=>$to_month,'from_month'=>$from_month]);
  }

  public function kheloindiyacentar(Request $req)
  {

    if ($req->method() == "POST") {
      // dd($req->all());
      $validation = Validator::make($req->all(), [
        'month_name' => 'required',
        'year' => 'required',
        'district_id' => 'required',
        'sport_id' => 'required',
      ]);

      if ($validation->fails()) {
        return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
      }


      $data=[
        'month_name' => $req->month_name,
        'year' => $req->year,
        'district_id' => $req->district_id,
        'sport_id' => $req->sport_id,

        'comment' => $req->comment,
      ];
      if($req->id){
        DB::table('information_kheloindiyacentar')->where('id',$req->id)->update($data);
        return response()->json(['error' => false, 'msg' => "Data Update sucessfully",'url'=>route('kheloindiyacentar')]);
      }else{
        DB::table('information_kheloindiyacentar')->insert($data);
        return response()->json(['error' => false, 'msg' => "Data Saved sucessfully",'url'=>route('kheloindiyacentar')]);
      }
      // return response()->json(['error' => false, 'msg' => "Data saved sucessfully"]);
    }

    $district_id_departmental = Auth::guard('admin')->user()->district_id;

    $admin_id = Auth::guard('admin')->user()->admin_role;
    $sports = DB::table('sport_type')->orderBy('name', 'ASC')->get();
    $divisions = DivisionModel::select('division_name', 'id')->get();
    $division_id = 0;
    $tehsils = DB::table('tehsil_master')->select('Tehsil_Name', 'id')->where('dist_id', $district_id_departmental)->get();
    $kheloindiyacentar = DB::table('information_kheloindiyacentar')
      ->join('hostel_div_district_mapping', 'information_kheloindiyacentar.district_id', '=', 'hostel_div_district_mapping.district_id');
    if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 18) {
      $division = DB::table('hostel_division_master')->select('division_name','id')->orderBy('division_name')->get();
      $districts = DB::table('cities')->select('city', 'id')->where('state_id', '23')->orderBy('city')->get();
    } elseif (Auth::guard('admin')->user()->admin_role == 9) {
      $division = DB::table('hostel_division_master')
      ->join('hostel_div_district_mapping','hostel_division_master.id','=','hostel_div_district_mapping.division_id')
      ->select('hostel_division_master.division_name','hostel_division_master.id')->where('hostel_div_district_mapping.district_id',$district_id_departmental)->orderBy('division_name')->get();
      $districts = DB::table('cities')->select('city', 'id')->where('id',  $district_id_departmental)->get();
      $kheloindiyacentar->where('information_kheloindiyacentar.district_id',  $district_id_departmental);
    } elseif (Auth::guard('admin')->user()->admin_role == 2) {
      $division_id = Auth::guard('admin')->user()->division_id;
      $division = DB::table('hostel_division_master')->select('division_name','id')->where('hostel_division_master.id',$division_id)->orderBy('division_name')->get();
      $district_list = DB::table('hostel_div_district_mapping')->where('division_id', $division_id)->get();
      $district_id = [];
      foreach ($district_list as $key => $item) {
        $district_id[] = $item->district_id;
      }
      $kheloindiyacentar->whereIn('information_kheloindiyacentar.district_id',  $district_id);
      $districts = DB::table('cities')->select('city', 'id')->whereIn('id',  $district_id)->get();
    }
    /** filter start */
    if (isset($req->district_name)) {
      $kheloindiyacentar->where('information_kheloindiyacentar.district_id', $req->district_name);
    }
    if (isset($req->division_name)) {
      $kheloindiyacentar->where('hostel_div_district_mapping.division_id', $req->division_name);
    }
    if (isset($req->year)) {
      $s_year = $req->year;
      if($req->year != 'all'){
        $kheloindiyacentar->where('information_kheloindiyacentar.year', $req->year);
      }
    }
    else{
      $s_year = date('Y');
      $kheloindiyacentar->where('information_kheloindiyacentar.year', date('Y'));
    }
    // if (isset($req->month)) {
    //   $s_month = $req->month;
    //   if($req->month != 'all'){
    //     $kheloindiyacentar->where('information_kheloindiyacentar.month_name', $req->month);
    //   }
    // }
    // else{
    //   $s_month = date('m');
    //   $kheloindiyacentar->where('information_kheloindiyacentar.month_name', date('m'));
    // }
    if (isset($req->from_month)) {
      $from_month = $req->from_month;
      if($req->from_month != 'all'){
      $kheloindiyacentar->where('information_kheloindiyacentar.month_name','>=',$req->from_month);
      }
    }
    else{
      $from_month = date('m');
      $kheloindiyacentar->where('information_kheloindiyacentar.month_name', date('m'));
    }

    // to
    if (isset($req->to_month)) {
      $to_month = $req->to_month;
      if($req->to_month != 'all'){
      $kheloindiyacentar->where('information_kheloindiyacentar.month_name','<=',$req->to_month);
      }
    }
    else{
      $to_month = date('m');
      $kheloindiyacentar->where('information_kheloindiyacentar.month_name', date('m'));
    }
    if ($req->from_date != '') {
      $kheloindiyacentar->whereDate('created_at', '>=', ymd($req->from_date));
    }

    if ($req->to_date != '') {
      $kheloindiyacentar->whereDate('created_at', '<=', ymd($req->to_date));
    }

    if ($req->from_date != '' && $req->to_date != '') {
      $kheloindiyacentar->whereBetween('created_at', [ymd($req->from_date), ymd($req->to_date)]);
    }
    /** filter end */
    $kheloindiyacentar = $kheloindiyacentar->select('information_kheloindiyacentar.*')->orderBy('hostel_div_district_mapping.division_id', 'ASC')->orderBy('hostel_div_district_mapping.district_id', 'ASC')
    ->orderBy('year', 'DESC')->orderBy('month_name', 'DESC')
    ->get();
    $ed_data =false;
    if($req->id){
      $ed_data = DB::table('information_kheloindiyacentar')->where('id',$req->id)->first();
    }
    return view('admin.information_details.kheloindiyacentar', ['division' => $division,'kheloindiyacentar' => $kheloindiyacentar, 'districts' => $districts, 'divisions' => $divisions, 'tehsils' => $tehsils, 'division_id' => $division_id, 'district_id_departmental' => $district_id_departmental, 'admin_id' => $admin_id, 'sports' => $sports,'ed_data'=>$ed_data,'s_year'=>$s_year ,'to_month'=>$to_month,'from_month'=>$from_month]);
  }

  public function pratiyogitaonKaAayojan(Request $req)
  {

    if ($req->method() == "POST") {
      // dd($req->all());
      $validation = Validator::make($req->all(), [
        'month_name' => 'required',
        'year' => 'required',
        'district_id' => 'required',
        'competition_name' => 'required',
        // 'event_date' => 'required',
        'participants_boys' => 'required',
        'participants_girls' => 'required',
        'participants_total' => 'required',
        'amount_spent' => 'required',
      ]);

      if ($validation->fails()) {
        return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
      }


      $data=[
        'month_name' => $req->month_name,
        'year' => $req->year,
        'district_id' => $req->district_id,
        'competition_name' => $req->competition_name,
        'event_date' => $req->event_date,
        'participants_boys' => $req->participants_boys,
        'participants_girls' => $req->participants_girls,
        'participants_total' => $req->participants_boys + $req->participants_girls,
        'sponsor_name' => $req->sponsor_name,
        'amount_spent' => $req->amount_spent,
        'comment' => $req->comment,
      ];
      if($req->id){
        DB::table('information_pratiyogitaonkaaayojan')->where('id',$req->id)->update($data);
        return response()->json(['error' => false, 'msg' => "Data Update sucessfully",'url'=>route('pratiyogitaonKaAayojan')]);
      }else{
        DB::table('information_pratiyogitaonkaaayojan')->insert($data);
        return response()->json(['error' => false, 'msg' => "Data Saved sucessfully",'url'=>route('pratiyogitaonKaAayojan')]);
      }
     
    }

    $district_id_departmental = Auth::guard('admin')->user()->district_id;

    $admin_id = Auth::guard('admin')->user()->admin_role;
    $sports = DB::table('sport_type')->orderBy('name', 'ASC')->get();
    $divisions = DivisionModel::select('division_name', 'id')->get();
    $division_id = 0;
    $tehsils = DB::table('tehsil_master')->select('Tehsil_Name', 'id')->where('dist_id', $district_id_departmental)->get();
    $pratiyogitaonKaAayojan = DB::table('information_pratiyogitaonkaaayojan')
      ->join('hostel_div_district_mapping', 'information_pratiyogitaonkaaayojan.district_id', '=', 'hostel_div_district_mapping.district_id');
    if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 18) {
      $division = DB::table('hostel_division_master')->select('division_name','id')->orderBy('division_name')->get();
      $districts = DB::table('cities')->select('city', 'id')->where('state_id', '23')->orderBy('city')->get();
    } elseif (Auth::guard('admin')->user()->admin_role == 9) {
      $division = DB::table('hostel_division_master')
      ->join('hostel_div_district_mapping','hostel_division_master.id','=','hostel_div_district_mapping.division_id')
      ->select('hostel_division_master.division_name','hostel_division_master.id')->where('hostel_div_district_mapping.district_id',$district_id_departmental)->orderBy('division_name')->get();
      $districts = DB::table('cities')->select('city', 'id')->where('id',  $district_id_departmental)->get();
      $pratiyogitaonKaAayojan->where('information_pratiyogitaonkaaayojan.district_id',  $district_id_departmental);
    } elseif (Auth::guard('admin')->user()->admin_role == 2) {
      $division_id = Auth::guard('admin')->user()->division_id;
      $division = DB::table('hostel_division_master')->select('division_name','id')->where('hostel_division_master.id',$division_id)->orderBy('division_name')->get();
      $district_list = DB::table('hostel_div_district_mapping')->where('division_id', $division_id)->get();
      $district_id = [];
      foreach ($district_list as $key => $item) {
        $district_id[] = $item->district_id;
      }
      $pratiyogitaonKaAayojan->whereIn('information_pratiyogitaonkaaayojan.district_id',  $district_id);
      $districts = DB::table('cities')->select('city', 'id')->whereIn('id',  $district_id)->get();
    }
    /** filter start */
    if (isset($req->district_name)) {
      $pratiyogitaonKaAayojan->where('information_pratiyogitaonkaaayojan.district_id', $req->district_name);
    }
    if (isset($req->division_name)) {
      $pratiyogitaonKaAayojan->where('hostel_div_district_mapping.division_id', $req->division_name);
    }
    // if (isset($req->year)) {
    //     $pratiyogitaonKaAayojan->where('information_pratiyogitaonkaaayojan.year', $req->year);
    // }
    // if (isset($req->month)) {
    //     $pratiyogitaonKaAayojan->where('information_pratiyogitaonkaaayojan.month_name', $req->month);
    // }

    if (isset($req->year)) {
      $s_year = $req->year;
      if($req->year != 'all'){
        $pratiyogitaonKaAayojan->where('information_pratiyogitaonkaaayojan.year', $req->year);
      }
    }
    else{
      $s_year = date('Y');
      $pratiyogitaonKaAayojan->where('information_pratiyogitaonkaaayojan.year', date('Y'));
    }
    // if (isset($req->month)) {
    //   $s_month = $req->month;
    //   if($req->month != 'all'){
    //     $pratiyogitaonKaAayojan->where('information_pratiyogitaonkaaayojan.month_name', $req->month);
    //   }
    // }
    // else{
    //   $s_month = date('m');
    //   $pratiyogitaonKaAayojan->where('information_pratiyogitaonkaaayojan.month_name', date('m'));
    // }
    if (isset($req->from_month)) {
      $from_month = $req->from_month;
      if($req->from_month != 'all'){
      $pratiyogitaonKaAayojan->where('information_pratiyogitaonkaaayojan.month_name','>=',$req->from_month);
      }
    }
    else{
      $from_month = date('m');
      $pratiyogitaonKaAayojan->where('information_pratiyogitaonkaaayojan.month_name', date('m'));
    }

    // to
    if (isset($req->to_month)) {
      $to_month = $req->to_month;
      if($req->to_month != 'all'){
      $pratiyogitaonKaAayojan->where('information_pratiyogitaonkaaayojan.month_name','<=',$req->to_month);
      }
    }
    else{
      $to_month = date('m');
      $pratiyogitaonKaAayojan->where('information_pratiyogitaonkaaayojan.month_name', date('m'));
    }

    if ($req->from_date != '') {
      $pratiyogitaonKaAayojan->whereDate('created_at', '>=', ymd($req->from_date));
    }

    if ($req->to_date != '') {
      $pratiyogitaonKaAayojan->whereDate('created_at', '<=', ymd($req->to_date));
    }

    if ($req->from_date != '' && $req->to_date != '') {
      $pratiyogitaonKaAayojan->whereBetween('created_at', [ymd($req->from_date), ymd($req->to_date)]);
    }
    /** filter end */
    $pratiyogitaonKaAayojan = $pratiyogitaonKaAayojan->select('information_pratiyogitaonkaaayojan.*')->orderBy('hostel_div_district_mapping.division_id', 'ASC')->orderBy('hostel_div_district_mapping.district_id', 'ASC')
    ->orderBy('year', 'DESC')->orderBy('month_name', 'DESC')
    ->get();
    $ed_data =false;
    if($req->id){
      $ed_data = DB::table('information_pratiyogitaonkaaayojan')->where('id',$req->id)->first();
    }
    return view('admin.information_details.pratiyogitaonKaAayojan', ['division' => $division,'pratiyogitaonKaAayojan' => $pratiyogitaonKaAayojan, 'districts' => $districts, 'divisions' => $divisions, 'tehsils' => $tehsils, 'division_id' => $division_id, 'district_id_departmental' => $district_id_departmental, 'admin_id' => $admin_id, 'sports' => $sports,'ed_data'=>$ed_data,'s_year'=>$s_year,'to_month'=>$to_month,'from_month'=>$from_month]);
  }


  public function ekalavyKreedaKosh(Request $req)
  {

    if ($req->method() == "POST") {
      // dd($req->all());
      $validation = Validator::make($req->all(), [
        'month_name' => 'required',
        'year' => 'required',
        'district_id' => 'required',
        'received_applications' => 'required',
      ]);

      if ($validation->fails()) {
        return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
      }


      $data=[
        'month_name' => $req->month_name,
        'year' => $req->year,
        'district_id' => $req->district_id,
        'received_applications' => $req->received_applications,

        'comment' => $req->comment,
      ];
      if($req->id){
        DB::table('information_ekalavykreedakosh')->where('id',$req->id)->update($data);
        return response()->json(['error' => false, 'msg' => "Data Update sucessfully",'url'=>route('ekalavyKreedaKosh')]);
      }else{
        DB::table('information_ekalavykreedakosh')->insert($data);
        return response()->json(['error' => false, 'msg' => "Data Saved sucessfully",'url'=>route('ekalavyKreedaKosh')]);
      }
      // return response()->json(['error' => false, 'msg' => "Data saved sucessfully"]);
    }

    $district_id_departmental = Auth::guard('admin')->user()->district_id;

    $admin_id = Auth::guard('admin')->user()->admin_role;
    $sports = DB::table('sport_type')->orderBy('name', 'ASC')->get();
    $divisions = DivisionModel::select('division_name', 'id')->get();
    $division_id = 0;
    $tehsils = DB::table('tehsil_master')->select('Tehsil_Name', 'id')->where('dist_id', $district_id_departmental)->get();
    $ekalavyKreedaKosh = DB::table('information_ekalavykreedakosh')
      ->join('hostel_div_district_mapping', 'information_ekalavykreedakosh.district_id', '=', 'hostel_div_district_mapping.district_id');
    if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 18) {
      $division = DB::table('hostel_division_master')->select('division_name','id')->orderBy('division_name')->get();
      $districts = DB::table('cities')->select('city', 'id')->where('state_id', '23')->orderBy('city')->get();
    } elseif (Auth::guard('admin')->user()->admin_role == 9) {
      $districts = DB::table('cities')->select('city', 'id')->where('id',  $district_id_departmental)->get();
      $division = DB::table('hostel_division_master')
      ->join('hostel_div_district_mapping','hostel_division_master.id','=','hostel_div_district_mapping.division_id')
      ->select('hostel_division_master.division_name','hostel_division_master.id')->where('hostel_div_district_mapping.district_id',$district_id_departmental)->orderBy('division_name')->get();
      $ekalavyKreedaKosh->where('information_ekalavykreedakosh.district_id',  $district_id_departmental);
    } elseif (Auth::guard('admin')->user()->admin_role == 2) {
      $division_id = Auth::guard('admin')->user()->division_id;
      $division = DB::table('hostel_division_master')->select('division_name','id')->where('hostel_division_master.id',$division_id)->orderBy('division_name')->get();
      $district_list = DB::table('hostel_div_district_mapping')->where('division_id', $division_id)->get();
      $district_id = [];
      foreach ($district_list as $key => $item) {
        $district_id[] = $item->district_id;
      }
      $ekalavyKreedaKosh->whereIn('information_ekalavykreedakosh.district_id',  $district_id);
      $districts = DB::table('cities')->select('city', 'id')->whereIn('id',  $district_id)->get();
    }
    /** filter start */
    if (isset($req->district_name)) {
      $ekalavyKreedaKosh->where('information_ekalavykreedakosh.district_id', $req->district_name);
    }
    if (isset($req->division_name)) {
      $ekalavyKreedaKosh->where('hostel_div_district_mapping.division_id', $req->division_name);
    }
    // if (isset($req->year)) {
    //     $ekalavyKreedaKosh->where('information_ekalavykreedakosh.year', $req->year);
    // }
    // if (isset($req->month)) {
    //     $ekalavyKreedaKosh->where('information_ekalavykreedakosh.month_name', $req->month);
    // }
    if (isset($req->year)) {
      $s_year = $req->year;
      if($req->year != 'all'){
        $ekalavyKreedaKosh->where('information_ekalavykreedakosh.year', $req->year);
      }
    }
    else{
      $s_year = date('Y');
      $ekalavyKreedaKosh->where('information_ekalavykreedakosh.year', date('Y'));
    }
    // if (isset($req->month)) {
    //   $s_month = $req->month;
    //   if($req->month != 'all'){
    //     $ekalavyKreedaKosh->where('information_ekalavykreedakosh.month_name', $req->month);
    //   }
    // }
    // else{
    //   $s_month = date('m');
    //   $ekalavyKreedaKosh->where('information_ekalavykreedakosh.month_name', date('m'));
    // }
    if (isset($req->from_month)) {
      $from_month = $req->from_month;
      if($req->from_month != 'all'){
      $ekalavyKreedaKosh->where('information_ekalavykreedakosh.month_name','>=',$req->from_month);
      }
    }
    else{
      $from_month = date('m');
      $ekalavyKreedaKosh->where('information_ekalavykreedakosh.month_name', date('m'));
    }

    // to
    if (isset($req->to_month)) {
      $to_month = $req->to_month;
      if($req->to_month != 'all'){
      $ekalavyKreedaKosh->where('information_ekalavykreedakosh.month_name','<=',$req->to_month);
      }
    }
    else{
      $to_month = date('m');
      $ekalavyKreedaKosh->where('information_ekalavykreedakosh.month_name', date('m'));
    }

    if ($req->from_date != '') {
      $ekalavyKreedaKosh->whereDate('created_at', '>=', ymd($req->from_date));
    }

    if ($req->to_date != '') {
      $ekalavyKreedaKosh->whereDate('created_at', '<=', ymd($req->to_date));
    }

    if ($req->from_date != '' && $req->to_date != '') {
      $ekalavyKreedaKosh->whereBetween('created_at', [ymd($req->from_date), ymd($req->to_date)]);
    }
    /** filter end */
    $ekalavyKreedaKosh = $ekalavyKreedaKosh->select('information_ekalavykreedakosh.*')->orderBy('hostel_div_district_mapping.division_id', 'ASC')->orderBy('hostel_div_district_mapping.district_id', 'ASC')
    ->orderBy('year', 'DESC')->orderBy('month_name', 'DESC')
    ->get();
    $ed_data =false;
    if($req->id){
      $ed_data = DB::table('information_ekalavykreedakosh')->where('id',$req->id)->first();
    }
    return view('admin.information_details.ekalavyKreedaKosh', ['division' => $division,'ekalavyKreedaKosh' => $ekalavyKreedaKosh, 'districts' => $districts, 'divisions' => $divisions, 'tehsils' => $tehsils, 'division_id' => $division_id, 'district_id_departmental' => $district_id_departmental, 'admin_id' => $admin_id, 'sports' => $sports,'ed_data'=>$ed_data,'s_year'=>$s_year ,'to_month'=>$to_month,'from_month'=>$from_month]);
  }

  public function jilaKhelVikaas(Request $req)
  {

    if ($req->method() == "POST") {
      // dd($req->all());
      $validation = Validator::make($req->all(), [
        'month_name' => 'required',
        'year' => 'required',
        'district_id' => 'required',
        'opening_balance_current_year' => 'required',
        'amount_received_current_month' => 'required',
        'amount_spent_current_month' => 'required',
        'total_balance_deposited_till_current_month' => 'required',
        'total_amount_received_till_current_month' => 'required',
        'total_amount_received_till_same_month_last_year' => 'required',
      ]);

      if ($validation->fails()) {
        return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
      }


      $data=[
        'month_name' => $req->month_name,
        'year' => $req->year,
        'district_id' => $req->district_id,
        'opening_balance_current_year' => $req->opening_balance_current_year,
        'amount_received_current_month' => $req->amount_received_current_month,
        'amount_spent_current_month' => $req->amount_spent_current_month,
        'total_balance_deposited_till_current_month' => $req->total_balance_deposited_till_current_month,
        'total_amount_received_till_current_month' => $req->total_amount_received_till_current_month,
        'total_amount_received_till_same_month_last_year' => $req->total_amount_received_till_same_month_last_year,
        'growth' => $req->growth,
        'shortage' => $req->shortage,
      ];
      if($req->id){
        DB::table('information_jilakhelvikaas')->where('id',$req->id)->update($data);
        return response()->json(['error' => false, 'msg' => "Data Update sucessfully",'url'=>route('jilaKhelVikaas')]);
      }else{
        DB::table('information_jilakhelvikaas')->insert($data);
        return response()->json(['error' => false, 'msg' => "Data Saved sucessfully",'url'=>route('jilaKhelVikaas')]);
      }
      // return response()->json(['error' => false, 'msg' => "Data saved sucessfully"]);
    }

    $district_id_departmental = Auth::guard('admin')->user()->district_id;

    $admin_id = Auth::guard('admin')->user()->admin_role;
    $sports = DB::table('sport_type')->orderBy('name', 'ASC')->get();
    $divisions = DivisionModel::select('division_name', 'id')->get();
    $division_id = 0;
    $tehsils = DB::table('tehsil_master')->select('Tehsil_Name', 'id')->where('dist_id', $district_id_departmental)->get();
    $jilaKhelVikaas = DB::table('information_jilakhelvikaas')
      ->join('hostel_div_district_mapping', 'information_jilakhelvikaas.district_id', '=', 'hostel_div_district_mapping.district_id');
    if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 18) {
      $division = DB::table('hostel_division_master')->select('division_name','id')->orderBy('division_name')->get();
      $districts = DB::table('cities')->select('city', 'id')->where('state_id', '23')->orderBy('city')->get();
    } elseif (Auth::guard('admin')->user()->admin_role == 9) {
      $districts = DB::table('cities')->select('city', 'id')->where('id',  $district_id_departmental)->get();
      $division = DB::table('hostel_division_master')
      ->join('hostel_div_district_mapping','hostel_division_master.id','=','hostel_div_district_mapping.division_id')
      ->select('hostel_division_master.division_name','hostel_division_master.id')->where('hostel_div_district_mapping.district_id',$district_id_departmental)->orderBy('division_name')->get();
      $jilaKhelVikaas->where('information_jilakhelvikaas.district_id',  $district_id_departmental);
    } elseif (Auth::guard('admin')->user()->admin_role == 2) {
      $division_id = Auth::guard('admin')->user()->division_id;
      $division = DB::table('hostel_division_master')->select('division_name','id')->where('hostel_division_master.id',$division_id)->orderBy('division_name')->get();
      $district_list = DB::table('hostel_div_district_mapping')->where('division_id', $division_id)->get();
      $district_id = [];
      foreach ($district_list as $key => $item) {
        $district_id[] = $item->district_id;
      }
      $jilaKhelVikaas->whereIn('information_jilakhelvikaas.district_id',  $district_id);
      $districts = DB::table('cities')->select('city', 'id')->whereIn('id',  $district_id)->get();
    }
    /** filter start */
    if (isset($req->district_name)) {
      $jilaKhelVikaas->where('information_jilakhelvikaas.district_id', $req->district_name);
    }
    if (isset($req->division_name)) {
      $jilaKhelVikaas->where('hostel_div_district_mapping.division_id', $req->division_name);
    }
    // if (isset($req->year)) {
    //     $jilaKhelVikaas->where('information_jilakhelvikaas.year', $req->year);
    // }
    // if (isset($req->month)) {
    //     $jilaKhelVikaas->where('information_jilakhelvikaas.month_name', $req->month);
    // }
    if (isset($req->year)) {
      $s_year = $req->year;
      if($req->year != 'all'){
        $jilaKhelVikaas->where('information_jilakhelvikaas.year', $req->year);
      }
    }
    else{
      $s_year = date('Y');
      $jilaKhelVikaas->where('information_jilakhelvikaas.year', date('Y'));
    }
    // if (isset($req->month)) {
    //   $s_month = $req->month;
    //   if($req->month != 'all'){
    //     $jilaKhelVikaas->where('information_jilakhelvikaas.month_name', $req->month);
    //   }
    // }
    // else{
    //   $s_month = date('m');
    //   $jilaKhelVikaas->where('information_jilakhelvikaas.month_name', date('m'));
    // }

    if (isset($req->from_month)) {
      $from_month = $req->from_month;
      if($req->from_month != 'all'){
      $jilaKhelVikaas->where('information_jilakhelvikaas.month_name','>=',$req->from_month);
      }
    }
    else{
      $from_month = date('m');
      $jilaKhelVikaas->where('information_jilakhelvikaas.month_name', date('m'));
    }

    // to
    if (isset($req->to_month)) {
      $to_month = $req->to_month;
      if($req->to_month != 'all'){
      $jilaKhelVikaas->where('information_jilakhelvikaas.month_name','<=',$req->to_month);
      }
    }
    else{
      $to_month = date('m');
      $jilaKhelVikaas->where('information_jilakhelvikaas.month_name', date('m'));
    }

    if ($req->from_date != '') {
      $jilaKhelVikaas->whereDate('created_at', '>=', ymd($req->from_date));
    }

    if ($req->to_date != '') {
      $jilaKhelVikaas->whereDate('created_at', '<=', ymd($req->to_date));
    }

    if ($req->from_date != '' && $req->to_date != '') {
      $jilaKhelVikaas->whereBetween('created_at', [ymd($req->from_date), ymd($req->to_date)]);
    }
    /** filter end */
    $jilaKhelVikaas = $jilaKhelVikaas->select('information_jilakhelvikaas.*')->orderBy('hostel_div_district_mapping.division_id', 'ASC')->orderBy('hostel_div_district_mapping.district_id', 'ASC')
    ->orderBy('year', 'DESC')->orderBy('month_name', 'DESC')
    ->get();
    $ed_data =false;
    if($req->id){
      $ed_data = DB::table('information_jilakhelvikaas')->where('id',$req->id)->first();
    }
    return view('admin.information_details.jilaKhelVikaas', ['division' => $division,'jilaKhelVikaas' => $jilaKhelVikaas, 'districts' => $districts, 'divisions' => $divisions, 'tehsils' => $tehsils, 'division_id' => $division_id, 'district_id_departmental' => $district_id_departmental, 'admin_id' => $admin_id, 'sports' => $sports,'ed_data'=>$ed_data,'s_year'=>$s_year ,'to_month'=>$to_month,'from_month'=>$from_month]);
  }

  public function kshetreeykreedaadhikaari(Request $req)
  {

    if ($req->method() == "POST") {
      // dd($req->all());
      $validation = Validator::make($req->all(), [
        'month_name' => 'required',
        'year' => 'required',
        'inspected_officer' => 'required',
        'subpost_name' => 'required',
        'posting_place_division' => 'required',
        // 'inspected_date' => 'required',
        'inspected_office' => 'required'
      ]);

      if ($validation->fails()) {
        return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
      }


      $data=[
        'month_name' => $req->month_name,
        'year' => $req->year,
        // 'district_id' => $req->district_id,
        'inspected_officer' => $req->inspected_officer,
        'subpost_name' => $req->subpost_name,
        'posting_place_division' => $req->posting_place_division,
        'inspected_date' => $req->inspected_date,
        'inspected_office' => $req->inspected_office
      ];
      if($req->id){
        DB::table('information_kshetreey_kreeda_adhikaari')->where('id',$req->id)->update($data);
        return response()->json(['error' => false, 'msg' => "Data Update sucessfully",'url'=>route('kshetreeykreedaadhikaari')]);
      }else{
        DB::table('information_kshetreey_kreeda_adhikaari')->insert($data);
        return response()->json(['error' => false, 'msg' => "Data Saved sucessfully",'url'=>route('kshetreeykreedaadhikaari')]);
      }
      // return response()->json(['error' => false, 'msg' => "Data saved sucessfully"]);
    }

    $district_id_departmental = Auth::guard('admin')->user()->district_id;

    $admin_id = Auth::guard('admin')->user()->admin_role;
    $sports = DB::table('sport_type')->orderBy('name', 'ASC')->get();
    $divisions = DivisionModel::select('division_name', 'id')->get();

    $tehsils = DB::table('tehsil_master')->select('Tehsil_Name', 'id')->where('dist_id', $district_id_departmental)->get();
    $kshetreeykreedaadhikaari = DB::table('information_kshetreey_kreeda_adhikaari');
    // if( Auth::guard('admin')->user()->admin_role== 1){
    //   $districts = DB::table('cities')->select('city','id')->where('state_id', '23')->orderBy('city')->get();
    //  }elseif(Auth::guard('admin')->user()->admin_role == 9){
    //   $districts = DB::table('cities')->select('city', 'id')->where('id',  $district_id_departmental)->get();
    //   $kshetreeykreedaadhikaari->where('district_id',  $district_id_departmental);
    // }elseif(Auth::guard('admin')->user()->admin_role == 2){ 
    //  
    //  $district_list = DB::table('hostel_div_district_mapping')->where('division_id',$division_id)->get();
    //   $district_id=[];
    //   foreach($district_list as $key=>$item){
    //     $district_id[]=$item->district_id;
    //   }
    //   $kshetreeykreedaadhikaari->whereIn('district_id',  $district_id);
    //   $districts = DB::table('cities')->select('city', 'id')->whereIn('id',  $district_id)->get();
    // }  
    /** filter start */
    if (isset($req->district_name)) {
      $kshetreeykreedaadhikaari->where('district_id', $req->district_name);
    }
    if (isset($req->division_name)) {
      $kshetreeykreedaadhikaari->where('hostel_div_district_mapping.division_id', $req->division_name);
    }
    // if (isset($req->year)) {
    //     $kshetreeykreedaadhikaari->where('information_kshetreey_kreeda_adhikaari.year', $req->year);
    // }
    // if (isset($req->month)) {
    //     $kshetreeykreedaadhikaari->where('information_kshetreey_kreeda_adhikaari.month_name', $req->month);
    // }
    if (isset($req->year)) {
      $s_year = $req->year;
      if($req->year != 'all'){
        $kshetreeykreedaadhikaari->where('information_kshetreey_kreeda_adhikaari.year', $req->year);
      }
    }
    else{
      $s_year = date('Y');
      $kshetreeykreedaadhikaari->where('information_kshetreey_kreeda_adhikaari.year', date('Y'));
    }
    // if (isset($req->month)) {
    //   $s_month = $req->month;
    //   if($req->month != 'all'){
    //     $kshetreeykreedaadhikaari->where('information_kshetreey_kreeda_adhikaari.month_name', $req->month);
    //   }
    // }
    // else{
    //   $s_month = date('m');
    //   $kshetreeykreedaadhikaari->where('information_kshetreey_kreeda_adhikaari.month_name', date('m'));
    // }
    if (isset($req->from_month)) {
      $from_month = $req->from_month;
      if($req->from_month != 'all'){
      $kshetreeykreedaadhikaari->where('information_kshetreey_kreeda_adhikaari.month_name','>=',$req->from_month);
      }
    }
    else{
      $from_month = date('m');
      $kshetreeykreedaadhikaari->where('information_kshetreey_kreeda_adhikaari.month_name', date('m'));
    }

    // to
    if (isset($req->to_month)) {
      $to_month = $req->to_month;
      if($req->to_month != 'all'){
      $kshetreeykreedaadhikaari->where('information_kshetreey_kreeda_adhikaari.month_name','<=',$req->to_month);
      }
    }
    else{
      $to_month = date('m');
      $kshetreeykreedaadhikaari->where('information_kshetreey_kreeda_adhikaari.month_name', date('m'));
    }
    if ($req->from_date != '') {
      $kshetreeykreedaadhikaari->whereDate('created_at', '>=', ymd($req->from_date));
    }

    if ($req->to_date != '') {
      $kshetreeykreedaadhikaari->whereDate('created_at', '<=', ymd($req->to_date));
    }

    if ($req->from_date != '' && $req->to_date != '') {
      $kshetreeykreedaadhikaari->whereBetween('created_at', [ymd($req->from_date), ymd($req->to_date)]);
    }
    /** filter end */
    $kshetreeykreedaadhikaari = $kshetreeykreedaadhikaari->select('information_kshetreey_kreeda_adhikaari.*')->orderBy('id', 'DESC')
    ->orderBy('year', 'DESC')->orderBy('month_name', 'DESC')
    ->get();
    $ed_data =false;
    if($req->id){
      $ed_data = DB::table('information_kshetreey_kreeda_adhikaari')->where('id',$req->id)->first();
    }
    return view('admin.information_details.kshetreey_kreeda_adhikaari', ['kshetreeykreedaadhikaari' => $kshetreeykreedaadhikaari, 'divisions' => $divisions, 'tehsils' => $tehsils, 'district_id_departmental' => $district_id_departmental, 'admin_id' => $admin_id, 'sports' => $sports,'ed_data'=>$ed_data,'s_year'=>$s_year ,'to_month'=>$to_month,'from_month'=>$from_month]);
  }

  public function adhikaariyonprashikshon(Request $req)
  {

    if ($req->method() == "POST") {
      // dd($req->all());
      $validation = Validator::make($req->all(), [
        'month_name' => 'required',
        'year' => 'required',
        'district_id' => 'required',
        'sport_id' => 'required',
        'instructor_name' => 'required',
        'departmental_part_time' => 'required',
        'schools_training' => 'required',
        'boys_number' => 'required',
        'girls_number' => 'required',
        'total_girls_boys' => 'required'
      ]);

      if ($validation->fails()) {
        return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
      }


      $data=[
        'month_name' => $req->month_name,
        'year' => $req->year,
        'district_id' => $req->district_id,
        'sport_id' => $req->sport_id,
        'instructor_name' => $req->instructor_name,
        'departmental_part_time' => $req->departmental_part_time,
        'schools_training' => $req->schools_training,
        'boys_number' => $req->boys_number,
        'girls_number' => $req->girls_number,
        'total_girls_boys' => $req->girls_number + $req->boys_number,
        'comment' => $req->comment,
      ];
      if($req->id){
        DB::table('information_adhikaariyon_prashikshon')->where('id',$req->id)->update($data);
        return response()->json(['error' => false, 'msg' => "Data Update sucessfully",'url'=>route('adhikaariyonprashikshon')]);
      }else{
        DB::table('information_adhikaariyon_prashikshon')->insert($data);
        return response()->json(['error' => false, 'msg' => "Data Saved sucessfully",'url'=>route('adhikaariyonprashikshon')]);
      }
      // return response()->json(['error' => false, 'msg' => "Data saved sucessfully"]);
    }

    $district_id_departmental = Auth::guard('admin')->user()->district_id;

    $admin_id = Auth::guard('admin')->user()->admin_role;
    $sports = DB::table('sport_type')->orderBy('name', 'ASC')->get();
    $divisions = DivisionModel::select('division_name', 'id')->get();
    $division_id = 0;
    $tehsils = DB::table('tehsil_master')->select('Tehsil_Name', 'id')->where('dist_id', $district_id_departmental)->get();
    $adhikaariyonprashikshon = DB::table('information_adhikaariyon_prashikshon')
      ->join('hostel_div_district_mapping', 'information_adhikaariyon_prashikshon.district_id', '=', 'hostel_div_district_mapping.district_id');
    if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 18) {
      $division = DB::table('hostel_division_master')->select('division_name','id')->orderBy('division_name')->get();
      $districts = DB::table('cities')->select('city', 'id')->where('state_id', '23')->orderBy('city')->get();
    } elseif (Auth::guard('admin')->user()->admin_role == 9) {
      $districts = DB::table('cities')->select('city', 'id')->where('id',  $district_id_departmental)->get();
      $division = DB::table('hostel_division_master')
      ->join('hostel_div_district_mapping','hostel_division_master.id','=','hostel_div_district_mapping.division_id')
      ->select('hostel_division_master.division_name','hostel_division_master.id')->where('hostel_div_district_mapping.district_id',$district_id_departmental)->orderBy('division_name')->get();
      $adhikaariyonprashikshon->where('information_adhikaariyon_prashikshon.district_id',  $district_id_departmental);
    } elseif (Auth::guard('admin')->user()->admin_role == 2) {
      $division_id = Auth::guard('admin')->user()->division_id;
      $division = DB::table('hostel_division_master')->select('division_name','id')->where('hostel_division_master.id',$division_id)->orderBy('division_name')->get();
      $district_list = DB::table('hostel_div_district_mapping')->where('division_id', $division_id)->get();
      $district_id = [];
      foreach ($district_list as $key => $item) {
        $district_id[] = $item->district_id;
      }
      $adhikaariyonprashikshon->whereIn('information_adhikaariyon_prashikshon.district_id',  $district_id);
      $districts = DB::table('cities')->select('city', 'id')->whereIn('id',  $district_id)->get();
    }
    /** filter start */
    if (isset($req->district_name)) {
      $adhikaariyonprashikshon->where('information_adhikaariyon_prashikshon.district_id', $req->district_name);
    }
    if (isset($req->division_name)) {
      $adhikaariyonprashikshon->where('hostel_div_district_mapping.division_id', $req->division_name);
    }
    // if (isset($req->year)) {
    //     $adhikaariyonprashikshon->where('information_adhikaariyon_prashikshon.year', $req->year);
    // }
    // if (isset($req->month)) {
    //     $adhikaariyonprashikshon->where('information_adhikaariyon_prashikshon.month_name', $req->month);
    // }
    if (isset($req->year)) {
      $s_year = $req->year;
      if($req->year != 'all'){
        $adhikaariyonprashikshon->where('information_adhikaariyon_prashikshon.year', $req->year);
      }
    }
    else{
      $s_year = date('Y');
      $adhikaariyonprashikshon->where('information_adhikaariyon_prashikshon.year', date('Y'));
    }
    // if (isset($req->month)) {
    //   $s_month = $req->month;
    //   if($req->month != 'all'){
    //     $adhikaariyonprashikshon->where('information_adhikaariyon_prashikshon.month_name', $req->month);
    //   }
    // }
    // else{
    //   $s_month = date('m');
    //   $adhikaariyonprashikshon->where('information_adhikaariyon_prashikshon.month_name', date('m'));
    // }
    if (isset($req->from_month)) {
      $from_month = $req->from_month;
      if($req->from_month != 'all'){
      $adhikaariyonprashikshon->where('information_adhikaariyon_prashikshon.month_name','>=',$req->from_month);
      }
    }
    else{
      $from_month = date('m');
      $adhikaariyonprashikshon->where('information_adhikaariyon_prashikshon.month_name', date('m'));
    }

    // to
    if (isset($req->to_month)) {
      $to_month = $req->to_month;
      if($req->to_month != 'all'){
      $adhikaariyonprashikshon->where('information_adhikaariyon_prashikshon.month_name','<=',$req->to_month);
      }
    }
    else{
      $to_month = date('m');
      $adhikaariyonprashikshon->where('information_adhikaariyon_prashikshon.month_name', date('m'));
    }
    if ($req->from_date != '') {
      $adhikaariyonprashikshon->whereDate('created_at', '>=', ymd($req->from_date));
    }

    if ($req->to_date != '') {
      $adhikaariyonprashikshon->whereDate('created_at', '<=', ymd($req->to_date));
    }

    if ($req->from_date != '' && $req->to_date != '') {
      $adhikaariyonprashikshon->whereBetween('created_at', [ymd($req->from_date), ymd($req->to_date)]);
    }
    /** filter end */
    $adhikaariyonprashikshon = $adhikaariyonprashikshon->select('information_adhikaariyon_prashikshon.*')->orderBy('hostel_div_district_mapping.division_id', 'ASC')->orderBy('hostel_div_district_mapping.district_id', 'ASC')
    ->orderBy('year', 'DESC')->orderBy('month_name', 'DESC')
    ->get();
    $ed_data =false;
    if($req->id){
      $ed_data = DB::table('information_adhikaariyon_prashikshon')->where('id',$req->id)->first();
    }
    return view('admin.information_details.adhikaariyonprashikshon', ['division' => $division,'adhikaariyonprashikshon' => $adhikaariyonprashikshon, 'districts' => $districts, 'divisions' => $divisions, 'tehsils' => $tehsils, 'division_id' => $division_id, 'district_id_departmental' => $district_id_departmental, 'admin_id' => $admin_id, 'sports' => $sports,'ed_data'=>$ed_data,'s_year'=>$s_year ,'to_month'=>$to_month,'from_month'=>$from_month]);
  }

  public function vyayaadhi_bachat(Request $req)
  {

    if ($req->method() == "POST") {
      // dd($req->all());
      $validation = Validator::make($req->all(), [
        'month' => 'required',
        'year' => 'required',
        'district_name' => 'required',
        'item_name' => 'required',
        'amount_of_money_spent' => 'required',
        'savings' => 'required',
        'directorate_seventy' => 'required',
      ]);

      if ($validation->fails()) {
        return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
      }

    // dd($req->all());
      $data=[
        'month_name' => $req->month,
        'year' => $req->year,  
        'district_id' => $req->district_name,
        'item_name' => $req->item_name,
        'revenue_accounting' => $req->revenue_accounting,
        'uttar_pradesh_sports_development' => $req->uttar_pradesh_sports_development,
        'amount_of_money_spent' => $req->amount_of_money_spent,
        'savings_percent' => $req->savings_percent,
        'savings' => $req->savings,
        'directorate_seventy' => $req->directorate_seventy,
        'allegation' => $req->allegation,
      ];

      if($req->id){
        DB::table('vyayaadhi_bachat')->where('id',$req->id)->update($data);
        return response()->json(['error' => false, 'msg' => "Data Update sucessfully",'url'=>route('vyayaadhi_bachat')]);
      }else{
        DB::table('vyayaadhi_bachat')->insert($data);
        return response()->json(['error' => false, 'msg' => "Data Saved sucessfully",'url'=>route('vyayaadhi_bachat')]);
      }
      // return response()->json(['error' => false, 'msg' => "Data saved sucessfully"]);
    }

    $district_id_departmental = Auth::guard('admin')->user()->district_id;

    $admin_id = Auth::guard('admin')->user()->admin_role;
    $sports = DB::table('sport_type')->orderBy('name', 'ASC')->get();
    $divisions = DivisionModel::select('division_name', 'id')->get();
    $division_id = 0;
    $tehsils = DB::table('tehsil_master')->select('Tehsil_Name', 'id')->where('dist_id', $district_id_departmental)->get();
    $vyayaadhi_bachat = DB::table('vyayaadhi_bachat')
      ->join('hostel_div_district_mapping', 'vyayaadhi_bachat.district_id', '=', 'hostel_div_district_mapping.district_id');
    if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 18) {
      $division = DB::table('hostel_division_master')->select('division_name','id')->orderBy('division_name')->get();
      $districts = DB::table('cities')->select('city', 'id')->where('state_id', '23')->orderBy('city')->get();
    } elseif (Auth::guard('admin')->user()->admin_role == 9) {
      $division = DB::table('hostel_division_master')
      ->join('hostel_div_district_mapping','hostel_division_master.id','=','hostel_div_district_mapping.division_id')
      ->select('hostel_division_master.division_name','hostel_division_master.id')->where('hostel_div_district_mapping.district_id',$district_id_departmental)->orderBy('division_name')->get();
      $districts = DB::table('cities')->select('city', 'id')->where('id',  $district_id_departmental)->get();
      $vyayaadhi_bachat->where('vyayaadhi_bachat.district_id',  $district_id_departmental);
    } elseif (Auth::guard('admin')->user()->admin_role == 2) {
      $division_id = Auth::guard('admin')->user()->division_id;
      $division = DB::table('hostel_division_master')->select('division_name','id')->where('hostel_division_master.id',$division_id)->orderBy('division_name')->get();
      $district_list = DB::table('hostel_div_district_mapping')->where('division_id', $division_id)->get();
      $district_id = [];
      foreach ($district_list as $key => $item) {
        $district_id[] = $item->district_id;
      }
      $vyayaadhi_bachat->whereIn('vyayaadhi_bachat.district_id',  $district_id);
      $districts = DB::table('cities')->select('city', 'id')->whereIn('id',  $district_id)->get();
    }
    /** filter start */
    if (isset($req->district_name)) {
      $vyayaadhi_bachat->where('vyayaadhi_bachat.district_id', $req->district_name);
    }
    if (isset($req->division_name)) {
      $vyayaadhi_bachat->where('hostel_div_district_mapping.division_id', $req->division_name);
    }
    // if (isset($req->year)) {
    //     $vyayaadhi_bachat->where('vyayaadhi_bachat.year', $req->year);
    // }
    // if (isset($req->month)) {
    //     $vyayaadhi_bachat->where('vyayaadhi_bachat.month_name', $req->month);
    // }
    if (isset($req->year)) {
      $s_year = $req->year;
      if($req->year != 'all'){
        $vyayaadhi_bachat->where('vyayaadhi_bachat.year', $req->year);
      }
    }
    else{
      $s_year = date('Y');
      $vyayaadhi_bachat->where('vyayaadhi_bachat.year', date('Y'));
    }
    // if (isset($req->month)) {
    //   $s_month = $req->month;
    //   if($req->month != 'all'){
    //     $vyayaadhi_bachat->where('vyayaadhi_bachat.month_name', $req->month);
    //   }
    // }
    // else{
    //   $s_month = date('m');
    //   $vyayaadhi_bachat->where('vyayaadhi_bachat.month_name', date('m'));
    // }
    if (isset($req->from_month)) {
      $from_month = $req->from_month;
      if($req->from_month != 'all'){
      $vyayaadhi_bachat->where('vyayaadhi_bachat.month_name','>=',$req->from_month);
      }
    }
    else{
      $from_month = date('m');
      $vyayaadhi_bachat->where('vyayaadhi_bachat.month_name', date('m'));
    }

    // to
    if (isset($req->to_month)) {
      $to_month = $req->to_month;
      if($req->to_month != 'all'){
      $vyayaadhi_bachat->where('vyayaadhi_bachat.month_name','<=',$req->to_month);
      }
    }
    else{
      $to_month = date('m');
      $vyayaadhi_bachat->where('vyayaadhi_bachat.month_name', date('m'));
    }
    if ($req->from_date != '') {
      $vyayaadhi_bachat->whereDate('created_on', '>=', ymd($req->from_date));
    }

    if ($req->to_date != '') {
      $vyayaadhi_bachat->whereDate('created_on', '<=', ymd($req->to_date));
    }

    if ($req->from_date != '' && $req->to_date != '') {
      $vyayaadhi_bachat->whereBetween('created_on', [ymd($req->from_date), ymd($req->to_date)]);
    }
    /** filter end */
    $vyayaadhi_bachat = $vyayaadhi_bachat->select('vyayaadhi_bachat.*')->orderBy('hostel_div_district_mapping.division_id', 'ASC')->orderBy('hostel_div_district_mapping.district_id', 'ASC')
    ->orderBy('year', 'DESC')->orderBy('month_name', 'DESC')
    ->get();
    $ed_data =false;
    if($req->id){
      $ed_data = DB::table('vyayaadhi_bachat')->where('id',$req->id)->first();
    }
    $convert=1;
    if($req->convert != '') {
      $convert=$req->convert;
    }
    return view('admin.information_details.vyayaadhi_bachat', ['division' => $division,'vyayaadhi_bachat' => $vyayaadhi_bachat, 'districts' => $districts, 'divisions' => $divisions, 'tehsils' => $tehsils, 'division_id' => $division_id, 'district_id_departmental' => $district_id_departmental, 'admin_id' => $admin_id, 'sports' => $sports,'ed_data'=>$ed_data,'convert'=>$convert,'s_year'=>$s_year ,'to_month'=>$to_month,'from_month'=>$from_month]);
  }

  public function information_honorable(Request $req)
  {

    if ($req->method() == "POST") {
      // dd($req->all());
      $validation = Validator::make($req->all(), [
        'month_name' => 'required',
        'year' => 'required',
        'district_name'     => 'required',
        'name_of_honorable'   => 'required',
        // 'date_of_receipt_of_letter'   => 'required',
        'subject_of_letter' => 'required',
        'details_of_action_taken' => 'required',
        // 'date_of_informing_honble_mp' => 'required',
        'honble_mp_action_taken' => 'required',
      ]);
      if ($validation->fails()) {
        return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
      }


      $data=[
        'month_name' => $req->month_name,
        'year' => $req->year,
        'district_id' => $req->district_name,
        'name_of_honorable' => $req->name_of_honorable,
        'date_of_receipt_of_letter' => $req->date_of_receipt_of_letter,
        'subject_of_letter' => $req->subject_of_letter,
        'details_of_action_taken' => $req->details_of_action_taken,
        'date_of_informing_honble_mp' => $req->date_of_informing_honble_mp,
        'honble_mp_action_taken' => $req->honble_mp_action_taken
      ];
      if($req->id){
        DB::table('information_honorable')->where('id',$req->id)->update($data);
        return response()->json(['error' => false, 'msg' => "Data Update sucessfully",'url'=>route('information_honorable')]);
      }else{
        DB::table('information_honorable')->insert($data);
        return response()->json(['error' => false, 'msg' => "Data Saved sucessfully",'url'=>route('information_honorable')]);
      }
      // return response()->json(['error' => false, 'msg' => "Data saved sucessfully"]);
    }

    $district_id_financial = Auth::guard('admin')->user()->district_id;

    $admin_id = Auth::guard('admin')->user()->admin_role;
    $sports = DB::table('sport_type')->orderBy('name', 'ASC')->get();
    $division_id = 0;
    $tehsils = DB::table('tehsil_master')->select('Tehsil_Name', 'id')->where('dist_id', $district_id_financial)->get();
    $information_honorable = DB::table('information_honorable')
      ->join('hostel_div_district_mapping', 'information_honorable.district_id', '=', 'hostel_div_district_mapping.district_id');
    if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 18) {
      $division = DB::table('hostel_division_master')->select('division_name','id')->orderBy('division_name')->get();
      $districts = DB::table('cities')->select('city', 'id')->where('state_id', '23')->orderBy('city')->get();
    } elseif (Auth::guard('admin')->user()->admin_role == 9) {
      $division = DB::table('hostel_division_master')
      ->join('hostel_div_district_mapping','hostel_division_master.id','=','hostel_div_district_mapping.division_id')
      ->select('hostel_division_master.division_name','hostel_division_master.id')->where('hostel_div_district_mapping.district_id',$district_id_financial)->orderBy('division_name')->get();
      $districts = DB::table('cities')->select('city', 'id')->where('id',  $district_id_financial)->get();
      $information_honorable->where('information_honorable.district_id',  $district_id_financial);
    } elseif (Auth::guard('admin')->user()->admin_role == 2 || Auth::guard('admin')->user()->admin_role == 2) {
      $division_id = Auth::guard('admin')->user()->division_id;
      $division = DB::table('hostel_division_master')
      ->join('hostel_div_district_mapping','hostel_division_master.id','=','hostel_div_district_mapping.division_id')
      ->select('hostel_division_master.division_name','hostel_division_master.id')->where('hostel_div_district_mapping.district_id',$district_id_financial)->orderBy('division_name')->get();
      $division = DB::table('hostel_division_master')->select('division_name','id')->where('hostel_division_master.id',$division_id)->orderBy('division_name')->get();
      $district_list = DB::table('hostel_div_district_mapping')->where('division_id', $division_id)->get();
      $district_id = [];
      foreach ($district_list as $key => $item) {
        $district_id[] = $item->district_id;
      }
      $districts = DB::table('cities')->select('city', 'id')->whereIn('id',  $district_id)->get();
      $information_honorable->whereIn('information_honorable.district_id',  $district_id);
    }

    if (isset($req->district_name)) {
      $information_honorable->where('information_honorable.district_id', $req->district_name);
    }
    if (isset($req->division_name)) {
      $information_honorable->where('hostel_div_district_mapping.division_id', $req->division_name);
    }
    if (isset($req->year)) {
      $s_year = $req->year;
      if($req->year != 'all'){
        $information_honorable->where('information_honorable.year', $req->year);
      }
    }
    else{
      $s_year = date('Y');
      $information_honorable->where('information_honorable.year', date('Y'));
    }
    // if (isset($req->month)) {
    //   $s_month = $req->month;
    //   if($req->month != 'all'){
    //     $information_honorable->where('information_honorable.month_name', $req->month);
    //   }
    // }
    // else{
    //   $s_month = date('m');
    //   $information_honorable->where('information_honorable.month_name', date('m'));
    // }
    if (isset($req->from_month)) {
      $from_month = $req->from_month;
      if($req->from_month != 'all'){
      $information_honorable->where('information_honorable.month_name','>=',$req->from_month);
      }
    }
    else{
      $from_month = date('m');
      $information_honorable->where('information_honorable.month_name', date('m'));
    }

    // to
    if (isset($req->to_month)) {
      $to_month = $req->to_month;
      if($req->to_month != 'all'){
      $information_honorable->where('information_honorable.month_name','<=',$req->to_month);
      }
    }
    else{
      $to_month = date('m');
      $information_honorable->where('information_honorable.month_name', date('m'));
    }
    if ($req->from_date != '') {
      $information_honorable->whereDate('created_at', '>=', ymd($req->from_date));
    }

    if ($req->to_date != '') {
      $information_honorable->whereDate('created_at', '<=', ymd($req->to_date));
    }


    if ($req->from_date != '' && $req->to_date != '') {
      $information_honorable->whereBetween('created_at', [ymd($req->from_date), ymd($req->to_date)]);
    }

    $information_honorable = $information_honorable->select('information_honorable.*')->orderBy('hostel_div_district_mapping.division_id', 'ASC')->orderBy('hostel_div_district_mapping.district_id', 'ASC')
    ->orderBy('year', 'DESC')->orderBy('month_name', 'DESC')
    ->get();
    $ed_data =false;
    if($req->id){
      $ed_data = DB::table('information_honorable')->where('id',$req->id)->first();
    }
    return view('admin.information_details.information_honorable', ['division' => $division,'information_honorable' => $information_honorable, 'districts' => $districts, 'tehsils' => $tehsils, 'division_id' => $division_id, 'district_id_financial' => $district_id_financial, 'admin_id' => $admin_id, 'sports' => $sports,'ed_data'=>$ed_data,'s_year' => $s_year,'to_month'=>$to_month,'from_month'=>$from_month]);
  }

  public function monthlyInformation(Request $req)
  {
    if ($req->method() == "POST") {
      $validation = Validator::make($req->all(), [
        'month_name' => 'required',
        'year_name' => 'required',
        'opening_balance_of_financial' => 'required',
        'amount_received' => 'required',
        'amount_spent' => 'required',
        'total_balance_deposited_current_month' => 'required',
        'total_amount_received_current_month' => 'required',
        'total_amount_received_lastyear' => 'required',
      ]);

      if ($validation->fails()) {
        return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
      }

      $data = [
        'month_name' => $req->month_name,
        'year' => $req->year_name,
        'district_id' => $req->district_name ?? Auth::guard('admin')->user()->district_id,
        'tehsil_id' => $req->tehsil_name,
        'opening_balance_of_financial' => $req->opening_balance_of_financial,
        'amount_received' => $req->amount_received,
        'amount_spent' => $req->amount_spent,
        'total_balance_deposited_current_month' => $req->total_balance_deposited_current_month,
        'total_amount_received_current_month' => $req->total_amount_received_current_month,
        'total_amount_received_lastyear' => $req->total_amount_received_lastyear,
        'increase' => $req->increase,
        'decrease' => $req->decrease,
        'status' => $req->identified_the_department, // 1 for District, 2 for Tehsil based on radio in blade
      ];

      if ($req->id) {
        DB::table('information_monthly_report')->where('id', $req->id)->update($data);
        return response()->json(['error' => false, 'msg' => "Data Update successfully", 'url' => route('monthlyInformation')]);
      } else {
        DB::table('information_monthly_report')->insert($data);
        return response()->json(['error' => false, 'msg' => "Data Saved successfully", 'url' => route('monthlyInformation')]);
      }
    }

    $district_id_monthly = Auth::guard('admin')->user()->district_id;
    $admin_id = Auth::guard('admin')->user()->admin_role;
    $sports = DB::table('sport_type')->orderBy('name', 'ASC')->get();
    $tehsils = DB::table('tehsil_master')->select('Tehsil_Name', 'id')->where('dist_id', $district_id_monthly)->get();
    $districts = DB::table('cities')->select('city', 'id')->where('state_id', '23')->orderBy('city')->get();

    $monthlyInformation = DB::table('information_monthly_report');
    
    if ($admin_id == 1 || $admin_id == 18) {
      // Superadmin
    } elseif ($admin_id == 9) {
        $monthlyInformation->where('district_id', $district_id_monthly);
    } elseif ($admin_id == 2) {
        $division_id = Auth::guard('admin')->user()->division_id;
        $district_list = DB::table('hostel_div_district_mapping')->where('division_id', $division_id)->pluck('district_id');
        $monthlyInformation->whereIn('district_id', $district_list);
    }

    $monthlyInformation = $monthlyInformation->orderBy('id', 'DESC')->get();
    $ed_data = false;
    if ($req->id) {
      $ed_data = DB::table('information_monthly_report')->where('id', $req->id)->first();
    }

    return view('admin.information_details.monthlyinformation', [
      'monthlyInformation' => $monthlyInformation,
      'districts' => $districts,
      'tehsils' => $tehsils,
      'district_id_monthly' => $district_id_monthly,
      'admin_id' => $admin_id,
      'sports' => $sports,
      'ed_data' => $ed_data
    ]);
  }

  public function incentiveCommittee(Request $req)
  {
    if ($req->method() == "POST") {
      $validation = Validator::make($req->all(), [
        'month_name' => 'required',
        'year_name' => 'required',
        'district_name' => 'required',
        'meeting_held' => 'required',
        'beneficiaries_selected' => 'required',
        'amount_distributed' => 'required',
      ]);

      if ($validation->fails()) {
        return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
      }

      $data = [
        'month_name' => $req->month_name,
        'year' => $req->year_name,
        'district_id' => $req->district_name,
        'meeting_held' => $req->meeting_held,
        'beneficiaries_selected' => $req->beneficiaries_selected,
        'amount_distributed' => $req->amount_distributed,
        'comment' => $req->comment
      ];

      if ($req->id) {
        DB::table('information_incentive_committee')->where('id', $req->id)->update($data);
        return response()->json(['error' => false, 'msg' => "Data Update successfully", 'url' => route('incentiveCommittee')]);
      } else {
        DB::table('information_incentive_committee')->insert($data);
        return response()->json(['error' => false, 'msg' => "Data Saved successfully", 'url' => route('incentiveCommittee')]);
      }
    }

    $district_id_incentive = Auth::guard('admin')->user()->district_id;
    $admin_id = Auth::guard('admin')->user()->admin_role;
    $sports = DB::table('sport_type')->orderBy('name', 'ASC')->get();
    $districts = DB::table('cities')->select('city', 'id')->where('state_id', '23')->orderBy('city')->get();

    $incentiveCommittee = DB::table('information_incentive_committee')
      ->join('hostel_div_district_mapping', 'information_incentive_committee.district_id', '=', 'hostel_div_district_mapping.district_id');

    if ($admin_id == 1 || $admin_id == 18) {
        $division = DB::table('hostel_division_master')->select('division_name', 'id')->orderBy('division_name')->get();
    } elseif ($admin_id == 9) {
        $incentiveCommittee->where('information_incentive_committee.district_id', $district_id_incentive);
        $division = DB::table('hostel_division_master')
            ->join('hostel_div_district_mapping','hostel_division_master.id','=','hostel_div_district_mapping.division_id')
            ->select('hostel_division_master.division_name','hostel_division_master.id')->where('hostel_div_district_mapping.district_id',$district_id_incentive)->get();
    } elseif ($admin_id == 2) {
        $division_id = Auth::guard('admin')->user()->division_id;
        $district_list = DB::table('hostel_div_district_mapping')->where('division_id', $division_id)->pluck('district_id');
        $incentiveCommittee->whereIn('information_incentive_committee.district_id', $district_list);
        $division = DB::table('hostel_division_master')->select('division_name','id')->where('id',$division_id)->get();
    }

    $incentiveCommittee = $incentiveCommittee->select('information_incentive_committee.*')->orderBy('id', 'DESC')->get();
    $ed_data = false;
    if ($req->id) {
      $ed_data = DB::table('information_incentive_committee')->where('id', $req->id)->first();
    }

    return view('admin.information_details.incentivecommittee', [
      'incentiveCommittee' => $incentiveCommittee,
      'districts' => $districts,
      'division' => $division ?? [],
      'admin_id' => $admin_id,
      'sports' => $sports,
      'ed_data' => $ed_data
    ]);
  }

  public function sportsInfrastructure(Request $req)
  {
    if ($req->method() == "POST") {
      $validation = Validator::make($req->all(), [
        'month_name' => 'required',
        'year_name' => 'required',
        'district_name' => 'required',
        'tehsil_name' => 'required',
        'infrastructure_name' => 'required',
        'physical_status' => 'required',
        'financial_status' => 'required',
      ]);

      if ($validation->fails()) {
        return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
      }

      $data = [
        'month_name' => $req->month_name,
        'year' => $req->year_name,
        'district_id' => $req->district_name,
        'tehsil_id' => $req->tehsil_name,
        'infrastructure_name' => $req->infrastructure_name,
        'physical_status' => $req->physical_status,
        'financial_status' => $req->financial_status,
        'comment' => $req->comment
      ];

      if ($req->id) {
        DB::table('information_sports_infrastructure')->where('id', $req->id)->update($data);
        return response()->json(['error' => false, 'msg' => "Data Update successfully", 'url' => route('sportsInfrastructure')]);
      } else {
        DB::table('information_sports_infrastructure')->insert($data);
        return response()->json(['error' => false, 'msg' => "Data Saved successfully", 'url' => route('sportsInfrastructure')]);
      }
    }

    $district_id_infra = Auth::guard('admin')->user()->district_id;
    $admin_id = Auth::guard('admin')->user()->admin_role;
    $sports = DB::table('sport_type')->orderBy('name', 'ASC')->get();
    $districts = DB::table('cities')->select('city', 'id')->where('state_id', '23')->orderBy('city')->get();
    $tehsils = DB::table('tehsil_master')->select('Tehsil_Name', 'id')->where('dist_id', $district_id_infra)->get();

    $sportsInfrastructure = DB::table('information_sports_infrastructure')
      ->join('hostel_div_district_mapping', 'information_sports_infrastructure.district_id', '=', 'hostel_div_district_mapping.district_id');

    if ($admin_id == 1 || $admin_id == 18) {
      $division = DB::table('hostel_division_master')->select('division_name', 'id')->orderBy('division_name')->get();
    } elseif ($admin_id == 9) {
      $sportsInfrastructure->where('information_sports_infrastructure.district_id', $district_id_infra);
      $division = DB::table('hostel_division_master')
        ->join('hostel_div_district_mapping', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
        ->select('hostel_division_master.division_name', 'hostel_division_master.id')->where('hostel_div_district_mapping.district_id', $district_id_infra)->get();
    } elseif ($admin_id == 2) {
      $division_id = Auth::guard('admin')->user()->division_id;
      $district_list = DB::table('hostel_div_district_mapping')->where('division_id', $division_id)->pluck('district_id');
      $sportsInfrastructure->whereIn('information_sports_infrastructure.district_id', $district_list);
      $division = DB::table('hostel_division_master')->select('division_name', 'id')->where('id', $division_id)->get();
    }

    $sportsInfrastructure = $sportsInfrastructure->select('information_sports_infrastructure.*')->orderBy('id', 'DESC')->get();
    $ed_data = false;
    if ($req->id) {
      $ed_data = DB::table('information_sports_infrastructure')->where('id', $req->id)->first();
    }

    return view('admin.information_details.sportsinfrastructure', [
      'sportsInfrastructure' => $sportsInfrastructure,
      'districts' => $districts,
      'tehsils' => $tehsils,
      'division' => $division ?? [],
      'admin_id' => $admin_id,
      'sports' => $sports,
      'ed_data' => $ed_data
    ]);
  }

  public function departmentalRevenue(Request $req)
  {
    if ($req->method() == "POST") {
      $validation = Validator::make($req->all(), [
        'month_name' => 'required',
        'year_name' => 'required',
        'district_name' => 'required',
        'revenue_source' => 'required',
        'amount_collected' => 'required',
      ]);

      if ($validation->fails()) {
        return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
      }

      $data = [
        'month_name' => $req->month_name,
        'year' => $req->year_name,
        'district_id' => $req->district_name,
        'revenue_source' => $req->revenue_source,
        'amount_collected' => $req->amount_collected,
        'comment' => $req->comment
      ];

      if ($req->id) {
        DB::table('information_revenue_income')->where('id', $req->id)->update($data);
        return response()->json(['error' => false, 'msg' => "Data Update successfully", 'url' => route('departmentalRevenue')]);
      } else {
        DB::table('information_revenue_income')->insert($data);
        return response()->json(['error' => false, 'msg' => "Data Saved successfully", 'url' => route('departmentalRevenue')]);
      }
    }

    $district_id_rev = Auth::guard('admin')->user()->district_id;
    $admin_id = Auth::guard('admin')->user()->admin_role;
    $sports = DB::table('sport_type')->orderBy('name', 'ASC')->get();
    $districts = DB::table('cities')->select('city', 'id')->where('state_id', '23')->orderBy('city')->get();

    $departmentalRevenue = DB::table('information_revenue_income')
      ->join('hostel_div_district_mapping', 'information_revenue_income.district_id', '=', 'hostel_div_district_mapping.district_id');

    if ($admin_id == 1 || $admin_id == 18) {
      $division = DB::table('hostel_division_master')->select('division_name', 'id')->orderBy('division_name')->get();
    } elseif ($admin_id == 9) {
      $departmentalRevenue->where('information_revenue_income.district_id', $district_id_rev);
      $division = DB::table('hostel_division_master')
        ->join('hostel_div_district_mapping', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
        ->select('hostel_division_master.division_name', 'hostel_division_master.id')->where('hostel_div_district_mapping.district_id', $district_id_rev)->get();
    } elseif ($admin_id == 2) {
      $division_id = Auth::guard('admin')->user()->division_id;
      $district_list = DB::table('hostel_div_district_mapping')->where('division_id', $division_id)->pluck('district_id')->toArray();
      $departmentalRevenue->whereIn('information_revenue_income.district_id', $district_list);
      $division = DB::table('hostel_division_master')->select('division_name', 'id')->where('id', $division_id)->get();
    }

    $departmentalRevenue = $departmentalRevenue->select('information_revenue_income.*')->orderBy('id', 'DESC')->get();
    $ed_data = false;
    if ($req->id) {
      $ed_data = DB::table('information_revenue_income')->where('id', $req->id)->first();
    }

    return view('admin.information_details.rajasv_praptiya', [
      'rajasv_praptiya' => $departmentalRevenue,
      'districts' => $districts,
      'division' => $division ?? [],
      'admin_id' => $admin_id,
      'sports' => $sports,
      'ed_data' => $ed_data
    ]);
  }

  public function organizedCompetition(Request $req)
  {
    if ($req->method() == "POST") {
      $validation = Validator::make($req->all(), [
        'month_name' => 'required',
        'year_name' => 'required',
        'district_name' => 'required',
        'competition_name' => 'required',
        'venue' => 'required',
        'number_of_participants' => 'required',
      ]);

      if ($validation->fails()) {
        return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
      }

      $data = [
        'month_name' => $req->month_name,
        'year' => $req->year_name,
        'district_id' => $req->district_name,
        'competition_name' => $req->competition_name,
        'venue' => $req->venue,
        'number_of_participants' => $req->number_of_participants,
        'comment' => $req->comment
      ];

      if ($req->id) {
        DB::table('information_organized_competition')->where('id', $req->id)->update($data);
        return response()->json(['error' => false, 'msg' => "Data Update successfully", 'url' => route('organizedCompetition')]);
      } else {
        DB::table('information_organized_competition')->insert($data);
        return response()->json(['error' => false, 'msg' => "Data Saved successfully", 'url' => route('organizedCompetition')]);
      }
    }

    $district_id_comp = Auth::guard('admin')->user()->district_id;
    $admin_id = Auth::guard('admin')->user()->admin_role;
    $sports = DB::table('sport_type')->orderBy('name', 'ASC')->get();
    $districts = DB::table('cities')->select('city', 'id')->where('state_id', '23')->orderBy('city')->get();

    $organizedCompetition = DB::table('information_organized_competition')
      ->join('hostel_div_district_mapping', 'information_organized_competition.district_id', '=', 'hostel_div_district_mapping.district_id');

    if ($admin_id == 1 || $admin_id == 18) {
      $division = DB::table('hostel_division_master')->select('division_name', 'id')->orderBy('division_name')->get();
    } elseif ($admin_id == 9) {
      $organizedCompetition->where('information_organized_competition.district_id', $district_id_comp);
      $division = DB::table('hostel_division_master')
        ->join('hostel_div_district_mapping', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
        ->select('hostel_division_master.division_name', 'hostel_division_master.id')->where('hostel_div_district_mapping.district_id', $district_id_comp)->get();
    } elseif ($admin_id == 2) {
      $division_id = Auth::guard('admin')->user()->division_id;
      $district_list = DB::table('hostel_div_district_mapping')->where('division_id', $division_id)->pluck('district_id');
      $organizedCompetition->whereIn('information_organized_competition.district_id', $district_list);
      $division = DB::table('hostel_division_master')->select('division_name', 'id')->where('id', $division_id)->get();
    }

    $organizedCompetition = $organizedCompetition->select('information_organized_competition.*')->orderBy('id', 'DESC')->get();
    $ed_data = false;
    if ($req->id) {
      $ed_data = DB::table('information_organized_competition')->where('id', $req->id)->first();
    }

    return view('admin.information_details.organizedcompetition', [
      'organizedCompetition' => $organizedCompetition,
      'districts' => $districts,
      'division' => $division ?? [],
      'admin_id' => $admin_id,
      'sports' => $sports,
      'ed_data' => $ed_data
    ]);
  }

  public function infoFinancialReport(Request $req)
  {
    if ($req->method() == "POST") {
      $validation = Validator::make($req->all(), [
        'month_name' => 'required',
        'year' => 'required',
        'district_id' => 'required',
        'opening_balance_current_year' => 'required',
        'amount_received_current_month' => 'required',
        'amount_spent_current_month' => 'required',
        'total_balance_deposited_till_current_month' => 'required',
        'total_amount_received_till_current_month' => 'required',
        'total_amount_received_till_same_month_last_year' => 'required',
      ]);

      if ($validation->fails()) {
        return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
      }

      $data = [
        'month_name' => $req->month_name,
        'year' => $req->year,
        'district_id' => $req->district_id,
        'opening_balance_current_year' => $req->opening_balance_current_year,
        'amount_received_current_month' => $req->amount_received_current_month,
        'amount_spent_current_month' => $req->amount_spent_current_month,
        'total_balance_deposited_till_current_month' => $req->total_balance_deposited_till_current_month,
        'total_amount_received_till_current_month' => $req->total_amount_received_till_current_month,
        'total_amount_received_till_same_month_last_year' => $req->total_amount_received_till_same_month_last_year,
        'growth' => $req->growth,
        'shortage' => $req->shortage,
      ];

      if ($req->id) {
        DB::table('information_financial')->where('id', $req->id)->update($data);
        return response()->json(['error' => false, 'msg' => "Data Update successfully", 'url' => route('infoFinancialReport')]);
      } else {
        DB::table('information_financial')->insert($data);
        return response()->json(['error' => false, 'msg' => "Data Saved successfully", 'url' => route('infoFinancialReport')]);
      }
    }

    $district_id_fin = Auth::guard('admin')->user()->district_id;
    $admin_id = Auth::guard('admin')->user()->admin_role;
    $sports = DB::table('sport_type')->orderBy('name', 'ASC')->get();
    $districts = DB::table('cities')->select('city', 'id')->where('state_id', '23')->orderBy('city')->get();

    $infoFinancialReport = DB::table('information_financial')
      ->join('hostel_div_district_mapping', 'information_financial.district_id', '=', 'hostel_div_district_mapping.district_id');

    if ($admin_id == 1 || $admin_id == 18) {
      $division = DB::table('hostel_division_master')->select('division_name', 'id')->orderBy('division_name')->get();
    } elseif ($admin_id == 9) {
      $infoFinancialReport->where('information_financial.district_id', $district_id_fin);
      $division = DB::table('hostel_division_master')
        ->join('hostel_div_district_mapping', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
        ->select('hostel_division_master.division_name', 'hostel_division_master.id')->where('hostel_div_district_mapping.district_id', $district_id_fin)->get();
    } elseif ($admin_id == 2) {
      $division_id = Auth::guard('admin')->user()->division_id;
      $district_list = DB::table('hostel_div_district_mapping')->where('division_id', $division_id)->pluck('district_id')->toArray();
      $infoFinancialReport->whereIn('information_financial.district_id', $district_list);
      $division = DB::table('hostel_division_master')->select('division_name', 'id')->where('id', $division_id)->get();
    }

    $infoFinancialReport = $infoFinancialReport->select('information_financial.*')->orderBy('id', 'DESC')->get();
    $ed_data = false;
    if ($req->id) {
      $ed_data = DB::table('information_financial')->where('id', $req->id)->first();
    }

    $tehsils = DB::table('tehsil_master')->select('Tehsil_Name', 'id')->get();
    return view('admin.information_details.informationFinancialReport', [
      'financialInformation' => $infoFinancialReport,
      'districts' => $districts,
      'tehsils' => $tehsils,
      'division' => $division ?? [],
      'admin_id' => $admin_id,
      'sports' => $sports,
      'ed_data' => $ed_data,
      'district_id_financial' => $district_id_fin
    ]);
  }

  public function delete_inf($id, $tbl)
  {
    DB::table($tbl)->where('id', '=', $id)->delete();
    return redirect()->back()->with("success", "Successfully Deleted.");
  }
}
