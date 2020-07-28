<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
class Product_status extends Model
{
    protected $guarded=[];
    public function product()
    {
        return $this->belongsToMany('App\Product');
    }
}
