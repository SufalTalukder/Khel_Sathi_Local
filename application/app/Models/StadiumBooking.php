<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StadiumBooking extends Model
{
    use HasFactory;
    protected $table = 'facility_booking_stadium';

    protected $fillable = [
        'user_id',
        'fullname',
        'mobile_no',
        'email_id',
        'date_from',
        'date_to',
        'purpose'
    ];
}