<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function productList(){
        return $this->hasMany(Product::class, 'id');
    }

}
