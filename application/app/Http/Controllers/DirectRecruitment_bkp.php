<?php

namespace App\Http\Controllers;

use App\Events\UserLoggedIn;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\AuthModel;
use App\Models\DirectRecruitmentV;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Events\SmsMail;
use App\Events\StatusChangeLog;
use Session;
use DateTime;
class DirectRecruitment extends Controller
{

    /**
     * User Sign Up
     */
    public function signUp()
    {
        if(Session::has('adv_no')){
        $capchaCode = rand(11111, 99999);
        session()->put('capchaCode', $capchaCode);
        return view('directRecruitment.signUp', compact('capchaCode'));
        }
        else{
            return redirect('/direct-recruitment');
        }
    }

    public function forgot()
    {
        return view('directRecruitment.forgot');
    }
    /**
     * User Login via Otp
     */
    public function otp()
    {
        return view('directRecruitment.otp');
    }

    /**
     * User Login Form
     */
    public function loginForm()
    {
        // dd(session()->get('adv_no'));
        if(Session::has('adv_no')){
            $capchaCode = rand(11111, 99999);
            session()->put('capchaCode', $capchaCode);
            return view('directRecruitment.login', compact('capchaCode'));
        }
        else{
            return redirect('/direct-recruitment');
        }

    }


    /**
     * User Login
     *
     * Guard web Middleware Authorization
     */
    public function login(Request $req)
    {

        $validation = Validator::make($req->all(), [
            'email' => 'required',
            'password' => 'required',
            'captcha' => 'required',
        ], msg());

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        if ($req->captcha != $req->capchaCode)
            return response()->json(['error' => true, 'msg' => "Oops! Invalid Captcha Code."]);

        if (Auth::guard('direct_recruitment')->attempt(['email' => $req->email, 'password' => $req->password])) {
            DirectRecruitmentV::where('user_id', Auth::guard('direct_recruitment')->user()->user_id)->update([
                'last_login_attempt_time' => date('Y-m-d H:i:s')
            ]);
            session()->flash('success', 'You have successfully logged in.');
            UserLoggedIn::dispatch(Auth::guard('direct_recruitment')->user()->user_id, 1,2,'direct_recruitment');
            if (DirectRecruitmentV::where('user_id', Auth::guard('direct_recruitment')->user()->user_id)->where('profile_complete', 1)->exists()) {
                session()->flash('success', 'You have successfully logged in.');
                return response()->json(['error' => false, 'route' => "dashboard", 'msg' => "You have successfully logged in."]);
            } else {
                return response()->json(['error' => false, 'route' => "profile_detail", 'msg' => "You have successfully logged in."]);
            }
            // session()->flash('success', 'You Successfully Login.');
            // return response()->json(['error' => false, 'msg' => "You Successfully Login."]);

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
        // UserLoggedIn::dispatch(Auth::guard('direct_recruitment')->user()->user_id, 2);

        // Auth::logout();Auth::id(), 2,2,'sport_welfare_registration_master'
        UserLoggedIn::dispatch(Auth::guard('direct_recruitment')->user()->user_id, 2,2,'direct_recruitment');
        Auth::guard('direct_recruitment')->logout();
        return Redirect('/direct-recruitment');
    }


    /**
     * User Pre Registration
     */
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

        return DirectRecruitmentV::preRegistration($req);
    }

    /**
     * User OTP Verify
     */
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
            $data_old= DB::table('sport_welfare_registration')->select(
                'id',
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
            $applNo = rand(11111, 99999);
            $applicationNo= date('ymd').$applNo;
            $id = DB::table('direct_recruitment')->insertGetId([
                'user_id'       => $data_old->id,
                'sport_type'       => $data_old->sport_type,
                'fullname'       => $data_old->fullname,
                'native_of_up'  => $data_old->native_of_up,
                'mobile'        => $data_old->mobile,
                'email'         => $data_old->email,
                'password'      => $data_old->password,
                'user_password' => $data_old->user_password,
            ]);

            // DB::table('direct_recruitment')->insertUsing(
            //     [
            //         'user_id', 'sport_type', 'fullname',  'role', 'native_of_up', 'mobile', 'email', 'password', 'user_password'
            //     ],
            //     DB::table('sport_welfare_registration')->select(
            //         'id',
            //         'sport_type',
            //         'fullname',
            //         // 'sport_position',
            //         'role',
            //         'native_of_up',
            //         'mobile',
            //         'email',
            //         'password',
            //         'user_password'
            //     )->where('id', $reg_id)
            // );

            // SmsMail::dispatch(["id" => $reg_id], 2);

            session()->put('mobile', 000);
            return response()->json(["error" => false, "msg" => "Thank You. You Are SuccessFully Registered", "url" => url('/direct-recruitment')]);
        }

        return response()->json(["error" => true, "msg" => "Oops! Invalid OTP  Please try again ."]);
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
        $capchaCode = rand(11111, 99999);
        session()->put('capchaCode', $capchaCode);
        return response()->json($capchaCode);
    }

    /**
     * User Password Reset
     */
    public function updatePassword(Request $req)
    {
        $validation = Validator::make($req->all(), [
            'old_password' => 'required',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|min:8|same:password',
        ]);

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        if (!Hash::check($req->old_password, Auth::guard('direct_recruitment')->user()->password))
            return response()->json(["error" => true, "msg" => "The old password does not match our records."]);

        if (Hash::check($req->password,  Auth::guard('direct_recruitment')->user()->password))
            return response()->json(["error" => true, "msg" => "Old password and New password cannot be same"]);

        DB::table('direct_recruitment')->where('user_id', Auth::guard('direct_recruitment')->user()->user_id)->update([
            'password' => Hash::make($req->password),
            'user_password' => $req->password
        ]);
        // Auth::logout();
        Auth::guard('direct_recruitment')->logout();
        session()->flash('success', 'Password Successfully changed.');
        return response()->json(["error" => false, "url" => url('/direct-recruitment')]);
    }

    public function changePassword()
    {
        return view('directRecruitment.changePassword');
    }

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
        //$otp = 123456;
         $otp = rand(111111, 999999);
        $message = 'Your OTP to register on File Investment Intent Portal is ' . $otp . '. (Invest UP) Udyog Bandhu';
        //$message = 'Your OTP to register on File Investment Intent Portal is ' . $otp . '. Kindly fill & verify the OTP on portal to complete your registration process. (Invest UP) Udyog Bandhu';
        $url = "http://103.16.101.52/sendsms/bulksms?username=omnt-UPIPFA&password=DR54W23R&type=0&dlr=1&destination=" . $requestMobile . "&source=UPIPFA&message=" . urlencode($message) . "&&entityid=1001638430000021707&tempid=1007161468563215472";


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



    ////

    public function dashboard()
    {
        $articles = DB::table('direct_recruitment')
            ->where('user_id', Auth::guard('direct_recruitment')->user()->user_id)
            ->where('category', '!=', '')
            ->first();
            // dd($articles);
        //   dd(Auth::guard('direct_recruitment')->user()->fullname);
        // $summary = DB::table('user_project_summary')->where('regid', Auth::guard('direct_recruitment')->user()->user_id)->get();
        return view('directRecruitment.dashboard', compact('articles'));
    }
    public function profile_detail()
    {
        $adv_list ="";
        $adv_no=session()->get('adv_no');

        $adv_list = DB::table('advertisment_post_master')->where('advertisment_no', $adv_no)->orderBy('id', 'DESC')->get();
        $post_id=array();
        $sport_id="";
        foreach ($adv_list as $key=>$item){
            if($key != 0){
                $sport_id .=',';
            }
            $sport_id .= $item->sport_type;
            // array_merge($sport_id,$item->sport_type);
            // $post_id[]=$item->id;
            //  $sport_id[]=$item->sport_type;
            // array_merge($sport_id,$item->sport_type);
        }
        $spo = explode(",", $sport_id);
        $sport_type = DB::table('sport_type')->whereIn('id', $spo)->get();
        //  $sport_name= DB::table('advertisment_post_master')->where('id', $adv_no)->orderBy('id', 'DESC')->get();

        $user = DirectRecruitmentV::where('user_id', Auth::guard('direct_recruitment')->user()->user_id)->first();

        // $sport_type = DB::table('sport_type')->get();
        $country = DB::table('countries')->get();
        $state = DB::table('states')->get();
        $city = DB::table('cities')->get();
        $selectMaster = DB::table('select_master')->select('id','name')->get();
        $postMaster = DB::table('advertisment_post_master')->select('id','post_name')->where('advertisment_no', $adv_no)->where('start_date','<=',date('Y-m-d'))->where('end_date','>=',date('Y-m-d'))->get();

        $all_city = DB::table('cities')->where('state_id', '23')->get();
        return view('directRecruitment.profile_detail', compact('postMaster','selectMaster','user', 'country', 'state', 'all_city', 'sport_type'));
    }

    public function edit_profile_detail()
    {
        $adv_list ="";
        $adv_no=session()->get('adv_no');
        $adv_list = DB::table('advertisment_post_master')->where('advertisment_no', $adv_no)->orderBy('id', 'DESC')->get();
        $post_id=array();
        $sport_id="";
        foreach ($adv_list as $key=>$item){
            if($key != 0){
                $sport_id .=',';
            }
            $sport_id .= $item->sport_type;
        }
        $spo = explode(",", $sport_id);
        $sport_type = DB::table('sport_type')->whereIn('id', $spo)->get();

        $user = DirectRecruitmentV::where('user_id', Auth::guard('direct_recruitment')->user()->user_id)->first();
        // $sport_type = DB::table('sport_type')->get();
        $country = DB::table('countries')->get();
        $state = DB::table('states')->get();
        $city = DB::table('cities')->get();
        $all_city = DB::table('cities')->where('state_id', '23')->get();

        $selectMaster = DB::table('select_master')->select('id','name')->get();
        // $postMaster = DB::table('post_master')->select('id','name')->get();
        $postMaster = DB::table('advertisment_post_master')->select('id','post_name')->where('advertisment_no', $adv_no)->where('end_date','>=',date('Y-m-d'))->get();


        $articles = DB::table('direct_recruitment')
            ->select('*')
            ->where('user_id', Auth::guard('direct_recruitment')->user()->user_id)
            ->get();
        $post = DB::table('applicant_post_master')
            ->select('*')
            ->where('user_id', Auth::guard('direct_recruitment')->user()->user_id)
            ->get();
            // dd($postMaster);
        return view('directRecruitment.edit_profile_detail', compact('postMaster','selectMaster','user', 'country', 'state', 'all_city', 'sport_type', 'articles', 'post'));
    }

    public function compProfile(Request $req)
    {



        $end = date('d/m/Y', strtotime('-18 years'));
        // $date=date_create($req->dob);
        //     $date=date_format($req->dob,"d/m/Y");
        //    dd($date);
        $required = [
            // 'dob'             => 'required|date_format:d/m/Y|before_or_equal:"'.$end.'"',
            'dob'             => 'required',
            'place_of_birth'            => 'required',
            'gender'         => 'required',
            "marital_status"       => 'required',
            "nationality"    => 'required',
            "religion"       => 'required',
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
            'achievement'            => 'required',
            'domicile_certificate'                 => 'required|mimes:pdf,png,jpg,jpeg|max:2000',
            'qualification_doc'                 => 'required|mimes:pdf,png,jpg,jpeg|max:2000',
            'aadhar_card'                 => 'required|mimes:pdf,png,jpg,jpeg|max:2000',
            'photograph'                 => 'required|mimes:png,jpg,jpeg|max:2000',
            'signature'                 => 'required|mimes:png,jpg,jpeg|max:2000',
        ];

        $validation = Validator::make($req->all(), $required, msg());

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
            // return redirect('/direct-recruitment/profile_detail')->withInput()->with('error', $validation->errors()->first());


            $dob=((explode('/',$req->dob)));
            $date1 = new DateTime($dob[1].'/'.$dob[0].'/'.$dob[2]);
            foreach ($req->post_name as $key => $item) {

                $adv_list = DB::table('advertisment_post_master')->where('id', $item)->first();
                $date2=new DateTime($adv_list->min_age_from);
                $interval = ($date1->diff($date2))->y;
                // dd($req->all());
                // $interval = 42;

                //for category wise post
                $category_post=false;

                if($req->category == 1 && $adv_list->general_post ==0){
                    $category_post=true;
                }
                if($req->category == 2 && $adv_list->obc_post ==0){
                    $category_post=true;
                }
                if($req->category == 3 && $adv_list->sc_post ==0){
                    $category_post=true;
                }
                if($req->category == 4 && $adv_list->st_post ==0){
                    $category_post=true;
                }

                //for age relaxation
                $age_relax=0;
                if($req->category == 2 && $adv_list->age_relax_obc !=0){

                    $age_relax= $adv_list->age_relax_obc;
                }
                if($req->category == 3 && $adv_list->age_relax_sc !=0){

                    $age_relax= $adv_list->age_relax_sc;
                }
                if($req->category == 4 && $adv_list->age_relax_st !=0){

                    $age_relax= $adv_list->age_relax_st;
                }
                // dd(($adv_list->max_age) + $age_relax);
                // dd($category_post);
                if(($interval <= $adv_list->min_age) || ($interval >= ($adv_list->max_age + $age_relax)) || $category_post){
                    // return redirect('direct-recruitment/profile_detail')->withInput()->with('error', "You are not eligible for $adv_list->post_name.");
                    return response()->json(['error' => true, 'msg' => "You are not eligible for $adv_list->post_name."]);
                }

            };


        $domicile_certificate = "{$req->domicile_certificate->getClientOriginalName()}";
        $path = $req->file('domicile_certificate')->storeAs('direct_recruitment', $domicile_certificate, 'public');

        $qualification_doc = "{$req->qualification_doc->getClientOriginalName()}";
        $path = $req->file('qualification_doc')->storeAs('direct_recruitment', $qualification_doc, 'public');

        $aadhar_card = "{$req->aadhar_card->getClientOriginalName()}";
        $path = $req->file('aadhar_card')->storeAs('direct_recruitment', $aadhar_card, 'public');

        $photograph = "{$req->photograph->getClientOriginalName()}";
        $path = $req->file('photograph')->storeAs('direct_recruitment', $photograph, 'public');

        $signature = "{$req->signature->getClientOriginalName()}";
        $path = $req->file('signature')->storeAs('direct_recruitment', $signature, 'public');

        $user = DB::table('direct_recruitment')->where('user_id', Auth::guard('direct_recruitment')->user()->user_id)->first();
        if ($user) {

            $dob=((explode('/',$req->dob)));
            $date1 = new DateTime($dob[1].'/'.$dob[0].'/'.$dob[2]);

            foreach ($req->post_name as $key => $item) {

                $adv_list = DB::table('advertisment_post_master')->where('id', $item)->first();

                $spo = explode(",", $adv_list->sport_type);
                $sport_type=true;
                    if (in_array($req->sport_type, $spo))
                    {
                        $sport_type=false;
                    }
                $date2=new DateTime($adv_list->min_age_from);
                $interval = ($date1->diff($date2))->y;

                // $interval = 42;
                //for category wise post

                //$interval = strtotime($interval);
                $category_post=false;

                if($req->category == 1 && $adv_list->general_post ==0){
                    $category_post=true;
                }
                if($req->category == 2 && $adv_list->obc_post ==0){
                    $category_post=true;
                }
                if($req->category == 3 && $adv_list->sc_post ==0){
                    $category_post=true;
                }
                if($req->category == 4 && $adv_list->st_post ==0){
                    $category_post=true;
                }

                //for age relaxation
                $age_relax=0;
                if($req->category == 2 && $adv_list->age_relax_obc !=0){

                    $age_relax= $adv_list->age_relax_obc;
                }
                if($req->category == 3 && $adv_list->age_relax_sc !=0){

                    $age_relax= $adv_list->age_relax_sc;
                }
                if($req->category == 4 && $adv_list->age_relax_st !=0){

                    $age_relax= $adv_list->age_relax_st;
                }



                if(($interval < $adv_list->min_age) || ($interval > ($adv_list->max_age + $age_relax) ||  $category_post || $sport_type)){
                    $chekk=true;
                    // dd($req->all());
                   // return redirect('/direct-recruitment/edit_profile_detail')->withInput()->with('error', "You are not eligible for $adv_list->post_name.");
                   return response()->json(['error' => true, 'msg' => "You are not eligible for $adv_list->post_name."]);
                }
            };
            // if($chekk){
            //     dd(4);
            //     return response()->json(['error' => true, 'msg' => "You are not eligible for $adv_list->post_name."]);

            // }
        if ($req->domicile_certificate) {
            $domicile_certificate = "{$req->domicile_certificate->getClientOriginalName()}";
            $path = $req->file('domicile_certificate')->storeAs('direct_recruitment', $domicile_certificate, 'public');
        } else {
            $domicile_certificate = $req->domicile_certificate1;
        }
        if ($req->qualification_doc) {
            $qualification_doc = "{$req->qualification_doc->getClientOriginalName()}";
            $path = $req->file('qualification_doc')->storeAs('direct_recruitment', $qualification_doc, 'public');
        } else {
            $qualification_doc = $req->qualification_doc1;
        }

        if ($req->aadhar_card) {
            $aadhar_card = "{$req->aadhar_card->getClientOriginalName()}";
            $path = $req->file('aadhar_card')->storeAs('direct_recruitment', $aadhar_card, 'public');
        } else {
            $aadhar_card = $req->aadhar_card1;
        }
        if ($req->photograph) {
            $photograph = "{$req->photograph->getClientOriginalName()}";
            $path = $req->file('photograph')->storeAs('direct_recruitment', $photograph, 'public');
        } else {
            $photograph = $req->photograph1;
        }

        if ($req->signature) {
            $signature = "{$req->signature->getClientOriginalName()}";
            $path = $req->file('signature')->storeAs('direct_recruitment', $signature, 'public');
        } else {
            $signature = $req->signature1;
        }
            // dd($req->all());
        $check = DB::table('direct_recruitment')->where('user_id', Auth::guard('direct_recruitment')->user()->user_id)->update([

            'mother_name' => $req->mother_name,
            'father_name' => $req->father_name,
            'sport_type' => $req->sport_type,
            'category' => $req->category,
            'dob' => $req->dob,
            'place_of_birth' => $req->place_of_birth,
            'gender' => $req->gender,
            'marital_status' => $req->marital_status,
            'nationality' => $req->nationality,
            'religion' => $req->religion,
            'sport_achievement' => $req->achievement,
            'aadhar_no' => $req->aadhar_no,

            'domicile_certificate'      => $domicile_certificate,
            'qualification_doc'      => $qualification_doc,
            'aadhar_doc'      => $aadhar_card,
            'photograph_doc'      => $photograph,
            'signature_doc'      => $signature,
            // 'guardian_signature'      => $guardian_signature,

            'present_address' => $req->present_address,

            'present_state' =>$req->present_state,
            'present_district' => $req->present_district,
            'present_pincode' => $req->present_pincode,
            'permanent_address' => $req->permanent_address,
            // 'permanent_state' =>$req->permanent_state,
            'permanent_district' => $req->permanent_district,
            'permanent_pincode' => $req->permanent_pincode

        ]);
            DB::table('applicant_post_master')->where('user_id', Auth::guard('direct_recruitment')->user()->user_id)->delete();
            foreach ($req->post_name as $key => $item) {
                $ch = DB::table('applicant_post_master')->insertGetId(array(
                    'user_id' => Auth::guard('direct_recruitment')->user()->user_id,
                    'post_type' => $req->post_type[$key],
                    'post_name' => $req->post_name[$key],
                ));
            };

            if ($ch) {
                $check = DB::table('direct_recruitment')->where('user_id', Auth::guard('direct_recruitment')->user()->user_id)->update(['profile_complete' => 1]);
                session()->flash('success', 'Profile Successfully Updated.');
                return response()->json(["error" => false, "msg" => "Detail Successfully Updated.", "url" => url('/direct-recruitment/formPreview')]);
                // return redirect('/direct-recruitment/formPreview')->with('success', 'Profile Successfully Updated.');
            } else {
                session()->flash('error', 'Profile Not Updated.');
                // return redirect('/direct-recruitment/edit_profile_detail')->with('error', 'Profile Not Updated.');
                return response()->json(['error' => true, 'msg' => "Profile Not Updated."]);
            }
        } else {
            $applNo = rand(11111, 99999);

            $check = DB::table('direct_recruitment')->insertGetId(array(
                'user_id' => Auth::guard('direct_recruitment')->user()->user_id,
                'fullname' => $req->full_name,
                'application_no' => date('ymd').$applNo,
                'mobile' => $req->contact_no,
                'email' => $req->email_id,
                'mother_name' => $req->mother_name,
                'father_name' => $req->father_name,
                'sport_type' => $req->sport_type,
                'category' => $req->category,
                'dob' => $req->dob,
                'place_of_birth' => $req->place_of_birth,
                'gender' => $req->gender,
                'marital_status' => $req->marital_status,
                'nationality' => $req->nationality,
                'religion' => $req->religion,
                'sport_achievement' => $req->achievement,
                'aadhar_no' => $req->aadhar_no,

                'domicile_certificate'      => $req->domicile_certificate->getClientOriginalName(),
                'qualification_doc'      => $req->qualification_doc->getClientOriginalName(),
                'aadhar_doc'      => $req->aadhar_card->getClientOriginalName(),
                'photograph_doc'      => $req->photograph->getClientOriginalName(),
                'signature_doc'      => $req->signature->getClientOriginalName(),
                // 'guardian_signature'      => $req->guardian_signature->getClientOriginalName(),

                'present_address' => $req->present_address,

                'present_state' =>$req->present_state,
                'present_district' => $req->present_district,
                'present_pincode' => $req->present_pincode,
                'permanent_address' => $req->permanent_address,
                // 'permanent_state' =>$req->permanent_state,
                'permanent_district' => $req->permanent_district,
                'permanent_pincode' => $req->permanent_pincode,

                'created_at' =>  date('d/m/Y')
            ));


            foreach ($req->post_name as $key => $item) {
                DB::table('applicant_post_master')->insertGetId(array(
                    'user_id' => Auth::guard('direct_recruitment')->user()->user_id,
                    'post_type' => $req->post_type[$key],
                    'post_name' => $req->post_name[$key],
                ));
            }

            if ($check) {
                DirectRecruitmentV::find(Auth::guard('direct_recruitment')->user()->user_id)->update(array('profile_complete' => 1));
                session()->flash('success', 'Profile Successfully Updated.');
                // return redirect('/direct-recruitment/formPreview')->with('success', 'Profile Successfully Updated.');
                return response()->json(["error" => false, "msg" => "Profile Successfully Updated.", "url" => url('/direct-recruitment/formPreview')]);

            } else {
                session()->flash('error', 'Profile Not Updated.');
                return response()->json(['error' => true, 'msg' => "Profile Not Updated."]);
                // return redirect('/direct-recruitment/profile_detail')->with('error', 'Profile Not Updated.');
            }
        }
    }
    public function formPreview()
    {
        $articles = DB::table('direct_recruitment')

            ->select('*')
            ->where('user_id', Auth::guard('direct_recruitment')->user()->user_id)
            ->get();
        // dd(Auth::guard('direct_recruitment')->user()->user_id);
        $post = DB::table('applicant_post_master')

            ->select('*')
            ->where('user_id', Auth::guard('direct_recruitment')->user()->user_id)
            ->get();
        //  dd($post);
        // $user = User::where('user_id', Auth::guard('direct_recruitment')->user()->user_id)->first();
        $user = DB::table('direct_recruitment')

            ->select('*')
            ->where('user_id', Auth::guard('direct_recruitment')->user()->user_id)
            ->get();

        $userId = Auth::guard('direct_recruitment')->user()->user_id;

        $queryData = DB::table('query_master')->where('form_type',6)->where('user_id',$userId)->orderBy('id','DESC')->get();
    //    dd($queryData);
        return view('directRecruitment.applicant_preview_form', compact('user', 'articles', 'post','queryData'));
    }

    public function updateProfile(Request $req)
    {

        $end = date('d/m/Y', strtotime('-18 years'));
        $required = [
            // 'dob'             => 'required|date|date_format:d/m/Y|before:'.$end,
            'dob'             => 'required',
            'place_of_birth'            => 'required',
            'gender'         => 'required',
            "marital_status"       => 'required',
            "nationality"    => 'required',
            "religion"       => 'required',
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
            'achievement'            => 'required',
            'domicile_certificate'                 => 'nullable|mimes:pdf,png,jpg,jpeg|max:2000',
            'qualification_doc'                 => 'nullable|mimes:pdf,png,jpg,jpeg|max:2000',
            'aadhar_card'                 => 'nullable|mimes:pdf,png,jpg,jpeg|max:2000',
            'photograph'                 => 'nullable|mimes:png,jpg,jpeg|max:2000',
            'signature'                 => 'nullable|mimes:png,jpg,jpeg|max:2000',
            // 'guardian_signature'                 => 'nullable|mimes:pdf,png,jpg,jpeg|max:2000',
        ];

        $validation = Validator::make($req->all(), $required, msg());

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

            $dob=((explode('/',$req->dob)));
            $date1 = new DateTime($dob[1].'/'.$dob[0].'/'.$dob[2]);

            foreach ($req->post_name as $key => $item) {

                $adv_list = DB::table('advertisment_post_master')->where('id', $item)->first();

                $spo = explode(",", $adv_list->sport_type);
                $sport_type=true;
                    if (in_array($req->sport_type, $spo))
                    {
                        $sport_type=false;
                    }
                $date2=new DateTime($adv_list->min_age_from);
                $interval = ($date1->diff($date2))->y;

                // $interval = 42;
                //for category wise post

                //$interval = strtotime($interval);
                $category_post=false;

                if($req->category == 1 && $adv_list->general_post ==0){
                    $category_post=true;
                }
                if($req->category == 2 && $adv_list->obc_post ==0){
                    $category_post=true;
                }
                if($req->category == 3 && $adv_list->sc_post ==0){
                    $category_post=true;
                }
                if($req->category == 4 && $adv_list->st_post ==0){
                    $category_post=true;
                }

                //for age relaxation
                $age_relax=0;
                if($req->category == 2 && $adv_list->age_relax_obc !=0){

                    $age_relax= $adv_list->age_relax_obc;
                }
                if($req->category == 3 && $adv_list->age_relax_sc !=0){

                    $age_relax= $adv_list->age_relax_sc;
                }
                if($req->category == 4 && $adv_list->age_relax_st !=0){

                    $age_relax= $adv_list->age_relax_st;
                }



                if(($interval < $adv_list->min_age) || ($interval > ($adv_list->max_age + $age_relax) ||  $category_post || $sport_type)){
                    $chekk=true;
                    // dd($req->all());
                   // return redirect('/direct-recruitment/edit_profile_detail')->withInput()->with('error', "You are not eligible for $adv_list->post_name.");
                   return response()->json(['error' => true, 'msg' => "You are not eligible for $adv_list->post_name."]);
                }
            };
            // if($chekk){
            //     return response()->json(['error' => true, 'msg' => "You are not eligible for $adv_list->post_name."]);

            // }
        if ($req->domicile_certificate) {
            $domicile_certificate = "{$req->domicile_certificate->getClientOriginalName()}";
            $path = $req->file('domicile_certificate')->storeAs('direct_recruitment', $domicile_certificate, 'public');
        } else {
            $domicile_certificate = $req->domicile_certificate1;
        }
        if ($req->qualification_doc) {
            $qualification_doc = "{$req->qualification_doc->getClientOriginalName()}";
            $path = $req->file('qualification_doc')->storeAs('direct_recruitment', $qualification_doc, 'public');
        } else {
            $qualification_doc = $req->qualification_doc1;
        }

        if ($req->aadhar_card) {
            $aadhar_card = "{$req->aadhar_card->getClientOriginalName()}";
            $path = $req->file('aadhar_card')->storeAs('direct_recruitment', $aadhar_card, 'public');
        } else {
            $aadhar_card = $req->aadhar_card1;
        }
        if ($req->photograph) {
            $photograph = "{$req->photograph->getClientOriginalName()}";
            $path = $req->file('photograph')->storeAs('direct_recruitment', $photograph, 'public');
        } else {
            $photograph = $req->photograph1;
        }

        if ($req->signature) {
            $signature = "{$req->signature->getClientOriginalName()}";
            $path = $req->file('signature')->storeAs('direct_recruitment', $signature, 'public');
        } else {
            $signature = $req->signature1;
        }

        $check = DB::table('direct_recruitment')->where('user_id', Auth::guard('direct_recruitment')->user()->user_id)->update([

            'mother_name' => $req->mother_name,
            'father_name' => $req->father_name,
            'sport_type' => $req->sport_type,
            'category' => $req->category,
            'dob' => $req->dob,
            'place_of_birth' => $req->place_of_birth,
            'gender' => $req->gender,
            'marital_status' => $req->marital_status,
            'nationality' => $req->nationality,
            'religion' => $req->religion,
            'sport_achievement' => $req->achievement,
            'aadhar_no' => $req->aadhar_no,

            'domicile_certificate'      => $domicile_certificate,
            'qualification_doc'      => $qualification_doc,
            'aadhar_doc'      => $aadhar_card,
            'photograph_doc'      => $photograph,
            'signature_doc'      => $signature,
            // 'guardian_signature'      => $guardian_signature,

            'present_address' => $req->present_address,

            'present_state' =>$req->present_state,
            'present_district' => $req->present_district,
            'present_pincode' => $req->present_pincode,
            'permanent_address' => $req->permanent_address,
            // 'permanent_state' =>$req->permanent_state,
            'permanent_district' => $req->permanent_district,
            'permanent_pincode' => $req->permanent_pincode

        ]);
        DB::table('applicant_post_master')->where('user_id', Auth::guard('direct_recruitment')->user()->user_id)->delete();
        foreach ($req->post_name as $key => $item) {
            $ch = DB::table('applicant_post_master')->insertGetId(array(
                'user_id' => Auth::guard('direct_recruitment')->user()->user_id,
                'post_type' => $req->post_type[$key],
                'post_name' => $req->post_name[$key],
            ));
        };

        if ($ch) {
            $check = DB::table('direct_recruitment')->where('user_id', Auth::guard('direct_recruitment')->user()->user_id)->update(['profile_complete' => 1]);
            session()->flash('success', 'Profile Successfully Updated.');
            return response()->json(["error" => false, "msg" => "Detail Successfully Updated.", "url" => url('/direct-recruitment/formPreview')]);
            // return redirect('/direct-recruitment/formPreview')->with('success', 'Profile Successfully Updated.');
        } else {
            session()->flash('error', 'Profile Not Updated.');
            // return redirect('/direct-recruitment/edit_profile_detail')->with('error', 'Profile Not Updated.');
            return response()->json(['error' => true, 'msg' => "Profile Not Updated."]);
        }
    }

    public function finalSubmit()
    {

        $check = DB::table('direct_recruitment')->where('user_id', Auth::guard('direct_recruitment')->user()->user_id)->update([
            'final_submit' => 1,
        ]);
        StatusChangeLog::dispatch(6,Auth::guard('direct_recruitment')->user()->user_id,"","Form Submitted","direct_recruitment");
        if ($check) {
            session()->flash('success', 'Application Successfully Updated.');
            return redirect('/direct-recruitment/dashboard')->with('success', 'Successfully Submitted.');
        } else {
            session()->flash('error', 'Application Not Updated.');
            return redirect('/direct-recruitment/edit_profile_detail')->with('error', 'Profile Not Updated.');
        }
    }


    //jyoti
    public function postDetail(){
        $advpostdetails = DB::table('advertisment_post_master')->distinct()
        ->orderBy('id', 'desc')
        ->get(['advertisment_no']);
        foreach ($advpostdetails as $key=>$advpostdetail) {

        $data[$key]['advt']=$advpostdetail->advertisment_no;
         $advposts = DB::table('advertisment_post_master')
         ->where('advertisment_post_master.advertisment_no','=', $advpostdetail->advertisment_no)
         ->get();
         $data[$key]['data']=$advposts;
        }
     return view('directRecruitment.post_detail', compact('advpostdetails','data'));
    }

    public function advertisment_details(Request $req){

        $adv_list = DB::table('advertisment_post_master')->where('post_name', $req->id)->orderBy('id', 'DESC')->first();

         return response()->json(["error" => false,"data"=>$adv_list]);
    }
    public function advertisment_session(Request $req){
        // $chekk=str_replace('_','/',$id);
    //    dd($req->id);
       session()->put('adv_no', $req->id);
       return response()->json(["error" => false, "url" => url('/direct-recruitment/loginForm')]);

        // $adv_list = DB::table('advertisment_post_master')->where('post_name', $req->id)->orderBy('id', 'DESC')->first();
        // dd($adv_list);
        // return response()->json(["error" => false,"data"=>$adv_list]);
    //  return view('directRecruitment.advertisment_detail', compact('adv_list'));
    }



}
