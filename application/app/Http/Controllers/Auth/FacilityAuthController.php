<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserLoggedIn;
use App\Events\ChangePasswordLog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Events\SmsMail;
use App\Models\FacilityRegister;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FacilityAuthController extends Controller
{
    // register view page

    public function register()
    {

        $Code1 = rand(11, 99);
        $Code2 = rand(11, 99);
        $capchaCode = $Code1 + $Code2;
        session()->put('capchaCode', $capchaCode);
        return view('facility_booking.register', compact('capchaCode', 'Code1', 'Code2'));
    }



    // login view page

    public function login()
    {
        $Code1 = rand(11, 99);
        $Code2 = rand(11, 99);
        $capchaCode = $Code1 + $Code2;
        session()->put('capchaCode', $capchaCode);
        //$captchaCode = rand(11111, 99999);
        //session()->put('captchaCode', $captchaCode);
        return view('facility_booking.login', compact('capchaCode', 'Code1', 'Code2'));
    }


    // otp view page

    public function otp()
    {
        return view('facility_booking.otp');
    }


    public function registerStore(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'fathername' => 'required',
            'mothername' => 'required',
            'nationality' => 'required',
            'dob' => 'required',
            'email' => 'required|email',

            'mobile' => 'required|numeric|digits:10',
            'captcha' => 'required'
        ]);

        if ($request->captcha != $request->capchaCode) {
            return redirect()->back()->with('error', 'Oops! Invalid Captcha Code.');
        }

        $otp = rand(111111, 999999);
        $randomPassword = rand(11111111, 99999999);
        $data = [
            'name' => $request->name,
            'fathername' => $request->fathername,
            'mothername' => $request->mothername,
            'nationality' => $request->nationality,
            'dob' => $request->dob,
            'email' => $request->email,
            'age' => $request->age,
            'mobile' => $request->mobile,
            'otp' => $otp,
            'decoded_password' => $randomPassword,
            'password' => Hash::make($randomPassword),
        ];
        $user = FacilityRegister::where('email', $request->email)->where('otp_verify', 0)->first();
        if ($user) {
            $user->update($data);
            session()->put('email', $request->email);
            session()->put('mobile', $request->mobile);
            session()->put('form_type', 1);
            SmsMail::dispatch([
                "otp" => $otp,
                "email" => $request->email,
                "mobile" => $request->mobile
            ], 1);

            return response()->json(['error' => false, 'msg' => 'OTP Sent Successfully./ओटीपी सफलतापूर्वक अग्रेषित कर दिया गया है।.', 'url' => route('facility_booking.otp')]);
            //return redirect()->route('facility_booking.otp')->with('success', 'OTP Sent Successfully./ओटीपी सफलतापूर्वक अग्रेषित कर दिया गया है।');
        }

        $user = FacilityRegister::where('email', $request->email)->first();
        if ($user) {
            return back()->withErrors([
                'email' => 'Email Already exist.',
            ])->onlyInput('email');
        }
        //dd($data);
        $registerUser = FacilityRegister::create($data);
        $user = Auth::guard('facility_booking')->user();
        $user->level = '1';
        $user->save();

        session()->put('email', $request->email);
        session()->put('mobile', $request->mobile);
        session()->put('form_type', 1);
        SmsMail::dispatch([
            "otp" => $otp,
            "email" => $request->email,
            "mobile" => $request->mobile
        ], 1);

        return response()->json(['error' => false, 'msg' => 'OTP Sent Successfully./ओटीपी सफलतापूर्वक अग्रेषित कर दिया गया है।.', 'url' => route('facility_booking.otp')]);

        //return redirect()->route('facility_booking.otp')->with('success', ' OTP Sent Successfully./ओटीपी सफलतापूर्वक अग्रेषित कर दिया गया है।');

    }


    public function otpStore(Request $req)
    {
        //dd(session()->get('email'));
        $otp = $req->otp1 . $req->otp2 . $req->otp3 . $req->otp4 . $req->otp5 . $req->otp6;
        $email = session()->get('email');

        $user = FacilityRegister::where('email', $email)->where('otp', $otp)->first();

        if ($user) {
            $user->otp_verify = 1;
            $user->save();
            SmsMail::dispatch(["id" => $user->id], 5);
            return response()->json(['error' => false, 'msg' => 'Successfully Registered on the Portal./पोर्टल पर सफलतापूर्वक पंजीकृत हो गए हैं।.', 'url' => route('facility_booking_login')]);

            //return redirect()->route('facility_booking.login')->with("success" , "Successfully Registered on the Portal./पोर्टल पर सफलतापूर्वक पंजीकृत हो गए हैं।");
        }

        return response()->json(['error' => true, 'msg' => 'Oops! Invalid OTP  Please try again.']);
        // return redirect()->back()->with('error', 'Oops! Invalid OTP  Please try again .');

    }

    public function loginStore(Request $request)
    {
        // dd($request);
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'captcha' => 'required',

        ]);
        $user = FacilityRegister::where('email', $request->email)->where('otp_verify', 0)->first();

        if ($user) {

            return Redirect()->route('facility_booking.register')->with('error', 'Please Register First.');
        }

        if ($request->captcha != $request->capchaCode) {
            return back()->withErrors([
                'captcha' => 'Oops! Invalid Captcha Code.',
            ])->onlyInput('captcha');
        }
        //dd('hello12');
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',

        ]);
        //dd(Auth::guard('facility_booking')->attempt($credentials));
        if (Auth::guard('facility_booking')->attempt($credentials)) {
            FacilityRegister::where('email', $request->email)->first()->update(['last_login' => date('Y-m-d H:i:s')]);

            if (Auth::guard('facility_booking')->user()->change_password_status == 1) {
                return redirect()->route('facility_booking.applicationForm')->with('success', 'Logged In Successfully./सफलतापूर्वक लॉगिन हो गए हैं।');
            } else {
                return redirect()->route('facility_booking.changePassword')->with('success', 'Logged In Successfully./सफलतापूर्वक लॉगिन हो गए हैं।');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials does not match our records.',
        ])->onlyInput('email');
    }

    public function changePassword()
    {
        return view('facility_booking.update_password');
    }


    public function logout()
    {
        Auth::guard('facility_booking')->logout();
        return Redirect()->route('facility_booking.login')->with('success', 'User Logout successfully.');
    }


    public function changepasswordStore(Request $request)
    {
        //  dd( $request);
        $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required|min:8',
            'confirmpassword' => 'required|min:8|same:newpassword',
        ]);


        if ($request->confirmpassword != $request->newpassword) {
            return back()->withErrors([
                'confirmpassword' => 'Oops! Confirm Password Does not Match.',
            ])->onlyInput('confirmpassword');
        }
        $user = Auth::guard('facility_booking')->user();
        if ($user->decoded_password != $request->oldpassword) {
            return back()->withErrors([
                'oldpassword' => 'Oops! Old Password Does not Match.',
            ])->onlyInput('oldpassword');
        }

        // $checkold =  DB::table('change_password_log')->where('type', 2)->where('email',Auth::guard('facility_booking')->user()->email )->where('user_id',Auth::guard('facility_booking')->user()->id)->take(3)->orderByDesc('id')->get();
        // if($checkold){
        // foreach ($checkold as $key => $value) {
        //  if($value->password == $request->newpassword){
        //       return back()->with(
        //'error','Already used this Password.',
        //     );
        //   }
        // }
        // }
        //ChangePasswordLog::dispatch(2, Auth::guard('facility_booking')->user()->id,Auth::guard('facility_booking')->user()->email, $request->newpassword );
        $userUpdate = FacilityRegister::find($user->id);

        $data = [
            'decoded_password' => $request->newpassword,
            'password' => Hash::make($request->newpassword),
            'change_password_status' => 1
        ];

        $userUpdate->update($data);


        Auth::guard('facility_booking')->logout();
        return Redirect()->route('facility_booking.login')->with('success', 'Password Changed Successfully./पासवर्ड सफलतापूर्वक बदल दिया गया है।');
    }

    public function resendotp()
    {
        $otp = rand(111111, 999999);

        FacilityRegister::where('email', session()->get('email'))->update(
            ["otp" => $otp]
        );

        SmsMail::dispatch([
            "otp" => $otp,
            "email" => session()->get('email'),
            "mobile" => session()->get('mobile')
        ], 1);
        return redirect()->back()->with('success', 'Otp Resend Successfully');
    }


    public function forgot()
    {
        return view('facility_booking.forgot');
    }

    public function forgotStore(Request $req)
    {

        $user = FacilityRegister::where('email', $req->email)->first();
        if ($user != "") {
            // dd($reply->mobile);
            $check = SmsMail::dispatch([
                "password" => $user->decoded_password,
                "email" => $req->email,
                "mobile" => $user->mobile
            ], 18);
            return redirect()->route('facility_booking.login')->with('success', "Password has been sent on the registered Mobile No./Email ID./पासवर्ड पंजीकृत मोबाइल नंबर/ईमेल आईडी पर भेज दिया गया है।");
        }
        return redirect()->route('facility_booking.forgot')->with('error', "Email does not exists");
    }


    // public function cp_refresh()
    //     {

    //         // $capchaCode = rand(11111, 99999);
    //         // session()->put('capchaCode', $capchaCode);

    //         $Code1 = rand(11, 99);
    //         $Code2 = rand(11, 99);
    //         $capchaCode = $Code1 + $Code2;
    //         session()->put('capchaCode', $capchaCode);
    //         $data['capchaCode'] = $capchaCode;
    //         $data['Code1'] = $Code1;
    //         $data['Code2'] = $Code2;
    //         return response()->json($data);
    //     }



}
