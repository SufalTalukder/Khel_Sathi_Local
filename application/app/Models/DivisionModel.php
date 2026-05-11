<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class DivisionModel extends Authenticatable
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'hostel_division_master';

    protected $fillable = [
        'division_name',
        'status'
    ];
}

