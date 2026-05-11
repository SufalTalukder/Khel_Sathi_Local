<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SolarPlant;
use App\Exports\ProjectExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class Project extends Controller
{
    public function projectdeatil($id, $type)
    {
        $data =  SolarPlant::projectDeatilsaAdmin($type, $id);
        return view('admin.projectdetails', $data); 
    }

    public function projectdeatilsExports($id, $type)
    {
        $data = SolarPlant::projectDeatilsaAdmin($type, $id);
        $pdf = PDF::loadView('exports.project', $data);
        $name  = $data['project_name'] . date('m-d-Y') . 'ad.pdf';
        return $pdf->download($name);
    }

    public function exportProjectExcel($id, $type)
    {
        // $data = SolarPlant::projectDeatilsaAdmin($type, $id);
        //return view('exports.projectExcel', $data);
        $name  = 'project' . $type . date('m-d-Y') . 'ad.xlsx';
        return Excel::download(new ProjectExport($type, $id), $name);
    }

    public function exportExcel()
    {
        $name  = 'project' . date('m-d-Y') . 'ad.xlsx';
        return Excel::download(new ProjectExport('admin', 1), $name);
    }

    public function forwordProject(Request $req)
    {
        $summary_id = $req->project_summary_id;
        if (DB::table('project_forwards_master')->where('project_id', $summary_id)->doesntExist()) {

            $by = Auth::guard('admin')->id();

            SolarPlant::CreateForward([
                "project_id" => $summary_id,
                "project_to" => $req->forward_to,
                "project_by" => $by,
                "forward_remark" => $req->remark
            ]);
            
            SolarPlant::UpdateSummary(['id', '=', $summary_id], [
                "forwarded" => 1,
                "application_status" => 2,
                "forwarded_by" => $by
            ]);

            SolarPlant::CreateLog([
                "primary_id" => $summary_id,
                "primary_id_comment" => " table : user_project_summary , key : id ",
                "user_id" => $by,
                "description" => "Project Forward By " . Auth::guard('admin')->user()->name,
                "type" => 1
            ]);

            return response()->json(['error' => false, 'msg' => 'Project forwarded successfully.']);
        } else {

            return response()->json(['error' => true, 'msg' => 'The project has already been forwarded.']);
        }
    }
}
