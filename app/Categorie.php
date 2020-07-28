<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\Subcategory;
class Categorie extends Model
{
    protected $guarded = [];
    public function product()
    {
        return $this->belongsToMany('App\Product');
    }
    public  function subcategory()
    {
        return $this->hasMany('App\Subcategory');
    }
}
