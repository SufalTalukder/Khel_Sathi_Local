<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\FacilityBooking;
use App\Models\FacilityRegister;
use Illuminate\Support\Facades\Validator;
use App\Models\MarkQuery;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use PDF;
use DateTime;
class FacilityApplication extends Controller
{
    public function dashboard (){
       
        $status = Auth::guard('facility_booking')->user()->change_password_status;
        $userDetails = Auth::guard('facility_booking')->user();
        $applicationBooking = DB::table('facility_booking_application')->where('facility_register_id', Auth::guard('facility_booking')->user()->id)->first();
         
        $sportList = array();
        if(Auth::guard('facility_booking')->user()->applicationBasicDetasils){
        }

        if($status == 0){
           return redirect()->route('facility_booking.changePassword');
        }

        if ($userDetails->level != "2"){
          return redirect()->route('facility_booking.applicationForm');
        }
        
        return view('facility_booking.dashboard',compact('userDetails', 'sportList','applicationBooking'));
    }

    public function applicationForm(){
        $status = Auth::guard('facility_booking')->user()->change_password_status;
        $userDetails = Auth::guard('facility_booking')->user();
        $facility_id = FacilityBooking::where('facility_register_id', Auth::guard('facility_booking')->user()->id)->first();
      
        $gymnasium = DB::table('gymnasium_master')
        ->join('cities', 'cities.id', '=', 'gymnasium_master.district_id')
        ->select('gymnasium_master.id', 'gymnasium_master.longitude','cities.id as city_id' ,'gymnasium_master.latitude','gymnasium_master.gymnasium_name', 'cities.city')
        ->orderBy('gymnasium_master.id', 'ASC')->get();

        $districts = DB::table('cities')->where('state_id', '23')->get();
        $districtAll = DB::table('cities')->get();
       
       if($status == 0){
        return redirect()->route('facility_booking.changePassword');
       }
        return view('facility_booking.application_form',compact('gymnasium','facility_id','userDetails','districts','districtAll'));
    
    }
    public function applicationBasicForm(Request $request){
      $validation = Validator::make($request->all(), [
            'services' => 'required'            
        ]);
    
    $data = [
    'facility_register_id'=> Auth::guard('facility_booking')->user()->id,
    'address_details'  => $request->address_details,
    'state'  => $request->state,
    'city_id'  => $request->city_id,
    'pincode' => $request->pincode,
    'services_type' => $request->services_type,  
];

if($request->services_type == 1){

    $data ['services_master_id'] = $request->services_master_id_mini;
    $data ['services_district_id'] = $request->services_district_id_mini;

    //applicant_photo
    if ($request->hasFile('applicant_photo_mini')){
        $applicant_photo= moveFile('facility_booking_storage/applicant_photo/', $request->applicant_photo_mini);
        $data ['applicant_photo'] = $applicant_photo;
    }
    
    $data ['guardian_name'] = $request->guardian_name;
    //applicant_signature
    if ($request->hasFile('applicant_signature_mini')){
        $applicant_signature= moveFile('facility_booking_storage/applicant_signature/', $request->applicant_signature_mini);
        $data ['applicant_signature'] = $applicant_signature;
    }
    //applicant_aadhar
    if ($request->hasFile('applicant_aadhar_mini')){
        $applicant_aadhar= moveFile('facility_booking_storage/applicant_aadhar/', $request->applicant_aadhar_mini);
        $data ['applicant_aadhar'] = $applicant_aadhar;
    }
    //parent_aadhar
    if ($request->hasFile('parent_aadhar_mini')){
        $parent_aadhar= moveFile('facility_booking_storage/parent_aadhar/', $request->parent_aadhar_mini);
        $data ['parent_aadhar'] = $parent_aadhar;
    }
    //parent_signature
    if ($request->hasFile('parent_signature_mini')){
        $parent_signature= moveFile('facility_booking_storage/parent_signature/', $request->parent_signature_mini);
        $data ['parent_signature'] = $parent_signature;
    }
    //age_proof
    if ($request->hasFile('age_proof_mini')){
        $age_proof= moveFile('facility_booking_storage/age_proof/', $request->age_proof_mini);
        $data ['age_proof'] = $age_proof;
    }
    //doctor_certificate
    if ($request->hasFile('doctor_certificate_mini')){
        $doctor_certificate= moveFile('facility_booking_storage/doctor_certificate/', $request->doctor_certificate_mini);
        $data ['doctor_certificate'] = $doctor_certificate;
    }
    //address_proof
    if ($request->hasFile('address_proof_mini')){
        $address_proof= moveFile('facility_booking_storage/address_proof/', $request->address_proof_mini);
        $data ['address_proof'] = $address_proof;
    
    }
    }elseif($request->services_type == 2){

        $data ['services_master_id'] = $request->services_master_id_adult;
        $data ['services_district_id'] = $request->services_district_id_adult;

        if ($request->hasFile('applicant_photo_adult')){
            $applicant_photo= moveFile('facility_booking_storage/applicant_photo/', $request->applicant_photo_adult);
            $data ['applicant_photo'] = $applicant_photo;
        
        }
        //applicant_signature
    if ($request->hasFile('applicant_signature_adult')){
        $applicant_signature= moveFile('facility_booking_storage/applicant_signature/', $request->applicant_signature_adult);
        $data ['applicant_signature'] = $applicant_signature;
    }
    //applicant_aadhar
    if ($request->hasFile('applicant_aadhar_adult')){
        $applicant_aadhar= moveFile('facility_booking_storage/applicant_aadhar/', $request->applicant_aadhar_adult);
        $data ['applicant_aadhar'] = $applicant_aadhar;
    
    }
    //address_proof
    if ($request->hasFile('address_proof_adult')){
        $address_proof= moveFile('facility_booking_storage/address_proof/', $request->address_proof_adult);
        $data ['address_proof'] = $address_proof;
    
    }
    //doctor_certificate
    if ($request->hasFile('doctor_certificate_adult')){
        $doctor_certificate= moveFile('facility_booking_storage/doctor_certificate/', $request->doctor_certificate_adult);
        $data ['doctor_certificate'] = $doctor_certificate;
    
    }
}elseif($request->services_type == 3){

        $data ['services_master_id'] = $request->services_master_id_gym;
        $data ['services_district_id'] = $request->services_district_id_gym; 
        if ($request->hasFile('applicant_photo_gym')){
            $applicant_photo= moveFile('facility_booking_storage/applicant_photo/', $request->applicant_photo_gym);
            $data ['applicant_photo'] = $applicant_photo;
        
        }
        //applicant_aadhar
    if ($request->hasFile('applicant_aadhar_gym')){
        $applicant_aadhar= moveFile('facility_booking_storage/applicant_aadhar/', $request->applicant_aadhar_gym);
        $data ['applicant_aadhar'] = $applicant_aadhar;
    
    }
    if ($request->hasFile('applicant_signature_gym')){
        $applicant_signature= moveFile('facility_booking_storage/applicant_signature/', $request->applicant_signature_gym);
        $data ['applicant_signature'] = $applicant_signature;
    }
    }
//dd($data);
$id_booking = DB::table('facility_booking_application')->insertGetId($data);
$user = Auth::guard('facility_booking')->user();
$user->level = '2';
$user->save();

$applicationBooking=  FacilityBooking::find($id_booking);

return redirect('facility_booking/application_preview/'.$id_booking)->with('success','Submitted Successfully.');
//return response()->json(['error' => false, 'msg' => 'Submitted Successfully.', 'url'=> route('facility_booking.applicationFormPreview' ,$applicationBooking->id)]);
}
    public function stadiumBooking(){
        return view('facility_booking.stadium_booking');
    }

    public function stadiumBookingStore(Request $request){

        return view('facility_booking.stadium_booking');
    }

    public function applicationFormPreview(Request $request, $id){
        $booking_id=$request->id;
        $applicationBooking = DB::table('facility_booking_application')
        ->select('*')
        ->where('id' , $booking_id)
        ->first();
        //dd( $applicationBooking);
        return view('facility_booking.application_form_preview',compact('applicationBooking'));
    }

    public function booking_final_submit($id){
        $FacilityBooking= FacilityBooking::find($id);
        $FacilityBooking->update([
            'application_no' => date('Y').sprintf("%010d", $id),
            'final_submit'=> 1,
            'created_at'=> date('Y-m-d H:i:s')

        ]);         
        return response()->json(['error' => false, 'msg' => 'Final Submitted Successfully .', 'url'=> route('facility_booking.dashboard')]);

    }

    public function applicationFormUpdate($id,Request $request){
         
        FacilityBooking::where('facility_register_id', Auth::guard('facility_booking')->user()->id)->first();
        $data = [
        'facility_register_id'=> Auth::guard('facility_booking')->user()->id,
        'address_details'  => $request->address_details,
        'state'  => $request->state,
        'city_id'  => $request->city_id,
        'pincode' => $request->pincode,
        'services_type' => $request->services_type,
        'guardian_name'=> $request->guardian_name,
        ];
        if($request->services_type == 1){
            $data ['services_master_id'] = $request->services_master_id_mini;
            $data ['services_district_id'] = $request->services_district_id_mini;
        }else if($request->services_type == 2){
            $data ['services_master_id'] = $request->services_master_id_adult;
            $data ['services_district_id'] = $request->services_district_id_adult;
        }else if($request->services_type == 3){
            $data ['services_master_id'] = $request->services_master_id_gym;
            $data ['services_district_id'] = $request->services_district_id_gym;
        }else{
            $data ['services_master_id'] = '' ;
            $data ['services_district_id'] = '' ;
        }

//applicant_photo
if ($request->hasFile('applicant_photo_mini')){
    $applicant_photo= moveFile('facility_booking_storage/applicant_photo/', $request->applicant_photo_mini);
    $data ['applicant_photo'] = $applicant_photo;

}
//applicant_signature
if ($request->hasFile('applicant_signature_mini')){
    $applicant_signature= moveFile('facility_booking_storage/applicant_signature/', $request->applicant_signature_mini);
    $data ['applicant_signature'] = $applicant_signature;
}
//applicant_aadhar
if ($request->hasFile('applicant_aadhar_mini')){
    $applicant_aadhar= moveFile('facility_booking_storage/applicant_aadhar/', $request->applicant_aadhar_mini);
    $data ['applicant_aadhar'] = $applicant_aadhar;

}
//parent_aadhar
if ($request->hasFile('parent_aadhar_mini')){
    $parent_aadhar= moveFile('facility_booking_storage/parent_aadhar/', $request->parent_aadhar_mini);
    $data ['parent_aadhar'] = $parent_aadhar;

}
//parent_signature
if ($request->hasFile('parent_signature_mini')){
    $parent_signature= moveFile('facility_booking_storage/parent_signature/', $request->parent_signature_mini);
    $data ['parent_signature'] = $parent_signature;

}
//age_proof
if ($request->hasFile('age_proof_mini')){
    $age_proof= moveFile('facility_booking_storage/age_proof/', $request->age_proof_mini);
    $data ['age_proof'] = $age_proof;

}
//doctor_certificate
if ($request->hasFile('doctor_certificate_mini')){
    $doctor_certificate= moveFile('facility_booking_storage/doctor_certificate/', $request->doctor_certificate_mini);
    $data ['doctor_certificate'] = $doctor_certificate;

}
//address_proof
if ($request->hasFile('address_proof_mini')){
    $address_proof= moveFile('facility_booking_storage/address_proof/', $request->address_proof_mini);
    $data ['address_proof'] = $address_proof;

}
//if($request->services_type == 2){
    if ($request->hasFile('applicant_photo_adult')){
        $applicant_photo= moveFile('facility_booking_storage/applicant_photo/', $request->applicant_photo_adult);
        $data ['applicant_photo'] = $applicant_photo;
    
    }
    //applicant_signature
if ($request->hasFile('applicant_signature_adult')){
    $applicant_signature= moveFile('facility_booking_storage/applicant_signature/', $request->applicant_signature_adult);
    $data ['applicant_signature'] = $applicant_signature;
}
//applicant_aadhar
if ($request->hasFile('applicant_aadhar_adult')){
    $applicant_aadhar= moveFile('facility_booking_storage/applicant_aadhar/', $request->applicant_aadhar_adult);
    $data ['applicant_aadhar'] = $applicant_aadhar;

}
//address_proof
if ($request->hasFile('address_proof_adult')){
    $address_proof= moveFile('facility_booking_storage/address_proof/', $request->address_proof_adult);
    $data ['address_proof'] = $address_proof;

}
//doctor_certificate
if ($request->hasFile('doctor_certificate_adult')){
    $doctor_certificate= moveFile('facility_booking_storage/doctor_certificate/', $request->doctor_certificate_adult);
    $data ['doctor_certificate'] = $doctor_certificate;

}
    if ($request->hasFile('applicant_photo_gym')){
        $applicant_photo= moveFile('facility_booking_storage/applicant_photo/', $request->applicant_photo_gym);
        $data ['applicant_photo'] = $applicant_photo;
    
    }
    //applicant_aadhar
if ($request->hasFile('applicant_aadhar_gym')){
    $applicant_aadhar= moveFile('facility_booking_storage/applicant_aadhar/', $request->applicant_aadhar_gym);
    $data ['applicant_aadhar'] = $applicant_aadhar;

}
if ($request->hasFile('applicant_signature_gym')){
    $applicant_signature= moveFile('facility_booking_storage/applicant_signature/', $request->applicant_signature_gym);
    $data ['applicant_signature'] = $applicant_signature;
}


$FacilityBookingedit = FacilityBooking::find($id);

$FacilityBookingedit ->update($data); 

//return response()->json(['error' => false, 'msg' => 'Submitted Successfully.', 'url'=> route('facility_booking.applicationFormPreview' ,$FacilityBookingedit->id)]);
return redirect('facility_booking/application_preview/'.$FacilityBookingedit->id)->with('success','Updated Successfully.');

}

public function applicationFormEdit ($id){
        $districts = DB::table('cities')->where('state_id', '23')->get();
        $districtAll = DB::table('cities')->get();
        $Facilityedit= FacilityBooking::find($id); 
       // dd($Facilityedit)   ;  
        return view('facility_booking.application_form',compact('Facilityedit','districts','districtAll'));
    }

    public function generate_application_preview(Request $req){
        $fac_id = $req->id;
        $applicationBooking = DB::table('facility_booking_application')
        ->select('*')
        ->where('facility_register_id' , Auth::guard('facility_booking')->user()->id)
        ->where('id' , $fac_id)
        ->first();
        //dd($applicationBooking);
        if($applicationBooking->final_submit == 1){
        $profile_detail = FacilityBooking::where('facility_register_id', Auth::guard('facility_booking')->user()->id)->first();
        $pdf = PDF::loadView('facility_booking.facility_booking_download',compact('applicationBooking','profile_detail'));
        return $pdf->download('Facility Booking Application.pdf');
       }
    }

    public function get_swimming(Request $req)
    {
        $id=$req->value;
        $all_swimming = DB::table('swimming_master')->where('district_id',$id)->orderBy('swimming_name','ASC')->get();
        
        return $all_swimming;
    }

    public function get_gymnasium(Request $req)
    {
        $id=$req->value;
        $all_gymnasium = DB::table('gymnasium_master')->where('district_id',$id)->orderBy('gymnasium_name','ASC')->get();
        return $all_gymnasium;
    }


}
