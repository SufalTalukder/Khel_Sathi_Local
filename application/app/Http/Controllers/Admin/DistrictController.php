<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\DivisionModel;
use App\Models\DivisionDistrictMap;
use App\Models\SportModel;
use App\Models\DistrictModel;

class DistrictController extends Controller
{
    public function index()
    {
        $districts = DB::table('cities')->where('state_id',23)->orderBy('id', 'DESC')->get();
        $states = DB::table('states')->orderBy('id', 'DESC')->get();
        return view('admin.division_master.district-list', ['districts' => $districts, 'states' => $states]);
    }

    public function saveDistrict(Request $req)
    {
      // return "hello";
      // dd($req->all());

      $validation = Validator::make($req->all(), [
            'state_id'     => 'required',
            'city'     => 'required|max:150|unique:cities',
            'status'      => 'required',
            'description'      => 'required'
        ]);
        
        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
 
        $district = new DistrictModel();
        $district->state_id = $req->state_id;
    		$district->city = $req->city;
    		$district->status = $req->status;
            $district->description = $req->description;
    		$district->save();

        return redirect('admin/district-list')->with("success", "District Successfully Created.");
    }

    public function districtStatus($id)
    {
        $divStatus = DB::table('cities')->where('id', $id)->first()->status;
        DB::table('cities')->where('id', $id)->update(["status" => $divStatus == 1 ? 0 : 1]);
        return redirect()->back()->with("success", "District Status Change Successfully");
    }
 
    public function updateDistrict(Request $req)
    {

        $validation = Validator::make($req->all(), [
            'name'     => 'required|max:150',
            'id'           => 'required|max:10',
            'description'      => 'required'
        ], [
            'name'      => 'Please Enter Sport Name',
            'id'           => 'Oop! Something went wrong please reload this page and try again.',
        ]);

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        DB::table('cities')->where('id', $req->id)->update(["city" => $req->name, 'description'  => $req->description, 'trial_from_date' => $req->trial_from_date,'trial_to_date' => $req->trial_to_date,] );
        
         return redirect()->back()->with("success", "District  Successfully Updated.");
        //return response()->json(['error' => false, 'msg' => "Division  Successfully Updated."]);
    }

  //   public function deleteDivision($id){
  //       DB::table('hostel_division_master')->where('id', '=', $id)->delete();
  //       //DB::table('hostel_div_district_mapping')->where('division_id', '=', $id)->delete();
  //       return redirect()->back()->with("success", "Hostel Division Successfully Deleted.");
  //     }
}
