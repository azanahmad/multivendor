<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingRates extends Model
{
    protected $fillable =
     [
        'name','shipping_price','type','min','max','zone_id','shipping_time','processing_time','product_id'
     ];

    public function has_zone()
    {
        return $this->belongsTo(Zone::class,'zone_id');
    }
}
