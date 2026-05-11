<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class RegionalMasterModel extends Authenticatable
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'regional_master';

    protected $fillable = [
        'regional_name',
        'district_id',  
        'status'     
    ];
}
