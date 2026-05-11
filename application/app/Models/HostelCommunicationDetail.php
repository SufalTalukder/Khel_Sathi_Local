<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HostelCommunicationDetail extends Model
{
    use HasFactory;

    protected $table = 'hostel_application_communication';

    protected $fillable = [
        'hostel_register_id',
        'p_gram_mohalla',
        'c_gram_mohalla',
        'p_post',
        'c_post',
        'p_thana',
        'c_thana',
        'p_state_id',
        'c_state_id',
        'p_district_id',
        'c_district_id',
        'p_mobile',
        'c_mobile',
        'p_alt_mobile',
        'c_alt_mobile',
        'p_email',
        'c_email',
        'p_pin',
        'c_pin',

    ];


    public function pdistrict()
    {
        return $this->belongsTo(District::class, 'p_district_id'  );
    }


    public function cdistrict()
    {
        return $this->belongsTo(District::class,'c_district_id' );
    }


    public function pstate()
    {
        return $this->belongsTo(State::class , 'p_state_id');
    }


    public function cstate()
    {
        return $this->belongsTo(State::class, 'c_state_id' );
    }

    public $timestamps = false;
}
