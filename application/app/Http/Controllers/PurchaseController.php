<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{

    public function listOrder()
    {
        $list = DB::table('purchase_order_history as poh')
        ->leftJoin('inventory_vendor_master as ivm', 'poh.vendor_id', '=', 'ivm.id')
        ->leftJoin('inventory_category_master as icm', 'poh.category_id', '=', 'icm.id')
        ->leftJoin('inventory_subcategory_master as iscm', 'poh.sub_category_id', '=', 'iscm.id')
        ->select('ivm.name as vendor','poh.order_date','poh.orderNo','poh.order_status','icm.name as category','iscm.name as subcategory','poh.added_by');
         if(Auth::guard('admin')->user()->admin_role != 1 ){
        // if(Auth::guard('admin')->user()->admin_role == 9 || Auth::guard('admin')->user()->admin_role == 10){
            $list->where('poh.added_by', Auth::guard('admin')->user()->id);
        }
        $list =$list->groupBy('poh.orderNo')->orderBy('poh.id', 'DESC')->get();
    //   dd($list);
        return view('admin.purchase.list_purchase_order', ['list' => $list]);
    }
    public function addOrder(Request $req)
    {
        $vendor = DB::table('inventory_vendor_master')->orderBy('id', 'DESC');
         if(Auth::guard('admin')->user()->admin_role != 1 ){
        // if(Auth::guard('admin')->user()->admin_role == 9 || Auth::guard('admin')->user()->admin_role == 10){
            $vendor->where('added_by', Auth::guard('admin')->user()->id);
        }
        $vendor =$vendor->get();
        if($req->id){
            $list=DB::table('purchase_order_history')->where('orderNo',$req->id)->get();
            
            return view('admin.purchase.add_purchase_order', ['vendor' => $vendor,'list'=>$list]);
        }
        
        return view('admin.purchase.add_purchase_order', ['vendor' => $vendor]);
    }

    public function get_Category(Request $req)
    { 
        $id=$req->value;
        $all_cat_list=DB::table('inventory_category_master')->where('type',$id);
        if(Auth::guard('admin')->user()->admin_role != 1 ){
             $all_cat_list->where('added_by', Auth::guard('admin')->user()->id);
        }
        $all_cat_list=$all_cat_list->orderBy('name','ASC')->get();
        return $all_cat_list;
    }

    public function get_item(Request $req)
    { 
        $sub_cat=$req->sub_cat;
        $itemtype=$req->itemtype;
        // if($itemtype == 1){
        //     $table="item_consumable_assets_master";
        // }else{
        //     $table="item_fixed_assets_master";
        // }
        
        $all_cat_list=DB::table('item_master')
        ->join('inventory_unit_master as unit', 'item_master.unit', '=', 'unit.id')
        ->select('item_master.id','item_master.item_name','unit.name as unit')
        ->where('item_type',$req->itemtype)->where('subcategory',$sub_cat);
        if(Auth::guard('admin')->user()->admin_role != 1 ){
            $all_cat_list->where('item_master.added_by', Auth::guard('admin')->user()->id);
        }
       $all_cat_list=$all_cat_list->orderBy('item_name','ASC')->get();
        
        return $all_cat_list;
    }

    public function saveOrder(Request $req)
    {
      
        $validation = Validator::make($req->all(), [
            'vendor_id'     => 'required',
            'order_date'     => 'required',
            'supply_date'     => 'required',
            'item_type_id.*'     => 'required',
            'category_id.*'     => 'required',
            'sub_category_id.*'     => 'required',
            'item_id.*'     => 'required',
            'unit.*'     => 'required',
            'quantity.*'     => 'required',
            'rate_per_item.*'     => 'required',
            'total_amount.*'     => 'required',
        ]);
        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

           

            
        if(isset($req->orderNo)){
            DB::table('purchase_order_history')->where('orderNo', '=', $req->orderNo)->delete();
            $data['updated_by']= Auth::guard('admin')->user()->id;
                foreach($req->item_type_id as $key=>$item){
                    DB::table('purchase_order_history')->insertGetId(array(
                        'vendor_id' =>  $req->vendor_id,
                        'order_date' =>  $req->order_date,
                        'supply_date' =>  $req->supply_date,
                        'orderNo' =>$req->orderNo,
                        'item_type_id' =>$item,
                        'category_id' =>$req->category_id[$key],
                        'sub_category_id' => $req->sub_category_id[$key],
                        'item_id' => $req->item_id[$key],
                        'unit' => $req->unit[$key],
                        'quantity' => $req->quantity[$key],
                        'rate_per_item' => $req->rate_per_item[$key],
                        'total_amount' => $req->total_amount[$key],
                        'updated_by' => Auth::guard('admin')->user()->id,
                    
                    ));
            };
            // DB::table('purchase_order_history')->where('id', $req->id)->update($data);
            return response()->json(["error" => false, "msg" => "Purchase Order Update Successfully","url" => route('listOrder')]);
        }
        else{
            $ranNo = rand(111111, 999999);
            $orderNo= date('Y').$ranNo;
            foreach($req->item_type_id as $key=>$item){
                DB::table('purchase_order_history')->insertGetId(array(
                    'vendor_id' =>  $req->vendor_id,
                    'order_date' =>  $req->order_date,
                    'supply_date' =>  $req->supply_date,
                    'orderNo' =>$orderNo,
                    'item_type_id' =>$item,
                    'category_id' =>$req->category_id[$key],
                    'sub_category_id' => $req->sub_category_id[$key],
                    'item_id' => $req->item_id[$key],
                    'unit' => $req->unit[$key],
                    'quantity' => $req->quantity[$key],
                    'rate_per_item' => $req->rate_per_item[$key],
                    'total_amount' => $req->total_amount[$key],
                    'added_by' => Auth::guard('admin')->user()->id,
                ));
               
             };
            return response()->json(["error" => false, "msg" => "Purchase Order Add Successfully","url" => route('listOrder')]);
        }
    }

    public function deleteOrder($id){
        DB::table('purchase_order_history')->where('orderNo', '=', $id)->delete();
        return redirect()->back()->with("success", "Order Successfully Deleted.");
    }

    public function generatePO($id){
        DB::table('purchase_order_history')->where('orderNo', '=', $id)->update(['order_status'=>2]);
        return redirect()->back()->with("success", "Purchase Order Successfully Generated.");
    }

    public function orderDetails(Request $req)
    {
        $id = $req->id;
        $list = DB::table('purchase_order_history as poh')
        ->leftJoin('inventory_vendor_master as ivm', 'poh.vendor_id', '=', 'ivm.id')
        ->leftJoin('inventory_category_master as icm', 'poh.category_id', '=', 'icm.id')
        ->leftJoin('inventory_subcategory_master as iscm', 'poh.sub_category_id', '=', 'iscm.id')
        ->select('ivm.name as vendor','poh.order_date','poh.orderNo','poh.order_status','poh.item_type_id',
        'poh.quantity','poh.rate_per_item','poh.total_amount','poh.item_id',
        'icm.name as category','iscm.name as subcategory')
        ->where('poh.orderNo', $id)->orderBy('poh.id', 'DESC')->get();

        // $list = DB::table('purchase_order_history')->where('orderNo', $id)->get();
        return view('components.orderHistory', compact('list'));
    }



    public function purchase_entry()
    {
        $vendor = DB::table('inventory_vendor_master');
         if(Auth::guard('admin')->user()->admin_role != 1 ){
        // if(Auth::guard('admin')->user()->admin_role == 9 || Auth::guard('admin')->user()->admin_role == 10){
            $vendor->where('added_by', Auth::guard('admin')->user()->id);
        }
        $vendor=$vendor->orderBy('id', 'DESC')->get();
        return view('admin.purchase.purchase_entry', ['vendor' => $vendor]);
    }

 
    public function get_vendor_order(Request $req)
    { 
        $vendor_id=$req->vendor_id;
        $list=DB::table('purchase_order_history')->select('orderNo')->where('vendor_id',$vendor_id)->where('order_status',2)->groupBy('orderNo')->get();
        return $list;
    }

    public function get_vendor_order_detail(Request $req)
    { 
        $vendor_id=$req->vendor_id;
        $order_id=$req->order_id;
        $list=DB::table('purchase_order_history as poh')
        ->leftJoin('inventory_category_master as icm', 'poh.category_id', '=', 'icm.id')
        ->select('poh.*','icm.name')
        ->where('vendor_id',$vendor_id)
        ->where('orderNo',$order_id)
        ->where('order_status',2)
        ->groupBy('poh.item_id')
        ->get();
        $htm='<div class="panel-heading text-center mt-3">
        <b>Item Details</b>
    </div>
    <div class="panel-body" style="padding: 15px 0;">
        <form action="'.route('save_purchase_entry').'"  id="preregistration" method="post"  ><div style="display:none;"><input type="hidden" name="_method" value="POST"></div>
            <div class="row">
                <div class="col-lg-3">
                    <label>Challan No.<span class="text-danger">*</span></label>
                    <div class="input text required" aria-required="true">
                        <input  name="challan_no" autocomplete="off" class="form-control" maxlength="15" placeholder="Challan No."  type="text" id="PurchaseEntryChallanNo" required="required" aria-required="true">
                    </div> 
                </div>
                <div class="col-lg-3">
                    <div class="input text">
                    <label for="PurchaseEntryChallanDate">Challan Date <span class="text-danger">*</span></label>
                    <input name="challan_date" required autocomplete="off" class="form-control" maxlength="10" max ="'.date('Y-m-d').'" placeholder="dd-mm-yyyy"  type="date" id="PurchaseEntryChallanDate"></div> 
                </div>
                <div class="col-md-2">
                    <label>Order Date</label>
                    <p>'.dmy($list[0]->order_date).'</p>  
                </div>
                <div class="col-md-2">
                    <label>Last Date of Supply</label>
                    <p>'.dmy($list[0]->supply_date).'</p>  
                </div>
                <div class="col-md-2">
                    <label>Want to close the order? <span class="text-danger">*</span></label>
                    <p>
                        <input type="radio" required name="is_completed" id="PurchaseEntryIsCompleted1" value="1" >
                        <label for="PurchaseEntryIsCompleted1">Yes</label>
                        <input type="radio" name="is_completed" id="PurchaseEntryIsCompleted0" value="0">
                        <label for="PurchaseEntryIsCompleted0">No</label>
                    </p>  
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-lg-12">
                &nbsp;
            </div>
            <div class="row">

                <div class="col-lg-12 table-responsive">
                    <table  id="dataTable" class="table table-bordered " style="table-layout: fixed">
                        <tbody>
                            <tr>

                                <th style="width: 3%">Sr. No.</th>
                                <th style="width: 7%">Item Category</th>
                                <th style="width: 8%">Item Name</th>
                                <th style="width: 5%">Unit</th>
                                <th style="width: 5%">Ordered Quantity</th>
                                <th style="width: 5%">Rec. Quantity</th>
                                <th style="width: 5%">Returned Quantity</th>
                                <th style="width: 5%">Stock Quantity</th>
                                <th style="width: 5%">Rate Per Item</th>
                                <th style="width: 7%">Quantity Received</th>
                                <th style="width: 8%">Total Amount</th>
                                <th style="width:4%">Tax Rate(%)</th>
                                <th style="width: 6%">Tax Amount</th>
                                <th style="width: 8%">Net Amount</th>
                                <th style="width: 6%">Remark</th>

                            </tr>';
foreach($list as $key=>$item){
    $htm.='<tr>
    <td>'.($key+1).'
        <input type="hidden" name="order_no[]" value="'.($item->orderNo).'" id="PurchaseEntryOrderNo">
        <input type="hidden" name="order_id[]" value="'.($item->id).'" id="PurchaseEntryOrderId">
        <input type="hidden" name="vender_id[]" value="'.($item->vendor_id).'" id="PurchaseEntryVenderId">
    </td>
    <td>'.($item->name).'
        <input type="hidden" name="item_type[]" value="'.($item->item_type_id).'" id="PurchaseEntryItemType">
        <input type="hidden" name="cat_id[]" value="'.($item->category_id).'" id="PurchaseEntryCatId">
        <input type="hidden" name="sub_category_id[]" value="'.($item->sub_category_id).'" id="PurchaseEntryCatId">
    </td>
    <td>'.itemName($item->item_type_id,$item->item_id).'
        <input type="hidden" name="item_id[]" value="'.($item->item_id).'" id="PurchaseEntryItemId">
    </td>
    <td>'.($item->unit).'</td>
    <td>'.($item->quantity).'</td>
    <td><a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="itemsDetails('.$item->orderNo.','.$item->item_id.',1)">'.totalItem($item->orderNo,$item->item_id,1).'</a></td>
    <td><a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="itemsDetails('.$item->orderNo.','.$item->item_id.',2)">'.totalItem($item->orderNo,$item->item_id,2).'</a></td>

    <td><a href="'.url("admin/item-detail").'/'.$item->item_id.'" target="_blank" class="btn btn-primary btn-sm" ">'.(stock_item($item->item_id,$item->item_type_id)).'</td>
    <td>'.($item->rate_per_item).'</td>
    <td>
        <input required  name="recieved_quantity[]" value="" min="0" max="'.($item->quantity - $item->quantity_recieved).'" class="form-control rec" type="number" id="PurchaseEntryRecevied">
    </td>
    <td>
        <input name="recieved_amount[]" value="0" class="form-control" readonly="readonly" type="text" id="PurchaseEntryAmount" required="required" aria-required="true">
    </td>
    <td>
        <input name="vat" value="0" class="form-control" readonly="readonly" type="text" id="PurchaseEntryVat">
    </td>
    <td>
        <input name="vat_amount" value="0" class="form-control" readonly="readonly" type="text" id="PurchaseEntryVatAmount">
    </td>
    <td>
        <input name="net_amt" value="0" class="form-control" readonly="readonly" type="text" id="PurchaseEntryNetAmt" required="required" aria-required="true">
    </td>
    <td>
        <textarea name="entry_remark[]" class="form-control rem" id="PurchaseEntryRemark"></textarea>
    </td>
</tr>  
<tr>

</tr>';
}
                            

$htm.= '</tbody>
                    </table>
                </div>
            </div>
            <div class="submit text-center">
                <input class="btn btn-primary" type="submit" value="Save">
            </div>        
        </form>   
        
	<script>
        $(".rec").keyup(function (e) {
            var rate = parseFloat($(this).parent().prev().text());
            var amount = $(this).parent().next().find("input");
            var vat = $(this).parent().next().next().find("input").val();
            var vatamt = $(this).parent().next().next().next().find("input");
            var netamt = $(this).parent().next().next().next().next().find("input");

            console.log(amount);
            console.log(rate * $(this).val());
            if (parseFloat($(this).val()) >= 0)
            {
                amount.val((parseFloat(rate) * parseFloat($(this).val())));
                vatamt.val(parseFloat(amount.val()) * (parseFloat(vat) / 100))
                netamt.val(parseFloat(amount.val()) + parseFloat(vatamt.val()))
            } else {
                
                $(this).val(0)
              //  return false;
            }
        });

    

    
</script> 

    </div>';
        return $htm;
    }
    public function save_purchase_entry(Request $req){

        $validation = Validator::make($req->all(), [
            'challan_no'     => 'required|unique:purchase_recieved_order_history,challan_no,'.$req->id,
            'challan_date'     => 'required',
            'orderNo.*'     => 'required',
            'item_type_id.*'     => 'required',
            'item_id.*'     => 'required',
            'quantity_recieved.*'     => 'required',
        ]);
        if ($validation->fails())
            return redirect()->back()->with("error", $validation->errors()->first());
            // return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
            
        // dd($req->all());
        foreach($req->order_id as $key=>$id){
            $list=DB::table('purchase_order_history')->select('quantity_recieved')->where('id',$req->order_id[$key])->first();
 
            DB::table('purchase_order_history')->where('id', '=', $id)->update(['quantity_recieved'=>$req->recieved_quantity[$key] + $list->quantity_recieved]);
      
            $data =[
                    'challan_no'=>$req->challan_no,
                    'challan_date'=>$req->challan_date,
                    'orderNo'=>$req->order_no[$key],
                    'item_type_id'=>$req->item_type[$key],
                    'item_id'=>$req->item_id[$key],
                    'quantity_recieved'=>$req->recieved_quantity[$key],
                    'entry_remark'=>$req->entry_remark[$key],
                    'added_by' => Auth::guard('admin')->user()->id,
                ];
             DB::table('purchase_recieved_order_history')->insert($data);
        }

        // return response()->json(["error" => false, "msg" => "Order Successfully Received","url" => route('purchase_entry')]);
        return redirect()->back()->with("success", "Order Successfully Received.");

      
    }

    public function verify_purchase_order(Request $req)
    {
        $list=DB::table('purchase_order_history');
         if(Auth::guard('admin')->user()->admin_role != 1 ){
        // if(Auth::guard('admin')->user()->admin_role == 9 || Auth::guard('admin')->user()->admin_role == 10){
            $list->where('added_by', Auth::guard('admin')->user()->id);
        }
        $list=$list->groupBy('orderNo')->get();
       $data="";
    //    dd($req->all());
       if($req->order_id){
        // dd($req->order_id);
        $data= DB::table('purchase_order_history as poh')
        ->leftJoin('inventory_vendor_master as ivm', 'poh.vendor_id', '=', 'ivm.id')
        ->leftJoin('inventory_category_master as icm', 'poh.category_id', '=', 'icm.id')
        ->leftJoin('inventory_subcategory_master as iscm', 'poh.sub_category_id', '=', 'iscm.id')
        ->select('ivm.name as vendor','poh.id','poh.item_type_id','poh.item_id','poh.po_approved_status','poh.quantity_recieved','poh.order_date','poh.orderNo','poh.order_status','icm.name as category','iscm.name as subcategory')
        
        ->where('orderNo',$req->order_id)
        // ->where('poh.po_approved_status',0)
        ->orderBy('poh.id', 'DESC')->get();
       }
    //    dd($data);
        return view('admin.purchase.verify_purchase_order', ['list' => $list,'data' =>$data]);
    }

    public function po_verify(Request $req){
       
        if($req->purchase_order_id){
       
            foreach($req->purchase_order_id as $key=>$id){
                    DB::table('purchase_order_history')->where('id', '=', $id)->update([
                        'po_approved_status'=>1,
                        'po_approved_by'=>Auth::guard('admin')->user()->id,
                        'po_approved_date'=>date('Y-m-d'),
                    ]);
            }
            $msg="Purchase order verified";
        }
        else{
            $msg="Select atleast one order";
        }
        return response()->json(["error" => false, "msg" => $msg]);


    }

    public function itemsDetails(Request $req)
    {
        $orderNo = $req->orderNo;
        $type = $req->type;
        $item_id = $req->item_id;
        
        if($type==1){
            $list = DB::table('purchase_recieved_order_history as proh')
            ->leftJoin('purchase_order_history as poh', 'poh.orderNo', '=', 'proh.orderNo')
            ->leftJoin('inventory_vendor_master as ivm', 'poh.vendor_id', '=', 'ivm.id')
            ->select('ivm.name as vendor','poh.id as order_id','poh.vendor_id','proh.*')
            ->where('proh.orderNo', $orderNo)->where('proh.item_id', $item_id)
            ->orderBy('proh.id', 'DESC')->groupBy('proh.challan_no')->get();
        }
        if($type==2){
            $list = DB::table('purchase_returned_order_history as proh')
            ->leftJoin('purchase_order_history as poh', 'poh.orderNo', '=', 'proh.orderNo')
            ->leftJoin('inventory_vendor_master as ivm', 'poh.vendor_id', '=', 'ivm.id')
            ->select('ivm.name as vendor','poh.id as order_id','poh.vendor_id','proh.*')
            ->where('proh.orderNo', $orderNo)->where('proh.item_id', $item_id)
            ->orderBy('proh.id', 'DESC')->groupBy('proh.challan_no')->get();
        }
       
        return view('admin.purchase.itemsDetails', compact('list','type'));
    }

    public function return_entry()
    {
        $vendor = DB::table('inventory_vendor_master');
         if(Auth::guard('admin')->user()->admin_role != 1 ){
        // if(Auth::guard('admin')->user()->admin_role == 9 || Auth::guard('admin')->user()->admin_role == 10){
            $vendor->where('added_by', Auth::guard('admin')->user()->id);
        }
        $vendor=$vendor->orderBy('id', 'DESC')->get();
        return view('admin.purchase.return_entry', ['vendor' => $vendor]);
    }

    public function get_order_challan(Request $req)
    { 
       
        $order_id=$req->order_id;
        $list=DB::table('purchase_recieved_order_history')->select('challan_no')->where('orderNo',$order_id)->groupBy('challan_no')->get();
        return $list;
    }

    public function get_order_challan_detail(Request $req)
    { 
        
        $order_id=$req->order_id;
        $challan_no=$req->challan_no;
        $list=DB::table('purchase_recieved_order_history as proh')
        ->leftJoin('purchase_order_history as poh', 'poh.orderNo', '=', 'proh.orderNo')
        ->leftJoin('inventory_category_master as icm', 'poh.category_id', '=', 'icm.id')
        ->select('poh.quantity_recieved as max_quan','poh.id as order_id','poh.vendor_id','poh.category_id','poh.sub_category_id','poh.unit','poh.*','proh.challan_no','icm.name')
        ->where('proh.challan_no',$challan_no)
        ->where('proh.orderNo',$order_id)
        ->groupBy('poh.item_id')
        ->get();
        // dd($list);
        $htm='<div class="panel-heading text-center mt-3">
        <b>Item Return Details</b>
    </div>
    <div class="panel-body" style="padding: 15px 0;">
        <form action="'.route('save_return_entry').'" id="PurchaseEntryPurchaseEntryTableForm" method="post" accept-charset="utf-8" ><div style="display:none;"><input type="hidden" name="_method" value="POST"></div>
           
            <div class="clearfix"></div>
            <div class="col-lg-12">
                &nbsp;
            </div>
            <div class="row">

                <div class="col-lg-12 table-responsive">
                    <table  id="dataTable" class="table table-bordered " style="table-layout: fixed">
                        <tbody>
                            <tr>
                                <th style="width: 3%">S.N.</th>
                                <th style="width: 8%">Order No.</th>
                                <th style="width: 5%">Challan No.</th>
                                <th style="width: 7%">Item Category</th>
                                <th style="width: 8%">Item Name</th>
                                <th style="width: 3%">Unit</th>
                                <th style="width: 5%">Available Quantity</th>
                                <th style="width: 5%">Rec. Quantity</th>
                                <th style="width: 5%">Return Quan.</th>
                                <th style="width: 6%">Returning Quantity</th>
                                <th style="width: 8%">Return Date</th>
                                <th style="width: 5%">Remark</th>
                            </tr>';
foreach($list as $key=>$item){
    $htm.='<tr>
    <td>'.($key+1).'
        <input type="hidden" name="order_no[]" value="'.($item->orderNo).'" id="purchaseReturnOrderNo">
        <input type="hidden" name="order_id[]" value="'.($item->order_id).'" id="purchaseReturnOrderId">
        <input type="hidden" name="vender_id[]" value="'.($item->vendor_id).'" id="purchaseReturnVenderId">
        <input type="hidden" name="challan_no[]" value="'.($item->challan_no).'" id="purchaseReturnChallanNo">
    </td>
    <td>'.($item->orderNo).'</td>
    <td>'.($item->challan_no).'</td>
    <td>'.($item->name).'
        <input type="hidden" name="item_type[]" value="'.($item->item_type_id).'" id="purchaseReturnItemType">
        <input type="hidden" name="cat_id[]" value="'.($item->category_id).'" id="purchaseReturnCatId">
        <input type="hidden" name="sub_category_id[]" value="'.($item->sub_category_id).'" id="purchaseReturnSubCatId">
    </td>
    <td>'.itemName($item->item_type_id,$item->item_id).'
        <input type="hidden" name="item_id[]" value="'.($item->item_id).'" id="purchaseReturnItemId">
    </td>
    <td>'.($item->unit).'</td>
    <td>'.($item->quantity_recieved).'</td>
    <td><a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="itemsDetails('.$item->orderNo.','.$item->item_id.',1)">'.totalItem($item->orderNo,$item->item_id,1).'</a></td>
    <td><a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="itemsDetails('.$item->orderNo.','.$item->item_id.',2)">'.totalItem($item->orderNo,$item->item_id,2).'</a></td>

    <td><input required  name="return_quantity[]" value="" min="0" max="'.($item->max_quan).'" class="form-control rec" type="number" id="purchaseReturnQuantity"></td>
    
    <td><input name="return_date[]" required value=""  class="form-control" autocomplete="off" type="date" id="purchaseReturnReturnDate"></td>
 
    <td>
        <textarea name="entry_remark[]" class="form-control rem" id="PurchaseEntryRemark"></textarea>
    </td>
</tr>  
<tr>

</tr>';
}
                            

$htm.= '</tbody>
                    </table>
                </div>
            </div>
            <div class="submit text-center">
                <input class="btn btn-primary" type="submit" value="Return">
            </div>        
        </form>   
    </div>';
        return $htm;
    }

    public function save_return_entry(Request $req){
       
                foreach($req->order_no as $key=>$order_no){
            $list=DB::table('purchase_order_history')->select('quantity_recieved')->where('id',$req->order_id[$key])->first();
            // dd($list->quantity_recieved - $req->return_quantity[$key]);
            DB::table('purchase_order_history')->where('id', '=', $req->order_id[$key])
            ->update(
                [
                    'quantity_recieved'=>$list->quantity_recieved - $req->return_quantity[$key]
                    

                ]);
      
            $data =[
                    'challan_no'=>$req->challan_no[$key],
                    'return_date'=>$req->return_date[$key],
                    'orderNo'=>$order_no,
                    'item_type_id'=>$req->item_type[$key],
                    'item_id'=>$req->item_id[$key],
                    'quantity_return'=>$req->return_quantity[$key],
                    'entry_remark'=>$req->entry_remark[$key],
                    'added_by' => Auth::guard('admin')->user()->id,
                ];
             DB::table('purchase_returned_order_history')->insert($data);
        }

        return redirect()->back()->with("success", "Order Successfully Returned.");

      
    }

    public function challanDetails(Request $req)
    {
        $challan_no = $req->challan_no;
        $type = $req->type;
        $item_id = $req->item_id;
     
            $list = DB::table('purchase_recieved_order_history as proh')
            ->leftJoin('purchase_order_history as poh', 'poh.orderNo', '=', 'proh.orderNo')
            ->leftJoin('inventory_vendor_master as ivm', 'poh.vendor_id', '=', 'ivm.id')
            ->select('ivm.name as vendor','poh.id as order_id','poh.vendor_id','proh.*')
            ->where('proh.item_id', $item_id)
            ->where('proh.challan_no', $challan_no)
            ->orderBy('proh.id', 'DESC')->groupBy('proh.item_id')->get();
     
       
       
        return view('admin.purchase.itemsDetails', compact('list','type'));
    }
}
