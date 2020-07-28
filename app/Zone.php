<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    protected $fillable =[
        'name','product_id'
    ];


    public function has_countries(){
        return $this->belongsToMany(Countries::class,'country_zones','zone_id','country_id');
    }



    public function has_rate(){
        return $this->hasMany('App\ShippingRates','zone_id');
    }
}
