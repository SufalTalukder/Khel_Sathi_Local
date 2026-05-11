<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\DivisionModel;
use App\Models\DivisionDistrictMap;

class DivisionMapController extends Controller
{
    public function index($id = null)
    {
        $divisions = DivisionModel::select('division_name','id')->get();
        $districts = DB::table('cities')->select('city', 'id')->where('state_id', '23')->get();
        $lists = DB::table('hostel_div_district_mapping')->select('hostel_div_district_mapping.id', 'cities.city', 'hostel_division_master.division_name')
        ->join('cities','cities.id','=','hostel_div_district_mapping.district_id')
		->join('hostel_division_master','hostel_division_master.id','=','hostel_div_district_mapping.division_id')
        ->get();
        //dd($lists);
        return view('admin.division_master.list', ['divisions' => $divisions, 'districts' => $districts, 'lists' => $lists]);
    }

    public function saveDivisionMap (Request $req)
    {
        $req->validate([
            'division_id'     => 'required',
            'district_id'      => 'required'
        ]);

        DB::table('hostel_div_district_mapping')->where('division_id', '=', $req->division_id)->delete();

        foreach($req->district_id as $key =>$item_id){
 
            $divisionsMap = new DivisionDistrictMap();
			$divisionsMap->division_id = $req->division_id;
			$divisionsMap->district_id = $req->district_id [$key];
			$divisionsMap->save();
        }

        return redirect('admin/list-division-map')->with("success", "Division Map Successfully Created.");
    }

    public function divisionMap($id)
    {
    	
        $module = DB::table('hostel_div_district_mapping')->select('district_id')->where('division_id', $id)->get();
        return $module;
    }
 

    public function deleteDivisionMap($id){
        DB::table('hostel_div_district_mapping')->where('id', '=', $id)->delete();
        //DB::table('hostel_div_district_mapping')->where('division_id', '=', $id)->delete();
        return redirect()->back()->with("success", "Hostel Division Map Successfully Deleted.");
      }
}
