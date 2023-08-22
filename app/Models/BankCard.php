<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankCard extends Model
{
    protected $table='bank_cards';
    protected $primarykey='id';
    protected $fillable = ['name', 'ifsc', 'account_no', 'state', 'city', 'address', 'mobile', 'email'];
    
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
