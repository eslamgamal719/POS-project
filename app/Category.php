<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use translatable;

    protected $guarded = [];

    protected $translatedAttributes = ['name'];

    public $timestamps = false;


    public function products() {
        return $this->hasMany(Product::class);
    }
}
