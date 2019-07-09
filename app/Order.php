<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        
    ];

   public function orderItems() {
   		return $this->hasMany('App\OrderItem');
   }
}
