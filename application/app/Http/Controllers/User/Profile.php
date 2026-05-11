<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use APP\Http\Helpers\Helper;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Laxmanaward;
use App\Models\Ranilaxmibai;
use App\Models\PositionHolder;
use DateTime;
use Illuminate\Support\Facades\Gate;
use App\Events\StatusChangeLog;

class Profile extends Controller
{
    /**
     * Display a listing of the type of plant.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('id', Auth::id())->first();
        if (User::find(Auth::id())->password_change_status == "1") {
            return redirect('/change-password');
        }
        $country = DB::table('countries')->get();
        $state = DB::table('states')->orderBy('name', 'ASC')->get();
        $city = DB::table('cities')->orderBy('city', 'ASC')->get();
        $form_check = (DB::table('laxman_award')->where('user_id', Auth::id())->where('final_submit', 1)->exists()
            || DB::table('ranilaxmibai_award')->where('user_id', Auth::id())->where('final_submit', 1)->exists()
            || DB::table('position_holder')->where('user_id', Auth::id())->where('final_submit', 1)
            || DB::table('financial_assistance')->where('user_id', Auth::id())->where('final_submit', 1)
            || DB::table('monthly_pension')->where('user_id', Auth::id())->where('final_submit', 1)
            || DB::table('direct_recruitment')->where('user_id', Auth::id())->where('final_submit', 1)
            ->exists());

        return view('user.profile.profile', compact('form_check', 'user', 'country', 'state', 'city'));
    }

    public function applyFor()
    {
        $articles = DB::table('user_award_apply_master')
            ->select('award_type_id')
            ->where('user_id', Auth::id())
            ->where('status', 1)
            ->get();
        $aa = array();
        // foreach ($articles as $sku){
        //     $aa[]=$sku->award_type_id;
        //     }
        $user = User::where('id', Auth::id())->first();

        if ($user->gender == 'Male' || $user->gender == 'Transgender') {
            $award_type = DB::table('award_type')->whereNotIn('id', $aa)->whereIn('id', [1, 3])->get();
        } elseif ($user->gender == 'Female') {
            $award_type = DB::table('award_type')->whereNotIn('id', $aa)->whereIn('id', [2, 3])->get();
        } else {
            $award_type = DB::table('award_type')->whereNotIn('id', $aa)->whereIn('id', [1, 2, 3])->get();
        }
        // dd($award_type);
        //$award_type = DB::table('award_type')->whereNotIn('id',$aa)->whereIn('id',[1,2,3])->get();


        return view('user.profile.applyfor', compact('user', 'award_type'));
    }

    public function saveApplyFor(Request $req)
    {
        $required = [

            'applyfor'           => 'required'
        ];
        // dd($req->applyfor);
        $validation = Validator::make($req->all(), $required, msg());
        // dd(date('Y-m-d h:i:sa'));
        if ($validation->fails())
            // return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
            return redirect('/applyFor')->with('error', $validation->errors()->first());

        $check = DB::table('user_award_apply_master')->insertGetId(array(
            'user_id' => Auth::id(),
            'award_type_id' => $req->applyfor,
            'created_at' =>  date('Y-m-d h:i:s')
        ));
        if ($check) {

            // session()->flash('success', 'Apply For.');
            if ($req->applyfor == "1")
                return redirect('/laxman_award');
            if ($req->applyfor == "2")
                return redirect('/rani_laxmi_bai_award');
            if ($req->applyfor == "3")
                return redirect('/position_holder');
            if ($req->applyfor == "4");
        }
    }
    public function profile_detail()
    {
        $user = User::where('id', Auth::id())->first();
        $sport_type = DB::table('sport_type')->where('status', 1)->get();
        $country = DB::table('countries')->get();
        $all_city = DB::table('cities')->where('state_id', '23')->orderBy('city', 'ASC')->get();
        $state = DB::table('states')->orderBy('name', 'ASC')->get();



        return view('user.profile.profile_detail', compact('user', 'country', 'state', 'all_city', 'sport_type'));
    }
    public function position_holder()
    {

        $user = User::where('id', Auth::id())->first();
        if ($user->dob)
            $dob = ((explode('/', $user->dob))[2]);

        $selected_sport = DB::table('sport_welfare_registration_master')->select('sport_type')->where('id', Auth::id())->get()[0]->sport_type;
        $competition = DB::table('position_competition_master')->get();
        $event = DB::table('position_event_master')->get();

        $sport_type = DB::table('sport_type')->where('status', 1)->get();
        return view('user.profile.position_holder', compact('dob', 'sport_type', 'selected_sport', 'user', 'competition', 'event'));
    }

    public function get_position_event(Request $req)
    {
        $comp_id = $req->comp;
        $event_type = $req->event_type;
        $all_event = DB::table('event_competition_map_master as ecmm')
            ->join('position_event_master as pem', 'ecmm.event_id', '=', 'pem.id')
            ->where('ecmm.comp_id', $comp_id)->where('ecmm.event_type', $event_type)->where('ecmm.form_type', $req->type)->orderBy('pem.name', 'ASC')->get();

        if ($all_event->isEmpty()) {
            $all_event = collect([
                (object)[
                    'id' => 0,
                    'name' => 'Other / अन्य'
                ]
            ]);
        }

        return $all_event;
    }

    //rani laxmi bai award
    public function rani_laxmi_bai_award()
    {
        $user = User::where('id', Auth::id())->first();
        $year = date("Y");
        $checkyear = '04/01/' . $year;
        $dob = ((explode('/', $user->dob)));

        $dobb = ($dob[1] . '/' . $dob[0] . '/' . $dob[2]);
        $date1 = new DateTime($dob[1] . '/' . $dob[0] . '/' . $dob[2]);
        $date2 = new DateTime('04/01/' . $year);
        $interval = ($date1->diff($date2))->y;
        //    dd($interval);

        // $dob=((explode('/',$user->dob))[2]);


        // $a=date("Y") - $dob;
        $dob = $dob[2];
        if ($interval < 40) {
            $dob = date("Y") - 3;
            $u_type = "general";
        } else {

            $dob = $dob + 9;
            $u_type = "veteran";
        }

        $sport_competition = DB::table('sport_competition_level_master')->get();
        //    dd($sport_competition);
        $sport_type = DB::table('sport_type')->where('status', 1)->get();
        $selected_sport = DB::table('sport_welfare_registration_master')->select('sport_type')->where('id', Auth::id())->get()[0]->sport_type;

        return view('user.profile.rani_laxmi_bai_award', compact('user', 'sport_competition', 'u_type', 'dob', 'sport_type', 'selected_sport'));
    }
    //end rani laxmi bai award

    //laxman award
    public function laxman_award()
    {


        $user = User::where('id', Auth::id())->first();
        $year = date("Y");
        $checkyear = '04/01/' . $year;
        $dob = ((explode('/', $user->dob)));

        $dobb = ($dob[1] . '/' . $dob[0] . '/' . $dob[2]);
        $date1 = new DateTime($dob[1] . '/' . $dob[0] . '/' . $dob[2]);
        $date2 = new DateTime('04/01/' . $year);
        $interval = ($date1->diff($date2))->y;
        // $dob=((explode('/',$user->dob))[2]);
        $sport_type = DB::table('sport_type')->where('status', 1)->get();
        $selected_sport = DB::table('sport_welfare_registration_master')->select('sport_type')->where('id', Auth::id())->get()[0]->sport_type;
        // $a=date("Y") - $dob;
        // dd((new DateTime('01/01/'.(date("Y") - 3)))->format('Y-m-d H:i:s'));
        $dob = $dob[2];
        if ($interval < 40) {
            $dob = date("Y") - 3;
            $u_type = "general";
            $date2 = (new DateTime('01/01/' . (date("Y") - 3)))->format('Y-m-d H:i:s');
        } else {
            $u_type = "veteran";
            $dob = $dob + 9;
            $date2 = $date1->format('Y-m-d H:i:s');
        }
        $sport_competition = DB::table('sport_competition_level_master')->get();



        return view('user.profile.laxman_award', compact('user', 'date2', 'sport_competition', 'u_type', 'dob', 'sport_type', 'selected_sport'));
    }


    public function save_laxman_award(Request $req)
    {
        return Laxmanaward::preRegistration($req);
    }
    public function save_rani_laxmibai_award(Request $req)
    {
        return Ranilaxmibai::preRegistration($req);
    }

    public function save_position_holder_award(Request $req)
    {

        return PositionHolder::preRegistration($req);
    }
    public function update_laxman_award(Request $req)
    {
        return Laxmanaward::update_laxman_award($req);
    }

    public function update_laxmibai_award(Request $req)
    {
        return Ranilaxmibai::update_laxmibai_award($req);
    }

    public function update_position_holder(Request $req)
    {
        return PositionHolder::update_position_holder($req);
    }

    public function edit_laxman_award(Request $req)
    {

        $user = User::where('id', Auth::id())->first();
        // $dob=((explode('/',$user->dob))[2]);
        $sport_type = DB::table('sport_type')->where('status', 1)->get();
        $laxman_award = DB::table('laxman_award')->select('*')->where('user_id', Auth::id())->where('application_no', $req->id)->get();
        $sport_achievement = DB::table('sport_achievement_master')->select('*')->where('user_id', Auth::id())->where('award_id', 1)->where('application_no', $req->id)->get();

        $selected_sport = DB::table('sport_welfare_registration_master')->select('sport_type')->where('id', Auth::id())->get()[0]->sport_type;

        $other_achievement = DB::table('other_achievement_master')->select('*')->where('user_id', Auth::id())->where('award_id', 1)->where('application_no', $req->id)->get();
        // $a=date("Y") - $dob;

        $year = date("Y");
        $checkyear = '04/01/' . $year;
        $dob = ((explode('/', $user->dob)));

        $dobb = ($dob[1] . '/' . $dob[0] . '/' . $dob[2]);
        $date1 = new DateTime($dob[1] . '/' . $dob[0] . '/' . $dob[2]);
        $date2 = new DateTime('04/01/' . $year);
        $interval = ($date1->diff($date2))->y;
        $dob = $dob[2];
        if ($interval < 40) {
            $dob = date("Y") - 3;
            $u_type = "general";
        } else {
            $dob = $dob + 9;
            $u_type = "veteran";
        }
        $sport_competition = DB::table('sport_competition_level_master')->get();

        return view('user.profile.edit_laxman_award', compact('user', 'sport_competition', 'u_type', 'dob', 'sport_type', 'selected_sport', 'laxman_award', 'other_achievement', 'sport_achievement'));
    }
    public function edit_laxmibai_award(Request $req)
    {

        $user = User::where('id', Auth::id())->first();
        // $dob=((explode('/',$user->dob))[2]);
        $sport_type = DB::table('sport_type')->where('status', 1)->get();
        $laxmi_award = DB::table('ranilaxmibai_award')->select('*')->where('user_id', Auth::id())->where('application_no', $req->id)->get();
        $sport_achievement = DB::table('sport_achievement_master')->select('*')->where('user_id', Auth::id())->where('award_id', 2)->where('application_no', $req->id)->get();
        // dd($sport_achievement);
        $selected_sport = DB::table('sport_welfare_registration_master')->select('sport_type')->where('id', Auth::id())->get()[0]->sport_type;

        $other_achievement = DB::table('other_achievement_master')->select('*')->where('user_id', Auth::id())->where('award_id', 2)->where('application_no', $req->id)->get();
        // $a=date("Y") - $dob;
        $year = date("Y");
        $checkyear = '04/01/' . $year;
        $dob = ((explode('/', $user->dob)));

        $dobb = ($dob[1] . '/' . $dob[0] . '/' . $dob[2]);
        $date1 = new DateTime($dob[1] . '/' . $dob[0] . '/' . $dob[2]);
        $date2 = new DateTime('04/01/' . $year);
        $interval = ($date1->diff($date2))->y;
        $dob = $dob[2];
        if ($interval < 40) {
            $dob = date("Y") - 3;
            $u_type = "general";
        } else {
            $dob = $dob + 9;
            $u_type = "veteran";
        }
        $sport_competition = DB::table('sport_competition_level_master')->get();

        return view('user.profile.edit_laxmibai_award', compact('user', 'sport_competition', 'u_type', 'dob', 'sport_type', 'selected_sport', 'laxmi_award', 'other_achievement', 'sport_achievement'));
    }
    public function finalSubmit_laxman_award(Request $req)
    {





        $table = DB::table('isp_common_detail')->where('user_id', Auth::id())->where('email', Auth::user()->email)->where('type', 'LAXMAN AND RANI LAXMIBAI AWARD')->whereNull('main_table_id')->update(['main_table_id' => $req->id]);

        $isp = isp_common_detail(Auth::id(), Auth::user()->email, 'LAXMAN AND RANI LAXMIBAI AWARD', $req->id);

        if ($isp) {



            $url = env('ISP_URl');

            $secretkey = env('ISP_SECRET_KEY');

            $tokenpassword = env('ISP_TOKEN_PASSWORD');
            $dept_id = env('ISP_DEPT_ID');


            $postData = array(
                "username" =>  $dept_id,
                "password" =>  $tokenpassword
            );



            $response = json_decode(getToken($url . '/ispws/authenticate', json_encode($postData)));

            $token = $response->token;
            $returnServiceStatus = new ReturnServiceStatus();
            $returnServiceStatus->set_applicant_id($isp->applicant_id);
            $returnServiceStatus->set_request_id($isp->request_id);

            $returnServiceStatus->set_service_code($isp->service_code);
            $returnServiceStatus->set_application_id($isp->applicant_id);
            $returnServiceStatus->set_status_code("s104");
            $returnServiceStatus->set_remarks("Application Submitted");
            $returnServiceStatus->set_pendency_level("10");
            $returnServiceStatus->set_action_taken_time(date("Y-m-d h:i:s"));
            $returnServiceStatus->set_pending_with_officer("NA");
            $returnServiceStatus->selected_district_for_processing_application($isp->permanent_district);
            $returnServiceStatus->designated_code("452");
            $returnServiceStatus->designated_location_code(isp_division(Auth::user()->permanent_district));
            $returnServiceStatus->designated_target_date(date('Y-m-d', strtotime("+30 days")));



            $e_data = encryptString(json_encode($returnServiceStatus), $secretkey);

            $finalLoad = array(
                "dept_id" => $dept_id,
                "e_data" => $e_data
            );

            $response = callIspWs($url . '/ispws/isp/v1/returnApplicationAcknowledgement', json_encode($finalLoad), $token);

            $Data_enc = json_decode($response)->data;

            $Data_dsc = json_encode(decryptString($Data_enc, $secretkey));
        };




        if (Auth::user()->registered_from == 2) {

            $check = DB::table('laxman_award')->where('user_id', Auth::id())->first();

            $url = 'http://164.100.181.28/DeptWebIntService/Service.asmx?op=SendResponse';
            $rKey = $check->RequestKey_edistrict;

            $depId = '5EA45F3FA6BD786D7E1024431E03961D';
            $serviceCode = $check->serviceCode_edistrict;
            $application = $check->application_no;
            $main_xml_str = '<?xml version="1.0" encoding="utf-8"?><soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/"><soap:Body><SendResponse xmlns="http://tempuri.org/"><RequestKey>' . $rKey . '</RequestKey><DeptRegistraionID>' . $depId . '</DeptRegistraionID><ApplicationNo>' . $application . '</ApplicationNo><serviceCode>' . $serviceCode . '</serviceCode></SendResponse></soap:Body></soap:Envelope>';

            $call_api = call_curlApi($main_xml_str, $url, 'Response');

            $xmlStr = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $call_api);
            $xml = simplexml_load_string($xmlStr);
            $json = json_encode($xml);

            $array = json_decode($json, TRUE);

            $check = $array['soapBody']['SendResponseResponse']['SendResponseResult'];

            $xmlStr = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $check);
            $xml = simplexml_load_string($xmlStr);
            $json = json_encode($xml);

            $array = json_decode($json, TRUE);

            if ($array['ReturnType'] != 1) {
                session()->flash('error', 'Technical Issue.');
                return;
            }
        };
        StatusChangeLog::dispatch(1, Auth::id(), "", "Form Submitted", "sport_welfare_registration_master");
        // dd($req->court_case);
        $check = DB::table('laxman_award')->where('user_id', Auth::id())->where('application_no', $req->id)->update([
            'dope_test' => $req->dope_test,
            'court_case' => $req->court_case,
            'final_submit' => 1,
            'is_editable' => 2,
        ]);

        if ($check)
            session()->flash('success', 'Successfully Submitted.');
        return $check;
    }

    public function finalSubmit_laxmibai_award(Request $req)
    {




        $table = DB::table('isp_common_detail')->where('user_id', Auth::id())->where('email', Auth::user()->email)->where('type', 'LAXMAN AND RANI LAXMIBAI AWARD')->whereNull('main_table_id')->update(['main_table_id' => $req->id]);

        $isp = isp_common_detail(Auth::id(), Auth::user()->email, 'LAXMAN AND RANI LAXMIBAI AWARD', $req->id);

        if ($isp) {



            $url = env('ISP_URl');

            $secretkey = env('ISP_SECRET_KEY');

            $tokenpassword = env('ISP_TOKEN_PASSWORD');
            $dept_id = env('ISP_DEPT_ID');


            $postData = array(
                "username" =>  $dept_id,
                "password" =>  $tokenpassword
            );



            $response = json_decode(getToken($url . '/ispws/authenticate', json_encode($postData)));

            $token = $response->token;
            $returnServiceStatus = new ReturnServiceStatus();
            $returnServiceStatus->set_applicant_id($isp->applicant_id);
            $returnServiceStatus->set_request_id($isp->request_id);

            $returnServiceStatus->set_service_code($isp->service_code);
            $returnServiceStatus->set_application_id($isp->applicant_id);
            $returnServiceStatus->set_status_code("s104");
            $returnServiceStatus->set_remarks("Application Submitted");
            $returnServiceStatus->set_pendency_level("10");
            $returnServiceStatus->set_action_taken_time(date("Y-m-d h:i:s"));
            $returnServiceStatus->set_pending_with_officer("NA");
            $returnServiceStatus->selected_district_for_processing_application($isp->permanent_district);
            $returnServiceStatus->designated_code("452");
            $returnServiceStatus->designated_location_code(isp_division(Auth::user()->permanent_district));
            $returnServiceStatus->designated_target_date(date('Y-m-d', strtotime("+30 days")));



            $e_data = encryptString(json_encode($returnServiceStatus), $secretkey);

            $finalLoad = array(
                "dept_id" => $dept_id,
                "e_data" => $e_data
            );

            $response = callIspWs($url . '/ispws/isp/v1/returnApplicationAcknowledgement', json_encode($finalLoad), $token);

            $Data_enc = json_decode($response)->data;

            $Data_dsc = json_encode(decryptString($Data_enc, $secretkey));
        };




        if (Auth::user()->registered_from == 2) {

            $check = DB::table('ranilaxmibai_award')->where('user_id', Auth::id())->first();

            $url = 'http://164.100.181.28/DeptWebIntService/Service.asmx?op=SendResponse';
            $rKey = $check->RequestKey_edistrict;

            $depId = '5EA45F3FA6BD786D7E1024431E03961D';
            $serviceCode = $check->serviceCode_edistrict;
            $application = $check->application_no;
            $main_xml_str = '<?xml version="1.0" encoding="utf-8"?><soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/"><soap:Body><SendResponse xmlns="http://tempuri.org/"><RequestKey>' . $rKey . '</RequestKey><DeptRegistraionID>' . $depId . '</DeptRegistraionID><ApplicationNo>' . $application . '</ApplicationNo><serviceCode>' . $serviceCode . '</serviceCode></SendResponse></soap:Body></soap:Envelope>';

            $call_api = call_curlApi($main_xml_str, $url, 'Response');

            $xmlStr = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $call_api);
            $xml = simplexml_load_string($xmlStr);
            $json = json_encode($xml);

            $array = json_decode($json, TRUE);

            $check = $array['soapBody']['SendResponseResponse']['SendResponseResult'];

            $xmlStr = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $check);
            $xml = simplexml_load_string($xmlStr);
            $json = json_encode($xml);

            $array = json_decode($json, TRUE);
            if ($array['ReturnType'] != 1) {
                session()->flash('error', 'Technical Issue.');
                return;
            }
        };

        StatusChangeLog::dispatch(2, Auth::id(), "", "Form Submitted", "sport_welfare_registration_master");
        $check = DB::table('ranilaxmibai_award')->where('user_id', Auth::id())->where('application_no', $req->id)->update([
            'dope_test' => $req->dope_test,
            'court_case' => $req->court_case,
            'final_submit' => 1,
            'is_editable' => 2,
        ]);
        if ($check)
            session()->flash('success', 'Successfully Submitted.');
        return $check;
    }
    //end laxman award


    public function get_city(Request $req)
    {
        $id = $req->value;
        $all_city = DB::table('cities')->where('state_id', $id)->orderBy('city', 'ASC')->get();
        return $all_city;
    }
    public function get_region_sport_office(Request $req)
    {
        $id = $req->value;
        $all_city = DB::table('regional_master')->where('district_id', $id)->orderBy('regional_name', 'ASC')->get();
        return $all_city;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for change the password.
     *
     * @return \Illuminate\Http\Response
     */
    public function changePassword()
    {
        return view('user.profile.changePassword');
    }

    public function compProfile(Request $req)
    {
        // dd($req->all());
        $end = date('d/m/Y', strtotime('-18 years'));
        /// $before = $dt->subYears(18)->format('d-m-y');
        //   dd($req->dob,$end);
        $required = [
            // 'dob'             => 'required|date|date_format:d/m/Y|before:'.$end,
            'place_of_birth'            => 'required',
            'gender'         => 'required',
            "marital_status"       => 'required',
            "nationality"    => 'required',
            // "religion"       => 'required',
            "mother_name" => 'required',
            'father_name'           => 'required',
            'permanent_address'             => 'required',
            // 'permanent_state'          => 'required',
            'permanent_flat_no'           => 'required',
            'permanent_district'           => 'required',
            'present_address'           => 'required',
            'present_state'           => 'required',
            'present_flat_no'           => 'required',
            'present_district'           => 'required',
            'present_pincode'           => 'required|numeric|digits:6',
            'permanent_pincode'           => 'required|numeric|digits:6',
            'aadhar_no'           => 'required|numeric|digits:12',
            'aadhar_card'                 => 'nullable|mimes:pdf,png,jpg,jpeg|max:2000',
            'birth_certificate'                 => 'nullable|mimes:pdf,png,jpg,jpeg|max:2000',
            'photograph'                 => 'nullable|mimes:jpg,jpeg|max:2000',
            'signature'                 => 'nullable|mimes:jpg,jpeg|max:2000',
            'medical_certificate'                 => 'nullable|mimes:pdf,jpg,jpeg|max:2000',
            'physical_condition'            => 'required',
            //new column
            // 'association_certificate'                 => 'required',
            // 'association_certificate_upload'            => 'nullable|mimes:pdf,jpg,jpeg|max:2000',

            'sport_type'            => 'required',
            // 'category'            => 'required',
        ];

        //image
        // if ($req->investor_type == 'Organisation')
        //     $data['gstno'] = 'required|regex:/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/';

        $validation = Validator::make($req->all(), $required, msg());
        //  dd($validation->errors());
        //if ($validation->fails())
        //return redirect('/profile_detail')->withInput($req->all())->with('error', $validation->errors()->first());
        // return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
        //    dd(User::find(Auth::id())->update($req->all())) ;

        if ($req->aadhar_card) {
            $aadhar_card = date('His') . $req->aadhar_card->getClientOriginalName();
            $path = $req->file('aadhar_card')->storeAs('award', $aadhar_card, 'public');
        } else {
            $aadhar_card = $req->aadhar_card1;
        }

        if ($req->birth_certificate) {
            $birth_certificate = date('His') . $req->birth_certificate->getClientOriginalName();
            $path = $req->file('birth_certificate')->storeAs('award', $birth_certificate, 'public');
        } else {
            $birth_certificate = $req->birth_certificate1;
        }


        if ($req->photograph) {
            $photograph = date('His') . $req->photograph->getClientOriginalName();
            $path = $req->file('photograph')->storeAs('award', $photograph, 'public');
        } else {
            $photograph = $req->photograph1;
        }

        if ($req->signature) {
            $signature = date('His') . $req->signature->getClientOriginalName();
            $path = $req->file('signature')->storeAs('award', $signature, 'public');
        } else {
            $signature = $req->signature1;
        }

        if ($req->medical_certificate) {
            $medical_certificate = date('His') . $req->medical_certificate->getClientOriginalName();
            // dd($medical_certificate);
            $path = $req->file('medical_certificate')->storeAs('award', $medical_certificate, 'public');
        } else {
            $medical_certificate = $req->medical_certificate1;
        }

        //new column
        //  if($req->association_certificate_upload){
        //     $association_certificate_upload = $req->association_certificate_upload->getClientOriginalName();
        //     // dd($medical_certificate);
        //     $path = $req->file('association_certificate_upload')->storeAs('award', $association_certificate_upload, 'public');
        // }
        // else{
        //     $association_certificate_upload = $req->association_certificate_upload;
        // }

        $check = DB::table('sport_welfare_registration_master')->where('id', Auth::id())->update([
            // 'user_id' =>Auth::id(),

            'mother_name' => $req->mother_name,
            'father_name' => $req->father_name,
            'sport_type' => $req->sport_type,
            'para_sport' => $req->para_sport,
            // 'category' =>$req->category,
            'dob' => $req->dob,
            'place_of_birth' => $req->place_of_birth,
            'gender' => $req->gender,
            'marital_status' => $req->marital_status,
            'nationality' => $req->nationality,
            // 'religion' =>$req->religion,
            'aadhar_no' => $req->aadhar_no,

            // 'domicile_certificate'      => $req->domicile_certificate->getClientOriginalName(),
            // 'qualification_doc'      => $req->qualification_doc->getClientOriginalName(),
            'aadhar_doc'      => $aadhar_card,
            'birth_certificate'      => $birth_certificate,
            'photograph_doc'      => $photograph,
            'signature_doc'      => $signature,
            // 'guardian_signature'      => $req->guardian_signature->getClientOriginalName(),

            'present_flat_no' => $req->present_flat_no,
            'present_address' => $req->present_address,

            'present_state' => $req->present_state,
            'present_district' => $req->present_district,
            'present_pincode' => $req->present_pincode,
            'permanent_flat_no' => $req->permanent_flat_no,
            'permanent_address' => $req->permanent_address,
            // 'permanent_state' =>$req->permanent_state,
            'permanent_district' => $req->permanent_district,
            'permanent_pincode' => $req->permanent_pincode,
            'is_phy_handicapped'      => $req->physical_condition,
            'phy_handi_docs'      => $medical_certificate,
            //new
            // 'association_certificate'      => $req->association_certificate,
            // 'association_certificate_upload'      => $association_certificate_upload,

            'created_at' =>  date('d/m/Y')
        ]);
        // echo   $check;die;
        // if($check )
        // {
        User::find(Auth::id())->update(array('profile_complete' => 1));
        session()->flash('success', 'Profile Successfully Updated./ प्रोफाइल सफलतापूर्वक अद्यतित हो गई।');
        // return redirect('/applyFor')->with('success', 'Profile Successfully Updated./ प्रोफाइल सफलतापूर्वक अद्यतित हो गई।');
        return redirect('/dashboard')->with('success', 'Profile Successfully Updated./ प्रोफाइल सफलतापूर्वक अद्यतित हो गई।');

        // }
        // else{
        //     session()->flash('error', 'Profile Not Updated.');
        //     return redirect('/profile_detail')->with('error', 'Profile Not Updated.');

        // }
    }


    public function awardDeatils($id)
    {
        if ($id == 1) {
            $table = "laxman_award";
        }

        $articles = DB::table('sport_welfare_registration_master as swrm')
            ->join('laxman_award as la', 'swrm.id', '=', 'la.user_id')
            ->join('sport_type as st', 'la.sport_type', '=', 'st.id')
            ->select(
                'swrm.fullname',
                'swrm.email',
                'swrm.mobile',
                'swrm.gender',
                'st.name as sport_name',
                'swrm.place_of_birth',
                'swrm.dob',
                'swrm.nationality',
                'la.qualification',
                'la.qualification_doc',
                'la.domicile_certificate',
                'la.monthly_income_personal',
                'la.application_no',
                'la.income_certificate',
                'la.dmc_income_verification',
                'la.level_of_report',
                'la.relevant_certificate',
                'la.other_achievements',
                'la.document_other_achievements',
                'la.document_justifying_achievements',
                'la.total_professional_experience',
                'la.amount_release',
                'la.amount_release_status',
                'la.form_status',
                'la.experience_sports_association',
                'la.document_justifying_experience',
                'la.income_other_sources',
                'la.income_document_other_sources',
                'la.is_editable',
                'la.details_of_assistance_benefits',
                'la.relevant_documents_justifing_assistance',
                'la.physical_condition',
                'la.medical_certificate',
                'la.dope_test',
                'la.court_case',
                'la.final_submit',
                'la.guardian_signature',
                'la.bank_name',
                'la.bank_branch',
                'la.bank_acc_no',
                'la.bank_ifsc',
                'la.acc_holder_name',
                'la.pan',
                'la.mobile_registered_in_bank',
                'la.other_relevant_information_applicant',
                'la.created_at',
                'swrm.marital_status',
                'swrm.religion',
                'swrm.aadhar_no',
                'swrm.father_name',
                'swrm.mother_name',
                'swrm.present_address',
                'swrm.present_state',
                'swrm.present_district',
                'swrm.present_pincode',
                'swrm.permanent_address',
                'swrm.permanent_state',
                'swrm.permanent_district',
                'swrm.permanent_pincode'
            )
            ->where('swrm.id', Auth::id())
            ->get();
        // dd($articles);
        $sport_achievement = DB::table('sport_achievement_master')
            ->join('sport_competition_level_master as sclm', 'sport_achievement_master.sport_achievement', '=', 'sclm.id')
            ->select('sport_achievement_master.*,sclm.name')
            ->where('sport_achievement_master.user_id', Auth::id())
            ->get();
        //  dd($sport_achievement);
        $user = User::where('id', Auth::id())->first();


        return view('user.profile.preview_laxman_award_form', compact('user', 'articles', 'sport_achievement'));
    }
    public function laxmandetailForm($appNo)
    {

        $articles = DB::table('sport_welfare_registration_master as swrm')
            ->join('laxman_award as la', 'swrm.id', '=', 'la.user_id')
            ->leftJoin('sport_type as st', 'la.sport_type', '=', 'st.id')
            ->select(
                'swrm.fullname',
                'swrm.email',
                'swrm.mobile',
                'swrm.gender',
                'swrm.association_certificate',
                'swrm.association_certificate_upload',
                'st.name as sport_name',
                'swrm.place_of_birth',
                'swrm.dob',
                'swrm.nationality',
                'la.highschool_certificate',
                'la.qualification',
                'la.qualification_doc',
                'la.domicile_certificate',
                'la.monthly_income_personal',
                'la.income_certificate',
                'la.dmc_income_verification',
                'la.level_of_report',
                'la.relevant_certificate',
                'la.notary_affidavit_doc',
                'la.application_no',
                'la.other_achievements',
                'la.document_other_achievements',
                'la.document_justifying_achievements',
                'la.total_professional_experience',
                'la.is_editable',
                'la.amount_release',
                'la.amount_release_status',
                'la.experience_sports_association',
                'la.document_justifying_experience',
                'la.income_other_sources',
                'la.income_document_other_sources',
                'la.form_status',
                'la.details_of_assistance_benefits',
                'la.relevant_documents_justifing_assistance',
                'la.physical_condition',
                'la.medical_certificate',
                'la.player_type',
                'la.dope_test',
                'la.court_case',
                'la.final_submit',
                'la.guardian_signature',
                'la.bank_name',
                'la.bank_branch',
                'la.bank_acc_no',
                'la.bank_ifsc',
                'la.acc_holder_name',
                'la.pan',
                'la.mobile_registered_in_bank',
                'la.other_relevant_information_applicant',
                'la.created_at',
                'swrm.signature_doc',
                'swrm.photograph_doc',
                'swrm.marital_status',
                'swrm.religion',
                'swrm.aadhar_no',
                'swrm.father_name',
                'swrm.mother_name',
                'swrm.present_address',
                'swrm.present_state',
                'swrm.present_district',
                'swrm.present_pincode',
                'swrm.permanent_address',
                'swrm.permanent_state',
                'swrm.permanent_district',
                'swrm.permanent_pincode',
                'swrm.present_flat_no',
                'swrm.permanent_flat_no'
            )
            ->where('swrm.id', Auth::id())
            ->where('la.application_no', $appNo)
            ->get();
        // dd($articles);

        // $sport_achievement =DB::table('sport_achievement_master')
        //             ->select('*')
        //             ->where('user_id', Auth::id())
        //             ->where('award_id', 1)
        //             ->get();
        $sport_achievement = DB::table('sport_achievement_master')
            ->join('sport_competition_level_master as sclm', 'sport_achievement_master.sport_achievement', '=', 'sclm.id')
            ->select('sport_achievement_master.*', 'sclm.name')
            ->where('sport_achievement_master.user_id', Auth::id())
            ->where('sport_achievement_master.award_id', 1)
            ->where('sport_achievement_master.application_no', $appNo)
            ->get();
        $other_achievement = DB::table('other_achievement_master')
            ->select('*')
            ->where('user_id', Auth::id())
            ->where('award_id', 1)
            ->where('other_achievement_master.application_no', $appNo)
            ->get();

        $userId = Auth::id();
        $user = User::where('id', $userId)->first();
        $queryData = DB::table('query_master')->where('form_type', 1)->where('application_no', $appNo)->where('user_id', $userId)->orderBy('id', 'DESC')->get();
        return view('user.profile.preview_laxman_award_form', compact('user', 'articles', 'sport_achievement', 'other_achievement', 'queryData'));
    }

    public function laxmibaidetailForm($appNo)
    {


        $articles = DB::table('sport_welfare_registration_master as swrm')
            ->join('ranilaxmibai_award as la', 'swrm.id', '=', 'la.user_id')
            ->join('sport_type as st', 'la.sport_type', '=', 'st.id')
            ->select(
                'swrm.fullname',
                'swrm.email',
                'swrm.mobile',
                'swrm.gender',
                'swrm.association_certificate',
                'swrm.association_certificate_upload',
                'st.name as sport_name',
                'swrm.place_of_birth',
                'swrm.dob',
                'swrm.nationality',
                'la.highschool_certificate',
                'la.qualification',
                'la.qualification_doc',
                'la.domicile_certificate',
                'la.monthly_income_personal',
                'la.income_certificate',
                'la.dmc_income_verification',
                'la.level_of_report',
                'la.relevant_certificate',
                'la.is_editable',
                'la.amount_release',
                'la.amount_release_status',
                'la.other_achievements',
                'la.document_other_achievements',
                'la.document_justifying_achievements',
                'la.total_professional_experience',
                'la.form_status',
                'la.application_no',
                'la.experience_sports_association',
                'la.document_justifying_experience',
                'la.income_other_sources',
                'la.income_document_other_sources',
                'la.details_of_assistance_benefits',
                'la.relevant_documents_justifing_assistance',
                'la.physical_condition',
                'la.medical_certificate',
                'la.notary_affidavit_doc',
                'la.player_type',
                'la.dope_test',
                'la.court_case',
                'la.final_submit',
                'la.guardian_signature',
                'la.bank_name',
                'la.bank_branch',
                'la.bank_acc_no',
                'la.bank_ifsc',
                'la.acc_holder_name',
                'la.pan',
                'la.mobile_registered_in_bank',
                'la.other_relevant_information_applicant',
                'la.created_at',
                'swrm.signature_doc',
                'swrm.photograph_doc',
                'swrm.marital_status',
                'swrm.religion',
                'swrm.aadhar_no',
                'swrm.father_name',
                'swrm.mother_name',
                'swrm.present_address',
                'swrm.present_state',
                'swrm.present_district',
                'swrm.present_pincode',
                'swrm.permanent_address',
                'swrm.permanent_state',
                'swrm.permanent_district',
                'swrm.permanent_pincode',
                'swrm.present_flat_no',
                'swrm.permanent_flat_no'
            )
            ->where('swrm.id', Auth::id())
            ->where('la.application_no', $appNo)
            ->get();

        $sport_achievement = DB::table('sport_achievement_master')
            ->join('sport_competition_level_master as sclm', 'sport_achievement_master.sport_achievement', '=', 'sclm.id')
            ->select('sport_achievement_master.*', 'sclm.name')
            ->where('user_id', Auth::id())
            ->where('sport_achievement_master.application_no', $appNo)
            ->where('award_id', 2)
            ->get();
        $other_achievement = DB::table('other_achievement_master')
            ->select('*')
            ->where('user_id', Auth::id())
            ->where('other_achievement_master.application_no', $appNo)
            ->where('award_id', 2)
            ->get();

        $userId = Auth::id();
        $user = User::where('id', $userId)->first();
        $queryData = DB::table('query_master')->where('form_type', 2)->where('user_id', $userId)->orderBy('id', 'DESC')->get();

        return view('user.profile.preview_laxmibai_award_form', compact('user', 'articles', 'sport_achievement', 'other_achievement', 'queryData'));
    }

    public function positiondetailForm($appNo)
    {


        $articles = DB::table('sport_welfare_registration_master as swrm')
            ->join('position_holder as la', 'swrm.id', '=', 'la.user_id')
            ->join('sport_type as st', 'la.sport_type', '=', 'st.id')
            ->select(
                'swrm.fullname',
                'swrm.email',
                'swrm.mobile',
                'swrm.gender',
                'st.name as sport_name',
                'swrm.place_of_birth',
                'swrm.dob',
                'swrm.nationality',
                'swrm.association_certificate',
                'swrm.association_certificate_upload',
                'la.application_no',
                'la.is_editable',
                'la.form_status',
                'la.award_certificate_affidavit',
                'la.event_type',
                'la.qualification',
                'la.qualification_doc',
                'la.domicile_certificate',
                'la.bank_name',
                'la.bank_branch',
                'la.bank_acc_no',
                'la.bank_ifsc',
                'la.acc_holder_name',
                'la.mobile_registered_in_bank',
                'la.created_at',
                'la.amount_release',
                'la.amount_release_status',
                'la.final_submit',
                'la.competition_type',
                'la.competition_name',
                'la.venue_name',
                'la.competition_from_date',
                'la.competition_to_date',
                'la.earned_achievement',
                'la.award_certificate',
                'la.pan_doc',
                'la.sport_certificate',
                'la.passbook_doc',
                'swrm.signature_doc',
                'swrm.photograph_doc',
                'swrm.marital_status',
                'swrm.religion',
                'swrm.aadhar_no',
                'swrm.father_name',
                'swrm.mother_name',
                'swrm.present_address',
                'swrm.present_state',
                'swrm.present_district',
                'swrm.present_pincode',
                'swrm.permanent_address',
                'swrm.permanent_state',
                'swrm.permanent_district',
                'swrm.permanent_pincode',
                'swrm.present_flat_no',
                'swrm.permanent_flat_no'
            )
            ->where('swrm.id', Auth::id())
            ->where('la.application_no', $appNo)
            ->get();
        $competition_award_docs = DB::table('position_holder_competition_docs as phcd')
            ->join('position_event_master as pem', 'phcd.event_name', '=', 'pem.id')
            ->join('position_competition_master as pcm', 'phcd.competition_name', '=', 'pcm.id')
            ->select('phcd.*', 'pcm.name as comp', 'pem.name as event')
            ->where('phcd.application_no', $appNo)
            ->where('phcd.user_id', Auth::id())
            ->get();




        // dd($competition_award_docs);

        $userId = Auth::id();
        $user = User::where('id', $userId)->first();
        $queryData = DB::table('query_master')->where('form_type', 3)->where('application_no', $appNo)->where('user_id', $userId)->orderBy('id', 'DESC')->get();
        return view('user.profile.preview_position_holder_form', compact('competition_award_docs', 'user', 'articles', 'queryData'));
    }

    public function edit_position_holder(Request $req)
    {
        $user = User::where('id', Auth::id())->first();
        $dob = ((explode('/', $user->dob))[2]);
        $sport_type = DB::table('sport_type')->where('status', 1)->get();
        $position_holder = DB::table('position_holder')->select('*')->where('user_id', Auth::id())->where('application_no', $req->id)->get();
        // $sport_achievement =DB::table('sport_achievement_master')->select('*')->where('user_id', Auth::id())->where('award_id', 2)->get();
        // dd($sport_achievement);
        $selected_sport = DB::table('sport_welfare_registration_master')->select('sport_type')->where('id', Auth::id())->get()[0]->sport_type;
        $competition_award_docs = DB::table('position_holder_competition_docs')
            ->select('*')
            ->where('user_id', Auth::id())
            ->where('application_no', $req->id)
            ->get();
        // dd($competition_award_docs);
        $competition = DB::table('position_competition_master')->get();
        $event = DB::table('position_event_master')->get();
        // $other_achievement =DB::table('other_achievement_master')->select('*')->where('user_id', Auth::id())->where('award_id', 2)->get();
        return view('user.profile.edit_position_holder', compact('competition', 'event', 'competition_award_docs', 'dob', 'sport_type', 'selected_sport', 'position_holder', 'user'));
    }

    public function finalSubmit_position_holder(Request $req)
    {

        $table = DB::table('isp_common_detail')->where('user_id', Auth::id())->where('email', Auth::user()->email)->where('type', 'PRIZE MONEY')->whereNull('main_table_id')->update(['main_table_id' => $req->id]);

        $isp = isp_common_detail(Auth::id(), Auth::user()->email, 'PRIZE MONEY', $req->id);

        if ($isp) {



            $url = env('ISP_URl');

            $secretkey = env('ISP_SECRET_KEY');

            $tokenpassword = env('ISP_TOKEN_PASSWORD');
            $dept_id = env('ISP_DEPT_ID');


            $postData = array(
                "username" =>  $dept_id,
                "password" =>  $tokenpassword
            );



            $response = json_decode(getToken($url . '/ispws/authenticate', json_encode($postData)));

            $token = $response->token;
            $returnServiceStatus = new ReturnServiceStatus();
            $returnServiceStatus->set_applicant_id($isp->applicant_id);
            $returnServiceStatus->set_request_id($isp->request_id);

            $returnServiceStatus->set_service_code($isp->service_code);
            $returnServiceStatus->set_application_id($isp->applicant_id);
            $returnServiceStatus->set_status_code("s104");
            $returnServiceStatus->set_remarks("Application Submitted");
            $returnServiceStatus->set_pendency_level("10");
            $returnServiceStatus->set_action_taken_time(date("Y-m-d h:i:s"));
            $returnServiceStatus->set_pending_with_officer("NA");
            $returnServiceStatus->selected_district_for_processing_application($isp->permanent_district);
            $returnServiceStatus->designated_code("452");
            $returnServiceStatus->designated_location_code(isp_division(Auth::user()->permanent_district));
            $returnServiceStatus->designated_target_date(date('Y-m-d', strtotime("+30 days")));



            $e_data = encryptString(json_encode($returnServiceStatus), $secretkey);

            $finalLoad = array(
                "dept_id" => $dept_id,
                "e_data" => $e_data
            );

            $response = callIspWs($url . '/ispws/isp/v1/returnApplicationAcknowledgement', json_encode($finalLoad), $token);

            $Data_enc = json_decode($response)->data;

            $Data_dsc = json_encode(decryptString($Data_enc, $secretkey));
        };


        if (Auth::user()->registered_from == 2) {

            $check = DB::table('position_holder')->where('user_id', Auth::id())->first();

            $url = 'http://164.100.181.28/DeptWebIntService/Service.asmx?op=SendResponse';
            $rKey = $check->RequestKey_edistrict;

            $depId = '5EA45F3FA6BD786D7E1024431E03961D';
            $serviceCode = $check->serviceCode_edistrict;
            $application = $check->application_no;
            $main_xml_str = '<?xml version="1.0" encoding="utf-8"?><soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/"><soap:Body><SendResponse xmlns="http://tempuri.org/"><RequestKey>' . $rKey . '</RequestKey><DeptRegistraionID>' . $depId . '</DeptRegistraionID><ApplicationNo>' . $application . '</ApplicationNo><serviceCode>' . $serviceCode . '</serviceCode></SendResponse></soap:Body></soap:Envelope>';

            $call_api = call_curlApi($main_xml_str, $url, 'Response');

            $xmlStr = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $call_api);
            $xml = simplexml_load_string($xmlStr);
            $json = json_encode($xml);

            $array = json_decode($json, TRUE);

            $check = $array['soapBody']['SendResponseResponse']['SendResponseResult'];

            $xmlStr = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $check);
            $xml = simplexml_load_string($xmlStr);
            $json = json_encode($xml);

            $array = json_decode($json, TRUE);
            if ($array['ReturnType'] != 1) {
                session()->flash('error', 'Technical Issue.');
                return;
            }
        };
        // dd(+$req->id);
        StatusChangeLog::dispatch(3, Auth::id(), "", "Form Submitted", "sport_welfare_registration_master");
        $check = DB::table('position_holder')->where('user_id', Auth::id())->where('application_no', $req->id)->update([

            'final_submit' => 1,
            'is_editable' => 2,
        ]);
        if ($check)
            session()->flash('success', 'Successfully Submitted.');
        return $check;
    }
}



class ISPApplicantData
{

    public $request_id;
    public  $dept_id;
}

class ISPRequestData
{

    public  $dept_id;
    public  $e_data;
}

class ISPRequestedDataResponse
{

    public  $error;
    public  $statusMessage;
    public  $data;
    public  $timestamp;

    public function set_data($data)
    {
        $this->data = $data;
    }
    public function get_data()
    {
        return $this->data;
    }

    public function set_error($error)
    {
        $this->error = $error;
    }
    public function get_error()
    {
        return $this->error;
    }

    public function set_statusMessage($statusMessage)
    {
        $this->statusMessage = $statusMessage;
    }
    public function get_statusMessage()
    {
        return $this->statusMessage;
    }

    public function set_timestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    }
    public function get_timestamp()
    {
        return $this->timestamp;
    }
}

class ISPRequestIdData
{

    public  $request_id;
    public  $applicant_id;
    public  $service_code;
    public  $request_validated;

    public function set_request_id($request_id)
    {
        $this->request_id = $request_id;
    }
    public function get_request_id()
    {
        return $this->request_id;
    }

    public function set_applicant_id($applicant_id)
    {
        $this->applicant_id = $applicant_id;
    }
    public function get_applicant_id()
    {
        return $this->applicant_id;
    }

    public function set_service_code($service_code)
    {
        $this->service_code = $service_code;
    }
    public function get_service_code()
    {
        return $this->service_code;
    }
}

class ISPRequestValidate
{

    public  $sessionkey;
    public  $dept_id;
}

class ISPResponseApplicantData
{

    public  $applicant_id;
    public  $first_name_eng;
    public  $middle_name_eng;
    public  $ast_name_eng;
    public  $first_name_hindi;
    public  $middle_name_hindi;
    public $gender;
    public $father_or_husband_or_guardian_name_eng;
    public $father_or_husband_or_guardian_name_hindi;
    public $mother_name_eng;
    public $mother_name_hindi;
    public $category;
    public $dob;
    public $pan_no;
    public $mobile;
    public $email;
    public $residential_house_no;
    public $residential_mohalla;
    public $residential_state;
    public $residential_post_office;
    public $residential_district;
    public $residential_tehsil;
    public $residential_police_station;
    public $residential_pin;
    public $permanent_house_no;
    public $permanent_mohalla;
    public $permanent_state;
    public $permanent_post_office;
    public $permanent_district;
    public $permanent_tehsil;
    public $permanent_police_station;
    public $permanent_pin;
    public $service_name_eng;
    public $service_name_hindi;
    public $service_code;
    public $family_id;
    public $member_id;
}

class ReturnServiceStatus
{

    public $request_id;
    public $applicant_id;
    public $service_code;
    public $application_id;
    public $status_code;
    public $remarks;
    public $pendency_level;
    public $action_taken_time;
    public $pending_with_officer;
    public $d1;
    public $d2;
    public $d3;
    public $d4;
    public $d5;
    public $d6;
    public $d7;
    public $d8;
    public $d9;
    public $d10;
    public $d11;
    public $d12;
    public $d13;
    public $d14;
    public $d15;
    public $d16;
    public $d17;
    public $d18;
    public $d19;
    public $d20;

    public $selected_district_for_processing_application;

    public $designated_code;

    public $designated_location_code;

    public $designated_target_date;



    public function designated_code($designated_code)
    {
        $this->designated_code = $designated_code;
    }

    public function designated_location_code($designated_location_code)
    {
        $this->designated_location_code = $designated_location_code;
    }


    public function designated_target_date($designated_target_date)
    {
        $this->designated_target_date = $designated_target_date;
    }


    public function set_request_id($request_id)
    {
        $this->request_id = $request_id;
    }
    public function getRequest_id()
    {
        return $this->request_id;
    }

    public function set_applicant_id($applicant_id)
    {
        $this->applicant_id = $applicant_id;
    }
    function get_applicant_id()
    {
        return $this->applicant_id;
    }

    public function set_service_code($service_code)
    {
        $this->service_code = $service_code;
    }
    public function get_service_code()
    {
        return $this->service_code;
    }

    public function set_application_id($application_id)
    {
        $this->application_id = $application_id;
    }
    public function get_application_id()
    {
        return $this->application_id;
    }

    public function set_status_code($status_code)
    {
        $this->status_code = $status_code;
    }
    public function get_status_code()
    {
        return $this->status_code;
    }

    public function set_remarks($remarks)
    {
        $this->remarks = $remarks;
    }
    public function get_remarks()
    {
        return $this->remarks;
    }

    public function set_pendency_level($pendency_level)
    {
        $this->pendency_level = $pendency_level;
    }
    public function get_pendency_level()
    {
        return $this->pendency_level;
    }

    public function set_action_taken_time($action_taken_time)
    {
        $this->action_taken_time = $action_taken_time;
    }
    public function get_action_taken_time()
    {
        return $this->action_taken_time;
    }

    public function set_pending_with_officer($pending_with_officer)
    {
        $this->pending_with_officer = $pending_with_officer;
    }

    public function selected_district_for_processing_application($selected_district_for_processing_application)
    {
        $this->selected_district_for_processing_application = $selected_district_for_processing_application;
    }
}

class ISPToken
{

    public $username;
    public $password;
}

class ISPTokenResponse
{

    public $token;
    public $error;
    public $statusMessage;
    public $timestamp;

    public function set_token($token)
    {
        $this->token = $token;
    }
    public function get_token()
    {
        return $this->token;
    }

    public function set_error($error)
    {
        $this->error = $error;
    }
    public function get_error()
    {
        return $this->error;
    }

    public function set_statusMessage($statusMessage)
    {
        $this->statusMessage = $statusMessage;
    }
    public function get_statusMessage()
    {
        return $this->statusMessage;
    }

    public function set_timestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    }
    public function get_timestamp()
    {
        return $this->timestamp;
    }
}
