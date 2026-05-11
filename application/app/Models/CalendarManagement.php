<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class CalendarManagement extends Authenticatable
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'calender_management_info';

    protected $fillable = [
        'header_name',
        'subject_name',
        'type',
        'media_data',
        'remarks'

    ];
}
