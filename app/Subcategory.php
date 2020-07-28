<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Categorie;
class Subcategory extends Model
{
    protected $guarded=[];
    public  function category()
    {
        return $this->has('App\Categorie');
    }
}
