<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Vareint extends Model
{
    protected $guarded=[];
    public function pro()
    {
        return $this->belongsTo('App\Product');
    }

    public function has_image()
    {
        return $this->hasOne('App\Product_imageModel','id','Image');
    }
}
