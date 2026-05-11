<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class OrganizedCompetition extends Authenticatable
{
    use HasFactory;
    //public $timestamps = false;
    protected $table = 'information_organized_competition';

    protected $fillable = ['month_name','year_name','district_id', 'organized_competition_name', 'spending_amount', 'year_of_event','status','tehsil_id'];
}
