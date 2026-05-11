<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarkQuery extends Model
{
    use HasFactory;

    protected $table = 'query_master';


    public function queryReplies()
    {
        return $this->hasMany(QueryRepply::class , 'query_id' );
    }
}
