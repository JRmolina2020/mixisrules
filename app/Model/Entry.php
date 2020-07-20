<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    protected $fillable = [
        'provider_id', 'user_id', 'total'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function provider()
    {
        return $this->belongsTo('App\Model\Provider');
    }

    function incomedetails()
    {
        return $this->hasMany('App\Model\IncomeDetail');
    }
}