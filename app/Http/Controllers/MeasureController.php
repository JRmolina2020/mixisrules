<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Measure;

class MeasureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $measures = DB::table('measures')->select('id', 'name')->orderBy('id', 'desc')->get();
        return $measures;
    }
    public function store(Request $request)
    {
        Measure::create([
            'name' => $request['name'],
        ]);
        return response()->json(['message' => 'La unidad de medida ha sido creada'], 200);
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
        $measures = Measure::find($id, ['id', 'name']);
        $measures->fill([
            'name' => request('name'),
        ])->save();
        return response()->json(['message' => 'La unidad de medida ha sido modificada'], 201);
    }
}