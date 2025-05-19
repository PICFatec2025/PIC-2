<?php

namespace App\Http\Controllers;

use App\Models\Vendas;
use Illuminate\Http\Request;

class VendasController extends Controller
{
    public function index()
    {
        $vendas = Vendas::paginate(20);
        $contagem = Vendas::count();
        return view('vendas.index',compact('vendas','contagem'));
    }
}
