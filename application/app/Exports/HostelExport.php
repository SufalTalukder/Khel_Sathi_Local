<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Facades\Auth;

class HostelExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function view(): View
    {
        $division=DB::table('hostel_division_master')->get();
        $check = DB::table('hostel_div_district_mapping')
       ->select(DB::raw('group_concat(district_id) as district_id'))->where( 'division_id', Auth::guard('admin')->user()->division_id)->get();
        $districts = DB::table('cities')->where('state_id', 23);

        if(Auth::guard('admin')->user()->division_id){
           $districts->whereIn( 'id',explode(',',$check[0]->district_id));
        }

        $districts=   $districts->orderBy('city', 'asc')->get();
        $hostelList =  DB::table('hostel_register as rg')
        ->join('hostel_application_basic as basic', 'rg.id', '=', 'basic.hostel_register_id')
        ->select('rg.*','basic.sports', 'basic.district_id')
        ->whereIn('rg.payment_status', [1,2,3]);

       
        $hostelList=  $hostelList->get();
        // $userDetails->payment_status
        $divisions = DB::table('hostel_division_master')->orderBy('division_name')->get();
        $sports = DB::table('sport_master')->orderBy('name')->get();
        return view('exports.hostelExcelList',compact('hostelList','districts','divisions','sports'));
    }
}

