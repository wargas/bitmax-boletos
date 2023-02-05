<?php

namespace App\Http\Controllers;

use App\Libraries\BitmaxBoleto;
use App\Models\Boleto;
use App\Models\Cliente;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class BoletosController extends Controller
{
   
    public function index(Request $request)
    {

        $user = $request->user();

        $documento =  Cliente::where('codigo', $user->id)->first()->cliente_cpf_cnpj;
        
        return Boleto::with('cliente')
            ->whereHas('cliente', function (Builder $query) use ($documento) {
                $query->where('documento', '=', $documento);
            })->get();
    }

    public function print($id)
    {

        $boletoData = Boleto::find($id);

        $boleto = BitmaxBoleto::fromDB($boletoData);

        $pdf = $boleto->pdf();

        return response($pdf, 200, [
            'Content-Type' => 'application/pdf',
        ]);
    }

    public function qrcodepix($id)
    {

        $boletoData = Boleto::find($id);

        $boleto = BitmaxBoleto::fromDB($boletoData);

        return $boleto->qrcodepix();

    }
    
    // public function store()
    // {
    //     return Boleto::create([
    //         'cliente_id' => 1,
    //         'vencimento' => '2022-12-20',
    //         'nosso_numero' => '002211936912',
    //         'valor' => 60,
    //         'status' => 'registrado',
    //     ]);
    // }


    public function carne(Request $request)
    {

        $ids =  explode(",", trim($request->get('ids')));

        $data = Boleto::with('cliente')
            ->whereIn('id', $ids)
            ->get();

        $boletos = [];

        foreach ($data as $item) {
            $boletos[] = BitmaxBoleto::fromDB($item);
        }

        $pdf = BitmaxBoleto::carnes($boletos);

        return response($pdf, 200, [
            'Content-Type' => 'application/pdf',
        ]);
    }
}
