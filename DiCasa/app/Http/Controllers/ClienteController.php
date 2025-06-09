<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index(){
        $clientes = Cliente::with('telefones')->with('enderecos')->paginate(15);
        return view('consultar_clientes',compact('clientes'));
    }
}
