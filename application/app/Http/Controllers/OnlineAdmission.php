<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProjectExport;
use PDF;
use Exception;


use Illuminate\Support\Facades\Session;
use App\Events\SmsMail;
use App\Models\OnlineAdmissionModel;
use App\Events\UserLoggedIn;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Validation\Rule as ValidationRule;

class OnlineAdmission extends Controller
{

    public function index()
    {
        $capchaCode = rand(11111, 99999);
        session()->put('capchaCode', $capchaCode);
        return view('onlineAdmission.login', compact('capchaCode'));
    }
    public function login(Request $req)
    {
        $validation = Validator::make($req->all(), [
            'appl_no' => 'required',
            'password' => 'required',
            'captcha' => 'required',
        ],     $message = [
            'appl_no.required' => 'Please Enter User ID./कृपया यूज़र आईडी भरें।',
            'password.required' => 'Please Enter Password./कृपया पासवर्ड भरें।',
            'captcha.required'=> 'Please Enter Captcha./कृपया कैप्चा भरें।'
        ]);

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        if ($req->captcha != $req->capchaCode)
            return response()->json(['error' => true, 'msg' => "Entered Captcha is invalid./भरा गया कैप्चा अमान्य है।"]);


        $encryptedData = $req->password;
        $decryptionKey = "2b7e151628aed2a6abf7158809cf4f3c";
        $keyHex = hex2bin($decryptionKey);
        $req->password = openssl_decrypt(base64_decode($encryptedData), 'AES-128-ECB', $keyHex, OPENSSL_RAW_DATA);
        // //  for email

        $mencryptedData = $req->appl_no;
        $mdecryptionKey = "2b7e151628aed2a6abf7158809cf4f3c";
        $mkeyHex = hex2bin($mdecryptionKey);
        $req->appl_no = openssl_decrypt(base64_decode($mencryptedData), 'AES-128-ECB', $mkeyHex, OPENSSL_RAW_DATA);

        // --- Exclusive Access Gate for Testing ---
        if ($req->appl_no !== 'DEV2026001') {
            return response()->json(['error' => true, 'msg' => "The module is currently under maintenance. Only authorized test accounts can log in at this time./यह मॉड्यूल वर्तमान में रखरखाव के अधीन है। इस समय केवल अधिकृत परीक्षण खाते ही लॉगिन कर सकते हैं।"]);
        }
        // ----------------------------------------

            if (Auth::guard('OnlineAdmission')->attempt(['application_no' => $req->appl_no, 'password' => $req->password])) {

                OnlineAdmissionModel::where('id', Auth::guard('OnlineAdmission')->user()->id)->update([
                    'last_login_attempt_time' => date('Y-m-d H:i:s')
                ]);
                session()->flash('success', 'You have successfully logged in.');
                UserLoggedIn::dispatch(Auth::guard('OnlineAdmission')->user()->id, 1,2,'admission_registration_login');
                if (OnlineAdmissionModel::where('id', Auth::guard('OnlineAdmission')->user()->id)->where('password_changed', 1)->exists()) {
                    session()->flash('success', 'You have successfully logged in.');
                    return response()->json(['error' => false, 'route' => "onlineAdmission/dashboard", 'msg' => "You have successfully logged in."]);
                } else {
                    return response()->json(['error' => false, 'route' => "onlineAdmission/change-password", 'msg' => "You have successfully logged in."]);
                }
                // session()->flash('success', 'You Successfully Login.');
                // return response()->json(['error' => false, 'msg' => "You Successfully Login."]);

            }

        return response()->json(['error' => true, 'msg' => "Entered Login Details are invalid. Please enter correct details./भरा गया लॉगिन विवरण अमान्य है। कृपया सही विवरण भरें।"]);
    }
    public function register($serviveCode=null)
    {
        if(Session::get('sessDetails')){
            $sessDetails = [
                'ReturnType'=> Session::get('sessDetails')['ReturnType'],
                'UserName'=> Session::get('sessDetails')['UserName'],
                'DCode'=> Session::get('sessDetails')['DCode'],
                'RequestKey'=> Session::get('sessDetails')['RequestKey'],

                'serviceCode'=> $serviveCode,
            ];
            Session::put('sessDetails', $sessDetails);

        }
        $capchaCode = rand(11111, 99999);
        session()->put('capchaCode', $capchaCode);
        return view('onlineAdmission.register', compact('capchaCode'));
    }

    public function preRegistration(Request $req)
    {

        $required = [
            'fname'  => 'required',
            'dateOfBirth' => 'required|date',
            'native_of_up'       => 'required',
            'mobile'        => 'required|numeric|digits:10',
            'aadhar_no'     => [
        'required',
        'numeric',
        'digits:12'
    ],
         'pen_no'        => 'required|numeric',
            'email'         => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            'captcha' => 'required',
        ];

        $message = [
            'fname.required' => 'Please Enter Full Name./कृपया पूरा नाम भरें।',
            'dateOfBirth.required' => 'Please Select Date of Birth./कृपया जन्मतिथि का चयन करें।',
            'native_of_up.required'       => 'Please answer that whether you are a native or UP or not./कृपया उत्तर दें कि आप उ0प्र0 के मूल निवासी हैं अथवा नहीं?',
            'mobile.required'        =>  'Please Enter Mobile No./कृपया मोबाइल नंबर भरें।',
            'mobile.digits'          =>  '	Mobile No. must be of 10 digits./मोबाइल नंबर 10 अंकों का होना चाहिए।',
            'aadhar_no.required' => 'Please Enter Aadhaar No./कृपया आधार नंबर भरें।',
            'aadhar_no.digits' => 'Aadhaar No. must be of 12 digits./आधार नंबर 12 अंकों का होना चाहिए।',
        'aadhar_no.unique' => 'Entered Aadhaar No. is already registered on this portal. Please try another Aadhaar No./भरा गया आधार नंबर पहले से पोर्टल पर पंजीकृत है। कृपया दूसरा आधार नंबर भरें।',

             'pen_no.required' => 'Please Enter Personal Education Number./कृपया व्यक्तिगत शिक्षा संख्या भरें।',
           //  'pen_no.digits' => 'Personal Education Number must be of 12 digits./व्यक्तिगत शिक्षा संख्या 12 अंकों का होना चाहिए।',
            // 'pen_no.unique' => 'Entered Personal Education Number is already registered on this portal. Please try another Personal Education Number./भरा गया व्यक्तिगत शिक्षा संख्या पहले से पोर्टल पर पंजीकृत है। कृपया दूसरा व्यक्तिगत शिक्षा संख्या भरें।',

            'email.required' => 'Please Enter Email ID./कृपया ईमेल आईडी भरें।',
            'email.email'=> 'Entered Email ID is invalid. Please Enter Valid Email ID./भरी गई ईमेल आईडी अमान्य है। कृपया सही ईमेल आईडी भरें।',
            'captcha.required'=> 'Please Enter Captcha./कृपया कैप्चा भरें।'
        ];

        if ($req->captcha != $req->capchaCode)
            return response()->json(['error' => true, 'msg' => "Entered Captcha is invalid. Please Enter Valid Captcha./भरा गया कैप्चा अमान्य है। कृपया सही कैप्चा भरें।"]);


        $validation = Validator::make($req->all(), $required, $message);

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

           $already_register = DB::table('admission_registration_login')->where('session_year', config('app.session_year'))->where('aadhar_no', $req->aadhar_no)->first();
            if ($already_register ){
                return response()->json(['error' => true, 'msg' => 'Entered Aadhaar No. is already registered on this portal. Please try another Aadhaar No./भरा गया आधार नंबर पहले से पोर्टल पर पंजीकृत है। कृपया दूसरा आधार नंबर भरें।']);
            }
          

           

            $password = rand(10000000, 99999999);
        $id = DB::table('sport_welfare_registration')->insertGetId([
            // 'sport_type' => $req->sport_type,
            'fullname'       => $req->fname,
            // 'sport_position'  => $req->sport_position,
            'native_of_up'  => $req->native_of_up,
            'mobile'        => $req->mobile,
            'email'         => $req->email,
            'role'         => $req->role,
            // 'gender'         => $req->gender,
            'password'      => Hash::make( $password ),
            'user_password' =>  $password ,
            'aadhar_no' => $req->aadhar_no,
            'pen_no' => $req->pen_no,
            'dob' => $req->dateOfBirth,
        ]);

        $otp = rand(111111, 999999);
    //   $otp = 123456;
        DB::table('user_otp')->insert([
            "pre_reg_id"    => $id,
            "mobile"        => $req->mobile,
            "otp"           => $otp
        ]);

        session()->put('mobile', $req->mobile);
        session()->put('email', $req->email);
        session()->put('aadhar_no', $req->aadhar_no);
        session()->put('form_type', 11);



        try {
            SmsMail::dispatch([
                "otp" => $otp,
                "email" => $req->email,
                "mobile" => $req->mobile
            ], 11);
        } catch (Exception $e) {


        }




        return response()->json(["error" => false, "msg" => "An OTP has been sent on entered Mobile No./Email ID./भरे गए मोबाइल नंबर/ईमेल आईडी पर एक ओटीपी भेजा गया है।", "url" => route('onlineAdmission.otp')]);
    }

    public function forgotPassword()
    {

        return view('onlineAdmission.forgot');
    }

    public function forgot(Request $req){
        $validation = Validator::make($req->all(), [
            'application_no'         => 'required'
        ], [
            'application_no.required'=> 'Please Enter Registered Email ID./कृपया पंजीकृत ईमेल आईडी भरें।'
        ]);

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        if($req->post()){
            $user = DB::table('admission_registration_login')->where('application_no', $req->application_no)->first();

            if($user != ""){
                // dd($reply->mobile);
                session()->put('form_type', 13);
                try{
                $check= SmsMail::dispatch([
                    "password" => $user->user_password,
                    "email" => $user->email,
                    "mobile" => $user->mobile,
                    "aadhar_no" => $user->aadhar_no
                ], 13);

            } catch (Exception $e) {


                 return response()->json(["error" => true, "msg" => 'Smpt connection Failed']);
            }
                 return response()->json(["error" => false, "msg" => "Password has been sent on the registered Email ID & Mobile No./पासवर्ड पंजीकृत ईमेल आईडी एवं मोबाइल नंबर पर भेज दिया गया है।"]);

            }
            else{
                return response()->json(['error' => true, 'msg' => "	Entered User ID is not registered on the Portal/भरी गई यूज़र आईडी पोर्टल पर पंजीकृत नहीं है।"]);
            }
        }
    }



    public function otp()
    {
        return view('onlineAdmission.otp');
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
            return response()->json(['error' => true, 'msg' => 'Please Enter OTP./कृपया ओटीपी भरें।']);

                $otp = $req->otp1 . $req->otp2 . $req->otp3 . $req->otp4 . $req->otp5 . $req->otp6;
                $mobile = session()->get('mobile');
                // dd($mobile);
                $table = DB::table('user_otp')->where('mobile', $mobile)->where('otp', $otp)->orderBy('id', 'DESC')->limit(1);

               if ($table->exists()) {
                    $reg_id = $table->first()->pre_reg_id;
                    $data_old= DB::table('sport_welfare_registration')->select(
                        'fullname',
                        'native_of_up',
                        'mobile',
                        'dob',
                        'gender',
                        'aadhar_no',
                        'pen_no',
                        'email',
                        'password',
                        'user_password'
                    )->where('id', $reg_id)->first();

                    // if (DB::table('admission_registration_login')->where('aadhar_no', $data_old->aadhar_no)->exists()){
                    //     $id=(DB::table('admission_registration_login')->select('id')->where('aadhar_no', $data_old->aadhar_no)->first())->id;

                    // }else{
                        // $applNo = rand(111111, 999999);



                        $applicationNo= date('y').date("m",strtotime($data_old->dob)).sprintf("%06d", $reg_id);




                      $data = [
                        'application_no'       => $applicationNo,
                        'fullname'       => $data_old->fullname,
                        'dob'       => $data_old->dob,
                        // 'gender'       => $data_old->gender,
                        'native_of_up'  => $data_old->native_of_up,
                        'mobile'        => $data_old->mobile,
                        'email'         => $data_old->email,
                        'aadhar_no'         => $data_old->aadhar_no,
                        'pen_no'         => $data_old->pen_no,
                        'password'      => $data_old->password,
                        'user_password' => $data_old->user_password,
                        'session_year' => config('app.session_year')
                      ];



                        if(Session::get('sessDetails')){


                            $data['registered_from']=2;
                            $data['UserName_edistrict']=Session::get('sessDetails')['UserName'];

                            $data['ReturnType']= Session::get('sessDetails')['ReturnType'];

                            $data['DCode']= Session::get('sessDetails')['DCode'];
                            $data['RequestKey'] =Session::get('sessDetails')['RequestKey'];

                            $data['serviceCode'] = Session::get('sessDetails')['serviceCode'];


                    }else{
                        $data['registered_from']=1;
                    }


                        $id = DB::table('admission_registration_login')->insertGetId($data);
                   //  }


                    // SmsMail::dispatch(["id" => $reg_id], 11);
                    try{
                    SmsMail::dispatch([
                        "password" => $data_old->user_password,
                        "email" => $data_old->email,
                        "mobile" => $data_old->mobile,
                        "aadhar_no" => $data_old->aadhar_no,
                        "applicationNo"=>$applicationNo
                    ], 12);

                } catch (Exception $e) {


                }

                    session()->put('mobile', 000);
                    return response()->json(["error" => false, "msg" => "OTP has been verified successfully, and login credentials have been sent on the registered Mobile No. & Email ID./ओटीपी सफलतापूर्वक सत्यापित हो गया है एवं पंजीकृत मोबाइल नंबर व ईमेल आईडी पर लॉगिन विवरण प्रेषित कर दिए गए हैं।", "url" => url('/onlineAdmission')]);
                }

                return response()->json(["error" => true, "msg" => "Entered OTP is invalid. Please enter valid OTP./भरा गया ओटीपी अमान्य है। कृपया सही ओटीपी भरें।"]);

    }

    public function changePassword()
    {
        return view('onlineAdmission.changePassword');
    }
    public function updatePassword(Request $req)
    {
        $validation = Validator::make($req->all(), [
            'old_password' => 'required',
            'password' =>  ['required','string','min:8',
                'regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/'
            ],
            'password_confirmation' => 'required|min:8|same:password',
        ],[
            'old_password.required'=>'	Please Enter Current Password./कृपया वर्तमान पासवर्ड भरें।',
            'password.required' =>'	Please Enter New Password./कृपया नया पासवर्ड भरें।',
            'password.min'=> '•	New Password must contain at least 08 characters./नया पासवर्ड न्यूनतम 08 वर्णों का होना चाहिए।',
            'password_confirmation.required'=> 'Please Retype New Password./कृपया नया पासवर्ड पुनः भरें।',
            'password_confirmation.same' => '•	New Password and Retyped New Password must be same./नया पासवर्ड एवं पुनः भरा गया नया पासवर्ड एक समान होना चाहिए।'
        ]);

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        if (!Hash::check($req->old_password, Auth::guard('OnlineAdmission')->user()->password))
            return response()->json(["error" => true, "msg" => "	Incorrect Current Password Entered. Please Enter Correct Password./भरा गया वर्तमान पासवर्ड अमान्य है। कृपया सही पासवर्ड भरें।'"]);

        if (Hash::check($req->password,  Auth::guard('OnlineAdmission')->user()->password))
            return response()->json(["error" => true, "msg" => "	Current Password and New Password cannot be same./वर्तमान पासवर्ड एवं नया पासवर्ड एक समान नहीं हो सकते।"]);

        DB::table('admission_registration_login')->where('id', Auth::guard('OnlineAdmission')->user()->id)->update([
            'password' => Hash::make($req->password),
            'user_password' => $req->password,
            'password_changed' => 1
        ]);
        // Auth::logout();
        Auth::guard('OnlineAdmission')->logout();
        session()->flash('success', 'Password Changed Successfully./पासवर्ड सफलतापूर्वक बदला गया।');
        return response()->json(["error" => false, "url" => url('/onlineAdmission')]);
    }

    public function dashboard()
    {
        if(OnlineAdmissionModel::where('id', Auth::guard('OnlineAdmission')->user()->id)->where('password_changed', 1)->exists()) {
if(OnlineAdmissionModel::where('id', Auth::guard('OnlineAdmission')->user()->id)->where('password_changed', 1)->first()->form_status < 2){
    return redirect()->route('onlineAdmission.applicationForm');
}
          $data = DB::table('admission_registration_login as rg')
                ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
                ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
                // ->join('online_admission_payment_details', 'online_admission_payment_details.user_id', '=', 'rg.id')
                // ->select('rg.application_no as application_no','online_admission_payment_details.transaction')
                ->select('rg.id','rg.application_no as application_no', 'rg.trial_type','rg.enroll_no', 'rg.mobile','rg.fullname','rg.aadhar_no','sport_onlineadmission.name as sport_name','rg.final_status', 'rg.form_status', 'rg.payment_status', 'rg.challan_no', 'basic.sport_college','rg.trial_type')
                ->where('rg.id',Auth::guard('OnlineAdmission')->user()->id)->first();

            return view('onlineAdmission.dashboard',compact('data'));
        } else {
            return Redirect('/onlineAdmission/change-password');
        }

    }

    public function applicationPreview()
    {

        $data = DB::table('admission_registration_login as rg')
                ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
                ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
                ->join('online_admission_education_document_details as education', 'rg.id', '=', 'education.user_id')
                ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
                ->join('sports_college_master', 'basic.sport_college', '=', 'sports_college_master.id')
                ->join('states', 'communication.p_state', '=', 'states.id')
                ->join('cities', 'communication.p_district', '=', 'cities.id')

               ->select('rg.id as id','rg.*','rg.application_no as application_no','basic.*','communication.*','education.*','sport_onlineadmission.name as sport_name','sports_college_master.college_name','cities.city as city_name','states.name as state_name','cities.trial_location','rg.trial_type')
                ->where('rg.id',Auth::guard('OnlineAdmission')->user()->id)->first();
          

        return view('onlineAdmission.applicationPreview',compact('data'));
    }

    public function payment()
    {$data = DB::table('admission_registration_login as rg')
        ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
        ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
        ->join('online_admission_education_document_details as education', 'rg.id', '=', 'education.user_id')
        ->join('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')

        ->join('cities', 'cities.id', '=', 'communication.p_district')
        ->join('states', 'communication.p_state', '=', 'states.id')
        ->join('sports_college_master', 'basic.sport_college', '=', 'sports_college_master.id')
        ->select('rg.*','basic.*','communication.*','education.*','sport_onlineadmission.name as sport_name', 'cities.city as city_name', 'states.name as state_name', 'sports_college_master.college_name', 'cities.trial_from_date')
        ->where('rg.id',Auth::guard('OnlineAdmission')->user()->id)->first();
   


        return view('onlineAdmission.payment',compact('data'));
    }

    public function applicationForm()
    {



        if((Auth::guard('OnlineAdmission')->user()->final_status == 1 &&  Auth::guard('OnlineAdmission')->user()->query_status == 2  )  || (Auth::guard('OnlineAdmission')->user()->final_status == 1 &&  Auth::guard('OnlineAdmission')->user()->query_status != 1  )){
            return redirect()->back();
        }



        $sport_type = DB::table('sport_onlineadmission')->where('status', 1)->orderBy('name')->get();
        $sport_college = DB::table('sports_college_master')->get();
        $state=DB::table('states')->get();
        $city=DB::table('cities')->where('state_id','=',23)->whereDate("trial_from_date",">",date("Y-m-d", strtotime("2 days")))->get();
        $division=DB::table('hostel_division_master')->get();
        $basic_detail=DB::table('online_admission_basic_details')->where('user_id','=',Auth::guard('OnlineAdmission')->user()->id)->first();
        $commun_detail =DB::table('online_admission_communication_details')->where('user_id','=',Auth::guard('OnlineAdmission')->user()->id)->first();
        $education_detail =DB::table('online_admission_education_document_details')->where('user_id','=',Auth::guard('OnlineAdmission')->user()->id)->first();
        return view('onlineAdmission.applicationForm',compact('division','sport_type','sport_college','state','city','basic_detail','commun_detail','education_detail'));
    }

    public function logout()
    {
        UserLoggedIn::dispatch(Auth::guard('OnlineAdmission')->user()->id, 2,2,'admission_registration_login');
        Auth::guard('OnlineAdmission')->logout();
        session()->flash('success', 'Successfully Logout.');
        return Redirect('/onlineAdmission');
    }

    public function get_sport(Request $req)
    {
        // dd($req->college1);
        $gender=$req->gender;

      if($gender == 2){
        $all_sport=DB::table('sport_onlineadmission')->whereIn('gender',[3,2])->where('status', 1)->orderBy('name')->get();
      }elseif($gender == 1){
        $all_sport=DB::table('sport_onlineadmission')->whereIn('gender',[1,3])->where('status', 1)->orderBy('name')->get();
      }

        return $all_sport;
    }
    public function get_subsport(Request $req)
    {
        $id=$req->sport;
        $all_sport=DB::table('sub_sport_type')->where('sport_id',$id)->get();
        return $all_sport;
    }



    public function get_college(Request $req)
    {

        $sport=$req->sport;
        $gender=$req->gender;

        // if($gender==1){
        //     $all_college=DB::table('sports_college_master')->where('gender','!=', 2)->get();
        //  }elseif($gender==2){
        //     $all_college=DB::table('sports_college_master')->where('gender','!=', 1)->get();
        //  }
        // $all_college=DB::SELECT("SELECT sports_college_master.college_name,sports_college_master.id FROM `sports_college_master` join college_sports_mapping on sports_college_master.id = college_sports_mapping.college_id where (college_sports_mapping.gender =$gender || college_sports_mapping.gender =3) and college_sports_mapping.sports_id=$sport ");

        $all_college=  DB::table('online_admission_college_matrix')
        ->leftJoin('sport_onlineadmission', 'online_admission_college_matrix.sport_id', '=', 'sport_onlineadmission.id')
        ->leftJoin('sports_college_master', 'online_admission_college_matrix.college_id', '=', 'sports_college_master.id')
        ->leftJoin('sub_sport_type', 'online_admission_college_matrix.sub_sport_id', '=', 'sub_sport_type.id')
        ->select('sports_college_master.college_name','sports_college_master.id')
        ->where('online_admission_college_matrix.seats','>=',1)
        ->where('online_admission_college_matrix.sport_id',$sport)
        ->where('online_admission_college_matrix.class',$req->admission_seeking)
        ->where('online_admission_college_matrix.gender',$gender);

        if(isset($req->sub_type)){
            $all_college->where('online_admission_college_matrix.sub_sport_id',$req->sub_type);
    }
    $all_college = $all_college->get();
         return response()->json(['error' => true, 'all_college' =>  $all_college , 'gender'=>$gender]);
        // return $all_college;
    }

    // public function get_subSport(Request $req)
    // {
    //     $id=$req->value;

    //     $all_sport=DB::table('college_sports_mapping')->join("sport_type","sport_type.id","=","college_sports_mapping.sports_id")->where('college_sports_mapping.college_id',$id)->get();


    //     return $all_sport;

    // }
    public function applicationbasicForm (Request $req)
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

        ],[
           'sport_college.required' => 'Please select college in which you are seeking admission?/कृपया विद्यालय का चयन करें जिसमें आप प्रवेश चाह रहे हैं?' ,
           'sport_type.required' => '	Please select name of Sports in which you are seeking admission?/कृपया खेल का चयन करें जिसमें आप प्रवेश चाह रहे हैं?',
           'category.required' => 'Please Select Category./कृपया श्रेणी का चयन करें।',
           'gender.required' => 'Please Select Gender./कृपया लिंग का चयन करें।',
           'height.required' => 'Please Enter Height (in Centimetre)./कृपया लंबाई (सेंटीमीटर में) भरें।',

           'blood_group.required'=> 'Please Select Blood Group./कृपया ब्लड ग्रुप का चयन करें।',
           'identification_marks.required'=> 'Please Enter Identification Mark./कृपया पहचान चिह्न भरें।',
           'disease.required' => '	Please answer that whether the applicant is suffering from Skin Disease/Fits/Other Disease?/कृपया उत्तर दें कि क्या आवेदक चर्म रोग/मिर्गी/अन्य किसी रोग से ग्रसित है?',
           'mother_name.required'=> 'Please Enter Mother’s Name./कृपया माता का नाम भरें।',

           'mother_occupation.required'=> 'Please Enter Mother’s Occupation./कृपया माता का व्यवसाय भरें।',
           'father_name.required'=> '	Please Enter Father’s Name./कृपया पिता का नाम भरें।',

           'father_occupation.required'=> 'Please Enter Father’s Occupation./कृपया पिता का व्यवसाय भरें।',



        ]);






        if ($validation->fails())
        return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        if ($req->hasFile('mother_aadhar')){
            $mother_aadhar = moveFile('onlineAdmission_storage/images', $req->mother_aadhar);
        }else{
            $mother_aadhar =  $req->mother_aadhar1;
        }

        if ($req->hasFile('father_aadhar')){
            $father_aadhar = moveFile('onlineAdmission_storage/images', $req->father_aadhar);
        }else{
            $father_aadhar =  $req->father_aadhar1;
        }

        $status =[
            'user_id'       => Auth::guard('OnlineAdmission')->user()->id,
            'application_no' => Auth::guard('OnlineAdmission')->user()->application_no,
            'sport_college'       => implode(",", $req->sport_college),
            'sport_type'       => $req->sport_type,

            'category'  => $req->category,
            'sub_category'        => $req->sub_category,
            'height'         => $req->height,
            'weight'      => $req->weight,
            'blood_group' => $req->blood_group,
            'identification_marks' => $req->identification_marks,
            'gender' => $req->gender,
            'admission_seeking' => $req->admission_seeking,

            'disease' => $req->disease,
            'mother_name' => $req->mother_name,

            'mother_occupation' => $req->mother_occupation,
            'father_name' => $req->father_name,

            'father_occupation' => $req->father_occupation,

            'mother_aadhar' => $mother_aadhar,
            'father_aadhar' => $father_aadhar
        ];




        //   if(DB::table('sub_sport_type')->where('sport_id', $req->sport_type)->exists()){
        //     $subSport = DB::table('sub_sport_type')->where('sport_id', $req->sport_type)->pluck('id')->toArray();





        //     $status['sub_sport_type'] = $req->sub_type;

        //   }else{
        //     $status['sub_sport_type'] = null;
        //   }


          $status['sub_sport_type'] = $req->sub_type;



        if (DB::table('online_admission_basic_details')->where('user_id', Auth::guard('OnlineAdmission')->user()->id)->exists()) {

            $check = DB::table('online_admission_basic_details')->where('user_id', Auth::guard('OnlineAdmission')->user()->id)->update($status);
            $msg = "You Are SuccessFully Updated basic detail.";
            DB::table('admission_registration_login')->where('id', Auth::guard('OnlineAdmission')->user()->id)->update([
            
                'pen_no'=> $req->pen_no,
            ]);

         } else {
            $check = DB::table('online_admission_basic_details')->insert($status);

          
            $msg = "You Are SuccessFully Submitted basic detail.";
            DB::table('admission_registration_login')->where('id', Auth::guard('OnlineAdmission')->user()->id)->update([
                'form_status' => 2,
                'pen_no'=> $req->pen_no,
            ]);

         }


        return response()->json(["error" => false, "msg" => $msg, "url" => url('onlineAdmission/applicationForm')]);
    }

    public function applicationcommunication (Request $req)
    {
        $validation = Validator::make($req->all(), [
            'p_gram'       => 'required',
            'p_post'       => 'required',
            'p_thana'  => 'required',
            'p_state'        => 'required',
            'p_district'         => 'required',
            'p_mobile'      => 'required|numeric',
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
            'p_gram.required' => ' Please Enter Street/Village Name./कृपया मोहल्ला/ग्राम का नाम भरें।' ,
            'p_post.required' => 'Please Enter Post Office./कृपया डाक घर भरें।' ,
            'p_thana.required' => 'Please Enter Police Station./कृपया पुलिस थाना भरें।' ,
            'p_state.required' => 'Please Select State./कृपया राज्य का चयन करें।' ,

            'p_district.required' => 'Please Select District./कृपया जनपद का चयन करें।' ,
            'p_mobile.required' => 'Please Enter Mobile No./कृपया मोबाइल नंबर भरें।' ,
            'p_alternate_mobile' => 'Please Enter Alternative Mobile No./कृपया वैकल्पिक मोबाइल नंबर भरें।' ,
            'p_email' => 'Please Enter Email ID./कृपया ईमेल आईडी भरें।' ,
            'c_gram.required' => 'Please Enter Street/Village Name./कृपया मोहल्ला/ग्राम का नाम भरें।' ,
            'c_post.required' => 'Please Enter Post Office./कृपया डाक घर भरें।' ,
            'c_thana.required' => 'Please Enter Police Station./कृपया पुलिस थाना भरें।' ,
            'c_state.required' => 'Please Select State./कृपया राज्य का चयन करें।' ,
            'c_district.required' => 'Please Select District./कृपया जनपद का चयन करें।' ,
            'c_mobile.required' => 'Please Enter Mobile No./कृपया मोबाइल नंबर भरें।' ,
            'c_alternate_mobile' => 'Please Enter Alternative Mobile No./कृपया वैकल्पिक मोबाइल नंबर भरें।' ,
            'c_email' => 'Please Enter Email ID./कृपया ईमेल आईडी भरें।' ,




         ]
    );

        if ($validation->fails())
        return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);


        if($req->p_alternate_mobile == $req->p_mobile){
            return response()->json(["error" => true, "msg" => 'In Permanent Address Mobile no. and Alternate mobile no. should not be same. ']);;
        }

        if($req->c_alternate_mobile == $req->c_mobile){
            return response()->json(["error" => true, "msg" => 'In Correspondence Address Mobile no. and Alternate mobile no. should not be same. ']);;
        }


        $status =[
            'user_id'       => Auth::guard('OnlineAdmission')->user()->id,
            'application_no' => Auth::guard('OnlineAdmission')->user()->application_no,
            'p_gram'       => $req->p_gram,
            'p_post'       => $req->p_post,
            'p_thana'  => $req->p_thana,
            'p_state'        => $req->p_state,
            'p_district'         => $req->p_district,
            'p_mobile'      => $req->p_mobile,
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

        if (DB::table('online_admission_communication_details')->where('user_id', Auth::guard('OnlineAdmission')->user()->id)->exists()) {
            $check = DB::table('online_admission_communication_details')->where('user_id', Auth::guard('OnlineAdmission')->user()->id)->update($status);
            $msg = "You Are SuccessFully Updated communication detail.";

         } else {
            $check = DB::table('online_admission_communication_details')->insertGetId($status);
            $msg = "You Are SuccessFully Submitted communication detail.";
            DB::table('admission_registration_login')->where('id', Auth::guard('OnlineAdmission')->user()->id)->update([
                'form_status' => 3
            ]);

         }


        return response()->json(["error" => false, "msg" => $msg, "url" => url('onlineAdmission/applicationForm')]);
    }


    public function applicationeducation (Request $req)
    {

        $validation = Validator::make($req->all(), [
            // 'updise_code'       => 'required',
            'school'       => 'required',
            // 'class'       =>'required',
            // 'year_of_passing'       => 'required',
            // 'obtained_marks'  => 'required|numeric',
            // 'maximum_marks'        => 'required|numeric',
            // 'grade_percentage'        => 'required'

        ]);

        if ($validation->fails())
        return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);



        $status =[
            'user_id'       => Auth::guard('OnlineAdmission')->user()->id,
            'application_no' => Auth::guard('OnlineAdmission')->user()->application_no,
            'school'       => $req->school,
            'updise_code'       => $req->updise_code,
            // 'class'       => $req->class,
            // 'year_of_passing'       => $req->year_of_passing,
            // 'obtained_marks'  => $req->obtained_marks,
            // 'maximum_marks'        => $req->maximum_marks,
            // 'grade_percentage'        => $req->grade_percentage

        ];

        if (DB::table('online_admission_education_document_details')->where('user_id', Auth::guard('OnlineAdmission')->user()->id)->exists()) {
            $check = DB::table('online_admission_education_document_details')->where('user_id', Auth::guard('OnlineAdmission')->user()->id)->update($status);
            $msg = "You Are SuccessFully Updated educational detail.";
         } else {
            $check = DB::table('online_admission_education_document_details')->insertGetId($status);
            $msg = "You Are SuccessFully Submitted educational detail.";


         }
         DB::table('admission_registration_login')->where('id', Auth::guard('OnlineAdmission')->user()->id)->update([
            'form_status' => 4
        ]);

        return response()->json(["error" => false, "msg" => $msg, "url" => url('onlineAdmission/applicationForm')]);
    }

    public function applicationdocument (Request $req)
    {
        if ($req->hasFile('applicant_photograph')){
            $applicant_photograph = moveFile('onlineAdmission_storage/images', $req->applicant_photograph);
        }else{
            $applicant_photograph =  $req->applicant_photograph1;
        }

        if ($req->hasFile('applicant_signature')){
            $applicant_signature = moveFile('onlineAdmission_storage/images', $req->applicant_signature);
        }else{
            $applicant_signature =  $req->applicant_signature1;
        }

        if ($req->hasFile('applicant_aadhar_birth_certificate')){
            $applicant_aadhar_birth_certificate = moveFile('onlineAdmission_storage/images', $req->applicant_aadhar_birth_certificate);
        }else{
            $applicant_aadhar_birth_certificate =  $req->applicant_aadhar_birth_certificate1;
        }

        if ($req->hasFile('applicant_birth_certificate')){
            $applicant_birth_certificate = moveFile('onlineAdmission_storage/images', $req->applicant_birth_certificate);
        }else{
            $applicant_birth_certificate =  $req->applicant_birth_certificate1;
        }




        // if ($req->hasFile('domicile_certificate')){
        //     $domicile_certificate = moveFile('onlineAdmission/images', $req->domicile_certificate);
        // }else{
        //     $domicile_certificate =  $req->domicile_certificate1;
        // }

        if ($req->hasFile('medical_certificate')){
            $medical_certificate = moveFile('onlineAdmission_storage/images', $req->medical_certificate);
        }

        if ($req->hasFile('education_certificate')){
            $education_certificate = moveFile('onlineAdmission_storage/images', $req->education_certificate);
        }else{
            $education_certificate =  $req->education_certificate1;
        }

        $status =[
            'applicant_photograph'       => $applicant_photograph,
            'applicant_signature'       => $applicant_signature,
            'applicant_aadhar_birth_certificate'       => $applicant_aadhar_birth_certificate,
'applicant_birth_certificate'=> $applicant_birth_certificate,
             'document_type'       => $req->document_type,
            'education_certificate'       => $education_certificate,

        ];      if ($req->hasFile('medical_certificate')){
        $status['medical_certificate'  ]= $medical_certificate;
        }

        if ($req->hasFile('affidavit')){
            $affidavit = moveFile('onlineAdmission_storage/images', $req->affidavit);
            $status['affidavit'] = $affidavit;
        }
        $check = DB::table('online_admission_education_document_details')->where('user_id', Auth::guard('OnlineAdmission')->user()->id)->update($status);
        $msg = "You Are SuccessFully Updated educational detail.";
        DB::table('admission_registration_login')->where('id', Auth::guard('OnlineAdmission')->user()->id)->update([
            'form_status' => 5
        ]);
        return response()->json(["error" => false, "msg" => $msg, "url" => url('onlineAdmission/applicationForm')]);
    }

    public function applicationsubmit (Request $req)
    {
        $msg = "You Are SuccessFully Submitted All details.";
        DB::table('admission_registration_login')->where('id', Auth::guard('OnlineAdmission')->user()->id)->update([
            'form_status' => 6
        ]);
        return response()->json(["error" => false, "msg" => $msg, "url" => url('onlineAdmission/applicationPreview')]);
    }

    public function applicationfinalSubmit (Request $req)
    {    $payment_status = DB::table('admission_registration_login')->where('id', Auth::guard('OnlineAdmission')->user()->id)->first()->payment_status;

        $msg = "Final Submission of Application is completed. Kindly pay the Application Fee./आवेदन को अंतिम रूप से दर्ज कर दिया गया है। कृपया आवेदन शुल्क का भुगतान करें।";

      if(Auth::guard('OnlineAdmission')->user()->query_status == 1){
        DB::table('admission_registration_login')->where('id', Auth::guard('OnlineAdmission')->user()->id)->update([
            'query_status' => 2
        ]);
        return response()->json(["error" => false, "msg" => $msg, "url" => url('/onlineAdmission/dashboard')]);
      }else{
        DB::table('admission_registration_login')->where('id', Auth::guard('OnlineAdmission')->user()->id)->update([
            'final_status' => 1,
           'challan_no'=> date('Y').sprintf("%012d", Auth::guard('OnlineAdmission')->user()->id)
        ]);
        return response()->json(["error" => false, "msg" => $msg, "url" => url('/onlineAdmission/dashboard')]);
 
      }


    }



    // by rakesh


    public function offlinepaymentdetail(Request $request){


        $user_id = Auth::guard('OnlineAdmission')->user()->id;
        $application_no = Auth::guard('OnlineAdmission')->user()->application_no;

        if ($request->hasFile('chalanfile')){
            $chalanfile = moveFile('onlineAdmission_storage/images/chalan', $request->chalanfile);
        }

        if ($request->hasFile('ddfile')){
            $ddfile = moveFile('onlineAdmission_storage/images/dd', $request->ddfile);
        }

        $data = [
          'user_id' => $user_id,
          'application_no' => $application_no,
          'payment_type'=>$request->paymenttype,
          'transaction'=>$request->transaction,

        ];


        if($request->paymenttype == 1){
           $data['chalan_no'] = $request->chalan_no;
           $data['chalan_file']= $chalanfile;
        }else{
            $data['dd_no'] = $request->dd_no;
            $data['dd_file'] = $ddfile;
        }



        DB::table('online_admission_payment_details')->insert($data);


        DB::table('admission_registration_login')->where('id', Auth::guard('OnlineAdmission')->user()->id)->update([
            'payment_status' => 1
        ]);
        $msg = "Your Offline Payment Details Submitted Successfully.";
        return response()->json(["error" => false, "msg" => $msg ,"url" => route('onlineAdmission.dashboard')]);
    }


}
