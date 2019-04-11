<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id', 'name' , 'description' ,'images','file','price','type','price_paypal','time_play','icon'];
}
