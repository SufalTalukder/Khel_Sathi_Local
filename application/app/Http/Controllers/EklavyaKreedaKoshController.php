<?php

namespace App\Http\Controllers;
use App\Events\SmsMail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EklavyaKreedaKosh;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\GymnasiumSwimming;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class EklavyaKreedaKoshController extends Controller
{
//      public function register(){
//         $Code1 = rand(11, 99);
//         $Code2 = rand(11, 99);
//         $capchaCode = $Code1 +  $Code2;
//         session()->put('capchaCode', $capchaCode);
//            return view('eklavya_kreeda_kosh.register',  compact('capchaCode','Code1','Code2'));

//      }


//      public function cp_refresh()
//      {


//          $Code1 = rand(11, 99);
//          $Code2 = rand(11, 99);
//          $capchaCode = $Code1 +  $Code2;
//          session()->put('capchaCode', $capchaCode);
//          $data['capchaCode']=$capchaCode;
//          $data['Code1']=$Code1;
//          $data['Code2']=$Code2;
//          return response()->json($data);
//      }


//      public function registrationStore(Request $request)
//      {
//          $checkEmail_for_registered = DB::table('eklavya_krida_kosh_registration')->where('email', $request->email)->first();
//          if ($checkEmail_for_registered && $checkEmail_for_registered->otp_verify == 0) {
//           $validation = Validator::make($request->all(), [
//               'name' => 'required|max:100',


//               'email' => 'required|email',
//               'captchacode' => 'required',
//               'captcha' => 'required',
//               'mobile' => 'required|numeric|digits:10',
//           ]);
//           if ($validation->fails())
//           return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
//           $otp = 123456;
//              session()->put('email', $request->email);
//              session()->put('mobile', $request->mobile);
//              session()->put('form_type', 1);
//              SmsMail::dispatch([
//                  "otp" => $otp,
//                  "email" => $request->email,
//                  "mobile" => $request->mobile
//              ], 1);
//              $data = [
//                  'name' => $request->name,

//                  'email' => $request->email,
//                  'mobile' => $request->mobile,
//                  'otp' => $otp,

//              ];
//              DB::table('eklavya_krida_kosh_registration')->where('id', $checkEmail_for_registered->id)->update($data);

//              return response()->json(["error" => false, "msg" => "OTP Sent Successfully./ओटीपी सफलतापूर्वक अग्रेषित कर दिया गया है।",  "url" => route('eklavya_kreeda_kosh_otp')]);

//         }elseif($checkEmail_for_registered){

//           return response()->json(["error" => true, "msg" => "Already register with this email Id."]);
//           }
//           $validation = Validator::make($request->all(), [
//              'name' => 'required|max:100',
//              'email' => 'required|email',
//              'captchacode' => 'required',
//              'captcha' => 'required',
//              'mobile' => 'required|numeric|digits:10',
//          ]);

//          if ($validation->fails())
//          return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

//          if ($request->captcha != $request->captchacode) {
//           return response()->json(["error" => true, "msg" => "Oops! Invalid Captcha Code."]);

//          }

//           $otp = 123456;
//          $randomPassword = 12345678;
//          $data = [
//              'name' => $request->name,
//              'email' => $request->email,
//              'mobile' => $request->mobile,
//              'otp' => $otp,
//              'decoded_password' => $randomPassword,
//              'password' => Hash::make($randomPassword),
//              'status_preview' => 1,
//          ];

//          $user = EklavyaKreedaKosh::where('email', $request->email)->where('otp_verify', 0)->first();
//          if ($user) {
//              $user->update($data);
//              session()->put('email', $request->email);
//              session()->put('mobile', $request->mobile);
//              session()->put('form_type', 1);
//              SmsMail::dispatch([
//                  "otp" => $otp,
//                  "email" => $request->email,
//                  "mobile" => $request->mobile
//              ], 1);

//              return response()->json(["error" => false, "msg" => "OTP Sent Successfully./ओटीपी सफलतापूर्वक अग्रेषित कर दिया गया है।", "url" => route('eklavya_kreeda_kosh_otp')]);

//           }

//          $user = EklavyaKreedaKosh::where('email', $request->email)->first();
//          if ($user) {
//           return response()->json(["error" => true, "msg" => "Already Registered with this Email."]);

//          }

//          $registerUser = EklavyaKreedaKosh::create($data);

//          session()->put('email', $request->email);
//          session()->put('mobile', $request->mobile);
//          session()->put('form_type', 1);
//          SmsMail::dispatch([
//              "otp" => $otp,
//              "email" => $request->email,
//              "mobile" => $request->mobile
//          ], 1);
//          return response()->json(["error" => false, "msg" => "OTP Sent Successfully./ओटीपी सफलतापूर्वक अग्रेषित कर दिया गया है।", "url" => route('eklavya_kreeda_kosh_otp')]);

//      }


//   public function otp(){
//     return view('eklavya_kreeda_kosh.otp');
//   }


//   public function otpStore(Request $req)
//   {
//       $otp = $req->otp1 . $req->otp2 . $req->otp3 . $req->otp4 . $req->otp5 . $req->otp6;
//       $email = session()->get('email');

//       $user = EklavyaKreedaKosh::where('email', $email)->where('otp', $otp)->first();


//       if ($user) {
//           $user->otp_verify = 1;
//           $user->save();
//           SmsMail::dispatch(["id" => $user->id],  17);
//           return response()->json(["error" => false, "msg" => "Successfully Registered on the Portal./पोर्टल पर सफलतापूर्वक पंजीकृत हो गए हैं।", "url" => route('eklavya_kreeda_kosh_login')]);


//       }
//     return response()->json(["error" => true, "msg" => "Oops! Invalid OTP  Please try again ."]);


//   }


//   public function login()
//   {
//    $Code1 = rand(11, 99);
//    $Code2 = rand(11, 99);
//    $capchaCode = $Code1 +  $Code2;
//    session()->put('capchaCode', $capchaCode);
//     return view('eklavya_kreeda_kosh.login', compact('capchaCode','Code1','Code2'));

//   }


//   public function loginStore(Request $request)
//   {
//    $validation = Validator::make($request->all(), [
//           'email' => 'required|email',
//           'password' => 'required',
//           'captcha' => 'required',

//       ]);

//       if ($validation->fails())
//       return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
//       $user = EklavyaKreedaKosh::where('email', $request->email)->where('otp_verify', 0)->first();
//       if ($user) {
//        return response()->json(["error" => true, "msg" => "Please Register First."]);

//       }

//       if ($request->captcha != $request->captchacode) {

//           return response()->json(["error" => true, "msg" => "Oops! Invalid Captcha Code."]);
//       }

//       $credentials = $request->validate([
//           'email' => 'required|email',
//           'password' => 'required',

//       ]);
//       Auth::guard('EklavyaKreedaKosh')->attempt($credentials);
//       if (Auth::guard('EklavyaKreedaKosh')->attempt($credentials)) {
//         EklavyaKreedaKosh::where('email', $request->email)->first()->update(['last_login' => date('Y-m-d H:i:s')]);



//         if (Auth::guard('EklavyaKreedaKosh')->user()->status_preview == 2) {
//              return response()->json(["error" => false, "msg" => "Logged In Successfully./सफलतापूर्वक लॉगिन हो गए हैं।", "url" => route('eklavya_kreeda_kosh_dashboard')]);

//         }
//           if (Auth::guard('EklavyaKreedaKosh')->user()->change_password_status == 1) {
//            return response()->json(["error" => false, "msg" => "Logged In Successfully./सफलतापूर्वक लॉगिन हो गए हैं।", "url" => route('eklavya_kreeda_kosh_application')]);

//           } else {

//               return response()->json(["error" => false, "msg" => "Logged In Successfully./सफलतापूर्वक लॉगिन हो गए हैं।", "url" => route('eklavya_kreeda_kosh_changepassword')]);

//            }
//       }
//       return response()->json(["error" => true, "msg" => "The provided credentials does not match our records"]);

//   }

//   public function resend_otp()
//   {
//       $otp = 123456;

//       EklavyaKreedaKosh::where('email', session()->get('email'))->update(
//           ["otp" => $otp]
//       );

//       SmsMail::dispatch([
//           "otp" => $otp,
//           "email" => session()->get('email'),
//           "mobile" => session()->get('mobile')
//       ], 1);
//       return redirect()->back()->with("success","Otp Resend Successfully.");


//   }

//   public function forgotpassword()
//     {
//         return view('eklavya_kreeda_kosh.forgotpassword');
//     }

//   public function changepassword(){

//     return view('eklavya_kreeda_kosh.change_password');
//    }
//    public function forgotStore(Request $req)
//    {
//        $user = EklavyaKreedaKosh::where('email', $req->email)->first();
//        //dd($user);
//        if ($user != "") {
//            //dd($reply->mobile);
//            SmsMail::dispatch(["id" => $user->id],  17);
//            return redirect()->route('eklavya_kreeda_kosh_login')->with('success', "Password has been sent on the registered Mobile No./Email ID./पासवर्ड पंजीकृत मोबाइल नंबर/ईमेल आईडी पर भेज दिया गया है।");
//        }
//        return redirect()->route('eklavya_kreeda_kosh_forgotpassword')->with('error', "Email does not exists");
//    }


//    public function dashboard(){
//     if (Auth::guard('EklavyaKreedaKosh')->user()->change_password_status != 1) {
//         return redirect()->route('eklavya_kreeda_kosh_changepassword');
//     }
//     if(Auth::guard('EklavyaKreedaKosh')->user()->status_preview == 1){

//            return redirect()->route('eklavya_kreeda_kosh_application');
//     }
//     $applicationview = DB::table('eklavya_krida_kosh_basic_detail')->where('user_id', Auth::id())->first();

//     return view('eklavya_kreeda_kosh.dashboard', compact('applicationview'));
//    }



//    public function changepasswordStore(Request $request)
//    {
//     $validation = Validator::make($request->all(), [
//            'old_password' => 'required',
//            'new_password' => 'required|min:8|different:old_password',
//            'confirm_password' => 'required|min:8|same:new_password',
//        ]);
//        if ($validation->fails())
//        return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

//        $user = Auth::guard('EklavyaKreedaKosh')->user();
//        if ($user->decoded_password != $request->old_password) {
//         return response()->json(['error' => true, 'msg' => 'Old Password Does Not Match Our Record.']);
//        }

//        $userUpdate = EklavyaKreedaKosh::find($user->id);



//        $data = [
//            'decoded_password' => $request->new_password,
//            'password' => Hash::make($request->new_password),
//            'change_password_status' => 1
//        ];

//        $userUpdate->update($data);
//        Auth::guard('EklavyaKreedaKosh')->logout();
//        return response()->json(['error' => false, 'msg' => 'Password Changed Successfully./पासवर्ड सफलतापूर्वक बदल दिया गया है।', 'url'=> route('eklavya_kreeda_kosh_login')]);

//    }
//    public function logout()
//    {
//        Auth::guard('EklavyaKreedaKosh')->logout();
//        return Redirect()->route('eklavya_kreeda_kosh_login')->with('success', 'User Logout successfully.');
//    }


   public function application(){




    // if (Auth::guard('EklavyaKreedaKosh')->user()->change_password_status != 1) {
    //     return redirect()->route('eklavya_kreeda_kosh_changepassword');
    // }



     $summary =DB::table('eklavya_krida_kosh_basic_detail')->where('user_id',  Auth::id())->first();

    $districts = DB::table('cities')->select('city', 'id')->where('state_id', '23')->orderBy('city')->get();
    $states = DB::table('states')->select('name', 'id')->where('country_id', '105')->orderBy('name')->get();
    $districtall = DB::table('cities')->select('city', 'id')->orderBy('city')->get();
    return view('eklavya_kreeda_kosh.application',  compact('summary','districts', 'states', 'districtall'));
   }

   public function applicant_applicationbasicForm(Request $request){

    $validation = Validator::make($request->all(), [
        'profile_picture'=> 'nullable|mimes:jpg,jpeg|max:2048',
        'signature'=> 'nullable|mimes:jpg,jpeg|max:2048',
        'high_school_certificate'=> 'nullable|mimes:pdf,png,jpg,jpeg|max:2048',

        'highest_qualification_certificate	'=> 'nullable|mimes:pdf,jpg,jpeg|max:2048',
        'father_name'=> 'required',
        'mother_name'=> 'required',
        'gender'=> 'required',
        'alternative_phone'=> 'required',
        'aadhaar'=> 'required',
        'dob'=> 'required',
        'purpose'=> 'required',
        'permanent_address'=> 'required',
        'permanent_district'=> 'required',
        'permanent_pin'=> 'required',
        'correspondance_address'=> 'required',
        'correspondance_state'=> 'required',
        'correspondance_district'=> 'required',
        'correspondance_pin'=> 'required',




     ], msg());


     if ($validation->fails())

     return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);



     $data = [
        'user_id'=> Auth::id(),

       'nationality'=> $request->nationality,
       'father_name'=> $request->father_name,
       'mother_name'=> $request->mother_name,
       'gender'=> $request->gender,
       'phone'=> $request->alternative_phone,
       'aadhaar'=> $request->aadhaar,
       'dob'=> $request->dob,
       'purpose'=> $request->purpose,
       'permanent_address'=> $request->permanent_address,
       'permanent_district'=> $request->permanent_district,
       'permanent_pin'=> $request->permanent_pin,
       'correspondance_address'=> $request->correspondance_address,
       'correspondance_state'=> $request->correspondance_state,
       'correspondance_district'=> $request->correspondance_district,
       'correspondance_pin'=> $request->correspondance_pin,
    ];


    $user_basic = DB::table('eklavya_krida_kosh_basic_detail')->where('user_id', Auth::id())->first();

     if ($request->hasFile('profile_picture')){
        $profile_picture = moveFile('eklavya_krida_kosh/profile_picture', $request->profile_picture);
        $data['profile_picture']= $profile_picture;

    }

    if ($request->hasFile('signature')){
        $signature = moveFile('eklavya_krida_kosh/signature', $request->signature);
        $data['signature']= $signature;


    }

    if ($request->hasFile('high_school_certificate')){
        $high_school_certificate = moveFile('eklavya_krida_kosh/high_school_certificate', $request->high_school_certificate);
        $data['high_school_certificate']= $high_school_certificate;
    }
    if ($request->hasFile('domicile_certificate')){
        $domicile_certificate = moveFile('eklavya_krida_kosh/domicile_certificate', $request->domicile_certificate);
        $data['domicile_certificate']= $domicile_certificate;
    }

    if ($request->hasFile('highest_qualification_certificate')){
        $highest_qualification_certificate = moveFile('eklavya_krida_kosh/highest_qualification_certificate', $request->highest_qualification_certificate);
        $data['highest_qualification_certificate']= $highest_qualification_certificate;


    }


    if($user_basic){


        $profile_picturee = "public/eklavya_krida_kosh/profile_picture/".$user_basic->profile_picture;


       if($request->hasFile('profile_picture') && File::exists($profile_picturee)) {
            File::delete($profile_picturee);
        }
        $signaturee = "public/eklavya_krida_kosh/signature/".$user_basic->signature;

        if($request->hasFile('signature') && File::exists($signaturee)) {
            File::delete($signaturee);
        }


        $high_school_certificatee = "public/eklavya_krida_kosh/high_school_certificate/".$user_basic->high_school_certificate;


        if($request->hasFile('high_school_certificate') && File::exists($high_school_certificatee)) {
             File::delete($high_school_certificatee);
         }
         $domicile_certificatee = "public/eklavya_krida_kosh/domicile_certificate/".$user_basic->domicile_certificate;

         if($request->hasFile('domicile_certificate') && File::exists($domicile_certificatee)) {
             File::delete($domicile_certificatee);
         }

         $highest_qualification_certificatee = "public/eklavya_krida_kosh/highest_qualification_certificate/".$user_basic->highest_qualification_certificate;

         if($request->hasFile('highest_qualification_certificate') && File::exists($highest_qualification_certificatee)) {
             File::delete($highest_qualification_certificatee);
         }

            DB::table('eklavya_krida_kosh_basic_detail')->where('user_id', Auth::id())->update($data);


            $msg = "Basic Detail Updated Successfully";
        }else{
            DB::table('eklavya_krida_kosh_basic_detail')->insert($data);
            $msg = "Basic Detail Submitted Successfully";
        }

        return response()->json(['error' => false, 'msg' => $msg,'url'=>route('eklavya_kreeda_kosh_award_bank_detail')]);







   }



   public function eklavya_kreeda_kosh(Request $req){
    //    dd($sport_competition);
    $user = User::where('id', Auth::id())->first();
    $dob=((explode('/',$user->dob))[2]);
    $sport_competition = DB::table('sport_competition_level_master')->get();
    $summary =DB::table('eklavya_krida_kosh_basic_detail')->where('user_id',  Auth::id())->first();
    $selected_sport = DB::table('sport_welfare_registration_master')->select('sport_type')->where('id', Auth::id())->get()[0]->sport_type;
    $sports = DB::table('sport_type')->orderBy('name', 'ASC')->get();
    $competition = DB::table('position_competition_master')->get();
    $event = DB::table('position_event_master')->get();
    $award = DB::table('eklavya_krida_kosh_award')->where('user_id', Auth::id())->get();
    $eklavya_data=false;
    $award_data=false;
    if($req->id){
        $eklavya_data = DB::table('eklavya_krida_kosh_basic_detail')->select('*')->where('user_id', Auth::id())->where('application_no', $req->id)->first();
        $award_data =DB::table('eklavya_krida_kosh_award')->select('*')->where('user_id', Auth::id())->where('application_no', $req->id)->get();
    }
    return view('eklavya_kreeda_kosh.award_bank_detail', compact('dob','sports', 'award','summary','sport_competition','selected_sport','eklavya_data','award_data','competition','event'));
   }

   


   public function awardStore(Request $req){
    $validation = Validator::make($req->all(), [
       'sport_achievement_docs.*'=> 'required|mimes:png,jpg,jpeg,pdf|max:2048',
       'front_page_of_passbook'=> 'required|mimes:png,jpg,jpeg,pdf|max:2048',
       'notary_affidavit_doc'=> 'required|mimes:png,jpg,jpeg,pdf|max:2048',
       'sport_competition_name.*'=>'required',
       'sport_name.*'=>'required',
       'sport_achievement_position.*'=>'required',
       'competition_from_date.*'=> 'required',
       'competition_to_date.*'=> 'required',
       'sport_place.*'=> 'required',
       'event_details.*'=> 'required',
       'bank_name'=> 'required',
       'bank_branch'=> 'required',
       'ifsc_code'=> 'required',
       'account_no'=> 'required',
       'purpose'=>'required',
       'qualification'=>'required',
    ], msg());

    if ($validation->fails())
        return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        $applNo = rand(11111, 99999);
        $applicationNo= date('ymd').$applNo;
// dd($req->all());
        foreach($req->competition_name as $key=>$item){
            if(isset($req->sport_achievement_docs[$key]) ){

                $sport_achievement_docs = date('His').$req->sport_achievement_docs[$key]->getClientOriginalName();
                $req->file('sport_achievement_docs')[$key]->storeAs('eklavya_kreeda_kosh', $sport_achievement_docs, 'public');
                }
                else{
                    $sport_achievement_docs = $req->sport_achievement_docs1[$key];
                }

                $get_id= DB::table('eklavya_krida_kosh_award')->insert(array(
                    'user_id' =>Auth::id(),
                    'application_no' => $applicationNo,
                    'competition_name' => $req->competition_name[$key],
                    'event_type' => $req->event_type[$key],
                    'event_name' => $req->event_name[$key],
                    'earned_medals' => $req->earned_medals[$key],
                    'competition_from_date' => $req->competition_from_date[$key],
                    'competition_to_date' => $req->competition_to_date[$key],
                    'sport_place' => $req->sport_place[$key],
                    'event_details' => $req->event_details[$key],
                    'sport_achievement_docs' => $sport_achievement_docs,
                ));

        }

        $data= [
            'user_id' =>Auth::id(),
            'bank_name'=> $req->bank_name,
            'bank_branch'=> $req->bank_branch,
            'ifsc_code'=> $req->ifsc_code,
            'account_no'=> $req->account_no,
            'application_no' => $applicationNo,
            'purpose' => $req->purpose,
            'qualification' => $req->qualification,
            'other_qualification' => $req->other_qualification
         ];

         $user_basic = DB::table('eklavya_krida_kosh_basic_detail')->where('user_id', Auth::id())->first();
         if ($req->hasFile('front_page_of_passbook')){
            if(isset($user_basic)){
            $front_page_of_passbooke = "public/eklavya_krida_kosh/front_page_of_passbook/".$user_basic->front_page_of_passbook;
    
            if($req->hasFile('front_page_of_passbook') && File::exists($front_page_of_passbooke)) {
                File::delete($front_page_of_passbooke);
            }
        }
            $front_page_of_passbook = moveFile('eklavya_krida_kosh/front_page_of_passbook', $req->front_page_of_passbook);
            $data['front_page_of_passbook']= $front_page_of_passbook;

            if ($req->hasFile('high_school_certificate')){
                $high_school_certificate = moveFile('eklavya_krida_kosh/high_school_certificate', $req->high_school_certificate);
                $data['high_school_certificate']= $high_school_certificate;
            }
            if ($req->hasFile('domicile_certificate')){
                $domicile_certificate = moveFile('eklavya_krida_kosh/domicile_certificate', $req->domicile_certificate);
                $data['domicile_certificate']= $domicile_certificate;
            }
        
            if ($req->hasFile('highest_qualification_certificate')){
                $highest_qualification_certificate = moveFile('eklavya_krida_kosh/highest_qualification_certificate', $req->highest_qualification_certificate);
                $data['highest_qualification_certificate']= $highest_qualification_certificate;
            }

            if ($req->hasFile('notary_affidavit_doc')){
                $notary_affidavit_doc = moveFile('eklavya_krida_kosh/notary_affidavit_doc', $req->notary_affidavit_doc);
                $data['notary_affidavit_doc']= $notary_affidavit_doc;
            }
            
    
            DB::table('eklavya_krida_kosh_basic_detail')->insertGetId($data);
        }
    

        return response()->json(['error' => false, 'msg' => 'Award Detail Added Successfully',"url" => url('applicationpreview/'.$applicationNo) ]);





}
public function updateawardStore(Request $req){
    $validation = Validator::make($req->all(), [
       'sport_achievement_docs.*'=> 'nullable|mimes:png,jpg,jpeg,pdf|max:2048',
       'front_page_of_passbook'=> 'nullable|mimes:png,jpg,jpeg,pdf|max:2048',
       'notary_affidavit_doc'=> 'nullable|mimes:png,jpg,jpeg,pdf|max:2048',
       'sport_competition_name.*'=>'required',
       'sport_name.*'=>'required',
       'sport_achievement_position.*'=>'required',
       'competition_from_date.*'=> 'required',
       'competition_to_date.*'=> 'required',
       'sport_place.*'=> 'required',
       'event_details.*'=> 'required',
       'bank_name'=> 'required',
       'bank_branch'=> 'required',
       'ifsc_code'=> 'required',
       'account_no'=> 'required',
       'purpose'=>'required',
       'qualification'=>'required',
    ], msg());

    if ($validation->fails())
        return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

        
        DB::table('eklavya_krida_kosh_award')->where('user_id',Auth::id())->where('application_no',$req->application_no)->delete();
        foreach($req->competition_name as $key=>$item){
            if(isset($req->sport_achievement_docs[$key]) ){

                $sport_achievement_docs = date('His').$req->sport_achievement_docs[$key]->getClientOriginalName();
                $req->file('sport_achievement_docs')[$key]->storeAs('eklavya_kreeda_kosh', $sport_achievement_docs, 'public');
                }
                else{
                    $sport_achievement_docs = $req->sport_achievement_docs1[$key];
                }

                $get_id= DB::table('eklavya_krida_kosh_award')->insert(array(
                    'user_id' =>Auth::id(),
                    'application_no' => $req->application_no,
                    'competition_name' => $req->competition_name[$key],
                    'event_type' => $req->event_type[$key],
                    'event_name' => $req->event_name[$key],
                    'earned_medals' => $req->earned_medals[$key],
                    'competition_from_date' => $req->competition_from_date[$key],
                    'competition_to_date' => $req->competition_to_date[$key],
                    'sport_place' => $req->sport_place[$key],
                    'event_details' => $req->event_details[$key],
                    'sport_achievement_docs' => $sport_achievement_docs,
                ));

        }

        $data= [
            'bank_name'=> $req->bank_name,
            'bank_branch'=> $req->bank_branch,
            'ifsc_code'=> $req->ifsc_code,
            'account_no'=> $req->account_no,
            'purpose' => $req->purpose,
            'qualification' => $req->qualification,
            'other_qualification' => $req->other_qualification
         ];

         $user_basic = DB::table('eklavya_krida_kosh_basic_detail')->where('application_no',$req->application_no)->where('user_id', Auth::id())->first();
         if ($req->hasFile('front_page_of_passbook')){
            if(isset($user_basic)){
                $front_page_of_passbooke = "public/eklavya_krida_kosh/front_page_of_passbook/".$user_basic->front_page_of_passbook;
                if($req->hasFile('front_page_of_passbook') && File::exists($front_page_of_passbooke)) {
                    File::delete($front_page_of_passbooke);
                }
            }else{
                $front_page_of_passbook = moveFile('eklavya_krida_kosh/front_page_of_passbook', $req->front_page_of_passbook);
                $data['front_page_of_passbook']= $front_page_of_passbook;
            }
        }else{
            $data['front_page_of_passbook']= $req->front_page_of_passbook1;
        }

            if ($req->hasFile('high_school_certificate')){
                $high_school_certificate = moveFile('eklavya_krida_kosh/high_school_certificate', $req->high_school_certificate);
                $data['high_school_certificate']= $high_school_certificate;
            }else{
                $data['high_school_certificate']= $req->high_school_certificate1;
            }

            if ($req->hasFile('domicile_certificate')){
                $domicile_certificate = moveFile('eklavya_krida_kosh/domicile_certificate', $req->domicile_certificate);
                $data['domicile_certificate']= $domicile_certificate;
            }
            else{
                $data['domicile_certificate']= $req->domicile_certificate1;
            }
        
            if ($req->hasFile('highest_qualification_certificate')){
                $highest_qualification_certificate = moveFile('eklavya_krida_kosh/highest_qualification_certificate', $req->highest_qualification_certificate);
                $data['highest_qualification_certificate']= $highest_qualification_certificate;
            }
            else{
                $data['highest_qualification_certificate']= $req->highest_qualification_certificate1;
            }
             if ($req->hasFile('notary_affidavit_doc')){
                $notary_affidavit_doc = moveFile('eklavya_krida_kosh/notary_affidavit_doc', $req->notary_affidavit_doc);
                $data['notary_affidavit_doc']= $notary_affidavit_doc;
            }
    
            DB::table('eklavya_krida_kosh_basic_detail')->where('user_id', Auth::id())->where('application_no', $req->application_no)->update($data);
        
    

        return response()->json(['error' => false, 'msg' => 'Award Detail Updated Successfully',"url" => url('applicationpreview/'.$req->application_no) ]);





}


// public function awarddelete($id){
//    $aw = DB::table('eklavya_krida_kosh_award')->find($id);
//     $image_path = "public/eklavya_krida_kosh/award/".$aw->upload_file;
//     if(File::exists($image_path)) {
//         File::delete($image_path);
//     }

//     DB::table('eklavya_krida_kosh_award')->delete($id);

//     $count = DB::table('eklavya_krida_kosh_award')->where('user_id', Auth::id())->get()->count();

//     return response()->json(['error' => false, 'msg' => 'Award Detail Remove Successfully', 'count'=>$count]);



// }


// public function bank_detail_store (Request $request){
//     $validation = Validator::make($request->all(), [
//         // 'upload_file'=> 'required|mimes:png,jpg,jpeg,pdf|max:2048',
//         'bank_name'=>'required',
//         'ifsc_code'=>'required',
//         'account_no'=>'required',

//      ], msg());


//      $data= [
//         'bank_name'=> $request->bank_name,
//         'ifsc_code'=> $request->ifsc_code,
//         'account_no'=> $request->account_no,
//      ];
//      $user_basic = DB::table('eklavya_krida_kosh_basic_detail')->where('user_id', Auth::id())->first();

//      if ($request->hasFile('front_page_of_passbook')){
//         $front_page_of_passbooke = "public/eklavya_krida_kosh/front_page_of_passbook/".$user_basic->front_page_of_passbook;

//         if($request->hasFile('front_page_of_passbook') && File::exists($front_page_of_passbooke)) {
//             File::delete($front_page_of_passbooke);
//         }
//         $front_page_of_passbook = moveFile('eklavya_krida_kosh/front_page_of_passbook', $request->front_page_of_passbook);
//         $data['front_page_of_passbook']= $front_page_of_passbook;


//     }

//      DB::table('eklavya_krida_kosh_basic_detail')->where('user_id', Auth::id())->update($data);
//      return response()->json(['error' => false, 'msg' => 'Award And Detail Added successfully','url'=>route('eklavya_kreeda_kosh_applicationpreview')]);


// }




public function applicationpreview($appNo="")
{
    $articles =DB::table('sport_welfare_registration_master as swrm')
                ->join('eklavya_krida_kosh_basic_detail as la', 'swrm.id', '=', 'la.user_id')
                ->join('sport_type as st', 'swrm.sport_type', '=', 'st.id')
                ->select( 'la.*','swrm.fullname','swrm.email','swrm.mobile','swrm.gender',
                'swrm.association_certificate', 'swrm.association_certificate_upload',
                'st.name as sport_name','swrm.place_of_birth','swrm.dob','swrm.nationality',           
                'swrm.signature_doc','swrm.photograph_doc','swrm.marital_status','swrm.religion',
                'swrm.aadhar_no','swrm.father_name','swrm.mother_name','swrm.present_address',
                'swrm.present_state','swrm.present_district','swrm.present_pincode','swrm.permanent_address',
                'swrm.permanent_state','swrm.permanent_district','swrm.permanent_pincode',
                'swrm.present_flat_no','swrm.permanent_flat_no')
                ->where('swrm.id', Auth::id())
                ->where('la.application_no', $appNo)
                ->first();

        $sport_achievement =DB::table('eklavya_krida_kosh_award as ekka')
                    ->join('position_event_master as pem', 'ekka.event_name', '=', 'pem.id')
                    ->join('position_competition_master as pcm', 'ekka.competition_name', '=', 'pcm.id')
                    ->select('ekka.*','pcm.name as comp','pem.name as event')
                    ->where('user_id', Auth::id())
                    ->where('application_no', $appNo)
                    ->get();

//     $applicationview = DB::table('eklavya_krida_kosh_basic_detail')->where('user_id', Auth::id())->first();
$queryData = DB::table('query_master')->where('form_type',7)->where('user_id',Auth::id())->where('application_no', $appNo)->orderBy('id','DESC')->get();
//    $award = DB::table('eklavya_krida_kosh_award')->where('user_id',  Auth::id())->get();

        return view('eklavya_kreeda_kosh.application_preview', compact('articles','sport_achievement','queryData'));



}
public function applicant_applicationFinalSubmit($appNo=""){
   
    // DB::table('eklavya_krida_kosh_registration')->where('id', Auth::id())->update(['status_preview'=> 2, 'application_no'=> date('Y').sprintf("%08d",  Auth::id()), 'final_submit_date'=> date("Y/m/d"), 'application_status'=> 1]);
    $check = DB::table('eklavya_krida_kosh_basic_detail')->where('user_id', Auth::id())->where('application_no', $appNo)->update([
        'final_submit' => 1,'is_editable' => 2,
    ]);
    return response()->json(['error' => false, 'msg' => 'Final Submitted  Successfully', 'url'=>route('dashboard')]);

}



}
