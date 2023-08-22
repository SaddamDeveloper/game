<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table='orders';
    protected $primarykey='id';
    protected $fillable = ['user_id',	'amount',	'razorpay_payment_id',	'razorpay_order_id',	'razorpay_signature',	'status'];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}