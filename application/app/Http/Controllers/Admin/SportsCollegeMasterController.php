<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DivisionModel;
use App\Models\DivisionDistrictMap;
use App\Models\SportModel;
use App\Models\SportModelMaster;
use App\Models\DistrictModel;

class SportsCollegeMasterController extends Controller
{
    public function index()
    {
        $districts = DB::table('cities')->select('city', 'id')->where('state_id', '23')->get();
        $sports = DB::table('sports_college_master')
        ->join('cities', 'cities.id', '=', 'sports_college_master.districts_id')->select('cities.city','sports_college_master.*')
        ->orderBy('sports_college_master.id', 'DESC')->get();
        return view('admin.division_master.sport_college_master', ['sports' => $sports, 'districts' => $districts]);
    }

    public function saveSportMaster(Request $req)
    {
        $req->validate([
            'name'     => 'required|max:150|',
            'gender'     => 'required',
            'c_address'     => 'required|max:150|',
            'district'     => 'required|max:150|'
        ]);
 
        $sport = new SportModelMaster();
	    $sport->college_name = $req->name;
        $sport->gender = $req->gender;
	    $sport->college_address = $req->c_address;
        $sport->districts_id = $req->district;
        $sport->ip_address = $req->ip();
        $sport->current_user_id = Auth::guard('admin')->user()->id;
		    $sport->save();

        return redirect('admin/college-master-list')->with("success", "Sport Master Successfully Created.");
    }

     public function updateCollegeMaster(Request $req)
     {
        $validation = Validator::make($req->all(), [
            'name'     => 'required|max:150|',
            'gender'     => 'required',
            'c_address'     => 'required|max:150|',
            'district'     => 'required|max:150|'
        ], [
            'name'      => 'Please Enter Sport Name',
            'id'           => 'Oop! Something went wrong please reload this page and try again.',
        ]);

        if ($validation->fails())
           return redirect()->back()->with("error", $validation->errors()->first());

        DB::table('sports_college_master')->where('id', $req->id)->update(["college_name" => $req->name, "gender" => $req->gender, "districts_id" => $req->district, "college_address" => $req->c_address, "ip_address" => $req->ip(), "current_user_id" => Auth::guard('admin')->user()->id ]);
        
        return redirect()->back()->with("success", "Sport College Master Successfully Updated.");
    }

    public function deleteCollegeMaster($id){
      DB::table('sports_college_master')->where('id', '=', $id)->delete();
      return redirect()->back()->with("success", "Sport College Master Successfully Deleted.");
    }
}
