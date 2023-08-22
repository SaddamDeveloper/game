<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WalletHistory extends Model
{
    protected $table='wallet_history';
    protected $primarykey='id';
    protected $fillable = [
        'id','user_id','comment','amount','total'
    ];
}
