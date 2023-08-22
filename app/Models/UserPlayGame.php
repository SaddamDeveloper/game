<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPlayGame extends Model
{
    protected $table = 'user_play_game';
    protected $primarykey = 'id';
    protected $fillable = [
        'id', 'game_play_id', 'user_id', 'game_details_id', 'quantity', 'status', 'amount'
    ];

    /**
     * Get the user that owns the UserPlayGame
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gamePlay()
    {
        return $this->belongsTo(GamePlay::class, 'game_play_id', 'id');
    }

    /**
     * Get the user that owns the UserPlayGame
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gameDetails()
    {
        return $this->belongsTo(GameDetails::class, 'game_details_id', 'id');
    }

    /**
     * Get the user that owns the UserPlayGame
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function colorGame()
    {
        return $this->belongsTo(GameDetails::class, 'game_details_id', 'id')->where('game_id', 2)->where('type', 1);
    }

    public function numberGame()
    {
        return $this->belongsTo(GameDetails::class, 'game_details_id', 'id')->where('game_id', 2)->where('type', 2);
    }
    public function endingGame()
    {
        return $this->belongsTo(GameDetails::class, 'game_details_id', 'id')->where('game_id', 2)->where('type', 3);
    }
}
