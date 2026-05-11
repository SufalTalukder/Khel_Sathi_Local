<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class OnlineAdmissionModel extends Authenticatable
{
    use HasFactory;

    protected $table = 'admission_registration_login';

    protected $fillable = [
        'application_no',
        'fullname',
        'dob',
        'email',
        'mobile',
        'aadhar_no',
        'native_of_up',
        'password',
        'user_password',
        'password_changed',
        'status',
        'created_at','registered_from'

    ];
}
