<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\RegionalMasterModel;

class RegionalMasterController extends Controller
{
    // public function index()
    // {
    //     $studiums = DB::table('studium_master')
    //     ->join('cities', 'cities.id', '=', 'studium_master.district_id')
    //     ->select('studium_master.id', 'studium_master.longitude','cities.id as city_id' ,'studium_master.latitude','studium_master.studium_name', 'cities.city')
    //     ->orderBy('studium_master.id', 'ASC')->get();
    //     $districts = DB::table('cities')->where('state_id', '23')->orderBy('id', 'ASC')->get();
    //     return view('admin.regional_sport.regional_sport', ['studiums' => $studiums, 'districts' => $districts]);
    // }

    //Regional feb-05-2023
    
    public function regional()
    {
       // echo 'SS'; die;
        $regional = DB::table('regional_master')
        ->join('cities', 'cities.id', '=', 'regional_master.district_id')
        ->select('regional_master.id', 'cities.id as city_id' ,'regional_master.regional_name', 'regional_master.status','cities.city')
        ->orderBy('regional_master.id', 'ASC')->get();      

        $districts = DB::table('cities')->where('state_id', '23')->orderBy('id', 'ASC')->get();
        return view('admin.regional_sport.regional_sport', ['regional' => $regional, 'districts' => $districts]);
    }

    public function saveRegionalMaster (Request $req)
    {
        $req->validate([
            'regional_name'     => 'required',
            'district'     => 'required',
            'status'     => 'required'
        ]);

        $RegionalMaster = new RegionalMasterModel();
        $RegionalMaster->regional_name = $req->regional_name;
        $RegionalMaster->district_id = $req->district;
        $RegionalMaster->status= $req->status;
        $RegionalMaster->save();

        return redirect('admin/create-regional')->with("success", "Regional Master Successfully Created.");
    }

    public function updateRegionalMaster(Request $req)
    {

        $req->validate([
            'regional_name'     => 'required|max:150',
            'id'           => 'required|max:10',
            'district'     => 'required'
            
        ]);

        DB::table('regional_master')->where('id', $req->id)->update(["regional_name" => $req->regional_name, "district_id" => $req->district]);
        return redirect()->back()->with("success", "Regional master  Successfully Updated.");
    }

    
    public function regionalStatus($id)
    {
        $disStatus = DB::table('regional_master')->where('id', $id)->first()->status;
       // dd($disStatus);
        DB::table('regional_master')->where('id', $id)->update(["status" => $disStatus == 1 ? 0 : 1]);
         return redirect()->back()->with("success", "District Status Change Successfully");
    }

    public function deleteRegionalMaster($id){
        DB::table('regional_master')->where('id', '=', $id)->delete();
        return redirect()->back()->with("success", "Regional Master Successfully Deleted.");
    }


           

}
