<?php

namespace App\Http\Controllers;
use App\Events\SmsMail;
use Illuminate\Http\Request;
use App\Models\EklavyaFund;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class EklavyaFundController extends Controller
{
    public function eklavyaFund(Request $req){
        if($req->method() == "POST"){
            $validation = Validator::make($req->all(), [
                'email' => 'required',
                'password' => 'required',
                'captcha' => 'required',
            ], msg());
    
            if ($validation->fails())
                return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
    
            if ($req->captcha != $req->captchacode)
                return response()->json(['error' => true, 'msg' => "Please Enter Valid Captcha./कृपया सही कैप्चा भरें।"]);
                
                
                $credentials = $req->validate([
                    'email' => 'required|email',
                    'password' => 'required',
     
                ]);
                if (Auth::guard('EklavyaFund')->attempt($credentials)) {
                    DB::table('eklavya_fund_registration')->where('email', $req->email)->update(['last_login' => date('Y-m-d H:i:s')]);
                        if (Auth::guard('EklavyaFund')->user()->change_password_status == 0) {
                            return response()->json(["error" => false, "msg" => "Logged In Successfully./सफलतापूर्वक लॉगिन हो गए हैं।", "url" => route('eklavyaFund_change_password')]);
                        } else {
                           return response()->json(["error" => false, "msg" => "Logged In Successfully./सफलतापूर्वक लॉगिन हो गए हैं।", "url" => route('eklavyaFund_dashboard')]);
                        }
                   }
                   return response()->json(["error" => true, "msg" => "The provided credentials does not match our records"]);
        
        }else{
            $Code1 = rand(11, 99);
            $Code2 = rand(11, 99);
            $capchaCode = $Code1 +  $Code2;
            session()->put('capchaCode', $capchaCode);
             return view('eklavya_fund.login', compact('capchaCode','Code1','Code2'));
        }
       
    }
    public function registration(Request $req){
        
        if($req->method() == "POST"){
            
            $validation = Validator::make($req->all(), [
                'academy_name' => 'required',
                'sport_name' => 'required',
                'mobile' => 'required',
                'email' => 'required',
                'native_of_up' => 'required',
                'pan' => 'required',
                'captcha' => 'required',
            ], msg());

            if ($validation->fails())
                return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

                // dd($req->all());
            if ($req->captchacode != $req->captcha)
                return response()->json(['error' => true, 'msg' => "Oops! Invalid Captcha Code."]);

                 // if (DB::table('sport_welfare_registration_master')->where('email', $req->email)->where('role', $req->role)->exists())
            if (DB::table('eklavya_fund_registration')->where('email', $req->email)->where('otp_verify', 1)->exists())
                return response()->json(['error' => true, 'msg' => "Entered Email ID is already registered on the portal./भरी गयी ईमेल आईडी पोर्टल पर पहले से पंजीकृत है।   ", "url" => route('signUp')]);

            // if (DB::table('sport_welfare_registration_master')->where('mobile', $req->mobile)->where('role', $req->role)->exists())
            if (DB::table('eklavya_fund_registration')->where('mobile', $req->mobile)->where('otp_verify', 1)->exists())
                return response()->json(['error' => true, 'msg' => "Entered Mobile No. is already registered on the portal./भरा गया मोबाइल नंबर पोर्टल पर पहले से पंजीकृत है।", "url" => route('signUp')]);

                 $otp = rand(111111, 999999);
               // $otp = 123456;
                  $pwd = rand(11111111,99999999);
                $data = [
                    'academy_name' => $req->academy_name,
                    'sport_id' => $req->sport_name,
                    'mobile' => $req->mobile,
                    'email' => $req->email,
                    'native_of_up' => $req->native_of_up,
                    'pan' =>$req->pan,
                    'password' => Hash::make($pwd),
                    'decoded_password' => $pwd,
                    'otp' => $otp,
                ];
                if (DB::table('eklavya_fund_registration')->where('email', $req->email)->exists()){
                    DB::table('eklavya_fund_registration')->where('email', $req->email)->update($data);
                }else{
                    $id = DB::table('eklavya_fund_registration')->insertGetId($data);
                }
                session()->put('mobile', $req->mobile);
                session()->put('email', $req->email);

                SmsMail::dispatch([
                    "otp" => $otp,
                    "email" => $req->email,
                    "mobile" => $req->mobile
                    
                ], 1);
           return response()->json(["error" => false, "msg" => "SuccessFully Registered", "url" => url('eklavyaFund/otp')]);

        }else{
            $Code1 = rand(11, 99);
            $Code2 = rand(11, 99);
            $capchaCode = $Code1 +  $Code2;
            session()->put('capchaCode', $capchaCode);
            $sports = DB::table('sport_type')->where('status',1)->orderBy('name', 'ASC')->get();
            return view('eklavya_fund.registration',compact('capchaCode','Code1','Code2','sports'));
        }
       
    }
    public function otp(Request $req){

        if($req->method() == "POST"){
            $validation = Validator::make($req->all(), [
                'otp1' => 'required',
                'otp2' => 'required',
                'otp3' => 'required',
                'otp4' => 'required',
                'otp5' => 'required',
                'otp6' => 'required',
            ], msg());
    
            if ($validation->fails())
                return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

            $otp = $req->otp1 . $req->otp2 . $req->otp3 . $req->otp4 . $req->otp5 . $req->otp6;
            $mobile = session()->get('mobile');
            $table = DB::table('eklavya_fund_registration')->where('mobile', $mobile)->where('otp', $otp)->orderBy('id', 'DESC')->limit(1);
            if ($table->exists()) {
                $reg_id = $table->first();
                $id = DB::table('eklavya_fund_registration')->where('mobile', $mobile)->update(['otp_verify'=>1]);
                // SmsMail::dispatch(["id" => $reg_id], 24);
                SmsMail::dispatch([
                    "id" => $reg_id,
                    "email" => session()->get('email'),
                    "mobile" => session()->get('mobile')
                ], 24);
                session()->put('mobile', 000);
                return response()->json(["error" => false, "msg" => "Thank You. You Are SuccessFully Registered./आप सफलतापूर्वक पंजीकृत हो गए हैं।", "url" => url('eklavyaFund')]);
            }else{
                return response()->json(["error" => true, "msg" => "Entered OTP is invalid. Please Enter Valid OTP./भरा गया ओटीपी अमान्य है। कृपया सही ओटीपी भरें।"]);
            }    
        }
        else{
            return view('eklavya_fund.otp');
        }
    }
    public function dashboard(){
        if(Auth::guard('EklavyaFund')->user()->change_password_status == 0){
            return redirect('eklavyaFund/change_password');
        }
        if(DB::table('eklavya_fund_application_form')->where('user_id',Auth::guard('EklavyaFund')->id())->doesntExist()){
            return redirect('eklavyaFund/application_form');
        }
        $fund_data=DB::table('eklavya_fund_application_form')->where('user_id',Auth::guard('EklavyaFund')->id())->get();
        return view('eklavya_fund.dashboard',compact('fund_data'));
    }
    public function application_form(Request $req,$id=""){
        if($req->method() == "POST"){
            $validation = Validator::make($req->all(), [
                'registration_certificate_doc'=> 'nullable|mimes:pdf,jpg,jpeg|max:2048',
                'notarized_affidavit_180_doc'=> 'nullable|mimes:pdf,jpg,jpeg|max:2048',
                'constitution_charter_doc'=> 'nullable|mimes:pdf,png,jpg,jpeg|max:2048',
                'accreditation_letter_doc'=> 'nullable|mimes:pdf,jpg,jpeg|max:2048',
                'premises_operated_doc'=> 'nullable|mimes:pdf,jpg,jpeg|max:2048',
                'notarized_affidavit_doc'=> 'nullable|mimes:pdf,jpg,jpeg|max:2048',
                'appropriate_approved_funds_doc'=> 'nullable|mimes:pdf,jpg,jpeg|max:2048',
                'report_training_provided_doc'=> 'nullable|mimes:pdf,jpg,jpeg|max:2048',
                'audit_report_accounts_doc'=> 'nullable|mimes:pdf,jpg,jpeg|max:2048',
                'recommendation_of_district_doc'=> 'nullable|mimes:pdf,jpg,jpeg|max:2048',
                'recommendation_of_state_sports_doc'=> 'nullable|mimes:pdf,jpg,jpeg|max:2048',

                'correspondence_address'=> 'required',
                'state'=> 'required',
                'district'=> 'required',
                'pincode'=> 'required',
                'affiliation'=> 'required',
                'email_sports_club'=> 'required',
                'ground_description'=> 'required',
                'financial_aid_details'=> 'required',
                'bank_ifsc'=> 'required',
                'bank_name'=> 'required',
                'acc_no'=> 'required',
                'office_name.*'=> 'required',
                'office_mobile.*'=> 'required',
                'office_address.*'=> 'required',
                'player_name.*'=> 'required',
                'player_mobile.*'=> 'required',
                'player_aadhar.*'=> 'required'
             ], msg());

             if ($validation->fails())
             return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
        
            // dd($req->all());
            DB::beginTransaction();
            $data = [
                'user_id'=> Auth::guard('EklavyaFund')->id(),
                'correspondence_address'=> $req->correspondence_address,
                'state'=> $req->state,
                'district'=> $req->district,
                'pincode'=> $req->pincode,
                'affiliation'=> $req->affiliation,
                'email_sports_club'=> $req->email_sports_club,
                'ground_description'=> $req->ground_description,
                'financial_aid_details'=> $req->financial_aid_details,
                'bank_ifsc'=> $req->bank_ifsc,
                'bank_name'=> $req->bank_name,
                'acc_no'=> $req->acc_no,
            ];

            if ($req->hasFile('registration_certificate_doc')){
                $registration_certificate_doc = moveFile('eklavya_fund/registration_certificate_doc', $req->registration_certificate_doc);
                $data['registration_certificate_doc']= $registration_certificate_doc;
            }
            if ($req->hasFile('notarized_affidavit_180_doc')){
                $notarized_affidavit_180_doc = moveFile('eklavya_fund/notarized_affidavit_180_doc', $req->notarized_affidavit_180_doc);
                $data['notarized_affidavit_180_doc']= $notarized_affidavit_180_doc;
            }
            if ($req->hasFile('accreditation_certificate_doc')){
                $accreditation_certificate_doc = moveFile('eklavya_fund/accreditation_certificate_doc', $req->accreditation_certificate_doc);
                $data['accreditation_certificate_doc']= $accreditation_certificate_doc;
            }
            
            if ($req->hasFile('constitution_charter_doc')){
                $constitution_charter_doc = moveFile('eklavya_fund/constitution_charter_doc', $req->constitution_charter_doc);
                $data['constitution_charter_doc']= $constitution_charter_doc;
            }
            if ($req->hasFile('accreditation_letter_doc')){
                $accreditation_letter_doc = moveFile('eklavya_fund/accreditation_letter_doc', $req->accreditation_letter_doc);
                $data['accreditation_letter_doc']= $accreditation_letter_doc;
            }
            if ($req->hasFile('premises_operated_doc')){
                $premises_operated_doc = moveFile('eklavya_fund/premises_operated_doc', $req->premises_operated_doc);
                $data['premises_operated_doc']= $premises_operated_doc;
            }
            if ($req->hasFile('notarized_affidavit_doc')){
                $notarized_affidavit_doc = moveFile('eklavya_fund/notarized_affidavit_doc', $req->notarized_affidavit_doc);
                $data['notarized_affidavit_doc']= $notarized_affidavit_doc;
            }
            if ($req->hasFile('appropriate_approved_funds_doc')){
                $appropriate_approved_funds_doc = moveFile('eklavya_fund/appropriate_approved_funds_doc', $req->appropriate_approved_funds_doc);
                $data['appropriate_approved_funds_doc']= $appropriate_approved_funds_doc;
            }
            if ($req->hasFile('report_training_provided_doc')){
                $report_training_provided_doc = moveFile('eklavya_fund/report_training_provided_doc', $req->report_training_provided_doc);
                $data['report_training_provided_doc']= $report_training_provided_doc;
            }
            if ($req->hasFile('audit_report_accounts_doc')){
                $audit_report_accounts_doc = moveFile('eklavya_fund/audit_report_accounts_doc', $req->audit_report_accounts_doc);
                $data['audit_report_accounts_doc']= $audit_report_accounts_doc;
            }
            if ($req->hasFile('recommendation_of_district_doc')){
                $recommendation_of_district_doc = moveFile('eklavya_fund/recommendation_of_district_doc', $req->recommendation_of_district_doc);
                $data['recommendation_of_district_doc']= $recommendation_of_district_doc;
            }
            if ($req->hasFile('recommendation_of_state_sports_doc')){
                $recommendation_of_state_sports_doc = moveFile('eklavya_fund/recommendation_of_state_sports_doc', $req->recommendation_of_state_sports_doc);
                $data['recommendation_of_state_sports_doc']= $recommendation_of_state_sports_doc;
            }
            if($req->id){
                $id=$req->id;
                DB::table('eklavya_fund_application_form')->where('id', $id)->update($data);
                $msg="Form Updated Successfully";
        
            }else{
                $id=DB::table('eklavya_fund_application_form')->insertGetId($data);
                $msg="Form Submitted Successfully";
            }

            DB::table('eklavya_fund_player_details')->where('fund_form_id', $id)->delete();
            foreach ($req->player_name as $key => $item) {
                $ch = DB::table('eklavya_fund_player_details')->insertGetId(array(
                    'fund_form_id' => $id,
                    'player_name' => $req->player_name[$key],
                    'player_mobile' => $req->player_mobile[$key],
                    'player_aadhar' => $req->player_aadhar[$key],
                ));
            };

            DB::table('eklavya_fund_officer_details')->where('fund_form_id', $id)->delete();
            foreach ($req->office_name as $key => $item) {
                $ch = DB::table('eklavya_fund_officer_details')->insertGetId(array(
                    'fund_form_id' => $id,
                    'office_name' => $req->office_name[$key],
                    'office_mobile' => $req->office_mobile[$key],
                    'office_address' => $req->office_address[$key],
                ));
            };
            DB::commit(); 
            
            return response()->json(['error' => false, 'msg' => $msg,"url" => url('eklavyaFund/application_preview/'.$id) ]);
            

        }else{
            $state=DB::table('states')->where('id',23)->orderBy('name','ASC')->get();
            $city=DB::table('cities')->orderBy('city','ASC')->get();
            $fund_data="";$player_data=$officer_data=[];
            if($req->id){
                $fund_data=DB::table('eklavya_fund_application_form')->where('id',$req->id)->first();
                $player_data=DB::table('eklavya_fund_player_details')->where('fund_form_id',$req->id)->get();
                $officer_data=DB::table('eklavya_fund_officer_details')->where('fund_form_id',$req->id)->get();
            }
            // dd($officer_data);
            return view('eklavya_fund.application_form',compact('state','city','fund_data','player_data','officer_data'));
        }
    }
    public function application_preview(Request $req,$id){
        if($req->method() == "POST"){
            $data=[
                'application_no' => date('ymdhis') . rand(11111, 99999),
                'final_submit' => 1,
                'final_submit_at' => date('Y-m-d H:i:s')
            ];
            DB::table('eklavya_fund_application_form')->where('id', $id)->update($data);
            return response()->json(['error' => false, 'msg' => 'Final Submitted Successfully',"url" => url('eklavyaFund/dashboard') ]);
        }else{
            $fund_data=DB::table('eklavya_fund_application_form')->where('id',$id)->first();
            $player_data=DB::table('eklavya_fund_player_details')->where('fund_form_id',$id)->get();
            $officer_data=DB::table('eklavya_fund_officer_details')->where('fund_form_id',$id)->get();
            return view('eklavya_fund.application_preview',compact('fund_data','player_data','officer_data'));
        }
    }
    public function change_password(Request $req){
        if($req->method() == "POST"){
            $validation = Validator::make($req->all(), [
                'old_password' => 'required',
                'password' => 'required|min:8|different:old_password',
                'password_confirmation' => 'required|min:8|same:password',
            ]);
            if ($validation->fails())
                return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

            $data = [
                'decoded_password' => $req->password,
                'password' => Hash::make($req->password),
                'change_password_status' => 1
            ];
            $user = Auth::guard('EklavyaFund')->user();
            $userUpdate = EklavyaFund::find($user->id);
            $userUpdate->update($data);
            Auth::guard('EklavyaFund')->logout();
            return response()->json(['error' => false, 'msg' => 'Password Changed Successfully./पासवर्ड सफलतापूर्वक बदल दिया गया है।', 'url'=> route('eklavyaFund')]);
 

        }
        return view('eklavya_fund.change_password');
    }
    public function logout()
    {
        Auth::guard('EklavyaFund')->logout();
        return Redirect('eklavyaFund')->with('success', 'Logout successfully.');
    }
}
