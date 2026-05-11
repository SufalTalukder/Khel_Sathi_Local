<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HostelBasicDetail extends Model
{
    use HasFactory;

    protected $table = 'hostel_application_basic';


    protected $fillable = [
       'hostel_register_id',
       'region_sport_office_id',
       'district_id',
       'sports',
        'sub_sport_type',
       'category',
       'sub_category',
       'aadhar_card_file',
       'father_name',
       'father_occuption',
       'applicant_file',
       'applicant_sign',
       'mother_name',
       'mother_occuption',
       'height',
       'weight',
       'blood_group',
       'class_for_which_admission',

       'applicant_domicle',
       'applicant_dob_certificate',
       'identification_mark',
       'number_of_teeth',
       'disease',
       'medical_certificate_file',
       'admission_no','roll_no','student_id_card','sports_college','national_champtionship_document'

    ];




    public function district()
    {
        return $this->belongsTo(District::class , 'district_id' );
    }


    public function region_office()
    {
        return $this->belongsTo(Region::class , 'region_sport_office_id' );
    }




    public $timestamps = false;
}
