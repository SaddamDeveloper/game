<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    protected $table='user';
   
    protected $fillable = [
        'username', 'referrer_id', 'name', 'nick_name', 'email','password','mobile','state','city','pin','gender','address','status'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function wallet()
    {
        return $this->hasOne('App\Models\Wallet');
    }

    public function bankCard()
    {
        return $this->hasMany('App\Models\BankCard');
    }

    public function order()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function referrer()
    {
        return $this->belongsTo(User::class, 'referrer_id', 'id');
    }

    public function referrals()
    {
        return $this->hasMany(User::class, 'referrer_id', 'id');
    }

    /**
     * Get all of the comments for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userPlayGame()
    {
        return $this->hasMany(UserPlayGame::class);
    }
}
