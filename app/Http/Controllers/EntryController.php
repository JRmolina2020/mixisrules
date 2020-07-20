<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EntryController extends Controller
{
    public function index()
    {
        $income = DB::table('income as i')
            ->join('users as u', 'i.user_id', '=', 'u.id')
            ->join('providers as p', 'i.provider_id', '=', 'p.id')
            ->join('people as pe', 'pe.id', '=', 'p.id')

            ->select(
                'i.id',
                'pe.document',
                'p.company_name',
                'pe.name AS provider_name',
                'pe.surname AS provider_surname',
                'u.name  AS user_name',
                'u.surname AS user_surname',
                'i.total',
                'i.status',
                'i.created_at'
            )
            ->orderBy('i.id', 'desc')->get();
        return $income;
    }
}