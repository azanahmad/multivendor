<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order_line_items extends Model
{
    function linked_variant()
    {
        return $this->hasOne(Vareint::class,'shopify_id','shopify_variant_id');
    }

    function get_order()
    {
        return $this->hasMany(order::class,'id','order_id');
    }
}
