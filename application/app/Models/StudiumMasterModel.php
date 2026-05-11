<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class StudiumMasterModel extends Authenticatable
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'studium_master';

    protected $fillable = [
        'studium_name',
        'district_id',
        'latitude',
        'longitude',
    ];
}

