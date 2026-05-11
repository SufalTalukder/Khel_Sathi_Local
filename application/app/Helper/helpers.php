<?php

use App\Models\HostelRegister;
use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Route;
//use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

function set($param)
{
    session()->put('header', $param);
}

function get()
{
    return  session()->get('header');
}


function sets($type)
{
    session()->put('type', $type);
}

function gets()
{
    return  session()->get('type');
}

function msg()
{
    return [

        'email.required'    => 'Please Enter Email ID./कृपया ईमेल आईडी भरें।',
        'email.email'       => 'Please Enter Valid Email ID./कृपया सही ईमेल आईडी भरें।',
        'password.required' => 'Please Enter Password.',
        'captcha.required'  => 'Please Enter Captcha Code.',
        'rolename'          => 'Please Enter Role Name.',
        'legalstatus'       => 'Please Choose Status.',
        'name'              => 'Please Enter Name.',
        'mobile.required'   => 'Please Enter Mobile No./कृपया मोबाइल नंबर भरें।',
        'mobile.numeric'    => 'Mobile No. must be of 10 digits./मोबाइल नंबर 10 अंकों का होना चाहिए।',
        'mobile.digits'     => 'Please Enter Valid Mobile No.',
        'ocfname.required'  => 'Please Enter Organisation/Company/Firm Name.',
        'onrname.required'  => 'Please Enter Owner’s Name.',

        'sector_name.required'      => 'Please Enter Sector Name.',
        'department.required'       => 'Please Enter Department Name.',
        'department_code.required'  => 'Please Enter Department Code.',

        'otp1'        => 'Please Enter OTP 1 letter',
        'otp2'        => 'Please Enter OTP 2 letter',
        'otp3'        => 'Please Enter OTP 3 letter',
        'otp4'        => 'Please Enter OTP 4 letter',
        'otp5'        => 'Please Enter OTP 5 letter',
        'otp6'        => 'Please Enter OTP 6 letter',

        'authorized_person' => 'Enter Authorized Person Name.',
        'approval_of_park'  => 'Please Select Approval of Park',
        'sanction_number'   => 'Please Enter Sanction Number',
        'sanction_date'     => 'Please Enter Sanction Date',
        'sanction_capacity' => 'Please Enter Sanction Capacity',
        'sub_station'       => 'Please Enter Sub Station',
        'voltage'           => 'Please Enter voltage',
        'area_of_land.required' => 'Please Enter Proposed Area of Land',
        'area_of_land.numeric'  => 'Please Enter Valid Proposed Area of Land',
        'preference_first'      => 'Please Select Preference 1.',
        'preference_second'     => 'Please Select Preference 2.',
        'preference_third'      => 'Please Select Preference 3.',



        'dob.required'      => 'Please Select Date of Birth./कृपया जन्मतिथि का चयन करें।',
        'gender.required'      => 'Please Select Gender./कृपया लिंग का चयन करें।',
        'nationality.required'      => 'Please Select Nationality./कृपया राष्ट्रीयता का चयन करें।',
        'marital_status.required'      => 'Please Select Marital Status./कृपया वैवाहिक स्थिति का चयन करें।    ',
        'religion.required'      => 'Please Select Religion./कृपया धर्म का चयन करें।',
        'sport_type.required'      => 'Please Answer which Sport did/do you play./कृपया उत्तर दें कि आप कौन सा खेल खेलते थे/हैं।',
        'category.required'      => 'Please Select Category./कृपया श्रेणी का चयन करें।',
        'physical_condition.required'      => 'Please Answer is Applicant Physically Challenged?/कृपया उत्तर दें कि क्या आवेदक शारीरिक रूप से अक्षम है?',
        'present_state.required'      => 'Please Select State./कृपया राज्य का चयन करें।',
        'present_district.required'      => 'Please Select District./कृपया जनपद का चयन करें।',
        'place_of_birth.required'      => 'Please Enter Place of Birth./कृपया जन्म स्थल का नाम भरें।',
        'mother_name.required'      => 'Please Enter Mother’s Name./कृपया माता का नाम भरें।',
        'father_name.required'      => 'Please Enter Father’s Name./कृपया पिता का नाम भरें।',
        'aadhar_no.required'      => 'Please Enter Aadhaar No./कृपया आधार नंबर भरें।',
        'present_address.required'      => 'Please Enter Address./कृपया पता भरें।',
        'permanent_address.required'      => 'Please Enter Address./कृपया पता भरें।',
        'present_pincode.required'      => 'Please Enter PIN Code./कृपया पिन कोड भरें।',
        'permanent_pincode.required'      => 'Please Enter PIN Code./कृपया पिन कोड भरें।',
        'aadhar_no.required'      => 'Aadhaar No. must be of 12 digits./आधार नंबर 12 अंकों का होना चाहिए।',
        // 'permanent_address.required'      => 'PIN Code must be of 06 digits./पिन कोड 06 अंकों का होना चाहिए।',
        // 'aadhar_card.required'      => 'Please Upload File in Valid Format./कृपया सही प्रारूप में फाइल अपलोड करें।',
        // 'permanent_address.required'      => 'File size should not exceed the maximum size mentioned./फाइल का अधिकतम साइज़ निर्धारित साइज़ से ज्यादा नहीं होना चाहिए।',
        'aadhar_card.required'      => 'Please Upload Aadhaar Card./कृपया आधार कार्ड अपलोड करें।',
        'medical_certificate.required'      => 'Please Upload Medical Certificate./कृपया चिकित्सा प्रमाणपत्र अपलोड करें।',
        'photograph.required'      => 'Please Upload Photograph./कृपया फोटो अपलोड करें।',
        'signature.required'      => 'Please Upload Signature./कृपया हस्ताक्षर अपलोड करें।',
        // 'permanent_address.required'      => 'Invalid Date of Birth. Please Enter Correct Date./अमान्य जन्मतिथि। कृपया सही तिथि भरें।',


    ];
}

function roleName($id)
{
    $table = DB::table('urm_role_manager')->where('id', $id);
    if ($table->exists())
        return $table->first()->role_name;

    return 'Admin';
}

function moveFile($path, $files)
{
    $name = date('His') . $files->getClientOriginalName();
    $files->move(public_path($path), $name);
    return $name;
}

function dateFormate($ArrTime)
{
    return date("Y-m-d", strtotime($ArrTime));
}

function dmy($ArrTime)
{
    if (empty($ArrTime) || $ArrTime == '0000-00-00' || $ArrTime == '0000-00-00 00:00:00' || strtotime($ArrTime) <= 0) {
        return "N/A";
    }
    return date("d-m-Y", strtotime($ArrTime));
}

function dmyHi($ArrTime)
{
    return date("d-m-Y H:i A", strtotime($ArrTime));
}
function dmyHis($ArrTime)
{
    return date("d/m/Y H:i:s", strtotime($ArrTime));
}
function ymd($ArrTime)
{
    return date("Y-m-d", strtotime($ArrTime));
}

function my($ArrTime)
{
    return date("Y-m-d", strtotime($ArrTime));
}
function users($id)
{
    return DB::table('users')->where('id', $id)->first();
}

function usersNon($id)
{
    return DB::table('unregistered_user')->where('id', $id)->first();
}



function checkRoute()
{
    // $routes = Route::getRoutes()->getRoutes();
    // $route = Route::currentRouteName();
    // $uri = request()->getRequestUri();
    // foreach ($routes as $r) {
    //     $id = $r->uri();
    //     if ($id == $route || $uri == '/' . $id) {
    //         return true;
    //     }
    // }
    return false;
}

function _smsApiCall($requestMobile, $message, $tempid = null)
{
    $params = [
        'User'         => 'Vareli',
        'passwd'       => 'Vtpl@1234',
        'mobilenumber' => $requestMobile,
        'message'      => $message,
        'sid'          => 'KHELSA',
        'mtype'        => 'N',
        'DR'           => 'Y',
    ];
    if ($tempid) {
        $params['tempid'] = $tempid;
    }
    $url = 'http://api.smscountry.com/SMSCwebservice_bulk.aspx?' . http_build_query($params);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    $result   = curl_exec($ch);
    $curlErr  = curl_error($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    \Illuminate\Support\Facades\Log::info('SMS_API', [
        'mobile'    => $requestMobile,
        'http_code' => $httpCode,
        'response'  => $result,
        'curl_err'  => $curlErr ?: null,
    ]);

    return ($httpCode == 200) ? 1 : 0;
}

function SendSMS($requestMobile, $message)
{
    // DLT template ID: 1407177303297096963 (Khel Sathi OTP, sender KHELSA)
    return _smsApiCall($requestMobile, $message, '1407177303297096963');
}













function SendPassword($requestMobile, $message)
{
    // TODO: add tempid once Vareli provides DLT template ID for password-change messages
    return _smsApiCall($requestMobile, $message);
}

function forgotpassword($requestMobile, $message)
{
    // TODO: add tempid once Vareli provides DLT template ID for forgot-password messages
    return _smsApiCall($requestMobile, $message);
}

function SendLoginCredential($requestMobile, $message)
{
    // TODO: replace tempid with DLT-registered template ID for login-credential messages
    return _smsApiCall($requestMobile, $message, '1607100000000032462');
}

function loginCredential($requestMobile, $message)
{
    // TODO: add tempid once Vareli provides DLT template ID for credentials messages
    return _smsApiCall($requestMobile, $message);
}

function tables()
{
    return  session()->get('tables');
}

function showPages($data, $table)
{
    session()->put('tables', $table);

    $total = $data->total();
    $to = $data->lastItem();
    $crnPage = $data->currentPage();
    $per_page = $data->perPage();
    if ($to >= $per_page)
        $crnPage = $to - $per_page;

    $per_page = $per_page + 1;

    // return "Showing $crnPage  to $to of $total entries";
    return "Showing  $to of $total entries";
}

// function getProjectId()
// {
//     if (DB::table('user_project_summary')->exists()) {
//         $projectId = DB::table('user_project_summary')->orderBy('id', 'DESC')->limit(1)->first()->project_id;
//         return  preg_replace('/[^a-zA-Z]/', '', $projectId) . '00' . (preg_replace('/[^0-9]/', '', $projectId) + 1);
//     }
//     return 'SG001';
// }

// function getPreferenceStation($type, $id)
// {

//     $first =   $second =  $third =  $first1 =   $second1 =  $third1 = '';

//     if ($type == 'SG001') {
//         $items = DB::table('power_project_ppa')->where('summary_id', $id)->first();
//     } elseif ($type == 'SG003') {
//         $items = DB::table('power_solar_public_park')->where('summary_id', $id)->first();
//     } elseif ($type == 'SG004') {
//         $items = DB::table('power_solar_private_park')->where('summary_id', $id)->first();
//     } elseif ($type == 'SG002') {
//         $items = DB::table('power_project_openaccess')->where('summary_id', $id)->first();
//     } elseif ($type == 'SG009') {
//         $items = DB::table('power_project_other')->where('summary_id', $id)->first();
//     }

//     if (isset($items->preference_first_substation))
//         $first = $items->preference_first_substation;

//     if (isset($items->preference_second_substation))
//         $second = $items->preference_second_substation;

//     if (isset($items->preference_third_substation))
//         $third = $items->preference_third_substation;

//     if (isset($items->preference_first))
//         $first = $items->preference_first;

//     if (isset($items->preference_second))
//         $second = $items->preference_second;

//     if (isset($items->preference_third))
//         $third = $items->preference_third;

//     $first = DB::table('cities')->select('city')->where('id', $first)->first();
//     $second = DB::table('cities')->select('city')->where('id', $second)->first();
//     $third = DB::table('cities')->select('city')->where('id', $third)->first();

//     if (isset($first->city))
//         $first1 = $first->city . ' ,';

//     if (isset($second->city))
//         $second1 = $second->city . ' ,';

//     if (isset($third->city))
//         $third1 = $third->city . ' ,';

//     return $first1 . "<br>" . $second1 . "<br>" . $third1;
// }

function stateName($id)
{
    $table = DB::table('states')->where('id', $id);
    if ($table->exists())
        return repairHindi($table->first()->name);

}

function districtName($id)
{
    $table = DB::table('cities')->where('id', $id);
    if ($table->exists())
        return repairHindi($table->first()->city);

}
function tehsiltName($id)
{
    $table = DB::table('tehsil_master')->where('id', $id);
    if ($table->exists())
        return repairHindi($table->first()->Tehsil_Name);

}

function swimming_service($id){
    $table = DB::table('swimming_master')->where('district_id', $id);
    if ($table->exists())

        return $table->first()->swimming_name;
}

function gymnasium_services($id){
    $table = DB::table('gymnasium_master')->where('district_id', $id);
    if ($table->exists())

        return $table->first()->gymnasium_name;
}


function eklavyaName($id)
{
    $table = DB::table('eklavya_krida_kosh_registration')->where('id', $id);
    if ($table->exists())
        return $table->first()->name;

}
 function eklavyaApplication($id)
 {
    $table = DB::table('eklavya_krida_kosh_registration')->where('id', $id);
    if ($table->exists())
         return $table->first()->application_no;

 }




function divisionName($id)
{
    $table = DB::table('hostel_division_master')->where('id', $id);
    if ($table->exists())
        return repairHindi($table->first()->division_name);

}


function applicant_awardDetails($award_id)
{
    if($award_id == 1)
    $table_name="laxman_award";
    if(isset($table_name)){
    $table = DB::table($table_name)->select('id','final_submit')->where('user_id', Auth::id());
    // print_r($table);exit;
    if ($table->exists())
        return $table->first();
    }

}
function last_login($uid)
{

    $table = DB::table("login_history")->select('date')->where('uid', $uid)->orderBy('id', 'desc')->take(1)->get();
    // return date_format(date_create($table[0]->date), "F j, Y, g:i A");
    return date_format(date_create($table[0]->date), "d/m/Y , g:i A");

    // return $table ;
    // print_r($table[0]->date);exit;


}

function isodate($date)
{


    return date_format(date_create($date), "d/m/Y ");




}

function rsoName($id)
{
    $table = DB::table('admin')->select('name')->where('id', $id);
    if ($table->exists())
        return repairHindi(ucfirst($table->first()->name));

    return '--';
}

function employeeName($id)
{
    $table = DB::table('employee')->select('employee_name')->where('id', $id);
    if ($table->exists())
        return ucfirst($table->first()->employee_name);

    return '--';
}

function userName($id,$type)
{

    $query_master = DB::table('query_master')->select('user_id','form_type')->where('id', $type)->first();
	// dd($id);
    // if($query_master->form_type==6){
	// $table = DB::table('direct_recruitment')->select('fullname as name')->where('user_id', $id);
	// }else{

// dd($query_master);
	$table = DB::table('sport_welfare_registration_master')->select('fullname as name')->where('id', $query_master->user_id);
	// }
    if ($table->exists())
        return ucfirst($table->first()->name);

    return '--';
}

function marked_status($id,$type)
{

//      if($type==4 || $type==5 || $type==6){
//         //  $mark_status = DB::table('query_master')->select('query_status')->where('user_id', Auth::guard('direct_recruitment')->user()->user_id)->where('form_type', $type)->orderBy('id', 'DESC')->first();
//         $mark_status = DB::table('query_master')->select('query_status','current_status','is_closed')->where('user_id', $id)->where('form_type', $type);

//     }
//    else{
        $mark_status = DB::table('query_master')->select('query_status','current_status','is_closed')->where('application_no', $id)->where('form_type', $type);

    //  }

	if(isset(Auth::guard('admin')->user()->id)){
        $rsoId  = Auth::guard('admin')->user()->id;
        $mark_status->where('rso_id', $rsoId);
    }

   $mark_status=$mark_status->orderBy('id', 'DESC')->first();
// dd($mark_status);
    return $mark_status;
}

function marked_closed($id)
{
    $mark_status = DB::table('query_master')->select('is_closed','query_status','current_status')->where('id', $id)->orderBy('id', 'DESC')->first();
    return $mark_status;
}
function queryReply($id)
{
    // if($type==6){
    //     $mark_status = DB::table('query_master')->select('query_status')->where('user_id', Auth::guard('direct_recruitment')->user()->user_id)->where('form_type', $type)->orderBy('id', 'DESC')->first();

    // }
    // else{
        $queryReply = DB::table('query_reply_detail')->select('*')->where('query_id', $id)->where('replied_by', '!=',8)->orderBy('id', 'DESC')->first();

    // }



    return $queryReply;
}

function chu($req){
    $chul = explode('-', $req);
    return  $chul[2] . '-' . $chul[1] . '-' . $chul[0];
}

function sportName($req){
    $spo = explode(",", $req);
    $items = DB::table('sport_type')->whereIn('id', $spo)->get();

    return  $items;
}

function postName($req){
    $items = DB::table('advertisment_post_master')->where('id', $req);
    // dd($items->post_name);
    if ($items->exists())
        return $items->first()->post_name;

    return "---";
    // return  $items->post_name;
}

function AppliedPostName($user_id){
    $post = DB::table('applicant_post_master')->where('user_id', $user_id)->first();

    // dd($post);
    if(isset($post->post_name)){
        $items = DB::table('advertisment_post_master')->where('id', $post->post_name)->first();
        // dd($items->post_name);

        if(isset($items->post_name)){
            return  $items->post_name;
        }
        else {
            return "";
        }
    }
    return "";

}
function AllAppliedPost($id){
    $post = DB::table('applicant_post_master')
        ->where('application_no', $id)->get();
        $post_data=[];
    if(count($post)>0){
        foreach($post as $item){
            if(isset($item->post_name)){
            $post_data[]=postName($item->post_name);
            }
        }
        if(count($post_data)>0){
            return  implode(',',$post_data);
        }
        else {
            return "";
        }
    }
    return "";
}
function AllCom($id){
    $sportAchievement = DB::table('direct_recruitment_sport_achievement')->where('application_no', $id)->get();
    // dd($sportAchievement);
    return $sportAchievement;
}

function AllCompetition($id,$type){
    $sportAchievement = db::table('sport_achievement_master')->select('*')->where('application_no', $id)->where('award_id', $type)->get();
    
    return $sportAchievement;
}

function PosiCompetition($id,$type=""){
    if($type==3){
        $sportAchievement = DB::table('position_holder_competition_docs')
        ->where('application_no', $id)
        ->get();
    }else{
        $sportAchievement = db::table('eklavya_krida_kosh_award')->select('*')->where('application_no', $id)->get();
    }
    // dd($sportAchievement);
    return $sportAchievement;
}

function sportNEventName($req){
    $items = DB::table('sports_event_master')->where('id', $req);
    // dd($items->post_name);
    if ($items->exists())
        return$items->first()->event_name;
    return $req;
}
function sportEventName($req){
    $items = DB::table('sport_competition_level_master')->where('id', $req);
    if ($items->exists())
        return$items->first()->name;
    return $req;
}

function PosiEventName($req){
    $items = DB::table('position_competition_master')->where('id', $req);
    if ($items->exists())
        return$items->first()->name;
    return $req;
}
function PosiEventMaster($req){
    $items = DB::table('position_event_master')->where('id', $req);
    if ($items->exists())
        return$items->first()->name;
    return $req;
}



function query_count($user_id,$form_type)
{
    $table = DB::table('query_master')->where('user_id', $user_id)->where('form_type',$form_type);
    if ($table->exists())
        return $table->count();

    return 0;
}


function sportCollege($id)
{
    $table = DB::table('sports_college_master')->where('id', $id);
    if ($table->exists())
        return $table->first()->college_name;


}


function transaction($challan_no,$user_id){
    $table = DB::table('online_admission_payment_response_details')->where('uniquechallan', $challan_no)->where('user_id', $user_id)->where('status', 'SUCCESS');
    if ($table->exists())
        return $table->orderByDesc('id')->first();
}


function sport_name($id){
    $table = DB::table('sport_type')->where('id', $id);
    if ($table->exists())
        return $table->first()->name;
}


function month_name($id){
    $table = DB::table('month_master')->where('id', $id);
    if ($table->exists())
        return $table->first()->month_name;

}

function applicantName($id,$type)
{

    // if($type == 6){
	// $table = DB::table('direct_recruitment')->select('fullname as name')->where('user_id', $id);
	// }else{

// dd($query_master);
	$table = DB::table('sport_welfare_registration_master')->select('fullname as name')->where('id', $id);
	// }
    if ($table->exists())
        return ucfirst($table->first()->name);

    return '--';
}

function form_date_status($type)
{

    $mark_status = DB::select('SELECT count(id) as count FROM `application_form_date_master` where form_type = '.$type.' and start_date <= now() and end_date >= now()')[0];

    // return $mark_status->count;
    return 1;
}
function form_apply_status($type)
{
    $where=false;
    if($type == 1){
        $table_name="laxman_award";
        $where=" where form_status = 0 and user_id =". Auth::id();
    }

    if($type == 2){
        $table_name="ranilaxmibai_award";
        $where=" where form_status = 0 and user_id =". Auth::id();
    }
    if($type == 3){
        $table_name="position_holder";
        $where=" where form_status = 0 and user_id =". Auth::id();
    }


    $mark_status = DB::select('SELECT YEAR(created_at) as yr FROM '.$table_name .$where);
    // dd( date($mark_status[0]->yr));

    if($mark_status  && date($mark_status[0]->yr) >= date("Y") ){
        $count=0;
    }
    else{
        $count=1;
    }

    return $count;
}


function sub_sport_type($sport_id){
    $subsports = DB::table('sub_sport_type')->where('sport_id', $sport_id)->get();

    return $subsports;
}


function sportnamee($sport_id){
    $subsports = DB::table('sport_type')->where('name', $sport_id)->first();

    return $subsports;
}

function itemName($type,$id)
{

	$table = DB::table('item_master')->select('item_name as name')->where('id', $id);

    if ($table->exists())
        return ucfirst($table->first()->name);

    return '--';
}

function item($id)
{

	$table = DB::table('item_master')->select('*')->where('id', $id);

    if ($table->exists())
        return $table->first();

    return '--';
}


function trialData($application_no, $subSport , $trial){


    $table = DB::table('online_admission_trial_applicant')->select('*')->where('application_no', $application_no)->where('trial_type', $trial);


     return $table->first();

}


function trialBadmintonData($application_no , $trial){


    $table = DB::table('online_admission_badminton_trial')->select('*')->where('application_no', $application_no)->where('trial_type', $trial);


     return $table->first();

}

function trialvolleyballData($application_no , $trial){


    $table = DB::table('online_admission_volleyball_trial')->select('*')->where('application_no', $application_no)->where('trial_type', $trial);


     return $table->first();

}


function trialgymnasticgirlsData($application_no , $trial){


    $table = DB::table('online_admission_gymnastic_girl_trial')->select('*')->where('application_no', $application_no)->where('trial_type', $trial);


     return $table->first();

}

function trialgymnasticboysData($application_no , $trial){


    $table = DB::table('online_admission_gymnastic_boy_trial')->select('*')->where('application_no', $application_no)->where('trial_type', $trial);


     return $table->first();

}


function trialjudoData($application_no , $trial){


    $table = DB::table('online_admission_judo_trial')->select('*')->where('application_no', $application_no)->where('trial_type', $trial);


     return $table->first();

}


function trialkustiData($application_no , $trial){


    $table = DB::table('online_admission_kusti_trial')->select('*')->where('application_no', $application_no)->where('trial_type', $trial);


     return $table->first();

}






function trialfootballkeeperData($application_no , $trial){


    $table = DB::table('online_admission_football_goalkeeper_trial')->select('*')->where('application_no', $application_no)->where('trial_type', $trial);


     return $table->first();

}
function trialfootballData($application_no , $trial){


    $table = DB::table('online_admission_football_trial')->select('*')->where('application_no', $application_no)->where('trial_type', $trial);


     return $table->first();

}


function trialathleticsthrowerData($application_no , $trial){

    $table = DB::table('online_admission_athletics_thrower_trial')->select('*')->where('application_no', $application_no)->where('trial_type', $trial);


     return $table->first();
}

function trialhockeyData($application_no , $trial){


    $table = DB::table('online_admission_hockey_trial')->select('*')->where('application_no', $application_no)->where('trial_type', $trial);


     return $table->first();

}

function trialhockeykeeperData($application_no, $trial){


    $table = DB::table('online_admission_hockey_goalkeeper_trial')->select('*')->where('application_no', $application_no)->where('trial_type', $trial);


     return $table->first();

}

function trialkabaddiData($application_no, $trial){


    $table = DB::table('online_admission_kabbadi_trial')->select('*')->where('application_no', $application_no)->where('trial_type', $trial);


     return $table->first();

}

function trialswimmingData($application_no, $trial){


    $table = DB::table('online_admission_swimming_trial')->select('*')->where('application_no', $application_no)->where('trial_type', $trial);


     return $table->first();

}



function trialathleticsrunnerData($application_no, $trial){


    $table = DB::table('online_admission_athletics_runner_trial')->select('*')->where('application_no', $application_no)->where('trial_type', $trial);


     return $table->first();

}



function trialathleticsjumperData($application_no, $trial){


    $table = DB::table('online_admission_athletics_jumper_trial')->select('*')->where('application_no', $application_no)->where('trial_type', $trial);


     return $table->first();

}



function trialcricketbatsmanData($application_no, $trial){


    $table = DB::table('online_admission_cricket_batsman_trial')->select('*')->where('application_no', $application_no)->where('trial_type', $trial);


     return $table->first();

}

function trialcricketkeeperData($application_no, $trial){


    $table = DB::table('online_admission_cricket_wicket_keeper_trial')->select('*')->where('application_no', $application_no)->where('trial_type', $trial);


     return $table->first();

}


function trialcricketballerData($application_no, $trial){


    $table = DB::table('online_admission_cricket_bowler_trial')->select('*')->where('application_no', $application_no)->where('trial_type', $trial);


     return $table->first();

}



function get_subSportName($id){

    $subsports = DB::table('sub_sport_type')->find($id);

    return $subsports->sub_type;
}

function get_subSportId($id){

    $subsports = DB::table('sub_sport_type')->find($id);

    return $subsports->sport_id;
}

function totalItem($order_no,$item_id,$type)
{
    $sum=0;
if($type==1){
    $sum = DB::select('SELECT sum(quantity_recieved) as total FROM `purchase_recieved_order_history` where orderNo='.$order_no.' and item_id ='.$item_id);
}
if($type==2){
    $sum = DB::select('SELECT sum(quantity_return) as total FROM `purchase_returned_order_history` where orderNo='.$order_no.' and item_id ='.$item_id);
}
if($sum[0]->total == null){
    $total=0;
}
else{
    $total=$sum[0]->total;
}

	// dd($sum[0]->total);
    return $total;
}

function tItem($count,$item_id)
{
    $sum = DB::select('SELECT sum(quantity_recieved) as total FROM `purchase_order_history` where  item_id ='.$item_id);

    return $sum[0]->total + $count;
}

function stock_item($item_id,$item_type)
{
    $total1=0;
    $total2=0;
    $total3=0;
    $sum = DB::select('SELECT sum(quantity_recieved) as total FROM `purchase_order_history` where  item_id ='.$item_id);
    if($sum[0]->total != null){
        $total1=$sum[0]->total;
    }
    $table = DB::table('item_master')->select('quantity_of_items_purchased as qqq')->where('id', $item_id)->first();
//    dd($table->qqq);

$raise=DB::select('SELECT sum(issued_quantity) as issued_quantity ,sum(return_quantity) as return_quantity FROM `indent_raise_request` where item_id='.$item_id);

if($table != null){
    $total2=$table->qqq;
}
if($raise != null){
    $total3=$raise[0]->return_quantity-$raise[0]->issued_quantity ;
}
     return $total1 + $total2 + $total3;
}



//ISP Api Integration Function



function getToken($apiUrl, $data){



    $curl = curl_init();
          curl_setopt($curl, CURLOPT_POST, 1);
          if ($data)
             curl_setopt($curl, CURLOPT_POSTFIELDS, $data);


 curl_setopt($curl, CURLOPT_URL, $apiUrl);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
       'APIKEY: 123456789',
       'Content-Type: application/json',
    ));

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

    $resultData = curl_exec($curl);

    if(!$resultData){
         die("Invalid API Request!");
     }

    curl_close($curl);
    return $resultData;



 }



 function callIspWs( $apiUrl, $data, $token){

    $curl = curl_init();
          curl_setopt($curl, CURLOPT_POST, 1);
          if ($data)
             curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

 $headr = array();
 $headr[] = 'Content-type: application/json';
 $headr[] = 'Authorization: Bearer '.$token;
 curl_setopt($curl, CURLOPT_URL, $apiUrl);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headr);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);


    $resultData = curl_exec($curl);


    if(!$resultData){
         die("Invalid API Request!");
     }
    curl_close($curl);

    return $resultData;
 }



 function encryptString($plaintext, $password){
	$salt = "0000000011111111";
$bytes = array('0','0','0','0','0','0','0','0','1', '1','1', '1','1', '1','1', '1');
$iv = implode(array_map("chr", $bytes));

$iterations = 1000;
$keyLength = 32;
$prepared_key = openssl_pbkdf2($password, $salt, $keyLength, $iterations, "sha512");
$ciphertext_b64 = base64_encode(openssl_encrypt($plaintext,"AES-256-CBC",$prepared_key,OPENSSL_RAW_DATA, $iv));
return $ciphertext_b64;


}


function decryptString($ciphertext_b64, $password){
	$salt = "0000000011111111";
$bytes = array('0','0','0','0','0','0','0','0','1', '1','1', '1','1', '1','1', '1');
$iv = implode(array_map("chr", $bytes));

$iterations = 1000;
$keyLength = 32;
$prepared_key = openssl_pbkdf2($password, $salt, $keyLength, $iterations, "sha512");
$pt = openssl_decrypt(base64_decode($ciphertext_b64),"AES-256-CBC",$prepared_key,OPENSSL_RAW_DATA, $iv);
//echo $pt::class;
//return serialize($pt);
return $pt;

}



function isp_common_detail($user_id, $email, $service, $application_no){
    $table = DB::table('isp_common_detail')->where('user_id', $user_id)->where('email', $email)->where('type', $service)->where('main_table_id', $application_no);


    if ($table->exists())

        return $table->orderByDesc('id')->first();

}






function isp_common($user_id, $email){
    $table = DB::table('isp_common_detail')->where('user_id', $user_id)->where('email', $email);

    if ($table->exists())
        return $table->orderByDesc('id')->first();
}



function isp_division($id){
    $table = DB::table('cities')->where('id', $id);
    if ($table->exists())
        return $table->first()->isp_division_code;
}

function hosteltrialData($application_no, $trial){


    $table = DB::table('hostel_trial_applicant')->select('*')->where('application_no', $application_no)->where('trial_type', $trial);


     return $table->latest('id')->first();

}

function hosteltrialBadmintonData($application_no , $trial){


    $table = DB::table('hostel_badminton_trial')->select('*')->where('application_no', $application_no)->where('trial_type', $trial);


     return $table->first();

}



function hosteltrialvolleyballData($application_no , $trial){


    $table = DB::table('hostel_volleyball_trial')->select('*')->where('application_no', $application_no)->where('trial_type', $trial);


     return $table->first();

}



function hosteltrialkustiData($application_no , $trial){


    $table = DB::table('hostel_kusti_trial')->select('*')->where('application_no', $application_no)->where('trial_type', $trial);


     return $table->first();

}



function hosteltrialswimmingData($application_no , $trial){


    $table = DB::table('hostel_swimming_trial')->select('*')->where('application_no', $application_no)->where('trial_type', $trial);


     return $table->first();

}








function hosteltrialkabaddiData($application_no, $trial){


    $table = DB::table('hostel_kabbadi_trial')->select('*')->where('application_no', $application_no)->where('trial_type', $trial);


     return $table->first();

}


function hosteltrialjudoData($application_no , $trial){


    $table = DB::table('hostel_judo_trial')->select('*')->where('application_no', $application_no)->where('trial_type', $trial);


     return $table->first();

}

function hosteltrialgymnasticboysData($application_no , $trial){


    $table = DB::table('hostel_gymnastic_boy_trial')->select('*')->where('application_no', $application_no)->where('trial_type', $trial);


     return $table->first();

}

function hosteltrialgymnasticgirlsData($application_no , $trial){


    $table = DB::table('hostel_gymnastic_girl_trial')->select('*')->where('application_no', $application_no)->where('trial_type', $trial);


     return $table->first();

}



function hosteltrialcricketbatsmanData($application_no, $trial){


    $table = DB::table('hostel_cricket_batsman_trial')->select('*')->where('application_no', $application_no)->where('trial_type', $trial);


     return $table->first();

}

function hosteltrialcricketkeeperData($application_no, $trial){


    $table = DB::table('hostel_cricket_wicket_keeper_trial')->select('*')->where('application_no', $application_no)->where('trial_type', $trial);


     return $table->first();

}


function hosteltrialcricketballerData($application_no, $trial){


    $table = DB::table('hostel_cricket_bowler_trial')->select('*')->where('application_no', $application_no)->where('trial_type', $trial);


     return $table->first();

}


function hosteltrialhockeyData($application_no , $trial){


    $table = DB::table('hostel_hockey_trial')->select('*')->where('application_no', $application_no)->where('trial_type', $trial);


     return $table->first();

}

function hosteltrialhockeykeeperData($application_no, $trial){


    $table = DB::table('hostel_hockey_goalkeeper_trial')->select('*')->where('application_no', $application_no)->where('trial_type', $trial);


     return $table->first();

}



function hosteltrialfootballkeeperData($application_no , $trial){


    $table = DB::table('hostel_football_goalkeeper_trial')->select('*')->where('application_no', $application_no)->where('trial_type', $trial);


     return $table->first();

}
function hosteltrialfootballData($application_no , $trial){


    $table = DB::table('hostel_football_trial')->select('*')->where('application_no', $application_no)->where('trial_type', $trial);


     return $table->first();

}



function hosteltrialathleticsrunnerData($application_no, $trial){


    $table = DB::table('hostel_athletics_runner_trial')->select('*')->where('application_no', $application_no)->where('trial_type', $trial);


     return $table->first();




}



function hosteltrialathleticsjumperData($application_no, $trial){


    $table = DB::table('hostel_athletics_jumper_trial')->select('*')->where('application_no', $application_no)->where('trial_type', $trial);


     return $table->first();

}




function hosteltrialathleticsthrowerData($application_no , $trial){

    $table = DB::table('hostel_athletics_thrower_trial')->select('*')->where('application_no', $application_no)->where('trial_type', $trial);


     return $table->first();
}



function hosteltrialboxingData($application_no , $trial){

    $table = DB::table('hostel_boxing_trial')->select('*')->where('application_no', $application_no)->where('trial_type', $trial);


     return $table->first();
}


function hosteltrialbasketballData($application_no , $trial){

    $table = DB::table('hostel_basketball_trial')->select('*')->where('application_no', $application_no)->where('trial_type', $trial);


     return $table->first();
}


function hosteltrialtabletennisData($application_no , $trial){

    $table = DB::table('hostel_tabletennis_trial')->select('*')->where('application_no', $application_no)->where('trial_type', $trial);


     return $table->first();
}



function hosteltrialhandballData($application_no , $trial){

    $table = DB::table('hostel_handball_trial')->select('*')->where('application_no', $application_no)->where('trial_type', $trial);
     return $table->first();
}



function hosteltrialarcheryData($application_no , $trial){

    $table = DB::table('hostel_archery_trial')->select('*')->where('application_no', $application_no)->where('trial_type', $trial);


     return $table->first();
}

function getBrowserName($user_agent){
    $bname = 'Unknown';
    if(preg_match('/MSIE/i',$user_agent) && !preg_match('/Opera/i',$user_agent))
    {
        $bname = 'Internet Explorer';
    }
    elseif(preg_match('/Firefox/i',$user_agent))
    {
        $bname = 'Mozilla Firefox';
    }
    elseif(preg_match('/Chrome/i',$user_agent))
    {
        $bname = 'Google Chrome';
    }
    elseif(preg_match('/Safari/i',$user_agent))
    {
        $bname = 'Apple Safari';
    }
    elseif(preg_match('/Opera/i',$user_agent))
    {
        $bname = 'Opera';
    }
    elseif(preg_match('/Netscape/i',$user_agent))
    {
        $bname = 'Netscape';
    }

    return $bname;
}

function get_association_by_app($appl_no){
    $table = DB::table('direct_recruitment')->join('sport_welfare_registration_master as swrm','swrm.id','=','direct_recruitment.user_id')->select('swrm.sport_type')->where('application_no', $appl_no);
    if ($table->exists()){
       $sport_type = $table->first()->sport_type;
       $admin = DB::table('admin')->select('id')->where('sport_type', $sport_type);
       if ($admin->exists()){
        return $admin->first()->id;
        }
    return "--";


    }
}

function get_rso_by_app($id){
    
    $table = DB::table('sport_welfare_registration_master')->select('permanent_district')->where('id', $id);
    if ($table->exists()){
       $district_id = $table->first()->permanent_district;
       $admin = DB::table('admin')->join('hostel_div_district_mapping','admin.division_id','=','hostel_div_district_mapping.division_id')->select('admin.id')
       ->where('admin.status', 1)->where('hostel_div_district_mapping.district_id', $district_id);
       if ($admin->exists()){
        return $admin->first()->id;
        }
    return "--";


    }
}
function get_rso_by_app_ekl($id){
    
    $table = DB::table('sport_welfare_registration_master')->select('permanent_district')->where('id', $id);
    if ($table->exists()){
       $district_id = $table->first()->permanent_district;
       $admin = DB::table('admin')->select('admin.id')
       ->where('admin.status', 1)->where('district_id', $district_id);
       if ($admin->exists()){
        return $admin->first()->id;
        }
    return "--";


    }
}
function get_last_reply($appl_no){
    $admin = DB::table('mark_query_comment')->select('*')->where('application_no', $appl_no);
       if ($admin->exists()){
        return $admin->orderBy('id', 'desc')->take(1)->first();
        }

}

function status_check($type){

    if($type==1){
        $status = DB::table('laxman_award')->where('user_id', Auth::id())->orderBy('id','desc')->first();

    }
    if($type==2){
        $status = DB::table('ranilaxmibai_award')->where('user_id', Auth::id())->orderBy('id','desc')->first();
    }
    if($type==3){
        $status = DB::table('position_holder')->where('user_id', Auth::id())->orderBy('id','desc')->first();
    }
    if($type==4){
        $status = DB::table('financial_assistance')->where('user_id', Auth::id())->orderBy('id','desc')->first();
    }
    if($type==5){
        $status = DB::table('monthly_pension')->where('user_id', Auth::id())->orderBy('id','desc')->first();
    }
    if($type==6){
        $status = DB::table('direct_recruitment')->where('user_id', Auth::id())->orderBy('id','desc')->first();
    }
    if($type==7){
        $status = DB::table('eklavya_krida_kosh_basic_detail')->where('user_id', Auth::id())->orderBy('id','desc')->first();
    }

    return $status;
}

function data_gett($type,$id){

    if($type==1){
        $status = DB::table('laxman_award')->where('user_id', $id)->orderBy('id','desc')->first();

    }
    if($type==2){
        $status = DB::table('ranilaxmibai_award')->where('user_id',$id)->orderBy('id','desc')->first();
    }
    if($type==3){
        $status = DB::table('position_holder')->where('user_id', $id)->orderBy('id','desc')->first();
    }
    if($type==4){
        $status = DB::table('financial_assistance')->where('user_id', $id)->orderBy('id','desc')->first();
    }
    if($type==5){
        $status = DB::table('monthly_pension')->where('user_id', $id)->orderBy('id','desc')->first();
    }
    if($type==6){
        $status = DB::table('direct_recruitment')->where('user_id', $id)->orderBy('id','desc')->first();
    }
    if($type==7){
        $status = DB::table('eklavya_krida_kosh_basic_detail')->where('user_id', $id)->orderBy('id','desc')->first();
    }

    return $status;
}


function admin_name($id){
    return DB::table("admin")->where('id', $id)->first()->name;
}



function announcement(){

   $announcement =  DB::table("admin_announcement")
   ->whereDate('start_date', '<=', date('Y-m-d'))
   ->whereDate('end_date', '>=', date('Y-m-d'))
   ->orderByDesc('id')
   ->get();
    return $announcement;

}
function getFormStatus($id,$url){

    $ccc =  DB::table("application_form_date_master")
    ->whereDate('start_date', '<=',  date('Y-m-d'))
    ->whereDate('end_date', '>=',  date('Y-m-d'))
    ->where('form_type', $id)
    ->where('url_slug',  $url);
    if ($ccc->exists()){
        return 1;
    }
    return 0;



 }



 function regionsportname($id)
{
    $table = DB::table('regional_master')->where('id', $id);
    if ($table->exists())
        return $table->first()->regional_name;

}





function call_curlApi($xml,$url,$arr_title){

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 10,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $xml,
        CURLOPT_HTTPHEADER => array(
            'Content-Type:text/xml',
            'Accept: application/xml'
        ),
    ));
    $curl_err = curl_error($curl);
    $response = curl_exec($curl);
    curl_close($curl);


    return $response;
    // print_r($curl_err);
    // echo $response;die;

    // $xml_res = XmlToArray::convert($response);
    // $res = XmlToArray::convert(@$xml_res['soap:Body']['Send'.$arr_title.'Response']['Send'.$arr_title.'Result']);
    // // print_r($res); die;

    // if(is_array($res)){
    //     return [true,$res];
    // }
    // $this->ErrorInsert('EDistrictController::call_curlApi',$curl_err.' not in array & empty res & not in status field.'.$response.' after convert :- '.json_encode($res));
    // return [false,$curl_err.' not in array & empty res & not in status field.'.$response];
    }





 function get_age($from_date, $to_date){

    $date1 =new DateTime($from_date);
    $date2 = new DateTime($to_date);

    $interval = ($date1->diff($date2))->y;
    return $interval;
 }



 function sport_name_hostel($id){
    $table = DB::table('sport_master')->where('id', $id);
    if ($table->exists())
        return $table->first()->name;
 }


 function sub_sport_name($id){
    $table = DB::table('sub_sport_type')->where('id', $id);
    if ($table->exists())
        return $table->first()->sub_type;
 }



 function get_age_differnce($from_date, $to_date){

    $date1 =new DateTime($from_date);
    $date2 = new DateTime($to_date);

    $interval = ($date1->diff($date2));
    return  $interval->y . "--" . $interval->m."--".$interval->d;
 }





 function hostelName($id)
 {
     $table = DB::table('hostel_master')->where('id', $id);
     if ($table->exists())
         return $table->first()->hostel_name;

 }




 function stadium_name ($id){

        $table = DB::table('studium_master')->where('id', $id);
        if ($table->exists())
            return $table->first()->studium_name;

 }






 function rajkosh_division_treasury($id){

    $division_id =  DB::Select("select `rajkosh_division`.`DIVCODE`, `rajkosh_treasury`.`TCODE` from `cities` join `hostel_div_district_mapping` on `cities`.`id` = `hostel_div_district_mapping`.`district_id` left JOIN rajkosh_treasury on rajkosh_treasury.district_id = cities.id left JOIN rajkosh_division on rajkosh_division.DIVCODE = rajkosh_treasury.DIVCODE where `cities`.`id` = $id");

    if (empty($division_id)) {
        return (object) ['DIVCODE' => '', 'TCODE' => ''];
    }

  return $division_id[0] ;

 }


 function rajkosh_payment_clip($application_no){
    $payment_data = DB::table('hostel_register')->select('rajkosh_payment_request.*')->join('rajkosh_payment_request','rajkosh_payment_request.application_no','=','hostel_register.application_no')->join('rajkosh_payment_response','rajkosh_payment_request.Depchallan','=','rajkosh_payment_response.challan_no')->where('hostel_register.application_no', $application_no)->where('rajkosh_payment_response.Status','Success')->where('rajkosh_payment_request.module', 1)->first();

    return $payment_data;
 }


 function rajkosh_payment_clipallotment($application_no){
    $payment_data = DB::table('hostel_register')->select('rajkosh_payment_request.*')->join('rajkosh_payment_request','rajkosh_payment_request.application_no','=','hostel_register.application_no')->join('rajkosh_payment_response','rajkosh_payment_request.Depchallan','=','rajkosh_payment_response.challan_no')->where('hostel_register.application_no', $application_no)->where('rajkosh_payment_response.Status','Success')->where('rajkosh_payment_request.module', 3)->first();

    return $payment_data;
 }


 function SendhostelallotmentSMS($requestMobile, $message)
{     $url = '#';
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;


}


function trial_date($application_no, $trial){




    $table = DB::table('online_admission_badminton_trial')->select('date', 'remark')->where('application_no', $application_no)->where('trial_type', $trial);
    if ($table->exists())
        return $table->first();


    $table = DB::table('online_admission_volleyball_trial')->select('date', 'remark')->where('application_no', $application_no)->where('trial_type', $trial);
    if ($table->exists())
        return $table->first();


    $table = DB::table('online_admission_gymnastic_girl_trial')->select('date', 'remark')->where('application_no', $application_no)->where('trial_type', $trial);
    if ($table->exists())
        return $table->first();


     $table = DB::table('online_admission_gymnastic_boy_trial')->select('date', 'remark')->where('application_no', $application_no)->where('trial_type', $trial);
     if ($table->exists())
       return $table->first();


     $table = DB::table('online_admission_judo_trial')->select('date', 'remark')->where('application_no', $application_no)->where('trial_type', $trial);
     if ($table->exists())
      return $table->first();




    $table = DB::table('online_admission_kusti_trial')->select('date', 'remark')->where('application_no', $application_no)->where('trial_type', $trial);
    if ($table->exists())
        return $table->first();




    $table = DB::table('online_admission_football_goalkeeper_trial')->select('date', 'remark')->where('application_no', $application_no)->where('trial_type', $trial);
    if ($table->exists())
        return $table->first();;


     $table = DB::table('online_admission_football_trial')->select('date', 'remark')->where('application_no', $application_no)->where('trial_type', $trial);
     if ($table->exists())
       return $table->first();



     $table = DB::table('online_admission_athletics_thrower_trial')->select('date', 'remark')->where('application_no', $application_no)->where('trial_type', $trial);
     if ($table->exists())
       return $table->first();



     $table = DB::table('online_admission_hockey_trial')->select('date', 'remark')->where('application_no', $application_no)->where('trial_type', $trial);
     if ($table->exists())
       return $table->first();



    $table = DB::table('online_admission_hockey_goalkeeper_trial')->select('date', 'remark')->where('application_no', $application_no)->where('trial_type', $trial);
    if ($table->exists())
        return $table->first();




    $table = DB::table('online_admission_kabbadi_trial')->select('date', 'remark')->where('application_no', $application_no)->where('trial_type', $trial);
    if ($table->exists())
        return $table->first();




    $table = DB::table('online_admission_swimming_trial')->select('date', 'remark')->where('application_no', $application_no)->where('trial_type', $trial);
    if ($table->exists())
        return $table->first();





    $table = DB::table('online_admission_athletics_runner_trial')->select('date', 'remark')->where('application_no', $application_no)->where('trial_type', $trial);
    if ($table->exists())
        return $table->first();



    $table = DB::table('online_admission_athletics_jumper_trial')->select('date', 'remark')->where('application_no', $application_no)->where('trial_type', $trial);
    if ($table->exists())
        return $table->first();


    $table = DB::table('online_admission_cricket_batsman_trial')->select('date', 'remark')->where('application_no', $application_no)->where('trial_type', $trial);
    if ($table->exists())
        return $table->first();




    $table = DB::table('online_admission_cricket_wicket_keeper_trial')->select('date', 'remark')->where('application_no', $application_no)->where('trial_type', $trial);
    if ($table->exists())
        return $table->first();




    $table = DB::table('online_admission_cricket_bowler_trial')->select('date', 'remark')->where('application_no', $application_no)->where('trial_type', $trial);
    if ($table->exists())
        return $table->first();





}






function rajkosh_payment_booking($application_no){
    $payment_data = DB::table('facility_booking_type_detail')->select('rajkosh_payment_request.*')->join('rajkosh_payment_request','rajkosh_payment_request.application_no','=','facility_booking_type_detail.application_no')->join('rajkosh_payment_response','rajkosh_payment_request.Depchallan','=','rajkosh_payment_response.challan_no')->where('facility_booking_type_detail.application_no', $application_no)->where('rajkosh_payment_response.Status','Success')->where('rajkosh_payment_request.module', 2)->first();

    return $payment_data;
 }

 function first_insert($table,$type){
    $page_master=DB::table($table)->select($type);
        if ($page_master->exists()){
            $st_date= dmy($page_master->take(1)->first()->$type);
        }else{
            $st_date=date("d-m-Y");
        }
        return $st_date;

 
 }
 
 function regectsms($requestMobile, $message)
 {
 $url = '#';
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $url);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
     $result = curl_exec($ch);
     curl_close($ch);
     $code = explode('|', $result);
 
     if ($code[0] == '1701') {
         return 1;
     } else {
         return 0;
     }
 }








 function acceptsms($requestMobile, $message)
 {
   
     $url = '#';

     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $url);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
     $result = curl_exec($ch);
     curl_close($ch);
     $code = explode('|', $result);
 
     if ($code[0] == '1701') {
         return 1;
     } else {
         return 0;
     }
 }

/**
 * Repairs commonly corrupted Hindi character patterns found in the database.
 * 
 * @param string $text
 * @return string
 */
function repairHindi($text)
{
    if (empty($text) || !is_string($text)) {
        return $text;
    }

    // Protection for correctly spelled submodules under 'Monthly Meeting Review'
    $whitelist = [
        'निर्माणाधीन परियोजनाओं की स्थिति',
        'खेलो इंडिया प्रस्ताव',
        'राजस्व प्राप्तियां',
        'खेलो इंडिया उत्कृष्टता',
        'प्रशिक्षण',
        'खेलो इंडिया सेंटर',
        'क्रीड़ा प्रतियोगिता का आयोजन',
        'एकलव्य क्रीड़ा कोष',
        'जिला खेल विकास',
        'व्ययाधिक्य बचत की सूचना',
        'क्षेत्रीय क्रीड़ा अधिकारी',
        'अधिकारियों/प्रशिक्षकों की सूचना',
        'क्रीड़ा छात्रवास',
        'Monthly Meeting Review'
    ];
    if (in_array(trim($text), $whitelist)) {
        return $text;
    }

    // 1. High-Priority Multi-Character Sequences (Specific Gibberish)
    $longSequences = [
        'वाीापसी' => 'वाराणसी',
        'ीखना' => 'लखनऊ',
        'बीीाममली' => 'बलरामपुर',
        'सलीतानमली' => 'सुलतानपुर',
        'गोीखमली' => 'गोरखपुर',
        'यीूसींीटेट' => 'यूनिट',
        'फ्ीी' => 'बार',
        'फ्ाीा' => 'बार',
        'ऩाडव' => 'यादव',
        'क्पाद़ा अधाकापा' => 'क्षेत्रीय अधिकारी',
        'क्पाद़ा' => 'क्षेत्रीय',
        'लखसऊ' => 'लखनऊ',
        'प्ायागपाप' => 'प्रयागराज',
        'गोपखपुप' => 'गोरखपुर',
        'वापापुसा' => 'वाराणसी',
        'वाभागाय' => 'विभागीय',
        'वापेता' => 'विजेता',
        'स्वतंत्ाता पावस' => 'स्वतंत्रता दिवस',
        'गणतंत्ाता पावस' => 'गणतंत्र दिवस',
        'शूस्य' => 'शून्य',
        'पपाषद' => 'परिषद',
        'प्पथष' => 'प्रथम',
        'प्वाताय' => 'द्वितीय',
    ];
    $text = str_replace(array_keys($longSequences), array_values($longSequences), $text);

    // 2. The Final Alpha-Shift Map (Systematic Alphabet Mapping)
    $alphaShift = [
        'रनमड' => 'परिषद',
        'रान' => 'पास',
        'ःेनास' => 'हेतु',
        'णला्' => 'पुष्',
        'ब्ीसाड' => 'प्रसाद',
        'म्ी' => 'प्र',
        'मजी' => 'परि',
        'ऩतीश' => 'सतीश',
        'ऩींी' => 'सिंह',
    ];
    $text = str_replace(array_keys($alphaShift), array_values($alphaShift), $text);

    // 3. Single Character Systematic Map (Using strtr for atomic shifts)
    $singleCharMap = [
        'ऩ' => 'य',
        'ब्' => 'व',
        'म्' => 'प',
        'र' => 'प', // Systematic shift for 'pa'
        'न' => 'स', // Systematic shift for 'sa'
        'म' => 'ष', // Systematic shift for 'sha'
        'ड' => 'द', // Systematic shift for 'da'
        'ः' => 'ह', // Systematic shift for 'ha'
        'ण' => 'पु',
        'ज' => 'र',
        'ढ' => 'ह',
        'ऽ' => 'स',
        'ा' => 'ी',
        'ी' => 'ा',
        'ि' => 'ा',
        'ऺ' => 'ध',
        'ऩे' => 'से',
        'डी' => 'के',
        'ीी' => 'जी', 
    ];
    
    // Multi-pass str_replace to handle byte overlaps safely
    $text = str_replace(array_keys($singleCharMap), array_values($singleCharMap), $text);

    // 4. Final Structure Cleanup
    $cleanup = [
        'ाी' => 'ी',
        'ाा' => 'ा',
        'ीी' => 'ी',
        'िि' => 'ि',
        'श्रीमतीी' => 'श्रीमती',
        'खेटीीय' => 'क्षेत्रीय',
        'क्रीडा' => 'क्रीड़ा',
    ];
    $text = str_replace(array_keys($cleanup), array_values($cleanup), $text);

    if ($text === 'क्' || $text === 'क्रीडा' || $text === 'क्रीड़ा') return 'क्रीड़ा अधिकारी';
    if ($text === 'खेटीीय' || $text === 'खेटीय') return 'क्षेत्रीय';

    return $text;
}