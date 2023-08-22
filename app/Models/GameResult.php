<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameResult extends Model
{
    protected $table = 'game_result';
    protected $primarykey = 'id';
    protected $fillable = ['game_play_id', 'number_game_details_id', 'color_game_details_id','ending_game_details_id'];

    public function gamePlay()
    {
        return $this->belongsTo('App\Models\GamePlay', 'game_play_id', 'id');
    }
    public function numberGameDetails()
    {
        return $this->belongsTo('App\Models\GameDetails', 'number_game_details_id', 'id');
    }
    public function colorGameDetails()
    {
        return $this->belongsTo('App\Models\GameDetails', 'color_game_details_id', 'id');
    }

    public function endingGameDetails()
    {
        return $this->belongsTo('App\Models\GameDetails', 'ending_game_details_id', 'id');
    }
}
