<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TehsilModel extends Authenticatable
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'tehsil_master';

    protected $fillable = [
        'Tehsil_Name',
        'dist_id'
    ];
}

