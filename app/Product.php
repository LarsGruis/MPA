<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $fillable = [
    'product_name',
    'product_price',
    'product_qty',
    'category_id',
    'product_photo', 
    'product_detail'
  ];
}
