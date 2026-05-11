<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\DivisionModel;
use App\Models\DivisionDistrictMap;
use App\Models\StudiumMasterModel;
use App\Models\SwimmingMasterModel;
use App\Models\GymnasiumMasterModel;

class StudiumMasterController extends Controller
{
    public function index()
    {
        $studiums = DB::table('studium_master')
        ->join('cities', 'cities.id', '=', 'studium_master.district_id')
        ->select('studium_master.id', 'studium_master.longitude','cities.id as city_id' ,'studium_master.latitude','studium_master.studium_name', 'cities.city')
        ->orderBy('studium_master.id', 'ASC')->get();
        $districts = DB::table('cities')->where('state_id', '23')->orderBy('id', 'ASC')->get();
        return view('admin.division_master.studium_master', ['studiums' => $studiums, 'districts' => $districts]);
    }

    public function saveStudiumMaster (Request $req)
    {
        $req->validate([
            'studium_name'     => 'required',
            'district'     => 'required',
            'longitude'     => 'required',
            'latitude'     => 'required'

        ]);

        $StudiumMaster = new StudiumMasterModel();
		$StudiumMaster->studium_name = $req->studium_name;
        $StudiumMaster->district_id = $req->district;
        $StudiumMaster->longitude = $req->longitude;
        $StudiumMaster->latitude = $req->latitude;
		$StudiumMaster->save();

        return redirect('admin/create-stadium')->with("success", "Stadium Master Successfully Created.");
    }

    public function updateStudiumMaster(Request $req)
     {

        $req->validate([
            'studium_name'     => 'required|max:150',
            'id'           => 'required|max:10',
            'district'     => 'required',
            'longitude'     => 'required',
            'latitude'     => 'required'
        ]);

        DB::table('studium_master')->where('id', $req->id)->update(["studium_name" => $req->studium_name, "district_id" => $req->district , "latitude" => $req->latitude , "longitude" => $req->longitude]);
        return redirect()->back()->with("success", "Stadium Mmaster  Successfully Updated.");
        //return response()->json(['error' => false, 'msg' => "Division  Successfully Updated."]);
    }

   
    public function deleteStudiumMaster($id){
        DB::table('studium_master')->where('id', '=', $id)->delete();
        return redirect()->back()->with("success", "Stadium Master Successfully Deleted.");
      }


    //Swimming nov-02-2023
    
    public function swimming()
    {
        $swimming = DB::table('swimming_master')
        ->join('cities', 'cities.id', '=', 'swimming_master.district_id')
        ->select('swimming_master.id', 'swimming_master.longitude','cities.id as city_id' ,'swimming_master.latitude','swimming_master.swimming_name', 'cities.city')
        ->orderBy('swimming_master.id', 'ASC')->get();      

        $districts = DB::table('cities')->where('state_id', '23')->orderBy('id', 'ASC')->get();
        return view('admin.swimming_master.swimming_master', ['swimming' => $swimming, 'districts' => $districts]);
    }

    public function saveSwimmingMaster (Request $req)
    {
        $req->validate([
            'swimming_name'     => 'required',
            'district'     => 'required'

        ]);

        $SwimmingMaster = new SwimmingMasterModel();
        $SwimmingMaster->swimming_name = $req->swimming_name;
        $SwimmingMaster->district_id = $req->district;
        $SwimmingMaster->longitude = $req->longitude;
        $SwimmingMaster->latitude = $req->latitude;
        $SwimmingMaster->save();

        return redirect('admin/create-swimming')->with("success", "Swimming Master Successfully Created.");
    }

    public function updateSwimmingMaster(Request $req)
    {

        $req->validate([
            'swimming_name'     => 'required|max:150',
            'id'           => 'required|max:10',
            'district'     => 'required'
            
        ]);

        DB::table('swimming_master')->where('id', $req->id)->update(["swimming_name" => $req->swimming_name, "district_id" => $req->district , "latitude" => $req->latitude , "longitude" => $req->longitude]);
        return redirect()->back()->with("success", "Swimming master  Successfully Updated.");
        //return response()->json(['error' => false, 'msg' => "Division  Successfully Updated."]);
    }

    
    public function deleteSwimmingMaster($id){
        DB::table('swimming_master')->where('id', '=', $id)->delete();
        return redirect()->back()->with("success", "Swimming Master Successfully Deleted.");
    }

 //Gymnasium nov-02-2023
 public function gymnasium()
    {
        $gymnasium = DB::table('gymnasium_master')
        ->join('cities', 'cities.id', '=', 'gymnasium_master.district_id')
        ->select('gymnasium_master.id', 'gymnasium_master.longitude','cities.id as city_id' ,'gymnasium_master.latitude','gymnasium_master.gymnasium_name', 'cities.city')
        ->orderBy('gymnasium_master.id', 'ASC')->get();
        
        $districts = DB::table('cities')->where('state_id', '23')->orderBy('id', 'ASC')->get();
        return view('admin.gymnasium_master.gymnasium_master', ['gymnasium' => $gymnasium, 'districts' => $districts]);
    }

    public function saveGymnasiumMaster (Request $req)
    {
        $req->validate([
            'gymnasium_name'     => 'required',
            'district'     => 'required',      

        ]);

        $GymnasiumMaster = new GymnasiumMasterModel();
        $GymnasiumMaster->gymnasium_name = $req->gymnasium_name;
        $GymnasiumMaster->district_id = $req->district;
        $GymnasiumMaster->longitude = $req->longitude;
        $GymnasiumMaster->latitude = $req->latitude;
        $GymnasiumMaster->save();

        return redirect('admin/create-gymnasium')->with("success", "Swimming Master Successfully Created.");
    }

    public function updateGymnasiumMaster(Request $req)
    {

        $req->validate([
            'gymnasium_name'     => 'required|max:150',
            'id'           => 'required|max:10',
            'district'     => 'required'
            
        ]);

        DB::table('gymnasium_master')->where('id', $req->id)->update(["gymnasium_name" => $req->gymnasium_name, "district_id" => $req->district , "latitude" => $req->latitude , "longitude" => $req->longitude]);
        return redirect()->back()->with("success", "Swimming master  Successfully Updated.");
        //return response()->json(['error' => false, 'msg' => "Division  Successfully Updated."]);
    }

    
    public function deleteGymnasiumMaster($id){
        DB::table('gymnasium_master')->where('id', '=', $id)->delete();
        return redirect()->back()->with("success", "Gymnasium Master Successfully Deleted.");
    }


           

}
