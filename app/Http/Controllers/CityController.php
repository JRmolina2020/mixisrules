<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{
    public function index($id)
    { {
            // if (!$request->ajax()) return redirect('/');
            $cities = DB::table('cities')
                ->select('id', 'name')
                ->where('departament_id', $id)
                ->orderBy('id', 'desc')->get();
            return $cities;
        }
    }
}