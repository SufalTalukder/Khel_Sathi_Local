<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserLoggedIn;
use App\Events\StatusChangeLog;
use App\Events\ChangePasswordLog;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\AuthModel;
use App\Models\AdminUser;
use App\Events\SmsMail;
use App\Mail\AcceptMail;
use Illuminate\Support\Facades\Mail;
use Exception;
use Illuminate\Support\Facades\Session;
use App\Models\RsoUser;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProjectExport;
use App\Exports\EklProjectExport;
use PDF;
use DateTime;

class Adminathentication extends Controller
{


    //  public function __construct(Request $request)
    // {

    //     $current_date = new DateTime();

    //     // Comparison date (10-10-2025)
    //     $comparison_date = new DateTime('2025-10-09');

    //     if ($current_date > $comparison_date) {
    //         // echo "Form is disabled because the current date is greater than 10-10-2025.";
    //         echo view('coming-soon');
    //         exit;
    //      }

    // }

    public $tableName;
    public function form_login()
    {

        $user_master = DB::table('user_master')->select('id', 'name')->get();
        $Code1 = rand(11, 99);
        $Code2 = rand(11, 99);
        $capchaCode = $Code1 +  $Code2;
        session()->put('capchaCode', $capchaCode);




        return view('auth.adminlogin', compact('capchaCode', 'user_master', 'Code1', 'Code2'));
    }

    public function forgot()
    {
        return view('auth.adminforgot');
    }
    public function otp()
    {
        return view('auth.adminotp');
    }

    public function login(Request $req)
    {
        $validation = Validator::make($req->all(), [
            'email' => 'required',
            'password' => 'required',
            'captcha' => 'required',
        ], msg());

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        // dd($req->all());
        if ($req->captcha != $req->capchaCode)
            return response()->json(['error' => true, 'msg' => "Oops! Invalid Captcha Code."]);

        $encryptedData = $req->password;
        $decryptionKey = "2b7e151628aed2a6abf7158809cf4f3c";
        $keyHex = hex2bin($decryptionKey);
        $req->password = openssl_decrypt(base64_decode($encryptedData), 'AES-128-ECB', $keyHex, OPENSSL_RAW_DATA);
        // //  for email

        $mencryptedData = $req->email;
        $mdecryptionKey = "2b7e151628aed2a6abf7158809cf4f3c";
        $mkeyHex = hex2bin($mdecryptionKey);
        $req->email = openssl_decrypt(base64_decode($mencryptedData), 'AES-128-ECB', $mkeyHex, OPENSSL_RAW_DATA);


        if (Auth::guard('admin')->attempt(['email' => $req->email, 'password' => $req->password])) {

            // if (Auth::guard('admin')->user()->is_login == 1) {
            //     Auth::guard('admin')->logout();
            //     return response()->json(['error' => true, 'msg' => "You are already login some where else .First logout there."]);
            // }

            DB::table('admin')->where('id', Auth::guard('admin')->user()->id)->update([
                "is_login" => 1,
                "ip_address" => request()->ip()
            ]);

            // dd($req->session()->all());
            //UserLoggedIn::dispatch(Auth::guard('admin')->user()->id, 1,1,'admin');
            session()->flash('success', 'Successfully Login.');
            if (Auth::guard('admin')->user()->admin_role == 5) {
                return response()->json(['error' => false, 'msg' => "Successfully Login.", 'url' => url('admin/dashboard')]);
            } elseif (Auth::guard('admin')->user()->admin_role == 6) {
                return response()->json(['error' => false, 'msg' => "Successfully Login.", 'url' => url('collegeadmin/dashboard')]);
            } else {
                return response()->json(['error' => false, 'msg' => "Successfully Login.", 'url' => url('admin/dashboard')]);
            }
        }




        return response()->json(['error' => true, 'msg' => "Oops! Invalid Credentials."]);
    }
    public function changePassword()
    {
        return view('rso.dashboard.changePassword');
    }
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

        return AdminUser::changePassword($req);
    }
    public function signOuts()
    {
        // dd("hello");
        UserLoggedIn::dispatch(Auth::guard('admin')->user()->id, 2, 1, 'admin');
        // Auth::logout();
        DB::table('admin')->where('id', Auth::guard('admin')->user()->id)->update([
            "is_login" => 0,
            "ip_address" => request()->ip()
        ]);
        Auth::guard('admin')->logout();

        return Redirect('/admin/login');
    }

    // public function preRegistration(Request $req)
    // {
    //     $required = [
    //         'investortype'  => 'required',
    //         'onrname'   => 'required',
    //         'mobile'        => 'required|numeric|digits:10',
    //         'email'         => 'required|email',
    //         'captcha'       => 'required',
    //         'password'      => 'required'
    //     ];

    //     if ($req->investortype == 1) {
    //         $required['ocfname'] = 'required';
    //         $required['legalstatus'] = 'required';
    //     }

    //     $validation = Validator::make($req->all(), $required, msg());

    //     if ($validation->fails())
    //         return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

    //     if ($req->captcha != $req->capchaCode)
    //         return response()->json(['error' => true, 'msg' => "Oops! Invalid Captcha Code."]);

    //     return AuthModel::preRegistration($req);
    // }

    // public function otpVerify(Request $req)
    // {
    //     $validation = Validator::make($req->all(), [
    //         'otp1' => 'required',
    //         'otp2' => 'required',
    //         'otp3' => 'required',
    //         'otp4' => 'required',
    //         'otp5' => 'required',
    //         'otp6' => 'required',
    //     ], msg());

    //     if ($validation->fails())
    //         return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

    //     return AuthModel::otpVerify($req);
    // }

    public function resendOtp()
    {
        return AuthModel::resendOtp();
    }

    public function cp_refresh()
    {
        $capchaCode = rand(11111, 99999);
        session()->put('capchaCode', $capchaCode);
        return response()->json($capchaCode);
    }

    // public function d_form_login()
    // {
    //     $user_master = DB::table('user_master')->select('id', 'name')->get();
    //     $capchaCode = rand(11111, 99999);
    //     session()->put('capchaCode', $capchaCode);
    //     return view('auth.departmentlogin', compact('capchaCode', 'user_master'));
    // }

    public function d_login(Request $req)
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

        if (Auth::guard('department')->attempt(['email' => $req->email, 'password' => $req->password])) {
            session()->flash('success', 'Successfully Login.');
            return response()->json(['error' => false, 'msg' => "Successfully Login.", 'url' => url('department/dashboard')]);
        }
        // dd(1);
        return response()->json(['error' => true, 'msg' => "Oops! Invalid Credentials."]);
    }

    public function rso_form_login()
    {
        $user_master = DB::table('user_master')->select('id', 'name')->get();
        $capchaCode = rand(11111, 99999);
        session()->put('capchaCode', $capchaCode);
        return view('rso.login.rsoLogin', compact('capchaCode', 'user_master'));
    }

    public function rso_login(Request $req)
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


        if (Auth::guard('rsouser')->attempt(['email' => $req->email, 'password' => $req->password])) {
            // dd(Auth::guard('rsouser')->user()->role);
            Auth::logout();
            if (Auth::guard('admin')->user()->admin_role == 2) {
                UserLoggedIn::dispatch(Auth::guard('admin')->user()->id, 1, 3, 'rsouser');
                session()->flash('success', 'Successfully Login.');
                return response()->json(['error' => false, 'msg' => "Successfully Logged In.", 'url' => url('rso/rsoDashboard')]);
            } else {
                UserLoggedIn::dispatch(Auth::guard('rsouser')->user()->id, 1, 3, 'association');
                session()->flash('success', 'Successfully Login.');
                return response()->json(['error' => false, 'msg' => "Successfully Logged In.", 'url' => url('rso/rsoDashboard')]);
            }
            // session()->flash('success', 'Successfully Login.');
            // return response()->json(['error' => false, 'msg' => "Successfully Logged In.", 'url' => url('rso/rsoDashboard')]);
        }
        return response()->json(['error' => true, 'msg' => "Please Enter Valid Login Credentials."]);
    }

    public function rsologout()
    {
        UserLoggedIn::dispatch(Auth::guard('admin')->user()->id, 2, 3, 'rsouser');
        Auth::guard('rsouser')->logout();

        return redirect('rso/login');
        //return response()->json(['error' => false, 'msg' => "Successfully Logout."]);
    }

    public function direct_rect()
    {
        $seg = 4;
        $seg4 = "";
        $details = DB::table('direct_recruitment')
            ->select('direct_recruitment.*')
            ->get();
        // dd($details);

        $cities = DB::table('cities')->where('state_id', 23)->orderBy('city', 'ASC')->get();
        $sports = DB::table('sport_type')->orderBy('name', 'ASC')->get();
        $sport_event = DB::table('sports_event_master')->select('event_name as name', 'id')->get();
        $post_master = DB::table('advertisment_post_master')->select('post_name as name', 'id')->get();
        return view('rso.dashboard.direct_rect', compact('post_master', 'sport_event', 'details', 'cities', 'sports', 'seg', 'seg4'));
    }

    public function direct_rect_view($id)
    {
        $details = DB::table('direct_recruitment')
            ->join('sport_welfare_registration_master', 'sport_welfare_registration_master.id', '=', 'direct_recruitment.user_id')
            ->join('sport_type', 'sport_type.id', '=', 'sport_welfare_registration_master.sport_type')
            ->select('sport_welfare_registration_master.*', 'direct_recruitment.category as catt', 'direct_recruitment.religion as religiii', 'direct_recruitment.*', 'sport_type.name as sport_name')
            ->where('direct_recruitment.application_no', $id)->get();
        $userID = $details[0]->user_id;
        $post = DB::table('applicant_post_master')
            ->where('application_no', $id)
            ->where('user_id',  $userID)
            ->get();

        $rsoId  = Auth::guard('admin')->user()->id;


        if (Auth::guard('admin')->user()->admin_role == 3) {
            $comment_data = DB::table('mark_query_comment')
                ->where('application_no', $id);

            $comment_data->where(function ($query) {
                $query->where('sender_id', Auth::guard('admin')->user()->id)
                    ->orWhere('reciever_id', Auth::guard('admin')->user()->id);
            });

            $comment_data = $comment_data->orderBy('id', 'ASC')->get();
        } else {

            $comment_data = DB::table('mark_query_comment')->where('application_no', $id)->orderBy('id', 'ASC')->get();
        }

        $queryData = DB::table('query_master')->where('form_type', 6)->where('application_no', $id)->orderBy('id', 'ASC')->get();
        // $queryData = DB::table('query_master')->where('form_type', 6)->where('user_id', $id)->where('rso_id', $rsoId)->orderBy('id', 'ASC')->get();
        // dd($queryData);
        $query_s = DB::table('query_master')->where('form_type', 6)->where('application_no', $id)->where('is_closed', 0)->count();
        $sportAchievement = DB::table('direct_recruitment_sport_achievement')->where('application_no', $id)->get();

        return view('rso.dashboard.direct_rect_view', compact('sportAchievement', 'details', 'post', 'queryData', 'id', 'query_s', 'comment_data'));
    }

    public function direct_rect_spe(Request $request)
    {
        $seg = $request->segment(3);
        $seg4 = $request->segment(4);


        if ($seg == 3) {
            $details = DB::table('direct_recruitment')
                ->join('sport_welfare_registration_master', 'sport_welfare_registration_master.id', '=', 'direct_recruitment.user_id')
                ->join('sport_type', 'sport_type.id', '=', 'sport_welfare_registration_master.sport_type')
                ->select('direct_recruitment.*', 'sport_type.name as sportName')
                ->where('direct_recruitment.final_submit', '=', 1);
            if (Auth::guard('admin')->user()->admin_role == 3) {
                $details->where('direct_recruitment.is_forwarded_by_rso', '>=', 4);
            } elseif (Auth::guard('admin')->user()->admin_role == 8) {
                $details->where('direct_recruitment.is_forwarded_by_rso', '>=', 2);
            } elseif (Auth::guard('admin')->user()->admin_role == 11) {
                $details->where('direct_recruitment.is_forwarded_by_rso', '>=', 1);
            } elseif (Auth::guard('admin')->user()->admin_role == 1) {
                $details->where('direct_recruitment.is_forwarded_by_rso', '>=', 3);
            }
            $details = $details->get();
        } else {
            $details = DB::table('direct_recruitment')
                ->join('sport_welfare_registration_master', 'sport_welfare_registration_master.id', '=', 'direct_recruitment.user_id')
                ->join('sport_type', 'sport_type.id', '=', 'sport_welfare_registration_master.sport_type')
                ->select('direct_recruitment.*', 'sport_type.name as sportName')
                ->where('direct_recruitment.final_submit', '=', 1)
                ->where('direct_recruitment.form_status', '=', $seg);
            if (Auth::guard('admin')->user()->admin_role == 3) {
                $details->where('direct_recruitment.is_forwarded_by_rso', '>=', 4);
            } elseif (Auth::guard('admin')->user()->admin_role == 8) {
                $details->where('direct_recruitment.is_forwarded_by_rso', '>=', 2);
            } elseif (Auth::guard('admin')->user()->admin_role == 11) {
                $details->where('direct_recruitment.is_forwarded_by_rso', '>=', 1);
            } elseif (Auth::guard('admin')->user()->admin_role == 1) {
                $details->where('direct_recruitment.is_forwarded_by_rso', '>=', 3);
            }
            $details = $details->get();
        }
        $cities = DB::table('cities')->where('state_id', 23)->orderBy('city', 'ASC')->get();
        $sports = DB::table('sport_type')->orderBy('name', 'ASC')->get();
        $sport_event = DB::table('sports_event_master')->select('event_name as name', 'id')->get();
        $post_master = DB::table('advertisment_post_master')->select('post_name as name', 'id')->get();
        return view('rso.dashboard.direct_rect', compact('details', 'seg', 'seg4', 'cities', 'sports', 'sport_event', 'post_master'));
    }

    public function financial_assis()
    {
        $seg = 4;
        $financial = DB::table('financial_assistance')
            ->join('sport_welfare_registration_master', 'sport_welfare_registration_master.id', '=', 'financial_assistance.user_id')
            ->join('sport_type', 'sport_type.id', '=', 'financial_assistance.sport_type')
            ->select('financial_assistance.*', 'sport_welfare_registration_master.fullname', 'sport_welfare_registration_master.email', 'sport_type.name as sportName')
            ->where('financial_assistance.final_submit', '=', 1)
            ->get();
        $cities = DB::table('cities')->where('state_id', 23)->orderBy('city', 'ASC')->get();
        $sports = DB::table('sport_type')->orderBy('name', 'ASC')->get();

        // $monthly = DB::table('monthly_pension')
        //     ->join('sport_welfare_registration_master', 'sport_welfare_registration_master.id', '=', 'monthly_pension.user_id')
        //     ->join('sport_type', 'sport_type.id', '=', 'monthly_pension.sport_type')
        //     ->select('monthly_pension.*', 'sport_welfare_registration_master.fullname', 'sport_welfare_registration_master.email', 'sport_type.name as sportName')
        //     ->get();

        return view('rso.dashboard.financial_assis', compact('financial', 'cities', 'sports', 'seg'));
    }

    public function financial_assis_spe(Request $request)
    {
        $seg = $request->segment(3);
        if ($seg == 3) {
            $financial = DB::table('financial_assistance')
                ->join('sport_welfare_registration_master', 'sport_welfare_registration_master.id', '=', 'financial_assistance.user_id')
                ->join('sport_type', 'sport_type.id', '=', 'financial_assistance.sport_type')
                ->select('financial_assistance.*', 'sport_welfare_registration_master.fullname', 'sport_welfare_registration_master.email', 'sport_type.name as sportName')
                ->where('financial_assistance.final_submit', '=', 1)
                ->where('financial_assistance.is_forwarded_by_rso', '=', 1)
                ->get();
        } else {
            $financial = DB::table('financial_assistance')
                ->join('sport_welfare_registration_master', 'sport_welfare_registration_master.id', '=', 'financial_assistance.user_id')
                ->join('sport_type', 'sport_type.id', '=', 'financial_assistance.sport_type')
                ->select('financial_assistance.*', 'sport_welfare_registration_master.fullname', 'sport_welfare_registration_master.email', 'sport_type.name as sportName')
                ->where('financial_assistance.final_submit', '=', 1)
                ->where('financial_assistance.form_status', '=', $seg)
                ->get();
        }
        $cities = DB::table('cities')->where('state_id', 23)->orderBy('city', 'ASC')->get();
        $sports = DB::table('sport_type')->orderBy('name', 'ASC')->get();
        return view('rso.dashboard.financial_assis', compact('financial', 'cities', 'sports', 'seg'));
    }

    public function financial_assis_view_bkp(Request $request)
    {
        $seg = $request->segment(3);
        $details = DB::table('financial_assistance')
            ->join('sport_welfare_registration_master', 'sport_welfare_registration_master.id', '=', 'financial_assistance.user_id')
            ->join('sport_type', 'sport_type.id', '=', 'financial_assistance.sport_type')
            ->join('states', 'states.id', '=', 'sport_welfare_registration_master.permanent_state')
            ->join('cities', 'cities.id', '=', 'sport_welfare_registration_master.permanent_district')
            ->select('financial_assistance.*', 'sport_welfare_registration_master.*', 'sport_welfare_registration_master.email', 'sport_type.name as sportName', 'states.name as stateName', 'cities.city as cityName')
            ->where('financial_assistance.id', '=', $seg)->get();

        $present_data = DB::table('financial_assistance')
            ->join('sport_welfare_registration_master', 'sport_welfare_registration_master.id', '=', 'financial_assistance.user_id')
            ->join('sport_type', 'sport_type.id', '=', 'financial_assistance.sport_type')
            ->join('states', 'states.id', '=', 'sport_welfare_registration_master.present_state')
            ->join('cities', 'cities.id', '=', 'sport_welfare_registration_master.present_district')
            ->select('financial_assistance.*', 'sport_welfare_registration_master.*', 'sport_welfare_registration_master.email', 'sport_type.name as sportName', 'states.name as stateNameCur', 'cities.city as cityNameCur')
            ->where('financial_assistance.id', '=', $seg)->get();

        //dd($details);
        return view('rso.dashboard.financial_assis_view', compact('details', 'present_data'));
    }

    public function financial_assis_view($id)
    {

        $articles = DB::table('sport_welfare_registration_master as swrm')
            ->join('financial_assistance as la', 'swrm.id', '=', 'la.user_id')
            ->join('sport_type as st', 'la.sport_type', '=', 'st.id')
            ->select(
                'swrm.fullname',
                'swrm.email',
                'swrm.mobile',
                'swrm.gender',
                'la.user_id',
                'st.name as sport_name',
                'swrm.place_of_birth',
                'swrm.dob',
                'swrm.nationality',
                'la.qualification',
                'la.qualification_doc',
                'la.domicile_certificate',
                'la.monthly_income_personal',
                'la.income_certificate',
                'la.dmc_income_verification',
                'la.level_of_report',
                'la.relevant_certificate',
                'la.other_achievements',
                'la.document_other_achievements',
                'la.document_justifying_achievements',
                'la.total_professional_experience',
                'la.experience_sports_association',
                'la.document_justifying_experience',
                'la.income_other_sources',
                'la.income_document_other_sources',
                'la.details_of_assistance_benefits',
                'la.relevant_documents_justifing_assistance',
                'la.physical_condition',
                'la.medical_certificate',
                'la.dope_test',
                'la.court_case',
                'la.final_submit',
                'la.guardian_signature',
                'la.bank_name',
                'la.bank_branch',
                'la.bank_acc_no',
                'la.bank_ifsc',
                'la.acc_holder_name',
                'la.pan',
                'la.mobile_registered_in_bank',
                'la.other_relevant_information_applicant',
                'la.created_at',

                // 'la.sport_position',
                'la.is_forwarded_by_association',
                'la.forward_verification_document',
                'la.forward_remark',
                'la.query_remark_by_admin',
                'la.query_doc_by_admin',
                'la.application_no',
                'la.form_status',
                'swrm.signature_doc',
                'swrm.photograph_doc',
                'swrm.marital_status',
                'swrm.religion',
                'swrm.aadhar_no',
                'swrm.father_name',
                'swrm.mother_name',
                'swrm.present_address',
                'swrm.present_state',
                'swrm.present_district',
                'swrm.present_pincode',
                'swrm.permanent_address',
                'swrm.permanent_state',
                'swrm.permanent_district',
                'swrm.association_certificate',
                'swrm.association_certificate_upload',
                'swrm.permanent_pincode',
                'swrm.present_flat_no',
                'swrm.permanent_flat_no'
            )
            // ->where('swrm.id', $id)
            ->where('la.application_no', $id)
            ->get();

        $sport_achievement = DB::table('sport_achievement_master')
            ->select('*')
            ->where('application_no', $id)
            ->where('award_id', 4)
            ->get();
        $user = User::where('id', $id)->first();
        $rsoId  = Auth::guard('admin')->user()->id;
        $queryData = DB::table('query_master')->where('form_type', 4)->where('application_no', $id)->orderBy('id', 'DESC')->get();
        // $queryData = DB::table('query_master')->where('form_type', 4)->where('user_id', $id)->where('rso_id', $rsoId)->orderBy('id', 'DESC')->get();
        $query_s = DB::table('query_master')->where('form_type', 4)->where('application_no', $id)->where('is_closed', 0)->count();

        if ($rsoId == 1) {
            $comment_data = DB::table('mark_query_comment')->where('application_no', $id)->orderBy('id', 'ASC')->get();
        } else {
            $comment_data = DB::table('mark_query_comment')
                ->where('application_no', $id);

            $comment_data->where(function ($query) {
                $query->where('sender_id', Auth::guard('admin')->user()->id)
                    ->orWhere('reciever_id', Auth::guard('admin')->user()->id);
            });

            $comment_data = $comment_data->orderBy('id', 'ASC')->get();
        }
        return view('rso.dashboard.financial_assis_view', compact('query_s', 'user', 'articles', 'sport_achievement', 'queryData', 'id', 'comment_data'));
    }

    public function monthly_pension()
    {
        // $financial = DB::table('financial_assistance')
        //     ->join('sport_welfare_registration_master', 'sport_welfare_registration_master.id', '=', 'financial_assistance.user_id')
        //     ->join('sport_type', 'sport_type.id', '=', 'financial_assistance.sport_type')
        //     ->select('financial_assistance.*', 'sport_welfare_registration_master.fullname', 'sport_welfare_registration_master.email', 'sport_type.name as sportName')
        //     ->get();
        $seg = 4;
        $monthly = DB::table('monthly_pension')
            ->join('sport_welfare_registration_master', 'sport_welfare_registration_master.id', '=', 'monthly_pension.user_id')
            ->join('sport_type', 'sport_type.id', '=', 'monthly_pension.sport_type')
            ->select('monthly_pension.*', 'sport_welfare_registration_master.fullname', 'sport_welfare_registration_master.email', 'sport_type.name as sportName')
            ->where('monthly_pension.final_submit', '=', 1)
            ->get();
        $cities = DB::table('cities')->where('state_id', 23)->orderBy('city', 'ASC')->get();
        $sports = DB::table('sport_type')->orderBy('name', 'ASC')->get();
        return view('rso.dashboard.monthly_pension', compact('monthly', 'cities', 'sports', 'seg'));
    }

    public function monthly_pension_spe(Request $request)
    {
        $seg = $request->segment(3);
        if ($seg == 3) {
            $monthly = DB::table('monthly_pension')
                ->join('sport_welfare_registration_master', 'sport_welfare_registration_master.id', '=', 'monthly_pension.user_id')
                ->join('sport_type', 'sport_type.id', '=', 'monthly_pension.sport_type')
                ->select('monthly_pension.*', 'sport_welfare_registration_master.fullname', 'sport_welfare_registration_master.email', 'sport_type.name as sportName')
                ->where('monthly_pension.final_submit', '=', 1)
                ->where('monthly_pension.is_forwarded_by_rso', '=', 1)
                ->get();
        } else {
            $monthly = DB::table('monthly_pension')
                ->join('sport_welfare_registration_master', 'sport_welfare_registration_master.id', '=', 'monthly_pension.user_id')
                ->join('sport_type', 'sport_type.id', '=', 'monthly_pension.sport_type')
                ->select('monthly_pension.*', 'sport_welfare_registration_master.fullname', 'sport_welfare_registration_master.email', 'sport_type.name as sportName')
                ->where('monthly_pension.final_submit', '=', 1)
                ->where('monthly_pension.form_status', '=', $seg)
                ->get();
        }
        $cities = DB::table('cities')->where('state_id', 23)->orderBy('city', 'ASC')->get();
        $sports = DB::table('sport_type')->orderBy('name', 'ASC')->get();
        return view('rso.dashboard.monthly_pension', compact('monthly', 'cities', 'sports', 'seg'));
    }

    public function monthly_pension_view($id)
    {
        $seg = 4;
        $articles = DB::table('sport_welfare_registration_master as swrm')
            ->join('monthly_pension as la', 'swrm.id', '=', 'la.user_id')
            ->join('sport_type as st', 'la.sport_type', '=', 'st.id')
            ->select(
                'swrm.fullname',
                'swrm.email',
                'swrm.mobile',
                'swrm.gender',
                'swrm.association_certificate',
                'swrm.association_certificate_upload',
                'st.name as sport_name',
                'swrm.place_of_birth',
                'swrm.dob',
                'swrm.nationality',
                'la.forward_verification_document',
                'la.query_remark_by_admin',
                'la.query_doc_by_admin',
                'la.is_forwarded_by_association',
                'la.forward_remark',
                'la.application_no',
                'la.form_status',
                'la.user_id',
                'la.award_year',
                'la.award_certificate',
                'la.honoured_award',
                'la.bank_name',
                'la.bank_branch',
                'la.bank_acc_no',
                'la.bank_ifsc',
                'la.acc_holder_name',
                'la.pan',
                'la.mobile_registered_in_bank',
                'la.other_relevant_information_applicant',
                'la.created_at',
                'la.final_submit',
                'swrm.signature_doc',
                'swrm.photograph_doc',
                'swrm.marital_status',
                'swrm.religion',
                'swrm.aadhar_no',
                'swrm.father_name',
                'swrm.mother_name',
                'swrm.present_address',
                'swrm.present_state',
                'swrm.present_district',
                'swrm.present_pincode',
                'swrm.permanent_address',
                'swrm.permanent_state',
                'swrm.permanent_district',
                'swrm.permanent_pincode',
                'swrm.present_flat_no',
                'swrm.permanent_flat_no'
            )
            ->where('la.application_no', $id)
            ->get();
        // dd($articles);
        $sport_achievement = DB::table('sport_achievement_master')
            ->select('*')
            ->where('user_id', $id)
            ->where('award_id', 5)
            ->get();
        $user = User::where('id', $id)->first();
        $rsoId  = Auth::guard('admin')->user()->id;
        $queryData = DB::table('query_master')->where('form_type', 5)->where('application_no', $id)->orderBy('id', 'DESC')->get();
        // $queryData = DB::table('query_master')->where('form_type', 5)->where('user_id', $id)->where('rso_id', $rsoId)->orderBy('id', 'DESC')->get();
        $query_s = DB::table('query_master')->where('form_type', 5)->where('application_no', $id)->where('is_closed', 0)->count();
        if ($rsoId == 1) {
            $comment_data = DB::table('mark_query_comment')->where('application_no', $id)->orderBy('id', 'ASC')->get();
        } else {
            $comment_data = DB::table('mark_query_comment')
                ->where('application_no', $id);

            $comment_data->where(function ($query) {
                $query->where('sender_id', Auth::guard('admin')->user()->id)
                    ->orWhere('reciever_id', Auth::guard('admin')->user()->id);
            });

            $comment_data = $comment_data->orderBy('id', 'ASC')->get();
        }
        return view('rso.dashboard.monthly_pension_view', compact('query_s', 'user', 'articles', 'sport_achievement', 'queryData', 'id', 'seg', 'comment_data'));
    }
    public function laxman()
    {
        $seg = 4;
        $details = DB::table('laxman_award')
            ->join('sport_welfare_registration_master', 'sport_welfare_registration_master.id', '=', 'laxman_award.user_id')
            ->join('sport_type', 'sport_type.id', '=', 'laxman_award.sport_type')
            ->select('laxman_award.*', 'sport_welfare_registration_master.fullname', 'sport_welfare_registration_master.email', 'sport_type.name as sportName')
            ->where('laxman_award.final_submit', '=', 1)
            ->get();
        $cities = DB::table('cities')->where('state_id', 23)->orderBy('city', 'ASC')->get();
        $sports = DB::table('sport_type')->orderBy('name', 'ASC')->get();

        return view('rso.dashboard.laxman', compact('details', 'cities', 'sports', 'seg'));
    }

    public function laxman_spe(Request $request)
    {
        $seg = $request->segment(3);
        if ($seg == 3) {
            $details = DB::table('laxman_award')
                ->join('sport_welfare_registration_master', 'sport_welfare_registration_master.id', '=', 'laxman_award.user_id')
                ->join('sport_type', 'sport_type.id', '=', 'laxman_award.sport_type')
                ->select('laxman_award.*', 'sport_welfare_registration_master.fullname', 'sport_welfare_registration_master.email', 'sport_type.name as sportName')
                ->where('laxman_award.final_submit', '=', 1)
                ->where('laxman_award.is_forwarded_by_rso', '=', 1)
                ->get();
        } else {
            $details = DB::table('laxman_award')
                ->join('sport_welfare_registration_master', 'sport_welfare_registration_master.id', '=', 'laxman_award.user_id')
                ->join('sport_type', 'sport_type.id', '=', 'laxman_award.sport_type')
                ->select('laxman_award.*', 'sport_welfare_registration_master.fullname', 'sport_welfare_registration_master.email', 'sport_type.name as sportName')
                ->where('laxman_award.final_submit', '=', 1)
                ->where('laxman_award.form_status', '=', $seg)
                ->get();
        }
        $cities = DB::table('cities')->where('state_id', 23)->orderBy('city', 'ASC')->get();
        $sports = DB::table('sport_type')->orderBy('name', 'ASC')->get();
        return view('rso.dashboard.laxman', compact('details', 'cities', 'sports', 'seg'));
    }

    public function laxman_view($id)
    {
        $articles = DB::table('sport_welfare_registration_master as swrm')
            ->join('laxman_award as la', 'swrm.id', '=', 'la.user_id')
            ->join('sport_type as st', 'la.sport_type', '=', 'st.id')
            ->select(
                'swrm.fullname',
                'swrm.email',
                'swrm.mobile',
                'swrm.gender',
                'swrm.is_phy_handicapped',
                'swrm.phy_handi_docs',
                'swrm.sport_type',
                'swrm.para_sport',
                'la.user_id',
                'st.name as sport_name',
                'swrm.place_of_birth',
                'swrm.dob',
                'swrm.nationality',
                'la.qualification',
                'la.amount_release_status',
                'la.amount_release',
                'la.qualification_doc',
                'la.domicile_certificate',
                'la.monthly_income_personal',
                'la.income_certificate',
                'la.dmc_income_verification',
                'la.level_of_report',
                'la.relevant_certificate',
                'la.other_achievements',
                'la.highschool_certificate',
                'la.document_other_achievements',
                'la.document_justifying_achievements',
                'la.total_professional_experience',
                'la.experience_sports_association',
                'la.document_justifying_experience',
                'la.income_other_sources',
                'la.income_document_other_sources',
                'la.details_of_assistance_benefits',
                'la.relevant_documents_justifing_assistance',
                'la.physical_condition',
                'la.medical_certificate',
                'la.notary_affidavit_doc',
                'la.player_type',
                'la.dope_test',
                'la.court_case',
                'la.final_submit',
                'la.guardian_signature',
                'la.bank_name',
                'la.bank_branch',
                'la.bank_acc_no',
                'la.bank_ifsc',
                'la.acc_holder_name',
                'la.pan',
                'la.mobile_registered_in_bank',
                'la.other_relevant_information_applicant',
                'la.created_at',
                // 'la.sport_position',

                'la.is_forwarded_by_association',
                'la.application_no',
                'la.forward_verification_document',
                'la.forward_remark',
                'la.query_remark_by_admin',
                'la.query_doc_by_admin',
                'la.form_status',
                'swrm.signature_doc',
                'swrm.photograph_doc',
                'swrm.marital_status',
                'swrm.religion',
                'swrm.aadhar_no',
                'swrm.father_name',
                'swrm.mother_name',
                'swrm.present_address',
                'swrm.present_state',
                'swrm.present_district',
                'swrm.present_pincode',
                'swrm.permanent_address',
                'swrm.permanent_state',
                'swrm.permanent_district',
                'swrm.permanent_pincode',
                'swrm.present_flat_no',
                'swrm.permanent_flat_no'
            )
            ->where('la.application_no', $id)
            ->get();
        $sport_achievement = DB::table('sport_achievement_master')
            ->join('sport_competition_level_master as sclm', 'sport_achievement_master.sport_achievement', '=', 'sclm.id')

            ->select('*')
            ->where('application_no', $id)
            ->where('award_id', 1)
            ->get();
        $other_achievement = DB::table('other_achievement_master')
            ->select('*')
            ->where('application_no', $id)
            ->where('award_id', 1)
            ->get();
        // dd($sport_achievement);
        $user = User::where('id', $id)->first();
        $rsoId  = Auth::guard('admin')->user()->admin_role;
        // dd($rsoId);
        // $queryData = DB::table('query_master')->where('form_type', 1)->where('application_no', $id)->where('rso_id', $rsoId)->orderBy('id', 'DESC')->get();
        $queryData = DB::table('query_master')->where('form_type', 1)->where('application_no', $id)->orderBy('id', 'DESC')->get();
        $query_s = DB::table('query_master')->where('form_type', 1)->where('application_no', $id)->where('is_closed', 0)->count();
        // dd($queryData);
        if ($rsoId == 1) {
            $comment_data = DB::table('mark_query_comment')->where('application_no', $id)->orderBy('id', 'ASC')->get();
        } else {
            $comment_data = DB::table('mark_query_comment')
                ->where('application_no', $id);

            $comment_data->where(function ($query) {
                $query->where('sender_id', Auth::guard('admin')->user()->id)
                    ->orWhere('reciever_id', Auth::guard('admin')->user()->id);
            });

            $comment_data = $comment_data->orderBy('id', 'ASC')->get();
        }
        return view('rso.dashboard.laxman_view', compact('sport_achievement', 'other_achievement', 'user', 'articles', 'queryData', 'id', 'query_s', 'comment_data'));
    }
    public function laxmibai_view($id)
    {
        $articles = DB::table('sport_welfare_registration_master as swrm')
            ->join('ranilaxmibai_award as la', 'swrm.id', '=', 'la.user_id')
            ->join('sport_type as st', 'la.sport_type', '=', 'st.id')
            ->select(
                'swrm.fullname',
                'swrm.email',
                'swrm.mobile',
                'swrm.gender',
                'swrm.is_phy_handicapped',
                'swrm.phy_handi_docs',
                'swrm.sport_type',
                'swrm.para_sport',

                'la.user_id',
                'st.name as sport_name',
                'swrm.place_of_birth',
                'swrm.dob',
                'swrm.nationality',
                'la.qualification',
                'la.amount_release_status',
                'la.amount_release',

                'la.qualification_doc',
                'la.domicile_certificate',
                'la.monthly_income_personal',
                'la.income_certificate',
                'la.dmc_income_verification',
                'la.level_of_report',
                'la.relevant_certificate',
                'la.is_forwarded_by_association',
                'la.other_achievements',
                'la.highschool_certificate',
                'la.document_other_achievements',
                'la.document_justifying_achievements',
                'la.total_professional_experience',
                'la.experience_sports_association',
                'la.document_justifying_experience',
                'la.income_other_sources',
                'la.income_document_other_sources',
                'la.details_of_assistance_benefits',
                'la.relevant_documents_justifing_assistance',
                'la.physical_condition',
                'la.medical_certificate',
                'la.notary_affidavit_doc',
                'la.player_type',
                'la.dope_test',
                'la.court_case',
                'la.final_submit',
                'la.guardian_signature',
                'la.bank_name',
                'la.bank_branch',
                'la.bank_acc_no',
                'la.bank_ifsc',
                'la.acc_holder_name',
                'la.pan',
                'la.mobile_registered_in_bank',
                'la.other_relevant_information_applicant',
                'la.created_at',
                'la.forward_verification_document',
                'la.forward_remark',
                'la.query_remark_by_admin',
                'la.query_doc_by_admin',
                // 'la.sport_position',
                'la.application_no',
                'la.form_status',
                'swrm.signature_doc',
                'swrm.photograph_doc',
                'swrm.marital_status',
                'swrm.religion',
                'swrm.aadhar_no',
                'swrm.father_name',
                'swrm.mother_name',
                'swrm.present_address',
                'swrm.present_state',
                'swrm.present_district',
                'swrm.present_pincode',
                'swrm.permanent_address',
                'swrm.permanent_state',
                'swrm.permanent_district',
                'swrm.association_certificate',
                'swrm.association_certificate_upload',
                'swrm.permanent_pincode',
                'swrm.present_flat_no',
                'swrm.permanent_flat_no'
            )
            ->where('la.application_no', $id)
            ->get();
        $sport_achievement = DB::table('sport_achievement_master')
            ->join('sport_competition_level_master as sclm', 'sport_achievement_master.sport_achievement', '=', 'sclm.id')

            ->select('*')
            ->where('application_no', $id)
            ->where('award_id', 2)
            ->get();
        $other_achievement = DB::table('other_achievement_master')
            ->select('*')
            ->where('application_no', $id)
            ->where('award_id', 2)
            ->get();
        $user = User::where('id', $id)->first();
        $rsoId  = Auth::guard('admin')->user()->id;
        if ($rsoId == 1) {
            $comment_data = DB::table('mark_query_comment')->where('application_no', $id)->orderBy('id', 'ASC')->get();
        } else {
            $comment_data = DB::table('mark_query_comment')
                ->where('application_no', $id);

            $comment_data->where(function ($query) {
                $query->where('sender_id', Auth::guard('admin')->user()->id)
                    ->orWhere('reciever_id', Auth::guard('admin')->user()->id);
            });

            $comment_data = $comment_data->orderBy('id', 'ASC')->get();
        }


        // $queryData = DB::table('query_master')->where('form_type', 2)->where('application_no', $id)->where('rso_id', $rsoId)->orderBy('id', 'DESC')->get();
        $queryData = DB::table('query_master')->where('form_type', 2)->where('application_no', $id)->orderBy('id', 'DESC')->get();
        $query_s = DB::table('query_master')->where('form_type', 2)->where('application_no', $id)->where('is_closed', 0)->count();

        return view('rso.dashboard.laxmibai_view', compact('sport_achievement', 'other_achievement', 'user', 'articles', 'queryData', 'id', 'query_s', 'comment_data'));
    }
    public function laxmibai()
    {
        $seg = 4;
        $details = DB::table('ranilaxmibai_award')
            ->join('sport_welfare_registration_master', 'sport_welfare_registration_master.id', '=', 'ranilaxmibai_award.user_id')
            ->join('sport_type', 'sport_type.id', '=', 'ranilaxmibai_award.sport_type')
            ->select('ranilaxmibai_award.*', 'sport_welfare_registration_master.fullname', 'sport_welfare_registration_master.email', 'sport_type.name as sportName')
            ->where('ranilaxmibai_award.final_submit', '=', 1)
            ->get();
        $cities = DB::table('cities')->where('state_id', 23)->orderBy('city', 'ASC')->get();
        $sports = DB::table('sport_type')->orderBy('name', 'ASC')->get();
        return view('rso.dashboard.laxmibai', compact('details', 'cities', 'sports', 'seg'));
    }
    public function laxmibai_spe(Request $request)
    {
        $seg = $request->segment(3);
        if ($seg == 3) {
            $details = DB::table('ranilaxmibai_award')
                ->join('sport_welfare_registration_master', 'sport_welfare_registration_master.id', '=', 'ranilaxmibai_award.user_id')
                ->join('sport_type', 'sport_type.id', '=', 'ranilaxmibai_award.sport_type')
                ->select('ranilaxmibai_award.*', 'sport_welfare_registration_master.fullname', 'sport_welfare_registration_master.email', 'sport_type.name as sportName')
                ->where('ranilaxmibai_award.final_submit', '=', 1)
                ->where('ranilaxmibai_award.is_forwarded_by_rso', '=', 1)
                ->get();
        } else {
            $details = DB::table('ranilaxmibai_award')
                ->join('sport_welfare_registration_master', 'sport_welfare_registration_master.id', '=', 'ranilaxmibai_award.user_id')
                ->join('sport_type', 'sport_type.id', '=', 'ranilaxmibai_award.sport_type')
                ->select('ranilaxmibai_award.*', 'sport_welfare_registration_master.fullname', 'sport_welfare_registration_master.email', 'sport_type.name as sportName')
                ->where('ranilaxmibai_award.final_submit', '=', 1)
                ->where('ranilaxmibai_award.form_status', '=', $seg)
                ->get();
        }
        $cities = DB::table('cities')->where('state_id', 23)->orderBy('city', 'ASC')->get();
        $sports = DB::table('sport_type')->orderBy('name', 'ASC')->get();
        return view('rso.dashboard.laxmibai', compact('details', 'cities', 'sports', 'seg'));
    }


    public function award()
    {
        $seg = 4;
        if (Auth::guard('admin')->user()->admin_role == 2) {
            $cond = 1;
            $details = DB::table('position_holder')
                ->join('sport_welfare_registration_master', 'sport_welfare_registration_master.id', '=', 'position_holder.user_id')
                ->join('sport_type', 'sport_type.id', '=', 'position_holder.sport_type')
                ->select('position_holder.*', 'sport_welfare_registration_master.fullname', 'sport_welfare_registration_master.email', 'sport_type.name as sportName')
                ->where('position_holder.final_submit', '=', 1)
                ->where('position_holder.is_forwarded_by_association', 1)
                ->get();
        } else {
            $details = DB::table('position_holder')
                ->join('sport_welfare_registration_master', 'sport_welfare_registration_master.id', '=', 'position_holder.user_id')
                ->join('sport_type', 'sport_type.id', '=', 'position_holder.sport_type')
                ->select('position_holder.*', 'sport_welfare_registration_master.fullname', 'sport_welfare_registration_master.email', 'sport_type.name as sportName')
                ->where('position_holder.final_submit', '=', 1)
                ->get();
        }

        //dd($details);
        $cities = DB::table('cities')->where('state_id', 23)->orderBy('city', 'ASC')->get();
        $sports = DB::table('sport_type')->orderBy('name', 'ASC')->get();
        return view('rso.dashboard.award', compact('details', 'cities', 'sports', 'seg'));
    }

    public function award_spe(Request $request)
    {
        $seg = $request->segment(3);
        if ($seg == 3) {
            $details = DB::table('position_holder')
                ->join('sport_welfare_registration_master', 'sport_welfare_registration_master.id', '=', 'position_holder.user_id')
                ->join('sport_type', 'sport_type.id', '=', 'position_holder.sport_type')
                ->select('position_holder.*', 'sport_welfare_registration_master.fullname', 'sport_welfare_registration_master.email', 'sport_type.name as sportName')
                ->where('position_holder.final_submit', '=', 1)
                ->where('position_holder.is_forwarded_by_rso', '=', 1)
                ->get();
        } else {
            $details = DB::table('position_holder')
                ->join('sport_welfare_registration_master', 'sport_welfare_registration_master.id', '=', 'position_holder.user_id')
                ->join('sport_type', 'sport_type.id', '=', 'position_holder.sport_type')
                ->select('position_holder.*', 'sport_welfare_registration_master.fullname', 'sport_welfare_registration_master.email', 'sport_type.name as sportName')
                ->where('position_holder.final_submit', '=', 1)
                ->where('position_holder.form_status', '=', $seg)
                ->get();
        }
        $cities = DB::table('cities')->where('state_id', 23)->orderBy('city', 'ASC')->get();
        $sports = DB::table('sport_type')->orderBy('name', 'ASC')->get();
        return view('rso.dashboard.award', compact('details', 'cities', 'sports', 'seg'));
    }

    public function award_view($id)
    {
        $articles = DB::table('sport_welfare_registration_master as swrm')
            ->join('position_holder as la', 'swrm.id', '=', 'la.user_id')
            ->join('sport_type as st', 'la.sport_type', '=', 'st.id')
            ->select(
                'swrm.fullname',
                'swrm.email',
                'swrm.mobile',
                'swrm.gender',
                'swrm.association_certificate',
                'swrm.association_certificate_upload',
                'st.name as sport_name',
                'swrm.place_of_birth',
                'swrm.dob',
                'swrm.nationality',
                'la.query_remark_by_rso',
                'la.query_doc_by_rso',
                'la.form_status',
                'la.user_id',
                'la.award_certificate_affidavit',
                'la.event_type',
                'la.qualification',
                'la.qualification_doc',
                'la.domicile_certificate',
                'la.bank_name',
                'la.bank_branch',
                'la.bank_acc_no',
                'la.bank_ifsc',
                'la.acc_holder_name',
                'la.mobile_registered_in_bank',
                'la.created_at',
                'la.competition_type',
                'la.is_forwarded_by_rso',
                'la.is_forwarded_by_association',
                'la.query_doc_by_admin',
                'la.query_remark_by_admin',
                'la.forward_remark',
                'la.forward_verification_document',
                'la.forward_remark_for_rso',
                'la.forward_verification_document_for_rso',
                'la.application_no',
                'la.final_submit',
                'la.competition_name',
                'la.venue_name',
                'la.competition_from_date',
                'la.competition_to_date',
                'la.earned_achievement',
                'la.award_certificate',
                'la.pan_doc',
                'la.sport_certificate',
                'la.passbook_doc',
                'swrm.signature_doc',
                'swrm.photograph_doc',
                'swrm.marital_status',
                'swrm.religion',
                'swrm.aadhar_no',
                'swrm.father_name',
                'swrm.mother_name',
                'swrm.present_address',
                'swrm.present_state',
                'swrm.present_district',
                'swrm.present_pincode',
                'swrm.permanent_address',
                'swrm.permanent_state',
                'swrm.permanent_district',
                'swrm.permanent_pincode',
                'swrm.present_flat_no',
                'swrm.permanent_flat_no'
            )

            ->where('la.application_no', $id)
            ->get();
        // $competition_award_docs = DB::table('position_holder_competition_docs')
        // ->select('*')
        // ->where('application_no', $id)
        // ->get();
        $competition_award_docs = DB::table('position_holder_competition_docs as phcd')
            ->join('position_event_master as pem', 'phcd.event_name', '=', 'pem.id')
            ->join('position_competition_master as pcm', 'phcd.competition_name', '=', 'pcm.id')
            ->select('phcd.*', 'pcm.name as comp', 'pem.name as event')
            ->where('phcd.application_no', $id)
            // ->where('phcd.user_id', Auth::id())
            ->get();

        $user = User::where('id', $id)->first();
        $rsoId  = Auth::guard('admin')->user()->id;

        if ($rsoId == 1) {
            $comment_data = DB::table('mark_query_comment')->where('application_no', $id)->orderBy('id', 'ASC')->get();
        } else {
            $comment_data = DB::table('mark_query_comment')
                ->where('application_no', $id);

            $comment_data->where(function ($query) {
                $query->where('sender_id', Auth::guard('admin')->user()->id)
                    ->orWhere('reciever_id', Auth::guard('admin')->user()->id);
            });

            $comment_data = $comment_data->orderBy('id', 'ASC')->get();
        }
        // $id=$rsoId;
        $queryData = DB::table('query_master')->where('form_type', 3)->where('application_no', $id)->orderBy('id', 'DESC')->get();
        // $queryData = DB::table('query_master')->where('form_type',3)->where('application_no', $id)->where('rso_id', $rsoId)->orderBy('id', 'DESC')->get();
        $query_s = DB::table('query_master')->where('form_type', 3)->where('application_no', $id)->where('is_closed', 0)->count();

        return view('rso.dashboard.award_view', compact('competition_award_docs', 'user', 'articles', 'queryData', 'id', 'query_s', 'comment_data'));
    }

    //
    public function eklavya_krida()
    {

        $seg = 4;
        $monthly = DB::table('eklavya_krida_kosh_basic_detail')
            ->join('sport_welfare_registration_master', 'sport_welfare_registration_master.id', '=', 'eklavya_krida_kosh_basic_detail.user_id')
            ->join('sport_type as st', 'sport_welfare_registration_master.sport_type', '=', 'st.id')
            ->select('eklavya_krida_kosh_basic_detail.*', 'sport_welfare_registration_master.fullname', 'sport_welfare_registration_master.email', 'st.name as sportName')
            ->where('eklavya_krida_kosh_basic_detail.final_submit', '=', 1)
            ->get();
        $cities = DB::table('cities')->where('state_id', 23)->orderBy('city', 'ASC')->get();
        $sports = DB::table('sport_type')->orderBy('name', 'ASC')->get();
        return view('rso.dashboard.eklavya_krida', compact('monthly', 'cities', 'sports', 'seg'));
    }

    public function eklavya_krida_spe(Request $request)
    {
        $seg = $request->segment(3);
        if ($seg == 3) {

            $monthly = DB::table('eklavya_krida_kosh_basic_detail')
                ->join('sport_welfare_registration_master', 'sport_welfare_registration_master.id', '=', 'eklavya_krida_kosh_basic_detail.user_id')
                ->join('sport_type as st', 'sport_welfare_registration_master.sport_type', '=', 'st.id')
                ->select('eklavya_krida_kosh_basic_detail.*', 'sport_welfare_registration_master.fullname', 'sport_welfare_registration_master.email', 'st.name as sportName')
                ->where('eklavya_krida_kosh_basic_detail.final_submit', '=', 1)
                ->where('eklavya_krida_kosh_basic_detail.is_forwarded_by_rso', '=', 1);
        } else {
            $monthly = DB::table('eklavya_krida_kosh_basic_detail')
                ->join('sport_welfare_registration_master', 'sport_welfare_registration_master.id', '=', 'eklavya_krida_kosh_basic_detail.user_id')
                ->join('sport_type as st', 'sport_welfare_registration_master.sport_type', '=', 'st.id')
                ->select('eklavya_krida_kosh_basic_detail.*', 'sport_welfare_registration_master.fullname', 'sport_welfare_registration_master.email', 'st.name as sportName')
                ->where('eklavya_krida_kosh_basic_detail.final_submit', '=', 1)
                ->where('eklavya_krida_kosh_basic_detail.form_status', '=', $seg);
        }

        if (Auth::guard('admin')->user()->admin_role == 17) {
            $monthly->where('eklavya_krida_kosh_basic_detail.is_editable', 2);
        }
        $monthly = $monthly->get();
        //  dd($monthly);
        $cities = DB::table('cities')->where('state_id', 23)->orderBy('city', 'ASC')->get();
        $sports = DB::table('sport_type')->orderBy('name', 'ASC')->get();
        return view('rso.dashboard.eklavya_krida', compact('monthly', 'cities', 'sports', 'seg'));
    }



    public function eklavya_krida_view($id)
    {
        $seg = 4;
        $articles = DB::table('sport_welfare_registration_master as swrm')
            ->join('eklavya_krida_kosh_basic_detail as la', 'swrm.id', '=', 'la.user_id')
            ->join('sport_type as st', 'swrm.sport_type', '=', 'st.id')
            ->select(
                'swrm.fullname',
                'swrm.email',
                'swrm.mobile',
                'swrm.gender',
                'swrm.association_certificate',
                'swrm.association_certificate_upload',
                'st.name as sport_name',
                'swrm.place_of_birth',
                'swrm.dob',
                'swrm.nationality',
                'la.*',
                'swrm.signature_doc',
                'swrm.photograph_doc',
                'swrm.marital_status',
                'swrm.religion',
                'swrm.aadhar_no',
                'swrm.father_name',
                'swrm.mother_name',
                'swrm.present_address',
                'swrm.present_state',
                'swrm.present_district',
                'swrm.present_pincode',
                'swrm.permanent_address',
                'swrm.permanent_state',
                'swrm.permanent_district',
                'swrm.permanent_pincode',
                'swrm.present_flat_no',
                'swrm.permanent_flat_no'
            )

            ->where('la.application_no', $id)
            ->get();
        // $sport_achievement =DB::table('eklavya_krida_kosh_award')
        // ->select('*')
        // ->where('application_no', $id)
        // ->get();
        $sport_achievement = DB::table('eklavya_krida_kosh_award as ekka')
            ->join('position_event_master as pem', 'ekka.event_name', '=', 'pem.id')
            ->join('position_competition_master as pcm', 'ekka.competition_name', '=', 'pcm.id')
            ->select('ekka.*', 'pcm.name as comp', 'pem.name as event')
            ->where('application_no', $id)
            ->get();

        $user = User::where('id', $id)->first();
        $rsoId  = Auth::guard('admin')->user()->id;
        $queryData = DB::table('query_master')->where('form_type', 7)->where('application_no', $id)->orderBy('id', 'DESC')->get();
        // $queryData = DB::table('query_master')->where('form_type', 5)->where('user_id', $id)->where('rso_id', $rsoId)->orderBy('id', 'DESC')->get();
        $query_s = DB::table('query_master')->where('form_type', 7)->where('application_no', $id)->where('is_closed', 0)->count();
        if ($rsoId == 1 || Auth::guard('admin')->user()->admin_role == 17) {
            $comment_data = DB::table('mark_query_comment')->where('application_no', $id)->orderBy('id', 'ASC')->get();
        } else {
            $comment_data = DB::table('mark_query_comment')
                ->where('application_no', $id);

            // $comment_data->where(function ($query) {
            //     $query->where('sender_id', Auth::guard('admin')->user()->id)
            //         ->orWhere('reciever_id', Auth::guard('admin')->user()->id);
            // });

            $comment_data = $comment_data->orderBy('id', 'ASC')->get();
        }
        return view('rso.dashboard.eklavya_krida_view', compact('query_s', 'user', 'articles', 'sport_achievement', 'queryData', 'id', 'seg', 'comment_data'));
    }
    //



    // eklavya

    public function eklavya_krida_co(Request $request)
    {
        $table = "eklavya_krida_kosh_basic_detail";
        $url = "eklavya_krida_view";
        $request->status_filter = $seg = $request->segment(3);

        $latestStatusSub = DB::table('status_change_log_detail')
            ->select('user_id', DB::raw('MAX(created_at) as latest_created_at'))
            ->where('form_id', 7)->groupBy('user_id')->when(Auth::guard('admin')->user()->admin_role == 17, function ($query) {
                $query->where('new_status', 'Forward to Directorate');
            });

        $queryData = DB::table($table)
            ->join('sport_welfare_registration_master', 'sport_welfare_registration_master.id', '=', $table . '.user_id')
            ->join('sport_type', 'sport_type.id', '=', 'sport_welfare_registration_master.sport_type')
            // ->join('status_change_log_detail', 'status_change_log_detail.user_id', '=', 'sport_welfare_registration_master.id')
            ->joinSub($latestStatusSub, 'latest_status', function ($join) {
                $join->on('latest_status.user_id', '=', 'sport_welfare_registration_master.id');
            })
            ->select(
                $table . '.*',
                'sport_welfare_registration_master.fullname',
                'sport_welfare_registration_master.permanent_district',
                'sport_welfare_registration_master.email',
                'sport_type.name as sportName',
                'latest_status.latest_created_at as trail_date'
            )
            ->where($table . '.final_submit', '=', 1);


        if ($request->from_date != '') {
            if ($seg == 6) {
                $queryData->whereDate('latest_status.latest_created_at', '>=', ymd($request->from_date));
            } else {
                $queryData->whereDate($table . '.created_at', '>=', ymd($request->from_date));
            }
        }

        if ($request->to_date != '') {
            if ($seg == 6) {
                $queryData->whereDate('latest_status.latest_created_at', '<=', ymd($request->to_date));
            } else {
                $queryData->whereDate($table . '.created_at', '<=', ymd($request->to_date));
            }
        }

        if ($request->from_date != '' && $request->to_date != '') {
            if ($seg == 6) {
                $queryData->whereBetween('latest_status.latest_created_at', [ymd($request->from_date), ymd($request->to_date)]);
            } else {
                $queryData->whereBetween($table . '.created_at', [ymd($request->from_date), ymd($request->to_date)]);
            }
        }

        $title = "";
        if ($request->status_filter == 1) {
            $title = "- Asso. Forwarded";
            $queryData->where($table . '.is_forwarded_by_association', '=', 1);
        } elseif ($request->status_filter == 2) {
            $title = "- Asso. Rejected";
            $queryData->where($table . '.is_forwarded_by_association', '=', 0)
                ->where($table . '.form_status', '=', 2);
        } elseif ($request->status_filter == 3) {
            $title = "- Asso. Pending";
            $queryData->where($table . '.is_forwarded_by_association', '=', 0)
                ->where($table . '.form_status', '=', 0);
        } elseif ($request->status_filter == 4) {
            $title = "- RSO/SO Pending";
            $queryData->where($table . '.is_forwarded_by_association', '=', 1)
                ->where($table . '.is_forwarded_by_rso', '=', 0)
                ->where($table . '.form_status', '=', 0);
        } elseif ($request->status_filter == 5) {
            $title = "- RSO/SO Rejected";
            $queryData->where($table . '.is_forwarded_by_association', '=', 1)
                ->where($table . '.is_forwarded_by_rso', '=', 0)
                ->where($table . '.form_status', '=', 2);
        } elseif ($request->status_filter == 6) {
            $title = "- Admin Prize Money Pending";
            $queryData->where($table . '.is_forwarded_by_rso', '=', 1)
                ->where($table . '.form_status', '=', 0);
        } elseif ($request->status_filter == 7) {
            $title = "- Admin Prize Money Rejected";
            $queryData->where($table . '.is_forwarded_by_rso', '=', 1)
                ->where($table . '.form_status', '=', 2);
        } elseif ($request->status_filter == 8) {
            $title = "- Admin Prize Money Accepted";
            $queryData->where($table . '.is_forwarded_by_rso', '=', 1)
                ->where($table . '.form_status', '=', 1);
        }

        if ($request->sport_id != '') {
            $queryData->where('sport_welfare_registration_master.sport_type', "$request->sport_id");
        }

        if (Auth::guard('admin')->user()->admin_role == 17) {
            $queryData->where($table . '.is_editable', '=', 2);
        }
        // dd(Auth::guard('admin')->user()->admin_role);
        if ($request->city_filter != '') {
            if (Auth::guard('admin')->user()->admin_role == 4) {
                $queryData->where('direct_recruitment.permanent_district', $request->city_filter);
            } else {
                $queryData->where('sport_welfare_registration_master.permanent_district', $request->city_filter);
            }
        }
        $collection = $queryData->get();
        // dd($collection);
        $cities = DB::table('cities')->where('state_id', 23)->orderBy('city', 'ASC')->get();
        $sports = DB::table('sport_type')->orderBy('name', 'ASC')->get();
        return view('rso.dashboard.eklavya_krida_co', compact('collection', 'cities', 'sports', 'seg', 'title'));
    }

    public function eklavya_krida_co_exce(Request $request)
    {
        $sportId = $request->input('sport_id');
        $status = $request->input('status_filter');
        $district = $request->input('city_filter');
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        $table = "eklavya_krida_kosh_basic_detail";
        $url = "eklavya_krida_view";
        $name = "Eklavya Krida Kosh Applicant List";

        $latestStatusSub = DB::table('status_change_log_detail')
            ->select('user_id', DB::raw('MAX(created_at) as latest_created_at'))
            ->where('form_id', 7)->groupBy('user_id');


        $queryData = DB::table($table)
            ->join('sport_welfare_registration_master', 'sport_welfare_registration_master.id', '=', $table . '.user_id')
            ->join('sport_type', 'sport_type.id', '=', 'sport_welfare_registration_master.sport_type')
            ->joinSub($latestStatusSub, 'latest_status', function ($join) {
                $join->on('latest_status.user_id', '=', 'sport_welfare_registration_master.id');
            })
            ->select(
                $table . '.*',
                'sport_welfare_registration_master.fullname',
                'sport_welfare_registration_master.email',
                'sport_welfare_registration_master.father_name',
                'sport_welfare_registration_master.permanent_district',
                'sport_welfare_registration_master.permanent_address',
                'sport_welfare_registration_master.mobile',
                'sport_type.name as sportName',
                'latest_status.latest_created_at as trail_date'
            )
            ->where($table . '.final_submit', '=', 1);


        if ($fromDate != '') {
            if ($status == 6) {
                $queryData->whereDate('latest_status.latest_created_at', '>=', ymd($fromDate));
            } else {
                $queryData->whereDate($table . '.created_at', '>=', ymd($fromDate));
            }
            $data['from_date'] = dmy($fromDate);
        } else {
            $data['from_date'] = "01-04-2023";
        }



        if ($toDate != '') {
            if ($status == 6) {
                $queryData->whereDate('latest_status.latest_created_at', '<=', ymd($toDate));
            } else {
                $queryData->whereDate($table . '.created_at', '<=', ymd($toDate));
            }
            $data['to_date'] = dmy($toDate);
        } else {
            $data['to_date'] = date('d-m-Y');
        }

        if ($request->from_date != '' && $request->to_date != '') {
            if ($status == 6) {
                $queryData->whereBetween('latest_status.latest_created_at', [ymd($request->from_date), ymd($request->to_date)]);
            } else {
                $queryData->whereBetween($table . '.created_at', [ymd($request->from_date), ymd($request->to_date)]);
            }
        }

        if ($fromDate != '' && $toDate != '') {
            if ($status == 6) {
                $queryData->whereBetween('latest_status.latest_created_at', [ymd($fromDate), ymd($toDate)]);
            } else {
                $queryData->whereBetween($table . '.created_at', [ymd($fromDate), ymd($toDate)]);
            }
        }

        if ($status == 1) {
            $title = "Asso. Forwarded -";
            $queryData->where($table . '.is_forwarded_by_association', '=', 1);
        } elseif ($status == 2) {
            $title = "Asso. Rejected -";
            $queryData->where($table . '.is_forwarded_by_association', '=', 0)
                ->where($table . '.form_status', '=', 2);
        } elseif ($status == 3) {
            $title = "Asso. Pending -";
            $queryData->where($table . '.is_forwarded_by_association', '=', 0)
                ->where($table . '.form_status', '=', 0);
        } elseif ($status == 4) {
            $title = "RSO/SO Pending -";
            $queryData->where($table . '.is_forwarded_by_association', '=', 1)
                ->where($table . '.is_forwarded_by_rso', '=', 0)
                ->where($table . '.form_status', '=', 0);
        } elseif ($status == 5) {
            $title = "RSO/SO Rejected -";
            $queryData->where($table . '.is_forwarded_by_association', '=', 1)
                ->where($table . '.is_forwarded_by_rso', '=', 0)
                ->where($table . '.form_status', '=', 2);
        } elseif ($status == 6) {
            $title = "Admin Prize Money Pending -";
            $queryData->where($table . '.is_forwarded_by_rso', '=', 1)
                ->where($table . '.form_status', '=', 0);
        } elseif ($status == 7) {
            $title = "Admin Prize Money Rejected -";
            $queryData->where($table . '.is_forwarded_by_rso', '=', 1)
                ->where($table . '.form_status', '=', 2);
        } elseif ($status == 8) {
            $title = "Admin Prize Money Accepted -";
            $queryData->where($table . '.is_forwarded_by_rso', '=', 1)
                ->where($table . '.form_status', '=', 1);
        }

        if ($sportId != '') {
            $queryData->where('sport_welfare_registration_master.sport_type', "$sportId");
        }


        if ($district != '') {
            if (Auth::guard('admin')->user()->admin_role == 4) {
                $queryData->where('direct_recruitment.permanent_district', $district);
            } else {
                $queryData->where('sport_welfare_registration_master.permanent_district', $district);
            }
        }
        // $queryData->where($table .'.application_no','25071122964');

        $collection = $queryData->get();
        $name  = $name . date('m-d-Y') . '.xlsx';
        $type = 7;
        $formName = $title . "Application Form of Eklavya Krida Kosh";
        // return view('exports.eklavyaExcel', compact('collection','data','type','formName'));
        return Excel::download(new EklProjectExport($type, $collection, $data), $name);
    }

    public function eklavya_krida_co_pd(Request $request)
    {
        $sportId = $request->input('sport_id');
        $status = $request->input('status_filter');
        $district = $request->input('city_filter');
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        $table = "eklavya_krida_kosh_basic_detail";
        $url = "eklavya_krida_view";
        $name = "Eklavya Krida Kosh Applicant List";

        $latestStatusSub = DB::table('status_change_log_detail')
            ->select('user_id', DB::raw('MAX(created_at) as latest_created_at'))
            ->where('form_id', 7)->groupBy('user_id');


        $queryData = DB::table($table)
            ->join('sport_welfare_registration_master', 'sport_welfare_registration_master.id', '=', $table . '.user_id')
            ->join('sport_type', 'sport_type.id', '=', 'sport_welfare_registration_master.sport_type')
            ->joinSub($latestStatusSub, 'latest_status', function ($join) {
                $join->on('latest_status.user_id', '=', 'sport_welfare_registration_master.id');
            })
            ->select(
                $table . '.*',
                'sport_welfare_registration_master.fullname',
                'sport_welfare_registration_master.email',
                'sport_welfare_registration_master.father_name',
                'sport_welfare_registration_master.permanent_district',
                'sport_welfare_registration_master.permanent_address',
                'sport_welfare_registration_master.mobile',
                'sport_type.name as sportName',
                'latest_status.latest_created_at as trail_date'
            )
            ->where($table . '.final_submit', '=', 1);


        if ($fromDate != '') {
            if ($status == 6) {
                $queryData->whereDate('latest_status.latest_created_at', '>=', ymd($fromDate));
            } else {
                $queryData->whereDate($table . '.created_at', '>=', ymd($fromDate));
            }
            $data['from_date'] = dmy($fromDate);
        } else {
            $data['from_date'] = "01-04-2023";
        }



        if ($toDate != '') {
            if ($status == 6) {
                $queryData->whereDate('latest_status.latest_created_at', '<=', ymd($toDate));
            } else {
                $queryData->whereDate($table . '.created_at', '<=', ymd($toDate));
            }
            $data['to_date'] = dmy($toDate);
        } else {
            $data['to_date'] = date('d-m-Y');
        }


        if ($request->from_date != '' && $request->to_date != '') {
            if ($status == 6) {
                $queryData->whereBetween('latest_status.latest_created_at', [ymd($request->from_date), ymd($request->to_date)]);
            } else {
                $queryData->whereBetween($table . '.created_at', [ymd($request->from_date), ymd($request->to_date)]);
            }
        }


        if ($status == 1) {
            $title = "Asso. Forwarded -";
            $queryData->where($table . '.is_forwarded_by_association', '=', 1);
        } elseif ($status == 2) {
            $title = "Asso. Rejected -";
            $queryData->where($table . '.is_forwarded_by_association', '=', 0)
                ->where($table . '.form_status', '=', 2);
        } elseif ($status == 3) {
            $title = "Asso. Pending -";
            $queryData->where($table . '.is_forwarded_by_association', '=', 0)
                ->where($table . '.form_status', '=', 0);
        } elseif ($status == 4) {
            $title = "RSO/SO Pending -";
            $queryData->where($table . '.is_forwarded_by_association', '=', 1)
                ->where($table . '.is_forwarded_by_rso', '=', 0)
                ->where($table . '.form_status', '=', 0);
        } elseif ($status == 5) {
            $title = "RSO/SO Rejected -";
            $queryData->where($table . '.is_forwarded_by_association', '=', 1)
                ->where($table . '.is_forwarded_by_rso', '=', 0)
                ->where($table . '.form_status', '=', 2);
        } elseif ($status == 6) {
            $title = "Admin Prize Money Pending -";
            $queryData->where($table . '.is_forwarded_by_rso', '=', 1)
                ->where($table . '.form_status', '=', 0);
        } elseif ($status == 7) {
            $title = "Admin Prize Money Rejected -";
            $queryData->where($table . '.is_forwarded_by_rso', '=', 1)
                ->where($table . '.form_status', '=', 2);
        } elseif ($status == 8) {
            $title = "Admin Prize Money Accepted -";
            $queryData->where($table . '.is_forwarded_by_rso', '=', 1)
                ->where($table . '.form_status', '=', 1);
        }

        if ($sportId != '') {
            $queryData->where('sport_welfare_registration_master.sport_type', "$sportId");
        }


        if ($district != '') {
            if (Auth::guard('admin')->user()->admin_role == 4) {
                $queryData->where('direct_recruitment.permanent_district', $district);
            } else {
                $queryData->where('sport_welfare_registration_master.permanent_district', $district);
            }
        }
        // $queryData->where($table .'.application_no','25071122964');

        $data['summary']  = $queryData->get();
        $data['name']   = '';
        // $data['name']   = $name . date('m-d-Y') . '.xlsx';
        $data['form_type'] = 7;
        $data['form_name'] = $title . "Application Form of Eklavya Krida Kosh";

        $data['report_code']   = "EK001";
        $data['row_count']   = 5;
        return view('exports.eklavyaProject', $data);
    }

    public function financial_forward(Request $request)
    {


        $id = $request->id;
        $form_type    = $request->form_type;

        $verification_document = '';

        $reciever_id = 1;
        if ($form_type == 7) {
            // $reciever_id=get_rso_by_app($request->reg_id);
            $reciever_id = get_rso_by_app_ekl($request->reg_id);
        }

        if ($request->hasFile('verification_document'))
            $verification_document = moveFile('verification_document', $request->verification_document);


        DB::table('mark_query_comment')->insert([
            'sender_id' => Auth::guard('admin')->user()->id,
            'reciever_id' =>  $reciever_id,
            'application_no' => $request->application_no,
            'comments' => $request->remark,
            'subject' => '',
            'doc' => $verification_document,
            'type' => 1
        ]);
        // dd( $reciever_id);
        $status = array(
            'is_forwarded_by_association' => 1,
        );
        // $status = array('is_forwarded_by_rso' => 1);
        $status['notificationBy'] = Auth::guard('admin')->user()->admin_role;
        if ($form_type == 4) {
            DB::table('financial_assistance')->where('id', $id)->update($status);
            $data = DB::table('financial_assistance')->where('id', $id)->first();

            $user = DB::table('sport_welfare_registration_master')->where('id', $data->user_id)->first();

            $isp = isp_common_detail($data->user_id, $user->email, 'FINANCIAL ASSISTANCE', $data->application_no);

            if ($isp) {



                $url = env('ISP_URl');

                $secretkey = env('ISP_SECRET_KEY');

                $tokenpassword = env('ISP_TOKEN_PASSWORD');
                $dept_id = env('ISP_DEPT_ID');


                $postData = array(
                    "username" =>  $dept_id,
                    "password" =>  $tokenpassword
                );



                $response = json_decode(getToken($url . '/ispws/authenticate', json_encode($postData)));

                $token = $response->token;
                $returnServiceStatus = new ReturnServiceStatus();
                $returnServiceStatus->set_applicant_id($isp->applicant_id);
                $returnServiceStatus->set_request_id($isp->request_id);
                $returnServiceStatus->set_service_code($isp->service_code);
                $returnServiceStatus->set_application_id($isp->applicant_id);
                $returnServiceStatus->set_status_code("s105");
                $returnServiceStatus->set_remarks($request->remark);
                $returnServiceStatus->set_pendency_level("6");
                $returnServiceStatus->set_action_taken_time(date("Y-m-d h:i:s"));
                $returnServiceStatus->set_pending_with_officer("NA");



                $e_data = encryptString(json_encode($returnServiceStatus), $secretkey);

                $finalLoad = array(
                    "dept_id" => $dept_id,
                    "e_data" => $e_data
                );

                $response = callIspWs($url . '/ispws/isp/v1/returnServiceStatus', json_encode($finalLoad), $token);

                $Data_enc = json_decode($response)->data;

                $Data_dsc = json_encode(decryptString($Data_enc, $secretkey));
            };






            StatusChangeLog::dispatch(4, $data->user_id, "", "Forward to Directorate", "sport_welfare_registration_master");
        } elseif ($form_type == 7) {
            if (Auth::guard('admin')->user()->admin_role == 3) {
                $status = array('is_forwarded_by_association' => 1, 'notificationBy' => 3);
                $statusLog = "Forward to RSO";
            } else {
                $status = array('is_forwarded_by_rso' => 1, 'notificationBy' => Auth::guard('admin')->user()->admin_role);
                $statusLog = "Forward to Directorate";
            }
            DB::table('eklavya_krida_kosh_basic_detail')->where('id', $id)->update($status);
            $data = DB::table('eklavya_krida_kosh_basic_detail')->select('user_id')->where('id', $id)->first();
            StatusChangeLog::dispatch(7, $data->user_id, "", $statusLog, "sport_welfare_registration_master");
        } else {




            DB::table('monthly_pension')->where('id', $id)->update($status);
            $data = DB::table('monthly_pension')->where('id', $id)->first();


            $user = DB::table('sport_welfare_registration_master')->where('id', $data->user_id)->first();

            $isp = isp_common_detail($data->user_id, $user->email, 'MONTHLY PENSION', $data->application_no);

            if ($isp) {



                $url = env('ISP_URl');

                $secretkey = env('ISP_SECRET_KEY');

                $tokenpassword = env('ISP_TOKEN_PASSWORD');
                $dept_id = env('ISP_DEPT_ID');


                $postData = array(
                    "username" =>  $dept_id,
                    "password" =>  $tokenpassword
                );



                $response = json_decode(getToken($url . '/ispws/authenticate', json_encode($postData)));

                $token = $response->token;
                $returnServiceStatus = new ReturnServiceStatus();
                $returnServiceStatus->set_applicant_id($isp->applicant_id);
                $returnServiceStatus->set_request_id($isp->request_id);
                $returnServiceStatus->set_service_code($isp->service_code);
                $returnServiceStatus->set_application_id($isp->applicant_id);
                $returnServiceStatus->set_status_code("s105");
                $returnServiceStatus->set_remarks($request->remark);
                $returnServiceStatus->set_pendency_level("6");
                $returnServiceStatus->set_action_taken_time(date("Y-m-d h:i:s"));
                $returnServiceStatus->set_pending_with_officer("NA");



                $e_data = encryptString(json_encode($returnServiceStatus), $secretkey);

                $finalLoad = array(
                    "dept_id" => $dept_id,
                    "e_data" => $e_data
                );

                $response = callIspWs($url . '/ispws/isp/v1/returnServiceStatus', json_encode($finalLoad), $token);

                $Data_enc = json_decode($response)->data;

                $Data_dsc = json_encode(decryptString($Data_enc, $secretkey));
            };



            StatusChangeLog::dispatch(5, $data->user_id, "", "Forward to Directorate", "sport_welfare_registration_master");
        }
        return redirect()->back();
    }

    public function financial_released(Request $request)
    {

        $id = $request->id;
        $amount = $request->amount_release;
        $form_type    = $request->form_type;

        $status = array('amount_release_status' => 1, 'amount_release' => $amount);
        if ($form_type == 4) {
            DB::table('financial_assistance')->where('id', $id)->update($status);
            $data = DB::table('financial_assistance')->select('user_id')->where('id', $id)->first();
            StatusChangeLog::dispatch(4, $data->user_id, "", "Amount Released", "sport_welfare_registration_master");
        } else {
            DB::table('monthly_pension')->where('id', $id)->update($status);
            $data = DB::table('monthly_pension')->select('user_id')->where('id', $id)->first();
            StatusChangeLog::dispatch(5, $data->user_id, "", "Amount Released", "sport_welfare_registration_master");
        }
        return redirect()->back();
    }

    public function financial_mark_query(Request $request)
    {
        $user_id = $request->user_id;
        $mess = $request->is_mark_query;
        if ($request->query_doc) {
            $query_doc = date('His') . $request->query_doc->getClientOriginalName();
            $path = $request->file('query_doc')->storeAs('rso_query', $query_doc, 'public');
        } else {
            $query_doc = "";
        }

        $data = array('form_status' => 3, 'is_mark_query' => $mess, 'query_doc' => $query_doc);
        //dd($data);
        DB::table('financial_assistance')->where('user_id', $user_id)->update($data);
        return redirect()->back()->with('success_marked', 'Marked Query Successfully');
    }

    public function financial_is_rejected(Request $request)
    {

        $user_id = $request->user_id;
        $form_type    = $request->form_type;
        $remark    = $request->remark;

        $data = array('form_status' => 2, 'remark' => $remark);
        // DB::table('financial_assistance')->where('user_id', $user_id)->update($data);
        if ($form_type == 4) {
            DB::table('financial_assistance')->where('application_no', $user_id)->update($data);
            $fin = DB::table('financial_assistance')->where('application_no', $user_id)->first();
            $user = DB::table('sport_welfare_registration_master')->where('id',  $fin->user_id)->first();



            $isp = isp_common_detail($user->id, $user->email, 'FINANCIAL ASSISTANCE', $user_id);
            if ($isp) {



                $url = env('ISP_URl');

                $secretkey = env('ISP_SECRET_KEY');

                $tokenpassword = env('ISP_TOKEN_PASSWORD');
                $dept_id = env('ISP_DEPT_ID');


                $postData = array(
                    "username" =>  $dept_id,
                    "password" =>  $tokenpassword
                );



                $response = json_decode(getToken($url . '/ispws/authenticate', json_encode($postData)));

                $token = $response->token;
                $returnServiceStatus = new ReturnServiceStatus();
                $returnServiceStatus->set_applicant_id($isp->applicant_id);
                $returnServiceStatus->set_request_id($isp->request_id);
                $returnServiceStatus->set_service_code($isp->service_code);
                $returnServiceStatus->set_application_id($isp->applicant_id);
                $returnServiceStatus->set_status_code("s110");
                $returnServiceStatus->set_remarks($request->remark);
                $returnServiceStatus->set_pendency_level("2");
                $returnServiceStatus->set_action_taken_time(date("Y-m-d h:i:s"));
                $returnServiceStatus->set_pending_with_officer("NA");
                $e_data = encryptString(json_encode($returnServiceStatus), $secretkey);

                $finalLoad = array(
                    "dept_id" => $dept_id,
                    "e_data" => $e_data
                );



                $response = callIspWs($url . '/ispws/isp/v1/returnServiceStatus', json_encode($finalLoad), $token);

                $Data_enc = json_decode($response)->data;



                $Data_dsc = json_encode(decryptString($Data_enc, $secretkey));
            }

            StatusChangeLog::dispatch(4, $request->user_id, $request->remark, "Form Rejected", "sport_welfare_registration_master");
            //mail send
            //dd($user);
            //Session::put(['form_type'=> $form_type, 'form_status' => 1]);
            Session::put('session_detail', ["form_type" => $form_type, "form_status" => 2]);

            //$email111 = "pankaj8932971158@gmail.com";
            Mail::to($user->email)->send(new AcceptMail($user->fullname, $user->email));
            //dd('send mail');
        } elseif ($form_type == 7) {
            Session::put('session_detail', ["form_type" => $form_type, "form_status" => 2]);
            $data['other_remark'] = $request->other_remark;
            $data['remark'] = implode('<br>', $remark);
            DB::table('eklavya_krida_kosh_basic_detail')->where('application_no', $user_id)->update($data);
            $fin = DB::table('eklavya_krida_kosh_basic_detail')->where('application_no', $user_id)->first();
            $user = DB::table('sport_welfare_registration_master')->where('id', $fin->user_id)->first();
            // Mail::to($user->email)->send(new AcceptMail($user->fullname, $user->email));
            // StatusChangeLog::dispatch(7, $request->user_id, $request->remark, "Form Rejected", "sport_welfare_registration_master");

        } else {
            DB::table('monthly_pension')->where('application_no', $user_id)->update($data);
            $fin = DB::table('financial_assistance')->where('application_no', $user_id)->first();
            $user = DB::table('sport_welfare_registration_master')->where('id',  $fin->user_id)->first();

            $isp = isp_common_detail($user->id, $user->email, 'MONTHLY PENSION', $user_id);

            if ($isp) {
                $url = env('ISP_URl');

                $secretkey = env('ISP_SECRET_KEY');

                $tokenpassword = env('ISP_TOKEN_PASSWORD');
                $dept_id = env('ISP_DEPT_ID');
                $postData = array(
                    "username" =>  $dept_id,
                    "password" =>  $tokenpassword
                );
                $response = json_decode(getToken($url . '/ispws/authenticate', json_encode($postData)));

                $token = $response->token;
                $returnServiceStatus = new ReturnServiceStatus();
                $returnServiceStatus->set_applicant_id($isp->applicant_id);
                $returnServiceStatus->set_request_id($isp->request_id);
                $returnServiceStatus->set_service_code($isp->service_code);
                $returnServiceStatus->set_application_id($isp->applicant_id);
                $returnServiceStatus->set_status_code("s110");
                $returnServiceStatus->set_remarks($request->remark);
                $returnServiceStatus->set_pendency_level("2");
                $returnServiceStatus->set_action_taken_time(date("Y-m-d h:i:s"));
                $returnServiceStatus->set_pending_with_officer("NA");



                $e_data = encryptString(json_encode($returnServiceStatus), $secretkey);

                $finalLoad = array(
                    "dept_id" => $dept_id,
                    "e_data" => $e_data
                );



                $response = callIspWs($url . '/ispws/isp/v1/returnServiceStatus', json_encode($finalLoad), $token);

                $Data_enc = json_decode($response)->data;



                $Data_dsc = json_encode(decryptString($Data_enc, $secretkey));
            }

            StatusChangeLog::dispatch($form_type, $request->user_id, $request->remark, "Form Rejected", "sport_welfare_registration_master");
            //mail send
            //dd($user);
            //Session::put(['form_type'=> $form_type, 'form_status' => 1]);
            Session::put('session_detail', ["form_type" => $form_type, "form_status" => 2]);

            //$email111 = "pankaj8932971158@gmail.com";
            Mail::to($user->email)->send(new AcceptMail($user->fullname, $user->email));
            //dd('send mail');
        }
        return redirect()->back()->with('error', 'Application Rejected Successfully');
    }

    public function financial_is_accepted(Request $request)
    {


        $user_id    = $request->user_id;
        $form_type    = $request->form_type;
        $remark    = $request->remark;
        $data       = array('form_status' => 1, 'remark' => $remark, 'notificationBy' => 0);
        if ($form_type == 4) {
            DB::table('financial_assistance')->where('application_no', $user_id)->update($data);
            $fin = DB::table('financial_assistance')->where('application_no', $user_id)->first();
            $user = DB::table('sport_welfare_registration_master')->where('id',  $fin->user_id)->first();
            $isp = isp_common_detail($user->id, $user->email, 'FINANCIAL ASSISTANCE', $user_id);

            if ($isp) {


                $url = env('ISP_URl');

                $secretkey = env('ISP_SECRET_KEY');

                $tokenpassword = env('ISP_TOKEN_PASSWORD');
                $dept_id = env('ISP_DEPT_ID');


                $postData = array(
                    "username" =>  $dept_id,
                    "password" =>  $tokenpassword
                );


                $response = json_decode(getToken($url . '/ispws/authenticate', json_encode($postData)));


                $token = $response->token;


                $returnDeliveredServiceStatus = new ReturnDeliveredServiceStatus();
                $returnDeliveredServiceStatus->set_applicant_id($isp->applicant_id);
                $returnDeliveredServiceStatus->set_request_id($isp->request_id);
                $returnDeliveredServiceStatus->set_service_code($isp->service_code);
                $returnDeliveredServiceStatus->set_application_id($isp->applicant_id);
                $returnDeliveredServiceStatus->set_status_code("s112");
                $returnDeliveredServiceStatus->set_remarks('average');
                $returnDeliveredServiceStatus->certificate_no("");
                $returnDeliveredServiceStatus->certificate_url("");
                $returnDeliveredServiceStatus->dbt_amount("");
                $returnDeliveredServiceStatus->set_action_taken_time(date("Y-m-d h:i:s"));



                $e_data = encryptString(json_encode($returnDeliveredServiceStatus), $secretkey);

                $finalLoad = array(
                    "dept_id" => $dept_id,
                    "e_data" => $e_data
                );

                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => $url . '/ispws/isp/v1/returnDeliveredServiceStatus',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => json_encode($finalLoad),
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json',
                        'Authorization: Bearer ' . $token
                    ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);




                $Data_enc = json_decode($response)->data;



                $Data_dsc = json_encode(decryptString($Data_enc, $secretkey));
            };
            StatusChangeLog::dispatch(4, $request->user_id, $request->remark, "Form Accepted", "sport_welfare_registration_master");
            //mail send
            //dd($user);
            //Session::put(['form_type'=> $form_type, 'form_status' => 1]);
            Session::put('session_detail', ["form_type" => $form_type, "form_status" => 1]);

            //$email111 = "pankaj8932971158@gmail.com";
            Mail::to($user->email)->send(new AcceptMail($user->fullname, $user->email));
            //dd('send mail');
        } elseif ($form_type == 7) {
            Session::put('session_detail', ["form_type" => $form_type, "form_status" => 1]);
            DB::table('eklavya_krida_kosh_basic_detail')->where('application_no', $user_id)->update($data);
            $fin = DB::table('eklavya_krida_kosh_basic_detail')->where('application_no', $user_id)->first();
            $user = DB::table('sport_welfare_registration_master')->where('id', $fin->user_id)->first();
            Mail::to($user->email)->send(new AcceptMail($user->fullname, $user->email));
            StatusChangeLog::dispatch(7, $request->user_id, $request->remark, "Form Accepted", "sport_welfare_registration_master");
        } else {
            Session::put('session_detail', ["form_type" => $form_type, "form_status" => 1]);
            DB::table('monthly_pension')->where('application_no', $user_id)->update($data);
            $fin = DB::table('monthly_pension')->where('application_no', $user_id)->first();
            $user = DB::table('sport_welfare_registration_master')->where('id', $fin->user_id)->first();
            StatusChangeLog::dispatch($form_type, $request->user_id, $request->remark, "Form Accepted", "sport_welfare_registration_master");


            $isp = isp_common_detail($user->id, $user->email, 'MONTHLY PENSION', $user_id);

            if ($isp) {


                $url = env('ISP_URl');

                $secretkey = env('ISP_SECRET_KEY');

                $tokenpassword = env('ISP_TOKEN_PASSWORD');
                $dept_id = env('ISP_DEPT_ID');


                $postData = array(
                    "username" =>  $dept_id,
                    "password" =>  $tokenpassword
                );


                $response = json_decode(getToken($url . '/ispws/authenticate', json_encode($postData)));


                $token = $response->token;


                $returnDeliveredServiceStatus = new ReturnDeliveredServiceStatus();
                $returnDeliveredServiceStatus->set_applicant_id($isp->applicant_id);
                $returnDeliveredServiceStatus->set_request_id($isp->request_id);
                $returnDeliveredServiceStatus->set_service_code($isp->service_code);
                $returnDeliveredServiceStatus->set_application_id($isp->applicant_id);
                $returnDeliveredServiceStatus->set_status_code("s112");
                $returnDeliveredServiceStatus->set_remarks('average');
                $returnDeliveredServiceStatus->certificate_no("");
                $returnDeliveredServiceStatus->certificate_url("");
                $returnDeliveredServiceStatus->dbt_amount("");
                $returnDeliveredServiceStatus->set_action_taken_time(date("Y-m-d h:i:s"));
                $returnDeliveredServiceStatus->certificate_expiry_date('999999');


                $e_data = encryptString(json_encode($returnDeliveredServiceStatus), $secretkey);

                $finalLoad = array(
                    "dept_id" => $dept_id,
                    "e_data" => $e_data
                );

                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => $url . '/ispws/isp/v1/returnDeliveredServiceStatus',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => json_encode($finalLoad),
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json',
                        'Authorization: Bearer ' . $token
                    ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);

                $Data_enc = json_decode($response)->data;



                $Data_dsc = json_encode(decryptString($Data_enc, $secretkey));
            };








            Mail::to($user->email)->send(new AcceptMail($user->fullname, $user->email));
        }
        return redirect()->back()->with('success', 'Application Accepted Successfully');
    }

    public function award_is_accepted(Request $request)
    {
        //dd($request->all());
        $user_id    = $request->user_id;
        $form_type    = $request->form_type;
        $remark    = $request->remark;
        $data       = array('form_status' => 1, 'remark' => $remark, 'notificationBy' => 0);
        if ($form_type == 1) {
            DB::table('laxman_award')->where('application_no', $user_id)->update($data);

            $award = DB::table('laxman_award')->where('application_no', $user_id)->first();


            $user = DB::table('sport_welfare_registration_master')->where('id', $award->user_id)->first();

            // dd($user->email);
            $isp = isp_common_detail($user->id, $user->email, 'LAXMAN AND RANI LAXMIBAI AWARD', $user_id);



            if ($isp) {


                $url = env('ISP_URl');

                $secretkey = env('ISP_SECRET_KEY');

                $tokenpassword = env('ISP_TOKEN_PASSWORD');
                $dept_id = env('ISP_DEPT_ID');


                $postData = array(
                    "username" =>  $dept_id,
                    "password" =>  $tokenpassword
                );


                $response = json_decode(getToken($url . '/ispws/authenticate', json_encode($postData)));


                $token = $response->token;


                $returnDeliveredServiceStatus = new ReturnDeliveredServiceStatus();
                $returnDeliveredServiceStatus->set_applicant_id($isp->applicant_id);
                $returnDeliveredServiceStatus->set_request_id($isp->request_id);
                $returnDeliveredServiceStatus->set_service_code($isp->service_code);
                $returnDeliveredServiceStatus->set_application_id($isp->applicant_id);
                $returnDeliveredServiceStatus->set_status_code("s112");
                $returnDeliveredServiceStatus->set_remarks('average');
                $returnDeliveredServiceStatus->certificate_no("");
                $returnDeliveredServiceStatus->certificate_url("");
                $returnDeliveredServiceStatus->dbt_amount("");
                $returnDeliveredServiceStatus->set_action_taken_time(date("Y-m-d h:i:s"));



                $e_data = encryptString(json_encode($returnDeliveredServiceStatus), $secretkey);

                $finalLoad = array(
                    "dept_id" => $dept_id,
                    "e_data" => $e_data
                );



                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => $url . '/ispws/isp/v1/returnDeliveredServiceStatus',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => json_encode($finalLoad),
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json',
                        'Authorization: Bearer ' . $token
                    ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);


                $Data_enc = json_decode($response)->data;



                $Data_dsc = json_encode(decryptString($Data_enc, $secretkey));
            };


            StatusChangeLog::dispatch(1, $request->user_id, $request->remark, "Form Accepted", "sport_welfare_registration_master");
            //mail send
            //dd($user);
            Session::put('session_detail', ["form_type" => $form_type, "form_status" => 1]);
            //$email111 = "pankaj8932971158@gmail.com";
            try {
                Mail::to($user->email)->send(new AcceptMail($user->fullname, $user->email));
            } catch (Exception $e) {
                return $e;
            }
            //dd('send mail');
        } elseif ($form_type == 2) {
            DB::table('ranilaxmibai_award')->where('application_no', $user_id)->update($data);


            $award = DB::table('ranilaxmibai_award')->where('application_no', $user_id)->first();


            $user = DB::table('sport_welfare_registration_master')->where('id', $award->user_id)->first();
            // dd($user->email);
            $isp = isp_common_detail($user->id, $user->email, 'LAXMAN AND RANI LAXMIBAI AWARD', $user_id);



            if ($isp) {


                $url = env('ISP_URl');

                $secretkey = env('ISP_SECRET_KEY');

                $tokenpassword = env('ISP_TOKEN_PASSWORD');
                $dept_id = env('ISP_DEPT_ID');


                $postData = array(
                    "username" =>  $dept_id,
                    "password" =>  $tokenpassword
                );


                $response = json_decode(getToken($url . '/ispws/authenticate', json_encode($postData)));


                $token = $response->token;


                $returnDeliveredServiceStatus = new ReturnDeliveredServiceStatus();
                $returnDeliveredServiceStatus->set_applicant_id($isp->applicant_id);
                $returnDeliveredServiceStatus->set_request_id($isp->request_id);
                $returnDeliveredServiceStatus->set_service_code($isp->service_code);
                $returnDeliveredServiceStatus->set_application_id($isp->applicant_id);
                $returnDeliveredServiceStatus->set_status_code("s112");
                $returnDeliveredServiceStatus->set_remarks('average');
                $returnDeliveredServiceStatus->certificate_no("");
                $returnDeliveredServiceStatus->certificate_url("");
                $returnDeliveredServiceStatus->dbt_amount("");
                $returnDeliveredServiceStatus->set_action_taken_time(date("Y-m-d h:i:s"));



                $e_data = encryptString(json_encode($returnDeliveredServiceStatus), $secretkey);

                $finalLoad = array(
                    "dept_id" => $dept_id,
                    "e_data" => $e_data
                );



                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => $url . '/ispws/isp/v1/returnDeliveredServiceStatus',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => json_encode($finalLoad),
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json',
                        'Authorization: Bearer ' . $token
                    ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);


                $Data_enc = json_decode($response)->data;



                $Data_dsc = json_encode(decryptString($Data_enc, $secretkey));
            };

            StatusChangeLog::dispatch(2, $request->user_id, $request->remark, "Form Accepted", "sport_welfare_registration_master");
            //mail send
            //dd($user);
            //Session::put(['form_type'=> $form_type, 'form_status' => 1]);
            Session::put('session_detail', ["form_type" => $form_type, "form_status" => 1]);

            //$email111 = "pankaj8932971158@gmail.com";
            Mail::to($user->email)->send(new AcceptMail($user->fullname, $user->email));
            //dd('send mail');

        } else {
            DB::table('position_holder')->where('application_no', $user_id)->update($data);

            $award = DB::table('position_holder')->where('application_no', $user_id)->first();


            $user = DB::table('sport_welfare_registration_master')->where('id', $award->user_id)->first();



            $isp = isp_common_detail($user->id, $user->email, 'PRIZE MONEY', $user_id);



            if ($isp) {


                $url = env('ISP_URl');

                $secretkey = env('ISP_SECRET_KEY');

                $tokenpassword = env('ISP_TOKEN_PASSWORD');
                $dept_id = env('ISP_DEPT_ID');


                $postData = array(
                    "username" =>  $dept_id,
                    "password" =>  $tokenpassword
                );


                $response = json_decode(getToken($url . '/ispws/authenticate', json_encode($postData)));


                $token = $response->token;


                $returnDeliveredServiceStatus = new ReturnDeliveredServiceStatus();
                $returnDeliveredServiceStatus->set_applicant_id($isp->applicant_id);
                $returnDeliveredServiceStatus->set_request_id($isp->request_id);
                $returnDeliveredServiceStatus->set_service_code($isp->service_code);
                $returnDeliveredServiceStatus->set_application_id($isp->applicant_id);
                $returnDeliveredServiceStatus->set_status_code("s112");
                $returnDeliveredServiceStatus->set_remarks('average');
                $returnDeliveredServiceStatus->certificate_no("");
                $returnDeliveredServiceStatus->certificate_url("");
                $returnDeliveredServiceStatus->dbt_amount("");
                $returnDeliveredServiceStatus->set_action_taken_time(date("Y-m-d h:i:s"));



                $e_data = encryptString(json_encode($returnDeliveredServiceStatus), $secretkey);

                $finalLoad = array(
                    "dept_id" => $dept_id,
                    "e_data" => $e_data
                );



                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => $url . '/ispws/isp/v1/returnDeliveredServiceStatus',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => json_encode($finalLoad),
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json',
                        'Authorization: Bearer ' . $token
                    ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);


                $Data_enc = json_decode($response)->data;



                $Data_dsc = json_encode(decryptString($Data_enc, $secretkey));
            };
            StatusChangeLog::dispatch(3, $request->user_id, $request->remark, "Form Accepted", "sport_welfare_registration_master");
            //mail send
            //dd($user);
            Session::put('session_detail', ["form_type" => $form_type, "form_status" => 1]);
            //$email111 = "pankaj8932971158@gmail.com";
            Mail::to($user->email)->send(new AcceptMail($user->fullname, $user->email));
            //dd('send mail');
        }

        return redirect()->back()->with('success', 'Application Accepted Successfully');
    }

    public function award_is_rejected(Request $request)
    {
        $user_id    = $request->user_id;
        $form_type    = $request->form_type;
        $remark    = $request->remark;
        $data       = array('form_status' => 2, 'remark' => $remark, 'notificationBy' => 0);

        if ($form_type == 1) {
            DB::table('laxman_award')->where('application_no', $user_id)->update($data);
            $award = DB::table('laxman_award')->where('application_no', $user_id)->first();


            $user = DB::table('sport_welfare_registration_master')->where('id', $award->user_id)->first();

            $isp = isp_common_detail($user->id, $user->email, 'LAXMAN AND RANI LAXMIBAI AWARD', $user_id);


            if ($isp) {



                $url = env('ISP_URl');

                $secretkey = env('ISP_SECRET_KEY');

                $tokenpassword = env('ISP_TOKEN_PASSWORD');
                $dept_id = env('ISP_DEPT_ID');


                $postData = array(
                    "username" =>  $dept_id,
                    "password" =>  $tokenpassword
                );



                $response = json_decode(getToken($url . '/ispws/authenticate', json_encode($postData)));

                $token = $response->token;
                $returnServiceStatus = new ReturnServiceStatus();
                $returnServiceStatus->set_applicant_id($isp->applicant_id);
                $returnServiceStatus->set_request_id($isp->request_id);
                $returnServiceStatus->set_service_code($isp->service_code);
                $returnServiceStatus->set_application_id($isp->applicant_id);
                $returnServiceStatus->set_status_code("s110");
                $returnServiceStatus->set_remarks($request->remark);
                $returnServiceStatus->set_pendency_level("2");
                $returnServiceStatus->set_action_taken_time(date("Y-m-d h:i:s"));
                $returnServiceStatus->set_pending_with_officer("NA");



                $e_data = encryptString(json_encode($returnServiceStatus), $secretkey);

                $finalLoad = array(
                    "dept_id" => $dept_id,
                    "e_data" => $e_data
                );



                $response = callIspWs($url . '/ispws/isp/v1/returnServiceStatus', json_encode($finalLoad), $token);

                $Data_enc = json_decode($response)->data;



                $Data_dsc = json_encode(decryptString($Data_enc, $secretkey));
            }
            StatusChangeLog::dispatch(1, $request->user_id, $request->remark, "Form Rejected", "sport_welfare_registration_master");
            //mail send
            //dd($user);
            Session::put('session_detail', ["form_type" => $form_type, "form_status" => 2]);
            //$email111 = "pankaj8932971158@gmail.com";
            Mail::to($user->email)->send(new AcceptMail($user->fullname, $user->email));
            //dd('send mail');
        } elseif ($form_type == 2) {
            DB::table('ranilaxmibai_award')->where('application_no', $user_id)->update($data);

            DB::table('ranilaxmibai_award')->where('application_no', $user_id)->update($data);
            $award = DB::table('ranilaxmibai_award')->where('application_no', $user_id)->first();


            $user = DB::table('sport_welfare_registration_master')->where('id', $award->user_id)->first();


            $isp = isp_common_detail($user->id, $user->email, 'LAXMAN AND RANI LAXMIBAI AWARD', $user_id);
            if ($isp) {



                $url = env('ISP_URl');

                $secretkey = env('ISP_SECRET_KEY');

                $tokenpassword = env('ISP_TOKEN_PASSWORD');
                $dept_id = env('ISP_DEPT_ID');


                $postData = array(
                    "username" =>  $dept_id,
                    "password" =>  $tokenpassword
                );



                $response = json_decode(getToken($url . '/ispws/authenticate', json_encode($postData)));

                $token = $response->token;
                $returnServiceStatus = new ReturnServiceStatus();
                $returnServiceStatus->set_applicant_id($isp->applicant_id);
                $returnServiceStatus->set_request_id($isp->request_id);
                $returnServiceStatus->set_service_code($isp->service_code);
                $returnServiceStatus->set_application_id($isp->applicant_id);
                $returnServiceStatus->set_status_code("s110");
                $returnServiceStatus->set_remarks($request->remark);
                $returnServiceStatus->set_pendency_level("2");
                $returnServiceStatus->set_action_taken_time(date("Y-m-d h:i:s"));
                $returnServiceStatus->set_pending_with_officer("NA");



                $e_data = encryptString(json_encode($returnServiceStatus), $secretkey);

                $finalLoad = array(
                    "dept_id" => $dept_id,
                    "e_data" => $e_data
                );



                $response = callIspWs($url . '/ispws/isp/v1/returnServiceStatus', json_encode($finalLoad), $token);

                $Data_enc = json_decode($response)->data;



                $Data_dsc = json_encode(decryptString($Data_enc, $secretkey));
            }
            StatusChangeLog::dispatch(2, $request->user_id, $request->remark, "Form Rejected", "sport_welfare_registration_master");
            //mail send
            //dd($user);
            Session::put('session_detail', ["form_type" => $form_type, "form_status" => 2]);
            //$email111 = "pankaj8932971158@gmail.com";
            Mail::to($user->email)->send(new AcceptMail($user->fullname, $user->email));
            //dd('send mail');
        } else {
            DB::table('position_holder')->where('application_no', $user_id)->update($data);

            $award = DB::table('position_holder')->where('application_no', $user_id)->first();


            $user = DB::table('sport_welfare_registration_master')->where('id', $award->user_id)->first();


            $isp = isp_common_detail($user->id, $user->email, 'PRIZE MONEY', $user_id);

            if ($isp) {

                $url = env('ISP_URl');

                $secretkey = env('ISP_SECRET_KEY');

                $tokenpassword = env('ISP_TOKEN_PASSWORD');
                $dept_id = env('ISP_DEPT_ID');

                $postData = array(
                    "username" =>  $dept_id,
                    "password" =>  $tokenpassword
                );


                $response = json_decode(getToken($url . '/ispws/authenticate', json_encode($postData)));

                $token = $response->token;
                $returnServiceStatus = new ReturnServiceStatus();
                $returnServiceStatus->set_applicant_id($isp->applicant_id);
                $returnServiceStatus->set_request_id($isp->request_id);
                $returnServiceStatus->set_service_code($isp->service_code);
                $returnServiceStatus->set_application_id($isp->applicant_id);
                $returnServiceStatus->set_status_code("s110");
                $returnServiceStatus->set_remarks($request->remark);
                $returnServiceStatus->set_pendency_level("2");
                $returnServiceStatus->set_action_taken_time(date("Y-m-d h:i:s"));
                $returnServiceStatus->set_pending_with_officer("NA");

                $e_data = encryptString(json_encode($returnServiceStatus), $secretkey);

                $finalLoad = array(
                    "dept_id" => $dept_id,
                    "e_data" => $e_data
                );



                $response = callIspWs($url . '/ispws/isp/v1/returnServiceStatus', json_encode($finalLoad), $token);

                $Data_enc = json_decode($response)->data;



                $Data_dsc = json_encode(decryptString($Data_enc, $secretkey));
            }
            StatusChangeLog::dispatch(3, $request->user_id, $request->remark, "Form Rejected", "sport_welfare_registration_master");

            Session::put('session_detail', ["form_type" => $form_type, "form_status" => 2]);
            //$email111 = "pankaj8932971158@gmail.com";
            Mail::to($user->email)->send(new AcceptMail($user->fullname, $user->email));
            //dd('send mail');
        }
        return redirect()->back()->with('error', 'Application Rejected Successfully');
    }


    public function award_released_amount(Request $request)
    {
        $id = $request->id;
        $amount = $request->amount_release;
        $form_type    = $request->form_type;

        $status = array('amount_release_status' => 1, 'amount_release' => $amount);
        if ($form_type == 1) {
            DB::table('laxman_award')->where('id', $id)->update($status);
            $data = DB::table('laxman_award')->select('user_id')->where('id', $id)->first();

            StatusChangeLog::dispatch(1, $data->user_id, $request->remark, "Amount Released", "sport_welfare_registration_master");
        } elseif ($form_type == 2) {
            DB::table('ranilaxmibai_award')->where('id', $id)->update($status);
            $data = DB::table('ranilaxmibai_award')->select('user_id')->where('id', $id)->first();
            StatusChangeLog::dispatch(2, $data->user_id, $request->remark, "Amount Released", "sport_welfare_registration_master");
        } else {
            DB::table('position_holder')->where('id', $id)->update($status);



            $data = DB::table('position_holder')->select('user_id')->where('id', $id)->first();


            StatusChangeLog::dispatch(3, $data->user_id, $request->remark, "Amount Released", "sport_welfare_registration_master");
        }
        return redirect()->back();
    }

    public function award_forward_directorate(Request $request)
    {
        // dd($request->all());
        $id = $request->id;
        $form_type    = $request->form_type;


        $verification_document = '';
        if ($request->hasFile('verification_document'))
            $verification_document = moveFile('verification_document', $request->verification_document);

        if ($form_type == 1 || $form_type == 2) {

            DB::table('mark_query_comment')->insert([
                'sender_id' => Auth::guard('admin')->user()->id,
                'reciever_id' => 1,
                'application_no' => $request->application_no,
                'comments' => $request->remark,
                'subject' => '',
                'doc' => $verification_document,
                'type' => 1
            ]);
        } else {
            $reciever_id = 32;
            if (Auth::guard('admin')->user()->id == 32) {
                $reciever_id = 1;
            }
            DB::table('mark_query_comment')->insert([
                'sender_id' => Auth::guard('admin')->user()->id,
                'reciever_id' => $reciever_id,
                'application_no' => $request->application_no,
                'comments' => $request->remark,
                'subject' => '',
                'doc' => $verification_document,
                'type' => 1
            ]);
        }

        if (Auth::guard('admin')->user()->admin_role == 3) {
            if ($form_type == 3) {

                $status = array(
                    'is_forwarded_by_association' => 1,
                    'notificationBy' => 3
                );
                $statusLog = "Forward to RSO";
            } else {
                $status = array(
                    'is_forwarded_by_association' => 1,
                    'notificationBy' => Auth::guard('admin')->user()->admin_role
                );
                $statusLog = "Forward to Directorate";
            }
        } else {
            $status = array(
                'is_forwarded_by_rso' => 1,
                'notificationBy' => Auth::guard('admin')->user()->admin_role
            );
            $statusLog = "Forward to Directorate";
        }
        if ($form_type == 1) {
            DB::table('laxman_award')->where('id', $id)->update($status);
            $data = DB::table('laxman_award')->where('id', $id)->first();



            $user = DB::table('sport_welfare_registration_master')->where('id', $data->user_id)->first();



            $isp = isp_common_detail($data->user_id, $user->email, 'LAXMAN AND RANI LAXMIBAI AWARD', $data->application_no);

            if ($isp) {



                $url = env('ISP_URl');

                $secretkey = env('ISP_SECRET_KEY');

                $tokenpassword = env('ISP_TOKEN_PASSWORD');
                $dept_id = env('ISP_DEPT_ID');


                $postData = array(
                    "username" =>  $dept_id,
                    "password" =>  $tokenpassword
                );



                $response = json_decode(getToken($url . '/ispws/authenticate', json_encode($postData)));

                $token = $response->token;
                $returnServiceStatus = new ReturnServiceStatus();
                $returnServiceStatus->set_applicant_id($isp->applicant_id);
                $returnServiceStatus->set_request_id($isp->request_id);
                $returnServiceStatus->set_service_code($isp->service_code);
                $returnServiceStatus->set_application_id($isp->applicant_id);
                $returnServiceStatus->set_status_code("s105");
                $returnServiceStatus->set_remarks($request->remark);
                $returnServiceStatus->set_pendency_level("2");
                $returnServiceStatus->set_action_taken_time(date("Y-m-d h:i:s"));
                $returnServiceStatus->set_pending_with_officer("NA");



                $e_data = encryptString(json_encode($returnServiceStatus), $secretkey);

                $finalLoad = array(
                    "dept_id" => $dept_id,
                    "e_data" => $e_data
                );



                $response = callIspWs($url . '/ispws/isp/v1/returnServiceStatus', json_encode($finalLoad), $token);

                $Data_enc = json_decode($response)->data;



                $Data_dsc = json_encode(decryptString($Data_enc, $secretkey));
            }
            StatusChangeLog::dispatch(1, $data->user_id, "", "Forward to Directorate", "sport_welfare_registration_master");
        } elseif ($form_type == 2) {
            $data = DB::table('ranilaxmibai_award')->select('user_id')->where('id', $id)->first();



            $data = DB::table('ranilaxmibai_award')->where('id', $id)->first();

            $user = DB::table('sport_welfare_registration_master')->where('id', $data->user_id)->first();



            $isp = isp_common_detail($data->user_id, $user->email, 'LAXMAN AND RANI LAXMIBAI AWARD', $data->application_no);

            if ($isp) {



                $url = env('ISP_URl');

                $secretkey = env('ISP_SECRET_KEY');

                $tokenpassword = env('ISP_TOKEN_PASSWORD');
                $dept_id = env('ISP_DEPT_ID');


                $postData = array(
                    "username" =>  $dept_id,
                    "password" =>  $tokenpassword
                );



                $response = json_decode(getToken($url . '/ispws/authenticate', json_encode($postData)));

                $token = $response->token;
                $returnServiceStatus = new ReturnServiceStatus();
                $returnServiceStatus->set_applicant_id($isp->applicant_id);
                $returnServiceStatus->set_request_id($isp->request_id);
                $returnServiceStatus->set_service_code($isp->service_code);
                $returnServiceStatus->set_application_id($isp->applicant_id);
                $returnServiceStatus->set_status_code("s105");
                $returnServiceStatus->set_remarks($request->remark);
                $returnServiceStatus->set_pendency_level("2");
                $returnServiceStatus->set_action_taken_time(date("Y-m-d h:i:s"));
                $returnServiceStatus->set_pending_with_officer("NA");



                $e_data = encryptString(json_encode($returnServiceStatus), $secretkey);

                $finalLoad = array(
                    "dept_id" => $dept_id,
                    "e_data" => $e_data
                );



                $response = callIspWs($url . '/ispws/isp/v1/returnServiceStatus', json_encode($finalLoad), $token);

                $Data_enc = json_decode($response)->data;



                $Data_dsc = json_encode(decryptString($Data_enc, $secretkey));
            }
            StatusChangeLog::dispatch(2, $data->user_id, "", "Forward to Directorate", "sport_welfare_registration_master");
            DB::table('ranilaxmibai_award')->where('id', $id)->update($status);
        } else {

            DB::table('position_holder')->where('id', $id)->update($status);
            $data = DB::table('position_holder')->where('id', $id)->first();

            $user = DB::table('sport_welfare_registration_master')->where('id', $data->user_id)->first();



            $isp = isp_common_detail($data->user_id, $user->email, 'PRIZE MONEY', $data->application_no);

            if ($isp) {



                $url = env('ISP_URl');

                $secretkey = env('ISP_SECRET_KEY');

                $tokenpassword = env('ISP_TOKEN_PASSWORD');
                $dept_id = env('ISP_DEPT_ID');


                $postData = array(
                    "username" =>  $dept_id,
                    "password" =>  $tokenpassword
                );



                $response = json_decode(getToken($url . '/ispws/authenticate', json_encode($postData)));

                $token = $response->token;
                $returnServiceStatus = new ReturnServiceStatus();
                $returnServiceStatus->set_applicant_id($isp->applicant_id);
                $returnServiceStatus->set_request_id($isp->request_id);
                $returnServiceStatus->set_service_code($isp->service_code);
                $returnServiceStatus->set_application_id($isp->applicant_id);
                $returnServiceStatus->set_status_code("s105");
                $returnServiceStatus->set_remarks($request->remark);
                $returnServiceStatus->set_pendency_level("2");
                $returnServiceStatus->set_action_taken_time(date("Y-m-d h:i:s"));
                $returnServiceStatus->set_pending_with_officer("NA");



                $e_data = encryptString(json_encode($returnServiceStatus), $secretkey);

                $finalLoad = array(
                    "dept_id" => $dept_id,
                    "e_data" => $e_data
                );



                $response = callIspWs($url . '/ispws/isp/v1/returnServiceStatus', json_encode($finalLoad), $token);

                $Data_enc = json_decode($response)->data;



                $Data_dsc = json_encode(decryptString($Data_enc, $secretkey));
            }
            StatusChangeLog::dispatch(3, $data->user_id, "", $statusLog, "sport_welfare_registration_master");
        }
        return redirect()->back()->with('success', 'Application Forwarded Successfully');
    }


    public function direct_is_accepted(Request $request)
    {
        $user_id    = $request->user_id;
        $form_type    = $request->form_type;
        $data       = array('form_status' => 1);

        DB::table('direct_recruitment')->where('user_id', $user_id)->update($data);

        $userrr = DB::table('direct_recruitment')->where('user_id', $user_id)->first();

        $user = DB::table('sport_welfare_registration_master')->where('id', $user_id)->first();



        $isp = isp_common_detail($user->id, $user->email, 'DIRECT RECRUITMENT', $userrr->application_no);



        if ($isp) {


            $url = env('ISP_URl');

            $secretkey = env('ISP_SECRET_KEY');

            $tokenpassword = env('ISP_TOKEN_PASSWORD');
            $dept_id = env('ISP_DEPT_ID');


            $postData = array(
                "username" =>  $dept_id,
                "password" =>  $tokenpassword
            );


            $response = json_decode(getToken($url . '/ispws/authenticate', json_encode($postData)));


            $token = $response->token;


            $returnDeliveredServiceStatus = new ReturnDeliveredServiceStatus();
            $returnDeliveredServiceStatus->set_applicant_id($isp->applicant_id);
            $returnDeliveredServiceStatus->set_request_id($isp->request_id);
            $returnDeliveredServiceStatus->set_service_code($isp->service_code);
            $returnDeliveredServiceStatus->set_application_id($isp->applicant_id);
            $returnDeliveredServiceStatus->set_status_code("s112");
            $returnDeliveredServiceStatus->set_remarks('average');
            $returnDeliveredServiceStatus->certificate_no("");
            $returnDeliveredServiceStatus->certificate_url("");
            $returnDeliveredServiceStatus->dbt_amount("");
            $returnDeliveredServiceStatus->set_action_taken_time(date("Y-m-d h:i:s"));



            $e_data = encryptString(json_encode($returnDeliveredServiceStatus), $secretkey);

            $finalLoad = array(
                "dept_id" => $dept_id,
                "e_data" => $e_data
            );



            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url . '/ispws/isp/v1/returnDeliveredServiceStatus',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($finalLoad),
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $token
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);


            $Data_enc = json_decode($response)->data;



            $Data_dsc = json_encode(decryptString($Data_enc, $secretkey));
        };
        StatusChangeLog::dispatch(6, $request->user_id, $request->remark, "Form Accepted", "direct_recruitment");

        return redirect()->back()->with('success', 'Application Accepted Successfully');
    }

    public function direct_is_rejected(Request $request)
    {
        $user_id    = $request->user_id;
        $form_type    = $request->form_type;
        $remark    = $request->remark;



        $data = array('form_status' => 2, 'remark' => $remark);

        DB::table('direct_recruitment')->where('user_id', $user_id)->update($data);
        $userrr = DB::table('direct_recruitment')->where('user_id', $user_id)->first();
        $user = DB::table('sport_welfare_registration_master')->where('id', $user_id)->first();



        $isp = isp_common_detail($user->id, $user->email, 'DIRECT RECRUITMENT', $userrr->application_no);

        if ($isp) {



            $url = env('ISP_URl');

            $secretkey = env('ISP_SECRET_KEY');

            $tokenpassword = env('ISP_TOKEN_PASSWORD');
            $dept_id = env('ISP_DEPT_ID');


            $postData = array(
                "username" =>  $dept_id,
                "password" =>  $tokenpassword
            );



            $response = json_decode(getToken($url . '/ispws/authenticate', json_encode($postData)));

            $token = $response->token;
            $returnServiceStatus = new ReturnServiceStatus();
            $returnServiceStatus->set_applicant_id($isp->applicant_id);
            $returnServiceStatus->set_request_id($isp->request_id);
            $returnServiceStatus->set_service_code($isp->service_code);
            $returnServiceStatus->set_application_id($isp->applicant_id);
            $returnServiceStatus->set_status_code("s110");
            $returnServiceStatus->set_remarks($request->remark);
            $returnServiceStatus->set_pendency_level("");
            $returnServiceStatus->set_action_taken_time(date("Y-m-d h:i:s"));






            $e_data = encryptString(json_encode($returnServiceStatus), $secretkey);

            $finalLoad = array(
                "dept_id" => $dept_id,
                "e_data" => $e_data
            );

            $response = callIspWs($url . '/ispws/isp/v1/returnServiceStatus', json_encode($finalLoad), $token);

            $Data_enc = json_decode($response)->data;

            $Data_dsc = json_encode(decryptString($Data_enc, $secretkey));
        };
        StatusChangeLog::dispatch(6, $request->user_id, $request->remark, "Form Rejected", "direct_recruitment");

        return redirect()->back()->with('success_marked', 'Application Rejected Successfully');
    }

    public function direct_forward_directorate(Request $request)
    {
        $id = $request->id;
        $form_type    = $request->form_type;
        $forward_to    = $request->forward_to + 1;

        if ($forward_to == 1) {
            $reciever_id = 38;
        }
        if ($forward_to == 2 || $forward_to == 6) {
            $reciever_id = 1;
        }
        if ($forward_to == 3  || $forward_to == 5) {
            $reciever_id = 51;
        }

        if ($forward_to == 4) {
            $reciever_id = get_association_by_app($request->application_no);
        }

        // if($forward_to == 4 || $forward_to==6){
        //     $reciever_id=1;
        // }



        $verification_document = '';
        if ($request->hasFile('verification_document'))
            $verification_document = moveFile('verification_document', $request->verification_document);

        $status = array('is_forwarded_by_rso' => $forward_to, 'notificationBy' => $forward_to);

        DB::table('mark_query_comment')->insert([
            'sender_id' => Auth::guard('admin')->user()->id,
            'reciever_id' => $reciever_id,
            'application_no' => $request->application_no,
            'comments' => $request->remark,
            'subject' => '',
            'doc' => $verification_document,
            'type' => 1
        ]);

        //    dd($forward_to);
        DB::table('direct_recruitment')->where('user_id', $id)->update($status);

        $user = DB::table('sport_welfare_registration_master')->where('id', $id)->first();



        $isp = isp_common_detail($user->id, $user->email, 'DIRECT RECRUITMENT', $request->application_no);

        if ($isp) {



            $url = env('ISP_URl');

            $secretkey = env('ISP_SECRET_KEY');

            $tokenpassword = env('ISP_TOKEN_PASSWORD');
            $dept_id = env('ISP_DEPT_ID');


            $postData = array(
                "username" =>  $dept_id,
                "password" =>  $tokenpassword
            );



            $response = json_decode(getToken($url . '/ispws/authenticate', json_encode($postData)));

            $token = $response->token;
            $returnServiceStatus = new ReturnServiceStatus();
            $returnServiceStatus->set_applicant_id($isp->applicant_id);
            $returnServiceStatus->set_request_id($isp->request_id);
            $returnServiceStatus->set_service_code($isp->service_code);
            $returnServiceStatus->set_application_id($isp->applicant_id);
            $returnServiceStatus->set_status_code("s105");
            $returnServiceStatus->set_remarks($request->remark);
            $returnServiceStatus->set_pendency_level("6");
            $returnServiceStatus->set_action_taken_time(date("Y-m-d h:i:s"));
            $returnServiceStatus->set_pending_with_officer("NA");



            $e_data = encryptString(json_encode($returnServiceStatus), $secretkey);

            $finalLoad = array(
                "dept_id" => $dept_id,
                "e_data" => $e_data
            );

            $response = callIspWs($url . '/ispws/isp/v1/returnServiceStatus', json_encode($finalLoad), $token);

            $Data_enc = json_decode($response)->data;

            $Data_dsc = json_encode(decryptString($Data_enc, $secretkey));
        };
        DB::table('query_master')->where('user_id', $id)->update(['is_closed' => 1]);
        if ($forward_to == 1) {
            StatusChangeLog::dispatch(6, $id, "", "Forward to Examination Committee", "direct_recruitment");
        }
        if ($forward_to == 2 || $forward_to == 6) {
            StatusChangeLog::dispatch(6, $id, "", "Forward to Directorate", "direct_recruitment");
        }
        if ($forward_to == 3 || $forward_to == 5) {
            StatusChangeLog::dispatch(6, $id, "", "Forward to Dealing Assistance", "direct_recruitment");
        }
        if ($forward_to == 4) {
            StatusChangeLog::dispatch(6, $id, "", "Forward to Association", "direct_recruitment");
        }

        return redirect()->back();
    }

    public function direct_released_amount(Request $request)
    {
        $id = $request->id;
        $amount = $request->amount_release;
        $form_type    = $request->form_type;

        $status = array('amount_release_status' => 1, 'amount_release' => $amount);

        DB::table('direct_recruitment')->where('id', $id)->update($status);

        return redirect()->back();
    }


    public function direct_mark_query(Request $req)
    {
        $fileName = '';
        if ($req->hasFile('query_doc'))
            $fileName = moveFile('queryDoc', $req->query_doc);

        //$userId = DB::table('direct_recruitment')->where('id', $req->formID)->first()->user_id;
        $userId = $req->formID;
        $application_id = $req->formID;
        $formType = $req->formType;
        $application_no = 0;
        if ($formType == 1) {
            DB::table('laxman_award')->where('application_no', $userId)->update(['is_editable' => 1]);
            $userId = DB::table('laxman_award')->where('application_no', $userId)->first()->user_id;
            $application_no = $req->formID;





            $user = DB::table('sport_welfare_registration_master')->where('id', $userId)->first();



            $isp = isp_common_detail($user->id, $user->email, 'LAXMAN AND RANI LAXMIBAI AWARD', $application_id);

            if ($isp) {



                $url = env('ISP_URl');

                $secretkey = env('ISP_SECRET_KEY');

                $tokenpassword = env('ISP_TOKEN_PASSWORD');
                $dept_id = env('ISP_DEPT_ID');


                $postData = array(
                    "username" =>  $dept_id,
                    "password" =>  $tokenpassword
                );



                $response = json_decode(getToken($url . '/ispws/authenticate', json_encode($postData)));

                $token = $response->token;
                $returnServiceStatus = new ReturnServiceStatus();
                $returnServiceStatus->set_applicant_id($isp->applicant_id);
                $returnServiceStatus->set_request_id($isp->request_id);
                $returnServiceStatus->set_service_code($isp->service_code);
                $returnServiceStatus->set_application_id($isp->applicant_id);
                $returnServiceStatus->set_status_code("s109");
                $returnServiceStatus->set_remarks($req->is_mark_query);
                $returnServiceStatus->set_pendency_level("6");
                $returnServiceStatus->set_action_taken_time(date("Y-m-d h:i:s"));
                $returnServiceStatus->set_pending_with_officer("NA");



                $e_data = encryptString(json_encode($returnServiceStatus), $secretkey);

                $finalLoad = array(
                    "dept_id" => $dept_id,
                    "e_data" => $e_data
                );

                $response = callIspWs($url . '/ispws/isp/v1/returnServiceStatus', json_encode($finalLoad), $token);

                $Data_enc = json_decode($response)->data;

                $Data_dsc = json_encode(decryptString($Data_enc, $secretkey));
            };
        }
        if ($formType == 2) {
            DB::table('ranilaxmibai_award')->where('application_no', $userId)->update(['is_editable' => 1]);
            $userId = DB::table('ranilaxmibai_award')->where('application_no', $userId)->first()->user_id;
            $application_no = $req->formID;




            $user = DB::table('sport_welfare_registration_master')->where('id', $userId)->first();



            $isp = isp_common_detail($user->id, $user->email, 'LAXMAN AND RANI LAXMIBAI AWARD', $application_id);

            if ($isp) {



                $url = env('ISP_URl');

                $secretkey = env('ISP_SECRET_KEY');

                $tokenpassword = env('ISP_TOKEN_PASSWORD');
                $dept_id = env('ISP_DEPT_ID');


                $postData = array(
                    "username" =>  $dept_id,
                    "password" =>  $tokenpassword
                );



                $response = json_decode(getToken($url . '/ispws/authenticate', json_encode($postData)));

                $token = $response->token;
                $returnServiceStatus = new ReturnServiceStatus();
                $returnServiceStatus->set_applicant_id($isp->applicant_id);
                $returnServiceStatus->set_request_id($isp->request_id);
                $returnServiceStatus->set_service_code($isp->service_code);
                $returnServiceStatus->set_application_id($isp->applicant_id);
                $returnServiceStatus->set_status_code("s109");
                $returnServiceStatus->set_remarks($req->is_mark_query);
                $returnServiceStatus->set_pendency_level("6");
                $returnServiceStatus->set_action_taken_time(date("Y-m-d h:i:s"));
                $returnServiceStatus->set_pending_with_officer("NA");



                $e_data = encryptString(json_encode($returnServiceStatus), $secretkey);

                $finalLoad = array(
                    "dept_id" => $dept_id,
                    "e_data" => $e_data
                );

                $response = callIspWs($url . '/ispws/isp/v1/returnServiceStatus', json_encode($finalLoad), $token);

                $Data_enc = json_decode($response)->data;

                $Data_dsc = json_encode(decryptString($Data_enc, $secretkey));
            };
        }
        if ($formType == 3) {
            DB::table('position_holder')->where('application_no', $userId)->update(['is_editable' => 1]);
            $userId = DB::table('position_holder')->where('application_no', $userId)->first()->user_id;
            $application_no = $req->formID;






            $user = DB::table('sport_welfare_registration_master')->where('id', $userId)->first();



            $isp = isp_common_detail($user->id, $user->email, 'PRIZE MONEY', $application_id);

            if ($isp) {



                $url = env('ISP_URl');

                $secretkey = env('ISP_SECRET_KEY');

                $tokenpassword = env('ISP_TOKEN_PASSWORD');
                $dept_id = env('ISP_DEPT_ID');


                $postData = array(
                    "username" =>  $dept_id,
                    "password" =>  $tokenpassword
                );



                $response = json_decode(getToken($url . '/ispws/authenticate', json_encode($postData)));

                $token = $response->token;
                $returnServiceStatus = new ReturnServiceStatus();
                $returnServiceStatus->set_applicant_id($isp->applicant_id);
                $returnServiceStatus->set_request_id($isp->request_id);
                $returnServiceStatus->set_service_code($isp->service_code);
                $returnServiceStatus->set_application_id($isp->applicant_id);
                $returnServiceStatus->set_status_code("s109");
                $returnServiceStatus->set_remarks($req->is_mark_query);
                $returnServiceStatus->set_pendency_level("6");
                $returnServiceStatus->set_action_taken_time(date("Y-m-d h:i:s"));
                $returnServiceStatus->set_pending_with_officer("NA");



                $e_data = encryptString(json_encode($returnServiceStatus), $secretkey);

                $finalLoad = array(
                    "dept_id" => $dept_id,
                    "e_data" => $e_data
                );

                $response = callIspWs($url . '/ispws/isp/v1/returnServiceStatus', json_encode($finalLoad), $token);

                $Data_enc = json_decode($response)->data;

                $Data_dsc = json_encode(decryptString($Data_enc, $secretkey));
            };
        }
        if ($formType == 4) {
            DB::table('financial_assistance')->where('application_no', $userId)->update(['is_editable' => 1]);
            $userId = DB::table('financial_assistance')->where('application_no', $userId)->first()->user_id;
            $application_no = $req->formID;







            $user = DB::table('sport_welfare_registration_master')->where('id', $userId)->first();
            $isp = isp_common_detail($user->id, $user->email, 'FINANCIAL ASSISTANCE', $application_id);

            if ($isp) {



                $url = env('ISP_URl');

                $secretkey = env('ISP_SECRET_KEY');

                $tokenpassword = env('ISP_TOKEN_PASSWORD');
                $dept_id = env('ISP_DEPT_ID');


                $postData = array(
                    "username" =>  $dept_id,
                    "password" =>  $tokenpassword
                );



                $response = json_decode(getToken($url . '/ispws/authenticate', json_encode($postData)));

                $token = $response->token;
                $returnServiceStatus = new ReturnServiceStatus();
                $returnServiceStatus->set_applicant_id($isp->applicant_id);
                $returnServiceStatus->set_request_id($isp->request_id);
                $returnServiceStatus->set_service_code($isp->service_code);
                $returnServiceStatus->set_application_id($isp->applicant_id);
                $returnServiceStatus->set_status_code("s109");
                $returnServiceStatus->set_remarks($req->is_mark_query);
                $returnServiceStatus->set_pendency_level("6");
                $returnServiceStatus->set_action_taken_time(date("Y-m-d h:i:s"));
                $returnServiceStatus->set_pending_with_officer("NA");



                $e_data = encryptString(json_encode($returnServiceStatus), $secretkey);
                $finalLoad = array(
                    "dept_id" => $dept_id,
                    "e_data" => $e_data
                );
                $response = callIspWs($url . '/ispws/isp/v1/returnServiceStatus', json_encode($finalLoad), $token);
                $Data_enc = json_decode($response)->data;
                $Data_dsc = json_encode(decryptString($Data_enc, $secretkey));
            };
        }
        if ($formType == 5) {
            DB::table('monthly_pension')->where('application_no', $userId)->update(['is_editable' => 1]);
            $userId = DB::table('monthly_pension')->where('application_no', $userId)->first()->user_id;
            $application_no = $req->formID;




            $user = DB::table('sport_welfare_registration_master')->where('id', $userId)->first();



            $isp = isp_common_detail($user->id, $user->email, 'MONTHLY PENSION', $application_id);

            if ($isp) {



                $url = env('ISP_URl');

                $secretkey = env('ISP_SECRET_KEY');

                $tokenpassword = env('ISP_TOKEN_PASSWORD');
                $dept_id = env('ISP_DEPT_ID');


                $postData = array(
                    "username" =>  $dept_id,
                    "password" =>  $tokenpassword
                );



                $response = json_decode(getToken($url . '/ispws/authenticate', json_encode($postData)));

                $token = $response->token;
                $returnServiceStatus = new ReturnServiceStatus();
                $returnServiceStatus->set_applicant_id($isp->applicant_id);
                $returnServiceStatus->set_request_id($isp->request_id);
                $returnServiceStatus->set_service_code($isp->service_code);
                $returnServiceStatus->set_application_id($isp->applicant_id);
                $returnServiceStatus->set_status_code("s109");
                $returnServiceStatus->set_remarks($req->is_mark_query);
                $returnServiceStatus->set_pendency_level("6");
                $returnServiceStatus->set_action_taken_time(date("Y-m-d h:i:s"));
                $returnServiceStatus->set_pending_with_officer("NA");



                $e_data = encryptString(json_encode($returnServiceStatus), $secretkey);

                $finalLoad = array(
                    "dept_id" => $dept_id,
                    "e_data" => $e_data
                );

                $response = callIspWs($url . '/ispws/isp/v1/returnServiceStatus', json_encode($finalLoad), $token);

                $Data_enc = json_decode($response)->data;

                $Data_dsc = json_encode(decryptString($Data_enc, $secretkey));
            };
        }
        if ($formType == 6) {

            DB::table('direct_recruitment')->where('application_no', $userId)->update(['is_editable' => 1]);
            $userId = DB::table('direct_recruitment')->where('application_no', $userId)->first()->user_id;





            $application_no = $req->formID;

            $user = DB::table('sport_welfare_registration_master')->where('id', $userId)->first();



            $isp = isp_common_detail($user->id, $user->email, 'DIRECT RECRUITMENT', $application_id);

            if ($isp) {



                $url = env('ISP_URl');

                $secretkey = env('ISP_SECRET_KEY');

                $tokenpassword = env('ISP_TOKEN_PASSWORD');
                $dept_id = env('ISP_DEPT_ID');


                $postData = array(
                    "username" =>  $dept_id,
                    "password" =>  $tokenpassword
                );



                $response = json_decode(getToken($url . '/ispws/authenticate', json_encode($postData)));

                $token = $response->token;
                $returnServiceStatus = new ReturnServiceStatus();
                $returnServiceStatus->set_applicant_id($isp->applicant_id);
                $returnServiceStatus->set_request_id($isp->request_id);
                $returnServiceStatus->set_service_code($isp->service_code);
                $returnServiceStatus->set_application_id($isp->applicant_id);
                $returnServiceStatus->set_status_code("s109");
                $returnServiceStatus->set_remarks($req->is_mark_query);
                $returnServiceStatus->set_pendency_level("6");
                $returnServiceStatus->set_action_taken_time(date("Y-m-d h:i:s"));
                $returnServiceStatus->set_pending_with_officer("NA");



                $e_data = encryptString(json_encode($returnServiceStatus), $secretkey);

                $finalLoad = array(
                    "dept_id" => $dept_id,
                    "e_data" => $e_data
                );

                $response = callIspWs($url . '/ispws/isp/v1/returnServiceStatus', json_encode($finalLoad), $token);

                $Data_enc = json_decode($response)->data;

                $Data_dsc = json_encode(decryptString($Data_enc, $secretkey));
            };
        }
        if ($formType == 7) {



            DB::table('eklavya_krida_kosh_basic_detail')->where('application_no', $userId)->update(['is_editable' => 1]);
            $userId = DB::table('eklavya_krida_kosh_basic_detail')->where('application_no', $userId)->first()->user_id;
            $application_no = $req->formID;
        }


















        //ranilaxmibai_award   laxman_award  position_holder financial_assistance
        $rsoId  = Auth::guard('admin')->user()->id;

        $dat_id = DB::table('query_master')->insertGetId(array(
            'form_type'     => $req->formType,
            'ticket_number' => $rsoId . date('mdhis'),
            'user_id'       => $userId,
            'application_no'       => $application_no,
            'rso_id'        => $rsoId,
            'query_details' => $req->is_mark_query,
            'query_subject' => $req->query_subject,
            'query_doc'     => $fileName,
        ));
        StatusChangeLog::dispatch($req->formType, $userId, "", "Query Marked", "sport_welfare_registration_master");

        return response()->json(['error' => false, 'msg' => 'Marked Query Successfully']);
    }

    public function getReplyDetails(Request $req)
    {
        $type = $req->type;
    }
    public function queryClosed(Request $req)
    {


        $id = $req->id;
        $form_type    = $req->form_type;

        $status = array('is_closed' => 1, 'closeing_date' => date("Y-m-d"));
        $queryMaster = DB::table('query_master')->where('id', $id)->first();
        StatusChangeLog::dispatch($queryMaster->form_type, $queryMaster->user_id, "", "Query Closed", "sport_welfare_registration_master");

        DB::table('query_master')->where('id', $id)->update($status);

        return response()->json(['error' => false, 'msg' => 'Query Closed Successfully']);
    }


    //filter section

    function filterData(Request $request)
    {

        $adminRole = Auth::guard('admin')->user()->admin_role;
        $direct_ass = 0;
        // dd($adminRole);
        //    $request->length=10;
        // dd($seg);
        // if ($request->ajax()) {

        // $queryData = DB::table('user_project_summary')
        //     ->join('up_investor_registration_master', 'up_investor_registration_master.id', '=', 'user_project_summary.regid')
        //     ->join('project_forwards_master', 'project_forwards_master.project_id', '=', 'user_project_summary.id')
        //     ->select('project_forwards_master.revert_remark', 'project_forwards_master.feasibility', 'project_forwards_master.is_reverted', 'project_forwards_master.forward_remark', 'user_project_summary.forwarded', 'user_project_summary.type', 'application_status', 'fullname', 'project_name', 'district', 'application_date', 'user_project_summary.project_id', 'user_project_summary.id', 'user_project_summary.project_id as p_code');

        if ($request->form_type == 1) {
            $table = "laxman_award";
            $url = "laxman_view";
        }
        if ($request->form_type == 2) {
            $table = "ranilaxmibai_award";
            $formName = "Nomination Form to Seek Reward from Government of UP";
            $name = "Laxmibai Award Applicant List";
            $url = "laxmibai_view";
        }
        if ($request->form_type == 3) {
            $table = "position_holder";
            $url = "award_view";
        }
        if ($request->form_type == 4) {
            $table = "financial_assistance";
            $url = "financial_assis_view";
        }
        if ($request->form_type == 5) {
            $table = "monthly_pension";
            $url = "monthly_pension_view";
        }
        if ($request->form_type == 6) {
            $table = "direct_recruitment";
            $url = "direct_rect_view";
        }
        if ($request->form_type == 7) {
            $table = "eklavya_krida_kosh_basic_detail";
            $url = "eklavya_krida_view";
        }
        // dd($adminRole);

        if ($request->form_type == 3 && isset($adminRole) &&  ($adminRole == 2 || $adminRole == 9)) {
            $queryData = DB::table($table)
                ->join('sport_welfare_registration_master', 'sport_welfare_registration_master.id', '=', $table . '.user_id')
                ->join('sport_type', 'sport_type.id', '=', $table . '.sport_type')
                ->select($table . '.*', 'sport_welfare_registration_master.fullname', 'sport_welfare_registration_master.permanent_district', 'sport_welfare_registration_master.email', 'sport_type.name as sportName')
                ->where($table . '.final_submit', '=', 1)
                ->where($table . '.is_forwarded_by_association', '=', 1);
        } else if ($request->form_type == 3 && isset($adminRole) &&  $adminRole == 3) {
            $queryData = DB::table($table)
                ->join('sport_welfare_registration_master', 'sport_welfare_registration_master.id', '=', $table . '.user_id')
                ->join('sport_type', 'sport_type.id', '=', $table . '.sport_type')
                ->select($table . '.*', 'sport_welfare_registration_master.fullname', 'sport_welfare_registration_master.permanent_district', 'sport_welfare_registration_master.email', 'sport_type.name as sportName')
                ->where($table . '.sport_type', '=', Auth::guard('admin')->user()->sport_type)
                ->where($table . '.final_submit', '=', 1);
        } else if ($request->form_type == 7) {

            $queryData = DB::table($table)
                ->join('sport_welfare_registration_master', 'sport_welfare_registration_master.id', '=', $table . '.user_id')
                ->join('eklavya_krida_kosh_award', 'eklavya_krida_kosh_award.user_id', '=', $table . '.user_id')
                ->join('sport_type', 'sport_type.id', '=', 'sport_welfare_registration_master.sport_type')
                ->select($table . '.*', 'sport_welfare_registration_master.fullname', 'sport_welfare_registration_master.permanent_district', 'sport_welfare_registration_master.email', 'sport_type.name as sportName')

                ->where($table . '.final_submit', '=', 1);
            if (isset($adminRole) &&  $adminRole == 2) {
                $div_id = Auth::guard('admin')->user()->division_id;
                $dis_t = DB::table('hostel_div_district_mapping')->where('division_id', $div_id)->pluck('district_id')
                    ->toArray();

                $queryData->where(function ($query) use ($table) {
                    $query->where($table . '.is_forwarded_by_association', '>=', 1)
                        ->orWhere(function ($subQuery) use ($table) {
                            $subQuery->whereIn('eklavya_krida_kosh_award.competition_name', [6, 9, 10, 14])
                                ->orWhereIn($table . '.qualification', ['diploma', 'researcher']);
                        });
                });
                $queryData->whereIn('sport_welfare_registration_master.permanent_district', $dis_t);
            } elseif (isset($adminRole) &&  $adminRole == 9) {
                $queryData->where($table . '.is_forwarded_by_association', '>=', 1);
                $queryData->where('sport_welfare_registration_master.permanent_district', Auth::guard('admin')->user()->district_id);
            } elseif (isset($adminRole) &&  $adminRole == 17) {
                $queryData->where($table . '.is_forwarded_by_rso', '>=', 1);
                $queryData->where($table . '.is_editable', '=', 2);

                // $queryData->where('sport_welfare_registration_master.permanent_district', Auth::guard('admin')->user()->district_id);
            }
        } else if ($request->form_type == 6 && isset($adminRole) && ($adminRole == 4 || $adminRole == 1  || $adminRole == 18  || $adminRole == 8 || $adminRole == 3 || $adminRole == 11)) {
            $direct_ass = 1;
            $queryData = DB::table($table)
                ->join('sport_welfare_registration_master', 'sport_welfare_registration_master.id', '=', $table . '.user_id')
                ->join('direct_recruitment_sport_achievement', 'direct_recruitment_sport_achievement.application_no', '=', $table . '.application_no')
                ->join('applicant_post_master', 'applicant_post_master.application_no', '=', $table . '.application_no')
                ->join('sport_type', 'sport_type.id', '=', 'sport_welfare_registration_master.sport_type')
                // ->join('applicant_post_master', 'applicant_post_master.user_id', '=', $table.'.user_id')
                ->select('sport_welfare_registration_master.fullname', 'sport_welfare_registration_master.email', 'sport_welfare_registration_master.permanent_district', $table . '.*', 'sport_type.name as sportName');
            if ($request->seg4 != "") {
                $queryData->where('applicant_post_master.post_name', $request->seg);
                if ($request->seg4 == 11) {
                    $queryData->where($table . '.gender', '=', 'Male');
                }
                if ($request->seg4 == 12) {
                    $queryData->where($table . '.gender', '=', 'Female');
                }
                if ($request->seg4 == 13) {
                    $queryData->where($table . '.is_forwarded_by_rso', '!=', '');
                }
                if ($request->seg4 == 14) {
                    $queryData->where($table . '.is_forwarded_by_rso', '=', 4);
                }
            }
            // dd(Auth::guard('admin')->user()->admin_role);
            $queryData->where($table . '.final_submit', '=', 1);
            // $queryData = DB::table($table)
            // ->join('sport_welfare_registration_master', 'sport_welfare_registration_master.id', '=', $table.'.user_id')
            // ->join('sport_type', 'sport_type.id', '=', $table.'.sport_type')
            // ->select($table.'.*', 'sport_welfare_registration_master.fullname', 'sport_welfare_registration_master.email', 'sport_type.name as sportName')
            // ->where($table.'.final_submit','=', 1)
            // ->where($table.'.is_forwarded_by_association','=', 1);
            if (Auth::guard('admin')->user()->admin_role == 3) {
                // dd("gfdg");
                $direct_ass = 1;
                if ($request->form_type == 6) {
                    $queryData->where($table . '.is_forwarded_by_rso', '>=', 4)->where('sport_welfare_registration_master.sport_type', '=', Auth::guard('admin')->user()->sport_type);
                } elseif ($request->form_type == 7) {
                    $queryData->where($table . '.is_forwarded_by_rso', '!=', 0)->where('sport_welfare_registration_master.sport_type', '=', Auth::guard('admin')->user()->sport_type);
                } else {

                    $queryData->where($table . '.is_forwarded_by_rso', '!=', 0)->where($table . '.sport_type', '=', Auth::guard('admin')->user()->sport_type);
                }
            }

            // dd(Auth::guard('admin')->user()->admin_role);
            if (Auth::guard('admin')->user()->admin_role == 3 && $request->form_type != 6)
                $queryData->where($table . '.is_forwarded_by_rso', '>=', 1);
            if ($request->form_type == 6  && Auth::guard('admin')->user()->admin_role == 8) {
                $queryData->where($table . '.is_forwarded_by_rso', '>=', 1);
            } elseif (Auth::guard('admin')->user()->admin_role == 8) {
                $queryData->where($table . '.is_forwarded_by_rso', '>=', 3);
            }
        } else {

            $queryData = DB::table($table)
                ->join('sport_welfare_registration_master', 'sport_welfare_registration_master.id', '=', $table . '.user_id')
                ->join('sport_type', 'sport_type.id', '=', $table . '.sport_type')
                ->select($table . '.*', 'sport_welfare_registration_master.fullname', 'sport_welfare_registration_master.email', 'sport_welfare_registration_master.permanent_district', 'sport_type.name as sportName')
                ->where($table . '.final_submit', '=', 1);
        }

        if (Auth::guard('admin')->user()->admin_role == 3) {
            if ($request->form_type == 7) {
                $queryData->where('sport_welfare_registration_master.sport_type', '=', Auth::guard('admin')->user()->sport_type);
                $queryData->whereNotIn('eklavya_krida_kosh_award.competition_name', [6, 9, 10, 14]);
                $queryData->whereNotIn($table . '.qualification', ['diploma', 'researcher']);
            } elseif ($request->form_type != 6) {
                $queryData->where($table . '.sport_type', '=', Auth::guard('admin')->user()->sport_type);
            }
        }
        if ($request->seg == 3) {
            if ($request->form_type == 6) {
                if (Auth::guard('admin')->user()->admin_role == 8) {
                    $queryData->where($table . '.is_forwarded_by_rso', '>=', 1);
                } elseif (Auth::guard('admin')->user()->admin_role == 11) {
                    $queryData->where($table . '.is_forwarded_by_rso', '>=', 1);
                } elseif (Auth::guard('admin')->user()->admin_role == 1) {
                    $queryData->where($table . '.is_forwarded_by_rso', '>=', 2);
                } elseif (Auth::guard('admin')->user()->admin_role == 3) {
                    $queryData->where($table . '.is_forwarded_by_rso', '>=', 3);
                }
            } else {
                $queryData->where($table . '.is_forwarded_by_rso', '=', 1);
            }
        }

        if (Auth::guard('admin')->user()->admin_role == 17 && ($request->form_type == 1 || $request->form_type == 2)) {
            $queryData->where($table . '.is_forwarded_by_rso', '>=', 1);
        }


        if ($request->from_date != '')
            $queryData->whereDate($table . '.created_at', '>=', ymd($request->from_date));

        if ($request->to_date != '')
            $queryData->whereDate($table . '.created_at', '<=', ymd($request->to_date));

        if ($request->from_date != '' && $request->to_date != '')
            $queryData->whereBetween($table . '.created_at', [ymd($request->from_date), ymd($request->to_date)]);

        if ($request->status_filter != '')
            $queryData->where($table . '.form_status', "$request->status_filter");

        if ($request->project_filter != '') {
            if ($request->form_type == 6 || $request->form_type == 7) {
                $queryData->where('sport_welfare_registration_master.sport_type', "$request->project_filter");
            } else {
                $queryData->where($table . '.sport_type', "$request->project_filter");
            }
        }
        // new filter for direct

        if ($request->sports_comp != '') {
            $queryData->where('direct_recruitment_sport_achievement.sport_event', "$request->sports_comp");
        }
        if ($request->post_name != '') {
            $queryData->where('applicant_post_master.post_name', "$request->post_name");
        }
        if ($request->position_medal != '') {
            $queryData->where('direct_recruitment_sport_achievement.medal', "$request->position_medal");
        }


        if ($request->comp_from_date != '') {
            $time = strtotime($request->comp_from_date);
            $newformat = date('Y-m-d', $time);
            // $queryData->whereDate('direct_recruitment_sport_achievement.competition_to_date','<=',"$newformat");
            $queryData->whereRaw(" DATE_FORMAT(STR_TO_DATE(`competition_from_date`,'%d-%m-%Y'), '%Y-%m-%d') >='$newformat'");
            // $queryData->whereDate(STR_TO_DATE('direct_recruitment_sport_achievement.competition_from_date','%d-%m-%Y'),'>=',dmy($request->comp_from_date));
        }
        if ($request->comp_to_date != '') {
            $time = strtotime($request->comp_to_date);
            $newformat = date('Y-m-d', $time);
            $queryData->whereRaw(" DATE_FORMAT(STR_TO_DATE(`competition_from_date`,'%d-%m-%Y'), '%Y-%m-%d') <='$newformat'");

            // $queryData->whereDate('direct_recruitment_sport_achievement.competition_to_date','<=',dmy($request->comp_to_date));

        }
        if ($request->comp_from_date != '' && $request->comp_to_date != '') {
            $timee = strtotime($request->comp_from_date);
            $from_date = date('Y-m-d', $timee);
            $time = strtotime($request->comp_to_date);
            $to_date = date('Y-m-d', $time);
            $queryData->whereRaw(" DATE_FORMAT(STR_TO_DATE(`competition_from_date`,'%d-%m-%Y'), '%Y-%m-%d') >='$from_date' AND DATE_FORMAT(STR_TO_DATE(`competition_from_date`,'%d-%m-%Y'), '%Y-%m-%d') <='$to_date'");
        }


        // end

        if ($request->city_filter != '') {
            if (Auth::guard('admin')->user()->admin_role == 4) {
                $queryData->where('direct_recruitment.permanent_district', $request->city_filter);
            } else {
                $queryData->where('sport_welfare_registration_master.permanent_district', $request->city_filter);
            }
        }


        if ($request->from_date == '' && ($request->form_type == 1 || $request->form_type == 2)) {
            $queryData->whereDate($table . '.created_at', '>=', ymd('01-01-' . config('app.session_year')));
        }

        if ($request->search != '') {

            $this->searchColumn = '%' . $request->search . '%';
            $this->tableName = $table;
            $queryData->where(function ($query) {
                if (Auth::guard('admin')->user()->admin_role == 4) {
                    $query->where('direct_recruitment.fullname', 'like', $this->searchColumn);
                } else {
                    $query->where('sport_welfare_registration_master.fullname', 'like', $this->searchColumn);
                }
                $query->orWhere($this->tableName . '.id', 'like', $this->searchColumn);
                $query->orWhere($this->tableName . '.application_no', 'like', $this->searchColumn);
                $query->orWhere($this->tableName . '.created_at', 'like', $this->searchColumn);
            });
        }
        $queryData->groupBy($table . '.id');
        $queryData->orderBy($table . '.id', 'DESC');

        // $collection = $queryData->paginate(10);
        // dd($queryData->count());
        // if($request->lenght =="all"){
        //     $collection = $queryData->paginate($queryData->count());
        // }
        // else{
        //     $collection = $queryData->paginate($request->lenght);
        // }
        // $queryData->dd();

        $form_type1 = $request->form_type;
        $collection = $queryData->paginate($request->lenght);
        // dd($collection);
        return view('rso.dashboard.applicant_render_list', compact('collection', 'url', 'form_type1', 'direct_ass'))->render();
        // }
    }

    // delete login detail code by anu
    public function delete_login_history(Request $req)
    {

        if ($req->email) {
            if (DB::table('admin')->where('email', $req->email)->where('is_login', 1)->exists()) {
                DB::table('session')->where('email', $req->email)->delete();
                DB::table('admin')->where('email', $req->email)->update([
                    "is_login" => 0,
                    "ip_address" => request()->ip()
                ]);
                return response()->json(['error' => false, 'msg' => "User Login Data delete."]);
            } else {
                return response()->json(['error' => true, 'msg' => "User Not Logged In."]);
            }
        } else {
            return view('admin.flush_login');
        }
    }

    // delete login detail code by anu


    public function save_query_for_supporting_document(Request $req)
    {

        $application_no = $req->user_id;
        $form_type    = $req->form_type;

        $query_doc_by_admin = '';
        if ($req->hasFile('query_doc_by_admin'))
            $query_doc_by_admin = moveFile('query_doc_by_admin', $req->query_doc_by_admin);


        $status = array('notificationBy' => Auth::guard('admin')->user()->admin_role);
        // $status['notificationBy'] =Auth::guard('admin')->user()->admin_role;
        if ($form_type == 1) {
            DB::table('laxman_award')->where('application_no', $application_no)->update($status);
            DB::table('mark_query_comment')->insert([
                'sender_id' => Auth::guard('admin')->user()->id,
                'reciever_id' => $req->sender_id,
                'application_no' => $req->user_id,
                'comments' => $req->remark,
                'doc' => $query_doc_by_admin,
                'type' => 1,
            ]);
        }
        if ($form_type == 2) {
            DB::table('ranilaxmibai_award')->where('application_no', $application_no)->update($status);
            DB::table('mark_query_comment')->insert([
                'sender_id' => Auth::guard('admin')->user()->id,
                'reciever_id' => $req->sender_id,
                'application_no' => $req->user_id,
                'comments' => $req->remark,
                'doc' => $query_doc_by_admin,
                'type' => 1,
            ]);
        }
        if ($form_type == 3) {

            DB::table('position_holder')->where('application_no', $application_no)->update($status);
            DB::table('mark_query_comment')->insert([
                'sender_id' => Auth::guard('admin')->user()->id,
                'reciever_id' => $req->sender_id,
                'application_no' => $req->user_id,
                'comments' => $req->remark,
                'doc' => $query_doc_by_admin,
                'type' => 1,
            ]);
        }

        if ($form_type == 4) {
            DB::table('financial_assistance')->where('application_no', $application_no)->update($status);
            DB::table('mark_query_comment')->insert([
                'sender_id' => Auth::guard('admin')->user()->id,
                'reciever_id' => $req->sender_id,
                'application_no' => $req->user_id,
                'comments' => $req->remark,
                'doc' => $query_doc_by_admin,
                'type' => 1,
            ]);
        }
        if ($form_type == 5) {
            DB::table('monthly_pension')->where('application_no', $application_no)->update($status);
            DB::table('mark_query_comment')->insert([
                'sender_id' => $req->reciever_id,
                'reciever_id' => $req->sender_id,
                'application_no' => $req->user_id,
                'comments' => $req->remark,
                'doc' => $query_doc_by_admin,
                'type' => 1
            ]);
        }
        if ($form_type == 6) {
            DB::table('mark_query_comment')->insert([
                'sender_id' => Auth::guard('admin')->user()->id,
                'reciever_id' => $req->sender_id,
                'application_no' => $req->user_id,
                'comments' => $req->remark,
                'doc' => $query_doc_by_admin,
                'type' => 1,
            ]);
            DB::table('direct_recruitment')->where('application_no', $application_no)->update([
                'notificationBy' => Auth::guard('admin')->user()->admin_role
            ]);
        }
        if ($form_type == 7) {
            DB::table('eklavya_krida_kosh_basic_detail')->where('application_no', $application_no)->update($status);
            DB::table('mark_query_comment')->insert([
                'sender_id' => Auth::guard('admin')->user()->id,
                'reciever_id' => $req->sender_id,
                'application_no' => $req->user_id,
                'comments' => $req->remark,
                'doc' => $query_doc_by_admin,
                'type' => 1,
            ]);
        }
        return redirect()->back()->with('success', 'Query Marked Successfully');
    }
    public function query_reply_for_supporting_document(Request $req)
    {

        // dd($req->all());
        $application_no = $req->user_id;
        $form_type    = $req->form_type;

        $verification_document = '';
        if ($req->hasFile('forward_verification_document'))
            $verification_document = moveFile('verification_document', $req->forward_verification_document);


        $status = array(
            'forward_remark' => $req->remark,
            'forward_verification_document' => $verification_document
        );

        if ($form_type == 1) {
            $status['notificationBy'] = Auth::guard('admin')->user()->admin_role;
            DB::table('laxman_award')->where('application_no', $application_no)->update($status);
            DB::table('mark_query_comment')->insert([
                'sender_id' => $req->reciever_id,
                'reciever_id' => $req->sender_id,
                'application_no' => $req->user_id,
                'comments' => $req->remark,
                'doc' => $verification_document,
                'type' => 2
            ]);
        }

        if ($form_type == 2) {
            $status['notificationBy'] = Auth::guard('admin')->user()->admin_role;
            DB::table('ranilaxmibai_award')->where('application_no', $application_no)->update($status);
            DB::table('mark_query_comment')->insert([
                'sender_id' => $req->reciever_id,
                'reciever_id' => $req->sender_id,
                'application_no' => $req->user_id,
                'comments' => $req->remark,
                'doc' => $verification_document,
                'type' => 2
            ]);
        }

        if ($form_type == 3) {
            // if(Auth::guard('admin')->user()->admin_role == 1)
            // $ttt=1;
            // if($req->is_rso==1){
            //     DB::table('position_holder')->where('application_no', $application_no)->update([
            //     'notificationBy' =>Auth::guard('admin')->user()->admin_role
            //     ]);
            // }elseif($req->is_rso==3){
            //     DB::table('position_holder')->where('application_no', $application_no)->update([
            //     'query_remark_by_rso' => $req->remark,
            //     'query_doc_by_rso' => $verification_document,
            //     'notificationBy' =>Auth::guard('admin')->user()->admin_role
            //     ]);
            // }
            // else{
            $status['notificationBy'] = Auth::guard('admin')->user()->admin_role;
            DB::table('position_holder')->where('application_no', $application_no)->update($status);
            DB::table('mark_query_comment')->insert([
                'sender_id' => $req->reciever_id,
                'reciever_id' => $req->sender_id,
                'application_no' => $req->user_id,
                'comments' => $req->remark,
                'doc' => $verification_document,
                'type' => 2
            ]);
            // }
        }

        if ($form_type == 4) {
            $status['notificationBy'] = Auth::guard('admin')->user()->admin_role;
            DB::table('financial_assistance')->where('application_no', $application_no)->update($status);
            DB::table('mark_query_comment')->insert([
                'sender_id' => $req->reciever_id,
                'reciever_id' => $req->sender_id,
                'application_no' => $req->user_id,
                'comments' => $req->remark,
                'doc' => $verification_document,
                'type' => 2
            ]);
        }
        if ($form_type == 5) {
            $status['notificationBy'] = Auth::guard('admin')->user()->admin_role;
            DB::table('monthly_pension')->where('application_no', $application_no)->update($status);
            DB::table('mark_query_comment')->insert([
                'sender_id' => $req->reciever_id,
                'reciever_id' => $req->sender_id,
                'application_no' => $req->user_id,
                'comments' => $req->remark,
                'doc' => $verification_document,
                'type' => 2
            ]);
        }
        if ($form_type == 6) {
            DB::table('mark_query_comment')->insert([
                'sender_id' => $req->reciever_id,
                'reciever_id' => $req->sender_id,
                'application_no' => $req->user_id,
                'comments' => $req->remark,
                'doc' => $verification_document,
                'type' => 2
            ]);
            DB::table('direct_recruitment')->where('application_no', $application_no)->update([
                'notificationBy' => Auth::guard('admin')->user()->admin_role
            ]);
        }

        return redirect()->back()->with('success', 'Replied Marked Successfully');
    }
}


class ISPApplicantData
{

    public $request_id;
    public  $dept_id;
}

class ISPRequestData
{

    public  $dept_id;
    public  $e_data;
}

class ISPRequestedDataResponse
{

    public  $error;
    public  $statusMessage;
    public  $data;
    public  $timestamp;

    public function set_data($data)
    {
        $this->data = $data;
    }
    public function get_data()
    {
        return $this->data;
    }

    public function set_error($error)
    {
        $this->error = $error;
    }
    public function get_error()
    {
        return $this->error;
    }

    public function set_statusMessage($statusMessage)
    {
        $this->statusMessage = $statusMessage;
    }
    public function get_statusMessage()
    {
        return $this->statusMessage;
    }

    public function set_timestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    }
    public function get_timestamp()
    {
        return $this->timestamp;
    }
}

class ISPRequestIdData
{

    public  $request_id;
    public  $applicant_id;
    public  $service_code;
    public  $request_validated;

    public function set_request_id($request_id)
    {
        $this->request_id = $request_id;
    }
    public function get_request_id()
    {
        return $this->request_id;
    }

    public function set_applicant_id($applicant_id)
    {
        $this->applicant_id = $applicant_id;
    }
    public function get_applicant_id()
    {
        return $this->applicant_id;
    }

    public function set_service_code($service_code)
    {
        $this->service_code = $service_code;
    }
    public function get_service_code()
    {
        return $this->service_code;
    }
}

class ISPRequestValidate
{

    public  $sessionkey;
    public  $dept_id;
}

class ISPResponseApplicantData
{

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
class ReturnDeliveredServiceStatus
{

    public $request_id;
    public $applicant_id;
    public $application_id;

    public $service_code;

    public $status_code;
    public $remarks;

    public $action_taken_time;
    // public $pending_with_officer;
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


    public $certificate_expiry_date;
    public $certificate_no;
    public $certificate_url;
    public $dbt_amount;

    public function certificate_url($certificate_url)
    {
        $this->certificate_url = $certificate_url;
    }

    public function dbt_amount($dbt_amount)
    {
        $this->dbt_amount = $dbt_amount;
    }
    public function certificate_no($certificate_no)
    {
        $this->certificate_no = $certificate_no;
    }


    public function designated_code($designated_code)
    {
        $this->designated_code = $designated_code;
    }
    public function designated_location_code($designated_location_code)
    {
        $this->designated_location_code = $designated_location_code;
    }


    public function designated_target_date($designated_target_date)
    {
        $this->designated_target_date = $designated_target_date;
    }


    public function set_request_id($request_id)
    {
        $this->request_id = $request_id;
    }

    public function getRequest_id()
    {
        return $this->request_id;
    }

    public function set_applicant_id($applicant_id)
    {
        $this->applicant_id = $applicant_id;
    }

    public function certificate_expiry_date($certificate_expiry_date)
    {
        $this->certificate_expiry_date = $certificate_expiry_date;
    }
    function get_applicant_id()
    {
        return $this->applicant_id;
    }

    public function set_service_code($service_code)
    {
        $this->service_code = $service_code;
    }
    public function get_service_code()
    {
        return $this->service_code;
    }

    public function set_application_id($application_id)
    {
        $this->application_id = $application_id;
    }
    public function get_application_id()
    {
        return $this->application_id;
    }



    public function set_status_code($status_code)
    {
        $this->status_code = $status_code;
    }
    public function get_status_code()
    {
        return $this->status_code;
    }

    public function set_remarks($remarks)
    {
        $this->remarks = $remarks;
    }
    public function get_remarks()
    {
        return $this->remarks;
    }

    public function set_pendency_level($pendency_level)
    {
        $this->pendency_level = $pendency_level;
    }
    public function get_pendency_level()
    {
        return $this->pendency_level;
    }

    public function set_action_taken_time($action_taken_time)
    {
        $this->action_taken_time = $action_taken_time;
    }
    public function get_action_taken_time()
    {
        return $this->action_taken_time;
    }

    // public function set_pending_with_officer($pending_with_officer) {
    //      $this->pending_with_officer = $pending_with_officer;
    //   }

    public function selected_district_for_processing_application($selected_district_for_processing_application)
    {
        $this->selected_district_for_processing_application = $selected_district_for_processing_application;
    }
}

class ReturnServiceStatus
{

    public $request_id;
    public $applicant_id;

    public $service_code;
    public $application_id;
    public $status_code;
    public $remarks;

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


    public $certificate_expiry_date;
    public $certificate_no;
    public $certificate_url;
    public $dbt_amount;

    public function certificate_no($certificate_no)
    {
        $this->certificate_no = $certificate_no;
    }
    public function certificate_url($certificate_url)
    {
        $this->certificate_url = $certificate_url;
    }
    public function dbt_amount($dbt_amount)
    {
        $this->dbt_amount = $dbt_amount;
    }

    public function designated_code($designated_code)
    {
        $this->designated_code = $designated_code;
    }
    public function designated_location_code($designated_location_code)
    {
        $this->designated_location_code = $designated_location_code;
    }


    public function designated_target_date($designated_target_date)
    {
        $this->designated_target_date = $designated_target_date;
    }


    public function set_request_id($request_id)
    {
        $this->request_id = $request_id;
    }

    public function getRequest_id()
    {
        return $this->request_id;
    }

    public function set_applicant_id($applicant_id)
    {
        $this->applicant_id = $applicant_id;
    }

    public function certificate_expiry_date($certificate_expiry_date)
    {
        $this->certificate_expiry_date = $certificate_expiry_date;
    }
    function get_applicant_id()
    {
        return $this->applicant_id;
    }

    public function set_service_code($service_code)
    {
        $this->service_code = $service_code;
    }
    public function get_service_code()
    {
        return $this->service_code;
    }

    public function set_application_id($application_id)
    {
        $this->application_id = $application_id;
    }
    public function get_application_id()
    {
        return $this->application_id;
    }

    public function set_status_code($status_code)
    {
        $this->status_code = $status_code;
    }
    public function get_status_code()
    {
        return $this->status_code;
    }

    public function set_remarks($remarks)
    {
        $this->remarks = $remarks;
    }
    public function get_remarks()
    {
        return $this->remarks;
    }

    public function set_pendency_level($pendency_level)
    {
        $this->pendency_level = $pendency_level;
    }
    public function get_pendency_level()
    {
        return $this->pendency_level;
    }

    public function set_action_taken_time($action_taken_time)
    {
        $this->action_taken_time = $action_taken_time;
    }
    public function get_action_taken_time()
    {
        return $this->action_taken_time;
    }

    public function set_pending_with_officer($pending_with_officer)
    {
        $this->pending_with_officer = $pending_with_officer;
    }

    public function selected_district_for_processing_application($selected_district_for_processing_application)
    {
        $this->selected_district_for_processing_application = $selected_district_for_processing_application;
    }
}

class ISPToken
{

    public $username;
    public $password;
}

class ISPTokenResponse
{

    public $token;
    public $error;
    public $statusMessage;
    public $timestamp;

    public function set_token($token)
    {
        $this->token = $token;
    }
    public function get_token()
    {
        return $this->token;
    }

    public function set_error($error)
    {
        $this->error = $error;
    }
    public function get_error()
    {
        return $this->error;
    }

    public function set_statusMessage($statusMessage)
    {
        $this->statusMessage = $statusMessage;
    }
    public function get_statusMessage()
    {
        return $this->statusMessage;
    }

    public function set_timestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    }
    public function get_timestamp()
    {
        return $this->timestamp;
    }

    //   code for flush login history by anu



}
