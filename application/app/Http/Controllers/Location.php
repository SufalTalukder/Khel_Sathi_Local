<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Location extends Controller
{

    /**
     * Get the specified record from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getState($id)
    {
        $data = DB::table('states')->where('country_id', $id)->orderBy('name', 'ASC')->get();
        $html = '<option value="">Select State</option>';
        foreach ($data as $item) {
            $html .= '<option value="' . $item->id . '">' . $item->name . '';
        }
        return response($html);
    }

    /**
     * Get the specified record from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getCity($id)
    {
        $data = DB::table('cities')->where('state_id', $id)->orderBy('city', 'ASC')->get();
        $html = '<option value="">Select City</option>';
        foreach ($data as $item) {
            $html .= '<option value="' . $item->id . '">' . $item->city . '';
        }
        return response($html);
    }
    public function getCitybyDiv($id, $dis = "")
    {
        $district_list = DB::table('hostel_div_district_mapping')->where('division_id', $id)->get();
        $district_id = [];
        foreach ($district_list as $key => $item) {
            $district_id[] = $item->district_id;
        }
        $data = DB::table('cities')->select('city', 'id')->whereIn('id',  $district_id)->orderBy('city', 'ASC')->get();
        $html = '<option value="">Select City</option>';
        foreach ($data as $item) {
            if ($dis == $item->id) {
                $html .= '<option selected value="' . $item->id . '">' . $item->city . '';
            } else {
                $html .= '<option value="' . $item->id . '">' . $item->city . '';
            }
        }
        return response($html);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function city()
    {
        $city = DB::table('cities')
            ->select('cities.*', 'states.name as state_name')
            ->join('states', 'cities.state_id', '=', 'states.id')
            ->orderBy('city', 'ASC')->get();
        $states = DB::table('states')->orderBy('name', 'ASC')->get();
        return view('admin.location.city', compact('city', 'states'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function state()
    {
        $states = DB::table('states')->orderBy('name', 'ASC')->get();
        return view('admin.location.state', compact('states'));
    }

    /**
     * Update the resource for status change the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function stateStatus($id)
    {
        $status = DB::table('states')->where('id', $id)->first()->status;
        DB::table('states')->where('id', $id)->update(["status" => $status == 1 ? 0 : 1]);
        $msg = $status == 0 ? "Enabled" : "Disabled";
        return response()->json(['error' => false, "msg" => 'State Successfully .' . $msg]);
    }

    /**
     * Update the resource for status change the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cityStatus($id)
    {
        $status = DB::table('cities')->where('id', $id)->first()->status;
        DB::table('cities')->where('id', $id)->update(["status" => $status == 1 ? 0 : 1]);
        $msg = $status == 0 ? "Enabled" : "Disabled";
        return response()->json(['error' => false, "msg" => 'City Successfully .' . $msg]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateCity(Request $req)
    {
        DB::table('cities')->where('id', $req->city_id)->update([
            "city" => $req->upcity,
            "state_id" => $req->state_id_up
        ]);
        return response()->json(['error' => false, "msg" => 'City Successfully Updated.']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function stateUpdate(Request $req)
    {
        DB::table('states')->where('id', $req->id)->update(["name" => $req->state]);
        return response()->json(["msg" => 'State Successfully Updated.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addState(Request $req)
    {
        $validation = Validator::make($req->all(), [
            'name'           => 'required|max:30',
        ], [
            "name" => 'Please Enter State Name.'
        ]);

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        DB::table('states')->insert(["name" => $req->name, 'country_id' => 105]);
        session()->flash('success', 'State Successfully Added.');
        return response()->json(['error' => false]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addCity(Request $req)
    {
        $validation = Validator::make($req->all(), [
            'city'           => 'required|max:30',
            'state_id'           => 'required',
        ], [
            "city" => 'Please Enter City Name.',
            "state_id" => 'Please Select StateF.'
        ]);

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        DB::table('cities')->insert(["city" => $req->city, 'state_id' => $req->state_id]);
        session()->flash('success', 'City Successfully Added.');
        return response()->json(['error' => false]);
    }
}
