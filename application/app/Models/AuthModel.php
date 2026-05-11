<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Events\SmsMail;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Mail;

class AuthModel extends Model
{
    use HasFactory;



    static function otpVerify($req)
    {
        $otp = $req->otp1 . $req->otp2 . $req->otp3 . $req->otp4 . $req->otp5 . $req->otp6;
        $mobile = session()->get('mobile');
        $table = DB::table('user_otp')->where('mobile', $mobile)->where('otp', $otp)->orderBy('id', 'DESC')->limit(1);

        if ($table->exists()) {

            $reg_id = $table->first()->pre_reg_id;
            $data_old = DB::table('sport_welfare_registration')->select(
                'sport_type',
                'fullname',
                // 'sport_position',
                'role',
                'native_of_up',
                'mobile',
                'email',
                'password',
                'user_password',
                'aadhar_no'
            )->where('id', $reg_id)->first();

            if (DB::table('sport_welfare_registration_master')->where('email', $data_old->email)->exists()) {
                $id = (DB::table('sport_welfare_registration_master')->select('id')->where('email', $data_old->email)->first())->id;
                // dd($id);
            } else {

                $data = [
                    'fullname'       => $data_old->fullname,
                    'native_of_up'  => $data_old->native_of_up,
                    'mobile'        => $data_old->mobile,
                    'email'         => $data_old->email,
                    'password'      => $data_old->password,
                    'user_password' => $data_old->user_password,
                    'aadhar_no' => $data_old->aadhar_no,
                    'login_from' => 1,

                ];
                if (Session::get('sessDetails')) {


                    $data['registered_from'] = 2;
                    $data['UserName_edistrict'] = Session::get('sessDetails')['UserName'];
                } else {
                    $data['registered_from'] = 1;
                }


                $id = DB::table('sport_welfare_registration_master')->insertGetId($data);
            }
            $id = DB::table('sport_welfare_user_type_master')->insertGetId([
                'user_id'       => $id,
                'registered_for'  => $data_old->role
            ]);

            SmsMail::dispatch(["id" => $reg_id], 2);

            session()->put('mobile', 000);
            return response()->json(["error" => false, "msg" => "Thank You. You Are SuccessFully Registered./आप सफलतापूर्वक पंजीकृत हो गए हैं।", "url" => "https://khelsathi.in/application/public/"]);
        }

        return response()->json(["error" => true, "msg" => "Entered OTP is invalid. Please Enter Valid OTP./भरा गया ओटीपी अमान्य है। कृपया सही ओटीपी भरें।"]);
    }

    static function resendOtp()
    {
        $count = DB::table('sport_welfare_registration_master')->select('otp_count')->where('mobile', session()->get('mobile'))->first()->otp_count;

        if ($count >= 4) {
            return response()->json(['status' => 201, 'msg' => "Your account has been temporarily blocked due to 4 consecutive incorrect OTP attempts. Your account has been blocked for the next 24 hours. Please try again after this time period."]);
        }
        $otp = rand(111111, 999999);
        //$otp = 123456;
        DB::table('user_otp')->where('mobile', session()->get('mobile'))->update(
            ["otp"           => $otp]
        );
        DB::table('eklavya_fund_registration')->where('email', session()->get('email'))->update(["otp" => $otp]);
        DB::table('sport_welfare_registration_master')->where('email', session()->get('email'))->update(["otp_count" => $count + 1]);
        SmsMail::dispatch([
            "otp" => $otp,
            "email" => session()->get('email'),
            "mobile" => session()->get('mobile')
        ], 1);
        return response()->json(["error" => false, "msg" => "OTP sent successfully./ओटीपी सफलतापूर्वक भेजा गया।"]);
    }

    static function changePassword($req)
    {

        if (!Hash::check($req->old_password, Auth::user()->password))
            return response()->json(["error" => true, "msg" => "The old password does not match our records."]);

        if (Hash::check($req->password, Auth::user()->password))
            return response()->json(["error" => true, "msg" => "Old password and New password cannot be same"]);

        DB::table('sport_welfare_registration_master')->where('id', Auth::id())->update([
            'password' => Hash::make($req->password),
            'user_password' => $req->password,
            'password_change_status' => 2
        ]);
        Auth::logout();
        session()->flash('success', 'Password Successfully changed.');

        return redirect()->to('https://khelsathi.in/application/public/');
    }


    /*static function sendSms($mobile, $message)
{
    $user = "Vareli";
    $password = "Vtpl@1234";
    $senderId = "VARELI";

    $url = "http://api.smscountry.com/SMSCwebservice_bulk.aspx";

    $postData = [
        'User' => $user,
        'passwd' => $password,
        'mobilenumber' => $mobile,
        'message' => urlencode($message),
        'sid' => $senderId,
        'mtype' => 'N',
        'DR' => 'Y'
    ];

    $finalUrl = $url . "?" . http_build_query($postData);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $finalUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    //return $response;

    return response()->json(["error" => false, "msg" => "SuccessFully Registered", "url" => route('otp')]);
}*/
    public static function sendPasswordMail($email, $password)
    {
        $data = [
            'password' => $password
        ];
        Mail::send('emails.password', $data, function ($message) use ($email) {

            $message->to($email);
            $message->subject('Your Login Password');
        });
        return response()->json(["error" => false, "msg" => "SuccessFully Registered", "url" => route('otp')]);
    }

    static function preRegistration($req)
    {

        // if (DB::table('sport_welfare_registration_master')->where('email', $req->email)->where('role', $req->role)->exists())
        if (DB::table('sport_welfare_registration_master')->join("sport_welfare_user_type_master", "sport_welfare_registration_master.id", "=", "sport_welfare_user_type_master.user_id")->where('sport_welfare_user_type_master.registered_for', "AWARD")->where('sport_welfare_registration_master.email', $req->email)->exists())
            return response()->json(['error' => true, 'msg' => "Entered Email ID is already registered on the portal./भरी गयी ईमेल आईडी पोर्टल पर पहले से पंजीकृत है।   ", "url" => route('signUp')]);

        // if (DB::table('sport_welfare_registration_master')->where('mobile', $req->mobile)->where('role', $req->role)->exists())
        if (DB::table('sport_welfare_registration_master')->join("sport_welfare_user_type_master", "sport_welfare_registration_master.id", "=", "sport_welfare_user_type_master.user_id")->where('sport_welfare_user_type_master.registered_for', "AWARD")->where('sport_welfare_registration_master.mobile', $req->mobile)->exists())
            return response()->json(['error' => true, 'msg' => "Entered Mobile No. is already registered on the portal./भरा गया मोबाइल नंबर पोर्टल पर पहले से पंजीकृत है।", "url" => route('signUp')]);

        if (DB::table('sport_welfare_registration_master')->where('aadhar_no', $req->aadhar_no)->exists())
            return response()->json(['error' => true, 'msg' => "Entered Aadhar No is already registered on the portal./भरा गया आधार संख्या पोर्टल पर पहले से पंजीकृत है।   ", "url" => route('signUp')]);

        $pwd = rand(11111111, 99999999);
        $id = DB::table('sport_welfare_registration')->insertGetId([
            // 'sport_type' => $req->sport_type,
            'fullname'       => $req->fname,
            // 'sport_position'  => $req->sport_position,
            'native_of_up'  => $req->native_of_up,
            'mobile'        => $req->mobile,
            'email'         => $req->email,
            'role'         => $req->role,
            'aadhar_no'    => $req->aadhar_no,
            'password'      => Hash::make($pwd),
            'user_password' => $pwd,
        ]);

        $otp = rand(111111, 999999);
        //$otp = 123456;
        DB::table('user_otp')->insert([
            "pre_reg_id"    => $id,
            "mobile"        => $req->mobile,
            "otp"           => $otp
        ]);

        session()->put('mobile', $req->mobile);
        session()->put('email', $req->email);
        session()->put('form_type', 1);




        $mobile = $req->mobile;

        $message = 'Your OTP is ' . $otp . ' for login into Khel Sathi Portal. Do not share OTP for security reasons, VTPL.';

        $smsUrl = 'http://api.smscountry.com/SMSCwebservice_bulk.aspx?' . http_build_query([
            'User'         => 'Vareli',
            'passwd'       => 'Vtpl@1234',
            'mobilenumber' => $mobile,
            'message'      => $message,
            'sid'          => 'KHELSA',
            'mtype'        => 'N',
            'DR'           => 'Y',
            'tempid'       => '1407177303297096963',
        ]);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $smsUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        $email = $req->email;
        $password = $pwd;
        //$this->sendPasswordMail($email,$pwd);
        self::sendPasswordMail($email, $password);




        return response()->json(["error" => false, "msg" => "SuccessFully Registered", "url" => route('otp')]);
    }
}
