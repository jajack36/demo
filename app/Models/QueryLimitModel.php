<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QueryLimitModel extends Model
{
    protected $table = 'query_limit';
    
    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'offset', 'limit', 'updated_at', 'created_at'
    ];


}