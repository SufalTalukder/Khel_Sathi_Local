<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class GymnasiumSwimming  extends Authenticatable
{
    use HasFactory;

    protected $table = 'gymnasium_swimming_registration';


    protected $fillable = [
      'name',
      'gender',
      'type',
      'dob',
      'aadhar',
      'mobile',
      'email',
      'password',
      'otp',
      'otp_verify',
      'decoded_password',
      'change_password_status',
      'last_login',
      'status_preview'
    ];
}
