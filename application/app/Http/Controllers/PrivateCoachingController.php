<?php

namespace App\Http\Controllers;

use App\Events\SmsMail;
use App\Models\PrivateCoaching;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use PDF;

class PrivateCoachingController extends Controller
{
    public function register()
    {
        $Code1 = rand(11, 99);
        $Code2 = rand(11, 99);
        $capchaCode = $Code1 +  $Code2;
        session()->put('capchaCode', $capchaCode);

        return view('private_coaching.register', compact('capchaCode', 'Code1', 'Code2'));
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


    public function register_store(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'email' => 'required|email',
            'aadhar_no' => 'required|numeric|digits:12',
            'captcha' => 'required',
            'mobile' => 'required|numeric|digits:10',
            'designation' => 'required',
        ]);


        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
        if ($request->captcha != $request->captchacode) {
            return response()->json(["error" => true, "msg" => "Oops! Invalid Captcha Code."]);
        }

        if (DB::table('private_coaching_register')->where('aadhar_no', $request->aadhar_no)->where('otp_verify', 1)->exists())
            return response()->json(['error' => true, 'msg' => "Entered Aadhar No is already registered on the portal./भरा गया आधार संख्या पोर्टल पर पहले से पंजीकृत है।   ", "url" => route('signUp')]);

        // $otp = 123456;
        $otp = rand(111111, 999999);
        $randomPassword = rand(11111111, 99999999);
        $data = [
            'name' => $request->name,
            'otp' => $otp,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'designation' => $request->designation,
            'aadhar_no' => $request->aadhar_no,
            'decoded_password' => $randomPassword,
            'password' => Hash::make($randomPassword),


        ];


        $user = PrivateCoaching::where('email', $request->email)->where('otp_verify', 1)->first();

        if ($user) {
            return response()->json(["error" => true, "msg" => "Already Registered with this Email."]);
        }
        $checkEmail_for_registered = PrivateCoaching::where('email', $request->email)->first();



        if ($checkEmail_for_registered  && $checkEmail_for_registered->otp_verify != 1) {

            $registerUser =   PrivateCoaching::where('id', $checkEmail_for_registered->id)->update($data);
        } else {
            $registerUser = PrivateCoaching::create($data);
        }


        session()->put('email', $request->email);
        session()->put('mobile', $request->mobile);
        session()->put('form_type', 21);
        SmsMail::dispatch([
            "otp" => $otp,
            "email" => $request->email,
            "mobile" => $request->mobile
        ], 1);


        return response()->json(["error" => false, "msg" => "OTP Sent Successfully./ओटीपी सफलतापूर्वक अग्रेषित कर दिया गया है।", "url" => route('private_coaching_otp')]);
    }


    public function otp()
    {
        return view('private_coaching.otp');
    }


    public function resend_otp()
    {
        $count = PrivateCoaching::where('email', session()->get('email'))->first()->otp_count;

        if ($count >= 4) {
            return response()->json(['status' => 201, 'msg' => "Your account has been temporarily blocked due to 4 consecutive incorrect OTP attempts. Your account has been blocked for the next 24 hours. Please try again after this time period."]);
        }
        $otp = rand(111111, 999999);

        PrivateCoaching::where('email', session()->get('email'))->update(
            ["otp" => $otp, "otp_count" => $count + 1]
        );
        session()->put('form_type', 21);
        SmsMail::dispatch([
            "otp" => $otp,
            "email" => session()->get('email'),
            "mobile" => session()->get('mobile')
        ], 1);
        return response()->json(["error" => false, "msg" => "Otp Resend Successfully."]);
    }



    public function otp_store(Request $req)
    {
        $otp = $req->otp1 . $req->otp2 . $req->otp3 . $req->otp4 . $req->otp5 . $req->otp6;
        $email = session()->get('email');

        $user = PrivateCoaching::where('email', $email)->where('otp', $otp)->first();

        session()->put('form_type', 21);
        if ($user) {
            $user->otp_verify = 1;
            $user->regsistered_on = now();

            $user->save();
            SmsMail::dispatch(["id" => $user->id],  21);
            return response()->json(["error" => false, "msg" => "Successfully Registered on the Portal./पोर्टल पर सफलतापूर्वक पंजीकृत हो गए हैं।", "url" => route('private_coaching_login')]);
        }
        return response()->json(["error" => true, "msg" => "Oops! Invalid OTP  Please try again ."]);
    }




    public function login()
    {
        $Code1 = rand(11, 99);
        $Code2 = rand(11, 99);
        $capchaCode = $Code1 +  $Code2;
        session()->put('capchaCode', $capchaCode);

        return view('private_coaching.login', compact('capchaCode', 'Code1', 'Code2'));
    }



    public function login_store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
            'captcha' => 'required',

        ]);

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        $encryptedData = $request->password;
        $decryptionKey = "2b7e151628aed2a6abf7158809cf4f3c";
        $keyHex = hex2bin($decryptionKey);
        $request->password = openssl_decrypt(base64_decode($encryptedData), 'AES-128-ECB', $keyHex, OPENSSL_RAW_DATA);
        // //  for email

        $mencryptedData = $request->email;
        $mdecryptionKey = "2b7e151628aed2a6abf7158809cf4f3c";
        $mkeyHex = hex2bin($mdecryptionKey);
        $request->email = openssl_decrypt(base64_decode($mencryptedData), 'AES-128-ECB', $mkeyHex, OPENSSL_RAW_DATA);

        $user = PrivateCoaching::where('email', $request->email)->where('otp_verify', '!=', 1)->first();
        if ($user) {
            return response()->json(["error" => true, "msg" => "Please Register First."]);
        }

        if ($request->captcha != $request->captchacode) {

            return response()->json(["error" => true, "msg" => "Oops! Invalid Captcha Code."]);
        }

        // $credentials = $request->validate([
        //     'email' => 'required|email',
        //     'password' => 'required',

        // ]);
        // Auth::guard('PrivateCoaching')->attempt($credentials);
        if (Auth::guard('PrivateCoaching')->attempt(['email' => $request->email, 'password' => $request->password])) {

            // if (Auth::guard('PrivateCoaching')->attempt($credentials)) {
            PrivateCoaching::where('email', $request->email)->first()->update(['last_login' => now()]);

            if (Auth::guard('PrivateCoaching')->user()->change_password_status == 1) {
                return response()->json(["error" => false, "msg" => "Logged In Successfully./सफलतापूर्वक लॉगिन हो गए हैं।", "url" => route('private_coaching_dashboard')]);
            } else {

                return response()->json(["error" => false, "msg" => "Logged In Successfully./सफलतापूर्वक लॉगिन हो गए हैं।", "url" => route('private_coaching_change_password')]);
            }
        }
        return response()->json(["error" => true, "msg" => "The provided credentials does not match our records"]);
    }



    public function change_password()
    {
        return view('private_coaching.change_password');
    }




    public function change_password_store(Request $request)
    {



        $validation = Validator::make($request->all(), [

            'old_password' => 'required',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/'
            ],
            'password_confirmation' => 'required|min:8|same:password',
        ]);
        if ($validation->fails()) {
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
        }


        $user = Auth::guard('PrivateCoaching')->user();


        if ($user->decoded_password != $request->old_password) {

            return response()->json(['error' => true, 'msg' => 'Old Password Does Not Match Our Record.']);
        }

        $userUpdate = PrivateCoaching::find($user->id);



        $data = [
            'decoded_password' => $request->password,
            'password' => Hash::make($request->password),
            'change_password_status' => 1
        ];

        $userUpdate->update($data);


        return response()->json(["error" => false, "msg" => "Password Changed Successfully.", "url" => route('private_coaching_dashboard')]);
    }




    public function dashboard()
    {


        if (Auth::guard('PrivateCoaching')->user()->change_password_status != 1) {
            return redirect()->route('private_coaching_change_password');
        }
        $profile_detail = DB::table('private_coaching_profile')->where('user_id', Auth::guard('PrivateCoaching')->user()->id)->first();

        if (!$profile_detail) {
            return redirect()->route('private_coaching_profile');
        }

        $userId = Auth::guard('PrivateCoaching')->user()->id;

        $academyApplication = DB::table('private_coaching_register')
            ->leftJoin('private_academies_application', 'private_academies_application.user_id', '=', 'private_coaching_register.id')
            ->leftJoin('private_coaching_profile', 'private_coaching_profile.user_id', '=', 'private_coaching_register.id')
            ->select('private_academies_application.id as id_application', 'private_coaching_register.*', 'private_coaching_profile.*', 'private_academies_application.application_no', 'private_academies_application.*')
            ->where('private_academies_application.user_id', $userId)
            ->orderByDesc('private_academies_application.final_submit_on')
            ->get();

        $associationApplication = DB::table('private_coaching_register')
            ->leftJoin('private_coaching_application', 'private_coaching_application.user_id', '=', 'private_coaching_register.id')
            ->leftJoin('private_coaching_profile', 'private_coaching_profile.user_id', '=', 'private_coaching_register.id')
            ->select('private_coaching_application.id as id_application', 'private_coaching_register.*', 'private_coaching_profile.*', 'private_coaching_application.application_no', 'private_coaching_application.*')
            ->where('private_coaching_application.user_id', $userId)
            ->orderByDesc('private_coaching_application.final_submit_on')
            ->get();

        $gymApplication = DB::table('private_coaching_register')
            ->leftJoin('private_gym_application', 'private_gym_application.user_id', '=', 'private_coaching_register.id')
            ->leftJoin('private_coaching_profile', 'private_coaching_profile.user_id', '=', 'private_coaching_register.id')
            ->select('private_gym_application.id as id_application', 'private_coaching_register.*', 'private_coaching_profile.*', 'private_gym_application.application_no', 'private_gym_application.*')
            ->where('private_gym_application.user_id', $userId)
            ->orderByDesc('private_gym_application.final_submit_on')
            ->get();

        $swimmingApplication = DB::table('private_coaching_register')
            ->leftJoin('private_swimming_pool_application', 'private_swimming_pool_application.user_id', '=', 'private_coaching_register.id')
            ->leftJoin('private_coaching_profile', 'private_coaching_profile.user_id', '=', 'private_coaching_register.id')
            ->select('private_swimming_pool_application.id as id_application', 'private_coaching_register.*', 'private_coaching_profile.*', 'private_swimming_pool_application.application_no', 'private_swimming_pool_application.*')
            ->where('private_swimming_pool_application.user_id', $userId)
            ->orderByDesc('private_swimming_pool_application.final_submit_on')
            ->get();

        return view('private_coaching.dashboard', compact(
            'academyApplication',
            'associationApplication',
            'gymApplication',
            'swimmingApplication',
            'profile_detail'
        ));
    }


    public function application_form($id = null)
    {



        $application = DB::table('private_coaching_application')->where('id', $id)->first();
        if ($application) {
            $associate_member =  DB::table('private_coaching_associate_member')->where('application_id', $application->id)->get();
        } else {
            $associate_member = [];
        };
        $profile = DB::table('private_coaching_profile')->where('user_id', Auth::guard('PrivateCoaching')->user()->id)->first();
        if (isset($application) && $application->final_submit == 1) {
            return redirect()->route('private_coaching_')->with('success', 'Already final submitted.');
        }

        $sport = DB::table('sport_master')->orderBy('name')->get();


        $state = DB::table('states')->where('country_id', '105')->orderBy('name')->get();
        return view('private_coaching.application_form', compact('state', 'sport', 'application', 'profile', 'associate_member'));
    }


    public function application_form_store(Request $request, $id = null)
    {


        $data = [
            'user_id' => Auth::guard('PrivateCoaching')->user()->id,
            'sport' => $request->sport,
            'date_of_registration' => $request->date_of_registration,
        ];



        if ($request->hasFile('sport_federation')) {
            $sport_federation = moveFile('private_coaching_storage/sport_federation', $request->sport_federation);
            $data['sport_federation'] = $sport_federation;
        }


        if ($request->hasFile('granting_recognition')) {
            $granting_recognition = moveFile('private_coaching_storage/granting_recognition', $request->granting_recognition);
            $data['granting_recognition'] = $granting_recognition;
        }


        if ($request->hasFile('certified_copy_of_recognition')) {
            $certified_copy_of_recognition = moveFile('private_coaching_storage/certified_copy_of_recognition', $request->certified_copy_of_recognition);
            $data['certified_copy_of_recognition'] = $certified_copy_of_recognition;
        }


        if ($request->hasFile('registration_certificate')) {
            $registration_certificate = moveFile('private_coaching_storage/registration_certificate', $request->registration_certificate);
            $data['registration_certificate'] = $registration_certificate;
        }



        if ($request->hasFile('certified_copy_of_the_constitution')) {
            $certified_copy_of_the_constitution = moveFile('private_coaching_storage/certified_copy_of_the_constitution', $request->certified_copy_of_the_constitution);
            $data['certified_copy_of_the_constitution'] = $certified_copy_of_the_constitution;
        }



        if ($request->hasFile('copy_of_the_selection')) {
            $copy_of_the_selection = moveFile('private_coaching_storage/copy_of_the_selection', $request->copy_of_the_selection);
            $data['copy_of_the_selection'] = $copy_of_the_selection;
        }


        if ($request->hasFile('audited_income_first')) {
            $audited_income_first = moveFile('private_coaching_storage/audited_income_first', $request->audited_income_first);
            $data['audited_income_first'] = $audited_income_first;
        }

        if ($request->hasFile('audited_income_second')) {
            $audited_income_second = moveFile('private_coaching_storage/audited_income_second', $request->audited_income_second);
            $data['audited_income_second'] = $audited_income_second;
        }



        if ($request->hasFile('audited_income_third')) {
            $audited_income_third = moveFile('private_coaching_storage/audited_income_third', $request->audited_income_third);
            $data['audited_income_third'] = $audited_income_third;
        }






        if ($request->hasFile('copy_of_the_list_including_mobile')) {
            $copy_of_the_list_including_mobile = moveFile('private_coaching_storage/copy_of_the_list_including_mobile', $request->copy_of_the_list_including_mobile);
            $data['copy_of_the_list_including_mobile'] = $copy_of_the_list_including_mobile;
        }

        if ($request->hasFile('report_activity_first')) {
            $report_activity_first = moveFile('private_coaching_storage/report_activity_first', $request->report_activity_first);
            $data['report_activity_first'] = $report_activity_first;
        }

        if ($request->hasFile('report_activity_second')) {
            $report_activity_second = moveFile('private_coaching_storage/report_activity_second', $request->report_activity_second);
            $data['report_activity_second'] = $report_activity_second;
        }




        if ($request->hasFile('report_activity_third')) {
            $report_activity_third = moveFile('private_coaching_storage/report_activity_third', $request->report_activity_third);

            $data['report_activity_third'] = $report_activity_third;
        }


        if ($request->hasFile('state_sports_association_first')) {
            $state_sports_association_first = moveFile('private_coaching_storage/state_sports_association_first', $request->state_sports_association_first);

            $data['state_sports_association_first'] = $state_sports_association_first;
        }
        if ($request->hasFile('state_sports_association_second')) {
            $state_sports_association_second = moveFile('private_coaching_storage/state_sports_association_second', $request->state_sports_association_second);

            $data['state_sports_association_second'] = $state_sports_association_second;
        }


        if ($request->hasFile('state_sports_association_third')) {
            $state_sports_association_third = moveFile('private_coaching_storage/state_sports_association_third', $request->state_sports_association_third);

            $data['state_sports_association_third'] = $state_sports_association_third;
        }


        $application = DB::table('private_coaching_application')->where('id', $id)->first();


        if ($application) {

            DB::table('private_coaching_application')->where('id', $id)->update($data);
            $id = $application->id;
            DB::table('private_coaching_associate_member')->where('application_id', $application->id)->delete();

            foreach ($request->name_of_member as $key => $value) {
                $data = [
                    'application_id' => $application->id,
                    'name' => $value,
                    'mobile' => $request->mobile[$key],
                    'email' => $request->email[$key],
                    'designation' => $request->designation[$key],
                ];

                DB::table('private_coaching_associate_member')->insert($data);
            }
        } else {
            $id = DB::table('private_coaching_application')->insertGetId($data);

            foreach ($request->name_of_member as $key => $value) {
                $data = [
                    'application_id' => $id,
                    'name' => $value,
                    'mobile' => $request->mobile[$key],
                    'email' => $request->email[$key],
                    'designation' => $request->designation[$key],
                ];

                DB::table('private_coaching_associate_member')->insert($data);
            }
        }





        return response()->json(['error' => false, 'msg' => 'Application Saved Successfully.',  "url" => route('private_coaching_application_preview', $id)]);
    }




    public function application_preview($id)
    {
        $application = DB::table('private_coaching_application')->where('id', $id)->first();

        $profile = DB::table('private_coaching_profile')->where('user_id', Auth::guard('PrivateCoaching')->user()->id)->first();
        $associate_member =  DB::table('private_coaching_associate_member')->where('application_id', $application->id)->get();
        $query_mark =  DB::table('private_mark_query_comment')->where('type', 2)->where('application_no', $application->application_no)->get();

        return view('private_coaching.application_preview', compact('application', 'associate_member', 'profile', 'query_mark'));
    }




    public function applicationfinalSubmit($id)
    {


        if (DB::table('private_coaching_application')->where('id', $id)->where('final_submit', 1)->first()) {



            DB::table('private_coaching_application')->where('id', $id)->update([
                'query_status' => 2
            ]);
            return response()->json(['error' => false, 'msg' => 'Application Form Re-Submitted Successfully.',  "url" => route('private_coaching_application_preview', $id)]);
        } else {

            DB::table('private_coaching_application')->where('id', $id)->update([
                'final_submit' => 1,
                'application_no' => date('Y') . '01' . sprintf("%05d", $id),
                'final_submit_on' => now()
            ]);


            return response()->json(['error' => false, 'msg' => 'Application Form Final Submitted Successfully.',  "url" => route('private_coaching_application_preview', $id)]);
        }
    }


    public function profile(Request $request)
    {

        $district = DB::table('cities')->where('state_id', 23)->orderBy('city')->get();



        if ($request->method() == 'POST') {
            $validation = Validator::make($request->all(), [

                'office_address' => 'required',
                'state' => 'required',
                'district' => 'required',
                'pin' => 'required',

                'institute_name' => 'required',
                'photo_upload' => 'nullable|mimes:png,jpg,jpeg,pdf|max:2048',
            ]);
            if ($validation->fails()) {
                return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
            }
            $data = [
                'user_id' => Auth::guard('PrivateCoaching')->user()->id,
                'office_address' => $request->office_address,
                'state' => $request->state,
                'district' => $request->district,
                'pin' => $request->pin,


                'institute_name' => $request->institute_name,
            ];
            if ($request->hasFile('photo_upload')) {
                $photo_upload = moveFile('private_coaching_storage/photo_upload', $request->photo_upload);
                $data['photo_upload'] = $photo_upload;
            };

            $id = DB::table('private_coaching_profile')->insertGetId($data);
            return response()->json(['error' => false, 'msg' => 'Profile Saved Successfully.', "url" => route('private_coaching_dashboard')]);
        }
        return view('private_coaching.profile', compact('district'));
    }



    public function admin_dashboard()
    {

        $adminRole = Auth::guard('admin')->user()->admin_role;
        $application =   DB::table('private_coaching_register')
            ->leftJoin('private_coaching_application', 'private_coaching_application.user_id', '=', 'private_coaching_register.id')
            ->leftJoin('private_coaching_profile', 'private_coaching_profile.user_id', '=', 'private_coaching_register.id')->select('private_coaching_application.id as id_application', 'private_coaching_register.*', 'private_coaching_profile.*', 'private_coaching_application.application_no', 'private_coaching_application.*');

        // if(isset($adminRole) &&  $adminRole == 3)
        // $application->where('sport_id', '=', Auth::guard('admin')->user()->sport_type);

        if (isset($adminRole) &&  $adminRole == 2) {
            $div_id = Auth::guard('admin')->user()->division_id;
            $dis_t = DB::table('hostel_div_district_mapping')->where('division_id', $div_id)->pluck('district_id')
                ->toArray();

            // $application->where('is_forwarded', '>=', 1);
            $application->whereIn('district', $dis_t);
        } elseif (isset($adminRole) &&  $adminRole == 9) {
            // $application->where('is_forwarded', '>=', 1);
            $application->where('district', Auth::guard('admin')->user()->district_id);
        }
        // elseif(isset($adminRole) &&  $adminRole == 17){
        //     $application->where('is_forwarded', '>=', 2);
        // }

        $application = $application->where('private_coaching_application.final_submit', 1)->orderByDesc('private_coaching_application.final_submit_on')->get();
        return view('private_coaching.admin_dashboard', compact('application'));
    }



    public function admin_application_preview($id)
    {
        $adminRole = Auth::guard('admin')->user()->admin_role;
        $application =   DB::table('private_coaching_register')->leftJoin('private_coaching_application', 'private_coaching_application.user_id', '=', 'private_coaching_register.id')->leftJoin('private_coaching_profile', 'private_coaching_profile.user_id', '=', 'private_coaching_register.id')->select('private_coaching_application.id as id_application', 'private_coaching_register.*', 'private_coaching_profile.*', 'private_coaching_application.*')->where('private_coaching_application.id', $id)->first();
        $associate_member =  DB::table('private_coaching_associate_member')->where('application_id', $id)->get();
        $query_mark =  DB::table('private_mark_query_comment')->where('type', 2)->where('application_no', $application->application_no);
        $forward_data =  DB::table('private_mark_query_comment')->where('type', 1)->where('application_no', $application->application_no);
        if ($adminRole == 2 || $adminRole == 3 || $adminRole == 9) {
            $forward_data->where('role_id', $adminRole);
            $query_mark->where('role_id', $adminRole);
        }
        $forward_data = $forward_data->get();
        $query_mark = $query_mark->get();

        // dd($query_mark);
        return view('private_coaching.admin_application_preview', compact('application', 'associate_member', 'query_mark', 'forward_data'));
    }

    public function accepted_reject_status(Request $req)
    {

        if ($req->status == 1) {
            $data = [
                'status' => 1,
                'accept_reject_date' => date('Y-m-d'),
                'remark' => $req->remark
            ];
            $msg = "Application Accepted Successfully";
        } else {
            $data = [
                'status' => 2,
                'accept_reject_date' => date('Y-m-d'),
                'remark' => $req->remark
            ];
            $msg = "Application Rejected Successfully";
        }

        if ($req->value == 1) {
            DB::table('private_coaching_application')->where('id', $req->application_id)->update($data);
        } elseif ($req->value == 2) {
            DB::table('private_gym_application')->where('id', $req->application_id)->update($data);
        } elseif ($req->value == 3) {
            DB::table('private_academies_application')->where('id', $req->application_id)->update($data);
        } elseif ($req->value == 4) {
            DB::table('private_swimming_pool_application')->where('id', $req->application_id)->update($data);
        }
        return response()->json(['error' => false, 'msg' => $msg]);
    }
    public function profile_preview()
    {
        $profile = DB::table('private_coaching_profile')->where('user_id', Auth::guard('PrivateCoaching')->user()->id)->first();

        if (!$profile) {
            return redirect()->route('private_coaching_profile');
        }
        return view('private_coaching.profile_preview', compact('profile'));
    }
    public function logout()
    {

        Auth::guard('PrivateCoaching')->logout();
        return Redirect()->route('private_coaching_login')->with('success', 'User Logout successfully.');
    }

    public function private_coaching_export_pdf(Request $request)
    {

        $namee = "List of Applicants who applied for Associations";


        $check = DB::table('hostel_div_district_mapping')
            ->select(DB::raw('group_concat(district_id) as district_id'))->where('division_id', Auth::guard('admin')->user()->division_id)->get();

        $application =   DB::table('private_coaching_register')->leftJoin('private_coaching_application', 'private_coaching_application.user_id', '=', 'private_coaching_register.id')->leftJoin('private_coaching_profile', 'private_coaching_profile.user_id', '=', 'private_coaching_register.id')->select('private_coaching_application.id as id_application', 'private_coaching_register.*', 'private_coaching_profile.*', 'private_coaching_application.application_no', 'private_coaching_application.*')->where('private_coaching_application.final_submit', 1);


        $application = $application->orderByDesc('private_coaching_application.final_submit_on')->get();


        $pdf = PDF::loadView('private_coaching.admin_application_pdf', compact('application'))->setPaper('a4', 'landscape');
        $pdf->output();
        $domPdf = $pdf->getDomPDF();
        $canvas = $domPdf->get_canvas();
        $rightMargin = 90;
        $pageWidth = $canvas->get_width();
        $pageNumberX = $pageWidth - $rightMargin;

        $canvas->page_text($pageNumberX, $canvas->get_height() - 20, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, [0, 0, 0]);
        $canvas->page_text(320, $canvas->get_height() - 20, "*This is a Software Generated Report*", null, 10, [0, 0, 0]);

        return $pdf->download($namee . '.pdf');
    }


    public function forgot_password(Request $request)
    {



        if ($request->method() == 'POST') {
            // dd($request->all());
            $user = PrivateCoaching::where('email', $request->email)->first();
            if ($user != "") {
                // dd($reply->mobile);
                session()->put('form_type', 21);
                $check = SmsMail::dispatch([
                    "password" => $user->decoded_password,
                    "email" => $request->email,
                    "mobile" => $user->mobile
                ], 23);

                return response()->json(['error' => false, 'msg' => 'Password has been sent on the registered Mobile No./Email ID./पासवर्ड पंजीकृत मोबाइल नंबर/ईमेल आईडी पर भेज दिया गया है।', 'url' => route('private_coaching_login')]);
            }


            return response()->json(['error' => true, 'msg' => 'Email does not exists']);
        }

        return view("private_coaching.forgot_password");
    }

    public function swimming_pool($id = null)
    {


        $application = DB::table('private_swimming_pool_application')->where('id', $id)->first();
        $instructors = DB::table('private_sub_member_detail')->where('type', 3)->where('application_id', $id)->get();
        $lifeguards = DB::table('private_sub_member_detail')->where('type', 4)->where('application_id', $id)->get();

        return view('private_coaching.swimming_pool', [
            'application' => $application,
            'instructors' => $instructors,
            'lifeguards' => $lifeguards,
        ]);
    }

    public function gyms($id = null)
    {
        $application = DB::table('private_gym_application')->where('id', $id)->first();



        // If you have related data like trainers or staff stored in other tables:
        $trainers = DB::table('private_sub_member_detail')->where('type', 5)->where('application_id', $id)->get();

        return view('private_coaching.gyms', [
            'application' => $application,
            'trainers' => $trainers
        ]);
    }

    public function academies($id = null)
    {
        $application = DB::table('private_academies_application')->where('id', $id)->first();


        $sport = DB::table('sport_master')->orderBy('name')->get();

        // If you have related data like trainers or staff stored in other tables:
        $trainers = DB::table('private_sub_member_detail')->where('type', 1)->where('application_id', $id)->get();
        $staff = DB::table('private_sub_member_detail')->where('type', 2)->where('application_id', $id)->get();

        return view('private_coaching.academies', [
            'application' => $application,
            'trainers' => $trainers,
            'staffs' => $staff,
            'sport' => $sport,
        ]);
    }


    public function academies_application_form_store(Request $request, $id = null)
    {
        $validation = Validator::make($request->all(), [
            'head_name' => 'required|string|max:255',
            'head_address' => 'required|string|max:500',
            'sport' => 'required',
            'head_mobile' => 'required|string|digits:10',
            'head_email' => 'required|email|max:255',
            'institution_type' => 'required|string|max:255',
            'manager_name' => 'required|string|max:255',
            'manager_address' => 'required|string|max:500',
            'manager_mobile' => 'required|string|digits:10',
            'manager_email' => 'required|email|max:255',
            'has_trainer' => 'required|in:0,1',
            'trainer_name' => 'required_if:has_trainer,1|array',

            'trainer_address' => 'required_if:has_trainer,1|array',

            'trainer_mobile' => 'required_if:has_trainer,1|array',

            'has_staff' => 'required|in:0,1',
            'support_name' => 'required_if:has_staff,1|array',

            'support_address' => 'required_if:has_staff,1|array',

            'support_mobile' => 'required_if:has_staff,1|array',

            'medical_facility_available' => 'required|in:0,1',
            'nearest_hospital_name' => 'required_if:medical_facility_available,0|string|max:255',
            'nearest_hospital_contact_number' => 'required_if:medical_facility_available,0|string|max:20',
            'attendance_register_available' => 'required|in:0,1',
            'rules_display_board_available' => 'required|in:0,1',
            'operating_hours' => 'required',
            'applicant_name' => 'required|string|max:255',
            'applicant_address' => 'required|string|max:500',
            'applicant_mobile' => 'required|string|digits:10',
            'photo' => 'nullable|file|mimes:jpeg,jpg|max:2048',
            'signature' => 'nullable|file|mimes:jpeg,jpg|max:2048',
            'trainer_photo.*' => 'nullable|file|mimes:jpeg,jpg|max:2048',
            'trainer_certificate.*' => 'nullable|file|mimes:jpeg,jpg,pdf|max:2048',
            'support_photo.*' => 'nullable|file|mimes:jpeg,jpg|max:2048',
            'support_certificate.*' => 'nullable|file|mimes:jpeg,jpg,pdf|max:2048',
            // 'noc_certificate' => 'nullable|file|mimes:jpeg,jpg,pdf|max:2048',
            'academy_map' => 'nullable|file|mimes:jpeg,jpg,pdf|max:2048',
            'previous_year_noc' => 'nullable|file|mimes:jpeg,jpg,pdf|max:2048',
            'academy_photo_1' => 'nullable|file|mimes:jpeg,jpg|max:2048',
            'academy_photo_2' => 'nullable|file|mimes:jpeg,jpg|max:2048',
            'academy_photo_3' => 'nullable|file|mimes:jpeg,jpg|max:2048',
            'academy_photo_4' => 'nullable|file|mimes:jpeg,jpg|max:2048',
            'affidavit_compliance' => 'nullable|file|mimes:jpeg,jpg,pdf|max:2048',
        ], [
            'sport.required' => 'Select at least one sport.'
        ]);

        if ($validation->fails()) {
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
        }
        DB::beginTransaction();

        try {
            $userId = Auth::guard('PrivateCoaching')->user()->id;

            $data = [
                'head_name' => $request->head_name,
                'head_address' => $request->head_address,
                'head_mobile' => $request->head_mobile,
                'head_email' => $request->head_email,
                'sport' => implode(',', $request->input('sport')),
                'institution_type' => $request->institution_type,
                'manager_name' => $request->manager_name,
                'manager_address' => $request->manager_address,
                'manager_mobile' => $request->manager_mobile,
                'manager_email' => $request->manager_email,
                'has_trainer' => $request->has_trainer,
                'has_staff' => $request->has_staff,
                'medical_facility_available' => $request->medical_facility_available,
                'nearest_hospital_name' => $request->nearest_hospital_name,
                'nearest_hospital_contact_number' => $request->nearest_hospital_contact_number,
                'attendance_register_available' => $request->attendance_register_available,
                'rules_display_board_available' => $request->rules_display_board_available,
                'operating_hours' => $request->operating_hours,
                'applicant_name' => $request->applicant_name,
                'applicant_address' => $request->applicant_address,
                'applicant_mobile' => $request->applicant_mobile,
                'user_id' => $userId,
            ];

            // Handle file uploads
            $fileFields = [
                'photo' => 'private_coaching_storage/photo',
                'signature' => 'private_coaching_storage/signature',
                'noc_certificate' => 'private_coaching_storage/noc_certificate',
                'academy_map' => 'private_coaching_storage/academy_map',
                'previous_year_noc' => 'private_coaching_storage/previous_year_noc',
                'academy_photo_1' => 'private_coaching_storage/academy_photo_1',
                'academy_photo_2' => 'private_coaching_storage/academy_photo_2',
                'academy_photo_3' => 'private_coaching_storage/academy_photo_3',
                'academy_photo_4' => 'private_coaching_storage/academy_photo_4',
                'affidavit_compliance' => 'private_coaching_storage/affidavit_compliance',
            ];

            foreach ($fileFields as $field => $path) {
                if ($request->hasFile($field)) {
                    $data[$field] = moveFile($path, $request->file($field));
                }
            }

            if ($id) {
                // Update
                DB::table('private_academies_application')->where('id', $id)->update($data);
                $applicationId = $id;

                // Delete existing trainers/supports if they exist
                DB::table('private_sub_member_detail')->whereIn('type', [1, 2])->where('application_id', $id)->delete();
            } else {
                // Create new
                $applicationId = DB::table('private_academies_application')->insertGetId($data);
            }

            // Save trainers
            if ($request->has_trainer == 1) {
                foreach ($request->trainer_name as $i => $name) {
                    $trainerPhoto = null;
                    $trainerCertificate = null;

                    // Handle photo update
                    if (isset($request->trainer_photo[$i])) {
                        $trainerPhoto = moveFile('private_coaching_storage/trainer_photo', $request->trainer_photo[$i]);
                    } elseif (isset($request->existing_trainer_photo[$i])) {
                        $trainerPhoto = $request->existing_trainer_photo[$i]; // Keep existing photo if no new one uploaded
                    }

                    // Handle certificate update
                    if (isset($request->trainer_certificate[$i])) {
                        $trainerCertificate = moveFile('private_coaching_storage/trainer_certificate', $request->trainer_certificate[$i]);
                    } elseif (isset($request->existing_trainer_certificate[$i])) {
                        $trainerCertificate = $request->existing_trainer_certificate[$i]; // Keep existing certificate
                    }

                    $trainerData = [
                        'user_id' => $userId,
                        'application_id' => $applicationId,
                        'type' => 1,
                        'name' => $name,
                        'address' => $request->trainer_address[$i],
                        'mobile' => $request->trainer_mobile[$i],
                        'photo' => $trainerPhoto,
                        'certificate' => $trainerCertificate,
                    ];
                    DB::table('private_sub_member_detail')->insert($trainerData);
                }
            }


            if ($request->has_staff == 1) {
                foreach ($request->support_name as $i => $name) {
                    $supportPhoto = null;
                    $supportCertificate = null;

                    // Handle photo update
                    if (isset($request->support_photo[$i])) {
                        $supportPhoto = moveFile('private_coaching_storage/support_photo', $request->support_photo[$i]);
                    } elseif (isset($request->existing_staff_photo[$i])) {
                        $supportPhoto = $request->existing_staff_photo[$i];
                    }

                    // Handle certificate update
                    if (isset($request->support_certificate[$i])) {
                        $supportCertificate = moveFile('private_coaching_storage/support_certificate', $request->support_certificate[$i]);
                    } elseif (isset($request->existing_staff_certificate[$i])) {
                        $supportCertificate = $request->existing_staff_certificate[$i];
                    }

                    $supportData = [
                        'user_id' => $userId,
                        'application_id' => $applicationId,
                        'type' => 2,
                        'name' => $name,
                        'address' => $request->support_address[$i],
                        'mobile' => $request->support_mobile[$i],
                        'photo' => $supportPhoto,
                        'certificate' => $supportCertificate,
                    ];
                    DB::table('private_sub_member_detail')->insert($supportData);
                }
            }

            DB::commit();

            return response()->json([
                'error' => false,
                'msg' => $id ? 'Application updated successfully' : 'Application submitted successfully',
                'url' => route('academies_application_preview', $applicationId)
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => true, 'msg' => 'Something went wrong.']);
        }
    }


    public function academies_application_preview($id)
    {
        $application = DB::table('private_academies_application')->where('id', $id)->first();

        if (!$application) {
            abort(404, 'Application not found.');
        }

        // If you have related data like trainers or staff stored in other tables:
        $trainers = DB::table('private_sub_member_detail')->where('type', 1)->where('application_id', $id)->get();
        $staff = DB::table('private_sub_member_detail')->where('type', 2)->where('application_id', $id)->get();
        $query_mark =  DB::table('private_mark_query_comment')->where('type', 2)->where('application_no', $application->application_no)->get();
        return view('private_coaching.academies_application_preview', [
            'application' => $application,
            'trainers' => $trainers,
            'staffs' => $staff,
            'query_mark' => $query_mark
        ]);
    }


    public function academies_application_finalSubmit($id)
    {



        if (DB::table('private_gym_application')->where('id', $id)->where('final_submit', 1)->first()) {



            DB::table('private_academies_application')->where('id', $id)->update([
                'query_status' => 2
            ]);
            return response()->json(['error' => false, 'msg' => 'Application Form Re-Submitted Successfully.',  "url" => route('academies_application_preview', $id)]);
        } else {

            DB::table('private_academies_application')->where('id', $id)->update([
                'final_submit' => 1,
                'application_no' => date('Y') . '02' . sprintf("%05d", $id),
                'final_submit_on' => now()
            ]);


            return response()->json(['error' => false, 'msg' => 'Application Form Final Submitted Successfully.',  "url" => route('academies_application_preview', $id)]);
        }
    }


    public function swimming_pool_form_store(Request $request, $id = null)
    {


        $validation = Validator::make($request->all(), [
            'owner_name' => 'required|string|max:255',
            'owner_address' => 'required|string|max:500',
            'owner_mobile' => 'required|string|max:20',
            'owner_email' => 'required|email|max:255',

            'manager_name' => 'required|string|max:255',
            'manager_address' => 'required|string|max:500',
            'manager_mobile' => 'required|string|max:20',
            'manager_email' => 'required|email|max:255',

            'has_instructor' => 'required|boolean',
            'instructor_name' => 'required_if:has_instructor,1|array',

            'instructor_address' => 'required_if:has_instructor,1|array',

            'instructor_mobile' => 'required_if:has_instructor,1|array',


            'has_life_guard' => 'required|boolean',
            'lifeguard_name' => 'required_if:has_life_guard,1|array',

            'lifeguard_address' => 'required_if:has_life_guard,1|array',

            'lifeguard_mobile' => 'required_if:has_life_guard,1|array',


            'water_capacity' => 'required|string|max:255',
            'water_source' => 'required|string|max:255',
            'other' => 'required_if:water_source,Other',
            'draining_utilization_process' => 'required|string|max:1000',

            'pool_size' => 'required|string|max:255',
            'pool_depth' => 'required|string|max:255',
            'height_boundary_wall' => 'required|string|max:255',
            'gate_access_detail' => 'required|string|max:1000',

            'available_filter_plant' => 'required|boolean',
            'filter_plant_capacity' => 'required_if:available_filter_plant,1|max:255',

            'depth_marking_available' => 'required|boolean',
            'medical_facility_available' => 'required|boolean',
            'life_jacket_available' => 'required|boolean',
            'swimmer_register_available' => 'required|boolean',

            'nearest_hospital_name' => 'required|string|max:255',
            'nearest_hospital_number' => 'required|string|max:20',

            'water_testing_kit_available' => 'required|boolean',
            'pool_rules_board_available' => 'required|boolean',
            'respiration_equipment_available' => 'required|boolean',
            'safety_hook_rope_available' => 'required|boolean',
            'life_saving_equipment_available' => 'required|boolean',

            'operating_hours' => 'required|string|max:255',

            'applicant_name' => 'required|string|max:255',
            'applicant_address' => 'required|string|max:500',
            'applicant_mobile' => 'required|string|max:20',
            'photo' => 'nullable|image|mimes:jpeg,jpg|max:2048',
            'signature' => 'nullable|image|mimes:jpeg,jpg|max:2048',
            'pool_layout_map' => 'nullable|file|mimes:pdf,jpeg,jpg|max:2048',
            'previous_year_noc' => 'nullable|file|mimes:pdf,jpeg,jpg|max:2048',
            'water_testing_report' => 'nullable|file|mimes:pdf,jpeg,jpg|max:2048',
            'photo_of_pool_1' => 'nullable|image|mimes:jpeg,jpg|max:2048',
            'photo_of_pool_2' => 'nullable|image|mimes:jpeg,jpg|max:2048',
            'photo_of_pool_3' => 'nullable|image|mimes:jpeg,jpg|max:2048',
            'photo_of_pool_4' => 'nullable|image|mimes:jpeg,jpg|max:2048',
            'affidavit_compliance' => 'nullable|file|mimes:pdf,jpeg,jpg|max:2048',
            // Array file inputs (optional)
            'instructor_photo.*' => 'nullable|image|mimes:jpeg,jpg|max:2048',
            'instructor_certificate.*' => 'nullable|file|mimes:pdf,jpeg,jpg|max:2048',
            'lifeguard_photo.*' => 'nullable|image|mimes:jpeg,jpg|max:2048',
            'lifeguard_certificate.*' => 'nullable|file|mimes:pdf,jpeg,jpg|max:2048',
        ]);

        if ($validation->fails()) {
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
        }






        DB::beginTransaction();

        try {
            $userId = Auth::guard('PrivateCoaching')->user()->id;

            $data = [
                'owner_name' => $request->owner_name,
                'owner_address' => $request->owner_address,
                'owner_mobile' => $request->owner_mobile,
                'owner_email' => $request->owner_email,

                'manager_name' => $request->manager_name,
                'manager_address' => $request->manager_address,
                'manager_mobile' => $request->manager_mobile,
                'manager_email' => $request->manager_email,
                'has_instructor' => $request->has_instructor,
                'has_life_guard' => $request->has_life_guard,
                'water_capacity' => $request->water_capacity,
                'water_source' => $request->water_source,
                'draining_utilization_process' => $request->draining_utilization_process,
                'pool_size' => $request->pool_size,
                'pool_depth' => $request->pool_depth,
                'height_boundary_wall' => $request->height_boundary_wall,
                'swimmer_register_available' => $request->swimmer_register_available,
                'gate_access_detail' => $request->gate_access_detail,
                'available_filter_plant' => $request->available_filter_plant,
                'depth_marking_available' => $request->depth_marking_available,
                'medical_facility_available' => $request->medical_facility_available,
                'life_jacket_available' => $request->life_jacket_available,
                'nearest_hospital_name' => $request->nearest_hospital_name,
                'nearest_hospital_number' => $request->nearest_hospital_number,
                'water_testing_kit_available' => $request->water_testing_kit_available,
                'pool_rules_board_available' => $request->pool_rules_board_available,
                'respiration_equipment_available' => $request->respiration_equipment_available,
                'safety_hook_rope_available' => $request->safety_hook_rope_available,
                'life_saving_equipment_available' => $request->life_saving_equipment_available,
                'respiration_equipment_available' => $request->respiration_equipment_available,

                'respiration_equipment_available' => $request->respiration_equipment_available,
                'operating_hours' => $request->operating_hours,
                'applicant_name' => $request->applicant_name,
                'applicant_address' => $request->applicant_address,
                'applicant_mobile' => $request->applicant_mobile,
                'user_id' => $userId,
            ];

            if ($request->water_source == 'Other') {
                $data['other'] = $request->other;
            } else {
                $data['other'] = null;
            }

            if ($request->available_filter_plant == 1) {
                $data['filter_plant_capacity'] = $request->filter_plant_capacity;
            } else {
                $data['filter_plant_capacity'] = null;
            }

            // Handle file uploads
            $fileFields = [
                'photo' => 'private_coaching_storage/photo',
                'signature' => 'private_coaching_storage/signature',
                'pool_layout_map' => 'private_coaching_storage/pool_layout_map',
                'previous_year_noc' => 'private_coaching_storage/previous_year_noc',
                'water_testing_report' => 'private_coaching_storage/water_testing_report',
                'photo_of_pool_1' => 'private_coaching_storage/photo_of_pool_1',
                'photo_of_pool_2' => 'private_coaching_storage/photo_of_pool_2',
                'photo_of_pool_3' => 'private_coaching_storage/photo_of_pool_3',
                'photo_of_pool_4' => 'private_coaching_storage/photo_of_pool_4',
                'affidavit_compliance' => 'private_coaching_storage/affidavit_compliance',
            ];

            foreach ($fileFields as $field => $path) {
                if ($request->hasFile($field)) {
                    $data[$field] = moveFile($path, $request->file($field));
                }
            }

            if ($id) {
                // Update
                DB::table('private_swimming_pool_application')->where('id', $id)->update($data);
                $applicationId = $id;

                // Delete existing trainers/supports if they exist
                DB::table('private_sub_member_detail')->whereIn('type', [3, 4])->where('application_id', $id)->delete();
            } else {
                // Create new
                $applicationId = DB::table('private_swimming_pool_application')->insertGetId($data);
            }

            // Save trainers
            if ($request->has_instructor == 1) {
                foreach ($request->instructor_name as $i => $name) {
                    $instructorPhoto = null;
                    $instructorCertificate = null;

                    // Handle photo update
                    if (isset($request->instructor_photo[$i])) {
                        $instructorPhoto = moveFile('private_coaching_storage/instructor_photo', $request->instructor_photo[$i]);
                    } elseif (isset($request->existing_instructor_photo[$i])) {
                        $instructorPhoto = $request->existing_instructor_photo[$i]; // Keep existing photo if no new one uploaded
                    }

                    // Handle certificate update
                    if (isset($request->instructor_certificate[$i])) {
                        $instructorCertificate = moveFile('private_coaching_storage/instructor_certificate', $request->instructor_certificate[$i]);
                    } elseif (isset($request->existing_instructor_certificate[$i])) {
                        $instructorCertificate = $request->existing_instructor_certificate[$i]; // Keep existing certificate
                    }

                    $trainerData = [
                        'user_id' => $userId,
                        'application_id' => $applicationId,
                        'type' => 3,
                        'name' => $name,
                        'address' => $request->instructor_address[$i],
                        'mobile' => $request->instructor_mobile[$i],
                        'photo' => $instructorPhoto,
                        'certificate' => $instructorCertificate,
                    ];
                    DB::table('private_sub_member_detail')->insert($trainerData);
                }
            }

            // Save support staff (similar logic as trainers)
            if ($request->has_life_guard == 1) {
                foreach ($request->lifeguard_name as $i => $name) {
                    $lifeguardPhoto = null;
                    $lifeguardCertificate = null;

                    // Handle photo update
                    if (isset($request->lifeguard_photo[$i])) {
                        $lifeguardPhoto = moveFile('private_coaching_storage/lifeguard_photo', $request->lifeguard_photo[$i]);
                    } elseif (isset($request->existing_lifeguard_photo[$i])) {
                        $lifeguardPhoto = $request->existing_lifeguard_photo[$i];
                    }

                    // Handle certificate update
                    if (isset($request->lifeguard_certificate[$i])) {
                        $lifeguardCertificate = moveFile('private_coaching_storage/lifeguard_certificate', $request->lifeguard_certificate[$i]);
                    } elseif (isset($request->existing_lifeguard_certificate[$i])) {
                        $lifeguardCertificate = $request->existing_lifeguard_certificate[$i];
                    }

                    $supportData = [
                        'user_id' => $userId,
                        'application_id' => $applicationId,
                        'type' => 4,
                        'name' => $name,
                        'address' => $request->lifeguard_address[$i],
                        'mobile' => $request->lifeguard_mobile[$i],
                        'photo' => $lifeguardPhoto,
                        'certificate' => $lifeguardCertificate,
                    ];
                    DB::table('private_sub_member_detail')->insert($supportData);
                }
            }

            DB::commit();

            return response()->json([
                'error' => false,
                'msg' => $id ? 'Application updated successfully' : 'Application submitted successfully',
                'url' => route('swimming_pool_application_preview', $applicationId)
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => true, 'msg' => $e]);
        }
    }



    public function swimming_pool_application_preview($id)
    {
        $application = DB::table('private_swimming_pool_application')->where('id', $id)->first();
        $instructors = DB::table('private_sub_member_detail')->where('type', 3)->where('application_id', $id)->get();
        $lifeguards = DB::table('private_sub_member_detail')->where('type', 4)->where('application_id', $id)->get();
        $query_mark =  DB::table('private_mark_query_comment')->where('type', 2)->where('application_no', $application->application_no)->get();

        return view('private_coaching.swimming_pool_application_preview', [
            'application' => $application,
            'instructors' => $instructors,
            'lifeguards' => $lifeguards,
            'query_mark' => $query_mark,
        ]);
    }





    public function swimming_pool_application_finalSubmit($id)
    {

        if (DB::table('private_swimming_pool_application')->where('id', $id)->where('final_submit', 1)->first()) {
            DB::table('private_swimming_pool_application')->where('id', $id)->update([
                'query_status' => 2
            ]);
            return response()->json(['error' => false, 'msg' => 'Application Form Re-Submitted Successfully.',  "url" => route('swimming_pool_application_preview', $id)]);
        } else {
            DB::table('private_swimming_pool_application')->where('id', $id)->update([
                'final_submit' => 1,
                'application_no' => date('Y') . '03' . sprintf("%05d", $id),
                'final_submit_on' => now()
            ]);
            return response()->json(['error' => false, 'msg' => 'Application Form Final Submitted Successfully.',  "url" => route('swimming_pool_application_preview', $id)]);
        }

        // DB::table('private_swimming_pool_application')->where('id', $id)->update([
        //     'final_submit' => 1,
        //     'application_no' => date('Y') . '03' . sprintf("%05d", $id),
        //     'final_submit_on' => now()
        // ]);


        // return response()->json(['error' => false, 'msg' => 'Application Form Final Submitted Successfully.',  "url" => route('swimming_pool_application_preview', $id)]);
    }

    public function gyms_form_store(Request $request, $id = null)
    {





        $validation = Validator::make($request->all(), [
            'owner_name' => 'required|string|max:255',
            'owner_address' => 'required|string|max:255',
            'owner_mobile' => 'required|digits:10',
            'operating_entity' => 'required|string|max:255',

            'manager_name' => 'required|string|max:255',
            'manager_address' => 'required|string|max:255',
            'manager_mobile' => 'required|digits:10',
            'manager_email' => 'required|email|max:255',

            'has_trainer' => 'required|boolean',
            'trainer_name.*' => 'required_if:has_trainer,1',
            'trainer_address.*' => 'required_if:has_trainer,1',
            'trainer_mobile.*' => 'required_if:has_trainer,1',

            'gym_station_count' => 'required|string|max:255',
            'gym_length' => 'required|string|max:255',
            'gym_width' => 'required|string|max:255',
            'gym_safety_equipment_details' => 'required|string|max:500',
            'gym_entrance_details' => 'required|string|max:500',

            'medical_facility_available' => 'required|boolean',
            'first_aid_box_available' => 'required|boolean',
            'user_register_available' => 'required|boolean',

            'nearest_hospital_name' => 'required|string|max:255',
            'nearest_hospital_contact_number' => 'required|string|max:20',

            'equipment_rules_board' => 'required|boolean',
            'respiration_device_available' => 'required|boolean',
            'operating_hours' => 'required|string|max:255',

            'applicant_name' => 'required|string|max:255',
            'applicant_address' => 'required|string|max:255',
            'applicant_mobile' => 'required|string|max:20',

            'photo' => 'nullable|file|mimes:pdf,jpg,jpeg|max:2048',
            'signature' => 'nullable|file|mimes:pdf,jpg,jpeg|max:2048',

            'trainer_photo.*' => 'nullable|file|mimes:pdf,jpg,jpeg|max:2048',
            'trainer_certificate.*' => 'nullable|file|mimes:pdf,jpg,jpeg|max:2048',

            'noc_certificate' => 'nullable|file|mimes:pdf,jpg,jpeg|max:2048',
            'previous_year_noc' => 'nullable|file|mimes:pdf,jpg,jpeg|max:2048',

            'gym_photo_1' => 'nullable|file|mimes:pdf,jpg,jpeg|max:2048',
            'gym_photo_2' => 'nullable|file|mimes:pdf,jpg,jpeg|max:2048',
            'gym_photo_3' => 'nullable|file|mimes:pdf,jpg,jpeg|max:2048',
            'gym_photo_4' => 'nullable|file|mimes:pdf,jpg,jpeg|max:2048',

            'affidavit_compliance' => 'nullable|file|mimes:pdf,jpg,jpeg|max:2048',
        ]);



        if ($validation->fails()) {

            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
        }









        DB::beginTransaction();

        // try {
        $userId = Auth::guard('PrivateCoaching')->user()->id;

        $data = [
            'owner_name' => $request->owner_name,
            'owner_address' => $request->owner_address,
            'owner_mobile' => $request->owner_mobile,
            'operating_entity' => $request->operating_entity,

            'manager_name' => $request->manager_name,
            'manager_address' => $request->manager_address,
            'manager_mobile' => $request->manager_mobile,
            'manager_email' => $request->manager_email,

            'has_trainer' => $request->has_trainer,
            'gym_station_count' => $request->gym_station_count,
            'gym_length' => $request->gym_length,
            'gym_width' => $request->gym_width,
            'gym_safety_equipment_details' => $request->gym_safety_equipment_details,
            'gym_entrance_details' => $request->gym_entrance_details,



            'medical_facility_available' => $request->medical_facility_available,
            'first_aid_box_available' => $request->first_aid_box_available,
            'user_register_available' => $request->user_register_available,
            'nearest_hospital_name' => $request->nearest_hospital_name,
            'nearest_hospital_contact_number' => $request->nearest_hospital_contact_number,
            'respiration_device_available' => $request->respiration_device_available,
            'equipment_rules_board' => $request->equipment_rules_board,
            'operating_hours' => $request->operating_hours,
            'applicant_name' => $request->applicant_name,
            'applicant_address' => $request->applicant_address,
            'applicant_mobile' => $request->applicant_mobile,
            'user_id' => $userId,
        ];



        // Handle file uploads
        $fileFields = [
            'photo' => 'private_coaching_storage/photo',
            'signature' => 'private_coaching_storage/signature',
            'noc_certificate' => 'private_coaching_storage/noc_certificate',
            'previous_year_noc' => 'private_coaching_storage/previous_year_noc',
            'gym_layout_plan_copy' => 'private_coaching_storage/gym_layout_plan_copy',
            'gym_photo_1' => 'private_coaching_storage/gym_photo_1',
            'gym_photo_2' => 'private_coaching_storage/gym_photo_2',
            'gym_photo_3' => 'private_coaching_storage/gym_photo_3',
            'gym_photo_4' => 'private_coaching_storage/gym_photo_4',
            'affidavit_compliance' => 'private_coaching_storage/affidavit_compliance',
        ];

        foreach ($fileFields as $field => $path) {
            if ($request->hasFile($field)) {
                $data[$field] = moveFile($path, $request->file($field));
            }
        }

        if ($id) {
            // Update
            DB::table('private_gym_application')->where('id', $id)->update($data);
            $applicationId = $id;

            // Delete existing trainers/supports if they exist
            DB::table('private_sub_member_detail')->whereIn('type', [5])->where('application_id', $id)->delete();
        } else {
            // Create new
            $applicationId = DB::table('private_gym_application')->insertGetId($data);
        }



        // Save support staff (similar logic as trainers)
        if ($request->has_trainer == 1) {
            foreach ($request->trainer_name as $i => $name) {
                $trainerPhoto = null;
                $trainerCertificate = null;

                // Handle photo update
                if (isset($request->trainer_photo[$i])) {
                    $trainerPhoto = moveFile('private_coaching_storage/trainer_photo', $request->trainer_photo[$i]);
                } elseif (isset($request->existing_trainer_photo[$i])) {
                    $trainerPhoto = $request->existing_trainer_photo[$i];
                }

                // Handle certificate update
                if (isset($request->trainer_certificate[$i])) {
                    $trainerCertificate = moveFile('private_coaching_storage/trainer_certificate', $request->trainer_certificate[$i]);
                } elseif (isset($request->existing_trainer_certificate[$i])) {
                    $trainerCertificate = $request->existing_trainer_certificate[$i];
                }

                $supportData = [
                    'user_id' => $userId,
                    'application_id' => $applicationId,
                    'type' => 5,
                    'name' => $name,
                    'address' => $request->trainer_address[$i],
                    'mobile' => $request->trainer_mobile[$i],
                    'photo' => $trainerPhoto,
                    'certificate' => $trainerCertificate,
                ];
                DB::table('private_sub_member_detail')->insert($supportData);
            }
        }

        DB::commit();

        return response()->json([
            'error' => false,
            'msg' => $id ? 'Application updated successfully' : 'Application submitted successfully',
            'url' => route('gyms_application_preview', $applicationId)
        ]);

        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     return response()->json(['error' => true, 'msg' => $e]);
        // }




    }


    public function gyms_application_preview($id)
    {
        $application = DB::table('private_gym_application')->where('id', $id)->first();
        $trainers = DB::table('private_sub_member_detail')->where('type', 5)->where('application_id', $id)->get();
        $query_mark =  DB::table('private_mark_query_comment')->where('type', 2)->where('application_no', $application->application_no)->get();

        return view('private_coaching.gyms_application_preview', [
            'application' => $application,
            'trainers' => $trainers,
            'query_mark' => $query_mark

        ]);
    }


    public function gyms_application_finalSubmit($id)
    {


        // DB::table('private_gym_application')->where('id', $id)->update([
        //     'final_submit' => 1,
        //     'application_no' => date('Y') . '04' . sprintf("%05d", $id),
        //     'final_submit_on' => now()
        // ]);

        if (DB::table('private_gym_application')->where('id', $id)->where('final_submit', 1)->first()) {
            DB::table('private_gym_application')->where('id', $id)->update([
                'query_status' => 2
            ]);
            return response()->json(['error' => false, 'msg' => 'Application Form Re-Submitted Successfully.',  "url" => route('gyms_application_preview', $id)]);
        } else {
            DB::table('private_gym_application')->where('id', $id)->update([
                'final_submit' => 1,
                'application_no' => date('Y') . '04' . sprintf("%05d", $id),
                'final_submit_on' => now()
            ]);
            return response()->json(['error' => false, 'msg' => 'Application Form Final Submitted Successfully.',  "url" => route('gyms_application_preview', $id)]);
        }


        // return response()->json(['error' => false, 'msg' => 'Application Form Final Submitted Successfully.',  "url" => route('gyms_application_preview', $id)]);
    }


    public function apply_for()
    {
        $userId = Auth::guard('PrivateCoaching')->user()->id;

        // Do not modify your existing queries:
        $academyApp = DB::table('private_coaching_register')
            ->leftJoin('private_academies_application', 'private_academies_application.user_id', '=', 'private_coaching_register.id')
            ->leftJoin('private_coaching_profile', 'private_coaching_profile.user_id', '=', 'private_coaching_register.id')
            ->select('private_academies_application.id as id_application', 'private_coaching_register.*', 'private_coaching_profile.*', 'private_academies_application.application_no', 'private_academies_application.*')
            ->where('private_academies_application.user_id', $userId)
            ->orderByDesc('private_academies_application.final_submit_on')
            ->get();

        $associationApp = DB::table('private_coaching_register')
            ->leftJoin('private_coaching_application', 'private_coaching_application.user_id', '=', 'private_coaching_register.id')
            ->leftJoin('private_coaching_profile', 'private_coaching_profile.user_id', '=', 'private_coaching_register.id')
            ->select('private_coaching_application.id as id_application', 'private_coaching_register.*', 'private_coaching_profile.*', 'private_coaching_application.application_no', 'private_coaching_application.*')
            ->where('private_coaching_application.user_id', $userId)
            ->orderByDesc('private_coaching_application.final_submit_on')
            ->get();

        $gymApp = DB::table('private_coaching_register')
            ->leftJoin('private_gym_application', 'private_gym_application.user_id', '=', 'private_coaching_register.id')
            ->leftJoin('private_coaching_profile', 'private_coaching_profile.user_id', '=', 'private_coaching_register.id')
            ->select('private_gym_application.id as id_application', 'private_coaching_register.*', 'private_coaching_profile.*', 'private_gym_application.application_no', 'private_gym_application.*')
            ->where('private_gym_application.user_id', $userId)
            ->orderByDesc('private_gym_application.final_submit_on')
            ->get();

        $swimmingApp = DB::table('private_coaching_register')
            ->leftJoin('private_swimming_pool_application', 'private_swimming_pool_application.user_id', '=', 'private_coaching_register.id')
            ->leftJoin('private_coaching_profile', 'private_coaching_profile.user_id', '=', 'private_coaching_register.id')
            ->select('private_swimming_pool_application.id as id_application', 'private_coaching_register.*', 'private_coaching_profile.*', 'private_swimming_pool_application.application_no', 'private_swimming_pool_application.*')
            ->where('private_swimming_pool_application.user_id', $userId)
            ->orderByDesc('private_swimming_pool_application.final_submit_on')
            ->get();

        // New: Create applied status array
        $applied = [
            'academies' => $academyApp->isNotEmpty(),
            'associations' => $associationApp->isNotEmpty(),
            'gyms' => $gymApp->isNotEmpty(),
            'swimming' => $swimmingApp->isNotEmpty(),
        ];




        return view('private_coaching.apply_for', compact('applied'));
    }


    // anu work admin

    public function gym_list()
    {
        $adminRole = Auth::guard('admin')->user()->admin_role;
        $application =   DB::table('private_coaching_register')
            ->leftJoin('private_gym_application', 'private_gym_application.user_id', '=', 'private_coaching_register.id')
            ->leftJoin('private_coaching_profile', 'private_coaching_profile.user_id', '=', 'private_coaching_register.id')
            ->select('private_gym_application.id as id_application', 'private_coaching_register.*', 'private_coaching_profile.*', 'private_gym_application.application_no', 'private_gym_application.*')
            ->where('private_gym_application.final_submit', 1);

        // if(isset($adminRole) &&  $adminRole == 3)
        // $application->where('sport_id', '=', Auth::guard('admin')->user()->sport_type);

        if (isset($adminRole) &&  $adminRole == 2) {
            $div_id = Auth::guard('admin')->user()->division_id;
            $dis_t = DB::table('hostel_div_district_mapping')->where('division_id', $div_id)->pluck('district_id')
                ->toArray();

            // $application->where('is_forwarded', '>=', 1);
            $application->whereIn('district', $dis_t);
        } elseif (isset($adminRole) &&  $adminRole == 9) {
            // $application->where('is_forwarded', '>=', 1);
            $application->where('district', Auth::guard('admin')->user()->district_id);
        }
        // elseif(isset($adminRole) &&  $adminRole == 17){
        //     $application->where('is_forwarded', '>=', 2);
        // }

        $application = $application->orderByDesc('private_gym_application.final_submit_on')
            ->get();


        return view('private_coaching.admin.gym_list', compact('application'));
    }

    public function admin_gym_preview($id)
    {
        $application =   DB::table('private_coaching_register')->leftJoin('private_gym_application', 'private_gym_application.user_id', '=', 'private_coaching_register.id')->leftJoin('private_coaching_profile', 'private_coaching_profile.user_id', '=', 'private_coaching_register.id')->select('private_gym_application.id as id_application', 'private_coaching_register.*', 'private_coaching_profile.*', 'private_gym_application.*')->where('private_gym_application.id', $id)->first();

        // $application = DB::table('private_gym_application')->where('id', $id)->first();
        $trainers = DB::table('private_sub_member_detail')->where('type', 5)->where('application_id', $id)->get();

        $adminRole = Auth::guard('admin')->user()->admin_role;
        $query_mark =  DB::table('private_mark_query_comment')->where('type', 2)->where('application_no', $application->application_no);
        $forward_data =  DB::table('private_mark_query_comment')->where('type', 1)->where('application_no', $application->application_no);
        if ($adminRole == 2 || $adminRole == 3 || $adminRole == 9) {
            $forward_data->where('role_id', $adminRole);
            $query_mark->where('role_id', $adminRole);
        }
        $forward_data = $forward_data->get();
        $query_mark = $query_mark->get();
        return view('private_coaching.admin.gyms_application_preview', [
            'application' => $application,
            'trainers' => $trainers,
            'query_mark' => $query_mark,
            'forward_data' => $forward_data

        ]);
    }
    public function academy_list()
    {
        $adminRole = Auth::guard('admin')->user()->admin_role;
        $application =   DB::table('private_academies_application')
            ->leftJoin('private_coaching_register', 'private_academies_application.user_id', '=', 'private_coaching_register.id')
            ->leftJoin('private_coaching_profile', 'private_coaching_profile.user_id', '=', 'private_academies_application.user_id')
            ->select('private_academies_application.id as id_application', 'private_coaching_register.*', 'private_coaching_profile.*', 'private_academies_application.application_no', 'private_academies_application.*')
            ->where('private_academies_application.final_submit', 1);

        // if(isset($adminRole) &&  $adminRole == 3)
        // $application->where('sport_id', '=', Auth::guard('admin')->user()->sport_type);

        if (isset($adminRole) &&  $adminRole == 2) {
            $div_id = Auth::guard('admin')->user()->division_id;
            $dis_t = DB::table('hostel_div_district_mapping')->where('division_id', $div_id)->pluck('district_id')
                ->toArray();

            // $application->where('is_forwarded', '>=', 1);
            $application->whereIn('district', $dis_t);
        } elseif (isset($adminRole) &&  $adminRole == 9) {
            // $application->where('is_forwarded', '>=', 1);
            $application->where('district', Auth::guard('admin')->user()->district_id);
        }
        // elseif(isset($adminRole) &&  $adminRole == 17){
        //     $application->where('is_forwarded', '>=', 2);
        // }

        $application = $application->orderByDesc('private_academies_application.final_submit_on')
            ->get();


        return view('private_coaching.admin.academy_list', compact('application'));
    }
    public function admin_academy_preview($id)
    {
        $application =   DB::table('private_coaching_register')->leftJoin('private_academies_application', 'private_academies_application.user_id', '=', 'private_coaching_register.id')->leftJoin('private_coaching_profile', 'private_coaching_profile.user_id', '=', 'private_coaching_register.id')->select('private_academies_application.id as id_application', 'private_coaching_register.*', 'private_coaching_profile.*', 'private_academies_application.*')->where('private_academies_application.id', $id)->first();

        // $application = DB::table('private_gym_application')->where('id', $id)->first();
        $trainers = DB::table('private_sub_member_detail')->where('type', 5)->where('application_id', $id)->get();
        $staff = DB::table('private_sub_member_detail')->where('type', 2)->where('application_id', $id)->get();
        $adminRole = Auth::guard('admin')->user()->admin_role;
        $query_mark =  DB::table('private_mark_query_comment')->where('type', 2)->where('application_no', $application->application_no);
        $forward_data =  DB::table('private_mark_query_comment')->where('type', 1)->where('application_no', $application->application_no);
        if ($adminRole == 2 || $adminRole == 3 || $adminRole == 9) {
            $forward_data->where('role_id', $adminRole);
            $query_mark->where('role_id', $adminRole);
        }
        $forward_data = $forward_data->get();
        $query_mark = $query_mark->get();
        return view('private_coaching.admin.academy_application_preview', [
            'application' => $application,
            'trainers' => $trainers,
            'staffs' => $staff,
            'query_mark' => $query_mark,
            'forward_data' => $forward_data

        ]);
    }

    public function swimming_pool_list()
    {
        $adminRole = Auth::guard('admin')->user()->admin_role;
        $application =   DB::table('private_swimming_pool_application')
            ->leftJoin('private_coaching_register', 'private_swimming_pool_application.user_id', '=', 'private_coaching_register.id')
            ->leftJoin('private_coaching_profile', 'private_coaching_profile.user_id', '=', 'private_swimming_pool_application.user_id')
            ->select('private_swimming_pool_application.id as id_application', 'private_coaching_register.*', 'private_coaching_profile.*', 'private_swimming_pool_application.application_no', 'private_swimming_pool_application.*')
            ->where('private_swimming_pool_application.final_submit', 1);

        // if(isset($adminRole) &&  $adminRole == 3)
        // $application->where('sport_id', '=', Auth::guard('admin')->user()->sport_type);

        if (isset($adminRole) &&  $adminRole == 2) {
            $div_id = Auth::guard('admin')->user()->division_id;
            $dis_t = DB::table('hostel_div_district_mapping')->where('division_id', $div_id)->pluck('district_id')
                ->toArray();

            // $application->where('is_forwarded', '>=', 1);
            $application->whereIn('district', $dis_t);
        } elseif (isset($adminRole) &&  $adminRole == 9) {
            // $application->where('is_forwarded', '>=', 1);
            $application->where('district', Auth::guard('admin')->user()->district_id);
        }
        // elseif(isset($adminRole) &&  $adminRole == 17){
        //     $application->where('is_forwarded', '>=', 2);
        // }

        $application = $application->orderByDesc('private_swimming_pool_application.final_submit_on')
            ->get();
        // dd($application);
        return view('private_coaching.admin.swimming_pool_list', compact('application'));
    }

    public function admin_swimming_pool_preview($id)
    {
        $application =   DB::table('private_coaching_register')->leftJoin('private_swimming_pool_application', 'private_swimming_pool_application.user_id', '=', 'private_coaching_register.id')->leftJoin('private_coaching_profile', 'private_coaching_profile.user_id', '=', 'private_coaching_register.id')->select('private_swimming_pool_application.id as id_application', 'private_coaching_register.*', 'private_coaching_profile.*', 'private_swimming_pool_application.*')->where('private_swimming_pool_application.id', $id)->first();

        // $application = DB::table('private_gym_application')->where('id', $id)->first();
        $instructors = DB::table('private_sub_member_detail')->where('type', 3)->where('application_id', $id)->get();
        $lifeguards = DB::table('private_sub_member_detail')->where('type', 4)->where('application_id', $id)->get();

        $adminRole = Auth::guard('admin')->user()->admin_role;
        $query_mark =  DB::table('private_mark_query_comment')->where('type', 2)->where('application_no', $application->application_no);
        $forward_data =  DB::table('private_mark_query_comment')->where('type', 1)->where('application_no', $application->application_no);
        if ($adminRole == 2 || $adminRole == 3 || $adminRole == 9) {
            $forward_data->where('role_id', $adminRole);
            $query_mark->where('role_id', $adminRole);
        }
        $forward_data = $forward_data->get();
        $query_mark = $query_mark->get();
        return view('private_coaching.admin.swimming_pool_application_preview', [
            'application' => $application,
            'instructors' => $instructors,
            'lifeguards' => $lifeguards,
            'query_mark' => $query_mark,
            'forward_data' => $forward_data

        ]);
    }

    public function query_mark(Request $req)
    {

        $data = [

            'query_status' => 1,
            // 'query' => $req->remark,
            // 'marked_on' => date('Y-m-d')


        ];
        $query_upload = '';
        if ($req->hasFile('query_upload')) {
            $query_upload = moveFile('private_coaching_storage/query_upload', $req->query_upload);
            // $data['query_upload'] = $query_upload;
        };
        if ($req->value == 1) {
            DB::table('private_coaching_application')->where('id', $req->application_id)->update($data);
        } elseif ($req->value == 2) {
            DB::table('private_gym_application')->where('id', $req->application_id)->update($data);
        } elseif ($req->value == 3) {
            DB::table('private_academies_application')->where('id', $req->application_id)->update($data);
        } elseif ($req->value == 4) {
            DB::table('private_swimming_pool_application')->where('id', $req->application_id)->update($data);
        }
        DB::table('private_mark_query_comment')->insert([
            'application_no' => $req->application_no,
            'comments' => $req->remark,
            'doc' => $query_upload,
            'type' => 2,
            'created_by' => Auth::guard('admin')->user()->id,
            'role_id' => Auth::guard('admin')->user()->admin_role,
        ]);

        return response()->json(['error' => false, 'msg' => 'Query Marked Successfully', 'url' => route(
            'admin_private_coaching_preview',
            $req->application_id
        )]);
    }

    public function private_forward(Request $req)
    {


        $query_upload = '';
        if ($req->hasFile('verification_document')) {
            $query_upload = moveFile('private_coaching_storage/query_upload', $req->verification_document);
            // $data['query_upload'] = $query_upload;
        };

        if (Auth::guard('admin')->user()->admin_role == 3) {
            $data = ['is_forwarded' => 1];
        } else {
            $data = ['is_forwarded' => 2];
        }

        if ($req->form_type == 1) {
            DB::table('private_coaching_application')->where('id', $req->id)->update($data);
        } elseif ($req->form_type == 2) {
            DB::table('private_gym_application')->where('id', $req->id)->update($data);
        } elseif ($req->form_type == 3) {
            DB::table('private_academies_application')->where('id', $req->id)->update($data);
        } elseif ($req->form_type == 4) {
            DB::table('private_swimming_pool_application')->where('id', $req->id)->update($data);
        }

        DB::table('private_mark_query_comment')->insert([
            'application_no' => $req->application_no,
            'comments' => $req->remark,
            'doc' => $query_upload,
            'type' => 1,
            'created_by' => Auth::guard('admin')->user()->id,
            'role_id' => Auth::guard('admin')->user()->admin_role,
        ]);

        return response()->json(['error' => false, 'msg' => 'Application Forwarded', 'url' => url('admin/private_coaching/dashboard')]);
    }
}
