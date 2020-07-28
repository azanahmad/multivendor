<?php

namespace App;

use App\Traits\OrderTrait;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use OrderTrait;

    function line_items()
    {
      return  $this->hasMany(order_line_items::class,'order_id','id');
    }

    public function fulfillments(){
        return $this->hasMany('App\OrderFulfillments','order_id');
    }

    public function has_payment(){
        return $this->hasOne('App\OrderTransaction','retailer_order_id');
    }
}
