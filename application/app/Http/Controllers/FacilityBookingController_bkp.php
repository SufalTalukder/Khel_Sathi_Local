<?php

namespace App\Http\Controllers;

use App\Events\SmsMail;
use App\Models\FacilityRegister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PDF;
class FacilityBookingController extends Controller
{
      public function register(Request $request){






        if($request->method()== 'POST'){
            $validation = Validator::make($request->all(),[
                'name' => 'required|max:100',
                'fathername'=>'required',
                'mothername'=> 'required',
                'nationality'=> 'required',
                'dob'=> 'required',
                'email'=>'required|email',

                'mobile'=> 'required|numeric|digits:10',
                'captcha'=>'required'
            ]);
            if ($validation->fails()){
                return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

            }


            if($request->captcha != $request->capchaCode){
                return response()->json(['error' => true, 'msg' => 'Oops! Invalid Captcha Code.']);

            }

            $otp = rand(111111, 999999);
            $randomPassword = 12345678;
            $data = [
             'name'=> $request->name,
             'fathername'=> $request->fathername,
             'mothername'=> $request->mothername,
             'nationality'=> $request->nationality,
             'dob'=> $request->dob,
             'email'=> $request->email,
             'age'=>$request->age,
             'mobile'=> $request->mobile,
             'otp'=> $otp,
             'decoded_password'=> $randomPassword,
             'password' => Hash::make($randomPassword),
        ];
        $user = FacilityRegister::where('email', $request->email)->where('otp_verify', 0)->first();
        if($user){
             $user->update($data);
             session()->put('email', $request->email);
             session()->put('mobile', $request->mobile);
             session()->put('form_type', 1);
             SmsMail::dispatch([
                 "otp" => $otp,
                 "email" => $request->email,
                 "mobile" => $request->mobile
             ], 1);

             return response()->json(['error' => false, 'msg' => 'OTP Sent Successfully./ओटीपी सफलतापूर्वक अग्रेषित कर दिया गया है।.', 'url'=> route('facility_booking_otp')]);

            }

            $user = FacilityRegister::where('email', $request->email)->first();
            if($user){

                      return response()->json(['error' => true, 'msg' => 'Email Already exist.']);
            }
        //dd($data);
        $registerUser = FacilityRegister::create($data);
        $user = Auth::guard('facility_booking')->user();
        $user->level = '1';
        $user->save();

        session()->put('email', $request->email);
        session()->put('mobile', $request->mobile);
        session()->put('form_type', 1);
        SmsMail::dispatch([
            "otp" => $otp,
            "email" => $request->email,
            "mobile" => $request->mobile
        ], 1);

        return response()->json(['error' => false, 'msg' => 'OTP Sent Successfully./ओटीपी सफलतापूर्वक अग्रेषित कर दिया गया है।.', 'url'=> route('facility_booking_otp')]);

        }
        $countries = DB::table("countries")->orderBy('name')->get();

        $Code1 = rand(11, 99);
        $Code2 = rand(11, 99);
        $capchaCode = $Code1 + $Code2;
        session()->put('capchaCode', $capchaCode);

       return view("facility_booking.register", compact("countries",'Code1','Code2','capchaCode'));
      }

      public function login(Request $request){

        if($request->method()== 'POST'){


            $validation = Validator::make($request->all(),[
                'email'=>'required|email',
                'password'=>'required',
                'captcha'=>'required',

            ]);

             if ($validation->fails()){
                return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

            }
            $user = FacilityRegister::where('email', $request->email)->where('otp_verify', 0)->first();

            if($user){
                return response()->json(['error' => true, 'msg' => 'Please Register First.']);


            }

            if($request->captcha != $request->capchaCode){

                return response()->json(['error' => true, 'msg' => 'Oops! Invalid Captcha Code.']);
            }

            $credentials = $request->validate([
                'email'=>'required|email',
                'password'=>'required',

            ]);
            //dd(Auth::guard('facility_booking')->attempt($credentials));
            if (Auth::guard('facility_booking')->attempt($credentials) ) {
                FacilityRegister::where('email', $request->email)->first()->update(['last_login' => date('Y-m-d H:i:s')]);

                if(Auth::guard('facility_booking')->user()->change_password_status == 1){


             return response()->json(['error' => false, 'msg' => 'Logged In Successfully./सफलतापूर्वक लॉगिन हो गए हैं।', 'url'=> route('facility_booking_dashboard')]);
            }else{
                return response()->json(['error' => false, 'msg' => 'Logged In Successfully./सफलतापूर्वक लॉगिन हो गए हैं।', 'url'=> route('facility_booking_change_password')]);
            }
            }


            return response()->json(['error' => true, 'msg' => 'The provided credentials does not match our records']);

        }
        $Code1 = rand(11, 99);
        $Code2 = rand(11, 99);
        $capchaCode = $Code1 + $Code2;
        session()->put('capchaCode', $capchaCode);
        return view("facility_booking.login",compact('Code1','Code2','capchaCode'));
      }

      public function otp(Request $request){

        if($request->method()== 'POST'){
        $otp = $request->otp1 . $request->otp2 . $request->otp3 . $request->otp4 . $request->otp5 . $request->otp6;
        $email = session()->get('email');

        $user = FacilityRegister::where('email', $email)->where('otp', $otp)->first();

        if($user){
            $user->otp_verify = 1;
            $user->save();
            SmsMail::dispatch(["id" => $user->id], 5);
            return response()->json(['error' => false, 'msg' => 'Successfully Registered on the Portal./पोर्टल पर सफलतापूर्वक पंजीकृत हो गए हैं।.', 'url'=> route('facility_booking_login')]);

                }

        return response()->json(['error' => true, 'msg' => 'Oops! Invalid OTP  Please try again.']);
        }
        return view("facility_booking.otp");
      }


      public function forgot_password(Request $request){



        if($request->method()== 'POST'){

$user = FacilityRegister::where('email', $request->email)->first();
if($user != ""){
    // dd($reply->mobile);
   $check= SmsMail::dispatch([
        "password" => $user->decoded_password,
        "email" => $request->email,
        "mobile" => $user->mobile
    ], 18);

    return response()->json(['error' => false, 'msg' => 'Password has been sent on the registered Mobile No./Email ID./पासवर्ड पंजीकृत मोबाइल नंबर/ईमेल आईडी पर भेज दिया गया है।', 'url'=> route('facility_booking_login')]);

}


return response()->json(['error' => true, 'msg' => 'Email does not exists']);
        }

        return view("facility_booking.forgot_password");
      }

      public function change_password(Request $request){

        if($request->method()== 'POST'){

        $validation = Validator::make($request->all(),[
            'oldpassword' => 'required',
            'newpassword' => 'required|min:8',
            'confirmpassword' => 'required|min:8|same:newpassword',

        ]);

         if ($validation->fails()){
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        }

        if($request->confirmpassword != $request->newpassword){


            return response()->json(['error' => true, 'msg' => 'Oops! Confirm Password Does not Match.']);
        }
        $user = Auth::guard('facility_booking')->user();
        if( $user->decoded_password != $request->oldpassword){


            return response()->json(['error' => true, 'msg' => 'Oops! Old Password Does not Match.']);

        }

       $userUpdate = FacilityRegister::find($user->id);

        $data = [
            'decoded_password' => $request->newpassword,
            'password' =>Hash::make($request->newpassword),
            'change_password_status' => 1
        ];

        $userUpdate->update($data);

        return response()->json(['error' => false, 'msg' => 'Password Changed Successfully./पासवर्ड सफलतापूर्वक बदल दिया गया है।', 'url'=> route('facility_booking_dashboard')]);



    }




        return view("facility_booking.change_password");
      }



      public function dashboard(Request $request){
        $application=  DB::table('facility_booking_type_detail')->where('user_id', Auth::guard('facility_booking')->user()->id)->orderByDesc('id')->get();
        return view("facility_booking.dashboard", compact("application"));
      }

      public function application(Request $request){
        $districts = DB::table('cities')->where('state_id', '23')->orderBy('city')->get();
        $sports = DB::table('sport_type')->where('status', 1)->get();


        if($request->method()== 'POST'){

             $dataApplication =[
                'booking_type'=> $request->booking_type,
                'family_member_name'=> $request->family_member_name,
                'family_member_dob'=> $request->family_member_dob,
                'family_member_relation'=> $request->family_member_relation,
                'organisation_name'=> $request->organisation_name,
                'organisation_registration_no'=> $request->organisation_registration_no,
                 'address'=> $request->address,
                'state'=> $request->state,
                'city'=> $request->city,
                'pin'=> $request->pin,
                'service'=> $request->service,
                'user_id'=>Auth::guard('facility_booking')->user()->id

             ];


         if ($request->hasFile('organisation_document')){
                $organisation_document = moveFile('facility_booking/organisation_document', $request->organisation_document);

                $dataApplication['organisation_document'] = $organisation_document;
            }



           $Application_id=  DB::table('facility_booking_type_detail')->insertGetId($dataApplication);


           if($request->service == 1)   {
            $data_service = [
                'user_id'=>Auth::guard('facility_booking')->user()->id,
                'application_id'=> $Application_id,
                'service_type'=> $request->service,

                'stadium'=> $request->stadium,
                'purpose'=> $request->purpose,
                'booking_date_from'=> $request->booking_date_from,
                'booking_date_to'=> $request->booking_date_to,
                'booking_time_from'=> $request->booking_time_from,
                'booking_time_to'=> $request->booking_time_to,
               ];
           }else if($request->service == 2) {
            $data_service = [
                'user_id'=>Auth::guard('facility_booking')->user()->id,
                'application_id'=> $Application_id,
                'service_type'=> $request->service,
                'location'=> $request->location_gr,
                'stadium'=> $request->stadium_gr,
                'room_type'=> $request->room_type_gr,
                'purpose'=> $request->purpose_gr,
                'member'=> $request->member_gr,
                'booking_date_from'=> $request->booking_date_from_gr,
                'booking_date_to'=> $request->booking_date_to_gr,
                'booking_time_from'=> $request->booking_time_from_gr,
                'booking_time_to'=> $request->booking_time_to_gr,
               ];
           }else if($request->service == 3) {
            $data_service = [
                'user_id'=>Auth::guard('facility_booking')->user()->id,
                'application_id'=> $Application_id,
                'service_type'=> $request->service,
                'location'=> $request->location_spm,
                'stadium'=> $request->stadium_spm,
                'purpose'=> $request->purpose_spm,
                'booking_date_from'=> $request->booking_date_from_spm,
                'booking_date_to'=> $request->booking_date_to_spm,

               ];
           }else if($request->service == 4) {
            $data_service = [
                'user_id'=>Auth::guard('facility_booking')->user()->id,
                'application_id'=> $Application_id,
                'service_type'=> $request->service,
                'location'=> $request->location_spa,
                'stadium'=> $request->stadium_spa,
                'purpose'=> $request->purpose_spa,
                'booking_date_from'=> $request->booking_date_from_spa,
                'booking_date_to'=> $request->booking_date_to_spa,

               ];
           }else if($request->service == 5) {
            $data_service = [
                'user_id'=>Auth::guard('facility_booking')->user()->id,
                'application_id'=> $Application_id,
                'service_type'=> $request->service,
                'location'=> $request->location_s,
                'stadium'=> $request->stadium_s,
                'purpose'=> $request->purpose_s,
                'booking_date_from'=> $request->booking_date_from_s,
                'booking_date_to'=> $request->booking_date_to_s,
                'booking_time_from'=> $request->booking_time_from_s,
                'booking_time_to'=> $request->booking_time_to_s,
                'sport_id'=> $request->sport_id_s,
               ];
           }

           $facility_booking_service_detail=  DB::table('facility_booking_service_detail')->insertGetId($data_service);



           if($request->service == 1)   {

            $facility_booking_service_attachment = [
                'user_id'=>Auth::guard('facility_booking')->user()->id,
                'application_id'=> $Application_id,
                'service_type'=> $request->service,
                'applicant_signature'=>'',
            ];
            if ($request->hasFile('applicant_photo')){
                $applicant_photo = moveFile('facility_booking/applicant_photo', $request->applicant_photo);

                $facility_booking_service_attachment['applicant_photo'] = $applicant_photo;
            }


            if ($request->hasFile('applicant_aadhaar')){
                $applicant_aadhaar = moveFile('facility_booking/applicant_aadhaar', $request->applicant_aadhaar);

                $facility_booking_service_attachment['applicant_aadhaar'] = $applicant_aadhaar;
            }



            if ($request->hasFile('applicant_parent_aadhaar')){
                $applicant_parent_aadhaar = moveFile('facility_booking/applicant_parent_aadhaar', $request->applicant_parent_aadhaar);

                $facility_booking_service_attachment['applicant_parent_aadhaar'] = $applicant_parent_aadhaar;
            }

            if ($request->hasFile('applicant_parent_signature')){
                $applicant_parent_signature = moveFile('facility_booking/applicant_parent_signature', $request->applicant_parent_signature);

                $facility_booking_service_attachment['applicant_parent_signature'] = $applicant_parent_signature;
            }

            if ($request->hasFile('applicant_age_proof')){
                $applicant_age_proof = moveFile('facility_booking/applicant_age_proof', $request->applicant_age_proof);

                $facility_booking_service_attachment['applicant_age_proof'] = $applicant_age_proof;
            }


            if ($request->hasFile('mbbs_doctor_certificate')){
                $mbbs_doctor_certificate = moveFile('facility_booking/mbbs_doctor_certificate', $request->mbbs_doctor_certificate);

                $facility_booking_service_attachment['mbbs_doctor_certificate'] = $mbbs_doctor_certificate;
            }


            if ($request->hasFile('address_proof')){
                $address_proof = moveFile('facility_booking/address_proof', $request->address_proof);

                $facility_booking_service_attachment['address_proof'] = $address_proof;
            }

           }else if($request->service == 2) {


            $facility_booking_service_attachment = [
                'user_id'=>Auth::guard('facility_booking')->user()->id,
                'application_id'=> $Application_id,
                'service_type'=> $request->service,
                'applicant_parent_aadhaar'=> "",
                'applicant_parent_signature'=> "",
                'applicant_age_proof'=> "",
                'mbbs_doctor_certificate'=> "",
                'address_proof'=> "",

            ];
            if ($request->hasFile('applicant_photo_gr')){
                $applicant_photo = moveFile('facility_booking/applicant_photo', $request->applicant_photo_gr);

                $facility_booking_service_attachment['applicant_photo'] = $applicant_photo;
            }


            if ($request->hasFile('applicant_aadhaar_gr')){
                $applicant_aadhaar = moveFile('facility_booking/applicant_aadhaar', $request->applicant_aadhaar_gr);

                $facility_booking_service_attachment['applicant_aadhaar'] = $applicant_aadhaar;
            }

            if ($request->hasFile('applicant_signature_gr')){
                $applicant_signature = moveFile('facility_booking/applicant_signature', $request->applicant_signature_gr);

                $facility_booking_service_attachment['applicant_signature'] = $applicant_signature;
            }











           }else if($request->service == 3) {

            $facility_booking_service_attachment = [
                'user_id'=>Auth::guard('facility_booking')->user()->id,
                'application_id'=> $Application_id,
                'service_type'=> $request->service,
                'applicant_parent_aadhaar'=> "",
                'applicant_parent_signature'=> "",
                'applicant_age_proof'=> ""
            ];
            if ($request->hasFile('applicant_photo_spm')){
                $applicant_photo = moveFile('facility_booking/applicant_photo', $request->applicant_photo_spm);

                $facility_booking_service_attachment['applicant_photo'] = $applicant_photo;
            }


            if ($request->hasFile('applicant_aadhaar_spm')){
                $applicant_aadhaar = moveFile('facility_booking/applicant_aadhaar', $request->applicant_aadhaar_spm);

                $facility_booking_service_attachment['applicant_aadhaar'] = $applicant_aadhaar;
            }

            if ($request->hasFile('applicant_signature_spm')){
                $applicant_signature = moveFile('facility_booking/applicant_signature', $request->applicant_signature_spm);

                $facility_booking_service_attachment['applicant_signature'] = $applicant_signature;
            }




            if ($request->hasFile('mbbs_doctor_certificate_spm')){
                $mbbs_doctor_certificate = moveFile('facility_booking/mbbs_doctor_certificate', $request->mbbs_doctor_certificate_spm);

                $facility_booking_service_attachment['mbbs_doctor_certificate'] = $mbbs_doctor_certificate;
            }


            if ($request->hasFile('address_proof_spm')){
                $address_proof = moveFile('facility_booking/address_proof', $request->address_proof_spm);

                $facility_booking_service_attachment['address_proof'] = $address_proof;
            }

           }else if($request->service == 4) {

            $facility_booking_service_attachment = [
                'user_id'=>Auth::guard('facility_booking')->user()->id,
                'application_id'=> $Application_id,
                'service_type'=> $request->service,
                'applicant_parent_aadhaar'=> "",
                'applicant_parent_signature'=> "",
                'applicant_age_proof'=> "",
                'mbbs_doctor_certificate'=> "",
                'address_proof'=> "",

            ];
            if ($request->hasFile('applicant_photo_spa')){
                $applicant_photo = moveFile('facility_booking/applicant_photo', $request->applicant_photo_spa);

                $facility_booking_service_attachment['applicant_photo'] = $applicant_photo;
            }


            if ($request->hasFile('applicant_aadhaar_spa')){
                $applicant_aadhaar = moveFile('facility_booking/applicant_aadhaar', $request->applicant_aadhaar_spa);

                $facility_booking_service_attachment['applicant_aadhaar'] = $applicant_aadhaar;
            }

            if ($request->hasFile('applicant_signature_spa')){
                $applicant_signature = moveFile('facility_booking/applicant_signature', $request->applicant_signature_spa);

                $facility_booking_service_attachment['applicant_signature'] = $applicant_signature;
            }


           }else if($request->service == 5) {

            $facility_booking_service_attachment = [
                'user_id'=>Auth::guard('facility_booking')->user()->id,
                'application_id'=> $Application_id,
                'service_type'=> $request->service,
                'applicant_parent_aadhaar'=> "",
                'applicant_parent_signature'=> "",
                'applicant_age_proof'=> "",
                'mbbs_doctor_certificate'=> "",
                'address_proof'=> "",

            ];
            if ($request->hasFile('applicant_photo_s')){
                $applicant_photo = moveFile('facility_booking/applicant_photo', $request->applicant_photo_s);

                $facility_booking_service_attachment['applicant_photo'] = $applicant_photo;
            }


            if ($request->hasFile('applicant_aadhaar_s')){
                $applicant_aadhaar = moveFile('facility_booking/applicant_aadhaar', $request->applicant_aadhaar_s);

                $facility_booking_service_attachment['applicant_aadhaar'] = $applicant_aadhaar;
            }

            if ($request->hasFile('applicant_signature_s')){
                $applicant_signature = moveFile('facility_booking/applicant_signature', $request->applicant_signature_s);

                $facility_booking_service_attachment['applicant_signature'] = $applicant_signature;
            }


           }

           $facility_booking_service_attachment=  DB::table('facility_booking_service_attachment')->insertGetId($facility_booking_service_attachment);





           return response()->json(['error' => false, 'msg' => 'Application Submitted successfully.', 'url'=> route('facility_booking_application_preview', $Application_id)]);


        }





        return view("facility_booking.application_form", compact('districts','sports'));
      }




      public function application_update(Request $request, $id){
        $districts = DB::table('cities')->where('state_id', '23')->orderBy('city')->get();
        $sports = DB::table('sport_type')->where('status', 1)->get();
        if($request->method()== 'POST'){

             $dataApplication =[
                'booking_type'=> $request->booking_type,
                'family_member_name'=> $request->family_member_name,
                'family_member_dob'=> $request->family_member_dob,
                'family_member_relation'=> $request->family_member_relation,
                'organisation_name'=> $request->organisation_name,
                'organisation_registration_no'=> $request->organisation_registration_no,
                 'address'=> $request->address,
                'state'=> $request->state,
                'city'=> $request->city,
                'pin'=> $request->pin,
                'service'=> $request->service,
                'user_id'=>Auth::guard('facility_booking')->user()->id

             ];


         if ($request->hasFile('organisation_document')){
                $organisation_document = moveFile('facility_booking/organisation_document', $request->organisation_document);

                $dataApplication['organisation_document'] = $organisation_document;
            }



           $Application_id=  DB::table('facility_booking_type_detail')->where('id',$id)->update($dataApplication);
           $Application_id=  DB::table('facility_booking_type_detail')->where('id',$id)->first()->id;

           if($request->service == 1)   {
            $data_service = [
                'user_id'=>Auth::guard('facility_booking')->user()->id,
                'application_id'=> $Application_id,
                'service_type'=> $request->service,

                'stadium'=> $request->stadium,
                'purpose'=> $request->purpose,
                'booking_date_from'=> $request->booking_date_from,
                'booking_date_to'=> $request->booking_date_to,
                'booking_time_from'=> $request->booking_time_from,
                'booking_time_to'=> $request->booking_time_to,
               ];
           }else if($request->service == 2) {
            $data_service = [
                'user_id'=>Auth::guard('facility_booking')->user()->id,
                'application_id'=> $Application_id,
                'service_type'=> $request->service,
                'location'=> $request->location_gr,
                'stadium'=> $request->stadium_gr,
                'room_type'=> $request->room_type_gr,
                'purpose'=> $request->purpose_gr,
                'member'=> $request->member_gr,
                'booking_date_from'=> $request->booking_date_from_gr,
                'booking_date_to'=> $request->booking_date_to_gr,
                'booking_time_from'=> $request->booking_time_from_gr,
                'booking_time_to'=> $request->booking_time_to_gr,
               ];
           }else if($request->service == 3) {
            $data_service = [
                'user_id'=>Auth::guard('facility_booking')->user()->id,
                'application_id'=> $Application_id,
                'service_type'=> $request->service,
                'location'=> $request->location_spm,
                'stadium'=> $request->stadium_spm,
                'purpose'=> $request->purpose_spm,
                'booking_date_from'=> $request->booking_date_from_spm,
                'booking_date_to'=> $request->booking_date_to_spm,

               ];
           }else if($request->service == 4) {
            $data_service = [
                'user_id'=>Auth::guard('facility_booking')->user()->id,
                'application_id'=> $Application_id,
                'service_type'=> $request->service,
                'location'=> $request->location_spa,
                'stadium'=> $request->stadium_spa,
                'purpose'=> $request->purpose_spa,
                'booking_date_from'=> $request->booking_date_from_spa,
                'booking_date_to'=> $request->booking_date_to_spa,

               ];
           }else if($request->service == 5) {
            $data_service = [
                'user_id'=>Auth::guard('facility_booking')->user()->id,
                'application_id'=> $Application_id,
                'service_type'=> $request->service,
                'location'=> $request->location_s,
                'stadium'=> $request->stadium_s,
                'purpose'=> $request->purpose_s,
                'booking_date_from'=> $request->booking_date_from_s,
                'booking_date_to'=> $request->booking_date_to_s,
                'booking_time_from'=> $request->booking_time_from_s,
                'booking_time_to'=> $request->booking_time_to_s,
                'sport_id'=> $request->sport_id_s,
               ];
           }

           $facility_booking_service_detail=  DB::table('facility_booking_service_detail')->where('application_id',$Application_id)->update($data_service);



           if($request->service == 1)   {

            $facility_booking_service_attachment = [
                'user_id'=>Auth::guard('facility_booking')->user()->id,
                'application_id'=> $Application_id,
                'service_type'=> $request->service,
                'applicant_signature'=>'',
            ];
            if ($request->hasFile('applicant_photo')){
                $applicant_photo = moveFile('facility_booking/applicant_photo', $request->applicant_photo);

                $facility_booking_service_attachment['applicant_photo'] = $applicant_photo;
            }


            if ($request->hasFile('applicant_aadhaar')){
                $applicant_aadhaar = moveFile('facility_booking/applicant_aadhaar', $request->applicant_aadhaar);

                $facility_booking_service_attachment['applicant_aadhaar'] = $applicant_aadhaar;
            }



            if ($request->hasFile('applicant_parent_aadhaar')){
                $applicant_parent_aadhaar = moveFile('facility_booking/applicant_parent_aadhaar', $request->applicant_parent_aadhaar);

                $facility_booking_service_attachment['applicant_parent_aadhaar'] = $applicant_parent_aadhaar;
            }

            if ($request->hasFile('applicant_parent_signature')){
                $applicant_parent_signature = moveFile('facility_booking/applicant_parent_signature', $request->applicant_parent_signature);

                $facility_booking_service_attachment['applicant_parent_signature'] = $applicant_parent_signature;
            }

            if ($request->hasFile('applicant_age_proof')){
                $applicant_age_proof = moveFile('facility_booking/applicant_age_proof', $request->applicant_age_proof);

                $facility_booking_service_attachment['applicant_age_proof'] = $applicant_age_proof;
            }


            if ($request->hasFile('mbbs_doctor_certificate')){
                $mbbs_doctor_certificate = moveFile('facility_booking/mbbs_doctor_certificate', $request->mbbs_doctor_certificate);

                $facility_booking_service_attachment['mbbs_doctor_certificate'] = $mbbs_doctor_certificate;
            }


            if ($request->hasFile('address_proof')){
                $address_proof = moveFile('facility_booking/address_proof', $request->address_proof);

                $facility_booking_service_attachment['address_proof'] = $address_proof;
            }

           }else if($request->service == 2) {


            $facility_booking_service_attachment = [
                'user_id'=>Auth::guard('facility_booking')->user()->id,
                'application_id'=> $Application_id,
                'service_type'=> $request->service,
                'applicant_parent_aadhaar'=> "",
                'applicant_parent_signature'=> "",
                'applicant_age_proof'=> "",
                'mbbs_doctor_certificate'=> "",
                'address_proof'=> "",

            ];
            if ($request->hasFile('applicant_photo_gr')){
                $applicant_photo = moveFile('facility_booking/applicant_photo', $request->applicant_photo_gr);

                $facility_booking_service_attachment['applicant_photo'] = $applicant_photo;
            }


            if ($request->hasFile('applicant_aadhaar_gr')){
                $applicant_aadhaar = moveFile('facility_booking/applicant_aadhaar', $request->applicant_aadhaar_gr);

                $facility_booking_service_attachment['applicant_aadhaar'] = $applicant_aadhaar;
            }

            if ($request->hasFile('applicant_signature_gr')){
                $applicant_signature = moveFile('facility_booking/applicant_signature', $request->applicant_signature_gr);

                $facility_booking_service_attachment['applicant_signature'] = $applicant_signature;
            }











           }else if($request->service == 3) {

            $facility_booking_service_attachment = [
                'user_id'=>Auth::guard('facility_booking')->user()->id,
                'application_id'=> $Application_id,
                'service_type'=> $request->service,
                'applicant_parent_aadhaar'=> "",
                'applicant_parent_signature'=> "",
                'applicant_age_proof'=> ""
            ];
            if ($request->hasFile('applicant_photo_spm')){
                $applicant_photo = moveFile('facility_booking/applicant_photo', $request->applicant_photo_spm);

                $facility_booking_service_attachment['applicant_photo'] = $applicant_photo;
            }


            if ($request->hasFile('applicant_aadhaar_spm')){
                $applicant_aadhaar = moveFile('facility_booking/applicant_aadhaar', $request->applicant_aadhaar_spm);

                $facility_booking_service_attachment['applicant_aadhaar'] = $applicant_aadhaar;
            }

            if ($request->hasFile('applicant_signature_spm')){
                $applicant_signature = moveFile('facility_booking/applicant_signature', $request->applicant_signature_spm);

                $facility_booking_service_attachment['applicant_signature'] = $applicant_signature;
            }




            if ($request->hasFile('mbbs_doctor_certificate_spm')){
                $mbbs_doctor_certificate = moveFile('facility_booking/mbbs_doctor_certificate', $request->mbbs_doctor_certificate_spm);

                $facility_booking_service_attachment['mbbs_doctor_certificate'] = $mbbs_doctor_certificate;
            }


            if ($request->hasFile('address_proof_spm')){
                $address_proof = moveFile('facility_booking/address_proof', $request->address_proof_spm);

                $facility_booking_service_attachment['address_proof'] = $address_proof;
            }

           }else if($request->service == 4) {

            $facility_booking_service_attachment = [
                'user_id'=>Auth::guard('facility_booking')->user()->id,
                'application_id'=> $Application_id,
                'service_type'=> $request->service,
                'applicant_parent_aadhaar'=> "",
                'applicant_parent_signature'=> "",
                'applicant_age_proof'=> "",
                'mbbs_doctor_certificate'=> "",
                'address_proof'=> "",

            ];
            if ($request->hasFile('applicant_photo_spa')){
                $applicant_photo = moveFile('facility_booking/applicant_photo', $request->applicant_photo_spa);

                $facility_booking_service_attachment['applicant_photo'] = $applicant_photo;
            }


            if ($request->hasFile('applicant_aadhaar_spa')){
                $applicant_aadhaar = moveFile('facility_booking/applicant_aadhaar', $request->applicant_aadhaar_spa);

                $facility_booking_service_attachment['applicant_aadhaar'] = $applicant_aadhaar;
            }

            if ($request->hasFile('applicant_signature_spa')){
                $applicant_signature = moveFile('facility_booking/applicant_signature', $request->applicant_signature_spa);

                $facility_booking_service_attachment['applicant_signature'] = $applicant_signature;
            }


           }else if($request->service == 5) {

            $facility_booking_service_attachment = [
                'user_id'=>Auth::guard('facility_booking')->user()->id,
                'application_id'=> $Application_id,
                'service_type'=> $request->service,
                'applicant_parent_aadhaar'=> "",
                'applicant_parent_signature'=> "",
                'applicant_age_proof'=> "",
                'mbbs_doctor_certificate'=> "",
                'address_proof'=> "",

            ];
            if ($request->hasFile('applicant_photo_s')){
                $applicant_photo = moveFile('facility_booking/applicant_photo', $request->applicant_photo_s);

                $facility_booking_service_attachment['applicant_photo'] = $applicant_photo;
            }


            if ($request->hasFile('applicant_aadhaar_s')){
                $applicant_aadhaar = moveFile('facility_booking/applicant_aadhaar', $request->applicant_aadhaar_s);

                $facility_booking_service_attachment['applicant_aadhaar'] = $applicant_aadhaar;
            }

            if ($request->hasFile('applicant_signature_s')){
                $applicant_signature = moveFile('facility_booking/applicant_signature', $request->applicant_signature_s);

                $facility_booking_service_attachment['applicant_signature'] = $applicant_signature;
            }


           }

           $facility_booking_service_attachment=  DB::table('facility_booking_service_attachment')->where('application_id',$Application_id)->update($facility_booking_service_attachment);





           return response()->json(['error' => false, 'msg' => 'Application Submitted successfully.', 'url'=> route('facility_booking_application_preview',$Application_id)]);


        }

        $application=  DB::table('facility_booking_type_detail')->where('id', $id)->first();

        $service_detail=  DB::table('facility_booking_service_detail')->where('application_id', $application->id)->first();



        $attachment=  DB::table('facility_booking_service_attachment')->where('application_id', $application->id)->first();




        return view("facility_booking.application_form_update", compact('districts','attachment','application','service_detail','sports'));
      }


      public function application_preview(Request $request, $id){
        $application=  DB::table('facility_booking_type_detail')->where('id', $id)->first();

        $service_detail=  DB::table('facility_booking_service_detail')->where('application_id', $application->id)->first();



        $attachment=  DB::table('facility_booking_service_attachment')->where('application_id', $application->id)->first();


        return view("facility_booking.application_preview" ,compact('attachment','application','service_detail'));
      }

      public function stadium_booking(Request $request){

        return view("facility_booking.stadium_booking");
      }


      public function stadium_booking_preview(Request $request){

        return view("facility_booking.stadium_booking_preview");
      }


      public function payment(Request $request){

        return view("facility_booking.payment");
      }



      public function logout(){
        Auth::guard('facility_booking')->logout();
        return Redirect()->route('facility_booking_login')->with('success', 'User Logout successfully.');
    }


    public function final_submit($id){


        if(  DB::table('facility_booking_type_detail')->where('id',$id)->where('query_status', 1)->first() ){

        DB::table('facility_booking_type_detail')->where('id',$id)->update([
            'query_status'=> 2
       ]);
        return response()->json(['error' => false, 'msg' => 'Application Re-Submitted successfully.', 'url'=> route('facility_booking_application_preview'
        ,$id)]);

    }else{
        DB::table('facility_booking_type_detail')->where('id',$id)->update([
            'final_submit'=> 1,
            'final_submit_date'=>date('Y-m-d H:i:s'),
            'application_no'=> date('Y').sprintf("%08d", $id)
        ]);
        return response()->json(['error' => false, 'msg' => 'Application final Submitted successfully.', 'url'=> route('facility_booking_application_preview'
        ,$id)]);

    }

    }



    public function resendotp(){
        $otp = rand(111111, 999999);

        FacilityRegister::where('email', session()->get('email'))->update(
            ["otp" => $otp]
        );

        SmsMail::dispatch([
            "otp" => $otp,
            "email" => session()->get('email'),
            "mobile" => session()->get('mobile')
        ], 1);
        return response()->json(['error' => false, 'msg' => 'Otp Resend Successfully']);

    }










    // admin


    public function admin_dashboard($type){

        $check = DB::table('hostel_div_district_mapping')
        ->select(DB::raw('group_concat(district_id) as district_id'))->where( 'division_id', Auth::guard('admin')->user()->division_id)->get();
        $application=  DB::table('facility_booking_register')->leftJoin('facility_booking_type_detail','facility_booking_type_detail.user_id','=','facility_booking_register.id')
        ->leftJoin('facility_booking_service_detail','facility_booking_service_detail.application_id','=','facility_booking_type_detail.id')->select('facility_booking_type_detail.id as id_application','facility_booking_type_detail.*','facility_booking_register.*')->where('service', $type)->where('facility_booking_type_detail.final_submit',1);


         if(Auth::guard('admin')->user()->division_id){

            $application->whereIn( 'facility_booking_service_detail.location',explode(',',$check[0]->district_id));
        }
        if(Auth::guard('admin')->user()->district_id){

            $application->where( 'facility_booking_service_detail.location',explode(',',Auth::guard('admin')->user()->district_id));
        }


        $application=   $application->orderByDesc('facility_booking_type_detail.final_submit_date')->get();

      return   view('facility_booking.admin_dashbboard',compact('application'));


    }


    public function admin_application_preview($id){

        $application=  DB::table('facility_booking_type_detail')->where('id', $id)->first();
        $user = DB::table('facility_booking_register')->where('id', $application->user_id)->first();

        $service_detail=  DB::table('facility_booking_service_detail')->where('application_id', $application->id)->first();



        $attachment=  DB::table('facility_booking_service_attachment')->where('application_id', $application->id)->first();


        return view("facility_booking.admin_application_preview" ,compact('attachment','application','service_detail','user'));


    }
    public function accepted_reject_status(Request $request){

        if($request->status == 1){
            if ($request->hasFile('upload_file_accept')){
                $upload_file_accept = moveFile('facility_booking/upload_file_accept', $request->upload_file_accept);


            }else{
                $upload_file_accept = '';
            }


          DB::table('facility_booking_type_detail')->where('id', $request->application_id)->update([
            'status'=> 1,
          'accept_reject_date'=> date('Y-m-d'),
          'remark'=> $request->remark,
          'amount_to_be_paid'=> $request->amount_to_be_paid,
           'fee_exemption_status'=> $request->fee_exemption_status,
          'upload_file_accept'=> $upload_file_accept
        ]);
        return response()->json(['error' => false, 'msg' => 'Application Accepted Successfully', 'url'=> route('admin_facility_booking_preview'
        ,$request->application_id)]);
        }else{
            DB::table('facility_booking_type_detail')->where('id', $request->application_id)->update(['status'=> 2,
            'accept_reject_date'=> date('Y-m-d'),
        'remark'=> $request->remark]);


        return response()->json(['error' => false, 'msg' => 'Application Rejected Successfully', 'url'=> route('admin_facility_booking_preview'
        ,$request->application_id)]);
        }

    }



    public function application_pdf(Request $request,$type){
       if($type == 1){
     $namee ="Swimming Pool (Mini)";
       } elseif ($type == 2){
        $namee ="Guest Room";
   }
   elseif ($type == 3){
    $namee = "Swimming Pool (Adult)";
   }
   elseif ($type == 4){
    $namee = "Gymnasium";
   }
   elseif ($type == 5){
    $namee = "Stadium";
   };



        $application=  DB::table('facility_booking_register')->leftJoin('facility_booking_type_detail','facility_booking_type_detail.user_id','=','facility_booking_register.id')->select('facility_booking_type_detail.id as id_application','facility_booking_type_detail.*','facility_booking_register.*')->where('service', $type)->where('facility_booking_type_detail.final_submit',1)->orderByDesc('facility_booking_type_detail.final_submit_date')->get();



        $pdf = PDF::loadView('facility_booking.admin_application_pdf',compact('application'))->setPaper('a4', 'landscape');
        $pdf->output();
        $domPdf = $pdf->getDomPDF();
        $canvas = $domPdf->get_canvas();
        $rightMargin = 90;
        $pageWidth = $canvas->get_width();
        $pageNumberX = $pageWidth - $rightMargin;

        $canvas->page_text($pageNumberX, $canvas->get_height() - 20, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, [0, 0, 0]);
        $canvas->page_text(320, $canvas->get_height() - 20, "*This is a Software Generated Report*", null, 10, [0, 0, 0]);

        return $pdf->download($namee.'.pdf');
    }




    public function stadium(Request $request){


        return  DB::table('studium_master')->where('district_id', $request->location)->orderBy("studium_name")->get();
    }



    public function query_mark(Request $request){

        $data=[

            'query_status'=> 1,
            'query'=> $request->query_text,
            'marked_on'=> date('Y-m-d')


        ];
        if ($request->hasFile('query_upload')){
            $query_upload = moveFile('facility_booking/query_upload', $request->query_upload);
            $data['query_upload']= $query_upload;


        };

          DB::table('facility_booking_type_detail')->where('id', $request->application_id)->update($data);

      return response()->json(['error' => false, 'msg' => 'Query Marked Successfully', 'url'=> route('admin_facility_booking_preview'
    ,$request->application_id)]);
    }


    public function payment_receipt($application_no){
        $namee = "Payment Receipt";



         $application=  DB::table('facility_booking_register')->leftJoin('facility_booking_type_detail','facility_booking_type_detail.user_id','=','facility_booking_register.id')->leftJoin('facility_booking_service_detail','facility_booking_service_detail.application_id','=','facility_booking_type_detail.id')->join('rajkosh_payment_request','rajkosh_payment_request.application_no','=','facility_booking_type_detail.application_no')->join('rajkosh_payment_response','rajkosh_payment_request.Depchallan','=','rajkosh_payment_response.challan_no')->select('facility_booking_type_detail.id as id_application','facility_booking_type_detail.*','facility_booking_register.*','rajkosh_payment_request.*','rajkosh_payment_response.*','facility_booking_service_detail.*')->where('rajkosh_payment_request.module','2')->where('rajkosh_payment_response.Status','Success')->where('facility_booking_type_detail.application_no',$application_no)->first();


         $pdf = PDF::loadView('facility_booking.PaymentReceipt',compact('application'))->setPaper('a4', 'landscape');
         $pdf->output();
         $domPdf = $pdf->getDomPDF();
         $canvas = $domPdf->get_canvas();
         $rightMargin = 90;
         $pageWidth = $canvas->get_width();
         $pageNumberX = $pageWidth - $rightMargin;

         $canvas->page_text($pageNumberX, $canvas->get_height() - 20, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, [0, 0, 0]);
         $canvas->page_text(320, $canvas->get_height() - 20, "*This is a Software Generated Report*", null, 10, [0, 0, 0]);

         return $pdf->download($namee.'.pdf');
    }

}
