<?php 

namespace App\Http\Controllers;

use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Laravel\Lumen\Http\Request as HttpRequest;

class AuthController extends Controller {

    public function login(Request $request) {
        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where("email", $email)->first();

        if(!$user) {
            return response(["message" => "INVALID_CREDENTIALS"], 200);
        }

        if(!password_verify($password, $user->password)) {
            return response(["message" => "INVALID_CREDENTIALS"], 200);
        }

        $key = env('APP_KEY');

        $jwt = JWT::Encode(["id" => $user->id], $key, 'HS256');

        return ["token" =>  $jwt, "type" => "Bearer"];
    }

    function currentUser(Request $request) {

        $user = $request->user();
        
        return User::find($user->id);

    }

}