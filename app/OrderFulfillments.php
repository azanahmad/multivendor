<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderFulfillments extends Model
{
    public function line_items(){
        return $this->hasMany(FulfillmentLineItems::class,'order_fulfillment_id');
    }
}
