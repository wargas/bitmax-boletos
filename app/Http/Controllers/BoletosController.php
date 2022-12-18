<?php

namespace App\Http\Controllers;

use App\Libraries\Boleto;
use App\Models\Boleto as ModelsBoleto;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use \OpenBoleto\Agente;

class BoletosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    //
    public function index(Request $request)
    {
        $documento = $request->get("documento");
        return ModelsBoleto::with('cliente')
            ->whereHas('cliente', function (Builder $query) use ($documento) {
                $query->where('documento', '=', $documento);
            })->get();
    }

    public function print($id)
    {

        $boletoData = ModelsBoleto::find($id);

        /**
         * @var \OpenBoleto\Banco\Santander
         */
        $boleto = Boleto::defaultBoleto();
        $boleto
            ->setDataVencimento(new \DateTime($boletoData->vencimento))
            ->setValor($boletoData->valor)
            ->setSequencial($boletoData->nosso_numero)
            ->setSacado(new Agente(
                $boletoData->cliente->nome,
                $boletoData->cliente->documento,
                $boletoData->cliente->endereco,
                $boletoData->cliente->cep,
                $boletoData->cliente->cidade,
                $boletoData->cliente->uf
            ));
            // dd($boleto->getResourcePath());

             $pdf = Boleto::pdf($boleto);
            return response($pdf, 200, [
                'Content-Type' => 'application/pdf',
            ]);
    }

    public function store()
    {
        return ModelsBoleto::create([
            'cliente_id' => 1,
            'vencimento' => '2022-12-20',
            'nosso_numero' => '002211936912',
            'valor' => 60,
            'status' => 'registrado',
        ]);
    }


    public function carne(Request $request)
    {

        $ids =  explode(",", trim($request->get('ids')));

        $data = ModelsBoleto::with('cliente')
            ->whereIn('id', $ids)
            ->get();

        $boletos = [];

        foreach ($data as $item) {
            /**
             * @var \OpenBoleto\Banco\Santander
             */
            $boleto = Boleto::defaultBoleto();

            $boleto
                ->setDataVencimento(new \DateTime($item->vencimento))
                ->setValor($item->valor)
                ->setSequencial($item->nosso_numero)
                ->setSacado(new Agente(
                    $item->cliente->nome,
                    $item->cliente->documento,
                    $item->cliente->endereco,
                    $item->cliente->cep,
                    $item->cliente->cidade,
                    $item->cliente->uf
                ));

            $boletos[] = $boleto->getData();
        }

        return View('carne', ["boletos" => $boletos]);
    }
}
