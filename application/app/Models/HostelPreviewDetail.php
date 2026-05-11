<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HostelPreviewDetail extends Model
{
    use HasFactory;


    protected $table = 'hostel_application_preview';

    protected $fillable = [
        'hostel_register_id',
        'guardian_name',
        'guardian_sign',
        'confirm'
  
    ];

    public $timestamps = false;
}
