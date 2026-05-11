<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class HostelRegister extends Authenticatable
{
    use HasFactory, Notifiable;


    protected $table = 'hostel_register';


    protected $fillable = [
      'name',
      'dob',
      'aadhar',
      'mobile',
      'email',
      'password',
      'otp',
      'otp_verify',
      'decoded_password',
      'change_password_status',
      'level',
      'remark','status',
      'hostel_alloted_id',
      'gender',
      'last_login',
      'native_of_up',
      'trial_one',
      'trial_two',
      'trial_three',
      'unique_chalan_no','payment_receipt','payment_date','paid_amount','payment_district','branch_name','payment_status','payment_remark','payment_by','payment_on',
      'query_status','existing_student','reason_cancelled','cancel_status'
,'hostel_allotment_letter','payment_allotment_fee_status','payment_allotment_fee_date'
,'session_year'
    ];


    public function applicationBasicDetasils()
    {
        return $this->hasOne(HostelBasicDetail::class , 'hostel_register_id' );
    }


    public function applicationCommunicationDetails()
    {
        return $this->hasOne(HostelCommunicationDetail::class , 'hostel_register_id' );
    }


    public function applicationQualificationDetails()
    {
        return $this->hasOne(HostelQualificationDetail::class , 'hostel_register_id' );
    }


    public function applicationPreviewDetails()
    {
        return $this->hasOne(HostelPreviewDetail::class , 'hostel_register_id' );
    }


    public function markquery()
    {
        return $this->hasMany(MarkQuery::class , 'user_id' )->where('form_type', 7);
    }







}
