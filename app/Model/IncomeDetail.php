<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class IncomeDetail extends Model
{
    protected $table = 'entries_details';
    public $timestamps = false;
    protected $fillable = ['entry_id', 'product_id', 'quantity', 'price', 'subtotal'];

    public function entry()
    {
        return $this->belongsTo('App\Model\Entry');
    }
}