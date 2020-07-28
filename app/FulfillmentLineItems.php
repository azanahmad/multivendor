<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FulfillmentLineItems extends Model
{
    public function linked_line_item(){
        return  $this->belongsTo(order_line_items::class,'order_line_item_id');
    }//
}
