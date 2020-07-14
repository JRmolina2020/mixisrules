<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (!$request->ajax()) return redirect('/');
        $products = Product::join('categories', 'products.categorie_id', '=', 'categories.id')
            ->select(
                'products.id',
                'products.code',
                'products.name',
                'products.sale_price',
                'products.stock',
                'products.description',
                'products.expiration',
                'products.unit',
                'products.status',
                'categories.name as name_categorie',
                'categories.id as idc'
            )
            ->orderBy('products.id', 'desc')->get();
        return $products;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Product::create([
            'categorie_id' => $request['categorie_id'],
            'code' => $request['code'],
            'name' => $request['name'],
            'type_product' => $request['type_product'],
            'sale_price' => $request['sale_price'],
            'description' => $request['description'],
            'expiration' => $request['expiration'],
            'unit' => $request['unit']
        ]);
        return response()->json(['message' => 'El producto ha sido creado'], 200);
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
        $products = Product::find($id, ['id', 'code', 'name', 'sale_price', 'description', 'expiration', 'unit']);
        $products->fill([
            'categorie_id' => $request['categorie_id'],
            'code' => request('code'),
            'name' => request('name'),
            'sale_price' => request('sale_price'),
            'description' => request('description'),
            'expiration' => request('expiration'),
            'unit' => request('unit')
        ])->save();
        return response()->json(['message' => 'El producto ha sido modificado'], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function available($id)
    {
        $products = Product::findOrFail($id, ['id']);
        $products->status = '1';
        $products->save();
        return response()->json(["message" => "Ha sido activado"]);
    }
    public function locked($id)
    {
        $products = Product::findOrFail($id, ['id']);
        $products->status = '0';
        $products->save();
        return response()->json(["message" => "Ha sido Bloqueado"]);
    }
}