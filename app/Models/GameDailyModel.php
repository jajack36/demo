<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameDailyModel extends Model
{
    protected $table = 'game_daily';
    
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