<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;


class DepartamentController extends Controller
{
    public function index()
    { {
            // if (!$request->ajax()) return redirect('/');
            $departaments = DB::table('departaments')->select('id', 'name')->orderBy('id', 'desc')->get();
            return $departaments;
        }
    }
}