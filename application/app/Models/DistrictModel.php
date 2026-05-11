<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class DistrictModel extends Authenticatable
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'cities';

    protected $fillable = [
        'city',
        'state_id',
        'status'
    ];
}

