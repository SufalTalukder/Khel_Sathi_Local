<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class MonthlyInformationModel extends Authenticatable
{
    use HasFactory;
    //public $timestamps = false;
    protected $table = 'information_monthly_report';

    protected $fillable = ['district_id', 'opening_balance_of_financial', 'amount_received', 'amount_spent', 'total_balance_deposited_current_month', 'total_amount_received_current_month','total_amount_received_lastyear','date_total_amount_received', 'increase', 'decrease','status','tehsil_id'];
}
