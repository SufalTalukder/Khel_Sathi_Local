<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminCoachingCampController extends Controller
{

   public function coaching_camp_list( Request $req)
   {

      $applicant_detailss = DB::table('coaching_camp_register')
      ->join('coaching_camp_basic_details', 'coaching_camp_register.id','=','coaching_camp_basic_details.user_id')
       ->select('coaching_camp_register.*','coaching_camp_basic_details.id as basic_id','coaching_camp_basic_details.*', 'coaching_camp_register.dob as regdob')
       ->where('coaching_camp_basic_details.final_submit', 1);
                                      
       if($req->post()){

       if ($req->city_filter){
        $applicant_detailss->where( 'coaching_camp_basic_details.permanent_district', $req->city_filter);
      }

}
       $applicationview=$applicant_detailss->where('coaching_camp_basic_details.payment_status', 1)->orderByDesc('coaching_camp_register.id')->get();
    //    dd($applicationview);
       $districts = DB::table('cities')->select('city', 'id')->where('state_id', '23')->get();
       $sports = DB::table('sport_type')->orderBy('name')->get();
       return view('admin.coaching_camp.index', compact('sports', 'districts','applicationview'));
   }


   public function coaching_camp_view_details($id){
    //$applicationview = DB::table('gymnasium_swimming_basic_detail')->where('user_id',$id)->first();
    $applicationview =DB::table('coaching_camp_basic_details')
    ->join('coaching_camp_register', 'coaching_camp_register.id','=','coaching_camp_basic_details.user_id')
    ->leftJoin('studium_master as b','coaching_camp_basic_details.stadium','b.id')
     ->select('coaching_camp_register.*','coaching_camp_basic_details.id as basic_id','coaching_camp_basic_details.*','b.studium_name as stadium_name','coaching_camp_register.dob as regdob')
     ->where('coaching_camp_basic_details.final_submit', 1)->where('coaching_camp_basic_details.id', $id)->first();

    return view('admin.coaching_camp.basic_detail', compact('applicationview'));
 }



 public function applicationUpdateStatus( Request $request)
 {
    $id = $request->id;
    $status = $request->status;
   $data = [
    'status' => $status,
    'payment_amount_coaching' => $request->payment_amount,
    'remark' => $request->remark,
    'status_on' => date('Y-m-d H:i:s'),
    'status_updated_by' =>Auth::guard('admin')->user()->id,
   ];
    DB::table('coaching_camp_basic_details')->where('id', $id)->update($data);

    return response()->json([
        'error' => false,
        'msg' => 'Application status updated successfully.',
        'url' => route('coaching_camp_view_details',$id)
    ]);

  }
 

}
