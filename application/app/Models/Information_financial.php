<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class information_financial extends Authenticatable
{
    use HasFactory;
    //public $timestamps = false;
    protected $table = 'information_financial';

    protected $fillable = ['circle_name','district_id','division_id','item_name', 'uttar_pradesh_sports_development','revenue_accounting', 'amount_of_money_spent', 'savings', 'directorate_seventy', 'allegation','status'];
}

