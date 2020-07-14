<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'categorie_id', 'code', 'name', 'sale_price', 'description', 'expiration', 'unit'
    ];

    function categorie()
    {
        return $this->belongsTo('App\Model\Categorie');
    }
}