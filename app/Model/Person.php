<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $fillable = [
        'type_document', 'document', 'prefix', 'is_client', 'name', 'surname',
        'email', 'telephone', 'city_id', 'direction'
    ];

    public function client()
    {
        return $this->hasOne('App\Model\Client');
    }
}