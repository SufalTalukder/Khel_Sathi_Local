<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Events\SmsMail;
use App\Models\PlayerRegistration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PlayerAuthController extends Controller
{
    //registration
    public function player_register()
    {

        $captchaCode = rand(11111, 99999);
        session()->put('captchaCode', $captchaCode);
        return view('player.player_registration', compact('captchaCode'));
    }

    //player_registrationStore
    public function player_registrationStore(Request $request)
    {
        $checkEmail_for_registered = DB::table('player_registration')->where('email', $request->email)->first();
        if ($checkEmail_for_registered) {
            $otp = rand(111111, 999999);
            session()->put('email', $request->email);
            session()->put('mobile', $request->mobile);
            session()->put('form_type', 1);
            SmsMail::dispatch([
                "otp" => $otp,
                "email" => $request->email,
                "mobile" => $request->mobile
            ], 1);
            $data = [
                'name' => $request->name,
                'dob' => $request->dob,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'otp' => $otp,
            ];
            DB::table('player_registration')->where('id', $checkEmail_for_registered->id)->update($data);
            return redirect()->route('playerotp')->with('error', 'Oops! Varification is pending for this email id, Please varify the OTP.');
            //return redirect('playerotp'.base64_encode($checkEmail_for_registered->id))->with('error', 'Oops! Varification is pending for this email id, Please varify the OTP.');
        }
        $request->validate([
            'name' => 'required|max:100',
            'dob' => 'required',
            'email' => 'required|email',
            'captchacode' => 'required',
            'captcha' => 'required',
            'mobile' => 'required|numeric|digits:10',
        ]);

        if ($request->captcha != $request->captchacode) {
            return redirect()->back()->with('error', 'Oops! Invalid Captcha Code.');
        }
        $otp = rand(111111, 999999);
        $randomPassword = rand(11111111, 99999999);
        $data = [
            'name' => $request->name,
            'dob' => $request->dob,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'otp' => $otp,
            'decoded_password' => $randomPassword,
            'password' => Hash::make($randomPassword),
            'status_preview' => 1,
        ];

        $user = PlayerRegistration::where('email', $request->email)->where('otp_verify', 0)->first();
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

            return redirect()->route('playerotp')->with('success', ' OTP Sent Successfully./ओटीपी सफलतापूर्वक अग्रेषित कर दिया गया है।');
        }

        $user = PlayerRegistration::where('email', $request->email)->first();
        if ($user) {
            return back()->withErrors([
                'email' => 'Email Already exist.',
            ])->onlyInput('email');
        }

        $registerUser = PlayerRegistration::create($data);

        session()->put('email', $request->email);
        session()->put('mobile', $request->mobile);
        session()->put('form_type', 1);
        SmsMail::dispatch([
            "otp" => $otp,
            "email" => $request->email,
            "mobile" => $request->mobile
        ], 1);

        return redirect()->route('playerotp')->with('success', ' OTP Sent Successfully./ओटीपी सफलतापूर्वक अग्रेषित कर दिया गया है।');
    }


    //login
    public function player_login()
    {
        $captchaCode = rand(11111, 99999);
        session()->put('captchaCode', $captchaCode);
        return view('player.player_login', compact('captchaCode'));
    }

    //login
    public function player_loginStore(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'captcha' => 'required',

        ]);
        $user = PlayerRegistration::where('email', $request->email)->where('otp_verify', 0)->first();
        if ($user) {
            return Redirect()->route('playerregistration')->with('error', 'Please Register First.');
        }

        if ($request->captcha != $request->captchacode) {
            return back()->withErrors([
                'captcha' => 'Oops! Invalid Captcha Code.',
            ])->onlyInput('captcha');
        }

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',

        ]);
        Auth::guard('player')->attempt($credentials);
        if (Auth::guard('player')->attempt($credentials)) {
            PlayerRegistration::where('email', $request->email)->first()->update(['last_login' => date('Y-m-d H:i:s')]);

            if (Auth::guard('player')->user()->change_password_status == 1) {
                return redirect()->route('playerdashboard')->with('success', 'Logged In Successfully./सफलतापूर्वक लॉगिन हो गए हैं।');
            } else {
                return redirect()->route('playerchangepassword')->with('success', 'Logged In Successfully./सफलतापूर्वक लॉगिन हो गए हैं।');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials does not match our records.',
        ])->onlyInput('email');
    }

    //otp
    public function player_otp()
    {
        return view('player.player_otp');
    }

    //otpstore
    public function player_otpStore(Request $req)
    {
        $otp = $req->otp1 . $req->otp2 . $req->otp3 . $req->otp4 . $req->otp5 . $req->otp6;
        $email = session()->get('email');
        // dd($email);
        $user = PlayerRegistration::where('email', $email)->where('otp', $otp)->first();
        if ($user) {
            $user->otp_verify = 1;
            $user->save();
            SmsMail::dispatch(["id" => $user->id],  17);
            return redirect()->route('playerlogin')->with("success", "Successfully Registered on the Portal./पोर्टल पर सफलतापूर्वक पंजीकृत हो गए हैं।");
        }
        return redirect()->back()->with('error', 'Oops! Invalid OTP  Please try again .');
    }

    //resendotp
    public function player_resendotp()
    {
        $otp = rand(111111, 999999);

        PlayerRegistration::where('email', session()->get('email'))->update(
            ["otp" => $otp]
        );

        SmsMail::dispatch([
            "otp" => $otp,
            "email" => session()->get('email'),
            "mobile" => session()->get('mobile')
        ], 1);
        return redirect()->back()->with('success', 'Otp Resend Successfully');
    }
    //changepassword
    public function player_changepassword()
    {
        return view('player.player_updatepassword');
    }

    //changepasswordStore
    public function player_changepasswordStore(Request $request)
    {
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
        $user = Auth::guard('player')->user();
        if ($user->decoded_password != $request->oldpassword) {
            return back()->withErrors([
                'oldpassword' => 'Oops! Old Password Does not Match.',
            ])->onlyInput('oldpassword');
        }

        $userUpdate = PlayerRegistration::find($user->id);

        $data = [
            'decoded_password' => $request->newpassword,
            'password' => Hash::make($request->newpassword),
            'change_password_status' => 1
        ];

        $userUpdate->update($data);
        Auth::guard('player')->logout();
        return Redirect()->route('playerlogin')->with('success', 'Password Changed Successfully./पासवर्ड सफलतापूर्वक बदल दिया गया है।');
    }


    //application
    //logout
    public function player_logout()
    {
        Auth::guard('player')->logout();
        return Redirect()->route('playerlogin')->with('success', 'User Logout successfully.');
    }

    public function player_forgotpassword()
    {
        return view('player.player_forgotpassword');
    }
    public function player_forgotStore(Request $req)
    {
        $user = PlayerRegistration::where('email', $req->email)->first();
        //dd($user);
        if ($user != "") {
            //dd($reply->mobile);
            $check = SmsMail::dispatch([
                "password" => $user->decoded_password,
                "email" => $req->email,
                "mobile" => $user->mobile
            ], 16);
            return redirect()->route('playerlogin')->with('success', "Password has been sent on the registered Mobile No./Email ID./पासवर्ड पंजीकृत मोबाइल नंबर/ईमेल आईडी पर भेज दिया गया है।");
        }
        return redirect()->route('playerforgotpassword')->with('error', "Email does not exists");
    }



}
