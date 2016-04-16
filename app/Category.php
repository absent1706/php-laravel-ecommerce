<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
    ];

    public function products()
    {
        return $this->hasMany('App\Product');
    }

    // TODO: backward relation. For this, we should implement our own attribute model that extends original one
    public function attributes()
    {
        return $this->belongsToMany('\Devio\Eavquent\Attribute\Attribute', 'category_attribute');
    }

    public function attributes_prepared()
    {
        // form array [<code> => <entity>]) of all category-related attributes
        $result = [];
        foreach ($this->attributes()->get() as $attribute) {
            $result[$attribute->code] = $attribute;
        }
        return $result;
    }

}
