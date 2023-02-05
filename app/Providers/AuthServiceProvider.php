<?php

namespace App\Providers;

use App\Models\Cliente;
use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Auth\GenericUser;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        $this->app['auth']->viaRequest('api', function ($request) {

            $authorization = $request->header('Authorization');

            

            if ($authorization) {
                $token = explode(' ', $authorization)[1];

                

                $key = new Key(env('APP_KEY'), 'HS256');

                
                

                $payload = JWT::decode($token, $key);


                
                if ($payload) {

                    $user = new User();

                    $user->id = $payload->codigo;

                    

                    return $user;
                }

                return null;
            }
        });
    }
}
