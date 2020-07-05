<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'type_person', 'regimen_type', 'responsible_iva', 'business_name', 'tributary_information'
    ];

    public $timestamps = false;
    public function person()
    {
        return $this->belongsTo('App\Model\Person');
    }
}