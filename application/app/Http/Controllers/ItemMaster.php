<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use PDF;
class ItemMaster extends Controller
{

    public function itemsInventory(Request $req)
    {
       
        $category = DB::table('inventory_category_master')->where('type',2);
        if(Auth::guard('admin')->user()->admin_role != 1 ){
        // if(Auth::guard('admin')->user()->admin_role == 9 || Auth::guard('admin')->user()->admin_role == 10){
            $category->where('added_by', Auth::guard('admin')->user()->id);
        }
        $category =$category->orderBy('id', 'ASC')->get();

        $subcategory = DB::table('inventory_subcategory_master');
        if(Auth::guard('admin')->user()->admin_role != 1 ){
        // if(Auth::guard('admin')->user()->admin_role == 9 || Auth::guard('admin')->user()->admin_role == 10){
            $subcategory->where('added_by', Auth::guard('admin')->user()->id);
        }
        $subcategory =$subcategory->orderBy('id', 'ASC')->get();

        $vendor = DB::table('inventory_vendor_master');
        if(Auth::guard('admin')->user()->admin_role != 1 ){
        // if(Auth::guard('admin')->user()->admin_role == 9 || Auth::guard('admin')->user()->admin_role == 10){
            $vendor->where('added_by', Auth::guard('admin')->user()->id);
        }
        $vendor =$vendor->orderBy('name', 'ASC')->get();



        $id=$req->value;
        $all_item=DB::table('item_master as ifam')
        ->join('inventory_category_master as icm', 'ifam.category', '=', 'icm.id')
        ->join('inventory_subcategory_master as iscm', 'ifam.subcategory', '=', 'iscm.id')
        ->select('ifam.id','ifam.item_name','ifam.item_code','ifam.quantity_of_items_purchased','icm.name as category','iscm.name as subcategory','ifam.added_by');
       
        if ($req->isMethod('post')) {
            if ($req->has('category')) {
                if($req->category != 'all')
                  $all_item->where( 'ifam.category',  '=',  $req->category );
            }
            if ($req->has('subcategory')) {
                if($req->subcategory != 'all')
                   $all_item->where( 'ifam.subcategory', '=', $req->subcategory  );
            }
            if ($req->has('vendor')) {
                if($req->vendor != 'all')
                   $all_item->where( 'ifam.vendor_name', '=', $req->vendor  );
            }
        }
        $conn="";
        if(Auth::guard('admin')->user()->admin_role != 1 ){
        // if(Auth::guard('admin')->user()->admin_role == 9 || Auth::guard('admin')->user()->admin_role == 10){
            $all_item->where('ifam.added_by', Auth::guard('admin')->user()->id);
            $conn="and im.added_by = '".Auth::guard('admin')->user()->id."'";
        }
        $stock_alert=DB::Select("SELECT im.item_name,im.id,im.item_type,im.item_code, (im.quantity_of_items_purchased + poh.quantity_recieved) as in_stock,im.stock_alert as stock_alert,im.added_by  FROM purchase_order_history as poh join item_master as im on poh.item_id = im.id where (im.quantity_of_items_purchased + poh.quantity_recieved) < im.stock_alert $conn");
        $data=$all_item->orderBy('ifam.id','DESC')->get();
     
        return view('admin.item.list_item', ['all_item' => $data,'category'=>$category,'subcategory'=>$subcategory ,'vendor'=>$vendor ,'stock_alert'=>$stock_alert]);
    }

    public function itemsInventoryPdf(Request $req)
    {
        
        $category = DB::table('inventory_category_master')->where('type',2)->orderBy('id', 'ASC')->get();
        $subcategory = DB::table('inventory_subcategory_master')->orderBy('id', 'ASC')->get();
        $vendor = DB::table('inventory_vendor_master')->orderBy('name', 'ASC')->get();
        $id=$req->value;
        $all_item=DB::table('item_master as ifam')
        ->join('inventory_category_master as icm', 'ifam.category', '=', 'icm.id')
        ->join('inventory_subcategory_master as iscm', 'ifam.subcategory', '=', 'iscm.id')
        ->select('ifam.id','ifam.item_name','ifam.item_code','ifam.quantity_of_items_purchased','icm.name as category','iscm.name as subcategory');
       
        
        $stock_alert=DB::Select("SELECT im.item_name,im.id,im.item_type,im.item_code, (im.quantity_of_items_purchased + poh.quantity_recieved) as in_stock,im.stock_alert as stock_alert  FROM purchase_order_history as poh join item_master as im on poh.item_id = im.id where (im.quantity_of_items_purchased + poh.quantity_recieved) < im.stock_alert");
        if(Auth::guard('admin')->user()->admin_role != 1 ){
        // if(Auth::guard('admin')->user()->admin_role == 9 || Auth::guard('admin')->user()->admin_role == 10){
            $all_item->where('ifam.added_by', Auth::guard('admin')->user()->id);
        }
        $data=$all_item->orderBy('ifam.id','DESC')->get();
     
        // return view('admin.item.list_item_pdf', ['all_item' => $data,'category'=>$category,'subcategory'=>$subcategory ,'vendor'=>$vendor ,'stock_alert'=>$stock_alert]);
        
         
       $pdf = PDF::loadView('admin.item.list_item_pdf', ['all_item' => $data,'category'=>$category,'subcategory'=>$subcategory ,'vendor'=>$vendor ,'stock_alert'=>$stock_alert])->setPaper('a4', 'landscape');
       $pdf->output();
       $domPdf = $pdf->getDomPDF();
       $canvas = $domPdf->get_canvas();
       $rightMargin = 90;
       $pageWidth = $canvas->get_width();
       $pageNumberX = $pageWidth - $rightMargin;

       $canvas->page_text($pageNumberX, $canvas->get_height() - 20, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, [0, 0, 0]);
       $canvas->page_text(320, $canvas->get_height() - 20, "*This is a Software Generated Report*", null, 10, [0, 0, 0]);
       $namee  = "List of Inventory Items" . date('m-d-Y') . '.pdf';
        return $pdf->download($namee);
    }

    public function itemDetail($id)
    { 
        $old_stock=DB::table('item_master as ifam')
        ->join('inventory_category_master as icm', 'ifam.category', '=', 'icm.id')
        ->join('inventory_subcategory_master as iscm', 'ifam.subcategory', '=', 'iscm.id')
        ->join('inventory_vendor_master as ivm', 'ifam.vendor_name', '=', 'ivm.id')
        ->select('ifam.id','ivm.name as vendor','ifam.purchase_date','ifam.item_name','ifam.added_by','ifam.quantity_of_items_purchased','icm.name as category','iscm.name as subcategory')
        ->where('ifam.id',$id)->orderBy('ifam.id','DESC')->first();
        
        $new_stock = $list = DB::table('purchase_recieved_order_history as proh')
        ->join('purchase_order_history as poh', 'poh.orderNo', '=', 'proh.orderNo')
        ->join('inventory_vendor_master as ivm', 'poh.vendor_id', '=', 'ivm.id')
        ->select('ivm.name as vendor','poh.id as order_id','poh.vendor_id','proh.*')
        ->where('proh.item_id', $id)->groupBy('proh.challan_no')->orderBy('proh.id', 'DESC')->get();

        $return_stock = DB::table('purchase_returned_order_history as proh')
        ->join('purchase_order_history as poh', 'poh.orderNo', '=', 'proh.orderNo')
        ->join('inventory_vendor_master as ivm', 'poh.vendor_id', '=', 'ivm.id')
        ->select('ivm.name as vendor','poh.id as order_id','poh.vendor_id','proh.*')
        ->where('proh.item_id', $id)->orderBy('proh.id', 'DESC')->get();
        
        $order_history = DB::table('purchase_order_history as poh')
        ->join('inventory_vendor_master as ivm', 'poh.vendor_id', '=', 'ivm.id')
        ->select('ivm.name as vendor','poh.*')
        ->where('poh.item_id', $id)->orderBy('poh.id', 'DESC')->get();

        $approved_indents = DB::table('indent_raise_request')
        ->where('issued_quantity','!=',0)
        ->where('issued_quantity','!=','')
        ->where('indent_raise_request.item_id', $id)->get();

        $returned_indents = DB::table('indent_raise_request')
        ->where('return_quantity','!=',0)
        ->where('return_quantity','!=','')
        ->where('indent_raise_request.item_id', $id)->get();
       
        return view('admin.item.itemDetail', ['old_stock' => $old_stock,'new_stock'=>$new_stock,'return_stock'=>$return_stock,'order_history'=>$order_history,'approved_indents'=>$approved_indents,'returned_indents'=>$returned_indents,'item_id'=>$id ]);
    }

    //  fixed item 
    public function FixedItem(Request $req)
    { 
     
        $category = DB::table('inventory_category_master')->where('type',2);
        if(Auth::guard('admin')->user()->admin_role != 1 ){
        // if(Auth::guard('admin')->user()->admin_role == 9 || Auth::guard('admin')->user()->admin_role == 10){
            $category->where('added_by', Auth::guard('admin')->user()->id);
        }
        $category =$category->orderBy('id', 'ASC')->get();

        $subcategory = DB::table('inventory_subcategory_master');
        if(Auth::guard('admin')->user()->admin_role != 1 ){
        // if(Auth::guard('admin')->user()->admin_role == 9 || Auth::guard('admin')->user()->admin_role == 10){
            $subcategory->where('added_by', Auth::guard('admin')->user()->id);
        }
        $subcategory =$subcategory->orderBy('id', 'ASC')->get();

        $vendor = DB::table('inventory_vendor_master');
        if(Auth::guard('admin')->user()->admin_role != 1 ){
        // if(Auth::guard('admin')->user()->admin_role == 9 || Auth::guard('admin')->user()->admin_role == 10){
            $vendor->where('added_by', Auth::guard('admin')->user()->id);
        }
        $vendor =$vendor->orderBy('name', 'ASC')->get();
        $id=$req->value;
        $all_item=DB::table('item_master as ifam')
        ->join('inventory_category_master as icm', 'ifam.category', '=', 'icm.id')
        ->join('inventory_subcategory_master as iscm', 'ifam.subcategory', '=', 'iscm.id')
        ->join('inventory_unit_master as unit', 'ifam.unit', '=', 'unit.id')
        ->join('inventory_vendor_master as vendor', 'ifam.vendor_name', '=', 'vendor.id')
        ->select('ifam.*','icm.name as category','iscm.name as subcategory','unit.name as unit','vendor.name as vendor_name');
       
        if ($req->isMethod('post')) {
            if ($req->has('category')) {
                if($req->category != 'all')
                  $all_item->where( 'ifam.category',  '=',  $req->category );
            }
            if ($req->has('subcategory')) {
                if($req->subcategory != 'all')
                   $all_item->where( 'ifam.subcategory', '=', $req->subcategory  );
            }
            if ($req->has('vendor')) {
                if($req->vendor != 'all')
                   $all_item->where( 'ifam.vendor_name', '=', $req->vendor  );
            }
        }
        if(Auth::guard('admin')->user()->admin_role != 1 ){
        // if(Auth::guard('admin')->user()->admin_role == 9 || Auth::guard('admin')->user()->admin_role == 10){
            $all_item->where('ifam.added_by', Auth::guard('admin')->user()->id);
        }
        $data=$all_item->where('item_type',2)->orderBy('id','DESC')->get();
        // dd($data);
        return view('admin.item.list_fixed_item', ['all_item' => $data,'category'=>$category,'subcategory'=>$subcategory ,'vendor'=>$vendor]);
    }
    public function addFixedItem(Request $req)
    {
        $vendor = DB::table('inventory_vendor_master');
        $unit = DB::table('inventory_unit_master');
        $category = DB::table('inventory_category_master');
        if(Auth::guard('admin')->user()->admin_role != 1 ){
        // if(Auth::guard('admin')->user()->admin_role == 9 || Auth::guard('admin')->user()->admin_role == 10){
            $vendor->where('added_by', Auth::guard('admin')->user()->id);
            $unit->where('added_by', Auth::guard('admin')->user()->id);
            $category->where('added_by', Auth::guard('admin')->user()->id);
        }
        $vendor = $vendor->orderBy('name', 'ASC')->get();
        $unit = $unit->orderBy('id', 'ASC')->get();
        $category=$category->where('type',2)->orderBy('id', 'ASC')->get();
       
        if($req->id){
            $list=DB::table('item_master')->where('id',$req->id)->first();
            return view('admin.item.add_fixed_item', ['category' => $category,'unit'=>$unit,'list'=>$list,'vendor'=>$vendor]);
        }
        return view('admin.item.add_fixed_item', ['category' => $category,'unit'=>$unit,'vendor'=>$vendor]);
    }

   
    public function get_subCategory(Request $req)
    { 
        $id=$req->value;
        $all_sub_list=DB::table('inventory_subcategory_master')->where('category_id',$id);
        if(Auth::guard('admin')->user()->admin_role != 1 ){
            $all_sub_list->where('added_by', Auth::guard('admin')->user()->id);
        }
        $all_sub_list=$all_sub_list->orderBy('name','ASC')->get();
        return $all_sub_list;
    }

    public function savefixedItem(Request $req)
    {
        $validation = Validator::make($req->all(), [
            'category'     => 'required',
            // 'subcategory'     => 'required',
            'item_name'     => 'required',
            // 'item_name'     => 'required|unique:item_master,item_name,'.$req->id,
            'purchase_date'     => 'required',
            'quantity_of_items_purchased'     => 'required',
            'unit'     => 'required',
            'rate_per_item'     => 'required',
            'total_cost_of_assets'     => 'required',
            'vendor_name'     => 'required',
            'voucher_number'     => 'required',
            // 'serial_number_of_asset'     => 'required',

            // 'depreciation_cost_in_1st_year'     => 'required',
            // 'asset_cost_at_beginning_of_2nd_year'     => 'required',
            // 'location_of_asset'     => 'required',
            'AMC_required'     => 'required',
            // 'AMC_period'     => 'required',
            'stock_alert'     => 'required',
            'asset_image'                 => 'nullable|mimes:pdf,png,jpg,jpeg|max:2048',
            'asset_image_2'                 => 'nullable|mimes:pdf,png,jpg,jpeg|max:2048',
        ]);
        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
            
            //  image 1
            $fileName = "";
            if($req->hasFile('asset_image')){
                $fileName = moveFile('item_asset', $req->asset_image);
            }
            else if (isset($req->id)){
                $fileName = $req->asset_image1;
            }

            //  image 2
            $fileName2 = "";
            if($req->hasFile('asset_image_2')){
                $fileName2 = moveFile('item_asset', $req->asset_image_2);
            }
            else if (isset($req->id)){
                $fileName2 = $req->asset_image2;
            }
            
            $data=[
                'category'       => $req->category,
                'subcategory'       => $req->subcategory,
                'item_name'       => $req->item_name,
                'purchase_date'       => $req->purchase_date,
                'quantity_of_items_purchased'       => $req->quantity_of_items_purchased,
                'unit'       => $req->unit,
                'rate_per_item'       => $req->rate_per_item,
                'total_cost_of_assets'       => $req->total_cost_of_assets,
                'vendor_name'       => $req->vendor_name,
                'voucher_number'       => $req->voucher_number,
                'serial_number_of_asset'       => $req->serial_number_of_asset,
                'manufacturer'       => $req->manufacturer,
                'model_number'       => $req->model_number,
                'date_of_expiry'       => $req->date_of_expiry,
                'last_date_of_warranty'       => $req->last_date_of_warranty,
                'depreciation_cost_in_1st_year'       => $req->depreciation_cost_in_1st_year,
                'asset_cost_at_beginning_of_2nd_year'       => $req->asset_cost_at_beginning_of_2nd_year,
                'location_of_asset'       => $req->location_of_asset,
                'AMC_required'       => $req->AMC_required,
                'AMC_period'       => $req->AMC_period,
                'stock_alert'       => $req->stock_alert,
                'asset_image'       => $fileName,
                'asset_image_2'       => $fileName2,
            ];
        if(isset($req->id)){
            $data['updated_by']= Auth::guard('admin')->user()->id;
            DB::table('item_master')->where('id', $req->id)->update($data);
            return response()->json(["error" => false, "msg" => "Fixed Item Update Successfully","url" => route('FixedItem')]);
        }
        else{
            $data['added_by']= Auth::guard('admin')->user()->id;
            $data['item_code'] = "F".rand(11111, 99999);
            $data['item_type'] = 2;
            DB::table('item_master')->insert($data);
            return response()->json(["error" => false, "msg" => "Fixed Item Add Successfully","url" => route('FixedItem')]);
        }
    }
    public function deleteFixedItem($id){
        DB::table('item_master')->where('id', '=', $id)->delete();
        return redirect()->back()->with("success", "Fixed Item Successfully Deleted.");
    }

     //  end fixed item 

     //  Consumable item 


     public function ConsumableItem(Request $req)
     { 
         $category = DB::table('inventory_category_master')->where('type',1);
         if(Auth::guard('admin')->user()->admin_role != 1 ){
        //  if(Auth::guard('admin')->user()->admin_role == 9 || Auth::guard('admin')->user()->admin_role == 10){
             $category->where('added_by', Auth::guard('admin')->user()->id);
         }
         $category =$category->orderBy('id', 'ASC')->get();
 
         $subcategory = DB::table('inventory_subcategory_master');
         if(Auth::guard('admin')->user()->admin_role != 1 ){
        //  if(Auth::guard('admin')->user()->admin_role == 9 || Auth::guard('admin')->user()->admin_role == 10){
             $subcategory->where('added_by', Auth::guard('admin')->user()->id);
         }
         $subcategory =$subcategory->orderBy('id', 'ASC')->get();
 
         $vendor = DB::table('inventory_vendor_master');
         if(Auth::guard('admin')->user()->admin_role != 1 ){
        //  if(Auth::guard('admin')->user()->admin_role == 9 || Auth::guard('admin')->user()->admin_role == 10){
             $vendor->where('added_by', Auth::guard('admin')->user()->id);
         }
         $vendor =$vendor->orderBy('name', 'ASC')->get();



         $id=$req->value;
         $all_item=DB::table('item_master as ifam')
         ->join('inventory_category_master as icm', 'ifam.category', '=', 'icm.id')
         ->join('inventory_subcategory_master as iscm', 'ifam.subcategory', '=', 'iscm.id')
         ->join('inventory_unit_master as unit', 'ifam.unit', '=', 'unit.id')
         ->join('inventory_vendor_master as vendor', 'ifam.vendor_name', '=', 'vendor.id')
         ->select('ifam.*','icm.name as category','iscm.name as subcategory','unit.name as unit','vendor.name as vendor_name');
         if ($req->isMethod('post')) {
            if ($req->has('category')) {
                if($req->category != 'all')
                  $all_item->where( 'ifam.category',  '=',  $req->category );
            }
            if ($req->has('subcategory')) {
                if($req->subcategory != 'all')
                   $all_item->where( 'ifam.subcategory', '=', $req->subcategory  );
            }
            if ($req->has('vendor')) {
                if($req->vendor != 'all')
                   $all_item->where( 'ifam.vendor_name', '=', $req->vendor  );
            }
        }
        if(Auth::guard('admin')->user()->admin_role != 1 ){
        // if(Auth::guard('admin')->user()->admin_role == 9 || Auth::guard('admin')->user()->admin_role == 10){
            $all_item->where('ifam.added_by', Auth::guard('admin')->user()->id);
        }
        $data=$all_item->where('item_type',1)->orderBy('id','DESC')->get();
        //  ->orderBy('id','DESC')->get();
         return view('admin.item.list_consumable_item', ['all_item' => $data,'category'=>$category,'subcategory'=>$subcategory ,'vendor'=>$vendor]);
     }
     public function addConsumableItem(Request $req)
     {
        $vendor = DB::table('inventory_vendor_master');
        $unit = DB::table('inventory_unit_master');
        $category = DB::table('inventory_category_master');
        if(Auth::guard('admin')->user()->admin_role != 1 ){
        // if(Auth::guard('admin')->user()->admin_role == 9 || Auth::guard('admin')->user()->admin_role == 10){
            $vendor->where('added_by', Auth::guard('admin')->user()->id);
            $unit->where('added_by', Auth::guard('admin')->user()->id);
            $category->where('added_by', Auth::guard('admin')->user()->id);
        }
        $vendor = $vendor->orderBy('name', 'ASC')->get();
        $unit = $unit->orderBy('id', 'ASC')->get();
        $category=$category->where('type',1)->orderBy('id', 'ASC')->get();
         if($req->id){
             $list=DB::table('item_master')->where('id',$req->id)->first();
             return view('admin.item.add_consumable_item', ['category' => $category,'unit'=>$unit,'list'=>$list,'vendor'=>$vendor]);
         }
         return view('admin.item.add_consumable_item', ['category' => $category,'unit'=>$unit,'vendor'=>$vendor]);
     }

     public function saveConsumableItem(Request $req)
    {
        $validation = Validator::make($req->all(), [
            'category'     => 'required',
            'subcategory'     => 'required',
            'item_name'     => 'required',
            // 'item_name'     => 'required|unique:item_master,item_name,'.$req->id,
            'purchase_date'     => 'required',
            'quantity_of_items_purchased'     => 'required',
            'unit'     => 'required',
            'rate_per_item'     => 'required',
            'total_cost_of_assets'     => 'required',
            'vendor_name'     => 'required'
        ]);
        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

            $data=[
                'category'       => $req->category,
                'subcategory'       => $req->subcategory,
                'item_name'       => $req->item_name,
                'purchase_date'       => $req->purchase_date,
                'quantity_of_items_purchased'       => $req->quantity_of_items_purchased,
                'unit'       => $req->unit,
                'rate_per_item'       => $req->rate_per_item,
                'total_cost_of_assets'       => $req->total_cost_of_assets,
                'vendor_name'       => $req->vendor_name,
                'voucher_number'       => $req->voucher_number,
                'description'       => $req->description,
            
            ];
        if(isset($req->id)){
            $data['updated_by']= Auth::guard('admin')->user()->id;
            DB::table('item_master')->where('id', $req->id)->update($data);
            return response()->json(["error" => false, "msg" => "Consumable Item Update Successfully","url" => route('ConsumableItem')]);
        }
        else{
            $data['added_by']= Auth::guard('admin')->user()->id;
            $data['item_type'] = 1;
            $data['item_code'] = "C".rand(11111, 99999);
            DB::table('item_master')->insert($data);
            return response()->json(["error" => false, "msg" => "Consumable Item Add Successfully","url" => route('ConsumableItem')]);
        }
    }

    public function deleteConsumableItem($id){
        DB::table('item_master')->where('id', '=', $id)->delete();
        return redirect()->back()->with("success", "Consumable Item Successfully Deleted.");
    }
 

     //  end Consumable item 
}
