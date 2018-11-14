<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameHistoryModel extends Model
{
    protected $table = 'game_history';
    
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
        'user_id', 'amount', 'result', 'bet_time', 'updated_at', 'created_at'
    ];


}