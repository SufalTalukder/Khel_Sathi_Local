<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SolarPlant extends Model
{
    use HasFactory;

    static function powerProjectppaSave($req)
    {
        $validation = Validator::make($req->all(), [
            'area_of_land'      => 'required|numeric',
            'preference_first'  => 'required',
            'preference_second' => 'required',
            'preference_third'  => 'required',
        ], [
            'area_of_land.required' => 'Please Enter Proposed Area of Land',
            'area_of_land.numeric'  => 'Please Enter Valid Proposed Area of Land',
            'preference_first'      => 'Please Select Preference 1.',
            'preference_second'     => 'Please Select Preference 2.',
            'preference_third'      => 'Please Select Preference 3.',
        ]);

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        $regid = Auth::id();


        $id =  DB::table('user_project_summary')->insertGetId([
            "regid" =>  $regid,
            "project_id" => getProjectId(),
            "type" => 'SG001',
            "project_name" => 'Solar Power Project PPA with UPPCL',
            "application_date" => date('Y-m-d')
        ]);

        DB::table('power_project_ppa')->insert([
            'area_of_land'      => $req->area_of_land,
            'preference_first'  => $req->preference_first,
            'preference_second' => $req->preference_second,
            'preference_third'  => $req->preference_third,
            'regid'             => $regid,
            'summary_id'        => $id
        ]);

        SolarPlant::CreateLog([
            "primary_id" => $id,
            "primary_id_comment" => " table : user_project_summary , key : id ",
            "user_id" => $regid,
            "type" => 3,
            "description" => "Solar Power Project PPA with UPPCL"
        ]);

        session()->flash('success', 'Solar Power Project PPA Successfully Updated.');
        return response()->json(['error' => false, 'type' => 1]);
    }

    static function powerProjectPublicParkSave($req)
    {
        $validation = Validator::make($req->all(), [
            'approval_of_park'  => 'required',
            'sanction_number'   => 'required',
            'sanction_date'     => 'required',
            'sanction_capacity' => 'required|numeric',
            'sub_station'       => 'required',
            'voltage'           => 'required|numeric',
            'area_of_land'      => 'required|numeric',
            'preference_first'  => 'required',
            'preference_second' => 'required',
            'preference_third'  => 'required',
        ], msg());

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        $regid = Auth::id();

        $id = DB::table('user_project_summary')->insertGetId([
            "regid" => $regid,
            "project_id" => getProjectId(),
            "type" => 'SG003',
            "project_name" => 'Solar Power Park Public Sector',
            "application_date" => date('Y-m-d')
        ]);

        DB::table('power_solar_public_park')->insert([
            'approval_of_park'  => $req->approval_of_park,
            'sanction_number'   => $req->sanction_number,
            'sanction_date'     => $req->sanction_date,
            'sanction_capacity' => $req->sanction_capacity,
            'sub_station'       => $req->sub_station,
            'voltage'           => $req->voltage,
            'area_of_land'      => $req->area_of_land,
            'preference_first'  => $req->preference_first,
            'preference_second' => $req->preference_second,
            'preference_third'  => $req->preference_third,
            'regid'             => $regid,
            'summary_id'        => $id
        ]);

        SolarPlant::CreateLog([
            "primary_id" => $id,
            "primary_id_comment" => " table : user_project_summary , key : id ",
            "user_id" => $regid,
            "type" => 3,
            "description" => "Solar Power Park Public Sector"
        ]);

        session()->flash('success', 'Solar Power Park Public Sector Successfully Updated.');
        return response()->json(['error' => false, 'type' => 2]);
    }


    static function powerProjectPrivateParkSave($req)
    {

        $validation = Validator::make($req->all(), [
            'sanction_number'   => 'required',
            'sanction_date'     => 'required',
            'sanction_capacity' => 'required|numeric',
            'sub_station'       => 'required',
            'voltage'           => 'required|numeric',
            'area_of_land'      => 'required|numeric',
            'preference_first'  => 'required',
            'preference_second' => 'required',
            'preference_third'  => 'required',
        ], msg());

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        $regid = Auth::id();

        $id = DB::table('user_project_summary')->insertGetId([
            "regid" => $regid,
            "project_id" => getProjectId(),
            "type" => 'SG004',
            "project_name" => 'Solar Power Park Private Sector',
            "application_date" => date('Y-m-d')
        ]);

        DB::table('power_solar_private_park')->insert([
            'status_of_solar_park'      => $req->status_of_solar_park,
            'connectivity'              => $req->connectivity,
            'grant_form_mnre'           => $req->grant_form_mnre,
            'setup_for_solar_park_mnre' => $req->setup_for_solar_park_mnre,
            'sanction_number'   => $req->sanction_number,
            'sanction_date'     => $req->sanction_date,
            'sanction_capacity' => $req->sanction_capacity,
            'sub_station'       => $req->sub_station,
            'voltage'           => $req->voltage,
            'area_of_land'      => $req->area_of_land,
            'preference_first'  => $req->preference_first,
            'preference_second' => $req->preference_second,
            'preference_third'  => $req->preference_third,
            'regid'             => $regid,
            'summary_id'        => $id
        ]);

        SolarPlant::CreateLog([
            "primary_id" => $id,
            "primary_id_comment" => " table : user_project_summary , key : id ",
            "user_id" => $regid,
            "type" => 3,
            "description" => "Solar Power Park Private Sector"
        ]);

        session()->flash('success', 'Solar Power Park Private Sector Successfully Updated.');
        return response()->json(['error' => false, 'type' => 3]);
    }

    static function projectDeatils($type, $id)
    {
        $regid = Auth::id();
        $project_name = '';
        /* if ($type == 'SG001') {
            $items = DB::table('power_project_ppa')->where('summary_id', $id)->first();
        } elseif ($type == 'SG003') {
            $items = DB::table('power_solar_public_park')->where('summary_id', $id)->first();
        } elseif ($type == 'SG004') {
            $items = DB::table('power_solar_private_park')->where('summary_id', $id)->first();
        } elseif ($type == 'SG002') {
            $items = DB::table('power_project_openaccess')->where('summary_id', $id)->first();
        } elseif ($type == 'SG009') {
            $items = DB::table('power_project_other')->where('summary_id', $id)->first();
        } */

        if (DB::table('power_project_ppa')->where('summary_id', $id)->exists()) {
            $items = DB::table('power_project_ppa')->where('summary_id', $id)->first();
        } else {

            if (DB::table('power_solar_public_park')->where('summary_id', $id)->exists()) {
                $items = DB::table('power_solar_public_park')->where('summary_id', $id)->first();
            } else {

                if (DB::table('power_solar_private_park')->where('summary_id', $id)->exists()) {
                    $items = DB::table('power_solar_private_park')->where('summary_id', $id)->first();
                } else {

                    if (DB::table('power_project_openaccess')->where('summary_id', $id)->exists()) {
                        $items = DB::table('power_project_openaccess')->where('summary_id', $id)->first();
                    } else {

                        if (DB::table('power_project_other')->where('summary_id', $id)->exists()) {
                            $items = DB::table('power_project_other')->where('summary_id', $id)->first();
                        }
                    }
                }
            }
        }

        $table = DB::table('user_project_summary')->where('id', $id)->where('regid', $regid);

        if ($table->exists())
            $project_name = $table->limit(1)->first()->project_name;

        $data['state']          = DB::table('cities')->select('id', 'city as name')->where('state_id', 23)->orderBy('name', 'ASC')->get();
        $data['project_name']   = $project_name;
        $data['type']           = $type;
        $data['items']          = $items;
        $data['id']             = $id;
        $data['summary']        = DB::table('project_log')
            ->join('user_project_summary', 'project_log.primary_id', '=', 'user_project_summary.id')
            ->where('primary_id', $items->summary_id)
            ->orderBy('project_log.id', 'DESC')
            ->select('project_log.type', 'project_log.created_at', 'user_project_summary.application_status')
            ->get();
        $data['station']        = DB::table('sub_station')->orderBy('name', 'ASC')->get();
        $data['profile']        = DB::table('up_investor_registration_master')->where('id', $regid)->first();

        return $data;
    }

    static function plantExists()
    {
        $id = Auth::id();
        $ppa = DB::table('power_project_ppa')->where('regid', Auth::id())->count();
        $pspp = DB::table('power_solar_public_park')->where('regid', Auth::id())->count();
        $psprp = DB::table('power_solar_private_park')->where('regid', Auth::id())->count();
    }

    static function projectDeatilsaAdmin($type, $id)
    {
        $table = DB::table('user_project_summary')->where('id', $id)->limit(1)->first();
        $project_name = $table->project_name;
        $regid = $table->regid;
        $data['forwarded'] = $table->forwarded;

        if ($type == 'SG001') {
            $items = DB::table('power_project_ppa')->where('summary_id', $id)->first();
        } elseif ($type == 'SG003') {
            $items = DB::table('power_solar_public_park')->where('summary_id', $id)->first();
        } elseif ($type == 'SG004') {
            $items = DB::table('power_solar_private_park')->where('summary_id', $id)->first();
        } elseif ($type == 'SG002') {
            $items = DB::table('power_project_openaccess')->where('summary_id', $id)->first();
        } elseif ($type == 'SG009') {
            $items = DB::table('power_project_other')->where('summary_id', $id)->first();
        }

        $data['state']          = DB::table('cities')->select('id', 'city as name')->where('state_id', 23)->orderBy('name', 'ASC')->get();
        $data['project_name']   = $project_name;
        $data['type']           = $type;
        $data['items']          = $items;
        $data['id']             = $id;

        $data['summary']        = DB::table('project_log')
            ->join('user_project_summary', 'project_log.primary_id', '=', 'user_project_summary.id')
            ->where('primary_id', $items->summary_id)
            ->orderBy('project_log.id', 'DESC')
            ->select('project_log.type', 'project_log.created_at', 'user_project_summary.application_status')
            ->get();
        $data['station']        = DB::table('sub_station')->orderBy('name', 'ASC')->get();
        $data['profile']        = DB::table('up_investor_registration_master')->where('id', $regid)->first();

        return $data;
    }


    static function powerSolarOpenAccess($req)
    {
        $validation = Validator::make($req->all(), [
            'usertype'                      => 'required',
            'is_connectivity'               => 'required',
            'load_capacity'                 => 'required',
            'connectivity'                  => 'required',
            'preference_first_substation'   => 'required',
            'preference_second_substation'  => 'required',
            'preference_third_substation'   => 'required',
            'at_voltage'                    => 'required'
        ], [
            'load_capacity'                 => 'Please Enter Load Capacity.',
            'connectivity'                  => 'Please Select Connectivity.',
            'preference_first_substation'   => 'Please Select Preferred Sub Station 1.',
            'preference_second_substation'  => 'Please Select Preferred Sub Station 2.',
            'preference_third_substation'   => 'Please Select Preferred Sub Station 3.',
            'at_voltage'                    => 'Please Enter At Voltage.'
        ]);

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        $regid = Auth::id();

        $id = DB::table('user_project_summary')->insertGetId([
            "regid" => $regid,
            "project_id" => getProjectId(),
            "type" => 'SG002',
            "project_name" => 'Solar Power Project under Open Access',
            "application_date" => date('Y-m-d')
        ]);

        DB::table('power_project_openaccess')->insert([
            'usertype' => $req->usertype,
            'is_connectivity' => $req->is_connectivity,
            'load_capacity' => $req->load_capacity,
            'connectivity' => $req->connectivity,
            'preference_first_substation' => $req->preference_first_substation,
            'preference_second_substation' => $req->preference_second_substation,
            'preference_third_substation' => $req->preference_third_substation,
            'at_voltage' => $req->at_voltage,
            'regid' => $regid,
            'summary_id' => $id
        ]);

        SolarPlant::CreateLog([
            "primary_id" => $id,
            "primary_id_comment" => " table : user_project_summary , key : id ",
            "user_id" => $regid,
            "type" => 3,
            "description" => "Solar Power Project under Open Access"
        ]);

        session()->flash('success', 'Solar Power Project under Open Access Successfully Updated.');
        return response()->json(['error' => false, 'type' => 22]);
    }


    static function powerSolarOpenAccessUpdate($req)
    {
        $validation = Validator::make($req->all(), [
            'usertype'                      => 'required',
            'is_connectivity'               => 'required',
            'load_capacity'                 => 'required',
            'connectivity'                  => 'required',
            'preference_first_substation'   => 'required',
            'preference_second_substation'  => 'required',
            'preference_third_substation'   => 'required',
            'at_voltage'                    => 'required'
        ], [
            'load_capacity'                 => 'Please Enter Load Capacity.',
            'connectivity'                  => 'Please Select Connectivity.',
            'preference_first_substation'   => 'Please Select Preferred Sub Station 1.',
            'preference_second_substation'  => 'Please Select Preferred Sub Station 2.',
            'preference_third_substation'   => 'Please Select Preferred Sub Station 3.',
            'at_voltage'                    => 'Please Enter At Voltage.'
        ]);

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);


        $beforeUpdate = DB::table('power_solar_public_park')->where('id', $req->rowid)->first();

        $newData = [
            'usertype' => $req->usertype,
            'is_connectivity' => $req->is_connectivity,
            'load_capacity' => $req->load_capacity,
            'connectivity' => $req->connectivity,
            'preference_first_substation' => $req->preference_first_substation,
            'preference_second_substation' => $req->preference_second_substation,
            'preference_third_substation' => $req->preference_third_substation,
            'at_voltage' => $req->at_voltage
        ];

        DB::table('power_project_openaccess')->where('id', $req->rowid)->update($newData);

        SolarPlant::CreateLog([
            "primary_id" => $req->rowid,
            "primary_id_comment" => " table : power_project_openaccess , key : id ",
            "user_id" => Auth::id(),
            "type" => 4,
            "exist_or_new_data" => json_encode(["exist" => $beforeUpdate, "new" => $newData]),
            "description" => "Solar Power Project under Open Access"
        ]);

        session()->flash('success', 'Solar Power Project under Open Access Successfully Updated.');
        return response()->json(['error' => false, 'type' => 22]);
    }


    static function powerProjectppaUpdate($req)
    {
        $validation = Validator::make($req->all(), [
            'area_of_land'      => 'required|numeric',
            'preference_first'  => 'required',
            'preference_second' => 'required',
            'preference_third'  => 'required',
        ], [
            'area_of_land.required' => 'Please Enter Proposed Area of Land',
            'area_of_land.numeric'  => 'Please Enter Valid Proposed Area of Land',
            'preference_first'      => 'Please Select Preference 1.',
            'preference_second'     => 'Please Select Preference 2.',
            'preference_third'      => 'Please Select Preference 3.',
        ]);

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        $beforeUpdate = DB::table('power_solar_public_park')->where('id', $req->rowid)->first();
        $newData = [
            'area_of_land'      => $req->area_of_land,
            'preference_first'  => $req->preference_first,
            'preference_second' => $req->preference_second,
            'preference_third'  => $req->preference_third
        ];
        DB::table('power_project_ppa')->where('id', $req->rowid)->update($newData);

        SolarPlant::CreateLog([
            "primary_id" => $req->rowid,
            "primary_id_comment" => " table : power_project_ppa , key : id ",
            "user_id" => Auth::id(),
            "type" => 4,
            "exist_or_new_data" => json_encode(["exist" => $beforeUpdate, "new" => $newData]),
            "description" => "Solar Power Project PPA"
        ]);

        session()->flash('success', 'Solar Power Project PPA Successfully Updated.');
        return response()->json(['error' => false, 'type' => 1]);
    }

    static function powerProjectPublicParkUpdate($req)
    {
        $validation = Validator::make($req->all(), [
            'approval_of_park'  => 'required',
            'sanction_number'   => 'required',
            'sanction_date'     => 'required',
            'sanction_capacity' => 'required|numeric',
            'sub_station'       => 'required',
            'voltage'           => 'required|numeric',
            'area_of_land'      => 'required|numeric',
            'preference_first'  => 'required',
            'preference_second' => 'required',
            'preference_third'  => 'required',
        ], msg());

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        $beforeUpdate = DB::table('power_solar_public_park')->where('id', $req->rowid)->first();
        $newData = [
            'approval_of_park'  => $req->approval_of_park,
            'sanction_number'   => $req->sanction_number,
            'sanction_date'     => $req->sanction_date,
            'sanction_capacity' => $req->sanction_capacity,
            'sub_station'       => $req->sub_station,
            'voltage'           => $req->voltage,
            'area_of_land'      => $req->area_of_land,
            'preference_first'  => $req->preference_first,
            'preference_second' => $req->preference_second,
            'preference_third'  => $req->preference_third
        ];
        DB::table('power_solar_public_park')->where('id', $req->rowid)->update($newData);

        SolarPlant::CreateLog([
            "primary_id" => $req->rowid,
            "primary_id_comment" => " table : power_solar_public_park , key : id ",
            "user_id" => Auth::id(),
            "type" => 4,
            "exist_or_new_data" => json_encode(["exist" => $beforeUpdate, "new" => $newData]),
            "description" => "Solar Power Park Public Sector"
        ]);

        session()->flash('success', 'Solar Power Park Public Sector Successfully Updated.');
        return response()->json(['error' => false, 'type' => 2]);
    }


    static function powerProjectPrivateParkUpdate($req)
    {

        $validation = Validator::make($req->all(), [
            'sanction_number'   => 'required',
            'sanction_date'     => 'required',
            'sanction_capacity' => 'required|numeric',
            'sub_station'       => 'required',
            'voltage'           => 'required|numeric',
            'area_of_land'      => 'required|numeric',
            'preference_first'  => 'required',
            'preference_second' => 'required',
            'preference_third'  => 'required',
        ], msg());

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        $beforeUpdate = DB::table('power_solar_private_park')->where('id', $req->rowid)->first();
        $newData = [
            'status_of_solar_park'      => $req->status_of_solar_park,
            'connectivity'              => $req->connectivity,
            'grant_form_mnre'           => $req->grant_form_mnre,
            'setup_for_solar_park_mnre' => $req->setup_for_solar_park_mnre,
            'sanction_number'   => $req->sanction_number,
            'sanction_date'     => $req->sanction_date,
            'sanction_capacity' => $req->sanction_capacity,
            'sub_station'       => $req->sub_station,
            'voltage'           => $req->voltage,
            'area_of_land'      => $req->area_of_land,
            'preference_first'  => $req->preference_first,
            'preference_second' => $req->preference_second,
            'preference_third'  => $req->preference_third
        ];

        DB::table('power_solar_private_park')->where('id', $req->rowid)->update($newData);

        SolarPlant::CreateLog([
            "primary_id" => $req->rowid,
            "primary_id_comment" => " table : power_solar_private_park , key : id ",
            "user_id" => Auth::id(),
            "type" => 4,
            "exist_or_new_data" => json_encode(["exist" => $beforeUpdate, "new" => $newData]),
            "description" => "Solar Power Park Private Sector"
        ]);

        session()->flash('success', 'Solar Power Park Private Sector Successfully Updated.');
        return response()->json(['error' => false, 'type' => 3]);
    }

    static function CreateLog($data)
    {
        DB::table('project_log')->insert($data);
    }

    static function CreateForward($data) 
    {
        DB::table('project_forwards_master')->insert($data);
    }

    static function UpdateForward($condition, $data)
    {
        DB::table('project_forwards_master')->where([$condition])->update($data);
    }

    static function UpdateSummary($condition, $data)
    {
        DB::table('user_project_summary')->where([$condition])->update($data);
    }
}
