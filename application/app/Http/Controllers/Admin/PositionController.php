<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class PositionController extends Controller
{
    public function competition()
    {
        $position_comp = DB::table('position_competition_master')->orderBy('name', 'ASC')->get();
        return view('admin.position.competition_master', compact('position_comp'));
    }
    public function addPositionComp(Request $req)
    {
        $validation = Validator::make($req->all(), [
            'name'           => 'required',
        ], [
            "name" => 'Please Enter Competition Name.'
        ]);

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        DB::table('position_competition_master')->insert(["name" => $req->name, 'status' => 1]);
        session()->flash('success', 'Competition Successfully Added.');
        return response()->json(['error' => false]);
    }
    public function compUpdate(Request $req)
    {
        DB::table('position_competition_master')->where('id', $req->id)->update(["name" => $req->name]);
        return response()->json(["msg" => 'Competition Successfully Updated.']);
    }

    public function event()
    {
        $position_event = DB::table('position_event_master')->orderBy('name', 'ASC')->get();
        return view('admin.position.event_master', compact('position_event'));
    }
    public function addPositionEvent(Request $req)
    {
        $validation = Validator::make($req->all(), [
            'name'  => 'required',
        ], [
            "name" => 'Please Enter Competition Name.'
        ]);

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        DB::table('position_event_master')->insert(["name" => $req->name, 'status' => 1]);
        session()->flash('success', 'Event Successfully Added.');
        return response()->json(['error' => false]);
    }
    public function eventUpdate(Request $req)
    {
        DB::table('position_event_master')->where('id', $req->id)->update(["name" => $req->name]);
        return response()->json(["msg" => 'Event Successfully Updated.']);
    }

    public function event_competition_map()
    {
        $position_event = DB::table('position_event_master')->orderBy('name', 'ASC')->get();
        $position_comp = DB::table('position_competition_master')->orderBy('name', 'ASC')->get();
        $event_competition_master = DB::table('event_competition_map_master')
        ->join('position_event_master', 'position_event_master.id','=','event_competition_map_master.event_id')
        ->join('position_competition_master', 'position_competition_master.id','=','event_competition_map_master.comp_id')
        ->select('position_event_master.name as event','position_competition_master.name as comp','event_competition_map_master.id','event_competition_map_master.event_type','event_competition_map_master.form_type')
        ->orderBy('event_competition_map_master.form_type', 'ASC')->orderBy('position_competition_master.name', 'ASC')->get();
        return view('admin.position.event_competition_map', ['position_event' => $position_event,'position_comp' => $position_comp,'event_competition_master' => $event_competition_master]);
    } 

    public function mapCompEvent(Request $req)
    {
        $validation = Validator::make($req->all(), [
            'comp_name'  => 'required',
            'event_name'  => 'required',
            'event_type'  => 'required',
            'form_type'  => 'required',
        ]);

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        DB::table('event_competition_map_master')->insert(["comp_id" => $req->comp_name, "event_id" => $req->event_name,"event_type" => $req->event_type,"form_type" => $req->form_type]);
        session()->flash('success', 'Competition Event Map Successfully.');
        return response()->json(['error' => false]);
    }
    public function deleteComEvent($id){
        DB::table('event_competition_map_master')->where('id', '=', $id)->delete();
        //DB::table('hostel_div_district_mapping')->where('division_id', '=', $id)->delete();
        return redirect()->back()->with("success", "Competition Event Map Successfully Deleted.");
      }
}
