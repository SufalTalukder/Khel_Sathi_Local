<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class PurchaseStores extends Controller
{

    public function indentList(Request $req)
    {
        $listt = DB::table('indent_raise_request as poh')
        ->join('inventory_section_master as ism', 'poh.section_id', '=', 'ism.id')
        ->join('inventory_category_master as icm', 'poh.category_id', '=', 'icm.id')
        ->join('inventory_subcategory_master as iscm', 'poh.sub_category_id', '=', 'iscm.id')
        ->select('ism.name_hn as section','poh.*','icm.name as category','iscm.name as subcategory');
        if($req->indent_no){
            $listt->where('poh.indent_no', $req->indent_no);
        }
        if($req->section){
            $listt->where('poh.section_id', $req->section);
        }
         if(Auth::guard('admin')->user()->admin_role != 1 ){
        // if(Auth::guard('admin')->user()->admin_role == 9 || Auth::guard('admin')->user()->admin_role == 10){
            $listt->where('poh.added_by', Auth::guard('admin')->user()->id);
        }
        $list= $listt->groupBy('poh.indent_no')->orderBy('poh.id', 'DESC')->get();
    //   dd($list);
        $section = DB::table('inventory_section_master');
         if(Auth::guard('admin')->user()->admin_role != 1 ){
        // if(Auth::guard('admin')->user()->admin_role == 9 || Auth::guard('admin')->user()->admin_role == 10){
            $section->where('added_by', Auth::guard('admin')->user()->id);
        }
        $section=$section->orderBy('id', 'DESC')->get();
        return view('admin.indent.indent_list', ['list' => $list,'section'=>$section]);
    }

    public function indent(Request $req)
    {
        $employee = DB::table('employee');
        // if(Auth::guard('admin')->user()->admin_role == 9 || Auth::guard('admin')->user()->admin_role == 10){
        //     $employee->where('added_by', Auth::guard('admin')->user()->id);
        // }
        $employee =$employee->orderBy('id', 'DESC')->get();
        $section = DB::table('inventory_section_master');
         if(Auth::guard('admin')->user()->admin_role != 1 ){
        // if(Auth::guard('admin')->user()->admin_role == 9 || Auth::guard('admin')->user()->admin_role == 10){
            $section->where('added_by', Auth::guard('admin')->user()->id);
        }
        $section=$section->orderBy('id', 'DESC')->get();
        if($req->id){
            $list=DB::table('purchase_order_history')->where('orderNo',$req->id)->get();
            
            return view('admin.purchase.add_purchase_order', ['section' => $section,'employee'=>$employee,'list'=>$list]);
        }
        
        return view('admin.indent.add_indent', ['section' => $section,'employee'=>$employee,]);
    }

    public function addIndent(Request $req)
    {
      
        $validation = Validator::make($req->all(), [
            'indent_for'     => 'required',
            'section_id'     => 'required',
            'indent_date'     => 'required',
            'item_type_id.*'     => 'required',
            'category_id.*'     => 'required',
            'sub_category_id.*'     => 'required',
            'item_id.*'     => 'required',
            'unit.*'     => 'required',
            'quantity.*'     => 'required',
        ]);
        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

            $ranNo = rand(111111, 999999);
            $orderNo= date('Y').$ranNo;
            foreach($req->item_type_id as $key=>$item){
                DB::table('indent_raise_request')->insertGetId(array(
                    'indent_for' =>  $req->indent_for,
                    'section_id' =>  $req->section_id,
                    'indent_date' =>  $req->indent_date,
                    'employee_id' =>  $req->employee_id,
                    'indent_no' =>$orderNo,
                    'item_type_id' =>$item,
                    'category_id' =>$req->category_id[$key],
                    'sub_category_id' => $req->sub_category_id[$key],
                    'item_id' => $req->item_id[$key],
                    'unit' => $req->unit[$key],
                    'requested_quantity' => $req->quantity[$key],
                    'added_by' => Auth::guard('admin')->user()->id,
                   
                ));
            }
               
            return response()->json(["error" => false, "msg" => "Indent Raise Successfully","url" => route('indentList')]);
        
    }


    public function indentDetails(Request $req)
    {
        $id = $req->id;
        $list = DB::table('indent_raise_request as poh')
        ->join('inventory_section_master as ism', 'poh.section_id', '=', 'ism.id')
        ->join('inventory_category_master as icm', 'poh.category_id', '=', 'icm.id')
        ->join('inventory_subcategory_master as iscm', 'poh.sub_category_id', '=', 'iscm.id')
        ->select('ism.name_hn as section','poh.*','icm.name as category','iscm.name as subcategory')
        ->where('poh.indent_no', $id)->orderBy('poh.id', 'DESC')->get();

        // $list = DB::table('purchase_order_history')->where('orderNo', $id)->get();
        return view('components.intentHistory', compact('list'));
    }
    public function deleteIntent($id){
        DB::table('indent_raise_request')->where('indent_no', '=', $id)->delete();
        return redirect()->back()->with("success", "Indent Successfully Deleted.");
    }
    public function deleteIntentById($id){
        DB::table('indent_raise_request')->where('id', '=', $id)->delete();
        return redirect()->back()->with("success", "Indent Successfully Deleted.");
    }

    public function aproveIndent()
    {
        $list = DB::table('indent_raise_request as poh')
        ->join('inventory_section_master as ism', 'poh.section_id', '=', 'ism.id')
        ->join('inventory_category_master as icm', 'poh.category_id', '=', 'icm.id')
        ->join('inventory_subcategory_master as iscm', 'poh.sub_category_id', '=', 'iscm.id')
        ->select('ism.name_hn as section','poh.*','icm.name as category','iscm.name as subcategory')
        ->where('poh.indent_status', 0);
         if(Auth::guard('admin')->user()->admin_role != 1 ){
        // if(Auth::guard('admin')->user()->admin_role == 9 || Auth::guard('admin')->user()->admin_role == 10){
            $list->where('poh.added_by', Auth::guard('admin')->user()->id);
        }
        $list =  $list->groupBy('poh.indent_no')
        ->orderBy('poh.id', 'DESC')->get();
    //   dd($list);
        return view('admin.indent.aproveIndent', ['list' => $list]);
    }

    public function indents_pending_to_process(Request $req)
    {
        $id = $req->id;
        $list = DB::table('indent_raise_request as poh')
        ->join('inventory_section_master as ism', 'poh.section_id', '=', 'ism.id')
        ->join('inventory_category_master as icm', 'poh.category_id', '=', 'icm.id')
        ->join('inventory_subcategory_master as iscm', 'poh.sub_category_id', '=', 'iscm.id')
        ->select('ism.name_hn as section','poh.*','icm.name as category','iscm.name as subcategory')
        ->where('poh.indent_no', $id)->orderBy('poh.id', 'DESC')->get();

        // $list = DB::table('purchase_order_history')->where('orderNo', $id)->get();
        // dd($list);
        return view('components.indents_pending_to_process', compact('list'));
    }
    public function pending_to_process(Request $req){

        foreach($req->id as $key=>$id){
 
            DB::table('indent_raise_request')->where('id', '=', $id)->update(['approved_quantity'=>$req->approve_quantity[$key],'indent_status' =>$req->approval_status[$key] ]);
        }
        return redirect()->back()->with("success", " Success.");
    }

    public function indents_issue(Request $req)
    {
        // $id = $req->id;
        $listt = DB::table('indent_raise_request as poh')
        ->join('inventory_section_master as ism', 'poh.section_id', '=', 'ism.id')
        ->join('inventory_category_master as icm', 'poh.category_id', '=', 'icm.id')
        ->join('inventory_subcategory_master as iscm', 'poh.sub_category_id', '=', 'iscm.id')
        ->select('ism.name_hn as section','poh.*','icm.name as category','iscm.name as subcategory')
        ->where('poh.indent_status','!=', 0)->where('poh.issued_quantity','=', null);
        if($req->indent_no){
            $listt->where('poh.indent_no', $req->indent_no);
        }
         if(Auth::guard('admin')->user()->admin_role != 1 ){
        // if(Auth::guard('admin')->user()->admin_role == 9 || Auth::guard('admin')->user()->admin_role == 10){
            $listt->where('poh.added_by', Auth::guard('admin')->user()->id);
        }
        $list=$listt->orderBy('poh.id', 'DESC')->get();

        // $list = DB::table('purchase_order_history')->where('orderNo', $id)->get();
        // dd($list);
        return view('admin.indent.indents_issue_list', compact('list'));
    }

    
    public function save_indent_issue(Request $req)
    {
        foreach($req->data['PurchaseIndentIssue'] as $key=>$item){
            if($item['issue_quantity'] !=0){
               
                DB::table('indent_issue')->insertGetId(array(
                    'indent_id' =>  $item['indent_id'],
                    'indent_no' =>  $item['intent_no'],
                    'issue_quantity' =>  $item['issue_quantity'],
                    'remark' =>  $req->remark,
                    'date_of_issuance' =>$req->date_of_issuance,
                    'issued_by' => Auth::guard('admin')->user()->id
                ));
                DB::table('indent_raise_request')->where('id', '=', $item['indent_id'])->update(['issued_quantity'=>$item['issue_quantity']]);
            }
        }
        return redirect()->back()->with("success", "Indents Issued Successfully Saved.");
        // dd($req->data['PurchaseIndentIssue']);
    }
    public function indents_return(Request $req)
    {
        // $id = $req->id;
        $listt = DB::table('indent_raise_request as poh')
        ->join('inventory_section_master as ism', 'poh.section_id', '=', 'ism.id')
        ->join('inventory_category_master as icm', 'poh.category_id', '=', 'icm.id')
        ->join('inventory_subcategory_master as iscm', 'poh.sub_category_id', '=', 'iscm.id')
        ->select('ism.name_hn as section','poh.*','icm.name as category','iscm.name as subcategory')
        ->where('poh.indent_status','!=', 0)->where('poh.issued_quantity','!=', null);
        if($req->indent_no){
            $listt->where('poh.indent_no', $req->indent_no);
        }
         if(Auth::guard('admin')->user()->admin_role != 1 ){
        // if(Auth::guard('admin')->user()->admin_role == 9 || Auth::guard('admin')->user()->admin_role == 10){
            $listt->where('poh.added_by', Auth::guard('admin')->user()->id);
        }
        $list=$listt->orderBy('poh.id', 'DESC')->get();

        // $list = DB::table('purchase_order_history')->where('orderNo', $id)->get();
        // dd($list);
        return view('admin.indent.indents_return_list', compact('list'));
    }

    public function save_indent_return(Request $req)
    {
        // dd($req->all());
        foreach($req->data['PurchaseIndentIssue'] as $key=>$item){
            if($item['return_quantity'] !=0){
               
                DB::table('indent_return')->insertGetId(array(
                    'indent_id' =>  $item['indent_id'],
                    'indent_no' =>  $item['intent_no'],
                    'return_quantity' =>  $item['return_quantity'],
                    'remark' =>  $req->remark,
                    'date_of_return' =>$req->date_of_issuance,
                    'return_by' => Auth::guard('admin')->user()->id
                ));
                $ddd=DB::table('indent_raise_request')->select('return_quantity')->where('id', '=', $item['indent_id'])->first();
// dd($ddd->return_quantity);
                DB::table('indent_raise_request')->where('id', '=', $item['indent_id'])->update(['return_quantity'=>$item['return_quantity'] + $ddd->return_quantity]);
            }
        }
        return redirect()->back()->with("success", "Indents Returned Successfully Saved.");
        // dd($req->data['PurchaseIndentIssue']);
    }

    public function indent_history_list()
    {
        $list = DB::table('indent_raise_request as poh')
        ->join('inventory_section_master as ism', 'poh.section_id', '=', 'ism.id')
        ->join('inventory_category_master as icm', 'poh.category_id', '=', 'icm.id')
        ->join('inventory_subcategory_master as iscm', 'poh.sub_category_id', '=', 'iscm.id')
        ->select('ism.name_hn as section','poh.*','icm.name as category','iscm.name as subcategory')
        ->where('poh.indent_status','!=', 0);
         if(Auth::guard('admin')->user()->admin_role != 1 ){
        // if(Auth::guard('admin')->user()->admin_role == 9 || Auth::guard('admin')->user()->admin_role == 10){
            $list->where('poh.added_by', Auth::guard('admin')->user()->id);
        }
        $list =$list->orderBy('poh.id', 'DESC')->get();
    //   dd($list);
        return view('admin.indent.indent_history_list', ['list' => $list]);
    }
    public function indent_history_details($id)
    {
        // dd($id);

        $issued = DB::table('indent_raise_request as poh')
        ->join('inventory_section_master as ism', 'poh.section_id', '=', 'ism.id')
        ->join('inventory_category_master as icm', 'poh.category_id', '=', 'icm.id')
        ->join('inventory_subcategory_master as iscm', 'poh.sub_category_id', '=', 'iscm.id')
        ->join('indent_issue as indent_issue', 'poh.indent_no', '=', 'indent_issue.indent_no')
        ->select('ism.name_hn as section','poh.*','icm.name as category','iscm.name as subcategory','indent_issue.issue_quantity as issue_quantity'
        ,'indent_issue.date_of_issuance as date_of_issuance','indent_issue.issued_by as issued_by'
        )
        ->where('poh.indent_no', $id)->get();
        $return = DB::table('indent_raise_request as poh')
        ->join('inventory_section_master as ism', 'poh.section_id', '=', 'ism.id')
        ->join('inventory_category_master as icm', 'poh.category_id', '=', 'icm.id')
        ->join('inventory_subcategory_master as iscm', 'poh.sub_category_id', '=', 'iscm.id')
        ->join('indent_return as iscmm', 'poh.indent_no', '=', 'iscmm.indent_no')
        ->select('ism.name_hn as section','poh.*','icm.name as category','iscm.name as subcategory',
        'iscmm.return_quantity as return_quantity','iscmm.date_of_return','iscmm.return_by')
        ->where('poh.indent_no', $id)->get();
    //   dd($return);
        return view('admin.indent.indents_history_details', ['issued' => $issued,'return' => $return]);
    }
    
}
