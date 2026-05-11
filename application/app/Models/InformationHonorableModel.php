<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class informationHonorableModel extends Authenticatable
{
    use HasFactory;
    //public $timestamps = false;
    protected $table = 'information_honorable';

    protected $fillable = ['year_name','month_name','district_id', 'name_of_honorable', 'date_of_receipt_of_letter', 'subject_of_letter', 'details_of_action_taken', 'date_of_informing_honble_mp','honble_mp_action_taken','status','tehsil_id'];
}

