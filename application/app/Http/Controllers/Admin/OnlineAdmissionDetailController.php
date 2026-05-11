<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\DivisionModel;
use App\Models\DivisionDistrictMap;
use App\Models\StudiumMasterModel;

class OnlineAdmissionDetailController extends Controller
{
    public function index()
    {
         
        $lists = DB::table('admission_registration_login as rg')->where('rg.final_status', '1')->orderBy('rg.id', 'ASC')->get();  
        return view('admin.division_master.online_admission_list', ['lists' => $lists]);
    }

    public function registerUserDetails($id)
    {

        $data = DB::table('admission_registration_login as rg')
                ->join('online_admission_basic_details as basic', 'rg.id', '=', 'basic.user_id')
                ->join('online_admission_communication_details as communication', 'rg.id', '=', 'communication.user_id')
                ->join('online_admission_education_document_details as education', 'rg.id', '=', 'education.user_id')
                ->join('sport_type', 'basic.sport_type', '=', 'sport_type.id')
                ->select('rg.*','basic.*','communication.*','education.*','sport_type.name')
                ->where('rg.id', $id)->where('rg.final_status', '1')->first();

            // dd($data);
                return view('admin.division_master.online_admission_details', compact('data'));
    }
}
