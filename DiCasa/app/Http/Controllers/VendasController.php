<?php

namespace App\Http\Controllers;

use App\Models\Vendas;
use Illuminate\Http\Request;

class VendasController extends Controller
{
    public function index()
    {
        $vendas = Vendas::paginate(20);
        return view('vendas.index',compact('vendas'));
    }
}
