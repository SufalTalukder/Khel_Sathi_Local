<?php

namespace App\Http\Controllers;

use App\Events\ChangePasswordLog;
use App\Events\UserLoggedIn;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\AuthModel;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use App\Models\FinancialAssistance_Model;
use App\Events\StatusChangeLog;
use App\Models\Laxmanaward;
use App\Models\Ranilaxmibai;

use App\Events\SmsMail;
use App\Http\Controllers\EdistrcitController;

class FinancialAssistance extends Controller
{
    public function signUp()
    {

        $Code1 = rand(11, 99);
        $Code2 = rand(11, 99);
        $capchaCode = $Code1 +  $Code2;
        session()->put('capchaCode', $capchaCode);
        return view('financialAssistance.signUp', compact('capchaCode','Code1','Code2'));
    }

    public function forgot(Request $req)
    {
        if($req->post()){
            $user = DB::table('sport_welfare_registration_master')->join("sport_welfare_user_type_master","sport_welfare_registration_master.id","=","sport_welfare_user_type_master.user_id")->where('sport_welfare_user_type_master.registered_for', "FINANCIAL")->where('sport_welfare_registration_master.email', $req->email)->first();

            if($user != ""){
                // dd($reply->mobile);
                session()->put('form_type', 4);
               $check= SmsMail::dispatch([
                    "password" => $user->user_password,
                    "email" => $req->email,
                    "mobile" => $user->mobile
                ], 4);
                 return response()->json(["error" => false, "msg" => "Password Sent on your mobile successfully."]);

            }
            else{
                return response()->json(['error' => true, 'msg' => "Email not found"]);
            }

        }
        return view('financialAssistance.forgot');
    }
    /**
     * User Login via Otp
     */
    public function otp()
    {
        return view('financialAssistance.otp');
    }

    /**
     * User Login Form
     */
    public function loginForm(Request $request)
    {
        if($request->query('sessionkey')){

        $url= env('ISP_URl');

        $secretkey = env('ISP_SECRET_KEY');

        $tokenpassword = env('ISP_TOKEN_PASSWORD');
        $dept_id = env('ISP_DEPT_ID');


        $postData = array (
            "username"=>  $dept_id,
            "password"=>  $tokenpassword
        );



    $response = json_decode(getToken( $url.'/ispws/authenticate', json_encode($postData)));

    $token=$response->token;
////////////////////////////////////Calling api getRequestValidatedAndRequestID//////////////////

$inputData = array (
	"sessionkey"=> $request->query('sessionkey')
);

$e_data = encryptString(json_encode($inputData),$secretkey);


$finalLoad = array(
	"dept_id"=> $dept_id,
	"e_data"=> $e_data
);


$response = callIspWs( $url.'/ispws/isp/v1/getRequestValidatedAndRequestID', json_encode($finalLoad),$token );

$Data_enc= json_decode($response)->data;

$Data_dsc= json_decode(decryptString($Data_enc,$secretkey));


$request_id=$Data_dsc->request_id;
$applicant_id=$Data_dsc->applicant_id;
$service_code=$Data_dsc->service_code;

session_start();
$_SESSION["request_id"]=$request_id;
$_SESSION["applicant_id"]=$applicant_id;
$_SESSION["service_code"]=$service_code;



// return redirect()->route('fasignUp');
//////////////////////////////////////////////////////END///////////////////////

////////////////////////////////////Calling api getApplicantCommonDetails//////////////////
$inputData = array (
	"request_id"=> $request_id
);

$e_data = encryptString(json_encode($inputData),$secretkey);


$finalLoad = array(
	"dept_id"=> $dept_id,
	"e_data"=> $e_data
);

$response = callIspWs( $url.'/ispws/isp/v1/getApplicantCommonDetails', json_encode($finalLoad),$token );

$Data_enc= json_decode($response)->data;

$Data_dsc= json_decode(decryptString($Data_enc,$secretkey));


if (DB::table('sport_welfare_registration_master')->where('email', $Data_dsc->email)->exists()){

    $id=(DB::table('sport_welfare_registration_master')->select('id')->where('email',$Data_dsc->email)->first())->id;

    if(!DB::table('sport_welfare_user_type_master')->where('user_id', $id)->where('registered_for', 'FINANCIAL')->exists()){
        $usertypeid = DB::table('sport_welfare_user_type_master')->insertGetId([
            'user_id'       => $id,
            'registered_for'  => 'FINANCIAL'
        ]);


        $data =[
            'user_id'=> $id,
            'type'=> 'FINANCIAL',
            'request_id'=> $request_id,
            'applicant_id' => $Data_dsc->applicant_id,
            'service_name_eng' => $Data_dsc->service_name_eng,
            'service_name_hindi' => $Data_dsc->service_name_hindi,
            'service_code' => $Data_dsc->service_code,
            'family_id' => $Data_dsc->family_id,
            'member_id' => $Data_dsc->member_id,
            'aadhar_reference_no' => $Data_dsc->aadhar_reference_no,
            'first_name_eng' => $Data_dsc->first_name_eng,
            'middle_name_eng' => $Data_dsc->middle_name_eng,
            'last_name_eng' => $Data_dsc->last_name_eng,
            'first_name_hindi' => $Data_dsc->first_name_hindi,
            'middle_name_hindi' => $Data_dsc->middle_name_hindi,
            'last_name_hindi' => $Data_dsc->last_name_hindi,
            'gender' => $Data_dsc->gender,
           'father_or_husband_or_guardian' => $Data_dsc->father_or_husband_or_guardian,
           'father_or_husband_or_guardian_name_eng' => $Data_dsc->father_or_husband_or_guardian_name_eng,
           'father_or_husband_or_guardian_name_hindi' => $Data_dsc->father_or_husband_or_guardian_name_hindi,
           'mother_name_eng' => $Data_dsc->mother_name_eng,
           'mother_name_hindi' => $Data_dsc->mother_name_hindi,
           'category' => $Data_dsc->category,
           'dob' => $Data_dsc->dob,
           'pan_no' => $Data_dsc->pan_no,
           'mobile' => $Data_dsc->mobile,
           'email' => $Data_dsc->email,
           'marital_status' => $Data_dsc->marital_status,
           'income' => $Data_dsc->income,
           'occupation' => $Data_dsc->occupation,
           'residential_area_type' => $Data_dsc->residential_area_type,
           'residential_house_no' => $Data_dsc->residential_house_no,
           'residential_mohalla' => $Data_dsc->residential_mohalla,
           'residential_pin' => $Data_dsc->residential_pin,
           'residential_district' => $Data_dsc->residential_district,
           'residential_tehsil' => $Data_dsc->residential_tehsil,
           'residential_vikaskhand' => $Data_dsc->residential_vikaskhand,
           'residential_grampanchayat' => $Data_dsc->residential_grampanchayat,
           'residential_rajasvagram' => $Data_dsc->residential_rajasvagram,
           'residential_ward' => $Data_dsc->residential_ward,
           'residential_nagarpalika' => $Data_dsc->residential_nagarpalika,
           'residential_nagarnigam' => $Data_dsc->residential_nagarnigam,
           'residential_nagarpanchayat' => $Data_dsc->residential_nagarpanchayat,
           'residential_police_station' => $Data_dsc->residential_police_station,
           'residential_state' => $Data_dsc->residential_state,
           'permanent_area_type' => $Data_dsc->permanent_area_type,
           'permanent_house_no' => $Data_dsc->permanent_house_no,
           'permanent_mohalla' => $Data_dsc->permanent_mohalla,
           'permanent_pin' => $Data_dsc->permanent_pin,
           'permanent_district' => $Data_dsc->permanent_district,
           'permanent_tehsil' => $Data_dsc->permanent_tehsil,
           'permanent_vikaskhand' => $Data_dsc->permanent_vikaskhand,
           'permanent_grampanchayat' => $Data_dsc->permanent_grampanchayat,
           'permanent_rajasvagram' => $Data_dsc->permanent_rajasvagram,
           'permanent_ward' => $Data_dsc->permanent_ward,
           'permanent_nagarpalika' => $Data_dsc->permanent_nagarpalika,
           'permanent_nagarnigam' => $Data_dsc->permanent_nagarnigam,
           'permanent_nagarpanchayat' => $Data_dsc->permanent_nagarpanchayat,
           'permanent_police_station' => $Data_dsc->permanent_police_station,
           'permanent_state' => $Data_dsc->permanent_state,


          ];


          $isp_common_detail =DB::table('isp_common_detail')->insertGetId($data);
    }

}else{

  $pwd = rand(11111111,99999999);
    $id = DB::table('sport_welfare_registration_master')->insertGetId([
        'fullname'       => $Data_dsc->first_name_eng." ".$Data_dsc->middle_name_eng ." ".$Data_dsc->last_name_eng,
        'native_of_up'  => 1,
        'mobile'        => $Data_dsc->mobile,
        'email'         => $Data_dsc->email,
        'password'      => Hash::make($pwd),
        'user_password' => $pwd,
        'login_from' => 2,
    ]);

    $usertypeid = DB::table('sport_welfare_user_type_master')->insertGetId([
        'user_id'       => $id,
        'registered_for'  => 'FINANCIAL'
    ]);

    $data =[
        'user_id'=> $id,
        'type'=> 'FINANCIAL',
        'request_id'=> $request_id,
        'applicant_id' => $Data_dsc->applicant_id,
        'service_name_eng' => $Data_dsc->service_name_eng,
        'service_name_hindi' => $Data_dsc->service_name_hindi,
        'service_code' => $Data_dsc->service_code,
        'family_id' => $Data_dsc->family_id,
        'member_id' => $Data_dsc->member_id,
        'aadhar_reference_no' => $Data_dsc->aadhar_reference_no,
        'first_name_eng' => $Data_dsc->first_name_eng,
        'middle_name_eng' => $Data_dsc->middle_name_eng,
        'last_name_eng' => $Data_dsc->last_name_eng,
        'first_name_hindi' => $Data_dsc->first_name_hindi,
        'middle_name_hindi' => $Data_dsc->middle_name_hindi,
        'last_name_hindi' => $Data_dsc->last_name_hindi,
        'gender' => $Data_dsc->gender,
       'father_or_husband_or_guardian' => $Data_dsc->father_or_husband_or_guardian,
       'father_or_husband_or_guardian_name_eng' => $Data_dsc->father_or_husband_or_guardian_name_eng,
       'father_or_husband_or_guardian_name_hindi' => $Data_dsc->father_or_husband_or_guardian_name_hindi,
       'mother_name_eng' => $Data_dsc->mother_name_eng,
       'mother_name_hindi' => $Data_dsc->mother_name_hindi,
       'category' => $Data_dsc->category,
       'dob' => $Data_dsc->dob,
       'pan_no' => $Data_dsc->pan_no,
       'mobile' => $Data_dsc->mobile,
       'email' => $Data_dsc->email,
       'marital_status' => $Data_dsc->marital_status,
       'income' => $Data_dsc->income,
       'occupation' => $Data_dsc->occupation,
       'residential_area_type' => $Data_dsc->residential_area_type,
       'residential_house_no' => $Data_dsc->residential_house_no,
       'residential_mohalla' => $Data_dsc->residential_mohalla,
       'residential_pin' => $Data_dsc->residential_pin,
       'residential_district' => $Data_dsc->residential_district,
       'residential_tehsil' => $Data_dsc->residential_tehsil,
       'residential_vikaskhand' => $Data_dsc->residential_vikaskhand,
       'residential_grampanchayat' => $Data_dsc->residential_grampanchayat,
       'residential_rajasvagram' => $Data_dsc->residential_rajasvagram,
       'residential_ward' => $Data_dsc->residential_ward,
       'residential_nagarpalika' => $Data_dsc->residential_nagarpalika,
       'residential_nagarnigam' => $Data_dsc->residential_nagarnigam,
       'residential_nagarpanchayat' => $Data_dsc->residential_nagarpanchayat,
       'residential_police_station' => $Data_dsc->residential_police_station,
       'residential_state' => $Data_dsc->residential_state,
       'permanent_area_type' => $Data_dsc->permanent_area_type,
       'permanent_house_no' => $Data_dsc->permanent_house_no,
       'permanent_mohalla' => $Data_dsc->permanent_mohalla,
       'permanent_pin' => $Data_dsc->permanent_pin,
       'permanent_district' => $Data_dsc->permanent_district,
       'permanent_tehsil' => $Data_dsc->permanent_tehsil,
       'permanent_vikaskhand' => $Data_dsc->permanent_vikaskhand,
       'permanent_grampanchayat' => $Data_dsc->permanent_grampanchayat,
       'permanent_rajasvagram' => $Data_dsc->permanent_rajasvagram,
       'permanent_ward' => $Data_dsc->permanent_ward,
       'permanent_nagarpalika' => $Data_dsc->permanent_nagarpalika,
       'permanent_nagarnigam' => $Data_dsc->permanent_nagarnigam,
       'permanent_nagarpanchayat' => $Data_dsc->permanent_nagarpanchayat,
       'permanent_police_station' => $Data_dsc->permanent_police_station,
       'permanent_state' => $Data_dsc->permanent_state,


      ];


      $isp_common_detail =DB::table('isp_common_detail')->insertGetId($data);



 }

 $log_in=Auth::attempt(['email' => $Data_dsc->email, 'password' => $Data_dsc->user_password]);
 $isp = isp_common_detail(Auth::user()->id,Auth::user()->email, 'FINANCIAL');

 if($request_id != $isp->request_id){
    Auth::logout();
    return redirect()->route('faloginForm')->with('error', 'Already Applied for this service.');
     }


if ($log_in) {
     User::find(Auth::id())->update(array('last_login_attempt_time' => (\Carbon\Carbon::now())->toDateTimeString()));
        UserLoggedIn::dispatch(Auth::id(), 1,2,'sport_welfare_registration_master');
        // User::where('id', Auth::id())->update([
        //     "is_login" => 1,
        //     "ip_address" => request()->ip(),
        // ]);
         session()->flash('success', 'You have successfully logged in.');

         if(User::find(Auth::id())->profile_complete == "1"){

             if((DB::table('financial_assistance')->where('user_id', Auth::id())->exists()) || DB::table('monthly_pension')->where('user_id', Auth::id())->exists()){
              return redirect()->route('dashboard')->with('success', 'You have successfully logged in.');

                }
                else{
                    return redirect()->route('faapplyFor')->with('success', 'You have successfully logged in.');

                }
            }
            else{
                return redirect()->route('facp')->with('success', 'You have successfully logged in.');

            }
        }

        return redirect()->route('faloginForm')->with('error', 'Invalid login Credential.');
//////////////////////////////////////////////////////END///////////////////////);

    }


    $Code1 = rand(11, 99);
    $Code2 = rand(11, 99);
    $capchaCode = $Code1 +  $Code2;
    session()->put('capchaCode', $capchaCode);
        return view('financialAssistance.login', compact('capchaCode','Code1','Code2'));
    }


    /**
     * User Login
     *
     * Guard web Middleware Authorization
     */
    public function login(Request $req)
    {



        if($req->type == 0){
            $name='otp_data';
        }
        else{
            $name='password';
        }
        $validation = Validator::make($req->all(), [
            'email' => 'required',
            $name => 'required',
            'captcha' => 'required',
        ], msg());

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        if ($req->captcha != $req->capchaCode)
            return response()->json(['error' => true, 'msg' => "Oops! Invalid Captcha Code."]);

            if($req->type == 0 && DB::table('sport_welfare_registration_master')->where('email',$req->email)->where('otp',$req->otp_data)->where('login_from', 1)->exists()){
                $check_users = User::where('email',$req->email)->where('otp',$req->otp_data)->first();
                $log_in=Auth::attempt(['email' => $req->email, 'password' => $check_users->user_password]);
            }
            else{
                if( DB::table('sport_welfare_registration_master')->where('email',$req->email)->where('login_from', 1)->exists()){
                    $log_in= Auth::attempt(['email' => $req->email, 'password' => $req->password]);
                }else{
                    return response()->json(['error' => true, 'msg' => "Not Authorized to login."]);
                }

                // $log_in= Auth::attempt(['email' => $req->email, 'password' => $req->password]);
            }

        if ($log_in) {
            $user_agent = request()->header('User-Agent');
            // if (Auth::user()->is_login == 1) {
            //     Auth::logout();
            //     return response()->json(['error' => true, 'msg' => "You are already login some where else .First logout there."]);
            // }

            // User::where('id', Auth::id())->update([
            //     "is_login" => 1,
            //     "ip_address" => getBrowserName($user_agent),
            //     "ippp" => request()->ip()

            // ]);
            User::find(Auth::id())->update(array('last_login_attempt_time' => (\Carbon\Carbon::now())->toDateTimeString()));
            UserLoggedIn::dispatch(Auth::id(), 1,2,'sport_welfare_registration_master');
            session()->flash('success', 'You have successfully logged in.');
            if (User::find(Auth::id())->password_change_status == "1") {
                return response()->json(['error' => false, "route" => route('fachangePassword'), 'msg' => "You have successfully logged in."]);
            }
            if(User::find(Auth::id())->profile_complete == "1"){
                // dd(DB::table('laxman_award')->where('user_id', Auth::id())->exists());
                if((DB::table('financial_assistance')->where('user_id', Auth::id())->exists()) || DB::table('monthly_pension')->where('user_id', Auth::id())->exists()){
                 return response()->json(['error' => false, 'route'=>"dashboard",'msg' => "You have successfully logged in."]);

                }
                else{
                    return response()->json(['error' => false, 'route'=>"financial-assistance/applyFor",'msg' => "You have successfully logged in."]);

                }
            }
            else{
                return response()->json(['error' => false, 'route'=>"financial-assistance/profile_detail",'msg' => "You have successfully logged in."]);

            }
        }

        return response()->json(['error' => true, 'msg' => "Oops! Invalid Credentials."]);
    }

    /**
     * User Sign Out
     *
     * Guard web Middleware Authorization
     */
    public function signOut()
    {
        UserLoggedIn::dispatch(Auth::id(), 2,2,'sport_welfare_registration_master');
        // User::where('id', Auth::id())->update([
        //     "is_login" => 0,
        //     "ip_address" => request()->ip(),
        // ]);
        Auth::logout();
        return Redirect('/financial-assistance');
    }
    public function changePassword()
    {
        return view('financialAssistance.changePassword');
    }
    public function updatePassword(Request $req)
    {
        $validation = Validator::make($req->all(), [
            'old_password' => 'required',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|min:8|same:password',
        ]);

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

            if (!Hash::check($req->old_password, Auth::user()->password))
            return response()->json(["error" => true, "msg" => "The old password does not match our records."]);

            if (Hash::check($req->password, Auth::user()->password))
                return response()->json(["error" => true, "msg" => "Old password and New password cannot be same"]);



            $checkold =  DB::table('change_password_log')->where('type', 4)->where('email',Auth::user()->email )->where('user_id',Auth::user()->id)->take(3)->orderByDesc('id')->get();


            if($checkold){
                foreach ($checkold as $key => $value) {
                    if($value->password == $req->password){
                     return response()->json(["error" => true, "msg" => "Old password cannot be same"]);

                    }
                }
            }
           ChangePasswordLog::dispatch(4, Auth::user()->id,Auth::user()->email, $req->password );



            DB::table('sport_welfare_registration_master')->where('id', Auth::id())->update([
                'password' => Hash::make($req->password),
                'user_password' => $req->password,
                'password_change_status' =>2
            ]);
            $check= SmsMail::dispatch([
                "password" => $req->password,
                "email" => Auth::user()->email,
                "mobile" => Auth::user()->mobile
            ], 4);
            Auth::logout();
            session()->flash('success', 'Password Successfully changed.');
            return response()->json(["error" => false, "url" => url('/financial-assistance')]);
    }
    public function preRegistration(Request $req)
    {
        //|regex:/^[a-zA-Z]+$/
        $required = [
            'fname'  => 'required',
            // 'sport_type'       => 'required',
            // 'sport_position'       => 'required',
            'captcha' => 'required',
            'native_of_up'       => 'required',
            'mobile'        => 'required|numeric|digits:10',
            'email'         => 'required|email',

        ];

        if ($req->captcha != $req->capchaCode)
        return response()->json(['error' => true, 'msg' => "Oops! Invalid Captcha Code."]);


        $validation = Validator::make($req->all(), $required, msg());

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        // if ($req->captcha != $req->capchaCode)
        //     return response()->json(['error' => true, 'msg' => "Oops! Invalid Captcha Code."]);

        // if (DB::table('sport_welfare_registration_master')->where('email', $req->email)->where('role', $req->role)->exists())
        if (DB::table('sport_welfare_registration_master')->join("sport_welfare_user_type_master","sport_welfare_registration_master.id","=","sport_welfare_user_type_master.user_id")->where('sport_welfare_user_type_master.registered_for', "FINANCIAL")->where('sport_welfare_registration_master.email', $req->email)->exists())
            return response()->json(['error' => true, 'msg' => "Entered Email ID is already registered on this Portal. Please try another Email ID."]);

        // if (DB::table('sport_welfare_registration_master')->where('mobile', $req->mobile)->where('role', $req->role)->exists())
        if (DB::table('sport_welfare_registration_master')->join("sport_welfare_user_type_master","sport_welfare_registration_master.id","=","sport_welfare_user_type_master.user_id")->where('sport_welfare_user_type_master.registered_for', "FINANCIAL")->where('sport_welfare_registration_master.mobile', $req->mobile)->exists())
            return response()->json(['error' => true, 'msg' => "Entered Mobile No. is already registered on this Portal. Please try another Mobile No."]);

            $pwd = rand(11111111,99999999);
        $id = DB::table('sport_welfare_registration')->insertGetId([
            // 'sport_type' => $req->sport_type,
            'fullname'       => $req->fname,
            // 'sport_position'  => $req->sport_position,
            'native_of_up'  => $req->native_of_up,
            'mobile'        => $req->mobile,
            'email'         => $req->email,
            'role'         => $req->role,
            'password'      => Hash::make($pwd),
            'user_password' => $pwd,
        ]);

       $otp = rand(111111, 999999);
       //$otp = 123456;
        DB::table('user_otp')->insert([
            "pre_reg_id"    => $id,
            "mobile"        => $req->mobile,
            "otp"           => $otp
        ]);

        session()->put('mobile', $req->mobile);
        session()->put('email', $req->email);
        session()->put('form_type', 4);

        SmsMail::dispatch([
            "otp" => $otp,
            "email" => $req->email,
            "mobile" => $req->mobile
        ], 1);

        return response()->json(["error" => false, "msg" => "SuccessFully Registered", "url" => route('faotp')]);
    }

    public function otpVerify(Request $req)
    {
        // dd($req->all());
        $validation = Validator::make($req->all(), [
            'otp1' => 'required',
            'otp2' => 'required',
            'otp3' => 'required',
            'otp4' => 'required',
            'otp5' => 'required',
            'otp6' => 'required',
        ], msg());

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

                $otp = $req->otp1 . $req->otp2 . $req->otp3 . $req->otp4 . $req->otp5 . $req->otp6;
                $mobile = session()->get('mobile');
                $table = DB::table('user_otp')->where('mobile', $mobile)->where('otp', $otp)->orderBy('id', 'DESC')->limit(1);

               if ($table->exists()) {
                    $reg_id = $table->first()->pre_reg_id;
                    // DB::table('sport_welfare_registration_master')->insertUsing([
                    //     'sport_type', 'fullname',  'role', 'native_of_up', 'mobile', 'email', 'password', 'user_password'
                    // ],
                    // DB::table('sport_welfare_registration')->select(
                    //     'sport_type',
                    //     'fullname',
                    //     // 'sport_position',
                    //     'role',
                    //     'native_of_up',
                    //     'mobile',
                    //     'email',
                    //     'password',
                    //     'user_password'
                    // )->where('id', $reg_id));

                    $data_old= DB::table('sport_welfare_registration')->select(
                        'sport_type',
                        'fullname',
                        // 'sport_position',
                        'role',
                        'native_of_up',
                        'mobile',
                        'email',
                        'password',
                        'user_password'
                    )->where('id', $reg_id)->first();

                    if (DB::table('sport_welfare_registration_master')->where('email', $data_old->email)->exists()){
                        $id=(DB::table('sport_welfare_registration_master')->select('id')->where('email', $data_old->email)->first())->id;
                        // dd($id);
                    }else{
                        $id = DB::table('sport_welfare_registration_master')->insertGetId([
                            'fullname'       => $data_old->fullname,
                            'native_of_up'  => $data_old->native_of_up,
                            'mobile'        => $data_old->mobile,
                            'email'         => $data_old->email,
                            'password'      => $data_old->password,
                            'user_password' => $data_old->user_password,
                            'login_from'=> 1
                        ]);
                     }
                    $id = DB::table('sport_welfare_user_type_master')->insertGetId([
                        'user_id'       => $id,
                        'registered_for'  => 'FINANCIAL'
                    ]);


                    SmsMail::dispatch(["id" => $reg_id], 2);

                    session()->put('mobile', 000);
                    return response()->json(["error" => false, "msg" => "Thank You. You Are SuccessFully Registered", "url" => url('/financial-assistance')]);
                }

                return response()->json(["error" => true, "msg" => "Oops! Invalid OTP  Please try again ."]);

    }

    public function profile_detail(Request $request)
    {


        if(User::find(Auth::id())->profile_complete == "1"){
            // session()->flash('success', 'You Successfully Login.');
            return redirect('/financial-assistance/edit_profile_detail');
         }
        $user = User::where('id', Auth::id())->first();
        $sport_type = DB::table('sport_type')->get();
        $country = DB::table('countries')->get();
        $state=DB::table('states')->orderBy('name','ASC')->get();
        $city=DB::table('cities')->orderBy('city','ASC')->get();
        $all_city=DB::table('cities')->where('state_id','23')->orderBy('city','ASC')->get();
        return view('financialAssistance.profile_detail', compact('user', 'country','state','all_city','sport_type'));
    }

    public function edit_profile_detail()
    {
        $user = User::where('id', Auth::id())->first();
        $sport_type = DB::table('sport_type')->get();
        $country = DB::table('countries')->get();
        $all_city=DB::table('cities')->where('state_id','23')->orderBy('city','ASC')->get();
        $state=DB::table('states')->orderBy('name','ASC')->get();

        return view('financialAssistance.edit_profile_detail', compact('user', 'country','state','all_city','sport_type'));
    }
    public function compProfile(Request $req)
    {

        //dd($req->all());
        $end = date('d/m/Y', strtotime('-18 years'));
       // dd($req->dob);  //30/03/2017 //01/03/2017
        $required = [
            //  'dob'             => 'required|date|date_format:Y/m/d|before:'.$end,
           'dob'             => 'required',
            'place_of_birth'            => 'required',
            'gender'         => 'required',
            "marital_status"       => 'required',
            "nationality"    => 'required',
            // "religion"       => 'required',
            "mother_name" => 'required',
            'father_name'           => 'required',
            'permanent_address'             => 'required',
            // 'permanent_state'          => 'required',
            'permanent_district'           => 'required',
            'present_address'           => 'required',
             'present_state'           => 'required',
            'present_district'           => 'required',
            'present_pincode'           => 'required|numeric|digits:6',
            'permanent_pincode'           => 'required|numeric|digits:6',
            'aadhar_no'           => 'required|numeric|digits:12',
            //new column
            'association_certificate'                 => 'required',
            'association_certificate_upload'            => 'nullable|mimes:pdf,jpg,jpeg|max:2000',

            'sport_type'            => 'required',
            'category'            => 'required',
            // 'achievement'            => 'required',
            // 'domicile_certificate'                 => 'required|mimes:pdf,png,jpg,jpeg|max:2000',
            // 'qualification_doc'                 => 'required|mimes:pdf,png,jpg,jpeg|max:2000',
            'aadhar_card'                 => 'required|mimes:pdf,png,jpg,jpeg|max:2000',
            'photograph'                 => 'required|mimes:png,jpg,jpeg|max:2000',
            'signature'                 => 'required|mimes:png,jpg,jpeg|max:2000',
            // 'guardian_signature'                 => 'required|mimes:pdf,png,jpg,jpeg|max:2000',
        ];

       // $data['gstno'] = 'required|regex:/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/';

        $validation = Validator::make($req->all(), $required, msg());

// dd($validation->errors()->first());

        if ($validation->fails())
             return redirect('/financial-assistance/profile_detail')->withInput($req->all())->with('error', $validation->errors()->first());

        // $domicile_certificate = "{$req->domicile_certificate->getClientOriginalName()}";
        // $path = $req->file('domicile_certificate')->storeAs('direct_recruitment', $domicile_certificate, 'public');

        // $qualification_doc = "{$req->qualification_doc->getClientOriginalName()}";
        // $path = $req->file('qualification_doc')->storeAs('direct_recruitment', $qualification_doc, 'public');

        $aadhar_card = date('His').$req->aadhar_card->getClientOriginalName();
        $path = $req->file('aadhar_card')->storeAs('award', $aadhar_card, 'public');

        $photograph = date('His').$req->photograph->getClientOriginalName();
        $path = $req->file('photograph')->storeAs('award', $photograph, 'public');

        $signature = date('His').$req->signature->getClientOriginalName();
        $path = $req->file('signature')->storeAs('award', $signature, 'public');

         //new column
             if($req->association_certificate_upload){
                $association_certificate_upload = date('His').$req->association_certificate_upload->getClientOriginalName();
                // dd($medical_certificate);
                $path = $req->file('association_certificate_upload')->storeAs('financial_assistance', $association_certificate_upload, 'public');
            }
            else{
                $association_certificate_upload = $req->association_certificate_upload;
            }

        // $guardian_signature = "{$req->guardian_signature->getClientOriginalName()}";
        // $path = $req->file('guardian_signature')->storeAs('direct_recruitment', $guardian_signature, 'public');

        $check = DB::table('sport_welfare_registration_master')->where('id', Auth::id())->update([
            // 'user_id' =>Auth::id(),
            'fullname' =>$req->full_name,
            'mobile' =>$req->contact_no,
            'email' =>$req->email_id,
            'mother_name' =>$req->mother_name,
            'father_name' =>$req->father_name,
            'sport_type' =>$req->sport_type,
            'category' =>$req->category,
            'dob' =>$req->dob,
            'place_of_birth' =>$req->place_of_birth,
            'gender' =>$req->gender,
            'marital_status' =>$req->marital_status,
            'nationality' =>$req->nationality,
            // 'religion' =>$req->religion,
            'aadhar_no' =>$req->aadhar_no,

            // 'domicile_certificate'      => $req->domicile_certificate->getClientOriginalName(),
            // 'qualification_doc'      => $req->qualification_doc->getClientOriginalName(),
            'aadhar_doc'      => $aadhar_card,
            'photograph_doc'      => $photograph,
            'signature_doc'      => $signature,
            // 'guardian_signature'      => $req->guardian_signature->getClientOriginalName(),

            //new
            'association_certificate'      => $req->association_certificate,
            'association_certificate_upload'      => $association_certificate_upload,

            'present_address' =>$req->present_address,

             'present_state' =>$req->present_state,
            'present_district' =>$req->present_district,
            'present_pincode' =>$req->present_pincode,
            'permanent_address' =>$req->permanent_address,
            // 'permanent_state' =>$req->permanent_state,
            'permanent_district' =>$req->permanent_district,
            'permanent_pincode' =>$req->permanent_pincode,

            'created_at' =>  date('d/m/Y')
                ]);


        if($check)
        {
            User::find(Auth::id())->update(array('profile_complete' => 1));
            session()->flash('success', 'Profile Successfully Updated.');
            return redirect('/financial-assistance/applyFor')->with('success', 'Basic Detail Successfully Updated.');
            // return redirect('/financial-assistance/form')->with('success', 'Basic Detail Successfully Updated.');

        }
        else{
            session()->flash('error', 'Profile Not Updated.');
            return redirect('/financial-assistance/profile_detail')->with('error', 'Basic Detail Profile Not Updated.');

        }
    }


    public function updateProfile(Request $req)
    {


        $end = date('d/m/Y', strtotime('-18 years'));
       // dd($req->dob);  //30/03/2017 //01/03/2017
        $required = [
            //  'dob'             => 'required|date|date_format:Y/m/d|before:'.$end,
           'dob'             => 'required',
            'place_of_birth'            => 'required',
            'gender'         => 'required',
            "marital_status"       => 'required',
            "nationality"    => 'required',
            // "religion"       => 'required',
            "mother_name" => 'required',
            'father_name'           => 'required',
            'permanent_address'             => 'required',
            // 'permanent_state'          => 'required',
            'permanent_district'           => 'required',
            'present_address'           => 'required',
             'present_state'           => 'required',
            'present_district'           => 'required',
            'present_pincode'           => 'required|numeric|digits:6',
            'permanent_pincode'           => 'required|numeric|digits:6',
            'aadhar_no'           => 'required|numeric|digits:12',

            'sport_type'            => 'required',
            'category'            => 'required',

            //new column
            'association_certificate'                 => 'required',
            'association_certificate_upload'            => 'nullable|mimes:pdf,jpg,jpeg|max:2000',
            // 'achievement'            => 'required',
            // 'domicile_certificate'                 => 'required|mimes:pdf,png,jpg,jpeg|max:2000',
            // 'qualification_doc'                 => 'required|mimes:pdf,png,jpg,jpeg|max:2000',
            'aadhar_card'                 => 'nullable|mimes:pdf,png,jpg,jpeg|max:2000',
            'photograph'                 => 'nullable|mimes:png,jpg,jpeg|max:2000',
            'signature'                 => 'nullable|mimes:png,jpg,jpeg|max:2000',
            // 'guardian_signature'                 => 'required|mimes:pdf,png,jpg,jpeg|max:2000',
        ];

       // $data['gstno'] = 'required|regex:/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/';

        $validation = Validator::make($req->all(), $required, msg());

// dd($validation->errors()->first());

        if ($validation->fails())
             return redirect('/financial-assistance/edit_profile_detail')->withInput($req->all())->with('error', $validation->errors()->first());

        // $domicile_certificate = "{$req->domicile_certificate->getClientOriginalName()}";
        // $path = $req->file('domicile_certificate')->storeAs('direct_recruitment', $domicile_certificate, 'public');

        // $qualification_doc = "{$req->qualification_doc->getClientOriginalName()}";
        // $path = $req->file('qualification_doc')->storeAs('direct_recruitment', $qualification_doc, 'public');
        if($req->aadhar_card){
            $aadhar_card = date('His').$req->aadhar_card->getClientOriginalName();
            $path = $req->file('aadhar_card')->storeAs('award', $aadhar_card, 'public');
        }
        else{
            $aadhar_card =$req->aadhar_card1;
        }

        if($req->photograph){
            $photograph = date('His').$req->photograph->getClientOriginalName();
            $path = $req->file('photograph')->storeAs('award', $photograph, 'public');
        }
        else{
            $photograph =$req->photograph1;
        }

        if($req->signature){
            $signature = date('His').$req->signature->getClientOriginalName();
        $path = $req->file('signature')->storeAs('award', $signature, 'public');
        }
        else{
            $signature =$req->signature1;
        }


         //new column
             if($req->association_certificate_upload){
                $association_certificate_upload = date('His').$req->association_certificate_upload->getClientOriginalName();
                // dd($medical_certificate);
                $path = $req->file('association_certificate_upload')->storeAs('financial_assistance', $association_certificate_upload, 'public');
            }
            else{
                $association_certificate_upload = $req->association_certificate_upload;
            }

        // $guardian_signature = "{$req->guardian_signature->getClientOriginalName()}";
        // $path = $req->file('guardian_signature')->storeAs('direct_recruitment', $guardian_signature, 'public');

        // $check = DB::table('sport_welfare_registration_master')->where('id', Auth::id())->updateOrInsert([
            // 'user_id' =>Auth::id(),
            // 'fullname' =>$req->full_name,
            // 'mobile' =>$req->contact_no,
            // 'email' =>$req->email_id,
            $data=[
            'mother_name' =>$req->mother_name,
            'father_name' =>$req->father_name,
            'sport_type' =>$req->sport_type,
            'category' =>$req->category,
            'dob' =>$req->dob,
            'place_of_birth' =>$req->place_of_birth,
            'gender' =>$req->gender,
            'marital_status' =>$req->marital_status,
            'nationality' =>$req->nationality,
            // 'religion' =>$req->religion,
            'aadhar_no' =>$req->aadhar_no,

            'aadhar_doc'      => $aadhar_card,
            'photograph_doc'      => $photograph,
            'signature_doc'      => $signature,

            'present_address' =>$req->present_address,

            'present_state' =>$req->present_state,
            'present_district' =>$req->present_district,
            'present_pincode' =>$req->present_pincode,
            'permanent_address' =>$req->permanent_address,
            // 'permanent_state' =>$req->permanent_state,
            'permanent_district' =>$req->permanent_district,
            //new
            'association_certificate'      => $req->association_certificate,
            'association_certificate_upload'      => $association_certificate_upload,
            'permanent_pincode' =>$req->permanent_pincode
            // 'created_at' =>  date('d/m/Y')
                ];

                $check = DB::table('sport_welfare_registration_master')->where('id', Auth::id())->update($data);
        // if($check)
        // {
            User::find(Auth::id())->update(array('profile_complete' => 1));

            session()->flash('success', 'Profile Successfully Updated.');

            if( DB::table('user_award_apply_master')->where('user_id', Auth::user()->id)->whereIn('award_type_id', [4,5])->exists()){
                return Redirect('/dashboard');

            }else{
                return redirect('/financial-assistance/applyFor')->with('success', 'Basic Detail Successfully Updated.');
            }



            // return redirect('/financial-assistance/form')->with('success', 'Basic Detail Successfully Updated.');

        // }
        // else{
        //     session()->flash('error', 'Profile Not Updated.');
        //     return redirect('/financial-assistance/profile_detail')->with('error', 'Basic Detail Profile Not Updated.');

        // }
    }

    public function applyFor()
    {
        $articles =DB::table('user_award_apply_master')
        ->select('award_type_id')
        ->where('user_id', Auth::id())
        ->where('status', 1)
        ->get();
        $aa=array();
        foreach ($articles as $sku){
            $aa[]=$sku->award_type_id;
            }
        $user = User::where('id', Auth::id())->first();
        $award_type = DB::table('award_type')->whereNotIn('id',$aa)->whereIn('id',['4','5'])->get();


        return view('financialAssistance.applyfor', compact('user','award_type'));
    }

    public function saveApplyFor(Request $req)
    {
        $required = [

            'applyfor'           => 'required'
        ];
    // dd($req->applyfor);
        $validation = Validator::make($req->all(), $required, msg());
        if ($validation->fails())
            // return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
            return redirect('/applyFor')->with('error', $validation->errors()->first());
            $check = DB::table('user_award_apply_master')->insertGetId(array(
                'user_id' =>Auth::id(),
                'award_type_id' =>$req->applyfor,
                'created_at' =>  date('Y-m-d h:i:s')
                ));
            if($check)
            {

                if($req->applyfor == "4")
                return redirect('/financial-assistance');
                if($req->applyfor == "5")
                return redirect('/monthlyPension_form');

            }
    }
    public function dashboard()
    {

        $financial_assistance =DB::table('sport_welfare_registration_master as swrm')
                ->join('financial_assistance', 'swrm.id', '=', 'financial_assistance.user_id')
                ->join('sport_type', 'swrm.sport_type', '=', 'sport_type.id')
                // ->join('query_master', 'swrm.id', '=', 'query_master.user_id')
                ->select('financial_assistance.query_doc','financial_assistance.application_no','financial_assistance.is_mark_query','financial_assistance.amount_release_status','financial_assistance.form_status','financial_assistance.created_at','financial_assistance.final_submit','financial_assistance.id as applicant_id','swrm.fullname','swrm.mobile','swrm.email','sport_type.name')
                ->where('swrm.id', Auth::id())
                ->get();
    //    dd($monthly_mark_status);
        $monthly_pension =DB::table('sport_welfare_registration_master as swrm')
        ->join('monthly_pension', 'swrm.id', '=', 'monthly_pension.user_id')
        ->join('sport_type', 'swrm.sport_type', '=', 'sport_type.id')
        ->select('monthly_pension.is_mark_query','monthly_pension.application_no','monthly_pension.amount_release_status','monthly_pension.form_status','monthly_pension.created_at','monthly_pension.final_submit','monthly_pension.id as applicant_id','swrm.fullname','swrm.mobile','swrm.email','sport_type.name')
        ->where('swrm.id', Auth::id())
        ->get();

//jyoti
        $finalsubmit = '';
        $finan = '';
         if (DB::table('monthly_pension')->exists()) {
            $finalsubmit = DB::table('monthly_pension')
             ->select('user_id','final_submit')
             ->where('user_id', Auth::id())
             ->first();
         }

         if (DB::table('financial_assistance')->exists()) {
            $finan = DB::table('financial_assistance')
             ->select('user_id','final_submit')
             ->where('user_id', Auth::id())
             ->first();
         }
        // dd($finalsubmit);

//endfinalstatus check
        return view('financialAssistance.dashboard', compact('financial_assistance','monthly_pension','finalsubmit','finan'));
    }
    public function form()
    {
        $user = User::where('id', Auth::id())->first();
        $sport_type = DB::table('sport_type')->get();
        $country = DB::table('countries')->get();
        $state=DB::table('states')->orderBy('name','ASC')->get();
        $city=DB::table('cities')->orderBy('city','ASC')->get();
    //    dd($user);
        $selected_sport = DB::table('sport_welfare_registration_master')->select('sport_type')->where('id', Auth::id())->get()[0]->sport_type;

        return view('financialAssistance.financial_assistance_form', compact('user', 'country','state','city','sport_type','selected_sport'));
    }

    //ifsc
    public function ifsc(Request $req)
    {
     //dd($req->ifsc);
        $curl = curl_init();

        curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://ifsc.razorpay.com/'.$req->ifsc,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
        }
         curl_close($curl);
         if(json_decode($response) == null){
            return response()->json(['error' => true,'msg'=>$error_msg]);

         }else{
            return response()->json(['error' => false,'data'=>json_decode($response)]);

         }
        //  dd(json_decode($response)) ;

        //return view('financialAssistance.financial_assistance_form', compact('user', 'country','state','city','sport_type','selected_sport'));
    }

    public function save_financial_assistance(Request $req)
    {
        //dd($req->all());
        return FinancialAssistance_Model::preRegistration($req);

    }

    public function financialformPreview($appNo="")
    {
// dd($appNo);
        $articles =DB::table('sport_welfare_registration_master as swrm')
                ->join('financial_assistance as la', 'swrm.id', '=', 'la.user_id')
                ->join('sport_type as st', 'la.sport_type', '=', 'st.id')
                ->select('swrm.fullname','swrm.email','swrm.mobile','swrm.gender','swrm.association_certificate', 'swrm.association_certificate_upload',
                'st.name as sport_name','swrm.place_of_birth','swrm.dob','swrm.nationality',
                'la.qualification','la.qualification_doc','la.domicile_certificate','la.monthly_income_personal',
                'la.income_certificate','la.dmc_income_verification','la.level_of_report','la.relevant_certificate',
                'la.application_no','la.other_achievements','la.document_other_achievements','la.document_justifying_achievements','la.total_professional_experience',
                'la.is_editable','la.form_status','la.experience_sports_association','la.document_justifying_experience','la.income_other_sources','la.income_document_other_sources',
                'la.amount_release','la.amount_release_status','la.details_of_assistance_benefits','la.relevant_documents_justifing_assistance','la.physical_condition','la.medical_certificate',
                'la.dope_test','la.court_case','la.final_submit','la.guardian_signature','la.bank_name','la.bank_branch','la.bank_acc_no','la.bank_ifsc','la.acc_holder_name','la.pan','la.mobile_registered_in_bank','la.other_relevant_information_applicant','la.created_at',
                'swrm.signature_doc','swrm.photograph_doc','swrm.marital_status','swrm.religion','swrm.aadhar_no','swrm.father_name','swrm.mother_name','swrm.present_address','swrm.present_state','swrm.present_district','swrm.present_pincode','swrm.permanent_address','swrm.permanent_state','swrm.permanent_district','swrm.permanent_pincode','swrm.present_flat_no','swrm.permanent_flat_no')
                ->where('swrm.id', Auth::id())
                ->where('la.application_no', $appNo)
                ->get();

        $sport_achievement =DB::table('sport_achievement_master')
                    ->select('*')
                    ->where('user_id', Auth::id())
                    ->where('application_no', $appNo)
                    ->where('award_id', 4)
                    ->get();
                //  dd($articles);

        $userId = Auth::id();
        $user = User::where('id', $userId)->first();
        $queryData = DB::table('query_master')->where('form_type',4)->where('user_id',$userId)->orderBy('id','DESC')->get();

        return view('financialAssistance.preview_financial_assistance_form', compact('user','articles','sport_achievement','queryData'));
    }

    public function edit_financialform(Request $req)
    {
        $user = User::where('id', Auth::id())->first();
        $sport_type = DB::table('sport_type')->get();
        $financial_assistance = DB::table('financial_assistance')->select('*')->where('user_id', Auth::id())->where('application_no', $req->id)->get();
        $sport_achievement =DB::table('sport_achievement_master')->select('*')->where('user_id', Auth::id())->where('award_id',4)->where('application_no', $req->id)->get();
        return view('financialAssistance.edit_financialform',compact('sport_type','financial_assistance','sport_achievement','user'));


    }
    public function updatefinancialform(Request $req)
    {
        return FinancialAssistance_Model::update_updatefinancialform($req);

    }
    public function finalSubmit(Request $req)
    {

        $table = DB::table('isp_common_detail')->where('user_id',Auth::id())->where('email', Auth::user()->email)->where('type', 'FINANCIAL ASSISTANCE')->whereNull('main_table_id')->update(['main_table_id'=>$req->id]);




        $isp = isp_common_detail(Auth::user()->id,Auth::user()->email, 'FINANCIAL ASSISTANCE', $req->id);

        if($isp){



         $url= env('ISP_URl');

         $secretkey = env('ISP_SECRET_KEY');

         $tokenpassword = env('ISP_TOKEN_PASSWORD');
         $dept_id = env('ISP_DEPT_ID');


         $postData = array (
             "username"=>  $dept_id,
             "password"=>  $tokenpassword
         );



         $response = json_decode(getToken( $url.'/ispws/authenticate', json_encode($postData)));

        $token=$response->token;
         $returnServiceStatus = new ReturnServiceStatus();
         $returnServiceStatus->set_applicant_id($isp->applicant_id);
         $returnServiceStatus->set_request_id($isp->request_id);
         $returnServiceStatus->set_service_code($isp->service_code);
         $returnServiceStatus->set_application_id($isp->applicant_id);
         $returnServiceStatus->set_status_code("s104");
         $returnServiceStatus->set_remarks("Application Submitted");
         $returnServiceStatus->set_pendency_level("10");
         $returnServiceStatus->set_action_taken_time( date("Y-m-d h:i:s"));
         $returnServiceStatus->set_pending_with_officer("NA");
         $returnServiceStatus->selected_district_for_processing_application($isp->permanent_district);
         $returnServiceStatus->designated_code("452");
         $returnServiceStatus->designated_location_code(isp_division(Auth::user()->permanent_district));
         $returnServiceStatus->designated_target_date(date('Y-m-d', strtotime("+30 days")));



         $e_data = encryptString(json_encode($returnServiceStatus),$secretkey);

         $finalLoad = array(
             "dept_id"=> $dept_id,
             "e_data"=> $e_data
         );

         $response = callIspWs( $url.'/ispws/isp/v1/returnApplicationAcknowledgement', json_encode($finalLoad),$token );

         $Data_enc= json_decode($response)->data;

         $Data_dsc= json_encode(decryptString($Data_enc,$secretkey));


        };
        if(Auth::user()->registered_from == 2){

            $check = DB::table('financial_assistance')->where('user_id', Auth::id())->first();

           $url = 'http://164.100.181.28/DeptWebIntService/Service.asmx?op=SendResponse';
           $rKey= $check->RequestKey_edistrict;

           $depId= '5EA45F3FA6BD786D7E1024431E03961D';
           $serviceCode = $check->serviceCode_edistrict;
           $application = $check->application_no;
           $main_xml_str = '<?xml version="1.0" encoding="utf-8"?><soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/"><soap:Body><SendResponse xmlns="http://tempuri.org/"><RequestKey>'.$rKey.'</RequestKey><DeptRegistraionID>'.$depId.'</DeptRegistraionID><ApplicationNo>'.$application.'</ApplicationNo><serviceCode>'.$serviceCode.'</serviceCode></SendResponse></soap:Body></soap:Envelope>';

           $call_api = call_curlApi($main_xml_str,$url,'Response');

           $xmlStr = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $call_api);
           $xml = simplexml_load_string($xmlStr);
           $json = json_encode($xml);

           $array = json_decode($json,TRUE);

           $check = $array['soapBody']['SendResponseResponse']['SendResponseResult'];

           $xmlStr = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $check);
           $xml = simplexml_load_string($xmlStr);
           $json = json_encode($xml);

           $array = json_decode($json,TRUE);
            if($array['ReturnType']!= 1){
                session()->flash('error', 'Technical Issue.');
                return;
            }



          };


        $check = DB::table('financial_assistance')->where('user_id', Auth::id())->where('application_no', $req->id)->update([

            'final_submit' =>1,
            'is_editable' =>2,
        ]);

// e_district integration



        StatusChangeLog::dispatch(4,Auth::id(),"","Form Submitted","sport_welfare_registration_master");
        if($check)
            session()->flash('success', 'Successfully Submitted.');
       return $check;
    }


    public function monthlyPension_form()
    {
        $user = User::where('id', Auth::id())->first();
        $sport_type = DB::table('sport_type')->get();
        $country = DB::table('countries')->get();
        $state=DB::table('states')->orderBy('name','ASC')->get();
        $city=DB::table('cities')->orderBy('city','ASC')->get();
        $selected_sport = DB::table('sport_welfare_registration_master')->select('sport_type')->where('id', Auth::id())->get()[0]->sport_type;
        //dd($user->dob);
        // explode(" ",$str)
        $dob=(explode('/',$user->dob))[2];

        //$dob=$user->dob[2];

//    dd( $user);
        return view('financialAssistance.monthlyPension_form', compact('selected_sport','dob','user', 'country','state','city','sport_type'));
    }

    public function save_monthlyPension(Request $req)
    {
        return FinancialAssistance_Model::save_monthlyPension($req);

    }

    public function monthlypensionformpreview($appNo="")
    {
        $articles =DB::table('sport_welfare_registration_master as swrm')
                ->join('monthly_pension as la', 'swrm.id', '=', 'la.user_id')
                ->join('sport_type as st', 'la.sport_type', '=', 'st.id')
                ->select('swrm.fullname','swrm.email','swrm.mobile','swrm.gender','swrm.association_certificate', 'swrm.association_certificate_upload',
                'st.name as sport_name','swrm.place_of_birth','swrm.dob','swrm.nationality',
                'la.is_editable','la.amount_release','la.amount_release_status','la.form_status','la.application_no','la.award_year','la.award_certificate','la.domicile_certificate','la.honoured_award','la.bank_name','la.bank_branch','la.bank_acc_no','la.bank_ifsc','la.acc_holder_name','la.pan','la.mobile_registered_in_bank','la.other_relevant_information_applicant','la.created_at','la.final_submit',
                'swrm.signature_doc','swrm.photograph_doc','swrm.marital_status','swrm.religion','swrm.aadhar_no','swrm.father_name','swrm.mother_name','swrm.present_address','swrm.present_state','swrm.present_district','swrm.present_pincode','swrm.permanent_address','swrm.permanent_state','swrm.permanent_district','swrm.permanent_pincode','swrm.present_flat_no','swrm.permanent_flat_no')
                ->where('swrm.id', Auth::id())
                ->where('la.application_no', $appNo)
                ->get();

        $sport_achievement =DB::table('sport_achievement_master')
                    ->select('*')
                    ->where('user_id', Auth::id())
                    ->where('application_no', $appNo)
                    ->get();
                //  dd($articles);
        $user = User::where('id', Auth::id())->first();
        $userId = Auth::id();
        $queryData = DB::table('query_master')->where('form_type',5)->where('user_id',$userId)->where('application_no', $appNo)->orderBy('id','DESC')->get();


        return view('financialAssistance.monthlypensionformpreview', compact('queryData','user','articles','sport_achievement'));


    }

    public function edit_monthlypensionform(Request $req)
    {

        $user = User::where('id', Auth::id())->first();
        $dob=(explode('/',$user->dob))[2];
        $sport_type = DB::table('sport_type')->get();
        $financial_assistance = DB::table('monthly_pension')->select('*')->where('application_no', $req->id)->get();
        $sport_achievement =DB::table('sport_achievement_master')->select('*')->where('user_id', Auth::id())->where('application_no', $req->id)->get();
        return view('financialAssistance.edit_monthlypensionform',compact('dob','sport_type','financial_assistance','sport_achievement','user'));


    }
    public function profile()
    {
        if (User::find(Auth::id())->password_change_status == "1") {
            return redirect()->route('fachangePassword');
        }
        $user = User::where('id', Auth::id())->first();
       $count=(DB::table('financial_assistance')->where('user_id', Auth::id())->exists() || DB::table('monthly_pension')->where('user_id', Auth::id())->exists());
    //    dd($count);
       $country = DB::table('countries')->get();
        $state=DB::table('states')->orderBy('name','ASC')->get();
        $city=DB::table('cities')->orderBy('city','ASC')->get();
        $form_check=(DB::table('financial_assistance')->where('user_id', Auth::id())->where('final_submit', 1)->exists() || DB::table('monthly_pension')->where('user_id', Auth::id())->where('final_submit', 1)->exists());
    //    dd($form_check);
        return view('financialAssistance.profile', compact('form_check','user', 'country','state','city'));
    }
    public function updatemonthlypensionform(Request $req)
    {
        return FinancialAssistance_Model::updatemonthlypensionform($req);

    }
    public function finalSubmitmonthly(Request $req)
    {
        // dd($req->court_case);
        $check = DB::table('monthly_pension')->where('user_id', Auth::id())->where('application_no', $req->id)->update([

            'final_submit' =>1,
            'is_editable' =>2,
        ]);
        $table = DB::table('isp_common_detail')->where('user_id',Auth::id())->where('email', Auth::user()->email)->where('type', 'MONTHLY PENSION')->whereNull('main_table_id')->update(['main_table_id'=>$req->id]);

        $isp = isp_common_detail(Auth::user()->id,Auth::user()->email, 'MONTHLY PENSION',$req->id);

        if($isp){



         $url= env('ISP_URl');

         $secretkey = env('ISP_SECRET_KEY');

         $tokenpassword = env('ISP_TOKEN_PASSWORD');
         $dept_id = env('ISP_DEPT_ID');


         $postData = array (
             "username"=>  $dept_id,
             "password"=>  $tokenpassword
         );



         $response = json_decode(getToken( $url.'/ispws/authenticate', json_encode($postData)));

        $token=$response->token;
         $returnServiceStatus = new ReturnServiceStatus();
         $returnServiceStatus->set_applicant_id($isp->applicant_id);
         $returnServiceStatus->set_request_id($isp->request_id);
         $returnServiceStatus->set_service_code($isp->service_code);
         $returnServiceStatus->set_application_id($isp->applicant_id);
         $returnServiceStatus->set_status_code("s104");
         $returnServiceStatus->set_remarks("Application Submitted");
         $returnServiceStatus->set_pendency_level("10");
         $returnServiceStatus->set_action_taken_time( date("Y-m-d h:i:s"));
         $returnServiceStatus->set_pending_with_officer("NA");
         $returnServiceStatus->selected_district_for_processing_application($isp->permanent_district);
         $returnServiceStatus->designated_code("452");
         $returnServiceStatus->designated_location_code(isp_division(Auth::user()->permanent_district));
         $returnServiceStatus->designated_target_date(date('Y-m-d', strtotime("+30 days")));



         $e_data = encryptString(json_encode($returnServiceStatus),$secretkey);

         $finalLoad = array(
             "dept_id"=> $dept_id,
             "e_data"=> $e_data
         );

         $response = callIspWs( $url.'/ispws/isp/v1/returnApplicationAcknowledgement', json_encode($finalLoad),$token );

         $Data_enc= json_decode($response)->data;

         $Data_dsc= json_encode(decryptString($Data_enc,$secretkey));


        };
        StatusChangeLog::dispatch(5,Auth::id(),"","Form Submitted","sport_welfare_registration_master");
        if($check)
            session()->flash('success', 'Successfully Submitted.');
       return $check;
    }

}

/*
class ISPApplicantData {

	public $request_id;
	public  $dept_id;
}
*/

/*
 class ISPRequestData {

	public  $dept_id;
	public  $e_data;
}

 class ISPRequestedDataResponse {

	public  $error;
	public  $statusMessage;
	public  $data;
	public  $timestamp;

public function set_data($data) {
    $this->data = $data;
  }
  public function get_data() {
    return $this->data;
  }

  public function set_error($error) {
    $this->error = $error;
  }
  public function get_error() {
    return $this->error;
  }

 public function set_statusMessage($statusMessage) {
    $this->statusMessage = $statusMessage;
  }
  public function get_statusMessage() {
    return $this->statusMessage;
  }

  public function set_timestamp($timestamp) {
    $this->timestamp = $timestamp;
  }
  public function get_timestamp() {
    return $this->timestamp;
  }



}

class ISPRequestIdData{

	public  $request_id;
	public  $applicant_id;
	public  $service_code;
	public  $request_validated;

public function set_request_id($request_id) {
    $this->request_id = $request_id;
  }
  public function get_request_id() {
    return $this->request_id;
  }

  public function set_applicant_id($applicant_id) {
    $this->applicant_id = $applicant_id;
  }
  public function get_applicant_id() {
    return $this->applicant_id;
  }

 public function set_service_code($service_code) {
    $this->service_code = $service_code;
  }
  public function get_service_code() {
    return $this->service_code;
  }





}

class ISPRequestValidate {

	public  $sessionkey;
	public  $dept_id;
}

class ISPResponseApplicantData {

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

class ReturnServiceStatus {

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



    public function designated_code($designated_code) {
        $this->designated_code = $designated_code;
      }

      public function designated_location_code($designated_location_code) {
        $this->designated_location_code = $designated_location_code;
      }


      public function designated_target_date($designated_target_date) {
        $this->designated_target_date = $designated_target_date;
      }


    public function set_request_id($request_id) {
    $this->request_id = $request_id;
  }
 public function getRequest_id() {
    return $this->request_id;
  }

 public function set_applicant_id($applicant_id) {
    $this->applicant_id = $applicant_id;
  }
  function get_applicant_id() {
    return $this->applicant_id;
  }

public function set_service_code($service_code) {
    $this->service_code = $service_code;
  }
  public function get_service_code() {
    return $this->service_code;
  }

public function set_application_id($application_id) {
    $this->application_id = $application_id;
  }
  public function get_application_id() {
    return $this->application_id;
  }

public function set_status_code($status_code) {
    $this->status_code = $status_code;
  }
  public function get_status_code() {
    return $this->status_code;
  }

public function set_remarks($remarks) {
    $this->remarks = $remarks;
  }
  public function get_remarks() {
    return $this->remarks;
  }

public function set_pendency_level($pendency_level) {
    $this->pendency_level = $pendency_level;
  }
  public function get_pendency_level() {
    return $this->pendency_level;
  }

public function set_action_taken_time($action_taken_time) {
    $this->action_taken_time = $action_taken_time;
  }
  public function get_action_taken_time() {
    return $this->action_taken_time;
  }

public function set_pending_with_officer($pending_with_officer) {
     $this->pending_with_officer = $pending_with_officer;
  }

  public function selected_district_for_processing_application($selected_district_for_processing_application) {
  $this->selected_district_for_processing_application = $selected_district_for_processing_application;
  }


}

class ISPToken {

	public $username;
	public $password;
}

class ISPTokenResponse {

	public $token;
	public $error;
	public $statusMessage;
	public $timestamp;

	public function set_token($token) {
    $this->token = $token;
  }
  public function get_token() {
    return $this->token;
  }

  public function set_error($error) {
    $this->error = $error;
  }
  public function get_error() {
    return $this->error;
  }

 public function set_statusMessage($statusMessage) {
    $this->statusMessage = $statusMessage;
  }
  public function get_statusMessage() {
    return $this->statusMessage;
  }

  public function set_timestamp($timestamp) {
    $this->timestamp = $timestamp;
  }
  public function get_timestamp() {
    return $this->timestamp;
  }

}
*/

