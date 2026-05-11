<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class InventoryMaster extends Controller
{

    /* section part start */
    public function sectionList()
    {
        $section = DB::table('inventory_section_master');
            if(Auth::guard('admin')->user()->admin_role != 1 ){
            // if(Auth::guard('admin')->user()->admin_role == 9 || Auth::guard('admin')->user()->admin_role == 10){
                $section->where('added_by', Auth::guard('admin')->user()->id);
            }
        $section = $section->orderBy('id', 'DESC')->get();
        return view('admin.inventory.section_master', ['section' => $section]);
    }

    public function saveSection(Request $req)
    {
      $validation = Validator::make($req->all(), [
            'hn_section_name'     => 'required',
            'en_section_name'   => 'required',
            'status'   => 'required',
        ]);

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
            $data=[
                'name_hn'       => $req->hn_section_name,
                'name_en'       => $req->en_section_name,
                'status'       => $req->status,
            ];
            if(isset($req->id)){
                $data['updated_by']= Auth::guard('admin')->user()->id;
                DB::table('inventory_section_master')->where('id', $req->id)->update($data);
                return response()->json(["error" => false, "msg" => "Section Update Successfully","url" => route('section')]);


            }
            else{
                $data['added_by']= Auth::guard('admin')->user()->id;
                DB::table('inventory_section_master')->insert($data);
                return response()->json(["error" => false, "msg" => "Section Add Successfully"]);
            }

        
    }
    public function editsection($id)
    {
        $psection = DB::table('inventory_section_master')->where('id', $id)->first();
         $section = DB::table('inventory_section_master');
            if(Auth::guard('admin')->user()->admin_role != 1 ){
            // if(Auth::guard('admin')->user()->admin_role == 9 || Auth::guard('admin')->user()->admin_role == 10){
                $section->where('added_by', Auth::guard('admin')->user()->id);
            }
        $section = $section->orderBy('id', 'DESC')->get();
        return view('admin.inventory.section_master', ['section' => $section,'psection'=>$psection]);
    }
    public function deletesection($id){
        DB::table('inventory_section_master')->where('id', '=', $id)->delete();
        return redirect()->back()->with("success", "Section Successfully Deleted.");
    }

      /* section part end */


       /* unit part start */
    public function unitList(){
        $unit = DB::table('inventory_unit_master');
         if(Auth::guard('admin')->user()->admin_role != 1 ){
        // if(Auth::guard('admin')->user()->admin_role == 9 || Auth::guard('admin')->user()->admin_role == 10){
            $unit->where('added_by', Auth::guard('admin')->user()->id);
        }
        $unit = $unit->orderBy('id', 'DESC')->get();
        return view('admin.inventory.unit_master', ['unit' => $unit]);
    }

    public function saveUnit(Request $req)
    {
        $validation = Validator::make($req->all(), [
            'name'     => 'required'
            // 'name'     => 'required|unique:inventory_unit_master,name,'.$req->id,
        ]);
        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
            $data=[
                'name'       => $req->name,
            ];
        if(isset($req->id)){
            $data['updated_by']= Auth::guard('admin')->user()->id;
            DB::table('inventory_unit_master')->where('id', $req->id)->update($data);
            return response()->json(["error" => false, "msg" => "Unit Update Successfully","url" => route('unit')]);
       }
        else{
            $data['added_by']= Auth::guard('admin')->user()->id;
            DB::table('inventory_unit_master')->insert($data);
            return response()->json(["error" => false, "msg" => "Unit Add Successfully"]);
        }
    }
    public function editUnit($id)
    {
        $punit = DB::table('inventory_unit_master')->where('id', $id)->first();
        $unit = DB::table('inventory_unit_master');
            if(Auth::guard('admin')->user()->admin_role != 1 ){
            // if(Auth::guard('admin')->user()->admin_role == 9 || Auth::guard('admin')->user()->admin_role == 10){
                $unit->where('added_by', Auth::guard('admin')->user()->id);
            }
        $unit = $unit->orderBy('id', 'DESC')->get();
        return view('admin.inventory.unit_master', ['unit' => $unit,'punit'=>$punit]);
    }
    public function deleteUnit($id){
        DB::table('inventory_unit_master')->where('id', '=', $id)->delete();
        return redirect()->back()->with("success", "Unit Successfully Deleted.");
    }

      /* unit part end */

     /* vendor part start */
    public function vendorList()
    {
        $vendor = DB::table('inventory_vendor_master');
         if(Auth::guard('admin')->user()->admin_role != 1 ){
        // if(Auth::guard('admin')->user()->admin_role == 9 || Auth::guard('admin')->user()->admin_role == 10){
            $vendor->where('added_by', Auth::guard('admin')->user()->id);
        }
        $vendor =  $vendor->orderBy('id', 'DESC')->get();
        return view('admin.inventory.vendor_master', ['vendor' => $vendor]);
    }

    public function saveVendor(Request $req)
    {
        $validation = Validator::make($req->all(), [
            'name'     => 'required',
            'mobile'     => 'required',
            'email'     => 'required',
            'address'     => 'required',
            'pan'     => 'required',
            'gst'     => 'required',
            'status'     => 'required'
        ]);
        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
            $vendorNo = rand(111111, 999999);

            $data=[
                'name'       => $req->name,
                'mobile'       => $req->mobile,
                'email'       => $req->email,
                'address'       => $req->address,
                'pan'       => $req->pan,
                'gst'       => $req->gst,
                'status'       => $req->status,
            ];
           
        if(isset($req->id)){
            $data['updated_by']= Auth::guard('admin')->user()->id;
            DB::table('inventory_vendor_master')->where('id', $req->id)->update($data);
            return response()->json(["error" => false, "msg" => "Vendor Update Successfully","url" => route('vendor')]);
        }
        else{
            $data['added_by']= Auth::guard('admin')->user()->id;
            $data['vendor_code']= "VD".$vendorNo;
            DB::table('inventory_vendor_master')->insert($data);
            return response()->json(["error" => false, "msg" => "Vendor Add Successfully"]);
        }
    }

    public function editVendor($id)
    {
        $pvendor = DB::table('inventory_vendor_master')->where('id', $id)->first();
        $vendor = DB::table('inventory_vendor_master');
         if(Auth::guard('admin')->user()->admin_role != 1 ){
        // if(Auth::guard('admin')->user()->admin_role == 9 || Auth::guard('admin')->user()->admin_role == 10){
            $vendor->where('added_by', Auth::guard('admin')->user()->id);
        }
        $vendor =  $vendor->orderBy('id', 'DESC')->get();
        return view('admin.inventory.vendor_master', ['vendor' => $vendor,'pvendor'=>$pvendor]);
    }
    public function deleteVendor($id){
        DB::table('inventory_vendor_master')->where('id', '=', $id)->delete();
        return redirect()->back()->with("success", "Vendor Successfully Deleted.");
    }

    /* vendor part end */

    /* category part start */

    public function categoryList()
    {
        $category = DB::table('inventory_category_master');
         if(Auth::guard('admin')->user()->admin_role != 1 ){
        // if(Auth::guard('admin')->user()->admin_role == 9 || Auth::guard('admin')->user()->admin_role == 10){
            $category->where('added_by', Auth::guard('admin')->user()->id);
        }
        $category =  $category->orderBy('id', 'DESC')->get();
        return view('admin.inventory.category_master', ['category' => $category]);
    }

    public function saveCategory(Request $req)
    {
        // dd(Auth::guard('admin')->user()->id);
        $validation = Validator::make($req->all(), [
            // 'name'     => 'required|unique:inventory_category_master,name,'.$req->id,
            'name'     => 'required',
            'item_type'     => 'required',
            'amc_required'     => 'required',
        ]);
        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

            $data=[
                'name'       => $req->name,
                'type'       => $req->item_type,
                'amc_required'       => $req->amc_required,
            ];
        if(isset($req->id)){
            $data['updated_by']= Auth::guard('admin')->user()->id;
            DB::table('inventory_category_master')->where('id', $req->id)->update($data);
            return response()->json(["error" => false, "msg" => "Category Update Successfully","url" => route('category')]);
        }
        else{
            $data['added_by']= Auth::guard('admin')->user()->id;
            DB::table('inventory_category_master')->insert($data);
            return response()->json(["error" => false, "msg" => "Category Add Successfully"]);
        }
    }

    public function editCategory($id)
    {
        $pcategory = DB::table('inventory_category_master')->where('id', $id)->first();
        $category = DB::table('inventory_category_master');
         if(Auth::guard('admin')->user()->admin_role != 1 ){
        // if(Auth::guard('admin')->user()->admin_role == 9 || Auth::guard('admin')->user()->admin_role == 10){
            $category->where('added_by', Auth::guard('admin')->user()->id);
        }
        $category =  $category->orderBy('id', 'DESC')->get();
        return view('admin.inventory.category_master', ['category' => $category,'pcategory'=>$pcategory]);
    }
    public function deleteCategory($id){
        DB::table('inventory_category_master')->where('id', '=', $id)->delete();
        return redirect()->back()->with("success", "Category Successfully Deleted.");
    }

    /* category part end */


    /* sub  category part start */

    public function subCategoryList(Request $req)
    {
        if($req->ajax()){
            $validation = Validator::make($req->all(), [
                'category'     => 'required',
                'name'     => 'required',
                // 'name'     => 'required|unique:inventory_subcategory_master,name,'.$req->id,
                // 'item_type'     => 'required',
                // 'amc_required'     => 'required',
            ]);
            if ($validation->fails())
                return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
                $data=[
                    'category_id'       => $req->category,
                    'name'       => $req->name,
                    // 'type'       => $req->item_type,
                    // 'amc_required'       => $req->amc_required,
                ];
            if(isset($req->id)){
                $data['updated_by']= Auth::guard('admin')->user()->id;
                DB::table('inventory_subcategory_master')->where('id', $req->id)->update($data);
                return response()->json(["error" => false, "msg" => "Sub Category Update Successfully","url" => route('subCategory')]);
            }else{
                $data['added_by']= Auth::guard('admin')->user()->id;
                DB::table('inventory_subcategory_master')->insert($data);
                return response()->json(["error" => false, "msg" => "Sub Category Add Successfully"]);
            }
        }
        $subcategory = DB::table('inventory_subcategory_master as ism')
        ->join('inventory_category_master as icm', 'ism.category_id', '=', 'icm.id')
        ->select('ism.*','icm.name as category');
         if(Auth::guard('admin')->user()->admin_role != 1 ){
        // if(Auth::guard('admin')->user()->admin_role == 9 || Auth::guard('admin')->user()->admin_role == 10){
            $subcategory->where('ism.added_by', Auth::guard('admin')->user()->id);
        }
        $subcategory =$subcategory->orderBy('id', 'DESC')->get();

        $category = DB::table('inventory_category_master');
         if(Auth::guard('admin')->user()->admin_role != 1 ){
        // if(Auth::guard('admin')->user()->admin_role == 9 || Auth::guard('admin')->user()->admin_role == 10){
            $category->where('added_by', Auth::guard('admin')->user()->id);
        }
        $category = $category->orderBy('id', 'ASC')->get();

        if($req->id){
            $psubcategory = DB::table('inventory_subcategory_master')->where('id', $req->id)->first();
            return view('admin.inventory.subcategory_master', ['subcategory'=> $subcategory,'category' => $category,'psubcategory'=>$psubcategory]);
        }
        else{
            return view('admin.inventory.subcategory_master', ['subcategory' => $subcategory,'category' => $category]);
        }
       
    }

    // public function savesubCategory(Request $req)
    // {
    //     $validation = Validator::make($req->all(), [
    //         'category'     => 'required',
    //         'name'     => 'required',
    //         'item_type'     => 'required',
    //         'amc_required'     => 'required',
    //     ]);
    //     if ($validation->fails())
    //         return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
    //         $data=[
    //             'category_id'       => $req->category,
    //             'name'       => $req->name,
    //             'type'       => $req->item_type,
    //             'amc_required'       => $req->amc_required,
    //         ];
    //     if(isset($req->id)){
    //         DB::table('inventory_subcategory_master')->where('id', $req->id)->update($data);
    //         return response()->json(["error" => false, "msg" => "Sub Category Update Successfully","url" => route('subCategory')]);
    //     }
    //     else{
    //         DB::table('inventory_subcategory_master')->insert($data);
    //         return response()->json(["error" => false, "msg" => "Sub Category Add Successfully"]);
    //     }
    // }

    // public function editsubCategory($id)
    // {
    //     $psubcategory = DB::table('inventory_subcategory_master')
    //     ->where('id', $id)->first();
    //     $subcategory = DB::table('inventory_subcategory_master as ism')
    //     ->join('inventory_category_master as icm', 'ism.category_id', '=', 'icm.id')
    //     ->select('ism.*','icm.name as category')
    //     ->orderBy('id', 'DESC')->get();
    //     $category = DB::table('inventory_category_master')->orderBy('id', 'ASC')->get();
    //     return view('admin.inventory.subcategory_master', ['subcategory'=> $subcategory,'category' => $category,'psubcategory'=>$psubcategory]);
    // }
    public function deletesubCategory($id){
        DB::table('inventory_subcategory_master')->where('id', '=', $id)->delete();
        return redirect()->back()->with("success", "Sub Category Successfully Deleted.");
    }

      /* sub category part end */
}
