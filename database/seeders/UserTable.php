<?php

namespace Database\Seeders;

use App\Models\Boleto;
use App\Models\Cliente;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::create([
        //     "name" => "Wargas Teixeira",
        //     "email" => "teixeira.wargas@gmail.com",
        //     "password" => password_hash('123456', PASSWORD_DEFAULT)
        // ]);

        // Cliente::create([
        //     "nome" => "Wargas Delmondes Teixeira",
        //     "documento" => "08948842471",
        //     "endereco" => "Rua Prefeito Pedro Sobrinho",
        //     "bairro" => "Centro",
        //     "cep" => "56180000",
        //     "cidade" => "Cabrobo",
        //     "uf" => "PE"
        // ]);

        // Cliente::create([
        //     "nome" => "Mailza de Oliveira Alves",
        //     "documento" => "11730815421",
        //     "endereco" => "Rua Prefeito Pedro Sobrinho",
        //     "bairro" => "Centro",
        //     "cep" => "56180000",
        //     "cidade" => "Cabrobo",
        //     "uf" => "PE"
        // ]);

        // Cliente::create([
        //     "nome" => "LEONARDO PEREIRA DE SOUSA",
        //     "documento" => "09458103428",
        //     "endereco" => "RUA CLARINDA CLARICE DE SOUZA",
        //     "bairro" => "Socorro",
        //     "cep" => "56210000",
        //     "cidade" => "Santa Filomena",
        //     "uf" => "PE"
        // ]);

        // Cliente::create([
        //     "nome" => "MARIA DIANA DA PAZ",
        //     "documento" => "06357009482",
        //     "endereco" => "RUA CLARINDA CLARICE DE SOUZA",
        //     "bairro" => "Socorro",
        //     "cep" => "56210000",
        //     "cidade" => "Santa Filomena",
        //     "uf" => "PE"
        // ]);
        $clientes = Cliente::all();

        $start = Carbon::createFromDate(2023, 1, 5);
        $codigo  = 105;

        for ($i = 1; $i < 12; $i++) {
            $vencimento = $start->addMonth(1)->format("Y-m-d");

            foreach($clientes as $cliente) {
                Boleto::create([
                    "codigo" => $codigo,
                    "cliente_id" => $cliente->id,
                    "vencimento" => $vencimento,
                    "nosso_numero" => $codigo + 100,
                    "valor" => 60,
                    "status" => "PENDENTE"
                ]);  
                $codigo ++;          
            }
        }
    }
}
