<?php

namespace App\Http\Controllers\Auth;

use App\Events\ChangePasswordLog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Events\SmsMail;
use Illuminate\Support\Facades\Validator;
use App\Exports\HostelExport;
use App\Models\HostelRegister;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class HostelAuthController extends Controller
{
    // register view page

    public function register()
    {

        $captchaCode = rand(11111, 99999);
        session()->put('captchaCode', $captchaCode);
        return view('hostel_auth.register', compact('captchaCode'));
    }



    // login view page

    public function login()
    {
        $captchaCode = rand(11111, 99999);
        session()->put('captchaCode', $captchaCode);
        return view('hostel_auth.login', compact('captchaCode'));
    }


    // otp view page

    public function otp()
    {
        return view('hostel_auth.otp');
    }


    public function registerStore(Request $request)
    {


        $request->validate([
            'name' => 'required|max:100',

            'dob' => 'required',
            'gender' => 'required',
            'native_of_up' => 'required',
            'aadhar' => 'required|numeric|digits:12',
            'mobile' => 'required|numeric|digits:10',
            'captchacode' => 'required',
            'captcha' => 'required',
            'email' => 'required|email',

        ]);

        $date1 = new \DateTime($request->dob);
        $date2 = new \DateTime(config('app.session_year') . "-04-01");
        $interval = ($date1->diff($date2))->y;

        if ($interval > 15 || $interval < 8) {
            return redirect()->back()->with('error', 'Applicant must be between 8 and 15 years old as on 1st April.');
        }



        if ($request->captcha != $request->captchacode) {


            return redirect()->back()->with('error', 'Oops! Invalid Captcha Code.');
        }






        $otp = rand(111111, 999999);
        $randomPassword = rand(11111111, 99999999);
        $data = [
            'name' => $request->name,
            'native_of_up' => 'Uttar Pradesh',
            'dob' => $request->dob,
            'aadhar' => $request->aadhar,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'otp' => $otp,
            'gender' => $request->gender,
            'decoded_password' => $randomPassword,
            'password' => Hash::make($randomPassword),
            'session_year' => config('app.session_year'),
            'change_password_status' => 0
        ];


        $user = HostelRegister::where('email', $request->email)->where('otp_verify', 0)->where('session_year', config('app.session_year'))->first();
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

            return redirect()->route('hostel.otp')->with('success', ' OTP Sent Successfully./ओटीपी सफलतापूर्वक अग्रेषित कर दिया गया है।');
        }

        $user = HostelRegister::where('email', $request->email)->where('session_year', config('app.session_year'))->first();
        if ($user) {
            return back()->withErrors([
                'email' => 'Email Already exist.',
            ])->onlyInput('email');
        }

        $registerUser = HostelRegister::create($data);

        session()->put('email', $request->email);
        session()->put('mobile', $request->mobile);
        session()->put('form_type', 1);
        SmsMail::dispatch([
            "otp" => $otp,
            "email" => $request->email,
            "mobile" => $request->mobile
        ], 1);

        return redirect()->route('hostel.otp')->with('success', ' OTP Sent Successfully./ओटीपी सफलतापूर्वक अग्रेषित कर दिया गया है।');

    }


    public function otpStore(Request $req)
    {

        $otp = $req->otp1 . $req->otp2 . $req->otp3 . $req->otp4 . $req->otp5 . $req->otp6;
        $email = session()->get('email');
        $user = HostelRegister::where('email', $email)->where('otp', $otp)->where('session_year', config('app.session_year'))->first();


        session()->put('form_type', 5);
        if ($user) {
            $user->otp_verify = 1;
            $user->save();
            SmsMail::dispatch(["id" => $user->id], 5);
            return redirect()->route('hostel.login')->with("success", "Successfully Registered on the Portal./पोर्टल पर सफलतापूर्वक पंजीकृत हो गए हैं।");
        }
        return redirect()->back()->with('error', 'Oops! Invalid OTP  Please try again .');

    }

    public function loginStore(Request $request)
    {



        $user = HostelRegister::where('email', $request->email)->where('otp_verify', 0)->orderBy('session_year', 'desc')->first();


        if ($user) {
            return Redirect()->route('hostel.register')->with('error', 'Please Register First.');
        }



        if ($request->captcha != $request->captchacode) {
            return back()->withErrors([
                'captcha' => 'Oops! Invalid Captcha Code.',
            ])->onlyInput('captcha');
        }


        // $credentials = $request->validate([
        //     'email'=>'required|email',
        //     'password'=>'required',

        // ]);
        $validation = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
            'captcha' => 'required',
        ], msg());

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);


        $plainEmail    = $request->email;
        $plainPassword = $request->password;

        $user = HostelRegister::where('email', $plainEmail)
            ->where('otp_verify', 1)
            ->orderBy('session_year', 'desc')
            ->first();

        if ($user && Hash::check($plainPassword, $user->password)) {
            Auth::guard('hostel')->login($user);
            $user->update(['last_login' => date('Y-m-d H:i:s')]);

            if (Auth::guard('hostel')->user()->change_password_status == 1) {
                return redirect()->route('hostel.dashboard')->with('success', 'Logged In Successfully./सफलतापूर्वक लॉगिन हो गए हैं।');
            }
            else {
                return redirect()->route('hostel.changePassword')->with('success', 'Logged In Successfully./सफलतापूर्वक लॉगिन हो गए हैं।');
            }

        }

        return back()->withErrors([
            'email' => 'The provided credentials does not match our records.',
        ])->onlyInput('email');


    }


    public function changePassword()
    {
        return view('hostel_auth.update_password');
    }


    public function logout()
    {
        Auth::guard('hostel')->logout();
        return Redirect()->route('hostel.login')->with('success', 'User Logout successfully.');
    }


    public function changepasswordStore(Request $request)
    {
        $request->validate([
            'oldpassword' => 'required',
            'newpassword' => ['required', 'string', 'min:8',
                'regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/'
            ],
            'confirmpassword' => 'required|min:8|same:newpassword',
        ]);


        if ($request->confirmpassword != $request->newpassword) {
            return back()->withErrors([
                'confirmpassword' => 'Oops! Confirm Password Does not Match.',
            ])->onlyInput('confirmpassword');
        }
        $user = Auth::guard('hostel')->user();
        if ($user->decoded_password != $request->oldpassword) {
            return back()->withErrors([
                'oldpassword' => 'Oops! Old Password Does not Match.',
            ])->onlyInput('oldpassword');

        }


        $checkold = DB::table('change_password_log')->where('type', 2)->where('email', Auth::guard('hostel')->user()->email)->where('user_id', Auth::guard('hostel')->user()->id)->take(3)->orderByDesc('id')->get();


        if ($checkold) {
            foreach ($checkold as $key => $value) {
                if ($value->password == $request->newpassword) {
                    return back()->with(
                        'error', 'Already used this Password.',
                    );
                }
            }
        }
        ChangePasswordLog::dispatch(2, Auth::guard('hostel')->user()->id, Auth::guard('hostel')->user()->email, $request->newpassword);


        $userUpdate = HostelRegister::find($user->id);

        $data = [
            'decoded_password' => $request->newpassword,
            'password' => Hash::make($request->newpassword),
            'change_password_status' => 1
        ];

        $userUpdate->update($data);


        Auth::guard('hostel')->logout();
        return Redirect()->route('hostel.login')->with('success', 'Password Changed Successfully./पासवर्ड सफलतापूर्वक बदल दिया गया है।');

    }




    public function resendotp()
    {
        $otp = rand(111111, 999999);

        HostelRegister::where('email', session()->get('email'))->update(
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
        return view('hostel_auth.forgot');
    }

    public function forgotStore(Request $req)
    {
        $user = HostelRegister::where('email', $req->email)->first();

        if ($user != "") {
            // dd($reply->mobile);
            $check = SmsMail::dispatch([
                "password" => $user->decoded_password,
                "email" => $req->email,
                "mobile" => $user->mobile
            ], 6);
            return redirect()->route('hostel.login')->with('success', "Password has been sent on the registered Mobile No./Email ID./पासवर्ड पंजीकृत मोबाइल नंबर/ईमेल आईडी पर भेज दिया गया है।");

        }

        return redirect()->route('hostel.forgot')->with('error', "Email does not exists");




    }



    public function chalan_print()
    {
        return view('hostel_auth.chlan_print');
    }


    public function update_challan_status(Request $req)
    {
        $req->validate([
            'branch_name' => 'required',
            'payment_district' => 'required',
            'paid_amount' => 'required',
            'payment_date' => 'required',

        ]);
        $data = [
            'branch_name' => $req->branch_name,
            'payment_district' => $req->payment_district,
            'paid_amount' => $req->paid_amount,
            'payment_date' => $req->payment_date,
            'payment_status' => 1,
        ];


        if ($req->file('payment_receipt')) {





            $file = $req->file('payment_receipt');
            $file_path = time() . $file->getClientOriginalName();
            $file->move(public_path('hostelapplicant/payment_receipt'), $file_path);
            $data['payment_receipt'] = $file_path;
        }

        HostelRegister::find(Auth::guard('hostel')->user()->id)->update($data);
        return redirect()->back()->with('success', 'Payment Status Update Successfully.');
    }
    //export
    public function hostelListExport(Request $request)
    {
        //dd($request->all);
        // $hostelList = HostelRegister::where('level', 4)->with('applicationBasicDetasils')->where('sports', $request->sports)->latest()->get();
        $division = DB::table('hostel_division_master')->get();
        $check = DB::table('hostel_div_district_mapping')
            ->select(DB::raw('group_concat(district_id) as district_id'))->where('division_id', Auth::guard('admin')->user()->division_id)->get();
        $districts = DB::table('cities')->where('state_id', 23);

        if (Auth::guard('admin')->user()->division_id) {
            $districts->whereIn('id', explode(',', $check[0]->district_id));
        }

        $districts = $districts->orderBy('city', 'asc')->get();
        $hostelList = DB::table('hostel_register as rg')
            ->join('hostel_application_basic as basic', 'rg.id', '=', 'basic.hostel_register_id')
            ->select('rg.*', 'basic.sports', 'basic.sub_sport_type', 'basic.district_id');
        if ($request->sport_id) {
            $hostelList->where('basic.sports', $request->sport_id);
        }

        if ($request->subsport) {
            $hostelList->where('basic.sub_sport_type', $request->subsport);
        }
        if ($request->city_filter) {
            $hostelList->where('basic.district_id', $request->city_filter);
        }
        if ($request->status_filter) {
            $hostelList->where('rg.status', $request->status_filter);
        }

        if (Auth::guard('admin')->user()->division_id > 0) {
            $hostelList->whereIn('basic.district_id', explode(',', $check[0]->district_id));
        }

        if (Auth::guard('admin')->user()->district_id > 0) {
            $hostelList->where('basic.district_id', Auth::guard('admin')->user()->district_id);
        }

        $hostelList = $hostelList->whereIn('rg.payment_status', [1, 2, 3])->get();
        //  dd($hostelList);
        $sports = DB::table('sport_master')->orderBy('name')->get();
        $divisions = DB::table('hostel_division_master')->orderBy('division_name')->get();
        $name = 'Hostel_Application' . date('m-d-Y') . 'List.xlsx';

        return Excel::download(new HostelExport($hostelList, $divisions, $sports, $districts), $name);




    }



    public function payment_response(Request $request)
    {
        dd('dgfd');
        return;
    }
}
