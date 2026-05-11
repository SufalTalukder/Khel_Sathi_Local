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
      'mobile'

    ];


    // public function applicationBasicDetasils()
    // {
    //     return $this->hasOne(HostelBasicDetail::class , 'hostel_register_id' );
    // }


    // public function applicationCommunicationDetails()
    // {
    //     return $this->hasOne(HostelCommunicationDetail::class , 'hostel_register_id' );
    // }


    // public function applicationQualificationDetails()
    // {
    //     return $this->hasOne(HostelQualificationDetail::class , 'hostel_register_id' );
    // }


    // public function applicationPreviewDetails()
    // {
    //     return $this->hasOne(HostelPreviewDetail::class , 'hostel_register_id' );
    // }


    // public function markquery()
    // {
    //     return $this->hasMany(MarkQuery::class , 'user_id' )->where('form_type', 7);
    // }




}
