<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class InformationMaster extends Authenticatable
{
    use HasFactory;
    //public $timestamps = false;
    protected $table = 'information_incentive_committee';

    protected $fillable = ['district_id','tehsil_id','division_id', 'date_of_committee_formation', 'date_of_registration_renewal_committee', 'bank_name', 'ac_number', 'ifsc_code','status'];
}

