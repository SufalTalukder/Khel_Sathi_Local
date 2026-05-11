<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Events\UserLoggedIn;
use PhpParser\Node\Expr\Cast\Array_;

class Dashboard extends Controller
{
    /**
     * Display a listing of the project summary.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard_new(Request $request)
    {
        if (User::find(Auth::id())->password_change_status == "1") {
            return redirect('/change-password');
        }
        if (User::find(Auth::id())->profile_complete != 1) {
            return redirect()->route('cp');
        }
        $user = DB::table('sport_welfare_registration_master')->where('id', Auth::id())->orderBy('id', 'desc')->first();
        if ($user->gender == "Male") {
            $award = DB::table('laxman_award')->where('user_id', Auth::id())->orderBy('id', 'desc')->get();
        } else {
            $award = DB::table('ranilaxmibai_award')->where('user_id', Auth::id())->orderBy('id', 'desc')->get();
        }
        $financial = DB::table('financial_assistance')->where('user_id', Auth::id())->orderBy('id', 'desc')->get();
        $monthly = DB::table('monthly_pension')->where('user_id', Auth::id())->orderBy('id', 'desc')->get();
        $position = DB::table('position_holder')->where('user_id', Auth::id())->orderBy('id', 'desc')->get();
        $direct = DB::table('direct_recruitment')->where('user_id', Auth::id())->orderBy('id', 'desc')->get();
        $eklavya  = DB::table('eklavya_krida_kosh_basic_detail')->where('user_id', Auth::id())->orderBy('id', 'desc')->get();
        return view('dashboard_new', compact('user', 'award', 'financial', 'monthly', 'position', 'direct', 'eklavya'));
    }
    public function dashboard()
    {
        if (User::find(Auth::id())->password_change_status == "1") {
            return redirect('change-password');
        }
        if (User::find(Auth::id())->profile_complete != 1) {
            return redirect()->route('cp');
        }
        $articles = DB::table('user_award_apply_master')
            ->select('award_type_id')
            ->where('user_id', Auth::id())
            ->where('status', 1)
            ->get();
        $award_count = count($articles);
        $laxman = DB::table('sport_welfare_registration_master as swrm')
            ->join('laxman_award', 'swrm.id', '=', 'laxman_award.user_id')
            ->join('sport_type', 'swrm.sport_type', '=', 'sport_type.id')
            ->select('laxman_award.application_no', 'laxman_award.amount_release_status', 'laxman_award.form_status', 'laxman_award.created_at', 'laxman_award.final_submit', 'laxman_award.id as applicant_id', 'swrm.fullname', 'swrm.mobile', 'swrm.email', 'sport_type.name')
            ->where('swrm.id', Auth::id())
            ->get();
        $ranilaxmibai = DB::table('sport_welfare_registration_master as swrm')
            ->join('ranilaxmibai_award', 'swrm.id', '=', 'ranilaxmibai_award.user_id')
            ->join('sport_type', 'swrm.sport_type', '=', 'sport_type.id')
            ->select('ranilaxmibai_award.application_no', 'ranilaxmibai_award.amount_release_status', 'ranilaxmibai_award.form_status', 'ranilaxmibai_award.created_at', 'ranilaxmibai_award.final_submit', 'ranilaxmibai_award.id as applicant_id', 'swrm.fullname', 'swrm.mobile', 'swrm.email', 'sport_type.name')
            ->where('swrm.id', Auth::id())
            ->get();
        $position_holder = DB::table('sport_welfare_registration_master as swrm')
            ->join('position_holder', 'swrm.id', '=', 'position_holder.user_id')
            ->join('sport_type', 'swrm.sport_type', '=', 'sport_type.id')
            ->select('position_holder.application_no', 'position_holder.amount_release_status', 'position_holder.form_status', 'position_holder.created_at', 'position_holder.final_submit', 'position_holder.id as applicant_id', 'swrm.fullname', 'swrm.mobile', 'swrm.email', 'sport_type.name')
            ->where('swrm.id', Auth::id())
            ->get();
        $apply_check = ((DB::table('laxman_award')->where('user_id', Auth::id())->exists() || DB::table('ranilaxmibai_award')->where('user_id', Auth::id())->exists()) && DB::table('position_holder')->where('user_id', Auth::id())->exists());
        //    dd($apply_check);
        //dd($laxman);
        $chkk = DB::table('sport_welfare_registration_master')->where('id', Auth::id())->where('profile_complete', 1)->count();

        return view('user.dashboard', compact('chkk', 'apply_check', 'award_count', 'laxman', 'ranilaxmibai', 'position_holder'));
    }
}
