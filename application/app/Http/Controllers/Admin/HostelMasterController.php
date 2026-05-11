<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\DivisionModel;
use App\Models\DivisionDistrictMap;
use App\Models\HostelMaster;
use Illuminate\Support\Facades\Auth;

class HostelMasterController extends Controller
{
    public function index()
    {
    	$divisions = DivisionModel::select('division_name','id')->get();
      $districts = DB::table('cities')->select('city', 'id')->where('state_id', '23')->get();
      $sports = DB::table('sport_master')->select('name', 'id')->where('status', '1')->get();
      return view('admin.division_master.hostel_master_list', ['divisions' => $divisions, 'districts' => $districts, 'sports' => $sports]);
    }

    public function listHostelMaster(Request $request)
    {
      $divisions = DivisionModel::select('division_name','id')->get();
      $districts = DB::table('cities')->select('city', 'id')->where('state_id', '23')->get();
      // $sports = DB::table('sport_master')->select('name', 'id')->where('status', '1')->get();

      $lists = DB::table('hostel_master')->select('hostel_master.id','sports', 'hostel_master.hostel_name', 'hostel_master.total_seats', 'hostel_master.boys', 'hostel_master.boys_alloted', 'hostel_master.girls_alloted', 'hostel_master.girls', 'hostel_master.seat_used','hostel_master.created_at', 'hostel_master.updated_at', 'cities.city', 'hostel_division_master.division_name')
        ->join('cities','cities.id','=','hostel_master.districts')
        ->join('sport_master','sport_master.id','=','hostel_master.sports')
        ->join('hostel_division_master','hostel_division_master.id','=','hostel_master.division_name');


         if ($request->isMethod('post')) {
               if ($request->has('hostel_name')) {
                 $lists->where( 'hostel_master.hostel_name', 'LIKE', '%' . $request->hostel_name . '%' );
            }

            // Search for a user based on their company.
            if ($request->has('division_name')) {
              //dd($request->division_name);
                $lists->where( 'hostel_master.division_name', 'LIKE', '%' . $request->division_name . '%' );
            }

            // Search for a user based on their city.
            if ($request->has('districts')) {
                $lists->where( 'hostel_master.districts', 'LIKE', '%' . $request->districts . '%' );
            }
        }
        $data=$lists->get();
      //  dd($data);

      return view('admin.division_master.hostel_master_show', ['divisions' => $divisions, 'districts' => $districts,  'lists' => $data]);
    }

    public function saveHostelMaster (Request $req)
    {


      $validation = Validator::make($req->all(), [
            'hostel_name'     => 'required|unique:hostel_master',
            'division_name'   => 'required',
            'districts'       => 'required',
            'total_seats'     => 'required',
            'boys'            => 'required',
            'girls'           => 'required',
            'sports'          => 'required',
            'seat_used'       => 'required',
            'girls_seat_used' => 'required',
            'boys_seat_used'  => 'required'
        ], [
            'hostel_name'      => 'Please Enter Unique hostel Name'
        ]);

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        $hostelMaster = new HostelMaster();
        $hostelMaster->hostel_name = $req->hostel_name;
        $hostelMaster->division_name = $req->division_name;
        $hostelMaster->districts = $req->districts;
        $hostelMaster->total_seats = $req->total_seats;
        $hostelMaster->boys = $req->boys;
        $hostelMaster->girls = $req->girls;
        $hostelMaster->sports = implode(',', $req->sports);
        $hostelMaster->seat_used = $req->seat_used;
        $hostelMaster->girls_alloted = $req->girls_seat_used;
        $hostelMaster->boys_alloted = $req->boys_seat_used;
        $hostelMaster->ip_address = $req->ip();
        $hostelMaster->current_user_id = Auth::guard('admin')->user()->id;
        $hostelMaster->save();

        // return redirect('admin/hostel-master')->with("success", "Hostel Master Successfully Created.");
        return response()->json(["error" => false, "msg" => "Hostel Master Successfully Created", "url" => route('hostelMaster')]);
    }

    public function divisionMap($id)
    {

        $module = DB::table('hostel_div_district_mapping')->select('district_id')->where('division_id', $id)->get();
        return $module;
    }

    public function fetchCities(Request $request)
      {
        $data['cities'] = DB::table('hostel_div_district_mapping')->join('cities','hostel_div_district_mapping.district_id','=','cities.id')->select('city','district_id')->where('division_id',$request->division_id)->get();
        return response()->json($data);
      }

   public function editHotelMaster($id){

      $divisions = HostelMaster::find(decrypt($id));
      //dd($divisions);
      $divisionss = DivisionModel::select('division_name','id')->get();
      $districts = DB::table('cities')->select('city', 'id')->where('state_id', '23')->get();
      $sports = DB::table('sport_master')->select('name', 'id')->where('status', '1')->get();

      $spo = explode(",", $divisions->sports);

      return view('admin.division_master.hostel_master_edit', ['divisions' => $divisions, 'divisionss' => $divisionss, 'districts' => $districts, 'sports' => $sports,'spo'=>$spo]);
    }

    public function updateHotelMaster (Request $req, $id)
    {

      //dd($req->all());
      $validation = Validator::make($req->all(), [
            'hostel_name'     => 'required',
            'division_name'   => 'required',
            'districts'       => 'required',
            'total_seats'     => 'required',
            'boys'            => 'required',
            'girls'           => 'required',
            'sports'          => 'required',
            'seat_used'       => 'required',
            'girls_seat_used' => 'required',
            'boys_seat_used'  => 'required'
        ], [
            'hostel_name'      => 'Please Enter Unique hostel Name'
        ]);

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        $hostelMaster = HostelMaster::find(decrypt($id));
        $hostelMaster->hostel_name    = $req->hostel_name;
        $hostelMaster->division_name  = $req->division_name;
        $hostelMaster->districts      = $req->districts;
        $hostelMaster->total_seats    = $req->total_seats;
        $hostelMaster->boys           = $req->boys;
        $hostelMaster->girls          = $req->girls;
        $hostelMaster->sports         = implode(',', $req->sports);
        $hostelMaster->seat_used      = $req->seat_used;
        $hostelMaster->girls_alloted  = $req->girls_seat_used;
        $hostelMaster->boys_alloted   = $req->boys_seat_used;
        $hostelMaster->ip_address     = $req->ip();
        $hostelMaster->current_user_id = Auth::guard('admin')->user()->id;
        $hostelMaster->update();

        //return redirect('admin/hostel-master')->with("success", "Hostel Master Successfully Updated.");
        return response()->json(["error" => false, "msg" => "Hostel Master Successfully Updated", "url" => route('hostelMaster')]);
    }

     // public function deleteDivisionMap($id){
     //    DB::table('hostel_div_district_mapping')->where('id', '=', $id)->delete();
     //    //DB::table('hostel_div_district_mapping')->where('division_id', '=', $id)->delete();
     //    return redirect()->back()->with("success", "Hostel Division Map Successfully Deleted.");
     //  }
}
