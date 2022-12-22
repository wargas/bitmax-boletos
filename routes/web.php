<?php

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', [function(Request $request) {
    $vencimento = Carbon::createFromFormat("Y-m-d", "2022-01-01");
    return $vencimento->format('d/m/Y');
}]);

$router->get('/api/v1/carne', 'BoletosController@carne');
$router->get('/api/v1/boletos/print/{id}', 'BoletosController@print');

$router->group(['prefix' => 'api/v1', 'middleware' => 'auth'], function () use($router) {
    $router->get('/clientes', 'ClientesController@index');
    $router->get('/clientes/{id}', 'ClientesController@show');
    $router->post('/clientes', 'ClientesController@store');
    $router->get('/boletos', 'BoletosController@index');
    // $router->get('/boletos/print/{id}', 'BoletosController@print');
    $router->post('/boletos', 'BoletosController@store');
    $router->get('/me', 'AuthController@currentUser');
    $router->get('/remessas', 'RemessaController@index');
    $router->get('/remessas/download/{id}', 'RemessaController@download');
    $router->post('/remessas/retorno', 'RemessaController@retorno');
    $router->post('/remessas', 'RemessaController@store');
    //Retorno
    $router->get('/retornos', 'RetornoController@index');
    $router->post('/retornos/upload', 'RetornoController@upload');
});


$router->post('/api/v1/auth', 'AuthController@login');


