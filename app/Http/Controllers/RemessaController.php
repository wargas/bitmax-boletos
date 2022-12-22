<?php

namespace App\Http\Controllers;

use App\Libraries\Remessa\Lines\LineHeaderArquivo;
use App\Libraries\Remessa\Lines\LineHeaderLote;
use App\Libraries\Remessa\Lines\LineP;
use App\Libraries\Remessa\Lines\LineQ;
use App\Libraries\Remessa\Lines\LineTrailerArquivo;
use App\Libraries\Remessa\Lines\LineTrailerLote;
use App\Libraries\Remessa\Lines\LineY03;
use App\Libraries\Remessa\Remessa;
use App\Libraries\Retorno\Retorno;
use App\Models\Boleto;
use App\Models\Remessa as ModelsRemessa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RemessaController extends Controller
{

    function index()
    {
        return ModelsRemessa::all();
    }

    function show()
    {
    }

    function retorno(Request $request)
    {
        $text = file_get_contents($request->file('file'));

        $retorno = new Retorno($text);

        $SegmentosY = $retorno->getSegmentosY();

        foreach ($SegmentosY as $r) {

            $boletoDb = Boleto::where('txid', $r->txId);

            $boletoDb->update([
                'url_pix' => $r->chavePixUrlQrCode
            ]);
        }

        return ['message' => 'Success'];

    }

    function store()
    {
        $boletos = Boleto::with('cliente')->where('status', 'PENDENTE')->get();
        $lastRemessa = DB::query()->selectRaw('max(sequencial) as last')->from('remessas')->first()->last;

        $sequencial = $lastRemessa ? $lastRemessa + 1 : 1;

        $remessa = new Remessa();

        $line_h_arquivo = new LineHeaderArquivo();
        $line_h_arquivo->setDataGeracaoArquivo(date("dmY"));
        $line_h_arquivo->setNumeroSequencialArquivo(1);

        $line_h_lote = new LineHeaderLote();
        $line_h_lote->setNumeroRemessaRetorno(1);
        $line_h_lote->setDataGravacaoRemessaRetorno(date("dmY"));

        $remessa->addLines($line_h_arquivo, $line_h_lote);

        $sequencialLote = 1;

        foreach ($boletos as $index => $boleto) {

            $vencimento = Carbon::createFromFormat('Y-m-d', $boleto->vencimento)->format('dmY');
            $emissao = Carbon::now()->format('dmY');

            $line_p = new LineP();
            $line_p->setNumeroSequencialRegistroLote($sequencialLote);
            $line_p->setValorNominalBoleto(number_format($boleto->valor, 2, '', ''));
            $line_p->setIdentificacaoBoletoNoBanco($boleto->nosso_numero);
            $line_p->setNumeroDocumento($boleto->codigo); //id fatura
            $line_p->setDataVencimentoBoleto($vencimento);
            $line_p->setDataEmissaoBoleto($emissao); //pegar do banco
            $line_p->setValorNominalBoleto(number_format($boleto->valor, 2, '', ''));
            $line_p->setDataJurosMora($vencimento); //igual o vencimento

            $sequencialLote++;

            $line_q = new LineQ();
            $line_q
                ->setNumeroSequencialRegistroLote($sequencialLote)
                ->setTipoInscricaoPagador(1)
                ->setNumeroInscricaoPagador($boleto->cliente->documento)
                ->setNomePagador($boleto->cliente->nome)
                ->setEnderecoPagador($boleto->cliente->endereco)
                ->setBairroPagador($boleto->cliente->bairro)
                ->setCepPagador(substr($boleto->cliente->cep, 0, 5))
                ->setSufixoCepPagador(substr($boleto->cliente->cep_sufixo, 5, 3))
                ->setCidadePagador($boleto->cliente->cidade)
                ->setUnidadeFederacaoPagador($boleto->cliente->uf);

            $sequencialLote++;

            $line_y = new LineY03();
            $line_y->setNumeroSequencialRegistroLote($sequencialLote);
            $line_y->setIdentificacaoBoletoNoBanco($boleto->txid);

            $sequencialLote++;

            $remessa
                ->addLine($line_p)
                ->addLine($line_q)
                ->addLine($line_y);
        }

        $line_t_lote = new LineTrailerLote();
        $line_t_lote->setQuantidadeRegistrosLote((count($boletos) * 3) + 2);

        $line_t_arquivo = new LineTrailerArquivo();
        $line_t_arquivo->setQuantidadeLotesArquivo(1);
        $line_t_arquivo->setQuantidadeRegistrosArquivo((count($boletos) * 3) + 4);

        $remessa->addLines($line_t_lote, $line_t_arquivo);

        date_default_timezone_set("America/Recife");

        $remessaDb = ModelsRemessa::create([
            "sequencial" => $sequencial,
            "data_criacao" => date("Y-m-d H:i:s"),
            "status" => "PENDENTE"
        ]);

        Storage::disk('local')->put("remessas/remessa-{$remessaDb->id}.txt", $remessa->getText());

        return $remessaDb;
    }

    public function download($id)
    {
        $file = Storage::disk('local')->get("remessas/remessa-{$id}.txt");

        return response($file, 200, [
            'Content-Disposition' => 'attachment; filename="filename.jpg"'
        ]);
    }
}
