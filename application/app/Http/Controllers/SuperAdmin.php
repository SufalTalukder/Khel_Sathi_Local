<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Models\Adminuser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Events\UserLoggedIn;
class SuperAdmin extends Controller
{
   
    public function index()
   {

      $financial = DB::Select("SELECT COUNT(CASE WHEN final_submit = 1 THEN 1 END) as total,COUNT(CASE WHEN is_forwarded_by_rso = 1 THEN 1 END) as total_app_forward,COUNT(CASE WHEN form_status = 0 THEN 1 END) as total_pending,COUNT(CASE WHEN form_status = 1 THEN 1 END) as total_accepted,COUNT(CASE WHEN form_status = 2 THEN 1 END) as total_rejected from financial_assistance WHERE 1 AND final_submit = 1");

      $monthly = DB::Select("SELECT COUNT(CASE WHEN final_submit = 1 THEN 1 END) as total,COUNT(CASE WHEN is_forwarded_by_rso = 1 THEN 1 END) as total_app_forward,COUNT(CASE WHEN form_status = 0 THEN 1 END) as total_pending,COUNT(CASE WHEN form_status = 1 THEN 1 END) as total_accepted,COUNT(CASE WHEN form_status = 2 THEN 1 END) as total_rejected from monthly_pension WHERE 1 AND final_submit = 1");
      // dd($monthly->total);

      $direct = DB::Select("SELECT COUNT(CASE WHEN final_submit = 1 THEN 1 END) as total,COUNT(CASE WHEN is_forwarded_by_rso = 1 THEN 1 END) as total_app_forward,COUNT(CASE WHEN form_status = 0 THEN 1 END) as total_pending,COUNT(CASE WHEN form_status = 1 THEN 1 END) as total_accepted,COUNT(CASE WHEN form_status = 2 THEN 1 END) as total_rejected from direct_recruitment WHERE 1 AND final_submit = 1");

      $laxman = DB::Select("SELECT COUNT(CASE WHEN final_submit = 1 THEN 1 END) as total,COUNT(CASE WHEN is_forwarded_by_rso = 1 THEN 1 END) as total_app_forward,COUNT(CASE WHEN form_status = 0 THEN 1 END) as total_pending,COUNT(CASE WHEN form_status = 1 THEN 1 END) as total_accepted,COUNT(CASE WHEN form_status = 2 THEN 1 END) as total_rejected from laxman_award WHERE 1 AND final_submit = 1");

      $ranilaxmibai = DB::Select("SELECT COUNT(CASE WHEN final_submit = 1 THEN 1 END) as total,COUNT(CASE WHEN is_forwarded_by_rso = 1 THEN 1 END) as total_app_forward,COUNT(CASE WHEN form_status = 0 THEN 1 END) as total_pending,COUNT(CASE WHEN form_status = 1 THEN 1 END) as total_accepted,COUNT(CASE WHEN form_status = 2 THEN 1 END) as total_rejected from ranilaxmibai_award WHERE 1 AND final_submit = 1");

      $position = DB::Select("SELECT COUNT(CASE WHEN final_submit = 1 THEN 1 END) as total,COUNT(CASE WHEN is_forwarded_by_rso = 1 THEN 1 END) as total_app_forward,COUNT(CASE WHEN form_status = 0 THEN 1 END) as total_pending,COUNT(CASE WHEN form_status = 1 THEN 1 END) as total_accepted,COUNT(CASE WHEN form_status = 2 THEN 1 END) as total_rejected from position_holder WHERE 1 AND final_submit = 1");
    
      $cities = DB::table('cities')->where('state_id', 23)->orderBy('city', 'ASC')->get();
      return view('superadmin.dashboard', compact('direct','cities', 'financial', 'monthly', 'laxman', 'ranilaxmibai', 'position'));
   }

    public function signOuts()
    {
        // dd("hello");
        UserLoggedIn::dispatch(Auth::guard('admin')->user()->id, 2,1,'admin');
        // Auth::logout();
        Auth::guard('admin')->logout();
         
        return Redirect('/admin/login');
    }
    public function changePassword()
    {
        return view('superadmin.changePassword');
    }
    public function profile()
    {
        return view('superadmin.profile');
    }
}
