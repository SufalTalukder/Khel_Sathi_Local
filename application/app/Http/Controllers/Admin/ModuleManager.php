<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ModuleManager extends Controller
{
    public function index()
    {
        $module = DB::table('urm_module_manager')->orderBy('id', 'DESC')->get();
        return view('admin.modulemanage.index', compact('module'));
    }

    public function moduleForm()
    {
        return view('admin.modulemanage.create');
    }

    public function createModule(Request $req)
    {
        $validation = Validator::make($req->all(), [
            'modulename'     => 'required|max:150',
            'moduleurl'      => 'required|max:255',
            'menuorder'      => 'required|max:11',
            'ismenu'         => 'required',
            'status'         => 'required',
            'options'        => 'required'
        ], msg());

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        DB::table('urm_module_manager')->insert([
            "module_name"   => $req->modulename,
            "module_url"    => $req->moduleurl,
            "menu_order"    => $req->menuorder,
            "is_menu"       => $req->ismenu,
            "module_status" => $req->status,
            "menu_icon"     => $req->options,
        ]);

        // session()->flash('success', 'Module Successfully Created.');
        // return response()->json(['error' => false]);
        return redirect('/admin/module_manager')->with("success", "Module  Successfully Created.");
    }

    public function moduleStatus($id)
    {
        $status = DB::table('urm_module_manager')->where('id', $id)->first()->module_status;
        DB::table('urm_module_manager')->where('id', $id)->update(["module_status" => $status == 1 ? 0 : 1]);
        $msg = $status == 0 ? "Enabled" : "Disabled";
        return response()->json(['error' => false, "msg" => 'Module Successfully .' . $msg]);
    }


    public function editModule($id)
    {
        $module = DB::table('urm_module_manager')->where('id', $id)->first();
        $icon = DB::table('module_icon')->get();
        return view('admin.modulemanage.update', compact('module', 'icon'));
    }

    public function updateModule(Request $req, $id)
    {
        $validation = Validator::make($req->all(), [
            'module_name'     => 'required|max:150',
            'module_url'      => 'required|max:255',
            'menu_order'      => 'required|max:11',
            'is_menu'         => 'required',
            'module_status'   => 'required',
            'menu_icon'       => 'required'
        ], msg());

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        DB::table('urm_module_manager')->where('id', $id)->update([
        "module_name"   => $req->module_name,
        "module_url"    => $req->module_url,
        "menu_order"    => $req->menu_order,
        "is_menu"       => $req->is_menu,
        "module_status" => $req->module_status,
        "menu_icon"     => $req->menu_icon
        ]);

        // session()->flash('success', 'Module Successfully Updated.');
        // return response()->json(['error' => false]);
        return redirect('/admin/module_manager')->with("success", "Module  Successfully Updated.");
    }
}
