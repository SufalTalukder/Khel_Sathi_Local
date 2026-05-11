<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class SportModel extends Authenticatable
{
    use HasFactory;
    
    protected $table = 'sport_type';
    protected $fillable = [

    	'name', 'status','ip_address','current_user_id'
    ];
}

