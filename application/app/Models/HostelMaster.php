<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class HostelMaster extends Authenticatable
{
    use HasFactory;
    //public $timestamps = false;
    protected $table = 'hostel_master';

    protected $fillable = ['hostel_name', 'division_name', 'districts', 'total_seats', 'boys', 'girls', 'sports', 'seat_used','boys_alloted' ,'girls_alloted', 'ip_address', 'current_user_id' ];
}

