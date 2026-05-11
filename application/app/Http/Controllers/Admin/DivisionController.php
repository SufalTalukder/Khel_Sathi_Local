<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\DivisionModel;
use App\Models\DivisionDistrictMap;

class DivisionController extends Controller
{
    public function index()
    {
        $divisions = DB::table('hostel_division_master')->orderBy('id', 'DESC')->get();
        return view('admin.division_master.index', ['divisions' => $divisions]);
    } 

    public function saveDivision (Request $req)
    {
        $req->validate([
            'division_name'     => 'required|max:150|unique:hostel_division_master',
            'status'      => 'required',
        ]);

        // DB::table('hostel_division_master')->insert([
        //     "division_name"   => $req->division_name,
        //     "status"    => $req->status,
        // ]);

        $divisions = new DivisionModel();
		$divisions->division_name = $req->division_name;
		$divisions->status = $req->status;
		$divisions->save();

        $divisionsMap = new DivisionDistrictMap();
		$divisionsMap->division_id = $divisions->id;
		$divisionsMap->district_id = $divisions->id;
		$divisionsMap->save();

        return redirect('admin/create-division')->with("success", "Division Successfully Created.");
    }

    public function divisionStatus($id)
    {
        $divStatus = DB::table('hostel_division_master')->where('id', $id)->first()->status;
        DB::table('hostel_division_master')->where('id', $id)->update(["status" => $divStatus == 1 ? 0 : 1]);
        return redirect()->back()->with("success", "Division Status Change Successfully");
    }


    // public function editModule($id)
    // {
    //     $module = DB::table('urm_module_manager')->where('id', $id)->first();
    //     $icon = DB::table('module_icon')->get();
    //     return view('admin.modulemanage.update', compact('module', 'icon'));
    // }

     public function updateDivision(Request $req)
     {

        $validation = Validator::make($req->all(), [
            'division_name'      => 'required|max:80',
            // 'status'      => 'required',
            'id'           => 'required|max:10',
        ], [
            'name'      => 'Please Enter Division Name',
            'status'      => 'Please select status',
            'id'           => 'Oop! Something went wrong please reload this page and try again.',
        ]);

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        DB::table('hostel_division_master')->where('id', $req->id)->update(["division_name" => $req->division_name]);

         return redirect()->back()->with("success", "Division  Successfully Updated.");
        //return response()->json(['error' => false, 'msg' => "Division  Successfully Updated."]);
    }

    public function deleteDivision($id){
        DB::table('hostel_division_master')->where('id', '=', $id)->delete();
        //DB::table('hostel_div_district_mapping')->where('division_id', '=', $id)->delete();
        return redirect()->back()->with("success", "Hostel Division Successfully Deleted.");
      }
}
