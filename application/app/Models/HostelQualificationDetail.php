<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HostelQualificationDetail extends Model
{
    use HasFactory;


    protected $table = 'hostel_application_qualification';

    protected $fillable = [
        'hostel_register_id',
        'class',
        'school_college',
        'passing_year',
        'obtain_mark',
        'total_mark',
        'result'

    ];

    public $timestamps = false;
}
