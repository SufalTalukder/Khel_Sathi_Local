<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SportModelMaster extends Authenticatable
{
    use HasFactory;
     
    protected $table = 'sports_college_master';
    protected $fillable = [ 

    	'college_name', 'college_address', 'districts_id', 'districts_id', 'ip_address', 'current_user_id', 'gender'
    ];
}

