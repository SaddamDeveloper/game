<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $table='wallet';
    protected $primarykey='id';
    protected $fillable = [
        'id','user_id','amount'
    ];
}
