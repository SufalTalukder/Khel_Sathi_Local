<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class DivisionDistrictMap extends Authenticatable
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'hostel_div_district_mapping';

    protected $fillable = [
        'division_id',
        'district_id',
    ];
}

