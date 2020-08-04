<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EntriesDetailController extends Controller
{
    public function index($id)
    {
        $income = DB::table('entries_details as i')
            ->join('entries as in', 'i.entry_id', '=', 'in.id')
            ->join('products as p', 'i.product_id', '=', 'p.id')
            ->select(
                'code',
                'name',
                'i.price',
                'unit',
                'i.quantity',
                'i.subtotal',
                'expiration'
            )
            ->where('in.id', '=', $id)
            ->orderBy('i.id', 'desc')->get();
        return $income;
    }
}