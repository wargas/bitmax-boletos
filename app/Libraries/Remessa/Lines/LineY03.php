<?php

namespace App\Libraries\Remessa\Lines;

class LineY03 extends LineAbstract
{

    private $codigo_banco_compensacao = 33;
    private $lote_servico = 1;
    private $tipo_registro = 3;
    private $numero_sequencial_registro_lote;
    private $codigo_segmento_registro_detalhe = "Y";
    private $codigo_movimento_remessa = 1;
    private $identificacao_registro = 3;
    private $tipo_chave_pix = 2;
    private $chave_pix = '11340883000103';
    private $codigo_identificacao_qr_code;
    //adicionado para calcular a chave pix
    private $identificacao_boleto_no_banco;




    function build()
    {
        $this->addCampo($this->codigo_banco_compensacao, "N", 3);
        $this->addCampo($this->lote_servico, "N", 4);
        $this->addCampo($this->tipo_registro, "N", 1);
        $this->addCampo($this->numero_sequencial_registro_lote, "N", 5);
        $this->addCampo($this->codigo_segmento_registro_detalhe, "A", 1);
        $this->addCampo(" ", "A", 1);
        $this->addCampo($this->codigo_movimento_remessa, "N", 2);
        $this->addCampo($this->identificacao_registro, "N", 2);
        $this->addCampo(" ", "A", 61);
        $this->addCampo($this->tipo_chave_pix, "A", 1);
        $this->addCampo($this->chave_pix, "A", 77);
        $this->addCampo($this->codigo_identificacao_qr_code, "A", 35);
        $this->addCampo(" ", "A", 47);
    }

    public function setIdentificacaoBoletoNoBanco($value)
    {
        //PODE SER INFORMADO QUALQUER VALOR ENTRE 26 E 35 CARACTERER (VALOR UNICO PARA CADA BOLETO)
        // $this->codigo_identificacao_qr_code =
        //     'YKT000177808'
        //     . $this->modulo11($value)
        //     . '22112022';

        $this->codigo_identificacao_qr_code = str_pad($value, 26, "0", STR_PAD_LEFT);

        return $this;
    }


    public function setCodigoBancoCompensacao($value)
    {
        $this->codigo_banco_compensacao = $value;
        return $this;
    }

    public function setLoteServico($value)
    {
        $this->lote_servico = $value;
        return $this;
    }

    public function setTipoRegistro($value)
    {
        $this->tipo_registro = $value;
        return $this;
    }

    public function setNumeroSequencialRegistroLote($value)
    {
        $this->numero_sequencial_registro_lote = $value;
        return $this;
    }

    public function setCodigoSegmentoRegistroDetalhe($value)
    {
        $this->codigo_segmento_registro_detalhe = $value;
        return $this;
    }


    public function setCodigoMovimentoRemessa($value)
    {
        $this->codigo_movimento_remessa = $value;
        return $this;
    }

    public function setIdentificacaoRegistro($value)
    {
        $this->identificacao_registro = $value;
        return $this;
    }


    public function setTipoChavePix($value)
    {
        $this->tipo_chave_pix = $value;
        return $this;
    }

    public function setChavePix($value)
    {
        $this->chave_pix = $value;
        return $this;
    }

    public function setCodigoIdentificacaoQrCode($value)
    {
        $this->codigo_identificacao_qr_code = $value;
        return $this;
    }
}
