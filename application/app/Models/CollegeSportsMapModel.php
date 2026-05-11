<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CollegeSportsMapModel extends Authenticatable  
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'college_sports_mapping';

    protected $fillable = [
        'college_id',
        'sports_id',
        'gender'
    ];
}

