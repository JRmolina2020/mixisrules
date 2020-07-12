<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'user_id', 'name', 'type', 'amount'
    ];

    function user()
    {
        return $this->belongsTo('App\User');
    }
}