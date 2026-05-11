<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
  
class EmployeeModel extends Model {

    use HasFactory;
    protected $table = 'employee';

    protected $fillable = [
      'employee_name',	'employee_mother',	'employee_father',	
      'employee_email',	'employee_mobile',	'employee_designation',	
      'employee_dob',	'employee_rank',	'year_of_appointment',	
      'employee_gender',	'employee_id',	'created_by','updated_by'
    ];
}