<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use \Devio\Eavquent\Eavquent;

    protected $fillable = [
        'category_id',
        'sku',
        'name',
        'price',
        'description',
        'qty',
        'sale_price',
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function category_attributes()
    {
        return $this->category()->first()->attributes();
    }
}
