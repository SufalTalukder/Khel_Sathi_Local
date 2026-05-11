<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Session;
use App\Events\SmsMail;
use App\Models\OnlineAdmissionModel;
use App\Events\UserLoggedIn;

class OnlineAdmissionTest extends Controller
{
    /* ─────────────────────────────────────────────────────────
     *  HELPER – Age eligibility (DOB must be on/after 2009-04-01)
     * ───────────────────────────────────────────────────────── */
    private function isOverAge(string $dob): bool
    {
        // DOB earlier than 01-04-2009 → Over Age
        return strtotime($dob) < strtotime('2009-04-01');
    }

    /* ─────────────────────────────────────────────────────────
     *  HELPER – Compact registration number: YY + 5-digit serial
     *  e.g. 2600001 (7 digits)
     * ───────────────────────────────────────────────────────── */
    private function generateRegNo(int $id): string
    {
        return date('y') . sprintf('%05d', $id);
    }

    /* ═══════════════════════════════════════════════════════════
     *  1. LOGIN PAGE
     * ═══════════════════════════════════════════════════════════ */
    public function index()
    {
        $capchaCode = rand(11111, 99999);
        session()->put('capchaCode_test', $capchaCode);
        return view('onlineAdmissionTest.login', compact('capchaCode'));
    }
    public function logintest()
    {
        $capchaCode = rand(11111, 99999);
        session()->put('capchaCode_test', $capchaCode);
        return view('onlineAdmissionTest.loginTest', compact('capchaCode'));
    }

    public function login(Request $req)
    {
        $validation = Validator::make($req->all(), [
            'appl_no'  => 'required',
            'password' => 'required',
            'captcha'  => 'required',
        ], [
            'appl_no.required'  => 'Please Enter User ID./कृपया यूज़र आईडी भरें।',
            'password.required' => 'Please Enter Password./कृपया पासवर्ड भरें।',
            'captcha.required'  => 'Please Enter Captcha./कृपया कैप्चा भरें।',
        ]);

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        if ($req->captcha != $req->capchaCode)
            return response()->json(['error' => true, 'msg' => 'Entered Captcha is invalid./भरा गया कैप्चा अमान्य है।']);

        // Decrypt password & appl_no (same encryption as original)
        $decryptionKey = "2b7e151628aed2a6abf7158809cf4f3c";
        $keyHex        = hex2bin($decryptionKey);
        $password      = openssl_decrypt(base64_decode($req->password), 'AES-128-ECB', $keyHex, OPENSSL_RAW_DATA);
        $applNo        = openssl_decrypt(base64_decode($req->appl_no),  'AES-128-ECB', $keyHex, OPENSSL_RAW_DATA);

        if (Auth::guard('OnlineAdmission')->attempt(['application_no' => $applNo, 'password' => $password])) {
            OnlineAdmissionModel::where('id', Auth::guard('OnlineAdmission')->user()->id)
                ->update(['last_login_attempt_time' => date('Y-m-d H:i:s')]);

            try {
                UserLoggedIn::dispatch(Auth::guard('OnlineAdmission')->user()->id, 1, 2, 'admission_registration_login');
            } catch (Exception $e) {
            }

            $passwordChanged = OnlineAdmissionModel::where('id', Auth::guard('OnlineAdmission')->user()->id)
                ->where('password_changed', 1)->exists();

            if ($passwordChanged) {
                return response()->json(['error' => false, 'route' => 'onlineAdmission/dashboard', 'msg' => 'You have successfully logged in.']);
            } else {
                return response()->json(['error' => false, 'route' => 'onlineAdmission/change-password', 'msg' => 'You have successfully logged in.']);
            }
        }

        return response()->json(['error' => true, 'msg' => 'Entered Login Details are invalid./भरा गया लॉगिन विवरण अमान्य है।']);
    }

    /* ═══════════════════════════════════════════════════════════
     *  2. REGISTRATION
     * ═══════════════════════════════════════════════════════════ */
    public function register()
    {
        $capchaCode = rand(11111, 99999);
        session()->put('capchaCode_test', $capchaCode);
        return view('onlineAdmissionTest.register', compact('capchaCode'));
    }

    public function preRegistration(Request $req)
    {
        if ($req->captcha != $req->capchaCode)
            return response()->json(['error' => true, 'msg' => 'Entered Captcha is invalid./भरा गया कैप्चा अमान्य है।']);

        $validation = Validator::make($req->all(), [
            'fname'       => 'required',
            'dateOfBirth' => 'required|date_format:Y-m-d',
            'native_of_up' => 'required',
            'gender'      => 'required',
            'mobile'      => 'required|numeric|digits:10',
            'email'       => 'required|email',
            'aadhar_no'   => 'required|numeric|digits:12',
            'pen_no'      => 'required',
            'captcha'     => 'required',
        ], [
            'fname.required'        => 'Please Enter Full Name./कृपया पूरा नाम भरें।',
            'dateOfBirth.required'  => 'Please Select Date of Birth./कृपया जन्मतिथि का चयन करें।',
            'native_of_up.required' => 'Please select whether you are a native of UP./कृपया बताएं कि आप उ.प्र. के मूल निवासी हैं या नहीं।',
            'gender.required'       => 'Please Select Gender./कृपया लिंग का चयन करें।',
            'mobile.required'       => 'Please Enter Mobile No./कृपया मोबाइल नंबर भरें।',
            'mobile.digits'         => 'Mobile No. must be of 10 digits./मोबाइल नंबर 10 अंकों का होना चाहिए।',
            'email.required'        => 'Please Enter Email ID./कृपया ईमेल आईडी भरें।',
            'aadhar_no.required'    => 'Please Enter Aadhaar No./कृपया आधार नंबर भरें।',
            'aadhar_no.digits'      => 'Aadhaar No. must be of 12 digits./आधार नंबर 12 अंकों का होना चाहिए।',
            'pen_no.required'       => 'Please Enter Personal Education Number./कृपया व्यक्तिगत शिक्षा संख्या भरें।',
        ]);

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        // ── UP Native check ──
        if ($req->native_of_up != 1) {
            return response()->json(['error' => true, 'msg' => 'Only natives of Uttar Pradesh are eligible to apply./केवल उत्तर प्रदेश के मूल निवासी ही आवेदन करने के पात्र हैं।']);
        }

        // ── Age Validation ── (HTML5 date input sends YYYY-MM-DD)
        try {
            $dob = Carbon::createFromFormat('Y-m-d', $req->dateOfBirth)->format('Y-m-d');
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'msg' => 'Invalid Date of Birth format./जन्मतिथि का प्रारूप अमान्य है।']);
        }
        if ($this->isOverAge($dob)) {
            return response()->json(['error' => true, 'msg' => 'Over Age: Date of Birth must be on or after 01-04-2009./अधिक आयु: जन्मतिथि 01-04-2009 या उसके बाद होनी चाहिए।']);
        }

        // Re-registration is allowed for all — existing credentials will be refreshed after OTP

        $password    = rand(10000000, 99999999);
        $existingSwr = DB::table('sport_welfare_registration')->where('aadhar_no', $req->aadhar_no)->first();

        if ($existingSwr) {
            // Re-registrant from a previous year — refresh their staging record
            DB::table('sport_welfare_registration')->where('id', $existingSwr->id)->update([
                'fullname'      => $req->fname,
                'native_of_up'  => $req->native_of_up,
                'gender'        => $req->gender,
                'mobile'        => $req->mobile,
                'email'         => $req->email,
                'password'      => Hash::make($password),
                'user_password' => $password,
                'pen_no'        => $req->pen_no,
                'dob'           => $dob,
            ]);
            $id = $existingSwr->id;
        } else {
            $id = DB::table('sport_welfare_registration')->insertGetId([
                'fullname'      => $req->fname,
                'native_of_up'  => $req->native_of_up,
                'gender'        => $req->gender,
                'mobile'        => $req->mobile,
                'email'         => $req->email,
                'role'          => 'user',
                'password'      => Hash::make($password),
                'user_password' => $password,
                'aadhar_no'     => $req->aadhar_no,
                'pen_no'        => $req->pen_no,
                'dob'           => $dob,
            ]);
        }

        $otp = rand(111111, 999999);
        DB::table('user_otp')->insert([
            'pre_reg_id' => $id,
            'mobile'     => $req->mobile,
            'otp'        => $otp,
        ]);

        session()->put('mobile_test', $req->mobile);
        session()->put('email_test', $req->email);
        session()->put('aadhar_no_test', $req->aadhar_no);

        session()->put('form_type', 11);
        try {
            SmsMail::dispatch(['otp' => $otp, 'email' => $req->email, 'mobile' => $req->mobile], 1);
        } catch (Exception $e) {
        }

        return response()->json([
            'error' => false,
            'msg'   => 'An OTP has been sent on entered Mobile No./Email ID./भरे गए मोबाइल नंबर/ईमेल आईडी पर एक ओटीपी भेजा गया है।',
            'url'   => route('onlineAdmissionTest.otp'),
        ]);
    }

    /* ═══════════════════════════════════════════════════════════
     *  3. OTP
     * ═══════════════════════════════════════════════════════════ */
    public function otp()
    {
        return view('onlineAdmissionTest.otp');
    }

    public function otpVerify(Request $req)
    {
        $validation = Validator::make($req->all(), [
            'otp1' => 'required',
            'otp2' => 'required',
            'otp3' => 'required',
            'otp4' => 'required',
            'otp5' => 'required',
            'otp6' => 'required',
        ]);

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => 'Please Enter OTP./कृपया ओटीपी भरें।']);

        $otp    = $req->otp1 . $req->otp2 . $req->otp3 . $req->otp4 . $req->otp5 . $req->otp6;
        $mobile = session()->get('mobile_test');

        $table = DB::table('user_otp')->where('mobile', $mobile)->where('otp', $otp)->orderBy('id', 'DESC')->limit(1);

        if ($table->exists()) {
            $reg_id  = $table->first()->pre_reg_id;
            $dataOld = DB::table('sport_welfare_registration')
                ->where('id', $reg_id)->first();

            // ── Compact registration number: YY + 5-digit serial ──
            $applicationNo = $this->generateRegNo($reg_id);

            // Handle re-registration: refresh credentials & personal details, preserve all form/payment data
            $existingReg = DB::table('admission_registration_login')->where('application_no', $applicationNo)->first();
            if ($existingReg) {
                // Always allow re-registration — update personal details & credentials only
                DB::table('admission_registration_login')->where('application_no', $applicationNo)->update([
                    'fullname'        => $dataOld->fullname,
                    'dob'             => $dataOld->dob,
                    'gender'          => $dataOld->gender,
                    'native_of_up'    => $dataOld->native_of_up,
                    'mobile'          => $dataOld->mobile,
                    'email'           => $dataOld->email,
                    'aadhar_no'       => $dataOld->aadhar_no,
                    'pen_no'          => $dataOld->pen_no,
                    'password'        => $dataOld->password,
                    'user_password'   => $dataOld->user_password,
                    'updated_at'      => now(),
                ]);
                session()->put('form_type', 11);
                try {
                    SmsMail::dispatch([
                        'password'      => $dataOld->user_password,
                        'email'         => $dataOld->email,
                        'mobile'        => $dataOld->mobile,
                        'aadhar_no'     => $dataOld->aadhar_no,
                        'applicationNo' => $applicationNo,
                    ], 12);
                } catch (Exception $e) {
                }
                session()->put('mobile_test', null);
                return response()->json([
                    'error' => false,
                    'msg'   => 'Re-registration successful. New credentials sent to your Mobile & Email./पुनः पंजीकरण सफल। नए क्रेडेंशियल आपके मोबाइल व ईमेल पर भेजे गए।',
                    'url'   => url('/onlineAdmission'),
                ]);
            }

            $data = [
                'application_no' => $applicationNo,
                'fullname'       => $dataOld->fullname,
                'dob'            => $dataOld->dob,
                'gender'         => $dataOld->gender,
                'native_of_up'   => $dataOld->native_of_up,
                'mobile'         => $dataOld->mobile,
                'email'          => $dataOld->email,
                'aadhar_no'      => $dataOld->aadhar_no,
                'pen_no'         => $dataOld->pen_no,
                'password'       => $dataOld->password,
                'user_password'  => $dataOld->user_password,
                'session_year'   => config('app.session_year'),
                'registered_from' => 1,
            ];

            DB::table('admission_registration_login')->insertGetId($data);

            session()->put('form_type', 11);
            try {
                SmsMail::dispatch([
                    'password'      => $dataOld->user_password,
                    'email'         => $dataOld->email,
                    'mobile'        => $dataOld->mobile,
                    'aadhar_no'     => $dataOld->aadhar_no,
                    'applicationNo' => $applicationNo,
                ], 12);
            } catch (Exception $e) {
            }

            session()->put('mobile_test', null);
            return response()->json([
                'error' => false,
                'msg'   => 'OTP verified. Login credentials sent to registered Mobile & Email./ओटीपी सत्यापित हुआ। लॉगिन विवरण पंजीकृत मोबाइल व ईमेल पर भेजा गया।',
                'url'   => url('/onlineAdmission'),
            ]);
        }

        return response()->json(['error' => true, 'msg' => 'Entered OTP is invalid./भरा गया ओटीपी अमान्य है।']);
    }

    /* ─── RESEND OTP ─── */
    public function resendOtp()
    {
        $mobile = session()->get('mobile_test');
        if (!$mobile) {
            return response()->json(['error' => true, 'msg' => 'Session expired. Please register again./सत्र समाप्त हो गया। कृपया पुनः पंजीकरण करें।']);
        }

        $reg = DB::table('user_otp')->where('mobile', $mobile)->orderBy('id', 'DESC')->first();
        if (!$reg) {
            return response()->json(['error' => true, 'msg' => 'No registration found./कोई पंजीकरण नहीं मिला।']);
        }

        $otp = rand(111111, 999999);
        DB::table('user_otp')->insert(['pre_reg_id' => $reg->pre_reg_id, 'mobile' => $mobile, 'otp' => $otp]);

        $email = session()->get('email_test');
        session()->put('form_type', 11);
        try {
            SmsMail::dispatch(['otp' => $otp, 'email' => $email, 'mobile' => $mobile], 1);
        } catch (Exception $e) {
        }

        return response()->json(['error' => false, 'msg' => 'OTP resent successfully./ओटीपी पुनः भेजा गया।']);
    }

    /* ═══════════════════════════════════════════════════════════
     *  4. FORGOT PASSWORD
     * ═══════════════════════════════════════════════════════════ */
    public function forgotPassword()
    {
        return view('onlineAdmissionTest.forgot');
    }

    public function forgot(Request $req)
    {
        $validation = Validator::make($req->all(), [
            'application_no' => 'required',
        ], ['application_no.required' => 'Please Enter Application Number./कृपया आवेदन संख्या भरें।']);

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        $user = DB::table('admission_registration_login')->where('application_no', $req->application_no)->first();
        if ($user) {
            try {
                SmsMail::dispatch([
                    'password'  => $user->user_password,
                    'email'     => $user->email,
                    'mobile'    => $user->mobile,
                    'aadhar_no' => $user->aadhar_no,
                ], 13);
            } catch (Exception $e) {
                return response()->json(['error' => true, 'msg' => 'SMTP connection failed.']);
            }
            return response()->json(['error' => false, 'msg' => 'Password sent to registered Email & Mobile./पासवर्ड पंजीकृत ईमेल व मोबाइल पर भेजा गया।']);
        }
        return response()->json(['error' => true, 'msg' => 'Application Number not found./आवेदन संख्या नहीं मिली।']);
    }

    /* ═══════════════════════════════════════════════════════════
     *  5. CHANGE PASSWORD (forced on first login)
     * ═══════════════════════════════════════════════════════════ */
    public function changePassword()
    {
        return view('onlineAdmissionTest.changePassword');
    }

    public function updatePassword(Request $req)
    {
        $validation = Validator::make($req->all(), [
            'old_password'          => 'required',
            'password'              => ['required', 'string', 'min:8', 'regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/'],
            'password_confirmation' => 'required|min:8|same:password',
        ], [
            'old_password.required'          => 'Please Enter Current Password./कृपया वर्तमान पासवर्ड भरें।',
            'password.required'              => 'Please Enter New Password./कृपया नया पासवर्ड भरें।',
            'password.min'                   => 'New Password must be at least 8 characters./नया पासवर्ड न्यूनतम 8 वर्णों का होना चाहिए।',
            'password_confirmation.required' => 'Please Retype New Password./कृपया नया पासवर्ड पुनः भरें।',
            'password_confirmation.same'     => 'New Password and Confirm Password must match./नया पासवर्ड और पुनः भरा पासवर्ड समान होने चाहिए।',
        ]);

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        if (!Hash::check($req->old_password, Auth::guard('OnlineAdmission')->user()->password))
            return response()->json(['error' => true, 'msg' => 'Incorrect Current Password./वर्तमान पासवर्ड गलत है।']);

        if (Hash::check($req->password, Auth::guard('OnlineAdmission')->user()->password))
            return response()->json(['error' => true, 'msg' => 'New Password cannot be same as Current Password./नया पासवर्ड वर्तमान पासवर्ड से अलग होना चाहिए।']);

        DB::table('admission_registration_login')
            ->where('id', Auth::guard('OnlineAdmission')->user()->id)
            ->update(['password' => Hash::make($req->password), 'user_password' => $req->password, 'password_changed' => 1]);

        Auth::guard('OnlineAdmission')->logout();
        return response()->json(['error' => false, 'msg' => 'Password Changed Successfully./पासवर्ड सफलतापूर्वक बदला गया।', 'url' => url('/onlineAdmission')]);
    }

    /* ═══════════════════════════════════════════════════════════
     *  6. DASHBOARD
     * ═══════════════════════════════════════════════════════════ */
    public function dashboard()
    {
        if (!OnlineAdmissionModel::where('id', Auth::guard('OnlineAdmission')->user()->id)->where('password_changed', 1)->exists()) {
            return redirect('/onlineAdmission/change-password');
        }

        $user = Auth::guard('OnlineAdmission')->user();

        // Rejected applicants must see the rejection message — never redirect away
        if ($user->final_status != 3) {
            if ($user->payment_status != 1) {
                if ($user->form_status == 6) {
                    return redirect()->route('onlineAdmissionTest.applicationPreview');
                }
                if ($user->form_status < 6) {
                    return redirect()->route('onlineAdmissionTest.applicationForm');
                }
            }
        }

        $data = DB::table('admission_registration_login as rg')
            ->leftJoin('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
            ->leftJoin('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
            ->select('rg.*', 'sport_onlineadmission.name as sport_name', 'basic.sport_college')
            ->where('rg.id', $user->id)->first();

        return view('onlineAdmissionTest.dashboard', compact('data'));
    }

    /* ═══════════════════════════════════════════════════════════
     *  7. APPLICATION FORM (SHOW)
     * ═══════════════════════════════════════════════════════════ */
    public function applicationForm()
    {
        if ((Auth::guard('OnlineAdmission')->user()->final_status == 1) && (Auth::guard('OnlineAdmission')->user()->query_status != 1)) {
            return redirect()->route('onlineAdmissionTest.applicationPreview');
        }

        $state         = DB::table('states')->get();
        $city          = DB::table('cities')->where('state_id', 23)->get();
        $basic_detail  = DB::table('online_admission_basic_details')->where('user_id', Auth::guard('OnlineAdmission')->user()->id)->first();
        $commun_detail = DB::table('online_admission_communication_details')->where('user_id', Auth::guard('OnlineAdmission')->user()->id)->first();
        $edu_detail    = DB::table('online_admission_education_document_details')->where('user_id', Auth::guard('OnlineAdmission')->user()->id)->first();
        $user          = Auth::guard('OnlineAdmission')->user();

        // Pre-render sports for the saved class (used as initial <select> options)
        $availableSports = collect();
        if ($basic_detail && $basic_detail->admission_seeking) {
            $classValue = $basic_detail->admission_seeking . 'th';
            $gender     = $user->gender;
            $q = DB::table('online_admission_college_matrix')
                ->where('class', $classValue)
                ->where('seats', '>=', 1);
            if ($gender && in_array((int)$gender, [1, 2])) {
                $q->where('gender', (int)$gender);
            }
            $sportIds = $q->distinct()->pluck('sport_id');
            if ($sportIds->isNotEmpty()) {
                $availableSports = DB::table('sport_onlineadmission')
                    ->whereIn('id', $sportIds)->where('status', 1)->orderBy('name')->get(['id', 'name']);
            }
        }

        // Full datasets embedded as JS — eliminates AJAX for sport/sub-sport/college filtering
        $jsSports      = DB::table('sport_onlineadmission')->where('status', 1)->orderBy('name')->get(['id', 'name']);
        $jsSubSports   = DB::table('sub_sport_type')->get(['id', 'sport_id', 'sub_type']);
        $jsMatrix      = DB::table('online_admission_college_matrix as m')
            ->join('sports_college_master as c', 'm.college_id', '=', 'c.id')
            ->where('m.seats', '>=', 1)
            ->get(['m.sport_id', 'm.class', 'm.gender', 'm.sub_sport_id', 'c.id as college_id', 'c.college_name']);

        return view('onlineAdmissionTest.applicationForm', compact(
            'state',
            'city',
            'basic_detail',
            'commun_detail',
            'edu_detail',
            'user',
            'availableSports',
            'jsSports',
            'jsSubSports',
            'jsMatrix'
        ));
    }

    /* ─── AJAX: Get sub-sports ─── */
    public function getSubSport(Request $req)
    {
        return DB::table('sub_sport_type')->where('sport_id', $req->sport)->get();
    }

    /* ─── AJAX: Get districts by state ─── */
    public function getDistricts(Request $req)
    {
        $districts = DB::table('cities')->where('state_id', $req->state_id)->orderBy('city')->get(['id', 'city']);
        return response()->json($districts);
    }

    /* ─── AJAX: Get sports that have seats for the selected class + logged-in user's gender ─── */
    public function getAvailableSports(Request $req)
    {
        $classValue = $req->admission_seeking . 'th';
        $gender     = Auth::guard('OnlineAdmission')->user()->gender;

        $q = DB::table('online_admission_college_matrix')
            ->where('class', $classValue)
            ->where('seats', '>=', 1);

        if ($gender && in_array((int)$gender, [1, 2])) {
            $q->where('gender', (int)$gender);
        }

        $sportIds = $q->distinct()->pluck('sport_id');

        if ($sportIds->isNotEmpty()) {
            $sports = DB::table('sport_onlineadmission')
                ->whereIn('id', $sportIds)
                ->where('status', 1)
                ->orderBy('name')
                ->get(['id', 'name']);
        } else {
            $sports = DB::table('sport_onlineadmission')
                ->where('status', 1)
                ->orderBy('name')
                ->get(['id', 'name']);
        }

        return response()->json($sports);
    }

    /* ─── AJAX: Get colleges filtered by sport + gender + class ─── */
    public function getCollege(Request $req)
    {
        // Matrix stores class as '6th','9th','11th'; form sends '6','9','11' — append 'th'
        $classValue = $req->admission_seeking . 'th';

        $q = DB::table('online_admission_college_matrix')
            ->leftJoin('sports_college_master', 'online_admission_college_matrix.college_id', '=', 'sports_college_master.id')
            ->select('sports_college_master.college_name', 'sports_college_master.id')
            ->distinct()
            ->where('online_admission_college_matrix.seats', '>=', 1)
            ->where('online_admission_college_matrix.sport_id', $req->sport)
            ->where('online_admission_college_matrix.class', $classValue);

        if ($req->gender && in_array((int)$req->gender, [1, 2])) {
            $q->where('online_admission_college_matrix.gender', (int)$req->gender);
        }

        if ($req->sub_type) {
            $q->where('online_admission_college_matrix.sub_sport_id', $req->sub_type);
        }

        return response()->json(['error' => false, 'all_college' => $q->get()]);
    }

    /* ─── SAVE: Section A – Basic Details ─── */
    public function saveBasic(Request $req)
    {
        $validation = Validator::make($req->all(), [
            'sport_type'       => 'required',
            'admission_seeking' => 'required',
            'sport_college'    => 'required',
            'gender'           => 'required',
            'category'         => 'required',
            'height'           => 'required|numeric',
            'weight'           => 'required|numeric',
            'blood_group'      => 'required',
            'identification_marks' => 'required',
            'disease'          => 'required',
            'mother_name'      => 'required',
            'mother_occupation' => 'required',
            'father_name'      => 'required',
            'father_occupation' => 'required',
            'pen_no'           => 'required',
        ], [
            'sport_type.required'        => 'Please select Sport./कृपया खेल का चयन करें।',
            'admission_seeking.required' => 'Please select Class seeking admission./कृपया कक्षा का चयन करें।',
            'sport_college.required'     => 'Please select College./कृपया विद्यालय का चयन करें।',
            'gender.required'            => 'Please select Gender./कृपया लिंग का चयन करें।',
            'category.required'          => 'Please select Category./कृपया श्रेणी का चयन करें।',
            'height.required'            => 'Please enter Height./कृपया लंबाई भरें।',
            'weight.required'            => 'Please enter Weight./कृपया वजन भरें।',
            'blood_group.required'       => 'Please select Blood Group./कृपया ब्लड ग्रुप का चयन करें।',
            'identification_marks.required' => 'Please enter Identification Marks./कृपया पहचान चिह्न भरें।',
            'disease.required'           => 'Please answer the disease question./कृपया रोग संबंधी प्रश्न का उत्तर दें।',
            'pen_no.required'            => 'Please enter PEN No./कृपया व्यक्तिगत शिक्षा संख्या भरें।',
            'mother_name.required'       => 'Please enter Mother\'s Name./कृपया माता का नाम भरें।',
            'mother_occupation.required' => 'Please enter Mother\'s Occupation./कृपया माता का व्यवसाय भरें।',
            'father_name.required'       => 'Please enter Father\'s Name./कृपया पिता का नाम भरें।',
            'father_occupation.required' => 'Please enter Father\'s Occupation./कृपया पिता का व्यवसाय भरें।',
        ]);

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        // If sport has sub-types, sub_type is required
        if ($req->sport_type) {
            $hasSubSports = DB::table('sub_sport_type')->where('sport_id', $req->sport_type)->exists();
            if ($hasSubSports && empty($req->sub_type)) {
                return response()->json(['error' => true, 'msg' => 'Please select Sub-Sport Type./कृपया उप-खेल प्रकार का चयन करें।']);
            }
        }

        // Age validation vs selected class
        $dob = Auth::guard('OnlineAdmission')->user()->dob;
        $ageError = $this->validateClassAge($dob, $req->admission_seeking);
        if ($ageError) {
            return response()->json(['error' => true, 'msg' => $ageError]);
        }

        $mother_aadhar = $req->mother_aadhar1 ?? null;
        if ($req->hasFile('mother_aadhar')) $mother_aadhar = moveFile('onlineAdmission_storage/images', $req->mother_aadhar);
        $father_aadhar = $req->father_aadhar1 ?? null;
        if ($req->hasFile('father_aadhar')) $father_aadhar = moveFile('onlineAdmission_storage/images', $req->father_aadhar);

        $status = [
            'user_id'              => Auth::guard('OnlineAdmission')->user()->id,
            'application_no'       => Auth::guard('OnlineAdmission')->user()->application_no,
            'sport_type'           => $req->sport_type,
            'sub_sport_type'       => $req->sub_type ?? null,
            'admission_seeking'    => $req->admission_seeking,
            'sport_college'        => is_array($req->sport_college) ? implode(',', array_filter($req->sport_college, fn($v) => $v !== '' && $v !== null)) : $req->sport_college,
            'gender'               => $req->gender,
            'category'             => $req->category,
            'sub_category'         => $req->sub_category ?? null,
            'height'               => $req->height,
            'weight'               => $req->weight,
            'blood_group'          => $req->blood_group,
            'identification_marks' => $req->identification_marks,
            'disease'              => $req->disease,
            'mother_name'          => $req->mother_name,
            'mother_occupation'    => $req->mother_occupation,
            'father_name'          => $req->father_name,
            'father_occupation'    => $req->father_occupation,
            'mother_aadhar'        => $mother_aadhar,
            'father_aadhar'        => $father_aadhar,
        ];

        if (DB::table('online_admission_basic_details')->where('user_id', Auth::guard('OnlineAdmission')->user()->id)->exists()) {
            DB::table('online_admission_basic_details')->where('user_id', Auth::guard('OnlineAdmission')->user()->id)->update($status);
        } else {
            DB::table('online_admission_basic_details')->insert($status);
            DB::table('admission_registration_login')->where('id', Auth::guard('OnlineAdmission')->user()->id)->update(['form_status' => 2]);
        }

        DB::table('admission_registration_login')
            ->where('id', Auth::guard('OnlineAdmission')->user()->id)
            ->update(['pen_no' => $req->pen_no]);

        return response()->json(['error' => false, 'msg' => 'Basic details saved.', 'url' => url('onlineAdmission/applicationForm') . '?tab=communication']);
    }

    /* ─── Age vs Class validation ─── */
    private function validateClassAge(string $dob, string $class): ?string
    {
        $dobTs = strtotime($dob);
        $ranges = [
            '6'  => ['2014-04-01', '2017-03-31'],
            '9'  => ['2011-04-01', '2014-03-31'],
            '11' => ['2009-04-01', '2011-03-31'],
        ];
        if (!isset($ranges[$class])) return null;
        [$from, $to] = $ranges[$class];
        if ($dobTs < strtotime($from) || $dobTs > strtotime($to)) {
            return "DOB is not in the eligible age range for Class $class. (Allowed: " . date('d-m-Y', strtotime($from)) . " to " . date('d-m-Y', strtotime($to)) . ")/कक्षा $class के लिए जन्मतिथि निर्धारित आयुवर्ग में नहीं है।";
        }
        return null;
    }

    /* ─── SAVE: Section B – Communication ─── */
    public function saveCommunication(Request $req)
    {
        $validation = Validator::make($req->all(), [
            'p_gram'             => 'required',
            'p_post'             => 'required',
            'p_thana'            => 'required',
            'p_state'            => 'required',
            'p_district'         => 'required',
            'p_pin'              => 'required|digits:6',
            'p_mobile'           => 'required|numeric',
            'p_alternate_mobile' => 'required|numeric',
            'p_email'            => 'required|email',
            'c_gram'             => 'required',
            'c_post'             => 'required',
            'c_thana'            => 'required',
            'c_state'            => 'required',
            'c_district'         => 'required',
            'c_pin'              => 'required|digits:6',
            'c_mobile'           => 'required|numeric',
            'c_alternate_mobile' => 'required|numeric',
            'c_email'            => 'required|email',
        ], [
            'p_gram.required'    => 'Please enter Street/Village (Permanent)./कृपया मोहल्ला/ग्राम (स्थायी) भरें।',
            'p_state.required'   => 'Please select State (Permanent)./कृपया राज्य (स्थायी) का चयन करें।',
            'p_district.required' => 'Please select District (Permanent)./कृपया जनपद (स्थायी) का चयन करें।',
            'p_mobile.required'  => 'Please enter Mobile No. (Permanent)./कृपया मोबाइल नंबर (स्थायी) भरें।',
            'p_email.required'   => 'Please enter Email (Permanent)./कृपया ईमेल (स्थायी) भरें।',
            'c_gram.required'    => 'Please enter Street/Village (Correspondence)./कृपया मोहल्ला/ग्राम (पत्राचार) भरें।',
            'c_state.required'   => 'Please select State (Correspondence)./कृपया राज्य (पत्राचार) का चयन करें।',
            'c_district.required' => 'Please select District (Correspondence)./कृपया जनपद (पत्राचार) का चयन करें।',
            'c_mobile.required'  => 'Please enter Mobile No. (Correspondence)./कृपया मोबाइल नंबर (पत्राचार) भरें।',
            'c_email.required'   => 'Please enter Email (Correspondence)./कृपया ईमेल (पत्राचार) भरें।',
        ]);

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        if ($req->p_alternate_mobile == $req->p_mobile)
            return response()->json(['error' => true, 'msg' => 'Mobile No. and Alternate Mobile No. cannot be same (Permanent).']);
        if ($req->c_alternate_mobile == $req->c_mobile)
            return response()->json(['error' => true, 'msg' => 'Mobile No. and Alternate Mobile No. cannot be same (Correspondence).']);

        $status = [
            'user_id'            => Auth::guard('OnlineAdmission')->user()->id,
            'application_no'     => Auth::guard('OnlineAdmission')->user()->application_no,
            'p_gram'             => $req->p_gram,
            'p_post'             => $req->p_post,
            'p_thana'            => $req->p_thana,
            'p_state'            => $req->p_state,
            'p_district'         => $req->p_district,
            'p_pin'              => $req->p_pin,
            'p_mobile'           => $req->p_mobile,
            'p_alternate_mobile' => $req->p_alternate_mobile,
            'p_email'            => $req->p_email,
            'c_gram'             => $req->c_gram,
            'c_post'             => $req->c_post,
            'c_thana'            => $req->c_thana,
            'c_state'            => $req->c_state,
            'c_district'         => $req->c_district,
            'c_pin'              => $req->c_pin,
            'c_mobile'           => $req->c_mobile,
            'c_alternate_mobile' => $req->c_alternate_mobile,
            'c_email'            => $req->c_email,
        ];

        if (DB::table('online_admission_communication_details')->where('user_id', Auth::guard('OnlineAdmission')->user()->id)->exists()) {
            DB::table('online_admission_communication_details')->where('user_id', Auth::guard('OnlineAdmission')->user()->id)->update($status);
        } else {
            DB::table('online_admission_communication_details')->insertGetId($status);
            DB::table('admission_registration_login')->where('id', Auth::guard('OnlineAdmission')->user()->id)->update(['form_status' => 3]);
        }

        return response()->json(['error' => false, 'msg' => 'Communication details saved.', 'url' => url('onlineAdmission/applicationForm') . '?tab=education']);
    }

    /* ─── SAVE: Section C – Education ─── */
    public function saveEducation(Request $req)
    {
        $validation = Validator::make($req->all(), [
            'school'          => 'required',
            'updise_code'     => 'required',
            'class'           => 'required',
            'year_of_passing' => 'required',
            'maximum_marks'   => 'required|numeric',
            'obtained_marks'  => 'required|numeric',
            'grade_percentage' => 'required',
        ], [
            'school.required'           => 'Please enter School/Vidyalaya Name./कृपया विद्यालय का नाम भरें।',
            'updise_code.required'      => 'Please enter UDISE Code./कृपया यूडाइस कोड भरें।',
            'class.required'            => 'Please select Class./कृपया कक्षा का चयन करें।',
            'year_of_passing.required'  => 'Please select Year of Passing./कृपया उत्तीर्ण वर्ष का चयन करें।',
            'maximum_marks.required'    => 'Please enter Maximum Marks./कृपया अधिकतम अंक भरें।',
            'obtained_marks.required'   => 'Please enter Obtained Marks./कृपया प्राप्त अंक भरें।',
            'grade_percentage.required' => 'Please enter Grade/Percentage./कृपया ग्रेड/प्रतिशत भरें।',
        ]);

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        if ((float)$req->obtained_marks > (float)$req->maximum_marks)
            return response()->json(['error' => true, 'msg' => 'Obtained Marks cannot exceed Maximum Marks./प्राप्त अंक अधिकतम अंक से अधिक नहीं हो सकते।']);

        $status = [
            'user_id'          => Auth::guard('OnlineAdmission')->user()->id,
            'application_no'   => Auth::guard('OnlineAdmission')->user()->application_no,
            'school'           => $req->school,
            'updise_code'      => $req->updise_code,
            'class'            => $req->class,
            'year_of_passing'  => $req->year_of_passing,
            'maximum_marks'    => $req->maximum_marks,
            'obtained_marks'   => $req->obtained_marks,
            'grade_percentage' => $req->grade_percentage,
        ];

        if (DB::table('online_admission_education_document_details')->where('user_id', Auth::guard('OnlineAdmission')->user()->id)->exists()) {
            DB::table('online_admission_education_document_details')->where('user_id', Auth::guard('OnlineAdmission')->user()->id)->update($status);
        } else {
            DB::table('online_admission_education_document_details')->insertGetId($status);
        }
        DB::table('admission_registration_login')
            ->where('id', Auth::guard('OnlineAdmission')->user()->id)
            ->update(['form_status' => DB::raw('GREATEST(form_status, 4)')]);

        return response()->json(['error' => false, 'msg' => 'Education details saved.', 'url' => url('onlineAdmission/applicationForm') . '?tab=documents']);
    }

    /* ─── SAVE: Section D – Documents ─── */
    public function saveDocuments(Request $req)
    {
        $edu = DB::table('online_admission_education_document_details')->where('user_id', Auth::guard('OnlineAdmission')->user()->id)->first();

        if (!$edu) {
            return response()->json(['error' => true, 'msg' => 'Please complete Education details first./कृपया पहले शिक्षा विवरण भरें।']);
        }

        $photo      = $edu->applicant_photograph ?? null;
        $signature  = $edu->applicant_signature  ?? null;
        $aadhar     = $edu->applicant_aadhar_birth_certificate ?? null;
        $birth_cert = $edu->applicant_birth_certificate ?? null;
        $edu_cert   = $edu->education_certificate ?? null;
        $affidavit  = $edu->affidavit ?? null;

        // Server-side validation: each file is required on first upload
        if (!$photo && !$req->hasFile('applicant_photograph'))
            return response()->json(['error' => true, 'msg' => 'Please upload Applicant Photograph./कृपया आवेदक का फोटो अपलोड करें।']);
        if (!$signature && !$req->hasFile('applicant_signature'))
            return response()->json(['error' => true, 'msg' => 'Please upload Applicant Signature./कृपया आवेदक के हस्ताक्षर अपलोड करें।']);
        if (!$edu_cert && !$req->hasFile('education_certificate'))
            return response()->json(['error' => true, 'msg' => 'Please upload Education Certificate./कृपया शिक्षा प्रमाणपत्र अपलोड करें।']);
        if (!$aadhar && !$req->hasFile('applicant_aadhar'))
            return response()->json(['error' => true, 'msg' => 'Please upload Aadhaar Card./कृपया आधार कार्ड अपलोड करें।']);
        if (!$birth_cert && !$req->hasFile('applicant_birth_certificate'))
            return response()->json(['error' => true, 'msg' => 'Please upload Birth Certificate./कृपया जन्म प्रमाणपत्र अपलोड करें।']);

        // File size validation (server-side)
        if ($req->hasFile('applicant_photograph') && $req->applicant_photograph->getSize() > 2097152)
            return response()->json(['error' => true, 'msg' => 'Photo must be less than 2 MB./फोटो 2 MB से कम होनी चाहिए।']);
        if ($req->hasFile('applicant_signature') && $req->applicant_signature->getSize() > 2097152)
            return response()->json(['error' => true, 'msg' => 'Signature must be less than 2 MB./हस्ताक्षर 2 MB से कम होने चाहिए।']);
        if ($req->hasFile('education_certificate') && $req->education_certificate->getSize() > 10485760)
            return response()->json(['error' => true, 'msg' => 'Education Certificate must be less than 10 MB./शिक्षा प्रमाणपत्र 10 MB से कम होना चाहिए।']);
        if ($req->hasFile('applicant_aadhar') && $req->applicant_aadhar->getSize() > 10485760)
            return response()->json(['error' => true, 'msg' => 'Aadhaar Card must be less than 10 MB./आधार कार्ड 10 MB से कम होना चाहिए।']);
        if ($req->hasFile('applicant_birth_certificate') && $req->applicant_birth_certificate->getSize() > 10485760)
            return response()->json(['error' => true, 'msg' => 'Birth Certificate must be less than 10 MB./जन्म प्रमाणपत्र 10 MB से कम होना चाहिए।']);

        if ($req->hasFile('applicant_photograph'))       $photo      = moveFile('onlineAdmission_storage/images', $req->applicant_photograph);
        if ($req->hasFile('applicant_signature'))        $signature  = moveFile('onlineAdmission_storage/images', $req->applicant_signature);
        if ($req->hasFile('education_certificate'))      $edu_cert   = moveFile('onlineAdmission_storage/images', $req->education_certificate);
        if ($req->hasFile('applicant_aadhar'))           $aadhar     = moveFile('onlineAdmission_storage/images', $req->applicant_aadhar);
        if ($req->hasFile('applicant_birth_certificate')) $birth_cert = moveFile('onlineAdmission_storage/images', $req->applicant_birth_certificate);
        if ($req->hasFile('affidavit'))                  $affidavit  = moveFile('onlineAdmission_storage/images', $req->affidavit);

        $status = [
            'applicant_photograph'              => $photo,
            'applicant_signature'               => $signature,
            'education_certificate'             => $edu_cert,
            'applicant_aadhar_birth_certificate' => $aadhar,
            'applicant_birth_certificate'       => $birth_cert,
            'affidavit'                         => $affidavit,
        ];

        DB::table('online_admission_education_document_details')->where('user_id', Auth::guard('OnlineAdmission')->user()->id)->update($status);
        DB::table('admission_registration_login')
            ->where('id', Auth::guard('OnlineAdmission')->user()->id)
            ->update(['form_status' => DB::raw('GREATEST(form_status, 5)')]);

        return response()->json(['error' => false, 'msg' => 'Documents uploaded.', 'url' => url('onlineAdmission/applicationForm') . '?tab=declaration']);
    }

    /* ─── SAVE: Section E – Declaration & Submit ─── */
    public function saveDeclaration(Request $req)
    {
        if (Auth::guard('OnlineAdmission')->user()->form_status < 5)
            return response()->json(['error' => true, 'msg' => 'Please complete all previous sections (Basic, Communication, Education, Documents) before final declaration./कृपया घोषणा से पहले सभी अनुभाग (मूल विवरण, संचार, शिक्षा, दस्तावेज़) पूरे करें।']);

        if (!$req->i_agree)
            return response()->json(['error' => true, 'msg' => 'You must agree to the declaration./आपको घोषणा से सहमत होना आवश्यक है।']);
        if (Auth::guard('OnlineAdmssion')->user()->query_status == 1) {
            DB::table('admission_registration_login')
                ->where('id', Auth::guard('OnlineAdmission')->user()->id)
                ->update(['query_status' => 2]);
            return redirect()->route('onlineAdmissionTest.dashboard');
        }
        DB::table('admission_registration_login')
            ->where('id', Auth::guard('OnlineAdmission')->user()->id)
            ->update(['form_status' => DB::raw('GREATEST(form_status, 6)')]);
        return response()->json(['error' => false, 'msg' => 'Declaration saved.', 'url' => url('onlineAdmission/applicationPreview')]);
    }

    /* ═══════════════════════════════════════════════════════════
     *  8. APPLICATION PREVIEW
     * ═══════════════════════════════════════════════════════════ */
    public function applicationPreview()
    {
        $user = Auth::guard('OnlineAdmission')->user();
        if ($user->form_status < 6) {
            return redirect()->route('onlineAdmissionTest.applicationForm');
        }

        $data = DB::table('admission_registration_login as rg')
            ->leftJoin('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
            ->leftJoin('online_admission_communication_details as comm', 'rg.id', '=', 'comm.user_id')
            ->leftJoin('online_admission_education_document_details as edu', 'rg.id', '=', 'edu.user_id')
            ->leftJoin('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
            ->leftJoin('states as ps', 'comm.p_state', '=', 'ps.id')
            ->leftJoin('cities as pd', 'comm.p_district', '=', 'pd.id')
            ->leftJoin('states as cs', 'comm.c_state', '=', 'cs.id')
            ->leftJoin('cities as cd', 'comm.c_district', '=', 'cd.id')
            ->select(
                'rg.*',
                'basic.*',
                'comm.*',
                'edu.*',
                'sport_onlineadmission.name as sport_name',
                'cd.trial_location as trial_location',
                'cd.trial_from_date as trial_from_date',
                'cd.trial_to_date as trial_to_date',
                'cd.trial_time as trial_time',
                'ps.name as p_state_name',
                'pd.city as p_district_name',
                'cs.name as c_state_name',
                'cd.city as c_district_name'
            )
            ->where('rg.id', Auth::guard('OnlineAdmission')->user()->id)->first();

        // Resolve college names
        $collegeNames = [];
        if ($data && $data->sport_college) {
            $ids = explode(',', $data->sport_college);
            $collegeNames = DB::table('sports_college_master')->whereIn('id', $ids)->pluck('college_name', 'id')->toArray();
        }

        // Resolve sub-sport name
        $subSportName = null;
        if ($data && $data->sub_sport_type) {
            $sub = DB::table('sub_sport_type')->where('id', $data->sub_sport_type)->first();
            $subSportName = $sub ? $sub->sub_type : null;
        }

        return view('onlineAdmissionTest.applicationPreview', compact('data', 'collegeNames', 'subSportName'));
    }

    /* ─── FINAL SUBMIT ─── */
    public function finalSubmit(Request $req)
    {
        if (Auth::guard('OnlineAdmission')->user()->form_status < 6) {
            return response()->json(['error' => true, 'msg' => 'Please complete all sections of the form before final submission./कृपया अंतिम जमा करने से पहले फॉर्म के सभी अनुभाग पूरे करें।']);
        }

        $alreadyPaid = Auth::guard('OnlineAdmission')->user()->payment_status == 1;

        DB::table('admission_registration_login')->where('id', Auth::guard('OnlineAdmission')->user()->id)->update([
            'final_status' => 1,
            'form_status'  => 7,
            'challan_no'   => date('Y') . sprintf('%012d', Auth::guard('OnlineAdmission')->user()->id),
        ]);

        if ($alreadyPaid) {
            return response()->json(['error' => false, 'msg' => 'Application re-submitted successfully./आवेदन सफलतापूर्वक पुनः जमा किया गया।', 'url' => route('onlineAdmissionTest.dashboard')]);
        }

        return response()->json(['error' => false, 'msg' => 'Application submitted successfully. Please check your trial venue and proceed to payment./आवेदन सफलतापूर्वक जमा हुआ। कृपया परीक्षा स्थल देखें और भुगतान करें।', 'url' => route('onlineAdmissionTest.trialSchedule')]);
    }

    /* ─── Payment Receipt ─── */
    public function paymentReceipt()
    {
        $user = Auth::guard('OnlineAdmission')->user();

        $payment = DB::table('online_admission_payment_response_details')
            ->where('user_id', $user->id)
            ->where('status', 'SUCCESS')
            ->latest('id')
            ->first();

        if (!$payment) {
            return redirect()->route('onlineAdmissionTest.dashboard')->with('error', 'No payment record found.');
        }

        $data = DB::table('admission_registration_login as rg')
            ->leftJoin('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
            ->leftJoin('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
            ->select('rg.*', 'sport_onlineadmission.name as sport_name', 'basic.admission_seeking', 'basic.sport_college')
            ->where('rg.id', $user->id)->first();

        return view('onlineAdmissionTest.paymentReceipt', compact('data', 'payment'));
    }

    /* ═══════════════════════════════════════════════════════════
     *  9. PAYMENT
     * ═══════════════════════════════════════════════════════════ */
    public function payment()
    {
        if (!Auth::guard('OnlineAdmission')->user()->final_status) {
            return redirect()->route('onlineAdmissionTest.applicationPreview');
        }
        $data = DB::table('admission_registration_login as rg')
            ->leftJoin('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
            ->leftJoin('online_admission_communication_details as comm', 'rg.id', '=', 'comm.user_id')
            ->leftJoin('sport_onlineadmission', 'basic.sport_type', '=', 'sport_onlineadmission.id')
            ->leftJoin('cities', 'comm.p_district', '=', 'cities.id')
            ->select('rg.*', 'basic.*', 'comm.*', 'sport_onlineadmission.name as sport_name', 'cities.city as district_name')
            ->where('rg.id', Auth::guard('OnlineAdmission')->user()->id)->first();

        // Build payment payload (SabPaisa gateway – same as original)
        $authKey     = 'voeXpkMY5WTg63sl';
        $authIV      = 'wE9gkr5BKoTXf8Mh';
        $clientCode  = 'GGSSC';
        $username    = 'nishant.jha_8637';
        $password    = 'GGSSC_SP8637';
        $clientTxnId = date('Y') . time();
        $amount      = 200; // TEMP TEST — change back to 200 after payment test
        $challan_no  = $data->challan_no ?? '';

        $encData = "?clientCode=$clientCode&transUserName=$username&transUserPassword=$password" .
            "&payerName={$data->fullname}&payerMobile={$data->mobile}&payerEmail={$data->email}" .
            "&payerAddress=&clientTxnId=$clientTxnId&amount=$amount&amountType=INR&mcc=5137&channelId=W" .
            "&callbackUrl=" . route('gatewayResponse') . "&udf6=$challan_no";

        $paymentdata = PaymentController::encrypt($authKey, $authIV, $encData);

        return view('onlineAdmissionTest.payment', compact('data', 'clientCode', 'paymentdata', 'clientTxnId', 'amount'));
    }

    /* ═══════════════════════════════════════════════════════════
     *  10. TRIAL SCHEDULE (personalised — auth required)
     * ═══════════════════════════════════════════════════════════ */
    public function trialSchedule()
    {
        $divisionNames = [
            1  => 'Saharanpur',
            2  => 'Meerut',
            3  => 'Agra',
            4  => 'Bareilly',
            5  => 'Moradabad',
            6  => 'Kanpur',
            7  => 'Prayagraj',
            8  => 'Jhansi',
            9  => 'Chitrakoot',
            10 => 'Varanasi',
            11 => 'Mirzapur',
            12 => 'Azamgarh',
            13 => 'Gorakhpur',
            14 => 'Basti',
            15 => 'Lucknow',
            16 => 'Devipatan',
            17 => 'Ayodhya',
            18 => 'Aligarh',
        ];

        $user    = Auth::guard('OnlineAdmission')->user();
        $comm    = DB::table('online_admission_communication_details')
            ->where('user_id', $user->id)->first();

        $trialInfo = null;
        $districtName = null;
        $divisionName = null;

        if ($comm && $comm->p_district) {
            $city = DB::table('cities')
                ->where('id', $comm->p_district)
                ->first(['city', 'trial_location', 'trial_from_date', 'trial_to_date', 'trial_time', 'isp_division_code']);

            if ($city) {
                $districtName = $city->city;
                $divisionName = $divisionNames[$city->isp_division_code] ?? null;
                if ($city->trial_location) {
                    $trialInfo = $city;
                }
            }
        }

        $paymentStatus = $user->payment_status ?? 0;
        $finalStatus   = $user->final_status   ?? 0;
        return view('onlineAdmissionTest.trialSchedule', compact('trialInfo', 'districtName', 'divisionName', 'paymentStatus', 'finalStatus'));
    }

    /* ═══════════════════════════════════════════════════════════
     *  11. LOGOUT
     * ═══════════════════════════════════════════════════════════ */
    public function logout()
    {
        try {
            UserLoggedIn::dispatch(Auth::guard('OnlineAdmission')->user()->id, 2, 2, 'admission_registration_login');
        } catch (Exception $e) {
        }
        Auth::guard('OnlineAdmission')->logout();
        return redirect('/onlineAdmission');
    }
}
