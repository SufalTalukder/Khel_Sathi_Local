<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class PrivateCoaching extends Authenticatable
{
    use HasFactory;

    protected $table = 'private_coaching_register';




    protected $fillable = [
      'name',
      'mobile',
      'email',
      'password',
      'otp',
      'aadhar_no',
      'designation',
      'otp_verify',
      'decoded_password',
      'change_password_status',
      'regsistered_on',
      'final_submit',
      'final_submit_on',
      'otp_count'
    ];

    public $timestamps = false;

}
