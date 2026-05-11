<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminRole extends Controller
{
    public function index()
    {
        $role =  DB::table('urm_role_manager')->orderBy('id', 'DESC')->get();
        return view('admin.role.index', compact('role'));
    }
    public function createRole(Request $req)
    {
        $validation = Validator::make($req->all(), [
            'role_name'           => 'required|max:250',
        ], [
            'role_name'      => 'Please Enter Role Name'
        ]);

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        DB::table('urm_role_manager')->insert(["role_name" => $req->role_name]);
        session()->flash('success', 'Role Successfully Added.');
        return redirect()->back()->with("success", "Role  Successfully Added.");
        // return response()->json(['error' => false,'msg' => 'Role Successfully Added.' , 'url'=>route('roles')]);
    }

    public function updateRole(Request $req)
    {
        $validation = Validator::make($req->all(), [
            'name'      => 'required|max:80',
            'id'           => 'required|max:10',
        ], [
            'name'      => 'Please Enter Role Name',
            'id'           => 'Oop! Something went wrong please reload this page and try again.',
        ]);
        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        DB::table('urm_role_manager')->where('id', $req->id)->update(["role_name" => $req->name]);
        session()->flash('success', 'Role Successfully Updated.');
        return response()->json(['error' => false,'msg' =>'Role Successfully Updated.' ]);
        // return redirect()->back()->with("success", "Role  Successfully Updated.");
    }

    public function roleStatus($id)
    {
        $status = DB::table('urm_role_manager')->where('id', $id)->first()->role_status;
        DB::table('urm_role_manager')->where('id', $id)->update(["role_status" => $status == 1 ? 0 : 1]);
        $msg = $status == 0 ? "Enabled" : "Disabled";
        return response()->json(['error' => false, "msg" => 'Role Successfully .' . $msg]);
    }
    public function deleteRole($id){
        DB::table('urm_role_manager')->where('id', '=', $id)->delete();
        return redirect()->back()->with("success", "Role Manager Successfully Deleted.");
      }
}
