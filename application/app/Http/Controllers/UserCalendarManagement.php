<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class UserCalendarManagement extends Controller
{
    public function sports_calendar(){
        // dd( DB::table('laxman_award')
        // ->select('*') 
        // ->where('application_no','25100798375')        
        // ->first());
        DB::table('laxman_award')->where('application_no','25092752527')->update(['form_status'=>0]);
        // 6568
        $sports_calendar = DB::table('calender_management_info')
        ->select('*') 
        ->orderByDesc('id')        
        ->get();        
        return view('user_calendar.sports_calendar',compact('sports_calendar'));
    }
}
