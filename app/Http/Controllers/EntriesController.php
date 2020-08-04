<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Entry;
use App\Model\IncomeDetail;
use Exception;
use Illuminate\Support\Facades\Auth;

class EntriesController extends Controller
{
    public function index()
    {
        $income = DB::table('entries as i')
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
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try {
            DB::beginTransaction();
            $entry = new Entry();
            $entry->provider_id = $request->provider_id;
            $entry->user_id  = Auth::user()->id;
            $entry->total = $request->total;
            $entry->save();
            $details = $request->products;
            foreach ($details as $ep => $det) {
                $details = new IncomeDetail();
                $details->entry_id = $entry->id;
                $details->product_id = $det['product_id'];
                $details->quantity = $det['quantity'];
                $details->price = $det['price'];
                $details->subtotal = $det['subtotal'];
                $details->save();
            }
            DB::commit();
            return response()->json(['message' => 'La compra de productos ha sido registrada'], 200);
        } catch (Exception $e) {
            DB::rollBack();
        }
    }
}