<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    public function has_orders(){
        return $this->hasMany(order::class,'customer_id');
    }
}
