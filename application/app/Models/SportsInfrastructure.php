<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class SportsInfrastructure extends Authenticatable
{
    use HasFactory;
    //public $timestamps = false;
    protected $table = 'information_sports_infrastructure';

    protected $fillable = ['district_id', 'name_of_game_setup', 'year_of_establishment', 'sports_infrastructure_cost', 'name_of_executing_agency'];
}

