<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use PDF;
class InventoryReportController extends Controller
{
    public function orderReport(Request $req)
    {
        
        $vendor = DB::table('inventory_vendor_master')->orderBy('id', 'DESC')->get();
        $listt = DB::table('purchase_order_history as poh')
        ->join('inventory_vendor_master as ivm', 'poh.vendor_id', '=', 'ivm.id')
        ->join('inventory_category_master as icm', 'poh.category_id', '=', 'icm.id')
        ->join('inventory_subcategory_master as iscm', 'poh.sub_category_id', '=', 'iscm.id')
        ->select('ivm.name as vendor','poh.*','icm.name as category','iscm.name as subcategory');
        if($req->vendor){
            $listt->where('poh.vendor_id',$req->vendor);
        }
        if(isset($req->order_no) && $req->order_no != 'all'){
            $listt->where('poh.orderNo',$req->order_no);
        }
        if(Auth::guard('admin')->user()->admin_role != 1 ){
        // if(Auth::guard('admin')->user()->admin_role == 9 || Auth::guard('admin')->user()->admin_role == 10){
            $listt->where('poh.added_by', Auth::guard('admin')->user()->id);
        }
        $list =$listt->orderBy('poh.id', 'DESC')->get();
        return view('admin.inventory_report.orderReport', ['list' => $list,'vendor' => $vendor]);
    }

    public function get_order_list(Request $req)
    { 
        $id=$req->value;
        $all_order_listt=DB::table('purchase_order_history')->where('vendor_id',$id)->groupBy('orderNo')->orderBy('orderNo','ASC')->get();
        return $all_order_listt;
    }

    public function indentReport(Request $req)
    {
        $listt = DB::table('indent_raise_request as poh')
        ->join('inventory_section_master as ism', 'poh.section_id', '=', 'ism.id')
        ->join('inventory_category_master as icm', 'poh.category_id', '=', 'icm.id')
        ->join('inventory_subcategory_master as iscm', 'poh.sub_category_id', '=', 'iscm.id')
        ->join('indent_issue as ii', 'poh.id', '=', 'ii.indent_id')
        ->select('ism.name_hn as section','poh.*','icm.name as category','iscm.name as subcategory','ii.created_at as issuance_date');
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
        $section = DB::table('inventory_section_master')->orderBy('id', 'DESC')->get();
        return view('admin.inventory_report.indentReport', ['list' => $list,'section'=>$section]);
    }

    public function orderReportPdf(Request $req)
    {
        
        $vendor = DB::table('inventory_vendor_master')->orderBy('id', 'DESC')->get();
        $listt = DB::table('purchase_order_history as poh')
        ->join('inventory_vendor_master as ivm', 'poh.vendor_id', '=', 'ivm.id')
        ->join('inventory_category_master as icm', 'poh.category_id', '=', 'icm.id')
        ->join('inventory_subcategory_master as iscm', 'poh.sub_category_id', '=', 'iscm.id')
        ->select('ivm.name as vendor','poh.*','icm.name as category','iscm.name as subcategory');
        if($req->vendor){
            $listt->where('poh.vendor_id',$req->vendor);
        }
        if(isset($req->order_no) && $req->order_no != 'all'){
            $listt->where('poh.orderNo',$req->order_no);
        }
        if(Auth::guard('admin')->user()->admin_role != 1 ){
        // if(Auth::guard('admin')->user()->admin_role == 9 || Auth::guard('admin')->user()->admin_role == 10){
            $listt->where('poh.added_by', Auth::guard('admin')->user()->id);
        }
        $list =$listt->orderBy('poh.id', 'DESC')->get();
        // return view('admin.inventory_report.orderReportPdf', ['list' => $list,'vendor' => $vendor]);

         
       $pdf = PDF::loadView('admin.inventory_report.orderReportPdf', ['list' => $list,'vendor' => $vendor])->setPaper('a4', 'landscape');
       $pdf->output();
       $domPdf = $pdf->getDomPDF();
       $canvas = $domPdf->get_canvas();
       $rightMargin = 90;
       $pageWidth = $canvas->get_width();
       $pageNumberX = $pageWidth - $rightMargin;

       $canvas->page_text($pageNumberX, $canvas->get_height() - 20, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, [0, 0, 0]);
       $canvas->page_text(320, $canvas->get_height() - 20, "*This is a Software Generated Report*", null, 10, [0, 0, 0]);
       $namee  = "List of Purchase Order" . date('m-d-Y') . '.pdf';
        return $pdf->download($namee);
    }

    public function indentReportPdf(Request $req)
    {
        $listt = DB::table('indent_raise_request as poh')
        ->join('inventory_section_master as ism', 'poh.section_id', '=', 'ism.id')
        ->join('inventory_category_master as icm', 'poh.category_id', '=', 'icm.id')
        ->join('inventory_subcategory_master as iscm', 'poh.sub_category_id', '=', 'iscm.id')
        ->join('indent_issue as ii', 'poh.id', '=', 'ii.indent_id')
        ->select('ism.name_hn as section','poh.*','icm.name as category','iscm.name as subcategory','ii.created_at as issuance_date');
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
        $section = DB::table('inventory_section_master')->orderBy('id', 'DESC')->get();
        // return view('admin.inventory_report.indentReportPdf', ['list' => $list,'section'=>$section]);

        $pdf = PDF::loadView('admin.inventory_report.indentReportPdf', ['list' => $list,'section'=>$section])->setPaper('a4', 'landscape');
       $pdf->output();
       $domPdf = $pdf->getDomPDF();
       $canvas = $domPdf->get_canvas();
       $rightMargin = 90;
       $pageWidth = $canvas->get_width();
       $pageNumberX = $pageWidth - $rightMargin;

       $canvas->page_text($pageNumberX, $canvas->get_height() - 20, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, [0, 0, 0]);
       $canvas->page_text(320, $canvas->get_height() - 20, "*This is a Software Generated Report*", null, 10, [0, 0, 0]);
       $namee  = "List of Issued Indents" . date('m-d-Y') . '.pdf';
        return $pdf->download($namee);
    }


}
