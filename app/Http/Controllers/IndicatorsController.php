<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Model\Client;
use Illuminate\Support\Facades\DB;

class IndicatorsController extends Controller
{
    public function countuser()
    {
        $countUser = User::all()->count();
        $countClient = Client::all()->count();
        $totalExpenses = DB::table('expenses')
            ->select(DB::raw('SUM(amount) as tot'))
            ->get();
        $totalExpenses = $totalExpenses[0]->tot;
        return view('home', compact('countUser', 'countClient', 'totalExpenses'));
    }
}