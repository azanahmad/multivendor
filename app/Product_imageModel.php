<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_imageModel extends Model
{


    protected $table = 'product_images';
    protected $fillable = [
        'product_id','src'
    ];
}
