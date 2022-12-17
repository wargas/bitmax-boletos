<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClientesController extends Controller
{

    public function index(Request $request) {
        
        return Cliente::with('boletos')
            ->get();
    }

    public function show($id) {
        $cliente = Cliente::find($id);
        $cliente->load('boletos');

        return $cliente;
    }

    public function store()
    {
        return Cliente::create([
            "nome" => "Wargas Delmondes Teixeira",
            "documento" => "08948842471",
            "endereco" => "Rua do Ginásio, Socorro, 72",
            "cep" => "56180-000",
            "cidade" => "Santa Filomena",
            "uf" => "PE"
        ]);
    }
}
