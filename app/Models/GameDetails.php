<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameDetails extends Model
{
    protected $table='game_details';
    protected $primarykey='id';
    protected $fillable = [
        'id','game_id','type','game_value','color','status'
    ];
}
