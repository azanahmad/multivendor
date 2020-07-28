<?php

namespace App;


use App\Traits\ProductVarientTrait;
use Illuminate\Database\Eloquent\Model;
use App\Product_status;
use App\User;
use App\Vareint;
use App\Shipping_zone;

class Product extends Model
{

    use ProductVarientTrait;

    protected $fillable = [
        'vendor_id', 'Title', 'Discription', 'Price', 'Compare_price', 'Image', 'SKU', 'Barcode', 'Quantity', 'Weight', 'County/zone', 'vendor_status', 'categories', 'sub_categories'
        ,'option_name1','option_name2','option_name3'
    ];

    public function categories()
    {
        return $this->belongsToMany('App\Categorie', 'product_categories', 'product_id', 'category_id');
    }

    public function varients()
    {
        return $this->hasMany('App\Vareint');
    }

    public function product_status()
    {
        return $this->hasOne('App\Product_status');
    }

    public function vendor()
    {
        return $this->belongsTo('App\User');
    }

    public function shipping()
    {
        return $this->hasOne('App\Shipping');
    }

    public function rate()
    {
        return $this->hasOne(Shipping_rate::class);
    }
    public function has_image()
    {
        return $this->hasMany('App\Product_imageModel','product_id','id');
    }


    function has_order_line_items()
    {
        return $this->hasMany(order_line_items::class,'shopify_product_id','shopify_id');
    }

}

