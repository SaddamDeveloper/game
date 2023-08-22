<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table='game';
    protected $primarykey='id';
    protected $fillable = [
        'id','name','status','winning_amount','price'
    ];

    /**
     * Get all of the comments for the Game
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gamePlay()
    {
        return $this->hasOne(GamePlay::class);
    }

    /**
     * Get all of the comments for the Game
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gameDetails()
    {
        return $this->hasMany(GameDetails::class);
    }
    
}
