<?php

namespace App\Http\Controllers;

use App\Libraries\Retorno\Retorno;
use App\Models\Boleto;
use App\Models\Retorno as ModelsRetorno;
use Illuminate\Http\Request;

class RetornoController extends Controller
{

    public function index()
    {

        $retornos = ModelsRetorno::all();

        return $retornos;
    }

    function upload(Request $request)
    {
        $text = file_get_contents($request->file('file'));

        $retorno = new Retorno($text);

        $SegmentosT = $retorno->getSegmentosT();

        foreach ($SegmentosT as $t) {

            if ($t->codigoDeMovimento == '02') {
                $nosso_numero = ltrim($t->identificacaoDoBoletoNoBanco, '0');
                $nosso_numero = substr($nosso_numero, 0, -1);

                $boletoDb = Boleto::where('nosso_numero', $nosso_numero);

                $boletoDb->update([
                    'status' => 'REGISTRADO',
                ]);
            }

            if ($t->codigoDeMovimento == '09') {
                $nosso_numero = ltrim($t->identificacaoDoBoletoNoBanco, '0');
                $nosso_numero = substr($nosso_numero, 0, -1);

                $boletoDb = Boleto::where('nosso_numero', $nosso_numero);

                $boletoDb->update([
                    'status' => 'PAGO',
                ]);
            }
        }

        //$SegmentosU = $retorno->getSegmentosU();

        $SegmentosY = $retorno->getSegmentosY();

        foreach ($SegmentosY as $y) {

            if ($y->codigoDeMovimento == '02') {

                $boletoDb = Boleto::where('txid', $y->txId);

                $boletoDb->update([
                    'url_pix' => $y->chavePixUrlQrCode
                ]);

            }
        }

        $sequencial = $retorno->getHeaderArquivo()->numeroSequencialDoArquivo;

        $retornoDb = ModelsRetorno::create([
            "sequencial" => $sequencial,
            "data_envio" => date("Y-m-d H:i:s")
        ]);

        return $retornoDb;
    }
}
