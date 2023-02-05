<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cliente;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Laravel\Lumen\Http\Request as HttpRequest;

class AuthController extends Controller
{

    public function index()
    {
        return ['API' => 'BIMTAX'];
    }
    public function login(Request $request)
    {
        $login = $request->input('email');
        $password = $request->input('password');

        $user = Cliente::where("cliente_cpf_cnpj", $login)->first();

        if (!$user) {
            return response(["message" => "INVALID_CREDENTIALS"], 200);
        }

        if (!password_verify($password, $user->senhaPortal)) {
            return response(["message" => "INVALID_CREDENTIALS"], 200);
        }

        $key = env('APP_KEY');

        $jwt = JWT::Encode(["codigo" => $user->codigo], $key, 'HS256');

        return ["token" =>  $jwt, "type" => "Bearer"];
    }


    public function login2(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where("email", $email)->first();

        if (!$user) {
            return response(["message" => "INVALID_CREDENTIALS"], 200);
        }

        if (!password_verify($password, $user->password)) {
            return response(["message" => "INVALID_CREDENTIALS"], 200);
        }

        $key = env('APP_KEY');

        $jwt = JWT::Encode(["id" => $user->id], $key, 'HS256');

        return ["token" =>  $jwt, "type" => "Bearer"];
    }


    function currentUser(Request $request)
    {

        $user = $request->user();

        return Cliente::where('codigo', $user->id)->first();
    }
}
