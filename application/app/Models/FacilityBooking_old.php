<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityBooking_old extends Model
{
    use HasFactory;

 
    protected $table = 'facility_booking_application';

    protected $fillable = [
        'application_no',
        'facility_register_id',
        'services_district_id',
        'services_master_id',
        'address_details',        
        'state',
        'city_id',
        'pincode',
        'services_type',
        'guardian_name',
        'applicant_signature',
        'applicant_photo',
        'applicant_aadhar', 
        'parent_aadhar',
        'parent_signature',
        'age_proof',
        'doctor_certificate', 
        'address_proof',
        'final_submit'
];
}