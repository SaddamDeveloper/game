<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GamePlay extends Model
{
    protected $table='game_play';
    protected $primarykey='id';
    protected $fillable = [
        'id','game_id','status'
    ];

    /**
     * Get the user that owns the GamePlay
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id', 'id');
    }

    /**
     * Get all of the comments for the GamePlay
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userGamePlay()
    {
        return $this->hasMany(UserPlayGame::class);
    }

    /**
     * Get the user associated with the GamePlay
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function gameResult()
    {
        return $this->hasOne(GameResult::class);
    }
}
