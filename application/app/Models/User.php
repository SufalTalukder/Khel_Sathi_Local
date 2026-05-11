<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'sport_welfare_registration_master';

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
        'profile_complete',
        'is_login',
        'ippp'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    static function updateProfile($req, $id)
    {

        // 'fullname'              => $req->ocfname,
        // 'company_name'          => $req->ownername,
        // 'legal_status'          => $req->legalstatus,
        //'email'                 => $req->email,
        //'mobile'                => $req->mobile,

        $data = [
            'gstin_no'              => $req->gstno,
            'pan_no'                => $req->pancardno,
            'country'               => $req->country,
            'state'                 => $req->state,
            'district'              => $req->district,
            'address'               => $req->address,
            'profile_complete'      => 1
        ];

        if ($req->hasFile('pancardfile'))
            $data['pan_card_doc']          = moveFile('doc', $req->pancardfile);

        if ($req->hasFile('gstcertificate'))
            $data['gst_file']              = moveFile('doc', $req->gstcertificate);

        if ($req->hasFile('byelawsfile'))
            $data['byelawsfile']           = moveFile('doc', $req->byelawsfile);

        if ($req->hasFile('certifiedcopyfile'))
            $data['company_id_proof_doc']  = moveFile('doc', $req->certifiedcopyfile);

        User::where('id', $id)->update($data);

        session()->flash('success', 'Profile Successfully Updated.');
        return response()->json(['error' => false, 'msg' => "Profile Successfully Updated", 'url' => route('registeredProject')]);
    }

    static function updateUser($req)
    {
        User::where('id', $req->id)->update([
            'fullname'      => $req->authorized_person,
            'role'          => $req->rolename,
            'email'         => $req->email,
            'mobile'        => $req->mobile,
            'gstin_no'      => $req->gstno,
            'pan_no'        => $req->pancardno,
            'country'       => $req->country,
            'state'         => $req->state,
            'district'      => $req->district,
            'address'       => $req->address,
        ]);

        session()->flash('success', 'User Successfully Updated.');
    }

    // static function compProfile($req)
    // {
    //     User::where('id', $req->id)->update([
    //         'dob'      => $req->authorized_person,
    //         'role'          => $req->rolename,
    //         'email'         => $req->email,
    //         'mobile'        => $req->mobile,
    //         'gstin_no'      => $req->gstno,
    //         'pan_no'        => $req->pancardno,
    //         'country'       => $req->country,
    //         'state'         => $req->state,
    //         'district'      => $req->district,
    //         'address'       => $req->address,
    //     ]);

    //     session()->flash('success', 'User Successfully Updated.');
    // }
}
