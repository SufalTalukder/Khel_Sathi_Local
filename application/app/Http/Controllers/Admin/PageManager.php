<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PageManager extends Controller
{
    public function index()
    {
        $page = DB::table('urm_page_manager')->select('urm_page_manager.*','urm_module_manager.module_name')->join('urm_module_manager','urm_page_manager.module_id','=','urm_module_manager.id')->orderBy('urm_page_manager.id', 'DESC')->get();
        
        return view('admin.pagemanage.index', compact('page'));
    }

    public function pageForm()
    {
        $page = DB::table('urm_page_manager')->orderBy('id', 'DESC')->get();
        $module = DB::table('urm_module_manager')->where('module_status', 1)->orderBy('id', 'DESC')->get();
        $icon = DB::table('module_icon')->get();
        return view('admin.pagemanage.create', compact('page', 'module','icon'));
    }

    public function getPage($id)
    {
        $data = DB::table('urm_page_manager')->where('module_id', $id)->orderBy('page_name', 'ASC')->get();
        $html = '<option value="">Select Parent</option>';
        foreach ($data as $item) {
            $html .= '<option value="' . $item->id . '">' . $item->page_name . '';
        }
        return response($html);
    }

    public function createPage(Request $req)
    { 
        $validation = Validator::make($req->all(), [
            'page_name'     => 'required|max:150',
            'page_url'      => 'required|max:255',
            'page_parent'   => 'nullable|max:11',
            'module_id'     => 'required',
            'page_order'    => 'required',
            'page_status'   => 'required',
            'is_menu'   => 'required',
        ], msg());

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

            $status = [
                'page_name' => $req->page_name,
                'page_url' => $req->page_url,
                'page_parent' => $req->page_parent,
                'module_id' => $req->module_id,
                'is_menu' => $req->is_menu,
                'menu_icon' => $req->menu_icon,
                'page_order' => $req->page_order,
                'page_status' => $req->page_status
             ];

        DB::table('urm_page_manager')->insert($status);

        // session()->flash('success', 'Page Successfully Created.');
        // return response()->json(['error' => false]);
        return redirect('/admin/page_manager')->with("success", "Page  Successfully Added.");
    }

    public function editPage($id)
    {
        $page = DB::table('urm_page_manager')->where('id', $id)->first();
        $pageCollection = DB::table('urm_page_manager')->orderBy('id', 'DESC')->get();
        $module = DB::table('urm_module_manager')->where('module_status', 1)->orderBy('id', 'DESC')->get();
        $icon = DB::table('module_icon')->get();
        return view('admin.pagemanage.update', compact('page', 'module', 'pageCollection','icon'));
    }

    public function pageStatus($id)
    {
        $status = DB::table('urm_page_manager')->where('id', $id)->first()->page_status;
        DB::table('urm_page_manager')->where('id', $id)->update(["page_status" => $status == 1 ? 0 : 1]);
        $msg = $status == 0 ? "Enabled" : "Disabled";
        return response()->json(['error' => false, "msg" => 'Page Successfully .' . $msg]);
    }

    public function updatePage(Request $req, $id)
    {
        $validation = Validator::make($req->all(), [
            'page_name'     => 'required|max:150',
            'page_url'      => 'required|max:255',
            'page_parent'   => 'nullable|max:11',
            'module_id'     => 'required',
            'page_order'    => 'required',
            'page_status'   => 'required'
        ], msg());
// dd($id);
        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        $status = [
            'page_name' => $req->page_name,
            'page_url' => $req->page_url,
            'page_parent' => $req->page_parent,
            'module_id' => $req->module_id,
            'is_menu' => $req->is_menu,
            'menu_icon' => $req->menu_icon,
            'page_order' => $req->page_order,
            'page_status' => $req->page_status
            ];
            // dd($id);
        DB::table('urm_page_manager')->where('id', $id)->update($status);

        // session()->flash('success', 'Page Successfully Updated.');
        // return response()->json(['error' => false]);
        return redirect('/admin/page_manager')->with("success", "Page  Successfully Updated.");
    }
}
