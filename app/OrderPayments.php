<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderPayments extends Model
{
    function has_order()
    {
        return $this->hasOne(order::class,'id','order_id');
    }

    function has_vendor()
    {
        return $this->hasOne(User::class,'id','vendor_id');
    }
}
