<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Models\Adminuser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProjectExport;
use PDF;
use DateTime;

use App\Imports\DataImports;

class AdminDashboard extends Controller
{
    public $searchColumn;
    public $tableName;
    public $queryCollection;


    //   public function __construct(Request $request)
    //  {

    //    $current_date = new DateTime();

    //    // Comparison date (10-10-2025)
    //    $comparison_date = new DateTime('2025-10-10');

    //    // Set both dates to midnight (just the date comparison)
    //    $current_date->setTime(0, 0); // Set the current date to midnight
    //    $comparison_date->setTime(0, 0); // Set the comparison date to midnight

    //    // Compare the dates
    //    if ($current_date > $comparison_date) {
    //       echo view('coming-soon');
    //       exit;
    //    }
    //  }

    public function dashboard()
    {
        // dd(Auth::guard('admin')->user()->admin_role);
        if (Auth::guard('admin')->user()->admin_role == 3) {
            $financial = DB::Select("SELECT COUNT(CASE WHEN final_submit = 1 THEN 1 END) as total,COUNT(CASE WHEN is_forwarded_by_rso = 1 THEN 1 END) as total_app_forward,COUNT(CASE WHEN form_status = 0 THEN 1 END) as total_pending,COUNT(CASE WHEN form_status = 1 THEN 1 END) as total_accepted,COUNT(CASE WHEN form_status = 2 THEN 1 END) as total_rejected from financial_assistance WHERE 1 AND final_submit = 1 AND sport_type = '" . Auth::guard('admin')->user()->sport_type . "'");
        } else {
            $financial = DB::Select("SELECT COUNT(CASE WHEN final_submit = 1 THEN 1 END) as total,COUNT(CASE WHEN is_forwarded_by_rso = 1 THEN 1 END) as total_app_forward,COUNT(CASE WHEN form_status = 0 THEN 1 END) as total_pending,COUNT(CASE WHEN form_status = 1 THEN 1 END) as total_accepted,COUNT(CASE WHEN form_status = 2 THEN 1 END) as total_rejected from financial_assistance WHERE 1 AND final_submit = 1");
        }
        if (Auth::guard('admin')->user()->admin_role == 3) {
            $monthly = DB::Select("SELECT COUNT(CASE WHEN final_submit = 1 THEN 1 END) as total,COUNT(CASE WHEN is_forwarded_by_rso = 1 THEN 1 END) as total_app_forward,COUNT(CASE WHEN form_status = 0 THEN 1 END) as total_pending,COUNT(CASE WHEN form_status = 1 THEN 1 END) as total_accepted,COUNT(CASE WHEN form_status = 2 THEN 1 END) as total_rejected from monthly_pension WHERE 1 AND final_submit = 1  AND sport_type = '" . Auth::guard('admin')->user()->sport_type . "'");
        } else {
            $monthly = DB::Select("SELECT COUNT(CASE WHEN final_submit = 1 THEN 1 END) as total,COUNT(CASE WHEN is_forwarded_by_rso = 1 THEN 1 END) as total_app_forward,COUNT(CASE WHEN form_status = 0 THEN 1 END) as total_pending,COUNT(CASE WHEN form_status = 1 THEN 1 END) as total_accepted,COUNT(CASE WHEN form_status = 2 THEN 1 END) as total_rejected from monthly_pension WHERE 1 AND final_submit = 1");
        }

        if (Auth::guard('admin')->user()->admin_role == 8) {
            $direct = DB::Select("SELECT COUNT(CASE WHEN final_submit = 1 THEN 1 END) as total,COUNT(CASE WHEN is_forwarded_by_rso >= 1 THEN 1 END) as total_app_forward,COUNT(CASE WHEN form_status = 0 THEN 1 END) as total_pending,COUNT(CASE WHEN form_status = 1 THEN 1 END) as total_accepted,COUNT(CASE WHEN form_status = 2 THEN 1 END) as total_rejected from direct_recruitment WHERE 1 AND final_submit = 1 AND is_forwarded_by_rso >= 1 ");
        } else if (Auth::guard('admin')->user()->admin_role == 3) {
            // $direct = DB::Select("SELECT COUNT(CASE WHEN final_submit = 1 THEN 1 END) as total,COUNT(CASE WHEN is_forwarded_by_rso = 4 THEN 1 END) as total_app_forward,COUNT(CASE WHEN form_status = 0 THEN 1 END) as total_pending,COUNT(CASE WHEN form_status = 1 THEN 1 END) as total_accepted,COUNT(CASE WHEN form_status = 2 THEN 1 END) as total_rejected from direct_recruitment WHERE 1 AND final_submit = 1 AND is_forwarded_by_rso >= 1  ");
            $direct = DB::Select("SELECT COUNT(CASE WHEN final_submit = 1 THEN 1 END) as total,COUNT(CASE WHEN is_forwarded_by_rso >= 5 THEN 1 END) as total_app_forward,COUNT(CASE WHEN form_status = 0 THEN 1 END) as total_pending,COUNT(CASE WHEN form_status = 1 THEN 1 END) as total_accepted,COUNT(CASE WHEN form_status = 2 THEN 1 END) as total_rejected from direct_recruitment join sport_welfare_registration_master on direct_recruitment.user_id=sport_welfare_registration_master.id WHERE 1 AND final_submit = 1 AND is_forwarded_by_rso >= 4  AND sport_welfare_registration_master.sport_type = '" . Auth::guard('admin')->user()->sport_type . "'");
        } else if (Auth::guard('admin')->user()->admin_role == 4) {
            $direct = DB::Select("SELECT COUNT(CASE WHEN final_submit = 1 THEN 1 END) as total,COUNT(CASE WHEN is_forwarded_by_rso >= 1 THEN 1 END) as total_app_forward,COUNT(CASE WHEN form_status = 0 THEN 1 END) as total_pending,COUNT(CASE WHEN form_status = 1 THEN 1 END) as total_accepted,COUNT(CASE WHEN form_status = 2 THEN 1 END) as total_rejected from direct_recruitment WHERE 1 AND final_submit = 1 ");
        } else if (Auth::guard('admin')->user()->admin_role == 11) {
            $direct = DB::Select("SELECT COUNT(CASE WHEN final_submit = 1 THEN 1 END) as total,COUNT(CASE WHEN is_forwarded_by_rso >= 1 THEN 1 END) as total_app_forward,COUNT(CASE WHEN form_status = 0 THEN 1 END) as total_pending,COUNT(CASE WHEN form_status = 1 THEN 1 END) as total_accepted,COUNT(CASE WHEN form_status = 2 THEN 1 END) as total_rejected from direct_recruitment WHERE 1 AND final_submit = 1");
        } else {
            $direct = DB::Select("SELECT COUNT(CASE WHEN final_submit = 1 THEN 1 END) as total,COUNT(CASE WHEN is_forwarded_by_rso >= 3 THEN 1 END) as total_app_forward,COUNT(CASE WHEN form_status = 0 THEN 1 END) as total_pending,COUNT(CASE WHEN form_status = 1 THEN 1 END) as total_accepted,COUNT(CASE WHEN form_status = 2 THEN 1 END) as total_rejected from direct_recruitment WHERE 1 AND final_submit = 1");
        }

        if (Auth::guard('admin')->user()->admin_role == 3) {
            $laxman = DB::Select("SELECT COUNT(CASE WHEN final_submit = 1 THEN 1 END) as total,COUNT(CASE WHEN is_forwarded_by_rso = 1 THEN 1 END) as total_app_forward,COUNT(CASE WHEN form_status = 0 THEN 1 END) as total_pending,COUNT(CASE WHEN form_status = 1 THEN 1 END) as total_accepted,COUNT(CASE WHEN form_status = 2 THEN 1 END) as total_rejected from laxman_award WHERE 1 AND final_submit = 1  AND sport_type = '" . Auth::guard('admin')->user()->sport_type . "' AND created_at >= '" . config('app.session_year') . "-01-01'");
        } else if (Auth::guard('admin')->user()->admin_role == 17) {
            $laxman = DB::Select("SELECT COUNT(CASE WHEN final_submit = 1 THEN 1 END) as total,COUNT(CASE WHEN is_forwarded_by_rso = 1 THEN 1 END) as total_app_forward,COUNT(CASE WHEN form_status = 0 THEN 1 END) as total_pending,COUNT(CASE WHEN form_status = 1 THEN 1 END) as total_accepted,COUNT(CASE WHEN form_status = 2 THEN 1 END) as total_rejected from laxman_award WHERE 1 AND final_submit = 1  AND is_forwarded_by_rso >= 1 AND created_at >= '" . config('app.session_year') . "-01-01'");
        } else {
            $laxman = DB::Select("SELECT COUNT(CASE WHEN final_submit = 1 THEN 1 END) as total,COUNT(CASE WHEN is_forwarded_by_rso = 1 THEN 1 END) as total_app_forward,COUNT(CASE WHEN form_status = 0 THEN 1 END) as total_pending,COUNT(CASE WHEN form_status = 1 THEN 1 END) as total_accepted,COUNT(CASE WHEN form_status = 2 THEN 1 END) as total_rejected from laxman_award WHERE 1 AND final_submit = 1 AND created_at >= '" . config('app.session_year') . "-01-01'");
        }

        if (Auth::guard('admin')->user()->admin_role == 3) {
            $ranilaxmibai = DB::Select("SELECT COUNT(CASE WHEN final_submit = 1 THEN 1 END) as total,COUNT(CASE WHEN is_forwarded_by_rso = 1 THEN 1 END) as total_app_forward,COUNT(CASE WHEN form_status = 0 THEN 1 END) as total_pending,COUNT(CASE WHEN form_status = 1 THEN 1 END) as total_accepted,COUNT(CASE WHEN form_status = 2 THEN 1 END) as total_rejected from ranilaxmibai_award WHERE 1 AND final_submit = 1  AND sport_type = '" . Auth::guard('admin')->user()->sport_type . "' AND created_at >= '" . config('app.session_year') . "-01-01'");
        } else if (Auth::guard('admin')->user()->admin_role == 3) {
            $ranilaxmibai = DB::Select("SELECT COUNT(CASE WHEN final_submit = 1 THEN 1 END) as total,COUNT(CASE WHEN is_forwarded_by_rso = 1 THEN 1 END) as total_app_forward,COUNT(CASE WHEN form_status = 0 THEN 1 END) as total_pending,COUNT(CASE WHEN form_status = 1 THEN 1 END) as total_accepted,COUNT(CASE WHEN form_status = 2 THEN 1 END) as total_rejected from ranilaxmibai_award WHERE 1 AND final_submit = 1  AND is_forwarded_by_rso >= 1 AND created_at >= '" . config('app.session_year') . "-01-01'");
        } else {
            $ranilaxmibai = DB::Select("SELECT COUNT(CASE WHEN final_submit = 1 THEN 1 END) as total,COUNT(CASE WHEN is_forwarded_by_rso = 1 THEN 1 END) as total_app_forward,COUNT(CASE WHEN form_status = 0 THEN 1 END) as total_pending,COUNT(CASE WHEN form_status = 1 THEN 1 END) as total_accepted,COUNT(CASE WHEN form_status = 2 THEN 1 END) as total_rejected from ranilaxmibai_award WHERE 1 AND final_submit = 1 AND created_at >= '" . config('app.session_year') . "-01-01'");
        }

        $onlineAdmission = DB::Select("SELECT COUNT(CASE WHEN sub.payment_status = 1 THEN 1 END) AS total, COUNT(CASE WHEN sub.final_status = 1 THEN 1 END) AS total_pending, COUNT(CASE WHEN sub.final_status = 2 THEN 1 END) AS total_accepted, COUNT(CASE WHEN sub.final_status = 3 THEN 1 END) AS total_rejected FROM ( SELECT DISTINCT rg.id, rg.payment_status, rg.final_status FROM admission_registration_login AS rg INNER JOIN online_admission_payment_response_details AS ps ON ps.user_id = rg.id WHERE rg.payment_status = 1 AND rg.session_year = '" . config('app.session_year') . "' AND ps.status = 'success' ) AS sub");

        $hostelapplicant = DB::Select("SELECT COUNT(CASE WHEN payment_status = 1 OR payment_status = 2 THEN 1 END) as total ,COUNT(CASE WHEN status = 3 ANd payment_status = 2 THEN 1 END) as total_pending,COUNT(CASE WHEN status = 1 ANd payment_status = 2 THEN 1 END) as total_accepted,COUNT(CASE WHEN status = 2 ANd payment_status = 2 THEN 1 END) as total_rejected from hostel_register WHERE 1 AND level = 4");

        $players = DB::Select("SELECT COUNT(CASE WHEN status_preview = 2  THEN 1 END) as total ,COUNT(CASE WHEN status_preview = 2 and application_status = 1   THEN 1 END) as total_pending,COUNT(CASE WHEN status_preview = 2  and application_status = 3  THEN 1 END) as total_accepted,COUNT(CASE WHEN status_preview = 3 and application_status = 2  THEN 1 END) as total_rejected from player_coach_registration WHERE type = 1");
        $coaches = DB::Select("SELECT COUNT(CASE WHEN status_preview = 2  THEN 1 END) as total ,COUNT(CASE WHEN status_preview = 2 and application_status = 1   THEN 1 END) as total_pending,COUNT(CASE WHEN status_preview = 2  and application_status = 3  THEN 1 END) as total_accepted,COUNT(CASE WHEN status_preview = 3 and application_status = 2  THEN 1 END) as total_rejected from player_coach_registration WHERE type = 2");

        // $position = DB::Select("SELECT COUNT(CASE WHEN final_submit = 1 THEN 1 END) as total,COUNT(CASE WHEN is_forwarded_by_rso = 1 THEN 1 END) as total_app_forward,COUNT(CASE WHEN form_status = 0 THEN 1 END) as total_pending,COUNT(CASE WHEN form_status = 1 THEN 1 END) as total_accepted,COUNT(CASE WHEN form_status = 2 THEN 1 END) as total_rejected from position_holder WHERE 1 AND final_submit = 1");
        if (Auth::guard('admin')->user()->admin_role == 2) {

            $position = DB::Select("SELECT COUNT(CASE WHEN final_submit = 1 THEN 1 END) as total,COUNT(CASE WHEN is_forwarded_by_rso = 1 THEN 1 END) as total_app_forward,COUNT(CASE WHEN form_status = 0 THEN 1 END) as total_pending,COUNT(CASE WHEN form_status = 1 THEN 1 END) as total_accepted,COUNT(CASE WHEN form_status = 2 THEN 1 END) as total_rejected from position_holder WHERE 1 AND final_submit = 1 AND is_forwarded_by_association = 1");
        } else if (Auth::guard('admin')->user()->admin_role == 3) {
            $position = DB::Select("SELECT COUNT(CASE WHEN final_submit = 1 THEN 1 END) as total,COUNT(CASE WHEN is_forwarded_by_rso = 1 THEN 1 END) as total_app_forward,COUNT(CASE WHEN form_status = 0 THEN 1 END) as total_pending,COUNT(CASE WHEN form_status = 1 THEN 1 END) as total_accepted,COUNT(CASE WHEN form_status = 2 THEN 1 END) as total_rejected from position_holder WHERE 1 AND final_submit = 1 AND sport_type = '" . Auth::guard('admin')->user()->sport_type . "'");
        } else {
            $position = DB::Select("SELECT COUNT(CASE WHEN final_submit = 1 THEN 1 END) as total,COUNT(CASE WHEN is_forwarded_by_rso = 1 THEN 1 END) as total_app_forward,COUNT(CASE WHEN form_status = 0 THEN 1 END) as total_pending,COUNT(CASE WHEN form_status = 1 THEN 1 END) as total_accepted,COUNT(CASE WHEN form_status = 2 THEN 1 END) as total_rejected from position_holder WHERE 1 AND final_submit = 1");
        }

        //
        if (Auth::guard('admin')->user()->admin_role == 2) {
            $div_id = Auth::guard('admin')->user()->division_id;
            $dis_t = DB::table('hostel_div_district_mapping')->where('division_id', $div_id)->pluck('district_id')
                ->toArray();
            if (empty($dis_t)) {
                $dis_t_str = '(-1)';
            } else {
                $dis_t_str = '(' . implode(',', $dis_t) . ')';
            }
            $eklavya = DB::Select("SELECT COUNT(DISTINCT CASE WHEN final_submit = 1 THEN eklavya_krida_kosh_basic_detail.id END) as total,
            COUNT(DISTINCT CASE WHEN is_forwarded_by_rso = 1 THEN eklavya_krida_kosh_basic_detail.id END) as total_app_forward,
            COUNT(DISTINCT CASE WHEN form_status = 0 THEN eklavya_krida_kosh_basic_detail.id END) as total_pending,
            COUNT(DISTINCT CASE WHEN form_status = 1 THEN eklavya_krida_kosh_basic_detail.id END) as total_accepted,
            COUNT(DISTINCT CASE WHEN form_status = 2 THEN eklavya_krida_kosh_basic_detail.id END) as total_rejected from eklavya_krida_kosh_basic_detail
            join sport_welfare_registration_master on eklavya_krida_kosh_basic_detail.user_id=sport_welfare_registration_master.id
            join eklavya_krida_kosh_award on eklavya_krida_kosh_basic_detail.user_id=eklavya_krida_kosh_award.user_id
            WHERE 1 AND final_submit = 1 AND ( is_forwarded_by_association = 1  OR (competition_name IN (6, 9, 10, 14) OR qualification IN ('diploma', 'researcher') ) ) and sport_welfare_registration_master.permanent_district IN $dis_t_str ");
        } else if (Auth::guard('admin')->user()->admin_role == 3) {
            $eklavya = DB::select(
                "SELECT
        COUNT(DISTINCT CASE WHEN final_submit = 1 THEN eklavya_krida_kosh_basic_detail.user_id END) as total,
        COUNT(DISTINCT CASE WHEN is_forwarded_by_rso = 1 THEN eklavya_krida_kosh_basic_detail.user_id END) as total_app_forward,
        COUNT(DISTINCT CASE WHEN form_status = 0 THEN eklavya_krida_kosh_basic_detail.user_id END) as total_pending,
        COUNT(DISTINCT CASE WHEN form_status = 1 THEN eklavya_krida_kosh_basic_detail.user_id END) as total_accepted,
        COUNT(DISTINCT CASE WHEN form_status = 2 THEN eklavya_krida_kosh_basic_detail.user_id END) as total_rejected
     FROM eklavya_krida_kosh_basic_detail
     JOIN sport_welfare_registration_master
       ON eklavya_krida_kosh_basic_detail.user_id = sport_welfare_registration_master.id
     JOIN eklavya_krida_kosh_award
       ON eklavya_krida_kosh_basic_detail.user_id = eklavya_krida_kosh_award.user_id
     WHERE final_submit = 1
       AND competition_name NOT IN (6, 9, 10, 14)
       AND qualification NOT IN ('diploma', 'researcher')
       AND sport_welfare_registration_master.sport_type = ?",
                [Auth::guard('admin')->user()->sport_type]  // Parameter binding for security
            );
        } else if (Auth::guard('admin')->user()->admin_role == 9) {
            $eklavya = DB::Select("SELECT COUNT(CASE WHEN final_submit = 1 THEN eklavya_krida_kosh_basic_detail.id END) as total,
         COUNT(DISTINCT CASE WHEN is_forwarded_by_rso = 1 THEN eklavya_krida_kosh_basic_detail.id END) as total_app_forward,
         COUNT(DISTINCT CASE WHEN form_status = 0 THEN eklavya_krida_kosh_basic_detail.id END) as total_pending,
         COUNT(DISTINCT CASE WHEN form_status = 1 THEN eklavya_krida_kosh_basic_detail.id END) as total_accepted,
         COUNT(DISTINCT CASE WHEN form_status = 2 THEN eklavya_krida_kosh_basic_detail.id END) as total_rejected from eklavya_krida_kosh_basic_detail join sport_welfare_registration_master on eklavya_krida_kosh_basic_detail.user_id=sport_welfare_registration_master.id
         join eklavya_krida_kosh_award on eklavya_krida_kosh_basic_detail.user_id=eklavya_krida_kosh_award.user_id
         WHERE 1 AND final_submit = 1 AND is_forwarded_by_association = 1 OR (competition_name IN (6, 9, 10, 14) OR qualification IN ('diploma', 'researcher') ) and sport_welfare_registration_master.permanent_district = '" . Auth::guard('admin')->user()->district_id . "'");
        } else if (Auth::guard('admin')->user()->admin_role == 17) {
            $eklavya = DB::Select("SELECT COUNT(CASE WHEN final_submit = 1 THEN 1 END) as total,
         COUNT(CASE WHEN is_forwarded_by_rso >= 1 THEN 1 END) as total_app_forward,
         COUNT(CASE WHEN form_status = 0 THEN 1 END) as total_pending,
         COUNT(CASE WHEN form_status = 1 THEN 1 END) as total_accepted,
         COUNT(CASE WHEN form_status = 2 THEN 1 END) as total_rejected from eklavya_krida_kosh_basic_detail
         join sport_welfare_registration_master on eklavya_krida_kosh_basic_detail.user_id=sport_welfare_registration_master.id
         WHERE 1 AND final_submit = 1 AND is_forwarded_by_rso >= 1 AND  is_editable=2");
            // $eklavya = DB::Select("SELECT COUNT(CASE WHEN final_submit = 1 THEN 1 END) as total,COUNT(CASE WHEN is_forwarded_by_rso >= 1 THEN 1 END) as total_app_forward,COUNT(CASE WHEN form_status = 0 THEN 1 END) as total_pending,COUNT(CASE WHEN form_status = 1 THEN 1 END) as total_accepted,COUNT(CASE WHEN form_status = 2 THEN 1 END) as total_rejected from eklavya_krida_kosh_basic_detail join sport_welfare_registration_master on eklavya_krida_kosh_basic_detail.user_id=sport_welfare_registration_master.id WHERE 1 AND final_submit = 1 AND is_forwarded_by_rso >= 1");
        } else {
            $eklavya  = DB::Select("SELECT COUNT(CASE WHEN final_submit = 1 THEN 1 END) as total,COUNT(CASE WHEN form_status = 0 THEN 1 END) as total_pending,COUNT(CASE WHEN form_status = 1 THEN 1 END) as total_accepted,COUNT(CASE WHEN form_status = 2 THEN 1 END) as total_rejected from eklavya_krida_kosh_basic_detail  WHERE 1 AND final_submit = 1  ");
        }
        // $eklavya  = DB::Select("SELECT COUNT(CASE WHEN final_submit = 1 THEN 1 END) as total,COUNT(CASE WHEN form_status = 0 THEN 1 END) as total_pending,COUNT(CASE WHEN form_status = 1 THEN 1 END) as total_accepted,COUNT(CASE WHEN form_status = 2 THEN 1 END) as total_rejected from eklavya_krida_kosh_basic_detail  WHERE 1 AND final_submit = 1  ");

        $cities = DB::table('cities')->where('state_id', 23)->orderBy('city', 'ASC')->get();

        $coaching_camp = DB::Select("SELECT COUNT(CASE WHEN coaching_camp_basic_details.final_submit = 1 THEN 1 END) as total ,COUNT(CASE WHEN coaching_camp_basic_details.final_submit = 2 THEN 1 END) as total_pending,COUNT(CASE WHEN coaching_camp_basic_details.final_submit = 3 THEN 1 END) as total_accepted,COUNT(CASE WHEN coaching_camp_basic_details.final_submit = 4 THEN 1 END) as total_rejected from coaching_camp_register LEFT JOIN coaching_camp_basic_details ON coaching_camp_basic_details.user_id=coaching_camp_register.id WHERE coaching_camp_basic_details.final_submit = 1");


        $broadcast_list =   DB::table('broadcasting')
            ->leftJoin('admin_mail_composer', 'admin_mail_composer.id', '=', 'broadcasting.mail_id')
            ->select('admin_mail_composer.*', 'broadcasting.*', 'broadcasting.id as idd')
            ->where('admin_mail_composer.type', 2)
            ->where('broadcasting.message_read', 1)
            ->where('broadcasting.user_id', Auth::guard('admin')->user()->id)
            ->orderByDesc('broadcasting.id')
            ->get();



        return view('admin.dashboard.dashboard', compact('direct', 'cities', 'financial', 'monthly', 'laxman', 'ranilaxmibai', 'position', 'onlineAdmission', 'hostelapplicant', 'players', 'coaches', 'broadcast_list', 'eklavya', 'coaching_camp'));
    }

    public function user_manager()
    {
        $users = DB::table('admin')->orderBy('id', 'DESC')->get();
        return view('admin.user.userslist', compact('users'));
    }
    public function user_manager_add()
    {

        $roles = DB::table('urm_role_manager')->where('role_status', 1)->orderBy('role_name', 'ASC')->get();
        $districts = DB::table('cities')->select('city', 'id')->where('state_id', '23')->get();
        $divisions = DB::table('hostel_division_master')->orderBy('id', 'ASC')->get();
        // dd($divisions);
        $profile = new Adminuser();
        $sports = DB::table('sport_type')->select('name', 'id')->where('status', '1')->get();
        return view('admin.user.add_user', compact('roles', 'profile', 'sports', 'districts', 'divisions'));
    }
    public function edituser($id)
    {

        $roles = DB::table('urm_role_manager')->where('role_status', 1)->orderBy('role_name', 'ASC')->get();
        $item = DB::table('admin')->where('id', $id)->first();
        $sports = DB::table('sport_type')->select('name', 'id')->where('status', '1')->get();
        $districts = DB::table('cities')->select('city', 'id')->where('state_id', '23')->get();
        $divisions = DB::table('hostel_division_master')->select('division_name', 'id')->where('status', '1')->get();
        return view('admin.user.edituser', compact('roles', 'item', 'sports', 'divisions', 'districts'));
    }
    public function user_manager_update(Request $req)
    {

        $validation = Validator::make($req->all(), [
            'rolename' => 'required',
            'name' => 'required',
            'username' => 'required',
            // 'email'             => 'sometimes|unique:admin|required|email',
            'email' => 'required|email|unique:admin,email,' . $req->id,
            'mobile' => 'required|numeric|digits:10',
            'status' => 'required',
            'designation' => 'required',

        ], msg());

        if ($validation->fails())
            return redirect()->back()->withInput($req->all())->with('error', $validation->errors()->first());
        //   return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        $status = array('admin_role' => $req->rolename, 'name' => $req->name, 'username' => $req->username, 'email' => $req->email, 'mobile' => $req->mobile, 'status' => $req->status, 'designation' => $req->designation, 'sport_type' => $req->sport_type, 'division_id' => $req->division_name, 'district_id' => $req->district_name, 'password' => Hash::make($req->password), 'user_password' => $req->password);

        if ($req->id) {
            $check = DB::table('admin')->where('id', $req->id)->update($status);
            $msg = "Successfully Updated.";
        } else {
            $check = DB::table('admin')->insertGetId($status);
            $msg = "Successfully Submited.";
        }
        // return response()->json(["error" => false, "msg" => "SuccessFully Submited", "url" => route('userslist')]);

        return redirect('/admin/user_manager ')->with('success', $msg);
    }

    public function userRolePageManagement(Request $req)
    {

        $module = $req->module;
        $role = $req->role;
        $user = $req->user;
        $checked = $req->checked;

        // $role_module = $this->admin_model->getDataOrderBy('urm_role_module_mapping', array('module_id' => $module, 'role_id' => $role), 'id');
        if ($checked == 1) {
            $role_module = DB::table('urm_role_module_mapping')->where('module_id', $module)->where('role_id', $role)->orderBy('id', 'DESC')->get();
        }
        if ($checked == 2) {
            $role_module = DB::table('urm_role_module_mapping')->where('module_id', $module)->where('user_id', $user)->orderBy('id', 'DESC')->get();
        }
        // $role_module = DB::table('urm_role_module_mapping')->where('module_id', $module)->where('role_id', $role)->orderBy('id', 'DESC')->get();

        $module_pages = DB::table('urm_page_manager')->where('module_id', $module)->orderBy('id', 'DESC')->get();
        // $module_pages = $this->admin_model->getDataOrderBy('urm_page_manager', array('module_id' => $module), 'id');

        $result['role_module'] = $role_module;
        $result['module_pages'] = $module_pages;
        echo json_encode($result);
        //print_r($result); exit;
    }

    public function urm_role_module_mapping(Request $req)
    {

        $validation = Validator::make($req->all(), [
            'modulename' => 'required',
            'page_module.*' => 'required',

        ], msg());

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
        $module = $req->modulename;
        $role_id = $req->role_id;
        $user_id = $req->user_id;
        $page_module = $req->page_module;
        // $this->admin_model->delete_row('urm_role_module_mapping', array('role_id' => $role, 'module_id' => $module));
        // dd($req->all());
        if ($req->optradio == 2) {
            DB::table('urm_role_module_mapping')->where('module_id', $module)->where('user_id', $user_id)->delete();
            $users = DB::table('admin')->select('admin_role')->where('id', $user_id)->first();
            // dd($users->admin_role);
            foreach ($page_module as $key => $item) {
                DB::table('urm_role_module_mapping')->insert([
                    'module_id' => $module,
                    'user_id' => $user_id,
                    'page_id' => $item,
                    'role_id' => $users->admin_role
                ]);
            }
        }
        if ($req->optradio == 1) {
            DB::table('urm_role_module_mapping')->where('module_id', $module)->where('role_id', $role_id)->delete();
            $users = DB::table('admin')->select('id')->where('admin_role', $role_id)->get();

            foreach ($users as $key => $user) {

                foreach ($page_module as $key => $item) {
                    DB::table('urm_role_module_mapping')->insert([
                        'module_id' => $module,
                        'user_id' => $user->id,
                        'page_id' => $item,
                        'role_id' => $role_id
                    ]);
                }
            }
        }
        return response()->json(["error" => false, "msg" => "SuccessFully Submited"]);
    }

    public function user_access_details()
    {

        $modules = DB::table('urm_module_manager')->where('module_status', '=', 1)->orderBy('id', 'DESC')->get();
        $users = DB::table('admin')->where('status', '=', 1)->orderBy('id', 'DESC')->get();
        foreach ($users as $user) {

            foreach ($modules as $module) {
                $role_modules = DB::table('urm_role_module_mapping')->where('urm_role_module_mapping.user_id', $user->id)->where('urm_role_module_mapping.module_id', '=', $module->id)->get();
                if ($role_modules) {
                    $i = 0;
                    // $adminData[$user->name][$module->id] = [];
                    foreach ($role_modules as $role_module) {
                        // dd($adminData);
                        $adminData[$user->name][$module->id]['module_name'] = $module->module_name;
                        $adminData[$user->name][$module->id]['module_url'] = $module->module_url;
                        $adminData[$user->name][$module->id]['menu_icon'] = $module->menu_icon;
                        $adminData[$user->name][$module->id]['dor'] = $role_module->dor;
                        $adminData[$user->name][$module->id]['updated_by'] = "tdsd";
                        $adminData[$user->name][$module->id]['user_id'] = $user->id;
                        $adminData[$user->name][$module->id]['pages'][] = DB::table('urm_page_manager')->where('id', $role_module->page_id)->orderBy('id', 'DESC')->first();
                        $i++;
                    }
                }
            }
        }
        $data = $adminData;

        return view('admin.user.user_access_details', compact('data'));
    }

    public function post_master(Request $req)
    {

        $modules = DB::table('advertisment_post_master')->orderBy('id', 'DESC')->get();



        //          foreach ($modules as $module) {
        //             // dd($module);
        //             $role_modules = DB::table('advertisment_post_master')->where('advertisment_post_master.advertisment_no','=', $module->advertisment_no)->get();
        //             if ($role_modules) {
        //                $i = 0;
        //                // $adminData[$user->name][$module->id] = [];
        //                foreach ($role_modules as $role_module) {
        //                   // dd($adminData);
        //                   $adminData[$module->advertisment_no][$module->id]['post_name']= $module->post_name;
        //                   $adminData[$module->advertisment_no][$module->id]['start_date']= $module->start_date;
        //                   $adminData[$module->advertisment_no][$module->id]['end_date']= $module->end_date;
        //                   $adminData[$module->advertisment_no][$module->id]['adevertisment_doc'] = $module->adevertisment_doc;
        //                   $i++;
        //                }
        //             }
        //          }
        //   $data = $adminData;
        //   dd($adminData);
        $post_list = DB::table('advertisment_post_master')->orderBy('id', 'DESC')->get();
        return view('admin.user.post_master', compact('post_list'));
    }
    public function post_master_add(Request $req)
    {
        if ($req->post('post_category')) {
            $validation = Validator::make($req->all(), [
                'post_category' => 'required',
                'advertisment_no' => 'required',
                'basic_pay' => 'required',
                // 'sport_type.*' => 'required',
                // 'end_date' => 'required',
                // 'post_name' => 'required',
                // 'total_post' => 'required|numeric',
                // 'general_post' => 'required',
                // 'obc_post' => 'required',
                // 'sc_post' => 'required',
                // 'st_post' => 'required',
                // 'ews_post' => 'required',
                // 'pwd_post' => 'required',
                // 'min_age' => 'required',
                // 'max_age' => 'required',
                // 'min_age_from' => 'required',
                // 'min_qualification' => 'required',
                // 'adevertisment_doc' => 'nullable|mimes:pdf,png,jpg,jpeg|max:2000',

            ], msg());
            if ($validation->fails())
                // return redirect()->back()->withInput($req->all())->with('error', $validation->errors()->first());
                return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
            if ($req->adevertisment_doc) {
                $adevertisment_doc = date('His') . $req->adevertisment_doc->getClientOriginalName();
                $path = $req->file('adevertisment_doc')->storeAs('adevertisment_doc', $adevertisment_doc, 'public');
            } else {
                $adevertisment_doc = $req->adevertisment_doc1;
            }

            $status = [
                'post_category' => $req->post_category,
                'advertisment_no' => $req->advertisment_no,
                // 'sport_type' => implode(",", $req->sport_type),
                'sport_type' => 0,
                // 'start_date' => chu($req->start_date),
                // 'end_date' => chu($req->end_date),
                'basic_pay' => $req->basic_pay,
                'post_name' => $req->post_name,
                'total_post' => $req->total_post,
                'general_post' => $req->general_post,
                'obc_post' => $req->obc_post,
                'sc_post' => $req->sc_post,
                'st_post' => $req->st_post,
                'ews_post' => $req->ews_post,
                'pwd_post' => $req->pwd_post,
                // 'min_age' => $req->min_age,
                // 'max_age' => $req->max_age,
                // 'min_age_from' => chu($req->min_age_from),
                // 'is_age_relaxation' => $req->is_age_relaxation,
                // 'age_relax_obc' => $req->age_relax_obc,
                // 'adevertisment_doc' => $adevertisment_doc,
                // 'age_relax_sc' => $req->age_relax_sc,
                // 'age_relax_st' => $req->age_relax_st,
                // 'age_relax_ews' => $req->age_relax_ews,
                // 'age_relax_pwd' => $req->age_relax_pwd,
                // 'min_qualification' => $req->min_qualification,
                // 'is_experience_required' => $req->experience_required,
                // 'exp_req' => $req->exp_req,
            ];

            if ($req->id) {
                $check = DB::table('advertisment_post_master')->where('id', $req->id)->update($status);
                $msg = "Successfully Updated.";
            } else {
                $check = DB::table('advertisment_post_master')->insertGetId($status);
                $msg = "Successfully Submited.";
            }

            return response()->json(["error" => false, "msg" => "SuccessFully Submited", "url" => route('post_master')]);

            //  return redirect('/admin/userslist')->with('success', $msg);
        }
        $sport_type = DB::table('sport_type')->orderBy('name', 'ASC')->get();
        return view('admin.user.add_post', compact('sport_type'));
    }
    public function editpost($id)
    {

        $post = DB::table('advertisment_post_master')->where('id', $id)->first();
        $sport_type = DB::table('sport_type')->get();

        $spo = explode(",", $post->sport_type);
        // $spo=array(1,2,3);
        //  dd(explode(",",$post->sport_type));
        return view('admin.user.edit_post', compact('post', 'sport_type', 'spo'));
    }
    public function deletePostMaster($id)
    {
        DB::table('advertisment_post_master')->where('id', '=', $id)->delete();
        return redirect()->back()->with("success", "Post Successfully Deleted.");
    }

    public function adminprofile()
    {


        return view('admin.profile');
    }


    public function exportExcel(Request $request)
    {
        // dd($request->all());
        $adminRole = Auth::guard('admin')->user()->admin_role;
        if ($request->form_type == 1) {
            $table = "laxman_award";
            $name = "Laxman Award Applicant List";
        }
        if ($request->form_type == 2) {
            $table = "ranilaxmibai_award";
            $formName = "Nomination Form to Seek Reward from Government of UP";
            $name = "Laxmibai Award Applicant List";
        }
        if ($request->form_type == 3) {
            $table = "position_holder";
            $name = "Position Holder Applicant List";
        }
        if ($request->form_type == 4) {
            $table = "financial_assistance";
            $name = "Financial Assistance Applicant List";
        }
        if ($request->form_type == 5) {
            $table = "monthly_pension";
            $name = "Monthly Pension Applicant List";
        }
        if ($request->form_type == 6) {
            $table = "direct_recruitment";
            $name = "Direct Recruitment Applicant List";
        }
        if ($request->form_type == 7) {
            $table = "eklavya_krida_kosh_basic_detail";
            $formName = "Application Form of Eklavya Krida Kosh";
            $name = "Eklavya Krida Kosh Applicant List";
        }

        if ($request->form_type == 3 && Auth::guard('admin')->user()->admin_role == 2) {
            $queryData = DB::table($table)
                ->join('sport_welfare_registration_master', 'sport_welfare_registration_master.id', '=', $table . '.user_id')
                ->join('sport_type', 'sport_type.id', '=', $table . '.sport_type')
                ->select($table . '.*', 'sport_welfare_registration_master.fullname', 'sport_welfare_registration_master.father_name', 'sport_welfare_registration_master.email', 'sport_welfare_registration_master.permanent_district', 'sport_welfare_registration_master.permanent_address', 'sport_welfare_registration_master.mobile', 'sport_type.name as sportName')
                ->where($table . '.final_submit', '=', 1)
                ->where($table . '.is_forwarded_by_association', '=', 1);
        } else if ($request->form_type == 7) {

            $queryData = DB::table($table)
                ->join('sport_welfare_registration_master', 'sport_welfare_registration_master.id', '=', $table . '.user_id')
                ->join('sport_type', 'sport_type.id', '=', 'sport_welfare_registration_master.sport_type')
                ->select($table . '.*', 'sport_welfare_registration_master.fullname', 'sport_welfare_registration_master.father_name', 'sport_welfare_registration_master.email', 'sport_welfare_registration_master.permanent_district', 'sport_welfare_registration_master.permanent_address', 'sport_welfare_registration_master.mobile', 'sport_type.name as sportName')

                ->where($table . '.final_submit', '=', 1);
        }
        //  else if($request->form_type == 6 && Auth::guard('admin')->user()->admin_role == 4){

        //     $queryData = DB::table($table)
        //     ->join('sport_type', 'sport_type.id', '=', $table.'.sport_type')
        //     ->select($table.'.*', 'sport_type.name as sportName')
        //     ->where($table.'.final_submit','=', 1);

        //  }
        else if ($request->form_type == 6 && isset($adminRole) && ($adminRole == 4 || $adminRole == 1 || $adminRole == 8 || $adminRole == 3)) {

            // $queryData = DB::table($table)
            // ->join('sport_welfare_registration_master', 'sport_welfare_registration_master.id', '=', $table.'.user_id')
            // ->join('sport_type', 'sport_type.id', '=', 'sport_welfare_registration_master.sport_type')
            // // ->join('applicant_post_master', 'applicant_post_master.user_id', '=', $table.'.user_id')
            // ->select($table.'.*', 'sport_type.name as sportName');
            $queryData = DB::table($table)
                ->join('sport_welfare_registration_master', 'sport_welfare_registration_master.id', '=', $table . '.user_id')
                ->join('direct_recruitment_sport_achievement', 'direct_recruitment_sport_achievement.application_no', '=', $table . '.application_no')
                ->join('applicant_post_master', 'applicant_post_master.application_no', '=', $table . '.application_no')
                ->join('sport_type', 'sport_type.id', '=', 'sport_welfare_registration_master.sport_type')
                // ->join('applicant_post_master', 'applicant_post_master.user_id', '=', $table.'.user_id')
                ->select('sport_welfare_registration_master.*', $table . '.*', 'sport_type.name as sportName');
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
            $queryData->where($table . '.final_submit', '=', 1);
            if (Auth::guard('admin')->user()->admin_role == 3) {
                $direct_ass = 1;
                if ($request->form_type == 6 || $request->form_type == 7) {
                    $queryData->where($table . '.is_forwarded_by_rso', '!=', 0)->where('sport_welfare_registration_master.sport_type', '=', Auth::guard('admin')->user()->sport_type);
                } else {
                    $queryData->where($table . '.is_forwarded_by_rso', '!=', 0)->where($table . '.sport_type', '=', Auth::guard('admin')->user()->sport_type);
                }
            }
            if (Auth::guard('admin')->user()->admin_role == 4)
                $queryData->where($table . '.is_forwarded_by_rso', '=', 4);
        } else {
            $queryData = DB::table($table)
                ->join('sport_welfare_registration_master', 'sport_welfare_registration_master.id', '=', $table . '.user_id')
                ->join('sport_type', 'sport_type.id', '=', $table . '.sport_type')
                ->select($table . '.*', 'sport_welfare_registration_master.fullname', 'sport_welfare_registration_master.email', 'sport_welfare_registration_master.father_name', 'sport_welfare_registration_master.permanent_district', 'sport_welfare_registration_master.permanent_address', 'sport_welfare_registration_master.mobile', 'sport_type.name as sportName')
                ->where($table . '.final_submit', '=', 1);
        }
        if (Auth::guard('admin')->user()->admin_role == 3) {

            if ($request->form_type == 6 || $request->form_type == 7) {
                $queryData->where('sport_welfare_registration_master.sport_type', '=', Auth::guard('admin')->user()->sport_type);
            } else {
                $queryData->where($table . '.sport_type', '=', Auth::guard('admin')->user()->sport_type);
            }
        }
        if ($request->seg == 3)
            $queryData->where($table . '.is_forwarded_by_rso', '=', 1);

        if ($request->from_date != '') {
            $queryData->whereDate($table . '.created_at', '>=', ymd($request->from_date));
            $data['from_date'] = dmy($request->from_date);
        } else {
            $data['from_date'] = "01-04-2023";
        }


        if ($request->to_date != '') {
            $queryData->whereDate($table . '.created_at', '<=', ymd($request->to_date));
            $data['to_date'] = dmy($request->to_date);
        } else {
            $data['to_date'] = date('d-m-Y');
        }

        // if ($request->from_date != '' )
        //     $queryData->whereDate($table.'.created_at','>=',ymd($request->from_date));

        // if ($request->to_date != '')
        // $queryData->whereDate($table.'.created_at','<=',ymd($request->to_date));

        if ($request->from_date != '' && $request->to_date != '')
            $queryData->whereBetween($table . '.created_at', [ymd($request->from_date), ymd($request->to_date)]);

        if ($request->status_filter != '')
            $queryData->where($table . '.form_status', "$request->status_filter");

        if ($request->project_filter != '')
            $queryData->where($table . '.sport_type', "$request->project_filter");

        if ($request->city_filter != '') {
            if (Auth::guard('admin')->user()->admin_role == 4) {
                $queryData->where('direct_recruitment.permanent_district', $request->city_filter);
            } else {
                $queryData->where('sport_welfare_registration_master.permanent_district', $request->city_filter);
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
        if ($request->from_date == '' && ($request->form_type == 1 || $request->form_type == 2)) {
            $queryData->whereDate($table . '.created_at', '>=', ymd('01-01-' . config('app.session_year')));
        }
        $queryData->orderBy($table . '.id', 'DESC');
        $queryData->groupBy($table . '.id');
        // $queryData->dd();
        // $collection = $queryData->paginate($request->lenght);
        $collection = $queryData->get();
        $name  = $name . date('m-d-Y') . '.xlsx';
        $type = $request->form_type;
        // return view('exports.sheetExcel', compact('collection','formName','data','type'));
        return Excel::download(new ProjectExport($type, $collection, $data), $name);
    }
    public function exportPdf(Request $request)
    {


        $adminRole = Auth::guard('admin')->user()->admin_role;
        if ($request->form_type == 1) {
            $table = "laxman_award";
            $formName = "Online Registration of Players and Coaches (Govt. & Pvt.)";
            $name = "List of Applicants who applied for Laxman Award";
            $report_code = "OR004";
            $row_count = 5;
        }
        if ($request->form_type == 2) {
            $table = "ranilaxmibai_award";
            $formName = "Online Registration of Players and Coaches (Govt. & Pvt.)";
            $name = "List of Applicants who  applied for Rani Laxmibai Award";
            $report_code = "OR005";
            $row_count = 5;
        }
        if ($request->form_type == 3) {
            $table = "position_holder";
            $formName = "Online Registration of Players and Coaches (Govt. & Pvt.)";
            $name = "List of Applicants who applied for Prize Money";
            $report_code = "OR006";
            $row_count = 5;
        }
        if ($request->form_type == 4) {
            $table = "financial_assistance";
            $formName = "Online Registration of Players and Coaches (Govt. & Pvt.)";
            $name = "List of Applicants who applied for Financial Assistance";
            $report_code = "OR002";
            $row_count = 5;
        }
        if ($request->form_type == 5) {
            $table = "monthly_pension";
            $formName = "Online Registration of Players and Coaches (Govt. & Pvt.)";
            $name = "List of Applicants who applied for Monthly Pension";
            $report_code = "OR003";
            $row_count = 5;
        }
        if ($request->form_type == 6) {
            $table = "direct_recruitment";
            $formName = "Online Registration of Players and Coaches (Govt. & Pvt.)";
            $name = "List of Applicants who applied for Direct Recruitment as Gazetted Officer";
            $report_code = "OR001";
            $row_count = 4;
        }
        if ($request->form_type == 7) {
            $table = "eklavya_krida_kosh_basic_detail";
            $formName = "Monitoring System  for Eklavya krida Scheme and Welfare Fund";
            $name = "List of Applicants who applied for Eklavya Krida Kosh";
            $report_code = "EK001";
            $row_count = 5;
        }

        if ($request->form_type == 3 && Auth::guard('admin')->user()->admin_role == 2) {
            $queryData = DB::table($table)
                ->join('sport_welfare_registration_master', 'sport_welfare_registration_master.id', '=', $table . '.user_id')
                ->join('sport_type', 'sport_type.id', '=', $table . '.sport_type')
                ->select($table . '.*', 'sport_welfare_registration_master.fullname', 'sport_welfare_registration_master.father_name', 'sport_welfare_registration_master.email', 'sport_type.name as sportName', 'sport_welfare_registration_master.permanent_district', 'sport_welfare_registration_master.permanent_address', 'sport_welfare_registration_master.mobile')
                ->where($table . '.final_submit', '=', 1)
                ->where($table . '.is_forwarded_by_association', '=', 1);
        }
        // else if($request->form_type == 6 && Auth::guard('admin')->user()->admin_role == 4){

        //    $queryData = DB::table($table)
        //    ->join('sport_type', 'sport_type.id', '=', $table.'.sport_type')
        //    ->select($table.'.*', 'sport_type.name as sportName')
        //    ->where($table.'.final_submit','=', 1);

        // }
        else if ($request->form_type == 7) {

            $queryData = DB::table($table)
                ->join('sport_welfare_registration_master', 'sport_welfare_registration_master.id', '=', $table . '.user_id')
                ->join('sport_type', 'sport_type.id', '=', 'sport_welfare_registration_master.sport_type')
                ->select($table . '.*', 'sport_welfare_registration_master.fullname', 'sport_welfare_registration_master.father_name', 'sport_welfare_registration_master.email', 'sport_type.name as sportName', 'sport_welfare_registration_master.permanent_district', 'sport_welfare_registration_master.permanent_address', 'sport_welfare_registration_master.mobile')

                ->where($table . '.final_submit', '=', 1);

            if (isset($adminRole) &&  $adminRole == 2) {
                $div_id = Auth::guard('admin')->user()->division_id;
                $dis_t = DB::table('hostel_div_district_mapping')->where('division_id', $div_id)->pluck('district_id')
                    ->toArray();

                $queryData->where($table . '.is_forwarded_by_association', '>=', 1);
                $queryData->whereIn('sport_welfare_registration_master.permanent_district', $dis_t);
            } elseif (isset($adminRole) &&  $adminRole == 9) {
                $queryData->where($table . '.is_forwarded_by_association', '>=', 1);
                $queryData->where('sport_welfare_registration_master.permanent_district', Auth::guard('admin')->user()->district_id);
            } elseif (isset($adminRole) &&  $adminRole == 17) {
                $queryData->where($table . '.is_forwarded_by_rso', '>=', 1);
                // $queryData->where('sport_welfare_registration_master.permanent_district', Auth::guard('admin')->user()->district_id);
            }
        } else if ($request->form_type == 6 && isset($adminRole) && ($adminRole == 4 || $adminRole == 1 || $adminRole == 8 || $adminRole == 3)) {

            // $queryData = DB::table($table)
            // ->join('sport_welfare_registration_master', 'sport_welfare_registration_master.id', '=', $table.'.user_id')
            // ->join('sport_type', 'sport_type.id', '=', 'sport_welfare_registration_master.sport_type')

            // // ->join('sport_type', 'sport_type.id', '=', $table.'.sport_type')
            // // ->join('applicant_post_master', 'applicant_post_master.user_id', '=', $table.'.user_id')
            // ->select($table.'.*', 'sport_type.name as sportName');
            $queryData = DB::table($table)
                ->join('sport_welfare_registration_master', 'sport_welfare_registration_master.id', '=', $table . '.user_id')
                ->join('direct_recruitment_sport_achievement', 'direct_recruitment_sport_achievement.application_no', '=', $table . '.application_no')
                ->join('applicant_post_master', 'applicant_post_master.application_no', '=', $table . '.application_no')
                ->join('sport_type', 'sport_type.id', '=', 'sport_welfare_registration_master.sport_type')
                ->select('sport_welfare_registration_master.*', $table . '.*', 'sport_type.name as sportName');
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
            $queryData->where($table . '.final_submit', '=', 1);
            if (Auth::guard('admin')->user()->admin_role == 3) {
                $direct_ass = 1;
                if ($request->form_type == 6 || $request->form_type == 7) {
                    $queryData->where($table . '.is_forwarded_by_rso', '!=', 0)->where('sport_welfare_registration_master.sport_type', '=', Auth::guard('admin')->user()->sport_type);
                } else {
                    $queryData->where($table . '.is_forwarded_by_rso', '!=', 0)->where('sport_welfare_registration_master.sport_type', '=', Auth::guard('admin')->user()->sport_type);
                }
            }
            if (Auth::guard('admin')->user()->admin_role == 4)
                $queryData->where($table . '.is_forwarded_by_rso', '=', 4);
        } else {
            $queryData = DB::table($table)
                ->join('sport_welfare_registration_master', 'sport_welfare_registration_master.id', '=', $table . '.user_id')
                ->join('sport_type', 'sport_type.id', '=', 'sport_welfare_registration_master.sport_type')
                ->select($table . '.*', 'sport_welfare_registration_master.fullname', 'sport_welfare_registration_master.father_name', 'sport_welfare_registration_master.email', 'sport_welfare_registration_master.permanent_district', 'sport_welfare_registration_master.permanent_address', 'sport_welfare_registration_master.dob', 'sport_welfare_registration_master.mobile', 'sport_type.name as sportName')
                ->where($table . '.final_submit', '=', 1);
        }
        if (Auth::guard('admin')->user()->admin_role == 3) {

            if ($request->form_type == 6 || $request->form_type == 7) {
                $queryData->where('sport_welfare_registration_master.sport_type', '=', Auth::guard('admin')->user()->sport_type);
            } else {
                $queryData->where('sport_welfare_registration_master.sport_type', '=', Auth::guard('admin')->user()->sport_type);
            }
        }
        if ($request->seg == 3)
            $queryData->where($table . '.is_forwarded_by_rso', '=', 1);

        if ($request->from_date != '') {
            $queryData->whereDate($table . '.created_at', '>=', ymd($request->from_date));
            $data['from_date'] = dmy($request->from_date);
        } else {
            $data['from_date'] = "01-04-2023";
        }


        if ($request->to_date != '') {
            $queryData->whereDate($table . '.created_at', '<=', ymd($request->to_date));
            $data['to_date'] = dmy($request->to_date);
        } else {
            $data['to_date'] = date('d-m-Y');
        }


        if ($request->from_date != '' && $request->to_date != '')
            $queryData->whereBetween($table . '.created_at', [ymd($request->from_date), ymd($request->to_date)]);

        if ($request->status_filter != '')
            $queryData->where($table . '.form_status', "$request->status_filter");

        if ($request->project_filter != '')
            $queryData->where('sport_welfare_registration_master.sport_type', "$request->project_filter");

        if ($request->city_filter != '') {
            if (Auth::guard('admin')->user()->admin_role == 4) {
                $queryData->where('direct_recruitment.permanent_district', $request->city_filter);
            } else {
                $queryData->where('sport_welfare_registration_master.permanent_district', $request->city_filter);
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

        if ($request->from_date == '' && ($request->form_type == 1 || $request->form_type == 2)) {
            $queryData->whereDate($table . '.created_at', '>=', ymd('01-01-' . config('app.session_year')));
        }
        $queryData->groupBy($table . '.id');
        $queryData->orderBy($table . '.id', 'DESC');
        //   $queryData->paginate($request->lenght);
        //   $queryData->dd();
        $data['summary']  = $queryData->get();

        $data['form_name']   = $formName;
        $data['name'] = $name;
        $data['form_type']   = $request->form_type;

        $data['from_date']   = $request->from_date;
        $data['to_date']   = $request->to_date;
        $data['report_code']   = $report_code;
        $data['row_count']   = $row_count;
        $namee  = $name . date('m-d-Y') . '.pdf';

        // dd($data);
        return view('exports.project', $data);
        $pdf = PDF::loadView('exports.project', $data)->setPaper('a4', 'landscape');
        $pdf->output();
        $domPdf = $pdf->getDomPDF();
        $canvas = $domPdf->get_canvas();
        $rightMargin = 90;
        $pageWidth = $canvas->get_width();
        $pageNumberX = $pageWidth - $rightMargin;

        $canvas->page_text($pageNumberX, $canvas->get_height() - 20, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, [0, 0, 0]);
        $canvas->page_text(320, $canvas->get_height() - 20, "*This is a Software Generated Report*", null, 10, [0, 0, 0]);
        //   $pdf = PDF::loadView('exports.project', $data)->setPaper('a4', 'landscape')->setOption(['defaultFont' => 'Devanagari']);
        //   dd($pdf);
        // $arrContextOptions = array(
        //    "ssl" => array(
        //      "verify_peer" => false,
        //      "verify_peer_name" => false,
        //    ),
        //  );

        //   $pdf->setHttpContext(stream_context_create($arrContextOptions));
        //   $pdf =$pdf->get_font("serif", "bold");
        return $pdf->stream($namee);
        //   return $pdf->download($namee);
    }


    public function fileimports()
    {
        return view('file-import');
    }
    public function fileImport(Request $request)
    {
        Excel::import(new DataImports, $request->file('file')->store('temp'));

        return back()->with('success', "Successfully Import");
    }
    public function trailDetail($id, $type)
    {
        // if($type==6){
        //    $item = DB::table('direct_recruitment')->where('user_id', $id)->first();
        // }
        // else{
        $item = DB::table('sport_welfare_registration_master')->where('id', $id)->first();
        // }
        $lists = DB::table('status_change_log_detail')->where('user_id', $id)->where('form_id', $type)->orderBy('id', 'asc')->get();
        //   dd($item);
        return view('admin.trailDetail', compact('lists', 'item', 'type'));
    }
    public function logDetail($id)
    {
        $lists = DB::table('login_history')->where('uid', $id)->orderBy('id', 'DESC')->get();
        //   dd($lists);
        $item = DB::table('admin')->where('id', $id)->first();
        return view('admin.logDetail', compact('lists', 'item'));
    }

    public function dateManangementMaster()
    {

        $date_list = DB::table('application_form_date_master')
            ->join('award_type', 'award_type.id', '=', 'application_form_date_master.form_type')
            ->select('application_form_date_master.*', 'award_type.name')
            ->orderBy('application_form_date_master.id', 'DESC')->get();
        return view('admin.user.date_manangement_list', compact('date_list'));
    }


    public function editDateMmanangement($id)
    {

        $item = DB::table('application_form_date_master')
            ->join('award_type', 'award_type.id', '=', 'application_form_date_master.form_type')
            ->select('application_form_date_master.*', 'award_type.name')
            ->where('application_form_date_master.id', $id)->first();
        // $spo=array(1,2,3);
        //  dd(explode(",",$post->sport_type));
        $award_type = DB::table('award_type')->get();
        $trail_list = DB::table('date_manangemnet_trail')->where('form_type', $id)->get();
        return view('admin.user.edit_date_management', compact('item', 'award_type', 'trail_list'));
    }

    public function dateManangementAdd(Request $req)
    {
        $end_date = strtotime($req->end_date);
        $start_date = strtotime($req->start_date);
        if ($req->post('award_type')) {
            $validation = Validator::make($req->all(), [
                'award_type' => 'required',
                'url_slug' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',

            ], msg());
            if ($validation->fails())
                return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
            $status = [
                'form_type' =>  $req->award_type,
                'url_slug' =>  $req->url_slug,
                'start_date' => date('Y-m-d H:i:s', $start_date),
                'end_date' => date('Y-m-d H:i:s', $end_date),
            ];

            if ($req->id) {
                $check = DB::table('application_form_date_master')->where('id', $req->id)->update($status);
                DB::table('date_manangemnet_trail')->insert([
                    'user_id' => Auth::guard('admin')->user()->id,
                    'form_type' =>  $req->award_type,
                    'type' => 2,
                    'ip_address' => request()->ip(),
                ]);
                $msg = "Successfully Updated.";
            } else {
                $check = DB::table('application_form_date_master')->insertGetId($status);
                DB::table('date_manangemnet_trail')->insert([
                    'user_id' => Auth::guard('admin')->user()->id,
                    'form_type' =>  $req->award_type,
                    'type' => 1,
                    'ip_address' => request()->ip(),
                ]);
                $msg = "Successfully Submited.";
            }

            return response()->json(["error" => false, "msg" => "SuccessFully Submited", "url" => route('dateManangementMaster')]);
        }
        $selected_award_type = DB::table('application_form_date_master')->select('form_type')->get();
        $award = array();
        foreach ($selected_award_type as $award1) {
            $award[] = $award1->form_type;
        }
        $award_type = DB::table('award_type')->get();
        return view('admin.user.add_date_management', compact('award_type', 'award'));
    }

    public function post_wise_count()
    {
        $post_count = DB::Select('SELECT apmm.id,apmm.post_name,COUNT(CASE WHEN apm.post_name != " " THEN 1 END) as total,COUNT(CASE WHEN apm.post_name != " " and dr.gender="Male" THEN 1 END) as Male,COUNT(CASE WHEN apm.post_name != " " and dr.gender="Female" THEN 1 END) as Female,COUNT(CASE WHEN dr.is_forwarded_by_rso != "" THEN 1 END) as is_forwarded_by_examination,COUNT(CASE WHEN dr.is_forwarded_by_rso = "4" THEN 1 END) as is_forwarded_by_comiittee from advertisment_post_master as apmm left join applicant_post_master as apm on apmm.id = apm.post_name left join direct_recruitment as dr on apm.user_id=dr.user_id group by apmm.id');
        //   dd($post_count);
        return view('admin.report.post_wise_count', compact('post_count'));
    }

    public function eklavya_competition(Request $req)
    {
        if ($req->method() == 'POST') {
            $validation = Validator::make($req->all(), [
                'name'           => 'required|max:30',
            ]);

            if ($validation->fails())
                return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

            DB::table('eklavya_competition')->insert(["name" => $req->name]);
            session()->flash('success', 'State Successfully Added.');
            return response()->json(['error' => false]);
        }

        $eklavya_competition = DB::table('eklavya_competition')->orderBy('name', 'ASC')->get();
        return view('admin.eklavya_competition', compact('eklavya_competition'));
    }
    public function userManagerStatus($id)
    {
        $status = DB::table('admin')->where('id', $id)->first()->status;
        DB::table('admin')->where('id', $id)->update(["status" => $status == 1 ? 2 : 1]);
        $msg = $status == 0 ? "Enabled" : "Disabled";
        return response()->json(['error' => false, "msg" => 'User Successfully .' . $msg]);
    }
}
