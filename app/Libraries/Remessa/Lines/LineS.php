<?php

namespace App\Libraries\Remessa\Lines;

class LineR extends LineAbstract
{
    private $codigo_banco_compensacao = 33;
    private $numero_lote_remessa;
    private $tipo_registro = 3;
    private $numero_sequencial_registro_lote;
    private $codigo_segmento_registro_detalhe = "S";
    private $codigo_movimento;
    private $identificacao_impressao;
    private $numero_linha_a_ser_impressa;
    private $mensagem_para_recibo_pagador;
    private $mensagem_a_ser_impressa;

    function setCodigoBancoCompensacao($value)
    {
        $this->codigo_banco_compensacao = $value;
        return $this;
    }

    function setNumeroLoteRemessa($value)
    {
        $this->numero_lote_remessa = $value;
        return $this;
    }

    function setTipoRegistro($value)
    {
        $this->tipo_registro = $value;
        return $this;
    }

    function setNumeroSequencialRegistroLote($value)
    {
        $this->numero_sequencial_registro_lote = $value;
        return $this;
    }

    function setCodigoSegmentoRegistroDetalhe($value)
    {
        $this->codigo_segmento_registro_detalhe = $value;
        return $this;
    }

    function setCodigoMovimento($value)
    {
        $this->codigo_movimento = $value;
        return $this;
    }

    function setIdentificacaoImpressao($value)
    {
        $this->identificacao_impressao = $value;
        return $this;
    }

    function setNumeroLinhaASerImpressa($value)
    {
        $this->numero_linha_a_ser_impressa = $value;
        return $this;
    }

    function setMensagemParaReciboPagador($value)
    {
        $this->mensagem_para_recibo_pagador = $value;
        return $this;
    }

    function setMensagemASerImpressa($value)
    {
        $this->mensagem_a_ser_impressa = $value;
        return $this;
    }


    function build()
    {
        $this->campos = [];
        $this->addCampo($this->codigo_banco_compensacao, "N", 3);
        $this->addCampo($this->numero_lote_remessa, "N", 4);
        $this->addCampo($this->tipo_registro, "N", 1);
        $this->addCampo($this->numero_sequencial_registro_lote, "N", 5);
        $this->addCampo($this->codigo_segmento_registro_detalhe, "A", 1);
        $this->addCampo(" ", "A", 1);
        $this->addCampo($this->codigo_movimento, "N", 2);
        $this->addCampo($this->identificacao_impressao, "N", 1);
        $this->addCampo($this->numero_linha_a_ser_impressa, "N", 2);
        $this->addCampo($this->mensagem_para_recibo_pagador, "N", 1);
        $this->addCampo($this->mensagem_a_ser_impressa, "A", 100);
        $this->addCampo(" ", "A", 119);
    }
}
