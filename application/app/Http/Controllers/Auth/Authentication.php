<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserLoggedIn;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\AuthModel;
use App\Models\User;
use App\Events\SmsMail;
use App\Events\StatusChangeLog;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class Authentication extends Controller
{

    /**
     * User Sign Up
     */
    public function signUp($serviveCode = null)
    {
        if (Session::get('sessDetails')) {
            $sessDetails = [
                'ReturnType' => Session::get('sessDetails')['ReturnType'],
                'UserName' => Session::get('sessDetails')['UserName'],
                'DCode' => Session::get('sessDetails')['DCode'],
                'RequestKey' => Session::get('sessDetails')['RequestKey'],

                'serviceCode' => $serviveCode,
            ];
            Session::put('sessDetails', $sessDetails);
        }

        $Code1 = rand(11, 99);
        $Code2 = rand(11, 99);
        $capchaCode = $Code1 + $Code2;
        session()->put('capchaCode', $capchaCode);
        return view('auth.signUp', compact('capchaCode', 'Code1', 'Code2'));
    }

    public function forgot(Request $req)
    {
        if ($req->email) {
            $user = DB::table('sport_welfare_registration_master')->join("sport_welfare_user_type_master", "sport_welfare_registration_master.id", "=", "sport_welfare_user_type_master.user_id")->where('sport_welfare_user_type_master.registered_for', "AWARD")->where('sport_welfare_registration_master.email', $req->email)->first();

            if ($user != "") {
                // dd($user->mobile);
                $check = SmsMail::dispatch([
                    "password" => $user->user_password,
                    "email" => $req->email,
                    "mobile" => $user->mobile
                ], 4);
                return response()->json(["error" => false, "msg" => "Password Sent on your mobile successfully."]);
            } else {
                return response()->json(['error' => true, 'msg' => "Email not found"]);
            }
        }

        return view('auth.forgot');
    }
    /**
     * User Login via Otp
     */
    public function otp()
    {
        return view('auth.otp');
    }

    /**
     * User Login Form
     */
    public function loginForm(Request $request)


    {


        if ($request->query('sessionkey')) {

            $url = env('ISP_URl');
            $secretkey = env('ISP_SECRET_KEY');
            $tokenpassword = env('ISP_TOKEN_PASSWORD');
            $dept_id = env('ISP_DEPT_ID');


            $postData = array(
                "username" => $dept_id,
                "password" => $tokenpassword
            );

            $response = json_decode(getToken($url . '/ispws/authenticate', json_encode($postData)));

            $token = $response->token;


            ////////////////////////////////////Calling api getRequestValidatedAndRequestID//////////////////
            $inputData = array(
                "sessionkey" => $request->query('sessionkey')
            );

            $e_data = encryptString(json_encode($inputData), $secretkey);


            $finalLoad = array(
                "dept_id" => $dept_id,
                "e_data" => $e_data
            );


            $response = callIspWs($url . '/ispws/isp/v1/getRequestValidatedAndRequestID', json_encode($finalLoad), $token);

            $Data_enc = json_decode($response)->data;

            $Data_dsc = json_decode(decryptString($Data_enc, $secretkey));


            $request_id = $Data_dsc->request_id;
            $applicant_id = $Data_dsc->applicant_id;
            $service_code = $Data_dsc->service_code;

            session_start();
            $_SESSION["request_id"] = $request_id;
            $_SESSION["applicant_id"] = $applicant_id;
            $_SESSION["service_code"] = $service_code;

            // return redirect()->route('fasignUp');
            //////////////////////////////////////////////////////END///////////////////////

            ////////////////////////////////////Calling api getApplicantCommonDetails//////////////////
            $inputData = array(
                "request_id" => $request_id
            );

            $e_data = encryptString(json_encode($inputData), $secretkey);


            $finalLoad = array(
                "dept_id" => $dept_id,
                "e_data" => $e_data
            );

            $response = callIspWs($url . '/ispws/isp/v1/getApplicantCommonDetails', json_encode($finalLoad), $token);

            $Data_enc = json_decode($response)->data;

            $Data_dsc = json_decode(decryptString($Data_enc, $secretkey));


            //Isp common detail

            $data = [

                'request_id' => $request_id,

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


            if ($Data_dsc->service_code == 'DDQ40') {
                $data['type'] = 'DIRECT RECRUITMENT';
            } elseif ($Data_dsc->service_code == 'LUO55') {
                $data['type'] = 'LAXMAN AND RANI LAXMIBAI AWARD';
            } elseif ($Data_dsc->service_code == 'FYI05') {
                $data['type'] = 'FINANCIAL ASSISTANCE';
            } elseif ($Data_dsc->service_code == 'MRZ51') {
                $data['type'] = 'MONTHLY PENSION';
            } elseif ($Data_dsc->service_code == 'PLW78') {
                $data['type'] = 'PRIZE MONEY';
            }

            session()->put('service_code', $Data_dsc->service_code);
            $user = DB::table('sport_welfare_registration_master')->where('email', $Data_dsc->email)->first();


            if ($user) {

                $id = $user->id;
                $data['user_id'] = $id;
                $isp_common_detail = DB::table('isp_common_detail')->where('user_id', $id)->where('service_code', $Data_dsc->service_code)->where('request_id', $request_id)->first();


                if (!$isp_common_detail) {
                    $isp_common_detail = DB::table('isp_common_detail')->insertGetId($data);
                }
            } else {


                $id = DB::table('sport_welfare_registration_master')->insertGetId([
                    'fullname' => $Data_dsc->first_name_eng . " " . $Data_dsc->middle_name_eng . " " . $Data_dsc->last_name_eng,
                    'native_of_up' => 1,
                    'mobile' => $Data_dsc->mobile,
                    'email' => $Data_dsc->email,
                    'password' => Hash::make('12345678'),
                    'user_password' => '12345678',
                    'login_from' => 3,
                    'password_change_status' => 2

                ]);

                DB::table('sport_welfare_user_type_master')->insertGetId([
                    'user_id'       => $id,
                    'registered_for'  => "AWARD"
                ]);

                $data['user_id'] = $id;
                $isp_common_detail = DB::table('isp_common_detail')->insertGetId($data);
            }


            $log_in = Auth::attempt(['email' => $Data_dsc->email, 'password' => '12345678']);

            if ($log_in) {

                session()->flash('success', 'You have successfully logged in.');

                if (User::find(Auth::id())->profile_complete == "1") {

                    return redirect('/dashboard')->with('success', 'You have successfully logged in.');
                } else {
                    return redirect('/profile_detail')->with('success', 'You have successfully logged in.');
                }
            } else {
                return response()->json(['error' => true, 'msg' => "UnAuthorized User"]);
            }
        }

        $Code1 = rand(11, 99);
        $Code2 = rand(11, 99);
        $capchaCode = $Code1 + $Code2;
        session()->put('capchaCode', $capchaCode);
        $urll = url()->current();
        $contents = explode('/', $urll);
        $last = end($contents);
        $formStatus = getFormStatus(1, $last);
        // registration_closed
        // dd($formStatus);
        // if($formStatus==1){
        return view('auth.login', compact('capchaCode', 'Code1', 'Code2'));
        // }else{
        //     return view('registration_closed');
        // }
    }

    public function reg_form()
    {
        return view('user.applicationform.regform');
    }

    /**
     * User Login
     *
     * Guard web Middleware Authorization
     */
    public function login(Request $req)
    {
        if ($req->type == 0) {
            $name = 'otp_data';
            $error_msg = "Oops! Invalid OTP. /कृपया सही ओटीपी भरें।";
        } else {
            $name = 'password';
            $error_msg = "Oops! Invalid Credentials. /कृपया सही लॉगिन विवरण भरें।";
        }

        $validation = Validator::make($req->all(), [
            'email' => 'required',
            $name => 'required',
            'captcha' => 'required',
        ], msg());

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        if ($req->captcha != $req->capchaCode)
            return response()->json(['error' => true, 'msg' => "Please Enter Valid Captcha./कृपया सही कैप्चा भरें।"]);
        // DB::table('sport_welfare_registration_master')->join("sport_welfare_user_type_master","sport_welfare_registration_master.id","=","sport_welfare_user_type_master.user_id")->where('sport_welfare_user_type_master.registered_for', "AWARD")->where('sport_welfare_registration_master.email', $req->email)->exists()
        // dd($log_in);
        // if (Auth::attempt(['email' => $req->email, 'password' => $req->password])) {
        $encryptedData = $req->password;
        $decryptionKey = "2b7e151628aed2a6abf7158809cf4f3c";
        $keyHex = hex2bin($decryptionKey);
        $req->password = openssl_decrypt(base64_decode($encryptedData), 'AES-128-ECB', $keyHex, OPENSSL_RAW_DATA);
        //  for email

        $mencryptedData = $req->email;
        $mdecryptionKey = "2b7e151628aed2a6abf7158809cf4f3c";
        $mkeyHex = hex2bin($mdecryptionKey);
        $req->email = openssl_decrypt(base64_decode($mencryptedData), 'AES-128-ECB', $mkeyHex, OPENSSL_RAW_DATA);



        if (Session::get('sessDetails')) {


            $data['registered_from'] = 2;
            $data['UserName_edistrict'] = Session::get('sessDetails')['UserName'];


            $edistrict = DB::table('sport_welfare_registration_master')->where('email', $req->email)->where('registered_from', 2)->first();
            if (isset($edistrict->UserName_edistrict) && $edistrict->UserName_edistrict  != Session::get('sessDetails')['UserName']) {
                return response()->json(['error' => true, 'msg' => 'Unauthorized Login Credential.']);
            }
        }






        if ($req->type == 0 && DB::table('sport_welfare_registration_master')->where('email', $req->email)->where('otp', $req->otp_data)->exists()) {
            $check_users = User::where('email', $req->email)->where('otp', $req->otp_data)->first();

            if ($check_users->login_from == 1) {
                $log_in = Auth::attempt(['email' => $req->email, 'password' => $check_users->user_password]);
            } else {
                return response()->json(['error' => true, 'msg' => "Not Authorized to login."]);
            }
        } else {
            // dd($req->password);
            if (DB::table('sport_welfare_registration_master')->where('email', $req->email)->where('login_from', 1)->exists()) {
                $log_in = Auth::attempt(['email' => $req->email, 'password' => $req->password]);
            } else {
                return response()->json(['error' => true, 'msg' => "Not Authorized to login."]);
            }
        }


        if ($log_in) {
            $user_agent = request()->header('User-Agent');

            // print_r( (\Carbon\Carbon::now())->toDateTimeString());exit;
            User::find(Auth::id())->update(array('last_login_attempt_time' => (\Carbon\Carbon::now())->toDateTimeString()));
            UserLoggedIn::dispatch(Auth::id(), 1, 2, 'sport_welfare_registration_master');

            // if (Auth::user()->is_login == 1) {
            //     Auth::logout();
            //     return response()->json(['error' => true, 'msg' => "You are already login some where else .First logout there."]);
            // }

            // User::where('id', Auth::id())->update([
            //     "is_login" => 1,
            //     "ip_address" => getBrowserName($user_agent),
            //     "ippp" => request()->ip()

            // ]);

            // Auth::guard('rsouser')->logout();
            // dd( User::find(Auth::id())->profile_complete);
            session()->flash('success', 'You have successfully logged in.');
            if (User::find(Auth::id())->password_change_status == "1") {
                return response()->json(['error' => false, "route" => route('changePassword'), 'msg' => "You have successfully logged in."]);
            }
            if (User::find(Auth::id())->profile_complete == "1") {
                // session()->flash('success', 'You Successfully Login.');
                return response()->json(['error' => false, 'route' => "dashboard", 'msg' => "You have successfully logged in."]);
            } else {
                return response()->json(['error' => false, 'route' => "profile_detail", 'msg' => "You have successfully logged in."]);
            }
            // session()->flash('success', 'You Successfully Login.');
            // return response()->json(['error' => false, 'msg' => "You Successfully Login."]);
        } else {
            return response()->json(['error' => true, 'msg' => $error_msg]);
        }
    }

    /**
     * User Sign Out
     *
     * Guard web Middleware Authorization
     */
    public function signOut()
    {
        UserLoggedIn::dispatch(Auth::id(), 2, 2, 'sport_welfare_registration_master');

        // User::where('id', Auth::id())->update([
        //     "is_login" => 0,
        //     "ip_address" => request()->ip(),
        // ]);
        $iso_detail = isp_common(Auth::id(), Auth::user()->email);
        Auth::logout();

        if ($iso_detail) {
            return Redirect('http://164.100.181.91/login');
        }


        return Redirect('/');
    }

    /**
     * User Sign Out
     *
     * Guard department Middleware Authorization
     */
    public function signOutsDep()
    {
        UserLoggedIn::dispatch(Auth::id(), 2, 2, 'sport_welfare_registration_master');
        Auth::guard('department')->logout();
        return Redirect('/');
    }

    /**
     * User Sign Out
     *
     * Guard admin Middleware Authorization
     */
    public function signOuts()
    {
        UserLoggedIn::dispatch(Auth::id(), 2, 2, 'sport_welfare_registration_master');
        Auth::guard('admin')->logout();
        return Redirect('/');
    }

    /**
     * User Pre Registration
     */
    public function preRegistration(Request $req)
    {
        //|regex:/^[a-zA-Z]+$/
        $required = [
            'fname' => 'required',
            // 'sport_type'       => 'required',
            // 'sport_position'       => 'required',
            'captcha' => 'required',
            'native_of_up' => 'required',
            'mobile' => 'required|numeric|digits:10',
            'aadhar_no' => 'required|numeric|digits:12',
            'email' => 'required|email',

        ];

        if ($req->captcha != $req->capchaCode)
            return response()->json(['error' => true, 'msg' => "Oops! Invalid Captcha Code."]);


        $validation = Validator::make($req->all(), $required, msg());

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        // if ($req->captcha != $req->capchaCode)
        //     return response()->json(['error' => true, 'msg' => "Oops! Invalid Captcha Code."]);

        return AuthModel::preRegistration($req);
    }

    /**
     * User OTP Verify
     */
    public function otpVerify(Request $req)
    {
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

        return AuthModel::otpVerify($req);
    }

    /**
     * User Resed OTP
     */
    public function resendOtp()
    {
        return AuthModel::resendOtp();
    }

    /**
     * Capcha Reset
     */
    public function cp_refresh()
    {

        // $capchaCode = rand(11111, 99999);
        // session()->put('capchaCode', $capchaCode);

        $Code1 = rand(11, 99);
        $Code2 = rand(11, 99);
        $capchaCode = $Code1 + $Code2;
        session()->put('capchaCode', $capchaCode);
        $data['capchaCode'] = $capchaCode;
        $data['Code1'] = $Code1;
        $data['Code2'] = $Code2;
        return response()->json($data);
    }

    /**
     * User Password Reset
     */
    public function updatePassword(Request $req)
    {
        $validation = Validator::make($req->all(), [
            'old_password' => 'required',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/'
            ],

            'password_confirmation' => 'required|min:8|same:password',
        ]);

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        return AuthModel::changePassword($req);
    }

    // login with otp start

    public function checkEmailValidity(Request $req)
    {
        $chkk = false;
        if ($req->form_type == 1) {
            $chkk = DB::table('sport_welfare_registration_master')->join("sport_welfare_user_type_master", "sport_welfare_registration_master.id", "=", "sport_welfare_user_type_master.user_id")->where('sport_welfare_user_type_master.registered_for', "AWARD")->where('sport_welfare_registration_master.email', $req->email)->exists();
        } else if ($req->form_type == 2) {
            $chkk = DB::table('sport_welfare_registration_master')->join("sport_welfare_user_type_master", "sport_welfare_registration_master.id", "=", "sport_welfare_user_type_master.user_id")->where('sport_welfare_user_type_master.registered_for', "FINANCIAL")->where('sport_welfare_registration_master.email', $req->email)->exists();
        } else if ($req->form_type == 6) {
            $chkk = DB::table('direct_recruitment')->where('email', $req->email)->exists();
        }
        return $chkk;
    }

    public function checkandsendOTP(Request $req)
    {
        // dd($req->all());
        $otp = rand(11111, 99999);
        //$otp = 123456;
        if ($req->form_type == 1 || $req->form_type == 2) {
            $chkk = DB::table('sport_welfare_registration_master')->where('email', $req->email)->first();

            DB::table('sport_welfare_registration_master')->where('email', $req->email)->update(["otp" => $otp]);
        }
        if ($req->form_type == 6) {
            $chkk = DB::table('direct_recruitment')->where('email', $req->email)->first();

            DB::table('direct_recruitment')->where('email', $req->email)->update(["otp" => $otp]);
        }
        SmsMail::dispatch([
            "otp" => $otp,
            "email" => $chkk->email,
            "mobile" => $chkk->mobile
        ], 1);

        return 1;
    }
    // login with otp end


    public function mailCheck()
    {
        //     $details = [
        //         'title' => 'Mail from aaaaa',
        //         'body' => 'This is for testing email using smtp'
        //     ];
        //use Illuminate\Support\Facades\Mail;
        //    return  Mail::to('harshrajoriya9@gmail.com')->send(new \App\Mail\MyTestMail($details));
        //Mail::to('harshrajoriya9@gmail.com')->send(new \App\Mail\RegistrationSuccess('Harsh', 'harshrajoriya9@gmail.com', '12345678'));
        // Mail::to('harshrajoriya9@gmail.com')->send(new \App\Mail\OtpSend(123456, 'OTP to Register'));
        return true;
    }

    public function SendSMS()
    {

        $requestMobile = +917052543383;
        // $otp = 123456;
        $otp = rand(111111, 999999);
        $message = 'Your OTP for Registration is ' . $otp . '. OMNINET TECHNOLOGIES PVT LTD';
        // $message = 'Your OTP to register on File Investment Intent Portal is ' . $otp . '. (Invest UP) Udyog Bandhu';
        //$message = 'Your OTP to register on File Investment Intent Portal is ' . $otp . '. Kindly fill & verify the OTP on portal to complete your registration process. (Invest UP) Udyog Bandhu';
        // $url = "http://103.16.101.52/sendsms/bulksms?username=omnt-UPIPFA&password=DR54W23R&type=0&dlr=1&destination=" . $requestMobile . "&source=UPIPFA&message=" . urlencode($message) . "&&entityid=1001638430000021707&tempid=1007161468563215472";
        $url = " http://103.16.101.52/bulksms/bulksms?username=omni-omnint&password=ZX45I90O&type=0&dlr=1&destination=" . $requestMobile . "&source=OMNINT&message=" . urlencode($message) . "&entityid=1601100000000007326&tempid=1607100000000032462&tmid=1601100000000007326,1602100000000007233";
        // http://103.16.101.52/bulksms/bulksms?username=omni-omnint&password=ZX45I90O&type=0&dlr=1&destination=9876543210&source=OMNINT&message=Your OTP for Registration is [otp]-OMNINET TECHNOLOGIES PVT LTD&entityid=1601100000000007326&tempid=1607100000000032462
        echo $url;
        die;
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

    public function logintype()
    {
        $data = DB::table('department')->get();
        $html = '<option value="">Select User Name</option>';
        foreach ($data as $item) {
            $html .= "<option value=" . $item->id . ">" . $item->name . "</option>";
        }
        return $html;
    }
    public function getReplyDetails(Request $req)
    {
        $type = $req->type;
        $id = $req->id;
        $reply = DB::table('query_reply_detail')->where('query_id', $id)->get();
        return view('queryreply.queryreply', compact('type', 'reply', 'id'));
    }

    public function directMarkQuery(Request $req)
    {
        $fileName = '';
        if ($req->hasFile('query_doc'))
            $fileName = moveFile('queryDoc', $req->query_doc);
        $queryId = $req->queryId;
        $queryMaster = DB::table('query_master')->where('id', $queryId)->first();
        $repliedBy = $queryMaster->user_id;
        $replyTo = $queryMaster->rso_id;
        $data = [
            'query_id' => $queryId,
            'reply' => $req->is_mark_query,
            'reply_doc' => $fileName,
        ];
        $typename = "";
        $rso = Auth::guard('admin')->user();
        if (isset($rso)) {
            $typename = Auth::guard('admin')->user()->name;
        } else {
            $typename = "User";
        }
        if (isset($rso)) {
            $data['replied_by'] = $replyTo;
            $data['reply_to'] = $repliedBy;
            $data['current_status'] = $typename;
            $data['reply_type'] = 1;
        } else {
            $data['replied_by'] = $repliedBy;
            $data['reply_to'] = $replyTo;
            $data['current_status'] = $typename;
            $data['reply_type'] = 2;
        }


        DB::table('query_reply_detail')->insert($data);

        DB::table('query_master')->where('id', $queryId)->update(["query_status" => 1, "current_status" => $typename]);

        StatusChangeLog::dispatch($queryMaster->form_type, $queryMaster->user_id, "", "Replied By " . $typename, "sport_welfare_registration_master");

        return response()->json(['error' => false, 'msg' => 'Query Reply Successfully', 'id' => $queryId, 'type' => $req->queryType]);
    }
}
