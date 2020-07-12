<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Expense;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class ExpenseController extends Controller
{
    public function index()
    {


        $expenses = Expense::join('users', 'expenses.user_id', '=', 'users.id')
            ->select('expenses.id', 'user_id', 'type', 'expenses.name', 'amount', 'users.name as user_name', 'users.surname')
            ->whereDate('expenses.created_at', '=', Carbon::now()->format('Y-m-d'))
            ->orderBy('expenses.id', 'desc')->get();
        return $expenses;
    }
    public function indexOne()
    {
        $expenses = Expense::join('users', 'expenses.user_id', '=', 'users.id')
            ->select('expenses.id', 'user_id', 'type', 'expenses.name', 'amount', 'users.name as user_name', 'users.surname')
            ->where('user_id', Auth::user()->id)
            ->whereDate('expenses.created_at', '=', Carbon::now()->format('Y-m-d'))
            ->orderBy('expenses.id', 'desc')->get();
        return $expenses;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Expense::create([
            'user_id' => Auth::user()->id,
            'type' => $request['type'],
            'name' => $request['name'],
            'amount' => $request['amount'],
        ]);
        return response()->json(['message' => 'El gasto ha sido registrado'], 200);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $expenses = Expense::find($id);
        $expenses->fill([
            'type' => request('type'),
            'name' => request('name'),
            'amount' => request('amount'),
        ])->save();
        return response()->json(['message' => 'EL Gasto ha sido modificado'], 201);
    }
}