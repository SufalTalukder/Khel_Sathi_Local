<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class FacilityRegister extends Authenticatable
{
    use HasFactory;


    protected $table = 'facility_booking_register';


    protected $fillable = [
      'name',
      'fathername',
      'mothername',
      'nationality',
      'dob',
      'email',
      'password',
      'decoded_password',
      'otp',
      'otp_verify',
      'change_password_status',
      'last_login',
      'age',
      'mobile',
      'otp_count'

    ];



}
