<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\SolarPlant;

class DashboardController extends Controller
{
    /**
     * Display a listing of department dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $cities = DB::table('cities')->where('state_id', 23)->orderBy('city', 'ASC')->get();
        return view('department.dashboard.dashboard', compact('cities'));
    }

    public function rsoDashboard()
    {
		$financial = DB::Select("SELECT COUNT(CASE WHEN final_submit = 1 THEN 1 END) as total,COUNT(CASE WHEN is_forwarded_by_rso = 1 THEN 1 END) as total_app_forward,COUNT(CASE WHEN form_status = 0 THEN 1 END) as total_pending,COUNT(CASE WHEN form_status = 1 THEN 1 END) as total_accepted,COUNT(CASE WHEN form_status = 2 THEN 1 END) as total_rejected from financial_assistance WHERE 1 AND final_submit = 1");

        $monthly = DB::Select("SELECT COUNT(CASE WHEN final_submit = 1 THEN 1 END) as total,COUNT(CASE WHEN is_forwarded_by_rso = 1 THEN 1 END) as total_app_forward,COUNT(CASE WHEN form_status = 0 THEN 1 END) as total_pending,COUNT(CASE WHEN form_status = 1 THEN 1 END) as total_accepted,COUNT(CASE WHEN form_status = 2 THEN 1 END) as total_rejected from monthly_pension WHERE 1 AND final_submit = 1");
        // dd($monthly->total);

        // $direct = DB::Select("SELECT COUNT(CASE WHEN final_submit = 1 THEN 1 END) as total,COUNT(CASE WHEN is_forwarded_by_rso = 1 THEN 1 END) as total_app_forward,COUNT(CASE WHEN form_status = 3 THEN 1 END) as total_pending,COUNT(CASE WHEN form_status = 1 THEN 1 END) as total_accepted,COUNT(CASE WHEN form_status = 2 THEN 1 END) as total_rejected from direct_recruitment WHERE 1");

        $laxman = DB::Select("SELECT COUNT(CASE WHEN final_submit = 1 THEN 1 END) as total,COUNT(CASE WHEN is_forwarded_by_rso = 1 THEN 1 END) as total_app_forward,COUNT(CASE WHEN form_status = 0 THEN 1 END) as total_pending,COUNT(CASE WHEN form_status = 1 THEN 1 END) as total_accepted,COUNT(CASE WHEN form_status = 2 THEN 1 END) as total_rejected from laxman_award WHERE 1 AND final_submit = 1");

        $ranilaxmibai = DB::Select("SELECT COUNT(CASE WHEN final_submit = 1 THEN 1 END) as total,COUNT(CASE WHEN is_forwarded_by_rso = 1 THEN 1 END) as total_app_forward,COUNT(CASE WHEN form_status = 0 THEN 1 END) as total_pending,COUNT(CASE WHEN form_status = 1 THEN 1 END) as total_accepted,COUNT(CASE WHEN form_status = 2 THEN 1 END) as total_rejected from ranilaxmibai_award WHERE 1 AND final_submit = 1");
        if(Auth::guard('admin')->user()->role == 2){
            $position = DB::Select("SELECT COUNT(CASE WHEN final_submit = 1 THEN 1 END) as total,COUNT(CASE WHEN is_forwarded_by_rso = 1 THEN 1 END) as total_app_forward,COUNT(CASE WHEN form_status = 0 THEN 1 END) as total_pending,COUNT(CASE WHEN form_status = 1 THEN 1 END) as total_accepted,COUNT(CASE WHEN form_status = 2 THEN 1 END) as total_rejected from position_holder WHERE 1 AND final_submit = 1 AND is_forwarded_by_association = 1");
        }
        else{
            $position = DB::Select("SELECT COUNT(CASE WHEN final_submit = 1 THEN 1 END) as total,COUNT(CASE WHEN is_forwarded_by_rso = 1 THEN 1 END) as total_app_forward,COUNT(CASE WHEN form_status = 0 THEN 1 END) as total_pending,COUNT(CASE WHEN form_status = 1 THEN 1 END) as total_accepted,COUNT(CASE WHEN form_status = 2 THEN 1 END) as total_rejected from position_holder WHERE 1 AND final_submit = 1");
        }

        // $dataList = DB::table('financial_assistance')
        // ->select('count(id),COUNT(CASE WHEN is_forwarded_by_rso = 1 THEN 1 END) as total_app_forward,COUNT(CASE WHEN form_status = 3 THEN 1 END) as total_pending,COUNT(CASE WHEN form_status = 1 THEN 1 END) as total_accepted,COUNT(CASE WHEN form_status = 2 THEN 1 END) as total_rejected')
        // ->get();
      
        $cities = DB::table('cities')->where('state_id', 23)->orderBy('city', 'ASC')->get();
        
        return view('rso.dashboard.rsoDashboard', compact('cities','financial','monthly','laxman','ranilaxmibai','position'));
    }

    /**
     * Display a listing of project (Fetch data via ajax).
     *
     * @return \Illuminate\Http\Response
     */
    // function projectdashboard(Request $request)
    // {
    //     if ($request->ajax()) {

    //         $queryData = DB::table('user_project_summary')
    //             ->join('up_investor_registration_master', 'up_investor_registration_master.id', '=', 'user_project_summary.regid')
    //             ->join('project_forwards_master', 'project_forwards_master.project_id', '=', 'user_project_summary.id')
    //             ->select('project_forwards_master.revert_remark', 'project_forwards_master.feasibility', 'project_forwards_master.is_reverted', 'project_forwards_master.forward_remark', 'user_project_summary.forwarded', 'user_project_summary.type', 'application_status', 'fullname', 'project_name', 'district', 'application_date', 'user_project_summary.project_id', 'user_project_summary.id', 'user_project_summary.project_id as p_code');

    //         if ($request->from_date != '' && $request->to_date != '')
    //             $queryData->whereBetween('application_date', [ymd($request->from_date), ymd($request->to_date)]);

    //         if ($request->status_filter != '')
    //             $queryData->where('application_status', "$request->status_filter");

    //         if ($request->project_filter != '')
    //             $queryData->where('user_project_summary.type', "$request->project_filter");

    //         if ($request->city_filter != '')
    //             $queryData->where('district', $request->city_filter);

    //         if ($request->search != '') {
    //             $this->searchColumn = '%' . $request->search . '%';
    //             $queryData->where(function ($query) {
    //                 $query->where('fullname', 'like', $this->searchColumn);
    //                 $query->orWhere('user_project_summary.project_id', 'like', $this->searchColumn);
    //                 $query->orWhere('project_name', 'like', $this->searchColumn);
    //                 $query->orWhere('application_date', 'like', $this->searchColumn);
    //             });
    //         }
    //         $queryData->orderBy('user_project_summary.id', 'DESC');
    //         $collection = $queryData->paginate($request->lenght);
    //         return view('department.dashboard.projectlist', compact('collection'))->render();
    //     }
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function revertProject(Request $req)
    // {
    //     $summary_id = $req->project_summary_id;
    //     $type = $req->project_rejected;

    //     SolarPlant::UpdateForward(['project_id', '=', $summary_id], [
    //         "feasibility" => $req->feasibility,
    //         "revert_remark" => $req->remark,
    //         "is_reverted" => $type == 0 ? 1 : 0
    //     ]);

    //     SolarPlant::UpdateSummary(['id', '=', $summary_id], [
    //         "reverted" => $type == 0 ? 1 : 0,
    //         "application_status" => $type == 0 ? 3 : 5,
    //         "reverted_by" => Auth::guard('department')->id()
    //     ]);

    //     SolarPlant::CreateLog([
    //         "primary_id" => $summary_id,
    //         "primary_id_comment" => " table : user_project_summary , key : id ",
    //         "user_id" => Auth::guard('department')->id(),
    //         "type" => $type == 0 ? 2 : 5
    //     ]);

    //     return response()->json(['error' => false, 'msg' => 'Project successfully updated.']);
    // }

    /**
     * Show the deatls for view the specified project.
     *
     * @param  int  $id
     * @param  int  $type
     * @return \Illuminate\Http\Response
     */
    // public function projectDeatils($id, $type)
    // {
    //     $data =  SolarPlant::projectDeatilsaAdmin($type, $id);
    //     return view('department.projectdetails', $data);
    // }
}
