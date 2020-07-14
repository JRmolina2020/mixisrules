<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Measure extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name',
    ];
}