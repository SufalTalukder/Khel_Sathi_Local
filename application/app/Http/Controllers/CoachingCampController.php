<?php

namespace App\Http\Controllers;

use App\Events\SmsMail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CoachingCamp;
use Illuminate\Support\Facades\Hash;


use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CoachingCampController extends Controller
{
    public function coaching_camp_register()
    {
        $Code1 = rand(11, 99);
        $Code2 = rand(11, 99);
        $capchaCode = $Code1 +  $Code2;
        session()->put('capchaCode', $capchaCode);
        return view('coaching_camp.register',  compact('capchaCode', 'Code1', 'Code2'));
    }

    public function coaching_camp_otp()
    {
        return view('coaching_camp.otp');
    }

    public function coaching_camp_login()
    {

        $Code1 = rand(11, 99);
        $Code2 = rand(11, 99);
        $capchaCode = $Code1 +  $Code2;
        session()->put('capchaCode', $capchaCode);

        return view('coaching_camp.login', compact('capchaCode', 'Code1', 'Code2'));
    }

    public function coaching_camp_forget_password()
    {
        return view('coaching_camp.forget_password');
    }

    public function coaching_camp_change_password()
    {
        return view('coaching_camp.change_password');
    }

    public function coaching_camp_application_form()
    {

        $sport = DB::table('sport_type')->where('status', 1)->orderBy('name')->get();
        $applicationview = DB::table('coaching_camp_basic_details')->where('user_id', Auth::guard('CoachingCamp')->user()->id)->first();
        $states = DB::table('states')->orderBy('name')->get();

        $districts = DB::table('cities')->where('state_id', 23)->orderBy('city')->get();
        $stadium = DB::table('studium_master')->get();

        $districtall = DB::table('cities')->orderBy('city')->get();
        return view('coaching_camp.application_form', compact('stadium', 'sport', 'applicationview', 'states', 'districts', 'districtall'));
    }


    public function coaching_camp_application_preview()
    {

        $applicationview = DB::table('coaching_camp_basic_details as a')->leftJoin('studium_master as b','a.stadium','b.id')
        ->select('a.*','b.studium_name as stadium_name')
        ->where('user_id', Auth::guard('CoachingCamp')->user()->id)->first();

        return view('coaching_camp.application_preview', compact('applicationview'));
    }

    public function coaching_camp_dashboard()
    {


        if (Auth::guard('CoachingCamp')->user()->change_password  != 1) {
            return redirect()->route('coaching_camp_change_password');
        }

        $applicationview = DB::table('coaching_camp_basic_details')->where('user_id', Auth::guard('CoachingCamp')->user()->id)->first();

        if (!$applicationview) {
            return redirect()->route('coaching_camp_application_form');
        }


        return view('coaching_camp.dashboard', compact('applicationview'));
    }


    public function coaching_camp_regsiter_store(Request $request)
    {

        $user = CoachingCamp::where('email', $request->email)->where('verified', 1)->first();
        if ($user) {
            return response()->json(["error" => true, "msg" => "Already Registered with this Email."]);
        }

        $checkEmail_for_registered = DB::table('coaching_camp_register')->where('email', $request->email)->first();
        if ($checkEmail_for_registered  && $checkEmail_for_registered->verified == 0) {
            $validation = Validator::make($request->all(), [
                'name' => 'required|max:100',
                'email' => 'required|email',
                'captchacode' => 'required',
                'captcha' => 'required',
                'aadhar' => 'required',
                'dob' => 'required|date|after:' . date('Y-m-d', strtotime('-18 years')),
                'mobile' => 'required|numeric|digits:10',
            ]);
            if ($validation->fails())
                return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
            if ($request->captcha != $request->captchacode) {
                return response()->json(["error" => true, "msg" => "Oops! Invalid Captcha Code."]);
            }

            //$otp = 123456;
             $otp = rand(111111, 999999);
            session()->put('email', $request->email);
            session()->put('mobile', $request->mobile);

            SmsMail::dispatch([
                "otp" => $otp,
                "email" => $request->email,
                "mobile" => $request->mobile
            ], 1);
            $data = [
                'name' => $request->name,

                'email' => $request->email,
                'mobile' => $request->mobile,
                'aadhar' => $request->aadhar,
                'dob' => $request->dob,
                'otp' => $otp,

            ];
            DB::table('coaching_camp_register')->where('id', $checkEmail_for_registered->id)->update($data);

            return response()->json(["error" => false, "msg" => "OTP Sent Successfully./ओटीपी सफलतापूर्वक अग्रेषित कर दिया गया है।",  "url" => route('coaching_camp_otp')]);

            //return redirect('CoachingCampotp'.base64_encode($checkEmail_for_registered->id))->with('error', 'Oops! Varification is pending for this email id, Please varify the OTP.');
        }
        $validation = Validator::make($request->all(), [
            'name' => 'required|max:100',

            'email' => 'required|email',
            'captchacode' => 'required',
            'captcha' => 'required',
            'dob' => 'required|date|after:' . date('Y-m-d', strtotime('-18 years')),
            'aadhar' => 'required|unique:coaching_camp_register',
            'mobile' => 'required|numeric|digits:10',
        ]);

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        if ($request->captcha != $request->captchacode) {
            return response()->json(["error" => true, "msg" => "Oops! Invalid Captcha Code."]);
        }
        $otp = rand(111111, 999999);
        //$otp = 123456;
        $randomPassword =   rand(11111111, 99999999);
        $data = [
            'name' => $request->name,
            'otp' => $otp,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'aadhar' => $request->aadhar,
            'dob' => $request->dob,
            'decoded_password' => $randomPassword,
            'password' => Hash::make($randomPassword),
        ];

        $registerUser = CoachingCamp::create($data);

        session()->put('email', $request->email);
        session()->put('mobile', $request->mobile);
        session()->put('form_type', 1);
        SmsMail::dispatch([
            "otp" => $otp,
            "email" => $request->email,
            "mobile" => $request->mobile
        ], 1);
        return response()->json(["error" => false, "msg" => "OTP Sent Successfully./ओटीपी सफलतापूर्वक अग्रेषित कर दिया गया है।", "url" => route('coaching_camp_otp')]);
    }

    public function cp_refresh()
    {
        $Code1 = rand(11, 99);
        $Code2 = rand(11, 99);
        $capchaCode = $Code1 +  $Code2;
        session()->put('capchaCode', $capchaCode);
        $data['capchaCode'] = $capchaCode;
        $data['Code1'] = $Code1;
        $data['Code2'] = $Code2;
        return response()->json($data);
    }

    public function coaching_camp_otpStore(Request $req)
    {
        $otp = $req->otp1 . $req->otp2 . $req->otp3 . $req->otp4 . $req->otp5 . $req->otp6;
        $email = session()->get('email');

        $user = CoachingCamp::where('email', $email)->where('otp', $otp)->first();

        if ($user) {
            $user->verified = 1;
            $user->created_on = now();

            $user->save();
            SmsMail::dispatch(["id" => $user->id],  20);
            return response()->json(["error" => false, "msg" => "Successfully Registered on the Portal./पोर्टल पर सफलतापूर्वक पंजीकृत हो गए हैं।", "url" => route('coaching_camp_login')]);
        }
        return response()->json(["error" => true, "msg" => "Oops! Invalid OTP  Please try again ."]);
    }




    public function coaching_camp_resendotp()
    {
       // $otp = 123456;
        $otp = rand(111111, 999999);

        CoachingCamp::where('email', session()->get('email'))->update(
            ["otp" => $otp]
        );

        SmsMail::dispatch([
            "otp" => $otp,
            "email" => session()->get('email'),
            "mobile" => session()->get('mobile')
        ], 1);
        return response()->json(["error" => false, "msg" => "Otp Resend Successfully."]);
    }

    public function loginStore(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'captcha' => 'required',

        ]);

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
        $user = CoachingCamp::where('email', $request->email)->where('verified', 0)->first();
        if ($user) {
            return response()->json(["error" => true, "msg" => "Please Register First."]);
        }

        if ($request->captcha != $request->captchacode) {

            return response()->json(["error" => true, "msg" => "Oops! Invalid Captcha Code."]);
        }

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',

        ]);
        Auth::guard('CoachingCamp')->attempt($credentials);
        if (Auth::guard('CoachingCamp')->attempt($credentials)) {
            CoachingCamp::where('email', $request->email)->first()->update(['last_login' => date('Y-m-d H:i:s')]);

            if (Auth::guard('CoachingCamp')->user()->change_password == 1) {
                return response()->json(["error" => false, "msg" => "Logged In Successfully./सफलतापूर्वक लॉगिन हो गए हैं।", "url" => route('coaching_camp_dashboard')]);
            } else {

                return response()->json(["error" => false, "msg" => "Logged In Successfully./सफलतापूर्वक लॉगिन हो गए हैं।", "url" => route('coaching_camp_change_password')]);
            }
        }
        return response()->json(["error" => true, "msg" => "The provided credentials does not match our records"]);
    }




    public function changepasswordStore(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:8|different:old_password',
            'confirm_password' => 'required|min:8|same:new_password',
        ]);
        if ($validation->fails())
            //   return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
            return redirect()->route('coaching_camp_login')->with('error',  $validation->errors()->first());

        $user = Auth::guard('CoachingCamp')->user();
        //    if ($user->decoded_password != $request->old_password) {
        //     return response()->json(['error' => true, 'msg' => 'Old Password Does Not Match Our Record.']);
        //    }

        $userUpdate = CoachingCamp::find($user->id);



        $data = [
            'decoded_password' => $request->new_password,
            'password' => Hash::make($request->new_password),
            'change_password' => 1
        ];

        $userUpdate->update($data);
        Auth::guard('CoachingCamp')->logout();
        // return response()->json(['error' => false, 'msg' => 'Password Changed Successfully./पासवर्ड सफलतापूर्वक बदल दिया गया है।', 'url'=> route('coaching_camp_login')]);
        return redirect()->route('coaching_camp_login')->with('success', 'Password Changed Successfully./पासवर्ड सफलतापूर्वक बदल दिया गया है।');
    }



    public function forgotStore(Request $req)
    {
        $user = CoachingCamp::where('email', $req->email)->first();


        if ($user) {

            SmsMail::dispatch(["id" => $user->id],  20);
            return response()->json(["error" => false, "msg" => "Password has been sent on the registered Mobile No./Email ID./पासवर्ड पंजीकृत मोबाइल नंबर/ईमेल आईडी पर भेज दिया गया है।", "url" => route('coaching_camp_login')]);
        }
        return response()->json(["error" => true, "msg" => "Email does not exists"]);
    }




    public function application_form_store(Request $request)
    { 
        $validation = Validator::make($request->all(), [
            'sport' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'religion' => 'required',
       
            'category' => 'required',
            'permanent_address' => 'required',
            'permanent_state' => 'required',
            'permanent_district' => 'required',
            'permanent_pin' => 'required',
            'correspondence_address' => 'required',
            'correspondence_state' => 'required',
            'correspondence_district' => 'required',
            'correspondence_pin' => 'required',
            'stadium' => 'required',
            'is_applicant_suffering_disease' => 'nullable',
       
        
            'height' => 'required',
            'weight' => 'required',
            'visible_identification_mark' => 'required',
            'blood_group' => 'nullable',
        ]);
        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        $data = [
            'user_id' => Auth::guard('CoachingCamp')->user()->id,
            'sport'=>implode(',', $request->input('sport')),
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'religion' => $request->religion,
           
            'category' => $request->category,
            'permanent_address' => $request->permanent_address,
            'permanent_state' => $request->permanent_state,
            'permanent_district' => $request->permanent_district,
            'permanent_pin' => $request->permanent_pin,
            'correspondence_address' => $request->correspondence_address,
            'correspondence_state' => $request->correspondence_state,
            'correspondence_district' => $request->correspondence_district,
            'correspondence_pin' => $request->correspondence_pin,
            'stadium' => $request->stadium,
            'blood_group' => $request->blood_group,
            'is_applicant_suffering_disease' => $request->is_applicant_suffering_disease,
            'height' => $request->height,
            'weight' => $request->weight,
            'visible_identification_mark' => $request->visible_identification_mark,
        ];

        if ($request->hasFile('profile_picture')) {
            $profile_picture = moveFile('coaching_camp/profile_picture', $request->profile_picture);
            $data['profile_picture'] = $profile_picture;
        }

        if ($request->is_applicant_suffering_disease == 1 && $request->hasFile('medical_certificate')) {
            $medical_certificate = moveFile('coaching_camp/medical_certificate', $request->medical_certificate);
            $data['medical_certificate'] = $medical_certificate;
        }elseif ($request->is_applicant_suffering_disease == 0) {
            $data['medical_certificate'] = '';
        }

        if ($request->hasFile('aadhar_card_photo')) {
            $aadhar_card_photo = moveFile('coaching_camp/aadhar_card_photo', $request->aadhar_card_photo);
            $data['aadhar_card_photo'] = $aadhar_card_photo;
        }

        if ($request->hasFile('signature')) {
            $signature = moveFile('coaching_camp/signature', $request->signature);
            $data['signature'] = $signature;
        }

        $applicationview = DB::table('coaching_camp_basic_details')->where('user_id', Auth::guard('CoachingCamp')->user()->id)->first();

        if ($applicationview) {

            DB::table('coaching_camp_basic_details')->where('user_id', Auth::guard('CoachingCamp')->user()->id)->update($data);
        } else {

            DB::table('coaching_camp_basic_details')->insert($data);
        }

        return response()->json(['error' => false, 'msg' => 'Application Basic Detail Submitted Successfully.', "url" => route('coaching_camp_application_preview')]);
    }



    public function applicationfinalSubmit()
    {

        $basicId = DB::table('coaching_camp_basic_details')->where('user_id', Auth::guard('CoachingCamp')->user()->id)->first()->id;

        DB::table('coaching_camp_basic_details')->where('user_id', Auth::guard('CoachingCamp')->user()->id)->update([
            'final_submit' => 1,
            'application_no' => $this->appNumberGenerate($basicId),
            'created' => now()
        ]);
        return response()->json(['error' => false, 'msg' => 'Final Submission of Application is completed.', "url" => route('coaching_camp_dashboard')]);

        //    return redirect()->route('coaching_camp_dashboard')->with('success', 'Final Submission of Application is completed.');

    }

    public function logout()
    {
        Auth::guard('CoachingCamp')->logout();
        return redirect()->route('coaching_camp_login')->with('success', 'Logout Successfully.');
    }

    public function appNumberGenerate($basicId)
    {
        return date('Y') . sprintf("%06d", $basicId);
    }


   
}
