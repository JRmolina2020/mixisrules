<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $fillable = [
        'company_name', 'services', 'landline', 'banking_entity', 'account type', 'account_number'
    ];

    public $timestamps = false;
    public function person()
    {
        return $this->belongsTo('App\Model\Person');
    }
}