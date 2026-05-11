<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\CoachModel;

class CoachMasterController extends Controller
{
    public function index()
    {
        $applicationBooking = DB::table('facility_booking_application')->orderBy('id', 'DESC')->get();
        // dd($applicationBooking);
        return view('admin.coach_master.index', ['applicationBooking' => $applicationBooking]);
    }
}
