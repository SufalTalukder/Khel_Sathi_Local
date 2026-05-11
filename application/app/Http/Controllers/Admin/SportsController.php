<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\DivisionModel;
use App\Models\DivisionDistrictMap;
use App\Models\SportModel;
use Illuminate\Support\Facades\Auth;

class SportsController extends Controller
{
    public function index()
    {
        $sports = DB::table('sport_type')->orderBy('id', 'DESC')->get();
        return view('admin.division_master.sport-list', ['sports' => $sports]);
    }

    public function saveSport(Request $req)
    {

        $req->validate([
            'name'     => 'required|max:150|unique:sport_type',
            'status'      => 'required',
            'gender'      => 'required',


        ]);

        $sport = new SportModel();
		$sport->name = $req->name;
		$sport->status = $req->status;
        $sport->gender =$req->gender;

        $sport->ip_address = $req->ip();
        $sport->current_user_id = Auth::guard('admin')->user()->id;
		$sport->save();



    if($req->sub_type){
    foreach ($req->sub_type as $key => $value) {
        DB::table('sub_sport_type')->insert(['sport_id'=>$sport->id, 'sub_type'=> $value]);
       }
    }


        return redirect('admin/sport-list')->with("success", "Sport Successfully Created.");
    }

    public function sportStatus($id)
    {
        $divStatus = DB::table('sport_type')->where('id', $id)->first()->status;
        DB::table('sport_type')->where('id', $id)->update(["status" => $divStatus == 1 ? 0 : 1]);
        return redirect()->back()->with("success", "Sport Status Change Successfully");
    }

     public function updateSport(Request $req)
     {

        $validation = Validator::make($req->all(), [
            'name'     => 'required|max:150',
            'id'           => 'required|max:10',
            'gender'           => 'required',

        ], [
            'name'      => 'Please Enter Sport Name',
            'id'           => 'Oop! Something went wrong please reload this page and try again.',
            'gender'           => 'Please Select Gender',
        ]);

        if ($validation->fails())
             return redirect()->back()->with("error", $validation->errors()->first());

        DB::table('sport_type')->where('id', $req->id)->update(["name" => $req->name, "ip_address" => $req->ip(),"gender"=>$req->gender, "current_user_id" => Auth::guard('admin')->user()->id]);




        // if($req->sub_type){dd($req->sub_type);

        //     $old = DB::table('sub_sport_type')->where('sport_id', $req->id)->get();

        // foreach ($old as $key => $value) {
        //     DB::table('sub_sport_type')->where('id', $value->id)->delete();

        // }
        //     foreach ($req->sub_type as $key => $value) {

        //         DB::table('sub_sport_type')->insert(['sport_id'=>$req->id, 'sub_type'=> $value]);
        //     }
        // }
        return redirect()->back()->with("success", "Sport  Successfully Updated.");
    }

  //   public function deleteDivision($id){
  //       DB::table('hostel_division_master')->where('id', '=', $id)->delete();
  //       //DB::table('hostel_div_district_mapping')->where('division_id', '=', $id)->delete();
  //       return redirect()->back()->with("success", "Hostel Division Successfully Deleted.");
  //     }

  public function sport_event()
  {
      $sport_event =  DB::table('sports_event_master')->orderBy('id', 'DESC')->get();
      return view('admin.sport_event', compact('sport_event'));
  }

  public function createSEvent(Request $req)
    {
        $validation = Validator::make($req->all(), [
            'event_name'           => 'required|max:250',
        ], [
            'event_name'      => 'Please Enter Event Name'
        ]);

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        DB::table('sports_event_master')->insert(["event_name" => $req->event_name]);
        return redirect()->back()->with("success", "Sport Event  Successfully Added.");
        // return response()->json(['error' => false,'msg' => 'Sport Event  Successfully Added.' ]);
    }

    public function updateSEvent (Request $req)
    {
        $validation = Validator::make($req->all(), [
            'event_name'      => 'required|max:80',
            'id'           => 'required|max:10',
        ], [
            'event_name'      => 'Please Enter Event Name',
            'id'           => 'Oop! Something went wrong please reload this page and try again.',
        ]);
        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        DB::table('sports_event_master')->where('id', $req->id)->update(["event_name" => $req->event_name]);

        return response()->json(['error' => false,'msg' =>'Sport Event Successfully Updated.' , 'url'=>route('sport_event')]);
    }

    public function SEventStatus($id)
    {
        $status = DB::table('sports_event_master')->where('id', $id)->first()->event_status;
        DB::table('sports_event_master')->where('id', $id)->update(["event_status" => $status == 1 ? 0 : 1]);

        return response()->json(['error' => false, "msg" => 'Status Successfully Updated.' ]);
    }
    public function deleteSEvent ($id){
        DB::table('sports_event_master')->where('id', '=', $id)->delete();
        return redirect()->back()->with("success", "Sport Event Successfully Deleted.");
      }



      public function index_onlineAdmission()
      {
          $sports = DB::table('sport_onlineadmission')->orderBy('id', 'DESC')->get();
          return view('admin.division_master.sport-list-onlineAdmission', ['sports' => $sports]);
      }




      public function saveSport_onlineAdmission(Request $req)
      {
  
          $req->validate([
              'name'     => 'required|max:150|unique:sport_type',
              'status'      => 'required',
              'gender'      => 'required',
          ]);
  
   
          DB::table('sport_onlineadmission')->insert(['name'=>$req->name, 'status'=> $req->status, 'gender'=>$req->gender, 'ip_address'=>$req->ip(),'current_user_id'=>Auth::guard('admin')->user()->id  ]);
  
  
      if($req->sub_type){
      foreach ($req->sub_type as $key => $value) {
          DB::table('sub_sport_type')->insert(['sport_id'=>$sport->id, 'sub_type'=> $value]);
         }
      }
  
  
          return redirect('admin/sport-list-onlineAdmission')->with("success", "Sport Successfully Created.");
      }
  
      public function sportStatus_onlineAdmission($id)
      {
          $divStatus = DB::table('sport_onlineadmission')->where('id', $id)->first()->status;
          DB::table('sport_onlineadmission')->where('id', $id)->update(["status" => $divStatus == 1 ? 0 : 1]);
          return redirect()->back()->with("success", "Sport Status Change Successfully");
      }
  
       public function updateSport_onlineAdmission(Request $req)
       {
  
          $validation = Validator::make($req->all(), [
              'name'     => 'required|max:150',
              'id'           => 'required|max:10',
              'gender'           => 'required',
  
          ], [
              'name'      => 'Please Enter Sport Name',
              'id'           => 'Oop! Something went wrong please reload this page and try again.',
              'gender'           => 'Please Select Gender',
          ]);
  
          if ($validation->fails())
               return redirect()->back()->with("error", $validation->errors()->first());
  
          DB::table('sport_onlineadmission')->where('id', $req->id)->update(["name" => $req->name, "ip_address" => $req->ip(),"gender"=>$req->gender, "current_user_id" => Auth::guard('admin')->user()->id]);
  
  

          return redirect()->back()->with("success", "Sport  Successfully Updated.");
      }
  






}
