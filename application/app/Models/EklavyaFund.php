<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class EklavyaFund extends Authenticatable
{
    use HasFactory;

    protected $table = 'eklavya_fund_registration';




    protected $fillable = [
      'academy_name',
      'sport_name',
      'mobile',
      'email',
      'password',
      'otp',
      'otp_verify',
      'decoded_password',
      'change_password_status'
    ];

    public $timestamps = false;

}
