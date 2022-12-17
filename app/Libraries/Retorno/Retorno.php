<?php

namespace App\Libraries\Retorno;


class Retorno
{

    private $lineHeaderArquivo;
    private $lineHeaderLote;

    private $linesT = [];
    private $linesU = [];

    public function __construct(string $texto)
    {
        $lines = explode("\r\n", $texto);

        $this->lineHeaderArquivo = $lines[0];
        $this->lineHeaderLote = $lines[1];

        $this->lineTrailerLote = $lines[count($lines) - 3];
        $this->lineTrailerArquivo = $lines[count($lines) - 2];

        foreach ($lines as $line) {
            $segmento = substr($line, 13, 1);
            if ($segmento == 'T') {
                $this->linesT[] = $line;
            }
            if ($segmento == 'U') {
                $this->linesU[] = $line;
            }
        }
    }

    public function getHeaderArquivo()
    {
        $arquivo = new \stdClass();

        $arquivo->codigoDoBancoNaCompensacao = $this->getValue($this->lineHeaderArquivo, 1, 3, 'N');
        $arquivo->loteDeServico = $this->getValue($this->lineHeaderArquivo, 4, 7, 'N');
        $arquivo->tipoDeRegistro = $this->getValue($this->lineHeaderArquivo, 8, 8, 'N');
        $arquivo->tipoDeInscricaoDaEmpresa = $this->getValue($this->lineHeaderArquivo, 17, 17, 'N');
        $arquivo->numeroDeInscricaoDaEmpresa = $this->getValue($this->lineHeaderArquivo, 18, 32, 'N');
        $arquivo->agenciaDoBeneficiario = $this->getValue($this->lineHeaderArquivo, 33, 36, 'N');
        $arquivo->digitoDaAgenciaDoBeneficiario = $this->getValue($this->lineHeaderArquivo, 37, 37, 'N');
        $arquivo->numeroDaContaCorrente = $this->getValue($this->lineHeaderArquivo, 38, 46, 'N');
        $arquivo->digitoVerificadorDaConta = $this->getValue($this->lineHeaderArquivo, 47, 47, 'N');
        $arquivo->codigoDoBeneficiario = $this->getValue($this->lineHeaderArquivo, 53, 61, 'N');
        $arquivo->nomeDaEmpresa = $this->getValue($this->lineHeaderArquivo, 73, 102, 'A');
        $arquivo->nomeDoBanco = $this->getValue($this->lineHeaderArquivo, 103, 132, 'A');
        $arquivo->codigoRemessaRetorno = $this->getValue($this->lineHeaderArquivo, 143, 143, 'N');
        $arquivo->dataDeGeracaoDoArquivo = $this->getValue($this->lineHeaderArquivo, 144, 151, 'N');
        $arquivo->numeroSequencialDoArquivo = $this->getValue($this->lineHeaderArquivo, 158, 163, 'N');
        $arquivo->numeroDaVersaoDoLayoutDoArquivo = $this->getValue($this->lineHeaderArquivo, 164, 166, 'N');

        return $arquivo;
    }

    public function getHeaderLote()
    {
        $arquivo = new \stdClass();

        $arquivo->codigoDoBancoNaCompensacao = $this->getValue($this->lineHeaderLote, 1, 3, 'N');
        $arquivo->numeroDoLoteRetorno = $this->getValue($this->lineHeaderLote, 4, 7, 'N');
        $arquivo->tipoDeRegistro = $this->getValue($this->lineHeaderLote, 8, 8, 'N');
        $arquivo->tipoDeOperacao = $this->getValue($this->lineHeaderLote, 9, 9, 'A');
        $arquivo->tipoDeServico = $this->getValue($this->lineHeaderLote, 10, 11, 'N');
        $arquivo->numeroDaVersaoDoLayoutDoLote = $this->getValue($this->lineHeaderLote, 14, 16, 'N');
        $arquivo->tipoDeInscricaoDaEmpresa = $this->getValue($this->lineHeaderLote, 18, 18, 'N');
        $arquivo->numeroDeInscricaoDaEmpresa = $this->getValue($this->lineHeaderLote, 19, 33, 'N');
        $arquivo->codigoDoBeneficiario = $this->getValue($this->lineHeaderLote, 34, 42, 'N');
        $arquivo->agenciaDoBeneficiario = $this->getValue($this->lineHeaderLote, 54, 57, 'N');
        $arquivo->digitoDaAgenciaDoBeneficiario = $this->getValue($this->lineHeaderLote, 58, 58, 'N');
        $arquivo->numeroDaContaDoBeneficiario = $this->getValue($this->lineHeaderLote, 59, 67, 'N');
        $arquivo->digitoVerificadorDaConta = $this->getValue($this->lineHeaderLote, 68, 68, 'N');
        $arquivo->nomeDaEmpresa = $this->getValue($this->lineHeaderLote, 74, 103, 'A');
        $arquivo->numeroDoRetorno = $this->getValue($this->lineHeaderLote, 184, 191, 'N');
        $arquivo->dataDaGravacaoRemessaRetorno = $this->getValue($this->lineHeaderLote, 192, 199, 'N');


        return $arquivo;
    }

    public function getSegmentosT()
    {

        $segmentos = [];

        foreach ($this->linesT as $line) {

            $segmento = new \stdClass();

            $segmento->codigoDoBancoNaCompensacao = $this->getValue($line, 1, 3, 'N');
            $segmento->numeroDoLoteRetorno = $this->getValue($line, 4, 7, 'N');
            $segmento->tipoDeRegistro = $this->getValue($line, 8, 8, 'N');
            $segmento->numeroSequencialDoRegistroNoLote = $this->getValue($line, 9, 13, 'N');
            $segmento->codSegmentoDoRegistroDetalhe = $this->getValue($line, 14, 14, 'A');
            $segmento->codigoDeMovimento = $this->getValue($line, 16, 17, 'A');
            $segmento->agenciaDoBeneficiario = $this->getValue($line, 18, 21, 'N');
            $segmento->digitoDaAgenciaDoBeneficiario = $this->getValue($line, 22, 22, 'N');
            $segmento->numeroDaContaCorrente = $this->getValue($line, 23, 31, 'N');
            $segmento->digitoVerificadorDaConta = $this->getValue($line, 32, 32, 'N');
            $segmento->identificacaoDoBoletoNoBanco = $this->getValue($line, 41, 53, 'N');
            $segmento->codigoDaCarteira = $this->getValue($line, 54, 54, 'A');
            $segmento->numeroDoDocumentoDeCobranca = $this->getValue($line, 55, 69, 'A');
            $segmento->dataDoVencimentoDoBoleto = $this->getValue($line, 70, 77, 'N');
            $segmento->valorNominalDoBoleto = $this->getValue($line, 78, 92, 'N');
            $segmento->numeroDoBancoCobradorRecebedor = $this->getValue($line, 93, 95, 'N');
            $segmento->agenciaCobradoraRecebedora = $this->getValue($line, 96, 99, 'N');
            $segmento->digitoDaAgenciaDoBeneficiario = $this->getValue($line, 100, 100, 'N');
            $segmento->identifDoBoletoNaEmpresa = $this->getValue($line, 101, 125, 'A');
            $segmento->codigoDaMoeda = $this->getValue($line, 126, 127, 'N');
            $segmento->tipoDeInscricaoPagador = $this->getValue($line, 128, 128, 'N');
            $segmento->numeroDeInscricaoPagador = $this->getValue($line, 129, 143, 'N');
            $segmento->nomeDoPagador = $this->getValue($line, 144, 183, 'A');
            $segmento->contaCobranca = $this->getValue($line, 184, 193, 'A');
            $segmento->valorDaTarifaCustas = $this->getValue($line, 194, 208, 'N');
            $segmento->identificacao = $this->getValue($line, 209, 218, 'A');

            $segmentos[] = $segmento;
        }

        return $segmentos;
    }

    public function getSegmentosU()
    {
        $segmentos = [];

        foreach ($this->linesU as $line) {
            $segmento = new \stdClass();

            $segmento->codigoDoBancoNaCompensacao = $this->getValue($line, 1, 3, 'N');
            $segmento->loteDeServico = $this->getValue($line, 4, 7, 'N');
            $segmento->tipoDeRegistro = $this->getValue($line, 8, 8, 'N');
            $segmento->numeroSequencialDoRegistroNoLote = $this->getValue($line, 9, 13, 'N');
            $segmento->codidgoSegmentoDoRegistroDetalhe = $this->getValue($line, 14, 14, 'A');
            //02 ENTRADA CONFIMADA //06 LIQUIDAÇAO 
            $segmento->codigoDeMovimento = $this->getValue($line, 16, 17, 'N');
            $segmento->jurosMultaEncargos = $this->getValue($line, 18, 32, 'N');
            $segmento->valorDoDescontoConcedido = $this->getValue($line, 33, 47, 'N');
            $segmento->valorDoAbatimentoConcedidoCancelado = $this->getValue($line, 48, 62, 'N');
            $segmento->valorDoIofRecolhido = $this->getValue($line, 63, 77, 'N');
            $segmento->valorPagoPeloPagador = $this->getValue($line, 78, 92, 'N');
            $segmento->valorLiquidoASerCreditado = $this->getValue($line, 93, 107, 'N');
            $segmento->valorDeOutrasDespesas = $this->getValue($line, 108, 122, 'N');
            $segmento->valorDeOutrosCreditos = $this->getValue($line, 123, 137, 'N');
            $segmento->dataDaOcorrencia = $this->getValue($line, 138, 145, 'N');
            $segmento->dataDaEfetivacaoDoCredito = $this->getValue($line, 146, 153, 'N');
            $segmento->codigoDaOcorrenciaDoPagador = $this->getValue($line, 154, 157, 'N');
            $segmento->dataDaOcorrenciaDoPagador = $this->getValue($line, 158, 165, 'N');
            $segmento->valorDaOcorrenciaDoPagador = $this->getValue($line, 166, 180, 'N');
            $segmento->complementoDaOcorrenciaDoPagador = $this->getValue($line, 181, 210, 'A');
            $segmento->codigoDoBancoCorrespondenteCompensacao = $this->getValue($line, 211, 213, 'N');

            $segmentos[] = $segmento;
        }

        return $segmentos;
    }

    private function getValue($line, $start, $end, $type = "A")
    {
        $value = substr($line, $start - 1, ($end - $start) + 1);
        if ($type == 'A') {
            return trim($value);
        } else {
            return $value;
        }
    }
}
