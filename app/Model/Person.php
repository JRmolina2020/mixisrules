<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $fillable = [
        'type_document', 'document', 'prefix', 'is_client', 'name', 'surname',
        'email', 'telephone', 'departament_id', 'city_id', 'direction'
    ];



    public function client()
    {
        return $this->hasOne('App\Model\Client');
    }
    public function provider()
    {
        return $this->hasOne('App\Model\Provider');
    }
}