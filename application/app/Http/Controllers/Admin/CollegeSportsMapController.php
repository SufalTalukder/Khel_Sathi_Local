<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\DivisionModel;
use App\Models\DivisionDistrictMap;
use App\Models\SportModel;
use App\Models\SportModelMaster;
use App\Models\DistrictModel;
use App\Models\CollegeSportsMapModel;

class CollegeSportsMapController extends Controller
{
    public function index()
    {
        $colleges = SportModelMaster::select('college_name','id')->get();
        $sports = DB::table('sport_type')->select('name', 'id')->orderBy('name', 'ASC')->get();
        // $sports = DB::table('sport_type')
        // ->join('college_sports_mapping', 'sport_type.id', '=', 'college_sports_mapping.sports_id')
        // ->select('sport_type.name', 'college_sports_mapping.sports_id', 'sport_type.id')->get();

        $lists = DB::table('college_sports_mapping')
        ->join('sport_type', 'sport_type.id', '=', 'college_sports_mapping.sports_id')
        ->join('sports_college_master', 'sports_college_master.id', '=', 'college_sports_mapping.college_id')
        ->select('sport_type.name','college_sports_mapping.*', 'sports_college_master.college_name')
        ->orderBy('college_sports_mapping.id', 'DESC')->get();

        return view('admin.division_master.college_sports_mapping', ['sports' => $sports, 'colleges' => $colleges, 'lists' => $lists]);
    }

    public function saveSportCollegeMap (Request $req)
    {
      //dd($req->all());
        $req->validate([
            'college_name'     => 'required',
            'gender'     => 'required',
            'sport_id'         => 'required'
        ]);

        //DB::table('college_sports_mapping')->where('college_id', '=', $req->college_name)->delete();

        foreach($req->sport_id as $key =>$item_id){
 
            $collegeMap = new CollegeSportsMapModel();
            $collegeMap->college_id = $req->college_name;
            $collegeMap->gender = $req->gender;
            $collegeMap->sports_id = $req->sport_id [$key];
            $collegeMap->save();
        }

        return redirect('admin/college-sports-map-list')->with("success", "Sport And College Map Successfully Created.");
    }
 
    public function checkedStatus($id){
            $module = DB::table('college_sports_mapping')->select('sports_id')->where('college_id', $id)->get();
        return $module;
    }

    public function deleteSportCollege($id){
        DB::table('college_sports_mapping')->where('id', '=', $id)->delete();
        //DB::table('hostel_div_district_mapping')->where('division_id', '=', $id)->delete();
        return redirect()->back()->with("success", "Sport College Map Successfully Deleted.");
    }
}
