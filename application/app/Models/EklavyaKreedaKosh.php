<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class EklavyaKreedaKosh  extends Authenticatable
{
    use HasFactory;

    protected $table = 'eklavya_krida_kosh_registration';


    protected $fillable = [
      'name',
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
