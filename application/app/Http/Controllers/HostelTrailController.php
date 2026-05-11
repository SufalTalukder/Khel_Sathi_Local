<?php

namespace App\Http\Controllers;

use App\Imports\DataImports;
use App\Imports\Resultupdate;
use App\Models\DivisionModel;
use App\Models\HostelRegister;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\Session;
use Throwable;

class HostelTrailController extends Controller
{

  public $sport;
  public $subsport;



  public function trialList(Request $request)
  {
    $trialType = 18;

    $sports = DB::table('sport_master')->where('status', 1)->orderBy('name', 'asc')->get();
    $division = DB::table('hostel_division_master')->get();



    $check = DB::table('hostel_div_district_mapping')
      ->select(DB::raw('group_concat(district_id) as district_id'))->where('division_id', Auth::guard('admin')->user()->division_id)->get();
    $districts = DB::table('cities')->where('state_id', 23);

    if (Auth::guard('admin')->user()->division_id) {

      $districts->whereIn('id', explode(',', $check[0]->district_id));
    }


    $districts =   $districts->orderBy('city', 'asc')->get();


    if ($request->post()) {
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



      if ($request->sport == 6 && $subSport == 21   && in_array($gender, [1, 2, 3])) {
        $trialType = 1;

        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'cities.city', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')

          ->where('basic.sports', $request->sport)
          ->where('basic.sub_sport_type', $request->subsport)

          ->where('hr.existing_student', '!=', 1)
          ->whereIn('hr.trial_one', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1);



        if (Auth::guard('admin')->user()->district_id > 0) {

          $applicants->where('basic.district_id', Auth::guard('admin')->user()->district_id);
        }
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('basic.district_id', $request->division_id);
        }


        if (Auth::guard('admin')->user()->division_id) {

          $applicants->whereIn('basic.district_id', explode(',', $check[0]->district_id));
        }


        $applicants = $applicants->where('hr.payment_status', 2)->where('hr.level', 4)->where('hr.session_year', '2026')->get();
      } elseif ($request->sport == 6 && $subSport == 20  && in_array($gender, [1, 2, 3])) {
        $trialType = 2;

        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'cities.city', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')

          ->where('basic.sports', $request->sport)
          ->where('basic.sub_sport_type', $request->subsport)
          ->whereNull('hr.cancel_status')

          ->where('hr.existing_student', '!=', 1)->where('hr.status', 1)
          ->whereIn('hr.trial_one', [1, 2, 3]);

        if (Auth::guard('admin')->user()->district_id > 0) {

          $applicants->where('basic.district_id', Auth::guard('admin')->user()->district_id);
        }
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('basic.district_id', $request->division_id);
        }


        if (Auth::guard('admin')->user()->division_id) {

          $applicants->whereIn('basic.district_id', explode(',', $check[0]->district_id));
        }

        $applicants = $applicants->where('hr.payment_status', 2)->where('hr.level', 4)->where('hr.session_year', '2026')->get();
      } elseif ($request->sport == 43  && in_array($gender, [1, 2, 3])) {
        $trialType = 3;


        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'cities.city', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)

          ->where('hr.existing_student', '!=', 1)->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_one', [1, 2, 3]);
        if (Auth::guard('admin')->user()->district_id > 0) {

          $applicants->where('basic.district_id', Auth::guard('admin')->user()->district_id);
        }
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('basic.district_id', $request->division_id);
        }


        if (Auth::guard('admin')->user()->division_id) {

          $applicants->whereIn('basic.district_id', explode(',', $check[0]->district_id));
        }
        $applicants = $applicants->where('hr.payment_status', 2)->where('hr.level', 4)->where('hr.session_year', '2026')->get();
      } elseif ($request->sport == 10  && in_array($gender, [1, 2, 3])) {
        $trialType = 4;

        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'cities.city', 'hr.dob', 'hr.gender',  'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)

          ->where('hr.existing_student', '!=', 1)->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_one', [1, 2, 3]);
        if (Auth::guard('admin')->user()->district_id > 0) {

          $applicants->where('basic.district_id', Auth::guard('admin')->user()->district_id);
        }
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('basic.district_id', $request->division_id);
        }
        if (Auth::guard('admin')->user()->division_id) {

          $applicants->whereIn('basic.district_id', explode(',', $check[0]->district_id));
        }


        $applicants = $applicants->where('hr.payment_status', 2)->where('hr.level', 4)->where('hr.session_year', '2026')->get();

        # code...
      } elseif ($request->sport == 9  && in_array($gender, [1, 2, 3])) {
        $trialType = 6;

        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'cities.city', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('basic.sports', $request->sport)
          ->whereNull('hr.cancel_status')

          ->where('hr.existing_student', '!=', 1)->where('hr.status', 1)
          ->whereIn('hr.trial_one', [1, 2, 3]);
        if (Auth::guard('admin')->user()->district_id > 0) {

          $applicants->where('basic.district_id', Auth::guard('admin')->user()->district_id);
        }
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('basic.district_id', $request->division_id);
        }

        if (Auth::guard('admin')->user()->division_id) {

          $applicants->whereIn('basic.district_id', explode(',', $check[0]->district_id));
        }
        $applicants = $applicants->where('hr.payment_status', 2)->where('hr.level', 4)->where('hr.session_year', '2026')->get();
      } elseif ($request->sport == 4 && $request->subsport == 22 && in_array($gender, [1, 2, 3])) {

        $trialType = 7;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'cities.city',  'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('basic.sports', $request->sport)

          ->where('hr.existing_student', '!=', 1)->where('basic.sub_sport_type', $request->subsport)
          ->whereIn('hr.trial_one', [1, 2, 3]);
        if (Auth::guard('admin')->user()->district_id > 0) {

          $applicants->where('basic.district_id', Auth::guard('admin')->user()->district_id);
        }
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('basic.district_id', $request->division_id);
        }

        if (Auth::guard('admin')->user()->division_id) {

          $applicants->whereIn('basic.district_id', explode(',', $check[0]->district_id));
        }

        $applicants = $applicants->where('hr.payment_status', 2)->where('hr.level', 4)->where('hr.session_year', '2026')->get();
      } elseif ($request->sport == 3 && $subSport == 24 && in_array($gender, [1, 2, 3])) {
        $trialType = 10;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'cities.city', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('basic.sub_sport_type', $request->subsport)
          ->where('basic.sports', $request->sport)
          ->where('hr.gender', 1)
          ->whereNull('hr.cancel_status')

          ->where('hr.existing_student', '!=', 1)->where('hr.status', 1)
          ->whereIn('hr.trial_one', [1, 2, 3]);
        if (Auth::guard('admin')->user()->district_id > 0) {

          $applicants->where('basic.district_id', Auth::guard('admin')->user()->district_id);
        }
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('basic.district_id', $request->division_id);
        }


        if (Auth::guard('admin')->user()->division_id) {

          $applicants->whereIn('basic.district_id', explode(',', $check[0]->district_id));
        }
        $applicants = $applicants->where('hr.payment_status', 2)->where('hr.level', 4)->where('hr.session_year', '2026')->get();

        //trial_type
      } elseif ($request->sport == 3 && $subSport == 26 && in_array($gender, [1, 2, 3])) {
        $trialType = 12;

        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'cities.city', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('basic.sub_sport_type', $request->subsport)
          ->where('basic.sports', $request->sport)
          ->where('hr.gender', 1)
          ->whereNull('hr.cancel_status')

          ->where('hr.existing_student', '!=', 1)->where('hr.status', 1)
          ->whereIn('hr.trial_one', [1, 2, 3]);
        if (Auth::guard('admin')->user()->district_id > 0) {

          $applicants->where('basic.district_id', Auth::guard('admin')->user()->district_id);
        }
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('basic.district_id', $request->division_id);
        }

        if (Auth::guard('admin')->user()->division_id) {

          $applicants->whereIn('basic.district_id', explode(',', $check[0]->district_id));
        }

        $applicants = $applicants->where('hr.payment_status', 2)->where('hr.level', 4)->where('hr.session_year', '2026')->get();
      } elseif ($request->sport == 3 && $subSport == 25  && in_array($gender, [1, 2, 3])) {
        $trialType = 11;

        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'cities.city',  'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('basic.sub_sport_type', $request->subsport)
          ->where('basic.sports', $request->sport)
          ->where('hr.gender', 1)
          ->whereNull('hr.cancel_status')

          ->where('hr.existing_student', '!=', 1)->where('hr.status', 1)
          ->whereIn('hr.trial_one', [1, 2, 3]);
        if (Auth::guard('admin')->user()->district_id > 0) {

          $applicants->where('basic.district_id', Auth::guard('admin')->user()->district_id);
        }
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('basic.district_id', $request->division_id);
        }
        if (Auth::guard('admin')->user()->division_id) {

          $applicants->whereIn('basic.district_id', explode(',', $check[0]->district_id));
        }
        $applicants = $applicants->where('hr.payment_status', 2)->where('hr.level', 4)->where('hr.session_year', '2026')->get();
      } elseif ($request->sport == 42  && $request->subsport == "11" && in_array($gender, [1, 2, 3])) {

        $trialType = 9;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'cities.city', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('basic.sports', $request->sport)

          ->where('hr.existing_student', '!=', 1)->where('basic.sub_sport_type', $request->subsport)
          ->whereIn('hr.trial_one', [1, 2, 3])

          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1);
        if (Auth::guard('admin')->user()->district_id > 0) {

          $applicants->where('basic.district_id', Auth::guard('admin')->user()->district_id);
        }
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('basic.district_id', $request->division_id);
        }
        if (Auth::guard('admin')->user()->division_id) {

          $applicants->whereIn('basic.district_id', explode(',', $check[0]->district_id));
        }

        $applicants = $applicants->where('hr.payment_status', 2)->where('hr.level', 4)->where('hr.session_year', '2026')->get();
      } elseif ($request->sport == 42  && $request->subsport == 10 && in_array($gender, [1, 2, 3])) {

        $trialType = 15;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'cities.city',  'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('basic.sports', $request->sport)

          ->where('hr.existing_student', '!=', 1)->where('basic.sub_sport_type', $request->subsport)
          ->whereIn('hr.trial_one', [1, 2, 3])

          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1);
        if (Auth::guard('admin')->user()->district_id > 0) {

          $applicants->where('basic.district_id', Auth::guard('admin')->user()->district_id);
        }
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('basic.district_id', $request->division_id);
        }


        if (Auth::guard('admin')->user()->division_id) {

          $applicants->whereIn('basic.district_id', explode(',', $check[0]->district_id));
        }

        $applicants = $applicants->where('hr.payment_status', 2)->where('hr.level', 4)->where('hr.session_year', '2026')->get();
      } elseif ($request->sport == 7 && in_array($gender, [1, 2, 3])) {
        $trialType = 14;

        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'cities.city',  'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('hr.gender', 1)

          ->where('hr.existing_student', '!=', 1)->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_one', [1, 2, 3])

          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1);
        if (Auth::guard('admin')->user()->district_id > 0) {

          $applicants->where('basic.district_id', Auth::guard('admin')->user()->district_id);
        }
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('basic.district_id', $request->division_id);
        }
        if (Auth::guard('admin')->user()->division_id) {

          $applicants->whereIn('basic.district_id', explode(',', $check[0]->district_id));
        }

        $applicants = $applicants->where('hr.payment_status', 2)->where('hr.level', 4)->where('hr.session_year', '2026')->get();

        # code...
      } elseif ($request->sport == 8 && in_array($gender, [1, 2, 3])) {
        $trialType = 13;


        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'cities.city',  'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')


          ->where('hr.existing_student', '!=', 1)->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_one', [1, 2, 3])

          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1);
        if (Auth::guard('admin')->user()->district_id > 0) {

          $applicants->where('basic.district_id', Auth::guard('admin')->user()->district_id);
        }
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('basic.district_id', $request->division_id);
        }
        if (Auth::guard('admin')->user()->division_id) {

          $applicants->whereIn('basic.district_id', explode(',', $check[0]->district_id));
        }

        $applicants = $applicants->where('hr.payment_status', 2)->where('hr.level', 4)->where('hr.session_year', '2026')->get();
      } elseif ($request->sport == 25  && in_array($gender, [1, 2, 3])) {
        $trialType = 5;

        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'cities.city', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')


          ->where('hr.existing_student', '!=', 1)->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_one', [1, 2, 3])

          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1);
        if (Auth::guard('admin')->user()->district_id > 0) {

          $applicants->where('basic.district_id', Auth::guard('admin')->user()->district_id);
        }
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('basic.district_id', $request->division_id);
        }
        if (Auth::guard('admin')->user()->division_id) {

          $applicants->whereIn('basic.district_id', explode(',', $check[0]->district_id));
        }


        $applicants = $applicants->where('hr.payment_status', 2)->where('hr.level', 4)->where('hr.session_year', '2026')->get();
      } elseif ($request->sport == 42 && $request->subsport == 12 && in_array($gender, [1, 2, 3])) {
        $trialType = 19;

        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'cities.city',  'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('basic.sub_sport_type', $request->subsport)

          ->where('hr.existing_student', '!=', 1)->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_one', [1, 2, 3])

          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1);
        if (Auth::guard('admin')->user()->district_id > 0) {

          $applicants->where('basic.district_id', Auth::guard('admin')->user()->district_id);
        }
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('basic.district_id', $request->division_id);
        }
        if (Auth::guard('admin')->user()->division_id) {

          $applicants->whereIn('basic.district_id', explode(',', $check[0]->district_id));
        }
        $applicants = $applicants->where('hr.payment_status', 2)->where('hr.level', 4)->where('hr.session_year', '2026')->get();
      } elseif ($request->sport == 5  && in_array($gender, [1, 2, 3])) {
        $trialType = 16;


        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'cities.city',  'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('hr.gender', $gender)

          ->where('hr.existing_student', '!=', 1)->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_one', [1, 2, 3])

          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1);
        if (Auth::guard('admin')->user()->district_id > 0) {

          $applicants->where('basic.district_id', Auth::guard('admin')->user()->district_id);
        }
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('basic.district_id', $request->division_id);
        }
        if (Auth::guard('admin')->user()->division_id) {

          $applicants->whereIn('basic.district_id', explode(',', $check[0]->district_id));
        }


        $applicants = $applicants->where('hr.payment_status', 2)->where('hr.level', 4)->where('hr.session_year', '2026')->get();
      } elseif ($request->sport == 5  && in_array($gender, [1, 2, 3])) {
        $trialType = 17;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'cities.city', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('hr.gender', $gender)

          ->where('hr.existing_student', '!=', 1)->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_one', [1, 2, 3])

          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1);
        if (Auth::guard('admin')->user()->district_id > 0) {

          $applicants->where('basic.district_id', Auth::guard('admin')->user()->district_id);
        }
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('basic.district_id', $request->division_id);
        }
        if (Auth::guard('admin')->user()->division_id) {

          $applicants->whereIn('basic.district_id', explode(',', $check[0]->district_id));
        }

        $applicants = $applicants->where('hr.payment_status', 2)->where('hr.level', 4)->where('hr.session_year', '2026')->get();
      } elseif ($request->sport == 4 && $subSport == 23 && in_array($gender, [1, 2, 3])) {
        $trialType = 8;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'cities.city', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('basic.sub_sport_type', $request->subsport)

          ->where('hr.existing_student', '!=', 1)->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_one', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1);
        if (Auth::guard('admin')->user()->district_id > 0) {

          $applicants->where('basic.district_id', Auth::guard('admin')->user()->district_id);
        }
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('basic.district_id', $request->division_id);
        }

        if (Auth::guard('admin')->user()->division_id) {

          $applicants->whereIn('basic.district_id', explode(',', $check[0]->district_id));
        }


        $applicants = $applicants->where('hr.payment_status', 2)->where('hr.level', 4)->where('hr.session_year', '2026')->get();
      } elseif ($request->sport == 15 && in_array($gender, [1, 2, 3])) {
        $trialType = 20;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'cities.city',  'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')


          ->where('hr.existing_student', '!=', 1)->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_one', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1);
        if (Auth::guard('admin')->user()->district_id > 0) {

          $applicants->where('basic.district_id', Auth::guard('admin')->user()->district_id);
        }
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('basic.district_id', $request->division_id);
        }
        if (Auth::guard('admin')->user()->division_id) {

          $applicants->whereIn('basic.district_id', explode(',', $check[0]->district_id));
        }

        $applicants = $applicants->where('hr.payment_status', 2)->where('hr.level', 4)->where('hr.session_year', '2026')->get();
      } elseif ($request->sport == 14 && in_array($gender, [1, 2, 3])) {
        $trialType = 21;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'cities.city', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')


          ->where('hr.existing_student', '!=', 1)->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_one', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1);
        if (Auth::guard('admin')->user()->district_id > 0) {

          $applicants->where('basic.district_id', Auth::guard('admin')->user()->district_id);
        }
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('basic.district_id', $request->division_id);
        }

        if (Auth::guard('admin')->user()->division_id) {

          $applicants->whereIn('basic.district_id', explode(',', $check[0]->district_id));
        }

        $applicants = $applicants->where('hr.payment_status', 2)->where('hr.level', 4)->where('hr.session_year', '2026')->get();
      } elseif ($request->sport == 23 && in_array($gender, [1, 2, 3])) {
        $trialType = 22;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'cities.city',  'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')

          ->where('hr.existing_student', '!=', 1)->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_one', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1);
        if (Auth::guard('admin')->user()->district_id > 0) {

          $applicants->where('basic.district_id', Auth::guard('admin')->user()->district_id);
        }
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('basic.district_id', $request->division_id);
        }
        if (Auth::guard('admin')->user()->division_id) {

          $applicants->whereIn('basic.district_id', explode(',', $check[0]->district_id));
        }

        $applicants = $applicants->where('hr.payment_status', 2)->where('hr.level', 4)->where('hr.session_year', '2026')->get();
      } elseif ($request->sport == 20 && in_array($gender, [1, 2, 3])) {
        $trialType = 23;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'cities.city',  'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')


          ->where('hr.existing_student', '!=', 1)->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_one', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1);
        if (Auth::guard('admin')->user()->district_id > 0) {

          $applicants->where('basic.district_id', Auth::guard('admin')->user()->district_id);
        }
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('basic.district_id', $request->division_id);
        }
        if (Auth::guard('admin')->user()->division_id) {

          $applicants->whereIn('basic.district_id', explode(',', $check[0]->district_id));
        }
        $applicants = $applicants->where('hr.payment_status', 2)->where('hr.level', 4)->where('hr.session_year', '2026')->get();
      } elseif ($request->sport == 44 && in_array($gender, [1, 2, 3])) {


        $trialType = 24;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'cities.city',  'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')


          ->where('hr.existing_student', '!=', 1)->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_one', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1);
        if (Auth::guard('admin')->user()->district_id > 0) {

          $applicants->where('basic.district_id', Auth::guard('admin')->user()->district_id);
        }
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('basic.district_id', $request->division_id);
        }
        if (Auth::guard('admin')->user()->division_id) {

          $applicants->whereIn('basic.district_id', explode(',', $check[0]->district_id));
        }

        $applicants = $applicants->where('hr.payment_status', 2)->where('hr.level', 4)->where('hr.session_year', '2026')->get();
      } else {
        $trialType = 18;



        $applicants = [];
      }





      return view('hosteltrial.trialListApplicant', compact('trialType', 'sports', 'applicants',  'filterData', 'filtsubSport', 'subSport', 'districts'));
    }



    return view('hosteltrial.trialListApplicant', compact('trialType', 'sports', 'districts'));
  }


  public function get_gender(Request $req)
  {
    $id = $req->sport;
    $all_sport = DB::table('sub_sport_type')->where('sport_id', $id)->get();

    $gender = "";


    if ($id == 6 || $id == 10 || $id == 43   || $id == 44  || $id == 20 || $id == 23 || $id == 14 || $id == 25  || $id == 42 || $id == 8 || $id == 9 | $id == 15) {
      $gender = 3;
    } elseif ($id == 3 || $id == 7 || $id == 4) {
      $gender = 1;
    } elseif ($id == 5) {
      $gender = 4;
    }




    return   response()->json(["sub_type" => $all_sport, "gender" => $gender]);
  }



  public function trialListtwo(Request $request)
  {
    $trialType = 18;

    $sports =   DB::table('sport_master')->where('status', 1)->orderBy('name', 'asc')->get();
    $division = DB::table('hostel_division_master')->orderBy('division_name', 'asc')->get();
    $allSubSports = DB::table('sub_sport_type')->get();




    $check = DB::table('hostel_div_district_mapping')
      ->select(DB::raw('group_concat(district_id) as district_id'))->where('division_id', Auth::guard('admin')->user()->division_id)->get();
    $districts = DB::table('cities')->where('state_id', 23);

    if (Auth::guard('admin')->user()->division_id) {

      $districts->whereIn('id', explode(',', $check[0]->district_id));
    }


    $districts =   $districts->orderBy('city', 'asc')->get();
    if ($request->post()) {


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

      $sport = $request->sport;



      if ($request->sport == 6 && $subSport == 21   && in_array($gender, [1, 2, 3])) {
        $trialType = 1;

        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('basic.sub_sport_type', $request->subsport)
          ->where('basic.sports', $request->sport)
          ->where('hr.district_level_approved', 1)
          ->whereIn('hr.trial_two', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1);

        if (Auth::guard('admin')->user()->division_id) {

          $applicants->whereIn('basic.district_id', explode(',', $check[0]->district_id));
        }

        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        }
        $applicants = $applicants->where('hr.level', 4)->where('hr.session_year', '2026')->get();
      } elseif ($request->sport == 6 && $subSport == 20  && in_array($gender, [1, 2, 3])) {
        $trialType = 2;

        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('basic.sub_sport_type', $request->subsport)
          ->where('basic.sports', $request->sport)
          ->where('hr.district_level_approved', 1)
          ->whereIn('hr.trial_two', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1);


        if (Auth::guard('admin')->user()->division_id) {

          $applicants->whereIn('basic.district_id', explode(',', $check[0]->district_id));
        }
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        }
        $applicants = $applicants->where('hr.level', 4)->where('hr.session_year', '2026')->get();
      } elseif ($request->sport == 43  && in_array($gender, [1, 2, 3])) {
        $trialType = 3;


        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('hr.district_level_approved', 1)
          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_two', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1);
        if (Auth::guard('admin')->user()->division_id) {

          $applicants->whereIn('basic.district_id', explode(',', $check[0]->district_id));
        }
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        }
        $applicants = $applicants->where('hr.level', 4)->where('hr.session_year', '2026')->get();
      } elseif ($request->sport == 10  && in_array($gender, [1, 2, 3])) {
        $trialType = 4;

        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender',  'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('hr.district_level_approved', 1)
          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_two', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1);

        if (Auth::guard('admin')->user()->division_id) {

          $applicants->whereIn('basic.district_id', explode(',', $check[0]->district_id));
        }
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        }
        $applicants = $applicants->where('hr.level', 4)->where('hr.session_year', '2026')->get();

        # code...
      } elseif ($request->sport == 9  && in_array($gender, [1, 2, 3])) {
        $trialType = 6;

        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_two', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.district_level_approved', 1);
        if (Auth::guard('admin')->user()->division_id) {

          $applicants->whereIn('basic.district_id', explode(',', $check[0]->district_id));
        }
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        }
        $applicants = $applicants->where('hr.level', 4)->where('hr.session_year', '2026')->get();
      } elseif ($request->sport == 4 && $request->subsport == 22 && in_array($gender, [1, 2, 3])) {
        $trialType = 7;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('basic.sub_sport_type', $request->subsport)
          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_two', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.district_level_approved', 1);
        if (Auth::guard('admin')->user()->division_id) {

          $applicants->whereIn('basic.district_id', explode(',', $check[0]->district_id));
        }
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        }
        $applicants = $applicants->where('hr.level', 4)->where('hr.session_year', '2026')->get();
      } elseif ($request->sport == 3 && $subSport == 24 && in_array($gender, [1, 2, 3])) {
        $trialType = 10;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('basic.sub_sport_type', $request->subsport)
          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_two', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.district_level_approved', 1);
        if (Auth::guard('admin')->user()->division_id) {

          $applicants->whereIn('basic.district_id', explode(',', $check[0]->district_id));
        }
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        }
        $applicants = $applicants->where('hr.level', 4)->where('hr.session_year', '2026')->get();

        //trial_type
      } elseif ($request->sport == 3 && $subSport == 26 && in_array($gender, [1, 2, 3])) {
        $trialType = 12;

        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('basic.sub_sport_type', $request->subsport)
          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_two', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.district_level_approved', 1);
        if (Auth::guard('admin')->user()->division_id) {

          $applicants->whereIn('basic.district_id', explode(',', $check[0]->district_id));
        }
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        }
        $applicants = $applicants->where('hr.level', 4)->where('hr.session_year', '2026')->get();
      } elseif ($request->sport == 3 && $subSport == 25  && in_array($gender, [1, 2, 3])) {
        $trialType = 11;

        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('basic.sub_sport_type', $request->subsport)
          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_two', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.district_level_approved', 1);
        if (Auth::guard('admin')->user()->division_id) {

          $applicants->whereIn('basic.district_id', explode(',', $check[0]->district_id));
        }
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        }
        $applicants = $applicants->where('hr.level', 4)->where('hr.session_year', '2026')->get();
      } elseif ($request->sport == 42  && $request->subsport == 11 && in_array($gender, [1, 2, 3])) {
        $trialType = 9;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('basic.sub_sport_type', $request->subsport)
          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_two', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.district_level_approved', 1);
        if (Auth::guard('admin')->user()->division_id) {

          $applicants->whereIn('basic.district_id', explode(',', $check[0]->district_id));
        }
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        }
        $applicants = $applicants->where('hr.level', 4)->where('hr.session_year', '2026')->get();
      } elseif ($request->sport == 42  && $request->subsport == 10 && in_array($gender, [1, 2, 3])) {

        $trialType = 15;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('basic.sports', $request->sport)
          ->where('basic.sub_sport_type', $request->subsport)
          ->whereIn('hr.trial_two', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.district_level_approved', 1);
        if (Auth::guard('admin')->user()->division_id) {

          $applicants->whereIn('basic.district_id', explode(',', $check[0]->district_id));
        }
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        }
        $applicants = $applicants->where('hr.level', 4)->where('hr.session_year', '2026')->get();
      } elseif ($request->sport == 7 && in_array($gender, [1, 2, 3])) {
        $trialType = 14;

        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('hr.district_level_approved', 1)
          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_two', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1);
        if (Auth::guard('admin')->user()->division_id) {

          $applicants->whereIn('basic.district_id', explode(',', $check[0]->district_id));
        }
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        }
        $applicants = $applicants->where('hr.level', 4)->where('hr.session_year', '2026')->get();

        # code...
      } elseif ($request->sport == 8 && in_array($gender, [1, 2, 3])) {
        $trialType = 13;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('hr.district_level_approved', 1)
          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_two', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1);
        if (Auth::guard('admin')->user()->division_id) {

          $applicants->whereIn('basic.district_id', explode(',', $check[0]->district_id));
        }
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        }
        $applicants = $applicants->where('hr.level', 4)->where('hr.session_year', '2026')->get();
      } elseif ($request->sport == 25  && in_array($gender, [1, 2, 3])) {
        $trialType = 5;

        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('hr.district_level_approved', 1)
          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_two', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1);
        if (Auth::guard('admin')->user()->division_id) {

          $applicants->whereIn('basic.district_id', explode(',', $check[0]->district_id));
        }
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        }
        $applicants = $applicants->where('hr.level', 4)->where('hr.session_year', '2026')->get();
      } elseif ($request->sport == 42  && $request->subsport == 12 && in_array($gender, [1, 2, 3])) {
        $trialType = 19;

        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('basic.sub_sport_type', $request->subsport)
          ->where('basic.sports', $request->sport)
          ->where('hr.district_level_approved', 1)
          ->whereIn('hr.trial_two', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1);
        if (Auth::guard('admin')->user()->division_id) {

          $applicants->whereIn('basic.district_id', explode(',', $check[0]->district_id));
        }
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        }
        $applicants = $applicants->where('hr.level', 4)->where('hr.session_year', '2026')->get();
      } elseif ($request->sport == 5  && in_array($gender, [1, 2, 3])) {
        $trialType = 16;


        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('hr.gender', $gender)
          ->where('hr.district_level_approved', 1)
          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_two', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1);
        if (Auth::guard('admin')->user()->division_id) {

          $applicants->whereIn('basic.district_id', explode(',', $check[0]->district_id));
        }
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        }
        $applicants = $applicants->where('hr.level', 4)->where('hr.session_year', '2026')->get();
      } elseif ($request->sport == 5  && in_array($gender, [1, 2, 3])) {
        $trialType = 17;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('hr.gender', $gender)
          ->where('hr.district_level_approved', 1)
          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_two', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1);
        if (Auth::guard('admin')->user()->division_id) {

          $applicants->whereIn('basic.district_id', explode(',', $check[0]->district_id));
        }
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        }
        $applicants = $applicants->where('hr.level', 4)->where('hr.session_year', '2026')->get();
      } elseif ($request->sport == 4 && $subSport == 23 && in_array($gender, [1, 2, 3])) {
        $trialType = 8;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')


          ->where('basic.sub_sport_type', $request->subsport)
          ->where('basic.sports', $request->sport)
          ->where('hr.district_level_approved', 1)
          ->whereIn('hr.trial_two', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1);

        if (Auth::guard('admin')->user()->division_id) {

          $applicants->whereIn('basic.district_id', explode(',', $check[0]->district_id));
        }
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        }
        $applicants = $applicants->where('hr.level', 4)->where('hr.session_year', '2026')->get();
      } elseif ($request->sport == 15 && in_array($gender, [1, 2, 3])) {
        $trialType = 20;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('basic.sports', $request->sport)
          ->where('hr.district_level_approved', 1)
          ->whereIn('hr.trial_two', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1);
        if (Auth::guard('admin')->user()->division_id) {

          $applicants->whereIn('basic.district_id', explode(',', $check[0]->district_id));
        }
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        }
        $applicants = $applicants->where('hr.level', 4)->where('hr.session_year', '2026')->get();
      } elseif ($request->sport == 14 && in_array($gender, [1, 2, 3])) {
        $trialType = 21;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('hr.district_level_approved', 1)
          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_two', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1);
        if (Auth::guard('admin')->user()->division_id) {

          $applicants->whereIn('basic.district_id', explode(',', $check[0]->district_id));
        }
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        }
        $applicants = $applicants->where('hr.level', 4)->where('hr.session_year', '2026')->get();
      } elseif ($request->sport == 23 && in_array($gender, [1, 2, 3])) {
        $trialType = 22;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('hr.district_level_approved', 1)
          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_two', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1);
        if (Auth::guard('admin')->user()->division_id) {

          $applicants->whereIn('basic.district_id', explode(',', $check[0]->district_id));
        }
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        }
        $applicants = $applicants->where('hr.level', 4)->where('hr.session_year', '2026')->get();
      } elseif ($request->sport == 20 && in_array($gender, [1, 2, 3])) {
        $trialType = 23;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('hr.district_level_approved', 1)
          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_two', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1);
        if (Auth::guard('admin')->user()->division_id) {

          $applicants->whereIn('basic.district_id', explode(',', $check[0]->district_id));
        }
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        }
        $applicants = $applicants->where('hr.level', 4)->where('hr.session_year', '2026')->get();
      } elseif ($request->sport == 44 && in_array($gender, [1, 2, 3])) {


        $trialType = 24;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('hr.district_level_approved', 1)
          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_two', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1);
        if (Auth::guard('admin')->user()->division_id) {

          $applicants->whereIn('basic.district_id', explode(',', $check[0]->district_id));
        }
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        }
        $applicants = $applicants->where('hr.level', 4)->where('hr.session_year', '2026')->get();
      } else {
        $trialType = 18;



        $applicants = [];
      }





      return view('hosteltrial.trialListApplicanttwo', compact('trialType', 'sports', 'applicants',  'filterData', 'filtsubSport', 'subSport', 'division', 'allSubSports'));
    }



    return view('hosteltrial.trialListApplicanttwo', compact('trialType', 'sports', 'division', 'allSubSports'));
  }







  public function trialListthree(Request $request)
  {





    $check = DB::table('hostel_div_district_mapping')
      ->select(DB::raw('group_concat(district_id) as district_id'))->where('division_id', Auth::guard('admin')->user()->division_id)->get();
    $districts = DB::table('cities')->where('state_id', 23);

    if (Auth::guard('admin')->user()->division_id) {

      $districts->whereIn('id', explode(',', $check[0]->district_id));
    }


    $districts =   $districts->orderBy('city', 'asc')->get();
    $sports = DB::table('sport_master')->where('status', 1)->orderBy('name', 'asc')->get();
    $division = DB::table('hostel_division_master')->orderBy('division_name', 'asc')->get();
    $allSubSports = DB::table('sub_sport_type')->get();
    if ($request->post()) {
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

      $division = DB::table('hostel_division_master')->orderBy('division_name', 'asc')->get();

      $filtsubSport = $request->subsport;



      $filterData = [
        'sport_id' => $request->sport,
        'subSport' => $request->subsport,
        'gender' => $request->gender,
        'division_id' => $request->division_id,
        'assign_skill' => $request->assign_skill,
      ];

      $subSport = $request->subsport;

      $gender = $request->gender;



      if ($request->sport == 6 && $subSport == 21   && in_array($gender, [1, 2, 3])) {
        $trialType = 1;

        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('basic.sub_sport_type', $request->subsport)
          ->where('hr.medical_test', 2)



          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_three', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.level', 4);

        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        };


        $applicants->where(function($q) use ($request) {
            $q->where('hr.session_year', '2026')
          ->orWhere(function ($applicants) use ($request) {
            $applicants->where('hr.existing_student', 1)->where('hr.session_year', '2026')
              ->where('basic.sports', $request->sport)
              ->where('basic.sub_sport_type', $request->subsport)
              ->where('hr.status', 1);
          });
        });

        if (isset($gender) && in_array($gender, [1, 2])) { $applicants->where('hr.gender', $gender); }
        $applicants = $applicants->get();
      } elseif ($request->sport == 6 && $subSport == 20  && in_array($gender, [1, 2, 3])) {
        $trialType = 2;

        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('basic.sub_sport_type', $request->subsport)
          ->where('basic.sports', $request->sport)
          ->where('hr.medical_test', 2)

          ->whereIn('hr.trial_three', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.level', 4);

        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        };
        $applicants->where(function($q) use ($request) {
            $q->where('hr.session_year', '2026')

          ->orWhere(function ($applicants) use ($request) {
            $applicants->where('hr.existing_student', 1)->where('hr.session_year', '2026')
              ->where('basic.sports', $request->sport)
              ->where('basic.sub_sport_type', $request->subsport)
              ->where('hr.status', 1);
          });
        })

        ;

        if (isset($gender) && in_array($gender, [1, 2])) { $applicants->where('hr.gender', $gender); }
        $applicants = $applicants->get();
      } elseif ($request->sport == 43  && in_array($gender, [1, 2, 3])) {
        $trialType = 3;


        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')

          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_three', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.medical_test', 2)

          ->where('hr.level', 4);

        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        };
        $applicants->where(function($q) use ($request) {
            $q->where('hr.session_year', '2026')
          ->orWhere(function ($applicants) use ($request) {
            $applicants->where('hr.existing_student', 1)->where('hr.session_year', '2026')
              ->where('basic.sports', $request->sport)
              ->where('hr.status', 1);
          });
        })


        ;

        if (isset($gender) && in_array($gender, [1, 2])) { $applicants->where('hr.gender', $gender); }
        $applicants = $applicants->get();
      } elseif ($request->sport == 10  && in_array($gender, [1, 2, 3])) {
        $trialType = 4;

        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender',  'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('hr.medical_test', 2)

          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_three', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.level', 4);

        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        };
        $applicants->where(function($q) use ($request) {
            $q->where('hr.session_year', '2026')
          ->orWhere(function ($applicants) use ($request) {
            $applicants->where('hr.existing_student', 1)->where('hr.session_year', '2026')
              ->where('basic.sports', $request->sport)
              ->where('hr.status', 1);
          });
        })
        ;

        if (isset($gender) && in_array($gender, [1, 2])) { $applicants->where('hr.gender', $gender); }
        $applicants = $applicants->get();

        # code...
      } elseif ($request->sport == 9  && in_array($gender, [1, 2, 3])) {
        $trialType = 6;

        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('basic.sports', $request->sport)
          ->where('hr.medical_test', 2)

          ->whereIn('hr.trial_three', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.level', 4);

        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        };
        $applicants->where(function($q) use ($request) {
            $q->where('hr.session_year', '2026')
          ->orWhere(function ($applicants) use ($request) {
            $applicants->where('hr.existing_student', 1)->where('hr.session_year', '2026')
              ->where('basic.sports', $request->sport)
              ->where('hr.status', 1);
          });
        });

        if (isset($gender) && in_array($gender, [1, 2])) { $applicants->where('hr.gender', $gender); }
        $applicants = $applicants->get();
      } elseif ($request->sport == 4 && $request->subsport == 22 && in_array($gender, [1, 2, 3])) {


        $trialType = 7;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('basic.sub_sport_type', $request->subsport)
          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_three', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.medical_test', 2)

          ->where('hr.level', 4);

        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        };
        $applicants->where(function($q) use ($request) {
            $q->where('hr.session_year', '2026')
          ->orWhere(function ($applicants) use ($request) {
            $applicants->where('hr.existing_student', 1)->where('hr.session_year', '2026')
              ->where('basic.sports', $request->sport)
              ->where('basic.sub_sport_type', $request->subsport)
              ->where('hr.status', 1);
          });
        });

        if (isset($gender) && in_array($gender, [1, 2])) { $applicants->where('hr.gender', $gender); }
        $applicants = $applicants->get();
      } elseif ($request->sport == 3 && $subSport == 24 && in_array($gender, [1, 2, 3])) {
        $trialType = 10;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('basic.sub_sport_type', $request->subsport)
          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_three', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.medical_test', 2)

          ->where('hr.level', 4);

        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        };
        $applicants->where(function($q) use ($request) {
            $q->where('hr.session_year', '2026')
          ->orWhere(function ($applicants) use ($request) {
            $applicants->where('hr.existing_student', 1)->where('hr.session_year', '2026')
              ->where('basic.sports', $request->sport)
              ->where('basic.sub_sport_type', $request->subsport)
              ->where('hr.status', 1);
          });
        });

        if (isset($gender) && in_array($gender, [1, 2])) { $applicants->where('hr.gender', $gender); }
        $applicants = $applicants->get();

        //trial_type
      } elseif ($request->sport == 3 && $subSport == 26 && in_array($gender, [1, 2, 3])) {
        $trialType = 12;

        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('basic.sub_sport_type', $request->subsport)
          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_three', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.medical_test', 2)

          ->where('hr.level', 4);

        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        };
        $applicants->where(function($q) use ($request) {
            $q->where('hr.session_year', '2026')
          ->orWhere(function ($applicants) use ($request) {
            $applicants->where('hr.existing_student', 1)->where('hr.session_year', '2026')
              ->where('basic.sports', $request->sport)
              ->where('basic.sub_sport_type', $request->subsport)
              ->where('hr.status', 1);
          });
        });

        if (isset($gender) && in_array($gender, [1, 2])) { $applicants->where('hr.gender', $gender); }
        $applicants = $applicants->get();
      } elseif ($request->sport == 3 && $subSport == 25  && in_array($gender, [1, 2, 3])) {
        $trialType = 11;

        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('basic.sub_sport_type', $request->subsport)
          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_three', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.medical_test', 2)

          ->where('hr.level', 4);

        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        };
        $applicants->where(function($q) use ($request) {
            $q->where('hr.session_year', '2026')
          ->orWhere(function ($applicants) use ($request) {
            $applicants->where('hr.existing_student', 1)->where('hr.session_year', '2026')
              ->where('basic.sports', $request->sport)
              ->where('basic.sub_sport_type', $request->subsport)
              ->where('hr.status', 1);
          });
        });

        if (isset($gender) && in_array($gender, [1, 2])) { $applicants->where('hr.gender', $gender); }
        $applicants = $applicants->get();
      } elseif ($request->sport == 42  && $request->subsport == 11 && in_array($gender, [1, 2, 3])) {
        $trialType = 9;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('basic.sports', $request->sport)
          ->where('basic.sub_sport_type', $request->subsport)
          ->whereIn('hr.trial_three', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.medical_test', 2)
          ->where('hr.level', 4);

        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        };
        $applicants->where(function($q) use ($request) {
            $q->where('hr.session_year', '2026')
          ->orWhere(function ($applicants) use ($request) {
            $applicants->where('hr.existing_student', 1)->where('hr.session_year', '2026')
              ->where('basic.sports', $request->sport)
              ->where('basic.sub_sport_type', $request->subsport)
              ->where('hr.status', 1);
          });
        });

        if (isset($gender) && in_array($gender, [1, 2])) { $applicants->where('hr.gender', $gender); }
        $applicants = $applicants->get();
      } elseif ($request->sport == 42  && $request->subsport == 10 && in_array($gender, [1, 2, 3])) {

        $trialType = 15;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('basic.sports', $request->sport)
          ->where('basic.sub_sport_type', $request->subsport)
          ->whereIn('hr.trial_three', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.medical_test', 2)

          ->where('hr.level', 4);

        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        };
        $applicants->where(function($q) use ($request) {
            $q->where('hr.session_year', '2026')
          ->orWhere(function ($applicants) use ($request) {
            $applicants->where('hr.existing_student', 1)->where('hr.session_year', '2026')
              ->where('basic.sports', $request->sport)
              ->where('basic.sub_sport_type', $request->subsport)
              ->where('hr.status', 1);
          });
        });

        if (isset($gender) && in_array($gender, [1, 2])) { $applicants->where('hr.gender', $gender); }
        $applicants = $applicants->get();
      } elseif ($request->sport == 7 && in_array($gender, [1, 2, 3])) {
        $trialType = 14;

        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('hr.medical_test', 2)

          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_three', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.level', 4);

        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        };
        $applicants->where(function($q) use ($request) {
            $q->where('hr.session_year', '2026')
          ->orWhere(function ($applicants) use ($request) {
            $applicants->where('hr.existing_student', 1)->where('hr.session_year', '2026')
              ->where('basic.sports', $request->sport)
              ->where('hr.status', 1);
          });
        });

        if (isset($gender) && in_array($gender, [1, 2])) { $applicants->where('hr.gender', $gender); }
        $applicants = $applicants->get();

        # code...
      } elseif ($request->sport == 8 && in_array($gender, [1, 2, 3])) {
        $trialType = 13;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('hr.medical_test', 2)

          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_three', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.level', 4);

        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        };
        $applicants->where(function($q) use ($request) {
            $q->where('hr.session_year', '2026')
          ->orWhere(function ($applicants) use ($request) {
            $applicants->where('hr.existing_student', 1)->where('hr.session_year', '2026')
              ->where('basic.sports', $request->sport)
              ->where('hr.status', 1);
          });
        });

        if (isset($gender) && in_array($gender, [1, 2])) { $applicants->where('hr.gender', $gender); }
        $applicants = $applicants->get();
      } elseif ($request->sport == 25  && in_array($gender, [1, 2, 3])) {
        $trialType = 5;

        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('hr.medical_test', 2)

          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_three', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.level', 4);

        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        };
        $applicants->where(function($q) use ($request) {
            $q->where('hr.session_year', '2026')
          ->orWhere(function ($applicants) use ($request) {
            $applicants->where('hr.existing_student', 1)->where('hr.session_year', '2026')
              ->where('basic.sports', $request->sport)
              ->where('hr.status', 1);
          });
        })
        ;

        if (isset($gender) && in_array($gender, [1, 2])) { $applicants->where('hr.gender', $gender); }
        $applicants = $applicants->get();
      } elseif ($request->sport == 42 && $request->subsport == 12 && in_array($gender, [1, 2, 3])) {
        $trialType = 19;

        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('basic.sub_sport_type', $request->subsport)
          ->where('basic.sports', $request->sport)
          ->where('hr.medical_test', 2)

          ->whereIn('hr.trial_three', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.level', 4);

        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        };
        $applicants->where(function($q) use ($request) {
            $q->where('hr.session_year', '2026')
          ->orWhere(function ($applicants) use ($request) {
            $applicants->where('hr.existing_student', 1)->where('hr.session_year', '2026')
              ->where('basic.sports', $request->sport)
              ->where('basic.sub_sport_type', $request->subsport)
              ->where('hr.status', 1);
          });
        });

        if (isset($gender) && in_array($gender, [1, 2])) { $applicants->where('hr.gender', $gender); }
        $applicants = $applicants->get();
      } elseif ($request->sport == 5  && in_array($gender, [1, 2, 3])) {
        $trialType = 16;


        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('hr.gender', $gender)
          ->where('hr.medical_test', 2)

          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_three', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.level', 4);

        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        };
        $applicants->where(function($q) use ($request) {
            $q->where('hr.session_year', '2026')

          ->orWhere(function ($applicants) use ($request) {
            $applicants->where('hr.existing_student', 1)->where('hr.session_year', '2026')
              ->where('basic.sports', $request->sport)
              ->where('hr.status', 1);
          });
        });

        if (isset($gender) && in_array($gender, [1, 2])) { $applicants->where('hr.gender', $gender); }
        $applicants = $applicants->get();
      } elseif ($request->sport == 5  && in_array($gender, [1, 2, 3])) {
        $trialType = 17;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('hr.gender', $gender)
          ->where('hr.medical_test', 2)

          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_three', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.level', 4);

        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        };
        $applicants->where(function($q) use ($request) {
            $q->where('hr.session_year', '2026')
          ->orWhere(function ($applicants) use ($request) {
            $applicants->where('hr.existing_student', 1)->where('hr.session_year', '2026')
              ->where('basic.sports', $request->sport)
              ->where('hr.status', 1);
          });
        });

        if (isset($gender) && in_array($gender, [1, 2])) { $applicants->where('hr.gender', $gender); }
        $applicants = $applicants->get();
      } elseif ($request->sport == 5 && in_array($gender, [1, 2, 3])) {
        $trialType = 16;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('hr.medical_test', 2)
          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_three', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.level', 4);

        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        };
        $applicants->where(function($q) use ($request) {
            $q->where('hr.session_year', '2026')
          ->orWhere(function ($applicants) use ($request) {
            $applicants->where('hr.existing_student', 1)->where('hr.session_year', '2026')
              ->where('basic.sports', $request->sport)
              ->where('hr.status', 1);
          });
        });

        if (isset($gender) && in_array($gender, [1, 2])) { $applicants->where('hr.gender', $gender); }
        $applicants = $applicants->get();
      } elseif ($request->sport == 4 && $subSport == 23 && in_array($gender, [1, 2, 3])) {
        $trialType = 8;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('basic.sub_sport_type', $subSport)
          ->where('basic.sports', $request->sport)
          ->where('hr.medical_test', 2)

          ->whereIn('hr.trial_three', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.level', 4);

        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        };
        $applicants->where(function($q) use ($request) {
            $q->where('hr.session_year', '2026')
          ->orWhere(function ($applicants) use ($request) {
            $applicants->where('hr.existing_student', 1)->where('hr.session_year', '2026')
              ->where('basic.sports', $request->sport)
              ->where('basic.sub_sport_type', $request->subsport)
              ->where('hr.status', 1);
          });
        });

        if (isset($gender) && in_array($gender, [1, 2])) { $applicants->where('hr.gender', $gender); }
        $applicants = $applicants->get();
      } elseif ($request->sport == 15 && in_array($gender, [1, 2, 3])) {
        $trialType = 20;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_three', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.medical_test', 2)

          ->where('hr.level', 4);

        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        };
        $applicants->where(function($q) use ($request) {
            $q->where('hr.session_year', '2026')
          ->orWhere(function ($applicants) use ($request) {
            $applicants->where('hr.existing_student', 1)->where('hr.session_year', '2026')
              ->where('basic.sports', $request->sport)
              ->where('basic.sub_sport_type', $request->subsport)
              ->where('hr.status', 1);
          });
        });

        if (isset($gender) && in_array($gender, [1, 2])) { $applicants->where('hr.gender', $gender); }
        $applicants = $applicants->get();
      } elseif ($request->sport == 14 && in_array($gender, [1, 2, 3])) {
        $trialType = 21;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('hr.medical_test', 2)

          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_three', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.level', 4);

        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        };
        $applicants->where(function($q) use ($request) {
            $q->where('hr.session_year', '2026')
          ->orWhere(function ($applicants) use ($request) {
            $applicants->where('hr.existing_student', 1)->where('hr.session_year', '2026')
              ->where('basic.sports', $request->sport)
              ->where('hr.status', 1);
          });
        });

        if (isset($gender) && in_array($gender, [1, 2])) { $applicants->where('hr.gender', $gender); }
        $applicants = $applicants->get();
      } elseif ($request->sport == 23 && in_array($gender, [1, 2, 3])) {
        $trialType = 22;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('hr.medical_test', 2)

          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_three', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.level', 4);

        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        };
        $applicants->where(function($q) use ($request) {
            $q->where('hr.session_year', '2026')
          ->orWhere(function ($applicants) use ($request) {
            $applicants->where('hr.existing_student', 1)->where('hr.session_year', '2026')
              ->where('basic.sports', $request->sport)
              ->where('hr.status', 1);
          });
        });

        if (isset($gender) && in_array($gender, [1, 2])) { $applicants->where('hr.gender', $gender); }
        $applicants = $applicants->get();
      } elseif ($request->sport == 20 && in_array($gender, [1, 2, 3])) {
        $trialType = 23;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('hr.medical_test', 2)

          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_three', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.level', 4);

        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        };
        $applicants->where(function($q) use ($request) {
            $q->where('hr.session_year', '2026')
          ->orWhere(function ($applicants) use ($request) {
            $applicants->where('hr.existing_student', 1)->where('hr.session_year', '2026')
              ->where('basic.sports', $request->sport)
              ->where('hr.status', 1);
          });
        });

        if (isset($gender) && in_array($gender, [1, 2])) { $applicants->where('hr.gender', $gender); }
        $applicants = $applicants->get();
      } elseif ($request->sport == 44 && in_array($gender, [1, 2, 3])) {


        $trialType = 24;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('hr.medical_test', 2)

          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_three', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.level', 4);

        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        };
        $applicants->where(function($q) use ($request) {
            $q->where('hr.session_year', '2026')
          ->orWhere(function ($applicants) use ($request) {
            $applicants->where('hr.existing_student', 1)->where('hr.session_year', '2026')
              ->where('basic.sports', $request->sport)
              ->where('hr.status', 1);
          });
        });

        if (isset($gender) && in_array($gender, [1, 2])) { $applicants->where('hr.gender', $gender); }
        $applicants = $applicants->get();

      // ── NA sub-sport: Hockey player (sport 6, assign_skill 21, no sub-sport selected) ──
      } elseif ($request->sport == 6 && !$subSport && $request->assign_skill == 21 && in_array($gender, [1, 2, 3])) {
        $trialType = 1;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('basic.sports', $request->sport)
          ->where(function($q) { $q->whereNull('basic.sub_sport_type')->orWhere('basic.sub_sport_type', 0)->orWhere('basic.sub_sport_type', ''); })
          ->where('hr.medical_test', 2)
          ->whereIn('hr.trial_three', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.level', 4);
        if ($request->division_id && $request->division_id != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        }
        $applicants->where(function($q) use ($request) {
          $q->where('hr.session_year', '2026')
            ->orWhere(function($q2) use ($request) {
              $q2->where('hr.existing_student', 1)->where('hr.session_year', '2026')
                ->where('basic.sports', $request->sport)->where('hr.status', 1);
            });
        });
        $applicants = $applicants->get();

      // ── NA sub-sport: Hockey keeper (sport 6, assign_skill 20, no sub-sport selected) ──
      } elseif ($request->sport == 6 && !$subSport && $request->assign_skill == 20 && in_array($gender, [1, 2, 3])) {
        $trialType = 2;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('basic.sports', $request->sport)
          ->where(function($q) { $q->whereNull('basic.sub_sport_type')->orWhere('basic.sub_sport_type', 0)->orWhere('basic.sub_sport_type', ''); })
          ->where('hr.medical_test', 2)
          ->whereIn('hr.trial_three', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.level', 4);
        if ($request->division_id && $request->division_id != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        }
        $applicants->where(function($q) use ($request) {
          $q->where('hr.session_year', '2026')
            ->orWhere(function($q2) use ($request) {
              $q2->where('hr.existing_student', 1)->where('hr.session_year', '2026')
                ->where('basic.sports', $request->sport)->where('hr.status', 1);
            });
        });
        $applicants = $applicants->get();

      // ── NA sub-sport: Cricket batsman (sport 3, assign_skill 24, no sub-sport selected) ──
      } elseif ($request->sport == 3 && !$subSport && $request->assign_skill == 24 && in_array($gender, [1, 2, 3])) {
        $trialType = 10;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('basic.sports', $request->sport)
          ->where(function($q) { $q->whereNull('basic.sub_sport_type')->orWhere('basic.sub_sport_type', 0)->orWhere('basic.sub_sport_type', ''); })
          ->where('hr.medical_test', 2)
          ->whereIn('hr.trial_three', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.level', 4)
          ->where('hr.gender', 1);
        if ($request->division_id && $request->division_id != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        }
        $applicants->where(function($q) use ($request) {
          $q->where('hr.session_year', '2026')
            ->orWhere(function($q2) use ($request) {
              $q2->where('hr.existing_student', 1)->where('hr.session_year', '2026')
                ->where('basic.sports', $request->sport)->where('hr.status', 1);
            });
        });
        $applicants = $applicants->get();

      // ── NA sub-sport: Cricket bowler (sport 3, assign_skill 25, no sub-sport selected) ──
      } elseif ($request->sport == 3 && !$subSport && $request->assign_skill == 25 && in_array($gender, [1, 2, 3])) {
        $trialType = 11;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('basic.sports', $request->sport)
          ->where(function($q) { $q->whereNull('basic.sub_sport_type')->orWhere('basic.sub_sport_type', 0)->orWhere('basic.sub_sport_type', ''); })
          ->where('hr.medical_test', 2)
          ->whereIn('hr.trial_three', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.level', 4)
          ->where('hr.gender', 1);
        if ($request->division_id && $request->division_id != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        }
        $applicants->where(function($q) use ($request) {
          $q->where('hr.session_year', '2026')
            ->orWhere(function($q2) use ($request) {
              $q2->where('hr.existing_student', 1)->where('hr.session_year', '2026')
                ->where('basic.sports', $request->sport)->where('hr.status', 1);
            });
        });
        $applicants = $applicants->get();

      // ── NA sub-sport: Cricket keeper (sport 3, assign_skill 26, no sub-sport selected) ──
      } elseif ($request->sport == 3 && !$subSport && $request->assign_skill == 26 && in_array($gender, [1, 2, 3])) {
        $trialType = 12;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('basic.sports', $request->sport)
          ->where(function($q) { $q->whereNull('basic.sub_sport_type')->orWhere('basic.sub_sport_type', 0)->orWhere('basic.sub_sport_type', ''); })
          ->where('hr.medical_test', 2)
          ->whereIn('hr.trial_three', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.level', 4)
          ->where('hr.gender', 1);
        if ($request->division_id && $request->division_id != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        }
        $applicants->where(function($q) use ($request) {
          $q->where('hr.session_year', '2026')
            ->orWhere(function($q2) use ($request) {
              $q2->where('hr.existing_student', 1)->where('hr.session_year', '2026')
                ->where('basic.sports', $request->sport)->where('hr.status', 1);
            });
        });
        $applicants = $applicants->get();

      } else {
        $trialType = 18;



        $applicants = [];
      }




      return view('hosteltrial.trialListApplicantthree', compact('trialType', 'sports', 'applicants',  'filterData', 'filtsubSport', 'subSport', 'division', 'districts', 'allSubSports'));
    }


    $trialType = 18;


    return view('hosteltrial.trialListApplicantthree', compact('trialType', 'sports', 'division', 'districts', 'allSubSports'));
  }




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
      return response()->json(['error' => true, 'msg' => $validation->errors()->first(), "application_no" => $request->applicant_id]);


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

    $id = DB::table('hostel_badminton_trial')->insertGetId($data);
    if ($request->sport_test_mark >= 25 && $request->trial_type == 1) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([
        'trial_one' => 2,
        'trial_two' => 1,
        'skill_trial_one_marks' => $request->sport_test_mark,

      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 1) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([
        'trial_one' => 3,
        'skill_trial_one_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 2) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([

        'trial_two' => 2,
        'trial_three' => 1,
        'skill_trial_two_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 2) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([

        'trial_two' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 3) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_three' => 2,
        'skill_trial_three_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 3) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_three' => 3,
        'skill_trial_three_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 4) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_four' => 2,
        'skill_trial_four_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 4) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_four' => 3,
        'skill_trial_four_marks' => $request->sport_test_mark,


      ]);
    }


    return response()->json(["error" => false, "msg" => "Sport Trial Data Submit Successfully", "application_no" => $request->applicant_id]);
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
      'physical_total_mark' => 'required|numeric|max:50',



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
      return response()->json(['error' => true, 'msg' => $validation->errors()->first(),  "application_no" => $request->applicant_id]);


    $totalmark = $request->hundred_mt_mark + $request->eight_hundred_mt_mark + $request->broad_jump_mark + $request->shuttle_run_mark + $request->ball_throw_mark;


    if ($totalmark != $request->physical_total_mark)
      return response()->json(['error' => true, 'msg' => 'Please Check Physical Total Marks Field', "application_no" => $request->applicant_id]);

    $data = [
      'sport_id' => $request->sport_id,
      'sub_sport_id' => $request->subsport_id,
      'gender' => $request->gender,
      'trial_type' => $request->trial_type,

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

    $id = DB::table('hostel_trial_applicant')->insertGetId($data);

    if ($request->physical_total_mark >= 20 && $request->trial_type == 1) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([
        'trial_one' => 2,
        'trial_two' => 1,
        'physical_trial_one_marks' => $request->physical_total_mark,

      ]);
    } elseif ($request->physical_total_mark < 20 && $request->trial_type == 1) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([
        'trial_one' => 3,
        'physical_trial_one_marks' => $request->physical_total_mark,


      ]);
    } elseif ($request->physical_total_mark >= 20 && $request->trial_type == 2) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([

        'trial_two' => 2,
        'trial_three' => 1,
        'physical_trial_two_marks' => $request->physical_total_mark,


      ]);
    } elseif ($request->physical_total_mark < 20 && $request->trial_type == 2) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([

        'trial_two' => 3,
        'physical_trial_two_marks' => $request->physical_total_mark,


      ]);
    } elseif ($request->physical_total_mark >= 20 && $request->trial_type == 3) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_three' => 2,
        'physical_trial_three_marks' => $request->physical_total_mark,


      ]);
    } elseif ($request->physical_total_mark < 20 && $request->trial_type == 3) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_three' => 3,
        'physical_trial_three_marks' => $request->physical_total_mark,


      ]);
    } elseif ($request->physical_total_mark >= 20 && $request->trial_type == 4) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_four' => 2,
        'physical_trial_four_marks' => $request->physical_total_mark,


      ]);
    } elseif ($request->physical_total_mark < 20 && $request->trial_type == 4) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_four' => 3,
        'physical_trial_four_marks' => $request->physical_total_mark,


      ]);
    }


    return response()->json(["error" => false, "msg" => "Trial Data Submit Successfully", "application_no" => $request->applicant_id]);
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
      return response()->json(['error' => true, 'msg' => $validation->errors()->first(), "application_no" => $request->applicant_id]);


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

    $id = DB::table('hostel_volleyball_trial')->insertGetId($data);

    if ($request->sport_test_mark >= 25 && $request->trial_type == 1) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([
        'trial_one' => 2,
        'trial_two' => 1,
        'skill_trial_one_marks' => $request->sport_test_mark,

      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 1) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([
        'trial_one' => 3,
        'skill_trial_one_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 2) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([

        'trial_two' => 2,
        'trial_three' => 1,
        'skill_trial_two_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 2) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([

        'trial_two' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 3) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_three' => 2,
        'skill_trial_three_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 3) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_three' => 3,
        'skill_trial_three_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 4) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_four' => 2,
        'skill_trial_four_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 4) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_four' => 3,
        'skill_trial_four_marks' => $request->sport_test_mark,


      ]);
    }

    return response()->json(["error" => false, "msg" => "Sport Trial Data Submit Successfully", "application_no" => $request->applicant_id]);
  }



  //kusti trial

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
      return response()->json(['error' => true, 'msg' => $validation->errors()->first(), "application_no" => $request->applicant_id]);


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

    $id = DB::table('hostel_kusti_trial')->insertGetId($data);
    if ($request->sport_test_mark >= 25 && $request->trial_type == 1) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([
        'trial_one' => 2,
        'trial_two' => 1,
        'skill_trial_one_marks' => $request->sport_test_mark,

      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 1) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([
        'trial_one' => 3,
        'skill_trial_one_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 2) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([

        'trial_two' => 2,
        'trial_three' => 1,
        'skill_trial_two_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 2) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([

        'trial_two' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 3) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_three' => 2,
        'skill_trial_three_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 3) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_three' => 3,
        'skill_trial_three_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 4) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_four' => 2,
        'skill_trial_four_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 4) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_four' => 3,
        'skill_trial_four_marks' => $request->sport_test_mark,


      ]);
    }


    return response()->json(["error" => false, "msg" => "Sport Trial Data Submit Successfully", "application_no" => $request->applicant_id]);
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
      return response()->json(['error' => true, 'msg' => $validation->errors()->first(), "application_no" => $request->applicant_id]);


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

    $id = DB::table('hostel_swimming_trial')->insertGetId($data);

    if ($request->sport_test_mark >= 25 && $request->trial_type == 1) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([
        'trial_one' => 2,
        'trial_two' => 1,
        'skill_trial_one_marks' => $request->sport_test_mark,

      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 1) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([
        'trial_one' => 3,
        'skill_trial_one_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 2) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([

        'trial_two' => 2,
        'trial_three' => 1,
        'skill_trial_two_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 2) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([

        'trial_two' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 3) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_three' => 2,
        'skill_trial_three_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 3) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_three' => 3,
        'skill_trial_three_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 4) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_four' => 2,
        'skill_trial_four_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 4) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_four' => 3,
        'skill_trial_four_marks' => $request->sport_test_mark,


      ]);
    }

    return response()->json(["error" => false, "msg" => "Sport Trial Data Submit Successfully", "application_no" => $request->applicant_id]);
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
      return response()->json(['error' => true, 'msg' => $validation->errors()->first(), "application_no" => $request->applicant_id]);


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

    $id = DB::table('hostel_kabbadi_trial')->insertGetId($data);
    if ($request->sport_test_mark >= 25 && $request->trial_type == 1) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([
        'trial_one' => 2,
        'trial_two' => 1,
        'skill_trial_one_marks' => $request->sport_test_mark,

      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 1) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([
        'trial_one' => 3,
        'skill_trial_one_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 2) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([

        'trial_two' => 2,
        'trial_three' => 1,
        'skill_trial_two_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 2) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([

        'trial_two' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 3) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_three' => 2,
        'skill_trial_three_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 3) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_three' => 3,
        'skill_trial_three_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 4) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_four' => 2,
        'skill_trial_four_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 4) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_four' => 3,
        'skill_trial_four_marks' => $request->sport_test_mark,


      ]);
    }


    return response()->json(["error" => false, "msg" => "Sport Trial Data Submit Successfully", "application_no" => $request->applicant_id]);
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
      return response()->json(['error' => true, 'msg' => $validation->errors()->first(), "application_no" => $request->applicant_id]);


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

    $id = DB::table('hostel_judo_trial')->insertGetId($data);
    if ($request->sport_test_mark >= 25 && $request->trial_type == 1) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([
        'trial_one' => 2,
        'trial_two' => 1,
        'skill_trial_one_marks' => $request->sport_test_mark,

      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 1) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([
        'trial_one' => 3,
        'skill_trial_one_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 2) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([

        'trial_two' => 2,
        'trial_three' => 1,
        'skill_trial_two_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 2) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([

        'trial_two' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 3) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_three' => 2,
        'skill_trial_three_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 3) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_three' => 3,
        'skill_trial_three_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 4) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_four' => 2,
        'skill_trial_four_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 4) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_four' => 3,
        'skill_trial_four_marks' => $request->sport_test_mark,


      ]);
    }


    return response()->json(["error" => false, "msg" => "Sport Trial Data Submit Successfully", "application_no" => $request->applicant_id]);
  }


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
      return response()->json(['error' => true, 'msg' => $validation->errors()->first(), "application_no" => $request->applicant_id]);


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

    $id = DB::table('hostel_gymnastic_boy_trial')->insertGetId($data);
    if ($request->sport_test_mark >= 25 && $request->trial_type == 1) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([
        'trial_one' => 2,
        'trial_two' => 1,
        'skill_trial_one_marks' => $request->sport_test_mark,

      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 1) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([
        'trial_one' => 3,
        'skill_trial_one_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 2) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([

        'trial_two' => 2,
        'trial_three' => 1,
        'skill_trial_two_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 2) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([

        'trial_two' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 3) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_three' => 2,
        'skill_trial_three_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 3) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_three' => 3,
        'skill_trial_three_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 4) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_four' => 2,
        'skill_trial_four_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 4) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_four' => 3,
        'skill_trial_four_marks' => $request->sport_test_mark,


      ]);
    }


    return response()->json(["error" => false, "msg" => "Sport Trial Data Submit Successfully", "application_no" => $request->applicant_id]);
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
      return response()->json(['error' => true, 'msg' => $validation->errors()->first(), "application_no" => $request->applicant_id]);


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

    $id = DB::table('hostel_gymnastic_girl_trial')->insertGetId($data);
    if ($request->sport_test_mark >= 25 && $request->trial_type == 1) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([
        'trial_one' => 2,
        'trial_two' => 1,
        'skill_trial_one_marks' => $request->sport_test_mark,

      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 1) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([
        'trial_one' => 3,
        'skill_trial_one_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 2) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([

        'trial_two' => 2,
        'trial_three' => 1,
        'skill_trial_two_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 2) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([

        'trial_two' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 3) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_three' => 2,
        'skill_trial_three_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 3) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_three' => 3,
        'skill_trial_three_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 4) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_four' => 2,
        'skill_trial_four_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 4) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_four' => 3,
        'skill_trial_four_marks' => $request->sport_test_mark,


      ]);
    }


    return response()->json(["error" => false, "msg" => "Sport Trial Data Submit Successfully", "application_no" => $request->applicant_id]);
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
      return response()->json(['error' => true, 'msg' => $validation->errors()->first(), "application_no" => $request->applicant_id]);


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

    $id = DB::table('hostel_cricket_batsman_trial')->insertGetId($data);

    if ($request->sport_test_mark >= 25 && $request->trial_type == 1) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([
        'trial_one' => 2,
        'trial_two' => 1,
        'skill_trial_one_marks' => $request->sport_test_mark,

      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 1) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([
        'trial_one' => 3,
        'skill_trial_one_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 2) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([

        'trial_two' => 2,
        'trial_three' => 1,
        'skill_trial_two_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 2) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([

        'trial_two' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 3) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_three' => 2,
        'skill_trial_three_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 3) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_three' => 3,
        'skill_trial_three_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 4) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_four' => 2,
        'skill_trial_four_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 4) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_four' => 3,
        'skill_trial_four_marks' => $request->sport_test_mark,


      ]);
    }

    return response()->json(["error" => false, "msg" => "Sport Trial Data Submit Successfully", "application_no" => $request->applicant_id]);
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
      return response()->json(['error' => true, 'msg' => $validation->errors()->first(), "application_no" => $request->applicant_id]);


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

    $id = DB::table('hostel_cricket_bowler_trial')->insertGetId($data);

    if ($request->sport_test_mark >= 25 && $request->trial_type == 1) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([
        'trial_one' => 2,
        'trial_two' => 1,
        'skill_trial_one_marks' => $request->sport_test_mark,

      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 1) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([
        'trial_one' => 3,
        'skill_trial_one_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 2) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([

        'trial_two' => 2,
        'trial_three' => 1,
        'skill_trial_two_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 2) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([

        'trial_two' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 3) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_three' => 2,
        'skill_trial_three_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 3) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_three' => 3,
        'skill_trial_three_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 4) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_four' => 2,
        'skill_trial_four_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 4) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_four' => 3,
        'skill_trial_four_marks' => $request->sport_test_mark,


      ]);
    }


    return response()->json(["error" => false, "msg" => "Sport Trial Data Submit Successfully", "application_no" => $request->applicant_id]);
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
      return response()->json(['error' => true, 'msg' => $validation->errors()->first(), "application_no" => $request->applicant_id]);


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

    $id = DB::table('hostel_cricket_wicket_keeper_trial')->insertGetId($data);

    if ($request->sport_test_mark >= 25 && $request->trial_type == 1) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([
        'trial_one' => 2,
        'trial_two' => 1,
        'skill_trial_one_marks' => $request->sport_test_mark,

      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 1) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([
        'trial_one' => 3,
        'skill_trial_one_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 2) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([

        'trial_two' => 2,
        'trial_three' => 1,
        'skill_trial_two_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 2) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([

        'trial_two' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 3) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_three' => 2,
        'skill_trial_three_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 3) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_three' => 3,
        'skill_trial_three_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 4) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_four' => 2,
        'skill_trial_four_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 4) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_four' => 3,
        'skill_trial_four_marks' => $request->sport_test_mark,


      ]);
    }



    return response()->json(["error" => false, "msg" => "Sport Trial Data Submit Successfully", "application_no" => $request->applicant_id]);
  }




  //hockeytrialList
  public function hockeytrialList(Request $request)
  {

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
      return response()->json(['error' => true, 'msg' => $validation->errors()->first(), "application_no" => $request->applicant_id]);


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

    $id = DB::table('hostel_hockey_trial')->insertGetId($data);
    if ($request->sport_test_mark >= 25 && $request->trial_type == 1) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([
        'trial_one' => 2,
        'trial_two' => 1,
        'skill_trial_one_marks' => $request->sport_test_mark,

      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 1) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([
        'trial_one' => 3,
        'skill_trial_one_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 2) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([

        'trial_two' => 2,
        'trial_three' => 1,
        'skill_trial_two_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 2) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([

        'trial_two' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 3) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_three' => 2,
        'skill_trial_three_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 3) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_three' => 3,
        'skill_trial_three_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 4) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_four' => 2,
        'skill_trial_four_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 4) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_four' => 3,
        'skill_trial_four_marks' => $request->sport_test_mark,


      ]);
    }

    return response()->json(["error" => false, "msg" => "Sport Trial Data Submit Successfully", "application_no" => $request->applicant_id]);
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
      return response()->json(['error' => true, 'msg' => $validation->errors()->first(), "application_no" => $request->applicant_id]);


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

    $id = DB::table('hostel_hockey_goalkeeper_trial')->insertGetId($data);
    if ($request->sport_test_mark >= 25 && $request->trial_type == 1) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([
        'trial_one' => 2,
        'trial_two' => 1,
        'skill_trial_one_marks' => $request->sport_test_mark,

      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 1) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([
        'trial_one' => 3,
        'skill_trial_one_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 2) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([

        'trial_two' => 2,
        'trial_three' => 1,
        'skill_trial_two_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 2) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([

        'trial_two' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 3) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_three' => 2,
        'skill_trial_three_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 3) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_three' => 3,
        'skill_trial_three_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 4) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_four' => 2,
        'skill_trial_four_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 4) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_four' => 3,
        'skill_trial_four_marks' => $request->sport_test_mark,


      ]);
    }


    return response()->json(["error" => false, "msg" => "Sport Trial Data Submit Successfully", "application_no" => $request->applicant_id]);
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
      return response()->json(['error' => true, 'msg' => $validation->errors()->first(), "application_no" => $request->applicant_id]);


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

    $id = DB::table('hostel_football_goalkeeper_trial')->insertGetId($data);
    if ($request->sport_test_mark >= 25 && $request->trial_type == 1) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([
        'trial_one' => 2,
        'trial_two' => 1,
        'skill_trial_one_marks' => $request->sport_test_mark,

      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 1) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([
        'trial_one' => 3,
        'skill_trial_one_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 2) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([

        'trial_two' => 2,
        'trial_three' => 1,
        'skill_trial_two_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 2) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([

        'trial_two' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 3) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_three' => 2,
        'skill_trial_three_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 3) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_three' => 3,
        'skill_trial_three_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 4) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_four' => 2,
        'skill_trial_four_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 4) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_four' => 3,
        'skill_trial_four_marks' => $request->sport_test_mark,


      ]);
    }

    return response()->json(["error" => false, "msg" => "Sport Trial Data Submit Successfully", "application_no" => $request->applicapplicant_idation_no]);
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
      return response()->json(['error' => true, 'msg' => $validation->errors()->first(), "application_no" => $request->applicant_id]);


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

    $id = DB::table('hostel_football_trial')->insertGetId($data);

    if ($request->sport_test_mark >= 25 && $request->trial_type == 1) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([
        'trial_one' => 2,
        'trial_two' => 1,
        'skill_trial_one_marks' => $request->sport_test_mark,

      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 1) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([
        'trial_one' => 3,
        'skill_trial_one_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 2) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([

        'trial_two' => 2,
        'trial_three' => 1,
        'skill_trial_two_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 2) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([

        'trial_two' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 3) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_three' => 2,
        'skill_trial_three_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 3) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_three' => 3,
        'skill_trial_three_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 4) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_four' => 2,
        'skill_trial_four_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 4) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_four' => 3,
        'skill_trial_four_marks' => $request->sport_test_mark,


      ]);
    }

    return response()->json(["error" => false, "msg" => "Sport Trial Data Submit Successfully", "application_no" => $request->applicant_id]);
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
      return response()->json(['error' => true, 'msg' => $validation->errors()->first(), "application_no" => $request->applicant_id]);


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

    $id = DB::table('hostel_athletics_runner_trial')->insertGetId($data);

    if ($request->sport_test_mark >= 25 && $request->trial_type == 1) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([
        'trial_one' => 2,
        'trial_two' => 1,
        'skill_trial_one_marks' => $request->sport_test_mark,

      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 1) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([
        'trial_one' => 3,
        'skill_trial_one_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 2) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([

        'trial_two' => 2,
        'trial_three' => 1,
        'skill_trial_two_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 2) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([

        'trial_two' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 3) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_three' => 2,
        'skill_trial_three_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 3) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_three' => 3,
        'skill_trial_three_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 4) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_four' => 2,
        'skill_trial_four_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 4) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_four' => 3,
        'skill_trial_four_marks' => $request->sport_test_mark,


      ]);
    }


    return response()->json(["error" => false, "msg" => "Sport Trial Data Submit Successfully", "application_no" => $request->applicant_id]);
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
      return response()->json(['error' => true, 'msg' => $validation->errors()->first(), "application_no" => $request->applicant_id]);


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

    $id = DB::table('hostel_athletics_thrower_trial')->insertGetId($data);
    if ($request->sport_test_mark >= 25 && $request->trial_type == 1) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([
        'trial_one' => 2,
        'trial_two' => 1,
        'skill_trial_one_marks' => $request->sport_test_mark,

      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 1) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([
        'trial_one' => 3,
        'skill_trial_one_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 2) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([

        'trial_two' => 2,
        'trial_three' => 1,
        'skill_trial_two_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 2) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([

        'trial_two' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 3) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_three' => 2,
        'skill_trial_three_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 3) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_three' => 3,
        'skill_trial_three_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 4) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_four' => 2,
        'skill_trial_four_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 4) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_four' => 3,
        'skill_trial_four_marks' => $request->sport_test_mark,


      ]);
    }


    return response()->json(["error" => false, "msg" => "Sport Trial Data Submit Successfully", "application_no" => $request->applicant_id]);
  }




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
      return response()->json(['error' => true, 'msg' => $validation->errors()->first(), "application_no" => $request->applicant_id]);


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

    $id = DB::table('hostel_athletics_jumper_trial')->insertGetId($data);

    if ($request->sport_test_mark >= 25 && $request->trial_type == 1) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([
        'trial_one' => 2,
        'trial_two' => 1,
        'skill_trial_one_marks' => $request->sport_test_mark,

      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 1) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([
        'trial_one' => 3,
        'skill_trial_one_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 2) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([

        'trial_two' => 2,
        'trial_three' => 1,
        'skill_trial_two_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 2) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([

        'trial_two' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 3) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_three' => 2,
        'skill_trial_three_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 3) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_three' => 3,
        'skill_trial_three_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 4) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_four' => 2,
        'skill_trial_four_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 4) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_four' => 3,
        'skill_trial_four_marks' => $request->sport_test_mark,


      ]);
    }


    return response()->json(["error" => false, "msg" => "Sport Trial Data Submit Successfully", "application_no" => $request->applicant_id]);
  }

  //boxingtrialList
  public function boxingtrialList(Request $request)
  {
    $validation = Validator::make($request->all(), [

      'punching_pad' => 'required|numeric|max:7.5',
      'shadow_boxing' => 'required|numeric|max:7.5',

      'skypink' => 'required|numeric|max:7.5',

      'sparring' => 'required|numeric|max:7.5',

      'test_score_mark' => 'required|numeric|max:30',
      'game_technique' => 'required|numeric|max:20',
      'sport_test_mark' => 'required|numeric|max:50',
      'total_obtain_mark' => 'required|numeric|max:100',
      'remark' => 'required|max:255',


    ]);

    if ($validation->fails())
      return response()->json(['error' => true, 'msg' => $validation->errors()->first(), "application_no" => $request->applicant_id]);


    $data = [
      'sport_id' => $request->sport_id,
      'trial_type' => $request->trial_type,

      'application_no' => $request->application_no,
      'applicant_id' => $request->applicant_id,
      'punching_pad' => $request->punching_pad,
      'shadow_boxing' => $request->shadow_boxing,
      'skypink' => $request->skypink,
      'sparring' => $request->sparring,

      'test_score_mark' => $request->test_score_mark,
      'game_technique' => $request->game_technique,
      'sport_test_mark' => $request->sport_test_mark,
      'total_obtain_mark' => $request->total_obtain_mark,
      'remark' => $request->remark,
      'addedby' => Auth::guard('admin')->user()->id,
      'date' => date("Y-m-d H:i:s")

    ];

    $id = DB::table('hostel_boxing_trial')->insertGetId($data);

    if ($request->sport_test_mark >= 25 && $request->trial_type == 1) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([
        'trial_one' => 2,
        'trial_two' => 1,
        'skill_trial_one_marks' => $request->sport_test_mark,

      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 1) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([
        'trial_one' => 3,
        'skill_trial_one_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 2) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([

        'trial_two' => 2,
        'trial_three' => 1,
        'skill_trial_two_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 2) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([

        'trial_two' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 3) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_three' => 2,
        'skill_trial_three_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 3) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_three' => 3,
        'skill_trial_three_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 4) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_four' => 2,
        'skill_trial_four_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 4) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_four' => 3,
        'skill_trial_four_marks' => $request->sport_test_mark,


      ]);
    }


    return response()->json(["error" => false, "msg" => "Sport Trial Data Submit Successfully", "application_no" => $request->applicant_id]);
  }




  //basketballtrialList
  public function basketballtrialList(Request $request)
  {
    $validation = Validator::make($request->all(), [

      'dribbling' => 'required|numeric|max:7.5',
      'passing' => 'required|numeric|max:7.5',

      'standing' => 'required|numeric|max:7.5',

      'jumpshot' => 'required|numeric|max:7.5',

      'test_score_mark' => 'required|numeric|max:30',
      'game_technique' => 'required|numeric|max:20',
      'sport_test_mark' => 'required|numeric|max:50',
      'total_obtain_mark' => 'required|numeric|max:100',
      'remark' => 'required|max:255',


    ]);

    if ($validation->fails())
      return response()->json(['error' => true, 'msg' => $validation->errors()->first(), "application_no" => $request->applicant_id]);


    $data = [
      'sport_id' => $request->sport_id,
      'trial_type' => $request->trial_type,

      'application_no' => $request->application_no,
      'applicant_id' => $request->applicant_id,
      'dribbling' => $request->dribbling,
      'passing' => $request->passing,
      'standing' => $request->standing,
      'jumpshot' => $request->jumpshot,

      'test_score_mark' => $request->test_score_mark,
      'game_technique' => $request->game_technique,
      'sport_test_mark' => $request->sport_test_mark,
      'total_obtain_mark' => $request->total_obtain_mark,
      'remark' => $request->remark,
      'addedby' => Auth::guard('admin')->user()->id,
      'date' => date("Y-m-d H:i:s")

    ];

    $id = DB::table('hostel_basketball_trial')->insertGetId($data);

    if ($request->sport_test_mark >= 25 && $request->trial_type == 1) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([
        'trial_one' => 2,
        'trial_two' => 1,
        'skill_trial_one_marks' => $request->sport_test_mark,

      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 1) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([
        'trial_one' => 3,
        'skill_trial_one_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 2) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([

        'trial_two' => 2,
        'trial_three' => 1,
        'skill_trial_two_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 2) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([

        'trial_two' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 3) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_three' => 2,
        'skill_trial_three_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 3) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_three' => 3,
        'skill_trial_three_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 4) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_four' => 2,
        'skill_trial_four_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 4) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_four' => 3,
        'skill_trial_four_marks' => $request->sport_test_mark,


      ]);
    }



    return response()->json(["error" => false, "msg" => "Sport Trial Data Submit Successfully", "application_no" => $request->applicant_id]);
  }




  //tabletennistrialList
  public function tabletennistrialList(Request $request)
  {
    $validation = Validator::make($request->all(), [

      'counter' => 'required|numeric|max:7.5',
      'push' => 'required|numeric|max:7.5',

      'block' => 'required|numeric|max:7.5',

      'service' => 'required|numeric|max:7.5',

      'test_score_mark' => 'required|numeric|max:30',
      'game_technique' => 'required|numeric|max:20',
      'sport_test_mark' => 'required|numeric|max:50',
      'total_obtain_mark' => 'required|numeric|max:100',
      'remark' => 'required|max:255',


    ]);

    if ($validation->fails())
      return response()->json(['error' => true, 'msg' => $validation->errors()->first(), "application_no" => $request->applicant_id]);


    $data = [
      'sport_id' => $request->sport_id,
      'trial_type' => $request->trial_type,

      'application_no' => $request->application_no,
      'applicant_id' => $request->applicant_id,
      'counter' => $request->counter,
      'push' => $request->push,
      'block' => $request->block,
      'service' => $request->service,

      'test_score_mark' => $request->test_score_mark,
      'game_technique' => $request->game_technique,
      'sport_test_mark' => $request->sport_test_mark,
      'total_obtain_mark' => $request->total_obtain_mark,
      'remark' => $request->remark,
      'addedby' => Auth::guard('admin')->user()->id,
      'date' => date("Y-m-d H:i:s")

    ];

    $id = DB::table('hostel_tabletennis_trial')->insertGetId($data);
    if ($request->sport_test_mark >= 25 && $request->trial_type == 1) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([
        'trial_one' => 2,
        'trial_two' => 1,
        'skill_trial_one_marks' => $request->sport_test_mark,

      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 1) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([
        'trial_one' => 3,
        'skill_trial_one_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 2) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([

        'trial_two' => 2,
        'trial_three' => 1,
        'skill_trial_two_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 2) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([

        'trial_two' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 3) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_three' => 2,
        'skill_trial_three_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 3) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_three' => 3,
        'skill_trial_three_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 4) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_four' => 2,
        'skill_trial_four_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 4) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_four' => 3,
        'skill_trial_four_marks' => $request->sport_test_mark,


      ]);
    }


    return response()->json(["error" => false, "msg" => "Sport Trial Data Submit Successfully", "application_no" => $request->applicant_id]);
  }






  //handballtrialList
  public function handballtrialList(Request $request)
  {
    $validation = Validator::make($request->all(), [

      'catch_pass' => 'required|numeric|max:7.5',
      'dibbling' => 'required|numeric|max:7.5',

      'standing_shot' => 'required|numeric|max:7.5',

      'jumpshot' => 'required|numeric|max:7.5',

      'test_score_mark' => 'required|numeric|max:30',
      'game_technique' => 'required|numeric|max:20',
      'sport_test_mark' => 'required|numeric|max:50',
      'total_obtain_mark' => 'required|numeric|max:100',
      'remark' => 'required|max:255',


    ]);

    if ($validation->fails())
      return response()->json(['error' => true, 'msg' => $validation->errors()->first(), "application_no" => $request->applicant_id]);


    $data = [
      'sport_id' => $request->sport_id,
      'trial_type' => $request->trial_type,

      'application_no' => $request->application_no,
      'applicant_id' => $request->applicant_id,
      'catch_pass' => $request->catch_pass,
      'dibbling' => $request->dibbling,
      'standing_shot' => $request->standing_shot,
      'jumpshot' => $request->jumpshot,

      'test_score_mark' => $request->test_score_mark,
      'game_technique' => $request->game_technique,
      'sport_test_mark' => $request->sport_test_mark,
      'total_obtain_mark' => $request->total_obtain_mark,
      'remark' => $request->remark,
      'addedby' => Auth::guard('admin')->user()->id,
      'date' => date("Y-m-d H:i:s")

    ];

    $id = DB::table('hostel_handball_trial')->insertGetId($data);
    if ($request->sport_test_mark >= 25 && $request->trial_type == 1) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([
        'trial_one' => 2,
        'trial_two' => 1,
        'skill_trial_one_marks' => $request->sport_test_mark,

      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 1) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([
        'trial_one' => 3,
        'skill_trial_one_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 2) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([

        'trial_two' => 2,
        'trial_three' => 1,
        'skill_trial_two_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 2) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([

        'trial_two' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 3) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_three' => 2,
        'skill_trial_three_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 3) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_three' => 3,
        'skill_trial_three_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 4) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_four' => 2,
        'skill_trial_four_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 4) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_four' => 3,
        'skill_trial_four_marks' => $request->sport_test_mark,


      ]);
    }


    return response()->json(["error" => false, "msg" => "Sport Trial Data Submit Successfully", "application_no" => $request->applicant_id]);
  }



  //archerytrialList
  public function archerytrialList(Request $request)
  {
    $validation = Validator::make($request->all(), [

      'staines' => 'required|numeric|max:5',
      'knocking' => 'required|numeric|max:5',

      'expansion' => 'required|numeric|max:5',

      'driving' => 'required|numeric|max:5',

      'anchoring' => 'required|numeric|max:6',
      'titan_hold' => 'required|numeric|max:6',

      'aiming' => 'required|numeric|max:6',

      'titan_release' => 'required|numeric|max:6',
      'after_hold' => 'required|numeric|max:6',
      'sport_test_mark' => 'required|numeric|max:50',
      'total_obtain_mark' => 'required|numeric|max:100',
      'remark' => 'required|max:255',


    ]);

    if ($validation->fails())
      return response()->json(['error' => true, 'msg' => $validation->errors()->first(), "application_no" => $request->applicant_id]);


    $data = [
      'sport_id' => $request->sport_id,
      'trial_type' => $request->trial_type,

      'application_no' => $request->application_no,
      'applicant_id' => $request->applicant_id,
      'staines' => $request->staines,
      'knocking' => $request->knocking,
      'expansion' => $request->expansion,
      'driving' => $request->driving,

      'anchoring' => $request->anchoring,
      'titan_hold' => $request->titan_hold,
      'aiming' => $request->aiming,
      'titan_release' => $request->titan_release,
      'after_hold' => $request->after_hold,
      'sport_test_mark' => $request->sport_test_mark,
      'total_obtain_mark' => $request->total_obtain_mark,
      'remark' => $request->remark,
      'addedby' => Auth::guard('admin')->user()->id,
      'date' => date("Y-m-d H:i:s")

    ];

    $id = DB::table('hostel_archery_trial')->insertGetId($data);
    if ($request->sport_test_mark >= 25 && $request->trial_type == 1) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([
        'trial_one' => 2,
        'trial_two' => 1,
        'skill_trial_one_marks' => $request->sport_test_mark,

      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 1) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([
        'trial_one' => 3,
        'skill_trial_one_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 2) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([

        'trial_two' => 2,
        'trial_three' => 1,
        'skill_trial_two_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 2) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([

        'trial_two' => 3,
        'skill_trial_two_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 3) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_three' => 2,
        'skill_trial_three_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 3) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_three' => 3,
        'skill_trial_three_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark >= 25 && $request->trial_type == 4) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_four' => 2,
        'skill_trial_four_marks' => $request->sport_test_mark,


      ]);
    } elseif ($request->sport_test_mark < 25 && $request->trial_type == 4) {
      $user = DB::table('hostel_register')->where('id', $request->applicant_id)->update([


        'trial_four' => 3,
        'skill_trial_four_marks' => $request->sport_test_mark,


      ]);
    }


    return response()->json(["error" => false, "msg" => "Sport Trial Data Submit Successfully", "application_no" => $request->applicant_id]);
  }


  public function get_subsport(Request $req)
  {
    $id = $req->sport;
    $all_sport = DB::table('sub_sport_type')->where('sport_id', $id)->get();
    return $all_sport;
  }


  public function apiresponsedata()
  {


    // $response = Http::post('https://upgis2023.in/investorcrm/api/Event/get_mou_details', [
    //     'intent_id' => '22000042',
    //     //'role' => 'Network Administrator',
    //  ]);

    //  $jsonData = $response->json();
    //  foreach ($jsonData as $key => $value) {
    //    echo "<pre>";
    //    print_r($value);
    //  }





    //             $curl = curl_init();

    // curl_setopt_array($curl, array(
    //   CURLOPT_URL => 'https://upgis2023.in/investorcrm/api/Event/get_mou_details',
    //   CURLOPT_RETURNTRANSFER => true,
    //   CURLOPT_ENCODING => '',
    //   CURLOPT_MAXREDIRS => 10,
    //   CURLOPT_TIMEOUT => 0,
    //   CURLOPT_FOLLOWLOCATION => true,
    //   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //   CURLOPT_CUSTOMREQUEST => 'POST',
    //   CURLOPT_POSTFIELDS =>'{"intent_id":22000042}',
    //   CURLOPT_HTTPHEADER => array(
    //     'Content-Type: application/json',
    //     'Cookie: ci_session=rrmm6nmke01rl0sj4dhd0lc73msffr8n'
    //   ),
    // ));

    // $response = curl_exec($curl);

    // curl_close($curl);
    // dd(json_decode($response) );
  }





  public function medical_test(Request $request)
  {
    session()->put('filter_hostel', $request->all());
    $hostelList =  DB::table('hostel_register as rg')
      ->join('hostel_application_basic as basic', 'rg.id', '=', 'basic.hostel_register_id')
      ->select('rg.*', 'basic.sports', 'basic.district_id')
      ->where('rg.level', 4)
      ->whereNull('rg.cancel_status')
      ->where('rg.division_level_approved', 1);



    if ($request->post()) {


      if ($request->sport_id) {
        $hostelList->where('basic.sports', $request->sport_id);
      }

      if ($request->city_filter) {
        $hostelList->where('basic.district_id', $request->city_filter);
      }

      if ($request->gender) {
        $hostelList->where('rg.gender', $request->gender);
      }
    }
    $selectedYear = $request->input('session_year', config('app.session_year'));
    $hostelList =   $hostelList->where('rg.session_year', $selectedYear)->get();
    $districts = DB::table('cities')->where('state_id', '23')->orderBy('city')->get();


    $sports = DB::table('sport_master')->where('status', 1)->orderBy('name')->get();
    $years = DB::table('hostel_register')->select('session_year')->distinct()->whereNotNull('session_year')->orderBy('session_year', 'desc')->pluck('session_year');

    return view('hosteltrial.medical', compact('hostelList', 'sports', 'districts', 'years'));
  }



  public function medical_test_approved(Request $request)
  {

    foreach ($request->arr as $value) {
      // dd($value);
      DB::table('hostel_register')->where('id', $value)->update([
        'medical_test' => 2,
        'ip_address_medical_approved' => $request->ip(),
        'medical_approved_by' =>  Auth::guard('admin')->user()->id,
      ]);
    }

    return response()->json(["error" => false, "msg" => "Applicant Approved Successfully"]);
  }


  public function district_level_approved(Request $request)
  {

    session()->put('filter_hostel', "");

    $division = DB::table('hostel_division_master')->get();

    $check = DB::table('hostel_div_district_mapping')
      ->select(DB::raw('group_concat(district_id) as district_id'))->where('division_id', Auth::guard('admin')->user()->division_id)->get();
    $districts = DB::table('cities')->where('state_id', 23);

    if (Auth::guard('admin')->user()->division_id) {


      $districts->whereIn('id', explode(',', $check[0]->district_id));
    }


    $districts =   $districts->orderBy('city', 'asc')->get();
    $hostelList =  DB::table('hostel_register as rg')
      ->join('hostel_application_basic as basic', 'rg.id', '=', 'basic.hostel_register_id')

      ->select('rg.*', 'basic.sports', 'basic.district_id', DB::raw('rg.physical_trial_one_marks + rg.skill_trial_one_marks as total_mark'))
      ->where('rg.trial_one', 2)

      ->whereNull('rg.cancel_status');


    if (Auth::guard('admin')->user()->district_id > 0) {

      $hostelList->where('basic.district_id', Auth::guard('admin')->user()->district_id);
    }

    if (Auth::guard('admin')->user()->division_id) {

      $hostelList->whereIn('basic.district_id', explode(',', $check[0]->district_id));
    }



    if ($request->post()) {

      session()->put('filter_hostel', $request->all());
      if ($request->sport_id) {
        $hostelList->where('basic.sports', $request->sport_id);
      }

      if ($request->city_filter) {
        $hostelList->where('basic.district_id', $request->city_filter);
      }
      if ($request->gender) {
        $hostelList->where('rg.gender', $request->gender);
      }
    }
    $selectedYear = $request->input('session_year', config('app.session_year'));
    $hostelList = $hostelList->where('rg.session_year', $selectedYear)->orderby('total_mark', "DESC")->get();



    $sports = DB::table('sport_master')->where('status', 1)->orderBy('name')->get();
    $years = DB::table('hostel_register')->select('session_year')->distinct()->whereNotNull('session_year')->orderBy('session_year', 'desc')->pluck('session_year');

    return view('hosteltrial.district_level_approved', compact('hostelList', 'sports', 'districts', 'years'));
  }


  public function district_level_approved_store(Request $request)
  {
    foreach ($request->arr as $value) {
      DB::table('hostel_register')->where('id', $value)->update([
        'district_level_approved' => 1,
        'ip_address_district_level_approved' => $request->ip(),
        'district_level_approved_by' => Auth::guard('admin')->user()->id,

      ]);
    }
    return response()->json(["error" => false, "msg" => "Applicant Approved Successfully"]);
  }



  public function division_level_approved(Request $request)
  {

    session()->put('filter_hostel', "");
    $division = DB::table('hostel_division_master')->orderBy('division_name', 'asc')->get();




    $check = DB::table('hostel_div_district_mapping')
      ->select(DB::raw('group_concat(district_id) as district_id'))->where('division_id', Auth::guard('admin')->user()->division_id)->get();

    if ($request->post()) {

      if ($request->division_filter) {

        $checkk = DB::table('hostel_div_district_mapping')
          ->select(DB::raw('group_concat(district_id) as district_id'))->where('division_id', $request->division_filter)->get();
      }
    }



    $districts = DB::table('cities')->where('state_id', 23);

    if (Auth::guard('admin')->user()->division_id) {

      $districts->whereIn('id', explode(',', $check[0]->district_id));
    }


    $districts =   $districts->orderBy('city', 'asc')->get();


    $hostelList =  DB::table('hostel_register as rg')
      ->join('hostel_application_basic as basic', 'rg.id', '=', 'basic.hostel_register_id')
      ->select('rg.*', 'basic.sports', 'basic.district_id',  DB::raw('rg.physical_trial_two_marks + rg.skill_trial_two_marks as total_mark'))
      ->where('rg.level', 4)
      ->where('rg.trial_two', 2)
      ->whereNull('rg.cancel_status');
    if (Auth::guard('admin')->user()->division_id) {

      $hostelList->whereIn('basic.district_id', explode(',', $check[0]->district_id));
    }


    if ($request->post()) {
      session()->put('filter_hostel', $request->all());

      if ($request->sport_id) {
        $hostelList->where('basic.sports', $request->sport_id);
      }

      if ($request->division_filter) {
        $hostelList->whereIn('basic.district_id', explode(',', $checkk[0]->district_id));
      }

      if ($request->gender) {
        $hostelList->where('rg.gender', $request->gender);
      }
    }

    $selectedYear = $request->input('session_year', config('app.session_year'));
    $hostelList  = $hostelList->where('rg.session_year', $selectedYear)->orderby('total_mark', "DESC")
      ->get();


    $divisions = DB::table('hostel_division_master')->orderBy('division_name', 'asc')->get();

    $sports = DB::table('sport_master')->where('status', 1)->orderBy('name')->get();
    $years = DB::table('hostel_register')->select('session_year')->distinct()->whereNotNull('session_year')->orderBy('session_year', 'desc')->pluck('session_year');

    return view('hosteltrial.division_level_approved', compact('hostelList', 'sports', 'divisions', 'years'));
  }


  public function division_level_approved_store(Request $request)
  {
    foreach ($request->arr as $value) {
      DB::table('hostel_register')->where('id', $value)->update([
        'division_level_approved' => 1,
        'ip_address_division_level_approved' => $request->ip(),
        'division_level_approved_by' => Auth::guard('admin')->user()->id,
      ]);
    }
    return response()->json(["error" => false, "msg" => "Applicant Approved Successfully"]);
  }


  public function districtwisecount()
  {

    $districts = DB::Select("SELECT cities.city ,count(CASE when hr.district_level_approved = 1 then 1 end) as total,count(CASE when hr.gender = 1 then 1 end and CASE when hr.district_level_approved = 1 then 1 end) as male , count(CASE when hr.gender = 2 then 1 end and CASE when hr.district_level_approved = 1 then 1 end) as female FROM `cities` left join hostel_application_communication as hac on hac.p_district_id= cities.id left join hostel_register as hr on hr.id=hac.hostel_register_id left join hostel_application_basic as hab on hr.id=hab.hostel_register_id where 1 and cities.state_id = 23 group by cities.id ORDER BY city asc");
    $total = DB::select(" SELECT cities.city ,count(CASE when hr.district_level_approved = 1 then 1 end) as total,count(CASE when hr.gender = 1 then 1 end and CASE when hr.district_level_approved = 1 then 1 end) as male , count(CASE when hr.gender = 2 then 1 end and CASE when hr.district_level_approved = 1 then 1 end) as female FROM `cities` left join hostel_application_communication as hac on hac.p_district_id= cities.id left join hostel_register as hr on hr.id=hac.hostel_register_id left join hostel_application_basic as hab on hr.id=hab.hostel_register_id where 1 and cities.state_id = 23");

    return view('hosteltrial.districtwisecount', compact('districts', 'total'));
  }



  public function divisionwisecount()
  {

    $divisions = DB::Select("SELECT hostel_division_master.division_name ,count(CASE when hr.division_level_approved = 1 then 1 end) as total,count(CASE when hr.gender = 1 then 1 end and CASE when hr.division_level_approved = 1 then 1 end) as male , count(CASE when hr.gender = 2 then 1 end and CASE when hr.division_level_approved = 1 then 1 end) as female FROM hostel_division_master left join hostel_div_district_mapping as hddm on hddm.division_id= hostel_division_master.id left join cities on cities.id = hddm.district_id left join hostel_application_communication as hac on hac.p_district_id= cities.id left join hostel_register as hr on hr.id=hac.hostel_register_id left join hostel_application_basic as hab on hr.id=hab.hostel_register_id group by hostel_division_master.id order by hostel_division_master.division_name;");
    $total = DB::select("SELECT hostel_division_master.division_name ,count(CASE when hr.division_level_approved = 1 then 1 end) as total,count(CASE when hr.gender = 1 then 1 end and CASE when hr.division_level_approved = 1 then 1 end) as male , count(CASE when hr.gender = 2 then 1 end and CASE when hr.division_level_approved = 1 then 1 end) as female FROM hostel_division_master left join hostel_div_district_mapping as hddm on hddm.division_id= hostel_division_master.id left join cities on cities.id = hddm.district_id left join hostel_application_communication as hac on hac.p_district_id= cities.id left join hostel_register as hr on hr.id=hac.hostel_register_id left join hostel_application_basic as hab on hr.id=hab.hostel_register_id");

    return view('hosteltrial.divisionwisecount', compact('divisions', 'total'));
  }






  public function competition_level_approved(Request $request)
  {

    session()->put('filter_hostel', $request->all());
    $division = DB::table('hostel_division_master')->orderBy('division_name', 'asc')->get();




    $check = DB::table('hostel_div_district_mapping')
      ->select(DB::raw('group_concat(district_id) as district_id'))->where('division_id', Auth::guard('admin')->user()->division_id)->get();

    if ($request->post()) {

      if ($request->division_filter) {

        $checkk = DB::table('hostel_div_district_mapping')
          ->select(DB::raw('group_concat(district_id) as district_id'))->where('division_id', $request->division_filter)->get();
      }
    }



    $districts = DB::table('cities')->where('state_id', 23);

    //  if(Auth::guard('admin')->user()->division_id){

    //     $districts->whereIn( 'id',explode(',',$check[0]->district_id));
    // }




    $districts =   $districts->orderBy('city', 'asc')->get();






    $hostelList =  DB::table('hostel_register as rg')
      ->join('hostel_application_basic as basic', 'rg.id', '=', 'basic.hostel_register_id')
      ->select('rg.*', 'basic.sports', 'basic.district_id',  DB::raw('rg.physical_trial_three_marks + rg.skill_trial_three_marks as total_mark'))
      ->where('rg.level', 4)
      ->where('rg.trial_three', 2)


      ->whereNull('rg.cancel_status');
    // if(Auth::guard('admin')->user()->division_id){

    //     $hostelList->whereIn( 'basic.district_id',explode(',',$check[0]->district_id));
    // }


    if ($request->post()) {


      if ($request->sport_id) {
        $hostelList->where('basic.sports', $request->sport_id);
      }

      if ($request->subsport) {
        $hostelList->where('basic.sub_sport_type', $request->subsport);
      }


      if ($request->gender) {
        $hostelList->where('rg.gender', $request->gender);
      }

      if ($request->division_filter) {
        $hostelList->whereIn('basic.district_id', explode(',', $checkk[0]->district_id));
      }
    }

    $selectedYear = $request->input('session_year', config('app.session_year'));
    $hostelList  = $hostelList->where('rg.session_year', $selectedYear)->orderby('total_mark', "DESC")
      ->get();


    $divisions = DB::table('hostel_division_master')->orderBy('division_name', 'asc')->get();

    $sports = DB::table('sport_master')->where('status', 1)->orderBy('name')->get();
    $years = DB::table('hostel_register')->select('session_year')->distinct()->whereNotNull('session_year')->orderBy('session_year', 'desc')->pluck('session_year');

    return view('hosteltrial.competition_level_approved', compact('hostelList', 'sports', 'divisions', 'years'));
  }


  public function competition_level_approved_store(Request $request)
  {
    foreach ($request->arr as $value) {
      DB::table('hostel_register')->where('id', $value)->update([
        'competition_level_approved' => 1,
        'trial_four' => 2,
        'ip_address_competition_level_approved' => $request->ip(),
        'competition_level_approved_by' => Auth::guard('admin')->user()->id,
      ]);
    }
    return response()->json(["error" => false, "msg" => "Applicant Approved Successfully"]);
  }


  public function division_level_merit_list(Request $request)
  {



    $division = DB::table('hostel_division_master')->orderBy('division_name', 'asc')->get();




    $check = DB::table('hostel_div_district_mapping')
      ->select(DB::raw('group_concat(district_id) as district_id'))->where('division_id', Auth::guard('admin')->user()->division_id)->get();

    if ($request->post()) {

      if ($request->division_filter) {

        $checkk = DB::table('hostel_div_district_mapping')
          ->select(DB::raw('group_concat(district_id) as district_id'))->where('division_id', $request->division_filter)->get();
      }
    }



    $districts = DB::table('cities')->where('state_id', 23);

    if (Auth::guard('admin')->user()->division_id) {

      $districts->whereIn('id', explode(',', $check[0]->district_id));
    }




    $districts =   $districts->orderBy('city', 'asc')->get();






    $hostelList =  DB::table('hostel_register as rg')
      ->join('hostel_application_basic as basic', 'rg.id', '=', 'basic.hostel_register_id')
      ->select('rg.id', 'rg.application_no', 'rg.name', 'rg.gender', 'basic.sports', 'basic.district_id', 'rg.mobile', 'rg.dob', 'rg.physical_trial_two_marks', 'rg.skill_trial_two_marks', DB::raw('rg.physical_trial_two_marks + rg.skill_trial_two_marks as total'))
      ->where('rg.level', 4)
      ->whereIn('rg.trial_two', [1, 2, 3]);
    if (Auth::guard('admin')->user()->division_id) {

      $hostelList->whereIn('basic.district_id', explode(',', $check[0]->district_id));
    }


    if ($request->post()) {


      if ($request->sport_id) {
        $hostelList->where('basic.sports', $request->sport_id);
      }


      if ($request->gender) {
        $hostelList->where('rg.gender', $request->gender);
      }

      if ($request->division_filter) {
        $hostelList->whereIn('basic.district_id', explode(',', $checkk[0]->district_id));
      }
    }

    $hostelList  = $hostelList->orderby('total', "DESC")->orderBy('rg.skill_trial_two_marks', "DESC")->orderBy('rg.dob', "ASC")
      ->get();


    $divisions = DB::table('hostel_division_master')->orderBy('division_name', 'asc')->get();

    $sports = DB::table('sport_master')->where('status', 1)->orderBy('name')->get();


    return view('hosteltrial.division_level_merit_list', compact('hostelList', 'sports', 'divisions'));
  }













  public function trialListfour(Request $request)
  {

    $sports = DB::table('sport_master')->where('status', 1)->orderBy('name', 'asc')->get();
    $division = DB::table('hostel_division_master')->orderBy('division_name', 'asc')->get();
    $allSubSports = DB::table('sub_sport_type')->get();
    if ($request->post()) {
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

      $division = DB::table('hostel_division_master')->orderBy('division_name', 'asc')->get();

      $filtsubSport = $request->subsport;



      $filterData = [
        'sport_id' => $request->sport,
        'subSport' => $request->subsport,
        'gender' => $request->gender,
        'division_id' => $request->division_id
      ];

      $subSport = $request->subsport;

      $gender = $request->gender;



      if ($request->sport == 6 && $subSport == 21   && in_array($gender, [1, 2, 3])) {
        $trialType = 1;

        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('basic.sub_sport_type', $request->subsport)
          ->where('hr.competition_level_approved', 1)
          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_four', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.level', 4)
          ->where('hr.session_year', '2026');
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        };

        if (isset($gender) && in_array($gender, [1, 2])) { $applicants->where('hr.gender', $gender); }
        $applicants =  $applicants->get();
      } elseif ($request->sport == 6 && $subSport == 20  && in_array($gender, [1, 2, 3])) {
        $trialType = 2;

        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('basic.sub_sport_type', $request->subsport)
          ->where('basic.sports', $request->sport)
          ->where('hr.competition_level_approved', 1)

          ->whereIn('hr.trial_four', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.level', 4)
          ->where('hr.session_year', '2026');
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        };

        if (isset($gender) && in_array($gender, [1, 2])) { $applicants->where('hr.gender', $gender); }
        $applicants =  $applicants->get();
      } elseif ($request->sport == 43  && in_array($gender, [1, 2, 3])) {
        $trialType = 3;


        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')

          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_four', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.competition_level_approved', 1)

          ->where('hr.level', 4)
          ->where('hr.session_year', '2026');
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        };

        if (isset($gender) && in_array($gender, [1, 2])) { $applicants->where('hr.gender', $gender); }
        $applicants =  $applicants->get();
      } elseif ($request->sport == 10  && in_array($gender, [1, 2, 3])) {
        $trialType = 4;

        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender',  'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('hr.competition_level_approved', 1)

          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_four', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.level', 4)
          ->where('hr.session_year', '2026');
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        };

        if (isset($gender) && in_array($gender, [1, 2])) { $applicants->where('hr.gender', $gender); }
        $applicants =  $applicants->get();


        # code...
      } elseif ($request->sport == 9  && in_array($gender, [1, 2, 3])) {
        $trialType = 6;

        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('basic.sports', $request->sport)
          ->where('hr.competition_level_approved', 1)

          ->whereIn('hr.trial_four', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.level', 4)
          ->where('hr.session_year', '2026');
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        };

        if (isset($gender) && in_array($gender, [1, 2])) { $applicants->where('hr.gender', $gender); }
        $applicants =  $applicants->get();
      } elseif ($request->sport == 4 && $request->subsport == 22 && in_array($gender, [1, 2, 3])) {


        $trialType = 7;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('basic.sub_sport_type', $request->subsport)
          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_four', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.competition_level_approved', 1)

          ->where('hr.level', 4)
          ->where('hr.session_year', '2026');
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        };

        if (isset($gender) && in_array($gender, [1, 2])) { $applicants->where('hr.gender', $gender); }
        $applicants =  $applicants->get();
      } elseif ($request->sport == 3 && $subSport == 24 && in_array($gender, [1, 2, 3])) {
        $trialType = 10;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('basic.sub_sport_type', $request->subsport)
          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_four', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.competition_level_approved', 1)

          ->where('hr.level', 4)
          ->where('hr.session_year', '2026');
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        };

        if (isset($gender) && in_array($gender, [1, 2])) { $applicants->where('hr.gender', $gender); }
        $applicants =  $applicants->get();


        //trial_type
      } elseif ($request->sport == 3 && $subSport == 26 && in_array($gender, [1, 2, 3])) {
        $trialType = 12;

        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('basic.sub_sport_type', $request->subsport)
          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_four', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.competition_level_approved', 1)

          ->where('hr.level', 4)
          ->where('hr.session_year', '2026');
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        };

        if (isset($gender) && in_array($gender, [1, 2])) { $applicants->where('hr.gender', $gender); }
        $applicants =  $applicants->get();
      } elseif ($request->sport == 3 && $subSport == 25  && in_array($gender, [1, 2, 3])) {
        $trialType = 11;

        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('basic.sub_sport_type', $request->subsport)
          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_four', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.competition_level_approved', 1)

          ->where('hr.level', 4)
          ->where('hr.session_year', '2026');
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        };

        if (isset($gender) && in_array($gender, [1, 2])) { $applicants->where('hr.gender', $gender); }
        $applicants =  $applicants->get();
      } elseif ($request->sport == 42  && $request->subsport == 11 && in_array($gender, [1, 2, 3])) {
        $trialType = 9;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('basic.sports', $request->sport)
          ->where('basic.sub_sport_type', $request->subsport)
          ->whereIn('hr.trial_four', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.competition_level_approved', 1)

          ->where('hr.level', 4)
          ->where('hr.session_year', '2026');
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        };

        if (isset($gender) && in_array($gender, [1, 2])) { $applicants->where('hr.gender', $gender); }
        $applicants =  $applicants->get();
      } elseif ($request->sport == 42  && $request->subsport == 10 && in_array($gender, [1, 2, 3])) {

        $trialType = 15;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('basic.sports', $request->sport)
          ->where('basic.sub_sport_type', $request->subsport)
          ->whereIn('hr.trial_four', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.competition_level_approved', 1)

          ->where('hr.level', 4)
          ->where('hr.session_year', '2026');
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        };

        if (isset($gender) && in_array($gender, [1, 2])) { $applicants->where('hr.gender', $gender); }
        $applicants =  $applicants->get();
      } elseif ($request->sport == 7 && in_array($gender, [1, 2, 3])) {
        $trialType = 14;

        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('hr.competition_level_approved', 1)

          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_four', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.level', 4)
          ->where('hr.session_year', '2026');
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        };

        if (isset($gender) && in_array($gender, [1, 2])) { $applicants->where('hr.gender', $gender); }
        $applicants =  $applicants->get();


        # code...
      } elseif ($request->sport == 8 && in_array($gender, [1, 2, 3])) {
        $trialType = 13;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('hr.competition_level_approved', 1)

          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_four', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.level', 4)
          ->where('hr.session_year', '2026');
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        };

        if (isset($gender) && in_array($gender, [1, 2])) { $applicants->where('hr.gender', $gender); }
        $applicants =  $applicants->get();
      } elseif ($request->sport == 25  && in_array($gender, [1, 2, 3])) {
        $trialType = 5;

        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('hr.competition_level_approved', 1)

          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_four', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.level', 4)
          ->where('hr.session_year', '2026');
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        };

        if (isset($gender) && in_array($gender, [1, 2])) { $applicants->where('hr.gender', $gender); }
        $applicants =  $applicants->get();
      } elseif ($request->sport == 42 && $request->subsport == 12 && in_array($gender, [1, 2, 3])) {
        $trialType = 19;

        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('basic.sub_sport_type', $request->subsport)
          ->where('basic.sports', $request->sport)
          ->where('hr.competition_level_approved', 1)

          ->whereIn('hr.trial_four', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.level', 4)
          ->where('hr.session_year', '2026');
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        };

        if (isset($gender) && in_array($gender, [1, 2])) { $applicants->where('hr.gender', $gender); }
        $applicants =  $applicants->get();
      } elseif ($request->sport == 5  && in_array($gender, [1, 2, 3])) {
        $trialType = 16;


        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('hr.gender', $gender)
          ->where('hr.competition_level_approved', 1)

          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_four', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.level', 4)
          ->where('hr.session_year', '2026');
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        };

        if (isset($gender) && in_array($gender, [1, 2])) { $applicants->where('hr.gender', $gender); }
        $applicants =  $applicants->get();
      } elseif ($request->sport == 5  && in_array($gender, [1, 2, 3])) {
        $trialType = 17;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('hr.gender', $gender)
          ->where('hr.competition_level_approved', 1)

          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_four', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.level', 4)
          ->where('hr.session_year', '2026');
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        };

        if (isset($gender) && in_array($gender, [1, 2])) { $applicants->where('hr.gender', $gender); }
        $applicants =  $applicants->get();
      } elseif ($request->sport == 5  && in_array($gender, [1, 2, 3])) {
        $trialType = 16;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('hr.competition_level_approved', 1)
          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_four', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.level', 4)
          ->where('hr.session_year', '2026');
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        };

        if (isset($gender) && in_array($gender, [1, 2])) { $applicants->where('hr.gender', $gender); }
        $applicants =  $applicants->get();
      } elseif ($request->sport == 4 && $subSport == 23 && in_array($gender, [1, 2, 3])) {
        $trialType = 8;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('basic.sub_sport_type', $request->subsport)
          ->where('basic.sports', $request->sport)
          ->where('hr.competition_level_approved', 1)

          ->whereIn('hr.trial_four', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.level', 4)
          ->where('hr.session_year', '2026');
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        };

        if (isset($gender) && in_array($gender, [1, 2])) { $applicants->where('hr.gender', $gender); }
        $applicants =  $applicants->get();
      } elseif ($request->sport == 15 && in_array($gender, [1, 2, 3])) {
        $trialType = 20;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_four', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.competition_level_approved', 1)

          ->where('hr.level', 4)
          ->where('hr.session_year', '2026');
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        };

        if (isset($gender) && in_array($gender, [1, 2])) { $applicants->where('hr.gender', $gender); }
        $applicants =  $applicants->get();
      } elseif ($request->sport == 14 && in_array($gender, [1, 2, 3])) {
        $trialType = 21;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('hr.competition_level_approved', 1)

          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_four', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.level', 4)
          ->where('hr.session_year', '2026');
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        };

        if (isset($gender) && in_array($gender, [1, 2])) { $applicants->where('hr.gender', $gender); }
        $applicants =  $applicants->get();
      } elseif ($request->sport == 23 && in_array($gender, [1, 2, 3])) {
        $trialType = 22;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('hr.competition_level_approved', 1)

          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_four', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.level', 4)
          ->where('hr.session_year', '2026');
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        };

        if (isset($gender) && in_array($gender, [1, 2])) { $applicants->where('hr.gender', $gender); }
        $applicants =  $applicants->get();
      } elseif ($request->sport == 20 && in_array($gender, [1, 2, 3])) {
        $trialType = 23;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('hr.competition_level_approved', 1)

          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_four', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.level', 4)
          ->where('hr.session_year', '2026');
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        };

        if (isset($gender) && in_array($gender, [1, 2])) { $applicants->where('hr.gender', $gender); }
        $applicants =  $applicants->get();
      } elseif ($request->sport == 44 && in_array($gender, [1, 2, 3])) {


        $trialType = 24;
        $applicants = DB::table('hostel_register as hr')
          ->join('hostel_application_basic as basic', 'hr.id', '=', 'basic.hostel_register_id')
          ->join('hostel_application_communication as communication', 'hr.id', '=', 'communication.hostel_register_id')
          ->join('cities', 'basic.district_id', '=', 'cities.id')
          ->leftjoin('hostel_div_district_mapping', 'cities.id', '=', 'hostel_div_district_mapping.district_id')
          ->leftjoin('hostel_division_master', 'hostel_division_master.id', '=', 'hostel_div_district_mapping.division_id')
          ->select('hr.application_no', 'hr.name as fullname', 'hr.dob', 'hr.gender', 'basic.sports', 'hr.level', 'hr.id', 'hostel_division_master.division_name', 'basic.district_id')
          ->where('hr.competition_level_approved', 1)

          ->where('basic.sports', $request->sport)
          ->whereIn('hr.trial_four', [1, 2, 3])
          ->whereNull('hr.cancel_status')
          ->where('hr.status', 1)
          ->where('hr.level', 4)
          ->where('hr.session_year', '2026');
        if ($request->division_id  && $request->division_id  != null) {
          $applicants->where('hostel_division_master.id', $request->division_id);
        };

        if (isset($gender) && in_array($gender, [1, 2])) { $applicants->where('hr.gender', $gender); }
        $applicants =  $applicants->get();
      } else {
        $trialType = 18;



        $applicants = [];
      }




      return view('hosteltrial.trialListApplicantfour', compact('trialType', 'sports', 'applicants',  'filterData', 'filtsubSport', 'subSport', 'division', 'allSubSports'));
    }

    $trialType = 18;



    $applicants = [];
    return view('hosteltrial.trialListApplicantfour', compact('trialType', 'sports', 'applicants', 'division', 'allSubSports'));
  }




  public function final_approved_list(Request $request)
  {


    $division = DB::table('hostel_division_master')->orderBy('division_name', 'asc')->get();

    $check = DB::table('hostel_div_district_mapping')
      ->select(DB::raw('group_concat(district_id) as district_id'))->where('division_id', Auth::guard('admin')->user()->division_id)->get();

    if ($request->post()) {

      if ($request->division_filter) {

        $checkk = DB::table('hostel_div_district_mapping')
          ->select(DB::raw('group_concat(district_id) as district_id'))->where('division_id', $request->division_filter)->get();
      }
    }






    $districts = DB::table('cities')->where('state_id', 23);


    $districts =   $districts->orderBy('city', 'asc')->get();


    $hostelList =  DB::table('hostel_register as rg')
      ->join('hostel_application_basic as basic', 'rg.id', '=', 'basic.hostel_register_id')
      ->select('rg.*', 'basic.sports', 'basic.district_id',  DB::raw('rg.physical_trial_four_marks + rg.skill_trial_four_marks  as total_mark'))
      ->where('rg.level', 4)
      ->where('rg.trial_four', 2)

      ->where('rg.competition_level_approved', 1);



    if ($request->post()) {


      if ($request->sport_id) {
        $hostelList->where('basic.sports', $request->sport_id);
      }



      if ($request->gender) {
        $hostelList->where('rg.gender', $request->gender);
      }
    }

    $selectedYear = $request->input('session_year', config('app.session_year'));
    $hostelList  = $hostelList->where('rg.session_year', $selectedYear)->orderby('total_mark', "DESC")
      ->get();


    $divisions = DB::table('hostel_division_master')->orderBy('division_name', 'asc')->get();

    $sports = DB::table('sport_master')->where('status', 1)->orderBy('name')->get();
    $years = DB::table('hostel_register')->select('session_year')->distinct()->whereNotNull('session_year')->orderBy('session_year', 'desc')->pluck('session_year');

    return view('hosteltrial.final_list_approved', compact('hostelList', 'sports', 'divisions', 'years'));
  }


  public function final_approved_list_store(Request $request)
  {
    foreach ($request->arr as $value) {
      DB::table('hostel_register')->where('id', $value)->update([
        'final_list_approved' => 1,

        'ip_address_final_list_approved' => $request->ip(),
        'final_list_approved_by' => Auth::guard('admin')->user()->id,
      ]);
    }
    return response()->json(["error" => false, "msg" => "Applicant Approved Successfully"]);
  }




  public function hostel_allotment_list(Request $request)
  {

    $division = DB::table('hostel_division_master')->orderBy('division_name', 'asc')->get();




    $check = DB::table('hostel_div_district_mapping')
      ->select(DB::raw('group_concat(district_id) as district_id'))->where('division_id', Auth::guard('admin')->user()->division_id)->get();

    if ($request->post()) {

      if ($request->division_filter) {

        $checkk = DB::table('hostel_div_district_mapping')
          ->select(DB::raw('group_concat(district_id) as district_id'))->where('division_id', $request->division_filter)->get();
      }
    }



    $districts = DB::table('cities')->where('state_id', 23);





    $districts =   $districts->orderBy('city', 'asc')->get();



    if ($request->post('sport_id')) {


      $hostelList =  DB::table('hostel_register as rg')
        ->join('hostel_application_basic as basic', 'rg.id', '=', 'basic.hostel_register_id')
        ->select('rg.*', 'basic.sports', 'basic.district_id',  DB::raw('rg.physical_trial_four_marks + rg.skill_trial_four_marks as total_mark'))
        ->where('rg.level', 4)
        ->where('rg.trial_four', 2)

        ->where('rg.final_list_approved', 1)
        ->whereNull('rg.cancel_status');





      if ($request->sport_id) {
        $hostelList->where('basic.sports', $request->sport_id);
      }

      if ($request->subsport) {
        $hostelList->where('basic.sub_sport_type', $request->subsport);
      }


      if ($request->gender) {
        $hostelList->where('rg.gender', $request->gender);
      }






      $hostelList  = $hostelList->orderby('rg.name', "DESC")
        ->get();
    } else {
      $hostelList = [];
    }
    $divisions = DB::table('hostel_division_master')->orderBy('division_name', 'asc')->get();

    $sports = DB::table('sport_master')->where('status', 1)->orderBy('name')->get();

    return view('hosteltrial.hostel_allotment_list', compact('hostelList', 'sports', 'divisions'));
  }




  public function hostel_seat_vacant(Request $request)
  {
    $total = (count($request->arr));


    if ($request->gender == 1) {
      $data = DB::table('hostel_master')->select('*', DB::raw('(boys - boys_alloted)as vacant'))->whereRaw("FIND_IN_SET($request->sport,sports) AND (boys - boys_alloted) >= $total")->orderBy('hostel_name')->get();
    } else {
      $data = DB::table('hostel_master')->select('*', DB::raw('(girls - girls_alloted)as vacant'))->whereRaw("FIND_IN_SET($request->sport,sports) AND (girls - girls_alloted) >= $total")->orderBy('hostel_name')->get();
    }


    return response()->json(["error" => false, "data" => $data, "msg" => "Applicant Approved Successfully"]);
  }











  public function hostel_allotted_to(Request $request)
  {
    session()->put('filter_hostel', $request->all());

    $division = DB::table('hostel_division_master')->orderBy('division_name', 'asc')->get();

    $check = DB::table('hostel_div_district_mapping')
      ->select(DB::raw('group_concat(district_id) as district_id'))->where('division_id', Auth::guard('admin')->user()->division_id)->get();

    if ($request->post()) {

      if ($request->division_filter) {

        $checkk = DB::table('hostel_div_district_mapping')
          ->select(DB::raw('group_concat(district_id) as district_id'))->where('division_id', $request->division_filter)->get();
      }
    }

    $districts = DB::table('cities')->where('state_id', 23);

    $districts =   $districts->orderBy('city', 'asc')->get();

    $hostelList =  DB::table('hostel_register as rg')
      ->join('hostel_application_basic as basic', 'rg.id', '=', 'basic.hostel_register_id')
      ->select('rg.*', 'basic.sports', 'basic.district_id',  DB::raw('rg.physical_trial_four_marks + rg.skill_trial_four_marks as total_mark'))
      ->whereNotNull('rg.hostel_alloted_id')
      ->where('rg.hostel_alloted_id', "!=", 0)
      ->whereNull('rg.detach_status');


    if (request()->segment(3)) {
      $hostelList->where('rg.hostel_alloted_id', request()->segment(3));
    }
    if ($request->post()) {


      if ($request->sport_id) {
        $hostelList->where('basic.sports', $request->sport_id);
      }


      
      if ($request->session_year) {
        $hostelList->where('rg.session_year',$request->session_year);
      }

      if ($request->hostel_master) {
        $hostelList->where('rg.hostel_alloted_id', $request->hostel_master);
      }




      if ($request->subsport) {
        $hostelList->where('basic.sub_sport_type', $request->subsport);
      }


      if ($request->gender) {
        $hostelList->where('rg.gender', $request->gender);
      }

      if ($request->division_filter) {
        $hostelList->whereIn('basic.district_id', explode(',', $checkk[0]->district_id));
      }
    }

    $hostelList  = $hostelList->orderby('rg.name')
      ->get();


    $divisions = DB::table('hostel_division_master')->orderBy('division_name', 'asc')->get();

    $sports = DB::table('sport_master')->where('status', 1)->orderBy('name')->get();
    $hostel_master = DB::table('hostel_master')->orderBy('hostel_name')->get();

    return view('hosteltrial.hostel_allotted_to', compact('hostelList', 'sports', 'divisions', 'hostel_master'));
  }




  public function hostel_detach(Request $request)
  {

    DB::table('hostel_register')->where('id', $request->user_id)->update([
      'detach_status' => 1,
      'detach_reason' => $request->reason_detach,
      'detach_ip_address' => $request->ip(),
      'detach_by' => Auth::guard('admin')->user()->id,
      'detach_on' => now()
    ]);
    $user = HostelRegister::find($request->user_id);
    $gender = $user->gender;

    if ($gender == 1) {
      $hostel = DB::table('hostel_master')->where('id', $user->hostel_alloted_id)->first();
      $boy_allot = $hostel->boys_alloted - 1;
      $seat_used = $hostel->seat_used - 1;
      DB::table('hostel_master')->where('id', $user->hostel_alloted_id)->update(['boys_alloted' => $boy_allot, 'seat_used' => $seat_used]);
    } else {
      $hostel = DB::table('hostel_master')->where('id', $user->hostel_alloted_id)->first();
      $girl_allot = $hostel->girls_alloted - 1;
      $seat_used = $hostel->seat_used - 1;
      DB::table('hostel_master')->where('id', $user->hostel_alloted_id)->update(['girls_alloted' => $girl_allot, 'seat_used' => $seat_used]);
    }
    return response()->json(["error" => false, "msg" => "Hostel Detached Successfully"]);
  }












  public function hostel_allotment_letter(Request $request)
  {
    $validation = Validator::make($request->all(), [
      'letter' => 'required',
    ]);

    $user =   HostelRegister::find($request->user_id);
    $msg = "With ref. to Application No. $user->application_no on Khel Sathi Portal, you have been selected for Hostel Admission. Kindly visit the link https://khelsathi.in/application/hostel/login and log in to your account to download your allotment letter and submit admission fee. -Omninet Technologies Pvt. Ltd.";




    //mail 
    try {
      SendhostelallotmentSMS($user->mobile, $msg);

      $data = array("name" => "smtp", "body" => "Dear $user->name,<br>With ref. to Application No. $user->application_no on Khel Sathi Portal, you have been selected for Hostel Admission. Kindly visit the link https://khelsathi.in/application/hostel/login and log in to your account to download your allotment letter and submit the admission fee. -Regards,<br> <br>
      Department of Sports, Uttar Pradesh");
      $subject = "Provisionally Admitted in " . hostelName($user->hostel_alloted_id);
      $email = $user->email;

      Mail::send('emails.mail', $data, function ($message) use ($subject, $email) {
        $message->to($email)
          ->subject($subject);
        $message->from(env('MAIL_USERNAME'), env('MAIL_FROM_NAME'));
      });
    } catch (Throwable $e) {
    }

    if ($validation->fails())
      return redirect()->back()->with('error', $validation->errors()->first());
    if ($request->hasFile('letter')) {
      $allotment_letter = moveFile('hostel/allotment_letter', $request->letter);
    }
    DB::table('hostel_register')->where('id', $request->user_id)->update([
      'hostel_allotment_letter' => $allotment_letter,
      'hostel_allotment_letter_ip_address' => $request->ip(),
      'hostel_allotment_letter_by' => Auth::guard('admin')->user()->id,
      'hostel_allotment_letter_on' => now()
    ]);
    return redirect()->back()->with('success', 'Allotment Letter Uploaded Successfully.');
  }



  public function download_hostel_pdf($checkk)
  {
    $filter =  Session::get('filter_hostel');


    ini_set("memory_limit", "10560M");
    ini_set('max_execution_time', 500);
    $data = [
      'module_name' => 'Online Admission Module for Sports Colleges & Hostels',
    ];
    if ($checkk == 1) {
      $division = DB::table('hostel_division_master')->get();
      $check = DB::table('hostel_div_district_mapping')
        ->select(DB::raw('group_concat(district_id) as district_id'))->where('division_id', Auth::guard('admin')->user()->division_id)->get();
      $districts = DB::table('cities')->where('state_id', 23);
      if (Auth::guard('admin')->user()->division_id) {
        $districts->whereIn('id', explode(',', $check[0]->district_id));
      }
      $districts =   $districts->orderBy('city', 'asc')->get();
      $hostelList =  DB::table('hostel_register as rg')
        ->join('hostel_application_basic as basic', 'rg.id', '=', 'basic.hostel_register_id')
        ->select('rg.*', 'basic.sports', 'basic.sub_sport_type', 'basic.district_id');
      if (isset($filter['sport_id']) &&  $filter['sport_id']) {
        $hostelList->where('basic.sports',  $filter['sport_id']);
      }

      if (isset($filter['subsport']) &&  $filter['subsport']) {
        $hostelList->where('basic.sub_sport_type',  $filter['subsport']);
      }

      if (isset($filter['city_filter']) &&  $filter['city_filter']) {
        $hostelList->where('basic.district_id', $filter['city_filter']);
      }
      if (isset($filter['status_filter']) &&  $filter['status_filter']) {
        $hostelList->where('rg.status', $filter['status_filter']);
      }
      if (isset($filter['district_trial']) &&  $filter['district_trial']) {
        $hostelList->where('rg.trial_one', $filter['district_trial']);
      }
      if (isset($filter['division_trial']) &&  $filter['division_trial']) {
        $hostelList->where('rg.trial_two', $filter['division_trial']);
      }
      if (isset($filter['state_trial']) &&  $filter['state_trial']) {
        $hostelList->where('rg.trial_three', $filter['state_trial']);
      }
      if (isset($filter['existing_student']) &&  $filter['existing_student'] == 1) {
        $hostelList->where('rg.existing_student', $filter['existing_student']);
      }
      if (Auth::guard('admin')->user()->division_id > 0) {
        $hostelList->whereIn('basic.district_id', explode(',', $check[0]->district_id));
      }

      if (Auth::guard('admin')->user()->district_id > 0) {
        $hostelList->where('basic.district_id', Auth::guard('admin')->user()->district_id);
      }

      if (isset($filter['session_year']) && $filter['session_year']) {

        $hostelList->where('rg.session_year', (string)$filter['session_year']);
      } else {

        $hostelList->where('rg.session_year', '2025');
      }
      $hostelList = $hostelList->whereIn('rg.payment_status', [1, 2])->get();
      $data['report_name'] = "List of Applicants who applied for Hostel Admission";
      $data['report_code'] = "OA008";
      $data['report_count'] = "10";
      $pdf = Pdf::loadView('exports.hostel_data', ['hostelList' => $hostelList, 'data' => $data])->setPaper('a4', 'landscape');
    } elseif ($checkk == 2) {
      $division = DB::table('hostel_division_master')->get();
      $check = DB::table('hostel_div_district_mapping')
        ->select(DB::raw('group_concat(district_id) as district_id'))->where('division_id', Auth::guard('admin')->user()->division_id)->get();
      $districts = DB::table('cities')->where('state_id', 23);
      if (Auth::guard('admin')->user()->division_id) {
        $districts->whereIn('id', explode(',', $check[0]->district_id));
      }
      $districts =   $districts->orderBy('city', 'asc')->get();
      $hostelList =  DB::table('hostel_register as rg')
        ->join('hostel_application_basic as basic', 'rg.id', '=', 'basic.hostel_register_id')
        ->select('rg.*', 'basic.*', 'basic.district_id', DB::raw('rg.physical_trial_one_marks + rg.skill_trial_one_marks as total_mark'))
        ->where('rg.trial_one', 2)
        ->whereNull('rg.cancel_status');
      if (Auth::guard('admin')->user()->district_id > 0) {
        $hostelList->where('basic.district_id', Auth::guard('admin')->user()->district_id);
      }
      if (Auth::guard('admin')->user()->division_id) {
        $hostelList->whereIn('basic.district_id', explode(',', $check[0]->district_id));
      }
      if (isset($filter['sport_id']) &&  $filter['sport_id']) {
        $hostelList->where('basic.sports', $filter['sport_id']);
      }
      if (isset($filter['city_filter']) && $filter['city_filter']) {
        $hostelList->where('basic.district_id', $filter['city_filter']);
      }
      if (isset($filter['gender']) && $filter['gender']) {
        $hostelList->where('rg.gender', $filter['gender']);
      }
      $hostelList = $hostelList->where('rg.session_year', '2025')->orderby('total_mark', "DESC")->get();
      $data['report_name'] = "List of District Level Approved Applicants";
      $data['report_code'] = "OA003";
      $data['report_count'] = "13";
      $pdf = Pdf::loadView('exports.hostel_data', ['hostelList' => $hostelList, 'data' => $data])->setPaper('a4', 'landscape');
    } elseif ($checkk == 3) {
      $check = DB::table('hostel_div_district_mapping')
        ->select(DB::raw('group_concat(district_id) as district_id'))->where('division_id', Auth::guard('admin')->user()->division_id)->get();
      if (isset($filter['division_filter']) && $filter['division_filter']) {
        $checkk = DB::table('hostel_div_district_mapping')
          ->select(DB::raw('group_concat(district_id) as district_id'))->where('division_id', $filter['division_filter'])->get();
      }
      $districts = DB::table('cities')->where('state_id', 23);
      if (Auth::guard('admin')->user()->division_id) {
        $districts->whereIn('id', explode(',', $check[0]->district_id));
      }
      $districts =   $districts->orderBy('city', 'asc')->get();
      $hostelList =  DB::table('hostel_register as rg')
        ->join('hostel_application_basic as basic', 'rg.id', '=', 'basic.hostel_register_id')
        ->select('rg.*', 'basic.*', 'basic.district_id',  DB::raw('rg.physical_trial_two_marks + rg.skill_trial_two_marks as total_mark'))
        ->where('rg.level', 4)
        ->where('rg.trial_two', 2)
        ->whereNull('rg.cancel_status');
      if (Auth::guard('admin')->user()->division_id) {
        $hostelList->whereIn('basic.district_id', explode(',', $check[0]->district_id));
      }
      if (isset($filter['sport_id']) && $filter['sport_id']) {
        $hostelList->where('basic.sports', $filter['sport_id']);
      }
      if (isset($filter['division_filter']) && $filter['division_filter']) {
        $hostelList->whereIn('basic.district_id', explode(',', $checkk[0]->district_id));
      }
      if (isset($filter['gender']) && $filter['gender']) {
        $hostelList->where('rg.gender', $filter['gender']);
      }
      $hostelList  = $hostelList->where('rg.session_year', '2025')->orderby('total_mark', "DESC")
        ->get();

      $data['report_name'] = "List of Division Level Approved Applicants";
      $data['report_code'] = "OA004";
      $data['report_count'] = "13";
      $pdf = Pdf::loadView('exports.hostel_data', ['hostelList' => $hostelList, 'data' => $data])->setPaper('a4', 'landscape');
    } elseif ($checkk == 4) {

      $hostelList =  DB::table('hostel_register as rg')
        ->join('hostel_application_basic as basic', 'rg.id', '=', 'basic.hostel_register_id')
        ->select('rg.*', 'basic.*', 'basic.district_id')
        ->where('rg.level', 4)
        ->whereNull('rg.cancel_status')
        ->where('rg.division_level_approved', 1);

      if (isset($filter['sport_id']) && $filter['sport_id']) {
        $hostelList->where('basic.sports', $filter['sport_id']);
      }

      if (isset($filter['city_filter']) && $filter['city_filter']) {
        $hostelList->where('basic.district_id', $filter['city_filter']);
      }
      if (isset($filter['gender']) && $filter['gender']) {
        $hostelList->where('rg.gender', $filter['gender']);
      }
      $hostelList =   $hostelList->where('rg.session_year', '2025')->get();
      $data['report_name'] = "List of State Level Medical Approved Applicants";
      $data['report_code'] = "OA005";
      $data['report_count'] = "13";
      $pdf = Pdf::loadView('exports.hostel_data', ['hostelList' => $hostelList, 'data' => $data])->setPaper('a4', 'landscape');
    } elseif ($checkk == 5) {
      $division = DB::table('hostel_division_master')->orderBy('division_name', 'asc')->get();
      $check = DB::table('hostel_div_district_mapping')
        ->select(DB::raw('group_concat(district_id) as district_id'))->where('division_id', Auth::guard('admin')->user()->division_id)->get();
      if (isset($filter['division_filter']) && $filter['division_filter']) {
        $checkk = DB::table('hostel_div_district_mapping')
          ->select(DB::raw('group_concat(district_id) as district_id'))->where('division_id', $filter['division_filter'])->get();
      }
      $districts = DB::table('cities')->where('state_id', 23);
      $districts =   $districts->orderBy('city', 'asc')->get();
      $hostelList =  DB::table('hostel_register as rg')
        ->join('hostel_application_basic as basic', 'rg.id', '=', 'basic.hostel_register_id')
        ->select('rg.*', 'basic.*', 'basic.district_id',  DB::raw('rg.physical_trial_three_marks + rg.skill_trial_three_marks as total_mark'))
        ->where('rg.level', 4)
        ->where('rg.trial_three', 2)
        ->where('rg.medical_test', 2)
        ->whereNull('rg.cancel_status');
      if (isset($filter['sport_id']) && $filter['sport_id']) {
        $hostelList->where('basic.sports', $filter['sport_id']);
      }
      if (isset($filter['subsport']) && $filter['subsport']) {
        $hostelList->where('basic.sub_sport_type', $filter['subsport']);
      }
      if (isset($filter['gender']) && $filter['gender']) {
        $hostelList->where('rg.gender', $filter['gender']);
      }
      if (isset($filter['division_filter']) && $filter['division_filter']) {
        $hostelList->whereIn('basic.district_id', explode(',', $checkk[0]->district_id));
      }
      $hostelList  = $hostelList->where('rg.session_year', '2025')->orderby('total_mark', "DESC")
        ->get();
      $data['report_name'] = "List of State Level Competition/Trial Approved";
      $data['report_code'] = "OA006";
      $data['report_count'] = "13";
      $pdf = Pdf::loadView('exports.hostel_data', ['hostelList' => $hostelList, 'data' => $data])->setPaper('a4', 'landscape');
    } elseif ($checkk == 6) {
      $division = DB::table('hostel_division_master')->orderBy('division_name', 'asc')->get();

      $districts = DB::table('cities')->where('state_id', 23)->orderBy('city', 'asc')->get();
      $hostelList =  DB::table('hostel_register as rg')
        ->join('hostel_application_basic as basic', 'rg.id', '=', 'basic.hostel_register_id')
        ->select('rg.*', 'basic.*', 'basic.district_id',  DB::raw('rg.physical_trial_four_marks + rg.skill_trial_four_marks as total_mark'))
        ->whereNotNull('rg.hostel_alloted_id')
        ->whereNull('rg.detach_status')

        ->where('rg.hostel_alloted_id', "!=", 0);
      if (request()->segment(3)) {
        $hostelList->where('rg.hostel_alloted_id', request()->segment(3));
      }

      if (isset($filter['sport_id']) && $filter['sport_id']) {
        $hostelList->where('basic.sports', $filter['sport_id']);
      }

      if (isset($filter['hostel_master']) && $filter['hostel_master']) {
        $hostelList->where('rg.hostel_alloted_id', $filter['hostel_master']);
      }
      if (isset($filter['subsport']) && $filter['subsport']) {
        $hostelList->where('basic.sub_sport_type', $filter['subsport']);
      }
      if (isset($filter['gender']) && $filter['gender']) {
        $hostelList->where('rg.gender', $filter['gender']);
      }
      if (isset($filter['division_filter']) && $filter['division_filter']) {
        $hostelList->whereIn('basic.district_id', explode(',', $checkk[0]->district_id));
      }
      $hostelList =   $hostelList->where('rg.session_year', '2025')->get();
      $data['report_name'] = "List of Applicants with Allotted Hostels";
      $data['report_code'] = "OA007";
      $data['report_count'] = "10";
      $pdf = Pdf::loadView('exports.hostel_data', ['hostelList' => $hostelList, 'data' => $data])->setPaper('a4', 'landscape');
    } elseif ($checkk == 7) {
      if ((isset($filter['district_id']) && $filter['district_id']) && !isset($filter['sport_id'])) {
        $hostels = DB::table('hostel_master')->where('districts', $filter['district_id'])->orderBy('hostel_name')->get();
      } elseif (!isset($filter['district_id']) && (isset($filter['sport_id']) && $filter['sport_id'])) {
        $hostels = DB::table('hostel_master')->whereRaw('FIND_IN_SET("' . $filter['sport_id'] . '", sports)')->orderBy('hostel_name')->get();
      } elseif ((isset($filter['district_id']) && $filter['district_id']) && (isset($filter['sport_id']) && $filter['sport_id'])) {
        $hostels = DB::table('hostel_master')->whereRaw('FIND_IN_SET("' . $filter['sport_id'] . '", sports) ')->Where('districts', $filter['district_id'])->orderBy('hostel_name')->get();
      } else {
        $hostels = DB::table('hostel_master')->orderBy('hostel_name')->get();
      }
      $sports = DB::table('sport_master')->orderBy('name')->get();
      $data['report_name'] = "Details of  Hostel Seat Matrix";
      $data['report_code'] = "OA001";
      $data['report_count'] = "13";
      $pdf = Pdf::loadView('exports.hostel_matrix', ['hostels' => $hostels, 'data' => $data])->setPaper('a4', 'landscape');
    } elseif ($checkk == 8) {
      $districts = DB::Select("SELECT cities.city , count(CASE when hr.payment_status = 2 then 1 end) as total , count(CASE when hr.gender = 1 and hr.payment_status = 2 then 1 end) as male ,count(CASE when hr.gender = 2 and hr.payment_status = 2 then 1 end) as female FROM `cities` left join hostel_application_basic as hab on hab.district_id = cities.id left join hostel_register as hr on hr.id = hab.hostel_register_id where cities.state_id = 23 group by cities.id ORDER BY city asc;");
      $total = DB::select("SELECT cities.city , count(CASE when hr.payment_status = 2 then 1 end) as total , count(CASE when hr.gender = 1 and hr.payment_status = 2 then 1 end) as male ,count(CASE when hr.gender = 2 and hr.payment_status = 2 then 1 end) as female FROM `cities` left join hostel_application_basic as hab on hab.district_id = cities.id left join hostel_register as hr on hr.id = hab.hostel_register_id where cities.state_id = 23 ");
      $data['report_name'] = "District Wise Hostel Admission Count of Applicants";
      $data['report_code'] = "OA002";
      $data['report_count'] = "12";
      $pdf = Pdf::loadView('exports.districtwisecount', ['districts' => $districts, 'total' => $total, 'data' => $data])->setPaper('a4', 'landscape');
    } elseif ($checkk == 9) {
     





      $division = DB::table('hostel_division_master')->get();
      $divisions = DivisionModel::select('division_name', 'id')->get();
      $sports =     DB::table('sport_type')->where('status', 1);

      if (Auth::guard('admin')->user()->id == 40) {
        $sports->whereIn('id', [25, 5, 7]);
      };


      if (Auth::guard('admin')->user()->id == 41) {
        $sports->whereIn('id', [8, 9]);
      };

      $sports = $sports->orderBy('name', 'asc')->get();
      $check = DB::table('hostel_div_district_mapping')
        ->select(DB::raw('group_concat(district_id) as district_id'))->where('division_id', Auth::guard('admin')->user()->division_id)->get();
      $district =     DB::table('cities')->where('state_id', 23);
      $abc = 0;
      if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 6) {
        $abc = 1;
      }
      if ($abc == 0) {
        $district->whereIn('id', explode(',', $check[0]->district_id));
      }


      $district =   $district->orderBy('city', 'asc')->get();
      $registrations = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as comm', 'rg.id', '=', 'comm.user_id')
        ->join('online_admission_education_document_details as edu', 'rg.id', '=', 'edu.user_id')
        ->join('cities', 'cities.id', '=', 'comm.p_district')
        ->join('sport_type', 'basic.sport_type', '=', 'sport_type.id')
        ->leftJoin('sub_sport_type', 'basic.sub_sport_type', '=', 'sub_sport_type.id')
        ->join('online_admission_payment_response_details as payment_response', 'payment_response.user_id', '=', 'rg.id')
        ->select('rg.application_no', 'rg.query_status', 'rg.pen_no', 'edu.updise_code', 'rg.enroll_no', 'rg.trial_type', 'rg.fullname', 'basic.sub_sport_type', 'basic.trial_division', 'rg.email', 'rg.mobile', 'sub_sport_type.sub_type', 'rg.aadhar_no', 'sport_type.name', 'rg.final_status', 'rg.id as register_id', 'rg.challan_no', 'rg.created_at', 'basic.*', 'payment_response.uniquechallan', 'payment_response.transDate');
      $registrations->where('rg.payment_status', 1);



      if (Auth::guard('admin')->user()->id == 40) {


        $registrations->whereIn('sport_type.id', [25, 5, 7]);
      };


      if (Auth::guard('admin')->user()->id == 41) {
        $registrations->whereIn('sport_type.id', [8, 9]);
      };
      $abc = 0;
      if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 6) {
        $abc = 1;
      }
      if ($abc == 0) {
        $registrations->where('basic.trial_division', Auth::guard('admin')->user()->division_id);
      }
  

      if (isset($filter['action']) && $filter['action']) {
        $registrations->where('rg.final_status', $filter['action']);
      }




        if (isset($filter['query_marked']) && $filter['query_marked']) {
          $registrations->where('rg.query_status', $filter['query_marked']);
        }



        if (isset($filter['trial_type']) && $filter['trial_type']) {
          if ($filter['trial_type'] == 2) {
            $registrations->whereIn('rg.trial_type', [2, 3, 5]);
          } else {
            $registrations->where('rg.trial_type', $filter['trial_type']);
          }
        }
  
        if (isset($filter['subsport']) && $filter['subsport']) {
          $registrations->where('sub_sport_type.id', $filter['subsport']);
        }
  
        if (isset($filter['district_id']) && $filter['district_id']) {
          $registrations->where('comm.p_district', $filter['district_id']);
        }




        if (isset($filter['division_id']) && $filter['division_id']) {
          $registrations->where('basic.trial_division', $filter['division_id']);
        }
        if (isset($filter['sport_id']) && $filter['sport_id']) {
          $registrations->where('sport_type.id', $filter['sport_id']);
        }
        // dd($registrations);



        if (isset($filter['from_Date']) && $filter['from_Date']) {
          $fromDate = Carbon::parse($filter['from_Date'])->format('Y-m-d');

          $registrations->whereRaw("
                          STR_TO_DATE(payment_response.transDate, '%a %b %d %H:%i:%s IST %Y') >= ?", [$filter['from_Date']]);
        }

        if ( isset($filter['to_Date']) && $filter['to_Date']) {
          $toDate = Carbon::parse($filter['to_Date'])->format('Y-m-d');

          $registrations->whereRaw("
                          STR_TO_DATE(payment_response.transDate, '%a %b %d %H:%i:%s IST %Y') <= ?", [$filter['to_Date']]);
        }

        if ((isset($filter['from_Date']) && $filter['from_Date']) && (isset($filter['to_Date']) && $filter['to_Date'])) {
          if (ymd($filter['from_Date']) > ymd($filter['to_Date'])) {
            return redirect()->back()->with("error", "From Date should not be greater than To Date Field");
          } elseif (ymd($filter['from_Date']) == ymd($filter['to_Date'])) {
     
            $registrations->whereRaw("
                              DATE(STR_TO_DATE(payment_response.transDate, '%a %b %d %H:%i:%s IST %Y')) = ?", $filter['to_Date']);
          } else {
            $registrations->whereRaw("
                              STR_TO_DATE(payment_response.transDate, '%a %b %d %H:%i:%s IST %Y') BETWEEN ? AND ?", [$filter['from_Date'],$filter['to_Date']]);
          }
        }
    



      $registrations = $registrations->where('rg.session_year', '2025')->where('payment_response.status', 'success')->groupBy('rg.id')->orderBy('rg.fullname', 'asc')->get();

















      $data['report_name'] = "List of Applicants who applied for Sports College Admission";
      $data['report_code'] = "OA009";
      $data['report_count'] = "13";
      $pdf = Pdf::loadView('exports.online_admission_data', ['registrations' => $registrations, 'data' => $data])->setPaper('a4', 'landscape');
    }


    $namee  = $data['report_name'] . date('m-d-Y') . '.pdf';
    //  return view('exports.hostel_data',['hostelList'=> $hostelList ] );
    $pdf->output();
    $domPdf = $pdf->getDomPDF();
    $canvas = $domPdf->get_canvas();
    $rightMargin = 90;
    $pageWidth = $canvas->get_width();
    $pageNumberX = $pageWidth - $rightMargin;

    $canvas->page_text($pageNumberX, $canvas->get_height() - 20, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, [0, 0, 0]);
    $canvas->page_text(320, $canvas->get_height() - 20, "*This is a Software Generated Report*", null, 10, [0, 0, 0]);
    return $pdf->download($namee);
  }
}
