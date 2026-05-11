<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Menu extends Controller
{
    public function menu()
    {
        $menu = DB::table('menu')->orderBy('name', 'ASC')->get();
        return view('admin.menu.menu', compact('menu'));
    }

    public function menuCreate(Request $req)
    {
        $validation = Validator::make($req->all(), [
            'menu_name'           => 'required|max:150',
            'order'               => 'required|numeric'
        ], [
            'menu_name' => 'Please Enter Menu Name.',
            'order' => 'Please Enter Order.'
        ]);

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        DB::table('menu')->insert([
            "name" => $req->menu_name,
            "order" => $req->order
        ]);

        session()->flash('success', 'Menu Successfully Added.');
        return response()->json(['error' => false]);
    }

    public function menuUpdate(Request $req)
    {
        $validation = Validator::make($req->all(), [
            'up_menu_name'           => 'required|max:150',
            'up_order'               => 'required|numeric'
        ], [
            'up_menu_name' => 'Please Enter Menu Name.',
            'up_order' => 'Please Enter Order.'
        ]);

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        DB::table('menu')->where('id',$req->menu_di)->update([
            "name" => $req->up_menu_name,
            "order" => $req->up_order
        ]);

        session()->flash('success', 'Menu Successfully Updated.');
        return response()->json(['error' => false]);
    }

    public function menuStatus($id)
    {
        $status = DB::table('menu')->where('id', $id)->first()->status;
        DB::table('menu')->where('id', $id)->update(["status" => $status == 1 ? 0 : 1]);
        $msg = $status == 0 ? "Enabled" : "Disabled";
        return response()->json(['error' => false, "msg" => 'Menu Successfully .' . $msg]);
    }
}
