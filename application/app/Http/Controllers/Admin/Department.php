<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class Department extends Controller
{
    public function index()
    {
        $department =  DB::table('department_master')->orderBy('id', 'DESC')->get();
        return view('admin.department.index', compact('department'));
    }
 
    public function addDepartment(Request $req)
    {
        $validation = Validator::make($req->all(), [
            'department'           => 'required|max:80',
            'department_code'      => 'required|max:10',
        ], msg());

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        DB::table('department_master')->insert($req->all());
        session()->flash('success', 'Department Successfully Added.');
        return response()->json(['error' => false]);
    }
    public function departmentStatus($id)
    {
        $status = DB::table('department_master')->where('id', $id)->first()->status;
        DB::table('department_master')->where('id', $id)->update(["status" => $status == 1 ? 0 : 1]);
        $msg = $status == 0 ? "Enabled" : "Disabled";
        return response()->json(['error' => false, "msg" => 'Department Successfully .' . $msg]);
    }

    public function updateDepartment(Request $req)
    {
        $validation = Validator::make($req->all(), [
            'up_department'      => 'required|max:80',
            'up_department_code' => 'required|max:10',
            'department_id'      => 'required|max:10',
        ], [
            'up_department'      => 'Please Enter Department Name',
            'up_department_code' => 'Please Enter Department Code',
            'department_id'      => 'Oop! Something went wrong please reload this page and try again.',
        ]);

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        DB::table('department_master')->where('id', $req->department_id)->update([
            'department'      => $req->up_department,
            'department_code' => $req->up_department_code,
        ]);
        //session()->flash('success', 'Department Successfully Updated.');
        return response()->json(['error' => false,'msg'=>'Department Successfully Updated.']);
    }
}
