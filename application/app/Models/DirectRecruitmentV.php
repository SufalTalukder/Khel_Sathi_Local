<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Events\SmsMail;
class DirectRecruitmentV extends Authenticatable
{
    use HasFactory;

    
    protected $table = 'direct_recruitment';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fullname',
        'email',
        'mobile',
        'password',
        'user_password',
        'father_name',
        'mother_name',
        'registration_no',
        'designation',
        'company_website',
        'company_phone',
        'password',
        'fullname',
        'email',
        'password',
        'fullname',
        'email',
        'password',
        'role',
        'gender',
        'sport_type',
        'sport_position',
        'native_of_up',
        'dob',
        'place_of_birth',
        'nationality',
        'marital_status',
        'religion',
        'aadhar_no',
        'present_address',
        'present_state',
        'present_district',
        'present_pincode',
        'permanent_address',
        'permanent_country',
        'permanent_state',
        'permanent_district',
        'permanent_pincode',
        'last_login_attempt_time',
        'applyfor',
        'profile_complete'
    ];

    static function preRegistration($req)
    {

        if (DB::table('direct_recruitment')->where('email', $req->email)->exists())
            return response()->json(['error' => true, 'msg' => "Entered Email ID is already registered on this Portal. Please try another Email ID."]);

        if (DB::table('direct_recruitment')->where('mobile', $req->mobile)->exists())
            return response()->json(['error' => true, 'msg' => "Entered Mobile No. is already registered on this Portal. Please try another Mobile No."]);

        $pwd = rand(11111111,99999999);
        $id = DB::table('sport_welfare_registration')->insertGetId([
            // 'sport_type' => $req->sport_type,
            'fullname'       => $req->fname,
            // 'sport_position'  => $req->sport_position,
            'native_of_up'  => $req->native_of_up,
            'mobile'        => $req->mobile,
            'email'         => $req->email,
            'role'         => $req->role,
            'password'      => Hash::make($pwd),
            'user_password' => $pwd,
        ]);

        $otp = rand(111111, 999999);
    //    $otp = 123456;
        DB::table('user_otp')->insert([
            "pre_reg_id"    => $id,
            "mobile"        => $req->mobile,
            "otp"           => $otp
        ]);

        session()->put('form_type', 5);
        session()->put('mobile', $req->mobile);
        session()->put('email', $req->email);
        SmsMail::dispatch([
            "otp" => $otp,
            "email" => $req->email,
            "mobile" => $req->mobile
        ], 1);
// dd($req->role);
        if(isset($req->role) && $req->role == "normal"){
            return response()->json(["error" => false, "msg" => "SuccessFully Registered", "url" => route('otp')]);

        }else{
            return response()->json(["error" => false, "msg" => "SuccessFully Registered", "url" => route('drotp')]);

        }
    }
}
