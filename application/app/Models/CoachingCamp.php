<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;

class CoachingCamp extends Authenticatable
{
    use HasFactory;

    protected $table = 'coaching_camp_register';


    protected $fillable = [
        'name',
        'verified',
        'email',
        'mobile',
        'password',
        'aadhar',
        'dob',
        'change_password',
        'otp',
        'created_on',
        'decoded_password',
        'last_login'
    ];

    public $timestamps = false;
}
