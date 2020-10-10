<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use translatable;

    protected $guarded = [];

    protected $translatedAttributes = ['name', 'description'];

    protected $appends = ['image_path', 'profit_percent'];

    public $timestamps = false;



    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function orders() {
        return $this->belongsToMany(Order::class, 'product_order');
    }




    public function getImagePathAttribute() {
        return asset('uploads/product_images/' . $this->image);
    }

    public function getProfitPercentAttribute() {
        $profit = $this->sale_price - $this->purchase_price;
        $profit_percent = $profit * 100 / $this->purchase_price;
        return number_format($profit_percent, 2);
    }







}
