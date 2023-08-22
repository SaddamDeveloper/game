<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    protected $table='withdrawals';
    protected $primarykey='id';
    protected $fillable = ['user_id', 'amount', 'status'];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

   public function bankCard()
   {
       return $this->belongsTo('App\Models\BankCard', 'account', 'account_no');
   }
}
