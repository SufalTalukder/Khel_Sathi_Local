<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\TehsilModel;
use App\Models\DivisionDistrictMap;

class TehsilController extends Controller
{
    public function index()
    {   
        $cities = DB::table('cities')->orderBy('city', 'asc')->get();
        $Tehsil_Name = DB::table('tehsil_master')->orderBy('id', 'DESC')->get();
        return view('admin.division_master.tehsil', ['Tehsil_Name' => $Tehsil_Name, 'cities' => $cities]);
    }

    public function saveTehsil (Request $req)
    {
        //dd($req->all());
        $req->validate([
            'dist_id'     => 'required|max:150|unique:tehsil_master',
            'Tehsil_Name'      => 'required'
        ]);

        $Tehsil = new TehsilModel();
		$Tehsil->dist_id = $req->dist_id;
		$Tehsil->Tehsil_Name = $req->Tehsil_Name;
		$Tehsil->save();
        return redirect('admin/create-tehsil')->with("success", "Tehsil Successfully Created.");
    }

    public function tehsilStatus($id)
    {
        $divStatus = DB::table('tehsil_master')->where('id', $id)->first()->status;
        DB::table('tehsil_master')->where('id', $id)->update(["status" => $divStatus == 1 ? 0 : 1]);
        return redirect()->back()->with("success", "Division Status Change Successfully");
    }
 
     public function updateTehsil(Request $req)
     {
         //dd($req->all());
        $validation = Validator::make($req->all(), [
             
            'Tehsil_name'      => 'required'
        ], [
             
            'Tehsil_name'      => 'required'
        ]);

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        DB::table('tehsil_master')->where('id', $req->id)->update(["Tehsil_Name" => $req->Tehsil_name]);
        
         return redirect()->back()->with("success", "Tehsil Name  Successfully Updated.");
        //return response()->json(['error' => false, 'msg' => "Division  Successfully Updated."]);
    }

    public function deleteTehsil($id){
        DB::table('tehsil_master')->where('id', '=', $id)->delete();
        //DB::table('hostel_div_district_mapping')->where('division_id', '=', $id)->delete();
        return redirect()->back()->with("success", "Tehsil Name Successfully Deleted.");
      }
}
