<?php

namespace App\Http\Controllers;
use App\Events\SmsMail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;

use App\Models\GymnasiumSwimming;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GymnasiumSwimmingController extends Controller
{
   public function gymnasium_swimming_register(){
    $Code1 = rand(11, 99);
    $Code2 = rand(11, 99);
    $capchaCode = $Code1 +  $Code2;
    session()->put('capchaCode', $capchaCode);
       return view('gymnasium_swimming.registration',  compact('capchaCode','Code1','Code2'));
   }


   public function cp_refresh()
   {


       $Code1 = rand(11, 99);
       $Code2 = rand(11, 99);
       $capchaCode = $Code1 +  $Code2;
       session()->put('capchaCode', $capchaCode);
       $data['capchaCode']=$capchaCode;
       $data['Code1']=$Code1;
       $data['Code2']=$Code2;
       return response()->json($data);
   }


   public function registrationStore(Request $request)
   {
       $checkEmail_for_registered = DB::table('gymnasium_swimming_registration')->where('email', $request->email)->first();
       if ($checkEmail_for_registered && $checkEmail_for_registered->type == $request->type && $checkEmail_for_registered->otp_verify == 0) {
        $validation = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'dob' => 'required',
            'gender' => 'required',
            'type' => 'required',
            'email' => 'required|email',
            'captchacode' => 'required',
            'captcha' => 'required',
            'mobile' => 'required|numeric|digits:10',
        ]);
        if ($validation->fails())
        return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
        //$otp = 123456;
         $otp = rand(111111, 999999);
           session()->put('email', $request->email);
           session()->put('mobile', $request->mobile);
           session()->put('form_type', 1);
           SmsMail::dispatch([
               "otp" => $otp,
               "email" => $request->email,
               "mobile" => $request->mobile
           ], 1);
           $data = [
               'name' => $request->name,
               'dob' => $request->dob,
               'email' => $request->email,
               'mobile' => $request->mobile,
               'otp' => $otp,
               'type' => $request->type,
           ];
           DB::table('gymnasium_swimming_registration')->where('id', $checkEmail_for_registered->id)->update($data);

           return response()->json(["error" => false, "msg" => "OTP Sent Successfully./ओटीपी सफलतापूर्वक अग्रेषित कर दिया गया है।",  "url" => route('gymnasium_swimming_otp')]);

              //return redirect('GymnasiumSwimmingotp'.base64_encode($checkEmail_for_registered->id))->with('error', 'Oops! Varification is pending for this email id, Please varify the OTP.');
       }elseif($checkEmail_for_registered && $checkEmail_for_registered->type != $request->type){
        if($checkEmail_for_registered->type == 1){
            $typee = 'Gymnasium';
        }else{
            $typee = 'Swimming';
        }
        return response()->json(["error" => true, "msg" => "Already register as ' .$typee. ' with this email Id."]);
        }
        $validation = Validator::make($request->all(), [
           'name' => 'required|max:100',
           'dob' => 'required',
           'gender' => 'required',
           'type' => 'required',
           'email' => 'required|email',
           'captchacode' => 'required',
           'captcha' => 'required',
           'mobile' => 'required|numeric|digits:10',
       ]);

       if ($validation->fails())
       return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

       if ($request->captcha != $request->captchacode) {
        return response()->json(["error" => true, "msg" => "Oops! Invalid Captcha Code."]);

       }
       $otp = rand(111111, 999999);
        //$otp = 123456;
       $randomPassword = rand(11111111,99999999);
       $data = [
           'name' => $request->name,
           'dob' => $request->dob,
           'type' => $request->type,
           'gender' => $request->gender,
           'email' => $request->email,
           'mobile' => $request->mobile,
           'otp' => $otp,
           'decoded_password' => $randomPassword,
           'password' => Hash::make($randomPassword),
           'status_preview' => 1,
       ];

       $user = GymnasiumSwimming::where('email', $request->email)->where('otp_verify', 0)->first();
       if ($user) {
           $user->update($data);
           session()->put('email', $request->email);
           session()->put('mobile', $request->mobile);
           session()->put('form_type', 1);
           SmsMail::dispatch([
               "otp" => $otp,
               "email" => $request->email,
               "mobile" => $request->mobile
           ], 1);

           return response()->json(["error" => false, "msg" => "OTP Sent Successfully./ओटीपी सफलतापूर्वक अग्रेषित कर दिया गया है।", "url" => route('gymnasium_swimming_otp')]);

        }

       $user = GymnasiumSwimming::where('email', $request->email)->first();
       if ($user) {
        return response()->json(["error" => true, "msg" => "Already Registered with this Email."]);

       }

       $registerUser = GymnasiumSwimming::create($data);

       session()->put('email', $request->email);
       session()->put('mobile', $request->mobile);
       session()->put('form_type', 1);
       SmsMail::dispatch([
           "otp" => $otp,
           "email" => $request->email,
           "mobile" => $request->mobile
       ], 1);
       return response()->json(["error" => false, "msg" => "OTP Sent Successfully./ओटीपी सफलतापूर्वक अग्रेषित कर दिया गया है।", "url" => route('gymnasium_swimming_otp')]);

   }

  public function otp(){
    return view('gymnasium_swimming.otp');
  }

  public function forgotStore (Request $req)
  {
      $user = GymnasiumSwimming::where('email', $req->email)->first();
      //dd($user);
      if ($user != "") {
          //dd($reply->mobile);
          SmsMail::dispatch(["id" => $user->id],  17);
          return response()->json(["error" => false, "msg" => "Password has been sent on the registered Mobile No./Email ID./पासवर्ड पंजीकृत मोबाइल नंबर/ईमेल आईडी पर भेज दिया गया है।", "url" => route('gymnasium_swimming_login')]);

      }
      return response()->json(["error" => true, "msg" => "Email does not exists"]);

  }
  public function otpStore(Request $req)
  {
      $otp = $req->otp1 . $req->otp2 . $req->otp3 . $req->otp4 . $req->otp5 . $req->otp6;
      $email = session()->get('email');

      $user = GymnasiumSwimming::where('email', $email)->where('otp', $otp)->first();


      if ($user) {
          $user->otp_verify = 1;
          $user->save();
          SmsMail::dispatch(["id" => $user->id],  17);
          return response()->json(["error" => false, "msg" => "Successfully Registered on the Portal./पोर्टल पर सफलतापूर्वक पंजीकृत हो गए हैं।", "url" => route('gymnasium_swimming_login')]);


      }
    return response()->json(["error" => true, "msg" => "Oops! Invalid OTP  Please try again ."]);


  }


    public function login()
       {
        $Code1 = rand(11, 99);
        $Code2 = rand(11, 99);
        $capchaCode = $Code1 +  $Code2;
        session()->put('capchaCode', $capchaCode);
         return view('gymnasium_swimming.login', compact('capchaCode','Code1','Code2'));

       }


       public function resendotp()
       {
           //$otp = 123456;
            $otp = rand(111111, 999999);

           GymnasiumSwimming::where('email', session()->get('email'))->update(
               ["otp" => $otp]
           );

           SmsMail::dispatch([
               "otp" => $otp,
               "email" => session()->get('email'),
               "mobile" => session()->get('mobile')
           ], 1);
           return response()->json(["error" => false, "msg" => "Otp Resend Successfully."]);


       }


       public function forgotpassword()
       {
           return view('gymnasium_swimming.forgotpassword');
       }


       public function loginStore(Request $request)
       {
        $validation = Validator::make($request->all(), [
               'email' => 'required|email',
               'password' => 'required',
               'captcha' => 'required',

           ]);

           if ($validation->fails())
           return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);
           $user = GymnasiumSwimming::where('email', $request->email)->where('otp_verify', 0)->first();
           if ($user) {
            return response()->json(["error" => true, "msg" => "Please Register First."]);

           }

           if ($request->captcha != $request->captchacode) {

               return response()->json(["error" => true, "msg" => "Oops! Invalid Captcha Code."]);
           }

           $credentials = $request->validate([
               'email' => 'required|email',
               'password' => 'required',

           ]);
           Auth::guard('GymnasiumSwimming')->attempt($credentials);
           if (Auth::guard('GymnasiumSwimming')->attempt($credentials)) {
            GymnasiumSwimming::where('email', $request->email)->first()->update(['last_login' => date('Y-m-d H:i:s')]);

               if (Auth::guard('GymnasiumSwimming')->user()->change_password_status == 1) {
                return response()->json(["error" => false, "msg" => "Logged In Successfully./सफलतापूर्वक लॉगिन हो गए हैं।", "url" => route('gymnasium_swimming_dashboard')]);

               } else {

                   return response()->json(["error" => false, "msg" => "Logged In Successfully./सफलतापूर्वक लॉगिन हो गए हैं।", "url" => route('gymnasium_swimming_changepassword')]);

                }
           }
           return response()->json(["error" => true, "msg" => "The provided credentials does not match our records"]);

       }


       public function changepassword(){

        return view('gymnasium_swimming.updatepassword');
       }




       public function changepasswordStore(Request $request)
       {
        $validation = Validator::make($request->all(), [
               'old_password' => 'required',
               'new_password' => 'required|min:8|different:old_password',
               'confirm_password' => 'required|min:8|same:new_password',
           ]);
           if ($validation->fails())
           return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

           $user = Auth::guard('GymnasiumSwimming')->user();
           if ($user->decoded_password != $request->old_password) {
            return response()->json(['error' => true, 'msg' => 'Old Password Does Not Match Our Record.']);
           }

           $userUpdate = GymnasiumSwimming::find($user->id);



           $data = [
               'decoded_password' => $request->new_password,
               'password' => Hash::make($request->new_password),
               'change_password_status' => 1
           ];

           $userUpdate->update($data);
           Auth::guard('GymnasiumSwimming')->logout();
           return response()->json(['error' => false, 'msg' => 'Password Changed Successfully./पासवर्ड सफलतापूर्वक बदल दिया गया है।', 'url'=> route('gymnasium_swimming_login')]);

       }


       public function dashboard(){

        if(Auth::guard('GymnasiumSwimming')->user()->change_password_status  != 1){
            return redirect()->route('gymnasium_swimming_changepassword');
        }

        $applicationview = DB::table('gymnasium_swimming_basic_detail')->where('user_id',Auth::guard('GymnasiumSwimming')->user()->id)->first();

        if(!$applicationview){
            return redirect()->route('gymnasium_swimming_application');
        }

        $award = DB::table('gymnasium_swimming_award')->where('user_id', Auth::guard('GymnasiumSwimming')->user()->id)->get();

        return view('gymnasium_swimming.dashboard', compact('applicationview','award'));
       }


       public function application(){


        if(Auth::guard('GymnasiumSwimming')->user()->status_preview == 2){
            return redirect()->back();
        }
            $summary =DB::table('gymnasium_swimming_basic_detail')->where('user_id', Auth::guard('GymnasiumSwimming')->user()->id)->first();

        $districts = DB::table('cities')->select('city', 'id')->where('state_id', '23')->get();
          $award = DB::table('gymnasium_swimming_award')->where('user_id', Auth::guard('GymnasiumSwimming')->user()->id)->get();

        return view('gymnasium_swimming.application',  compact('summary','districts', 'award'));
       }




    public function awardStore(Request $request){

        $validation = Validator::make($request->all(), [
           'upload_file'=> 'required|mimes:png,jpg,jpeg,pdf|max:2048',
           'award'=> 'required',
        ], msg());

        if ($validation->fails())
            return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);

            if ($request->hasFile('upload_file')){
                $upload_file = moveFile('gymnasium_swimming/award', $request->upload_file);
            }

            $data = [
              'user_id'=> Auth::guard('GymnasiumSwimming')->user()->id,
              'award'=>$request->award,
              'upload_file'=>$upload_file,
            ];

            DB::table('gymnasium_swimming_award')->insert($data);

            $dataQual=  DB::table('gymnasium_swimming_award')->where('user_id', Auth::guard('GymnasiumSwimming')->user()->id)->get();
            return response()->json(['error' => false, 'msg' => 'Award Detail Added Successfully','dataQual'=> $dataQual ]);





    }

    public function logout()
    {
        Auth::guard('GymnasiumSwimming')->logout();
        return Redirect()->route('gymnasium_swimming_login')->with('success', 'User Logout successfully.');
    }

    public function awarddelete($id){
       $aw = DB::table('gymnasium_swimming_award')->find($id);
        $image_path = "public/gymnasium_swimming/award/".$aw->upload_file;
        if(File::exists($image_path)) {
            File::delete($image_path);
        }

        DB::table('gymnasium_swimming_award')->delete($id);

        $count = DB::table('gymnasium_swimming_award')->where('user_id',Auth::guard('GymnasiumSwimming')->user()->id)->get()->count();

        return response()->json(['error' => false, 'msg' => 'Award Detail Remove Successfully', 'count'=>$count]);



    }



    public function applicant_applicationbasicForm(Request $request){


        $validation = Validator::make($request->all(), [
            'profile_picture'=> 'mimes:png,jpg,jpeg|max:2048',
            'signature'=> 'mimes:png,jpg,jpeg|max:2048',
            'father_name'=> 'required',
            'nationality'=> 'required',
            'aadhar'=> 'required',
            'religion'=> 'required',

            'blood_group'=> 'required',
            'address'=> 'required',
            'district_id'=> 'required',
            'pin_code'=> 'required',


         ], msg());

         if ($validation->fails())

         return response()->json(['error' => true, 'msg' => $validation->errors()->first()]);


             $dataaward=  DB::table('gymnasium_swimming_award')->where('user_id', Auth::guard('GymnasiumSwimming')->user()->id)->get();
             if ($dataaward->count() == 0){
                return response()->json(['error' => true, 'msg' => 'Please Fill Award Details']);


             }

             $data = [
                'user_id'=>Auth::guard('GymnasiumSwimming')->user()->id,
               'father_name'=> $request->father_name,
               'nationality'=> $request->nationality,
               'aadhar'=> $request->aadhar,
               'religion'=> $request->religion,
               'vehicle_no'=> $request->vehicle_no,

               'blood_group'=> $request->blood_group,
               'address'=> $request->address,
               'district_id'=> $request->district_id,
               'pin_code'=> $request->pin_code,


            ];
            $user_basic = DB::table('gymnasium_swimming_basic_detail')->where('user_id',Auth::guard('GymnasiumSwimming')->user()->id)->first();

             if ($request->hasFile('profile_picture')){
                $profile_picture = moveFile('gymnasium_swimming/profile_picture', $request->profile_picture);
                $data['profile_picture']= $profile_picture;

            }

            if ($request->hasFile('signature')){
                $signature = moveFile('gymnasium_swimming/signature', $request->signature);
                $data['signature']= $signature;


            }

       if($user_basic){


        $profile_picturee = "public/gymnasium_swimming/profile_picture/".$user_basic->profile_picture;


       if($request->hasFile('profile_picture') && File::exists($profile_picturee)) {
            File::delete($profile_picturee);
        }
        $signaturee = "public/gymnasium_swimming/signature/".$user_basic->signature;

        if($request->hasFile('signature') && File::exists($signaturee)) {
            File::delete($signaturee);
        }

            DB::table('gymnasium_swimming_basic_detail')->where('user_id',Auth::guard('GymnasiumSwimming')->user()->id)->update($data);


            $msg = "Basic Detail Updated Successfully";
        }else{
            DB::table('gymnasium_swimming_basic_detail')->insert($data);
            $msg = "Basic Detail Submitted Successfully";
        }

        return response()->json(['error' => false, 'msg' => $msg,'url'=>route('gymnasium_swimming_applicationpreview')]);



    }


    public function applicationpreview()
    {

        $applicationview = DB::table('gymnasium_swimming_basic_detail')->where('user_id',Auth::guard('GymnasiumSwimming')->user()->id)->first();

       $award = DB::table('gymnasium_swimming_award')->where('user_id', Auth::guard('GymnasiumSwimming')->user()->id)->get();

            return view('gymnasium_swimming.applicationpreview', compact('applicationview','award'));



    }


    public function applicant_applicationFinalSubmit(){
        DB::table('gymnasium_swimming_registration')->where('id',Auth::guard('GymnasiumSwimming')->user()->id)->update(['status_preview'=> 2, 'application_no'=> date('Y').sprintf("%08d", Auth::guard('GymnasiumSwimming')->user()->id), 'final_submit_date'=> date("Y/m/d"), 'application_status'=> 1]);

        return response()->json(['error' => false, 'msg' => 'Final Submitted  Successfully', 'url'=>route('gymnasium_swimming_dashboard')]);

    }







}
