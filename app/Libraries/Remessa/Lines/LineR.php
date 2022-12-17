<?php

namespace App\Libraries\Remessa\Lines;

class LineR extends LineAbstract
{

    private $codigo_banco_compensacao = 33;
    private $numero_lote_remessa;
    private $tipo_registro = 3;
    private $numero_sequencial_registro_lote;
    private $codigoSegmentoRegistroDetalhe;
    private $codigo_movimento;
    private $codigo_desconto_2;
    private $data_desconto_2;
    private $valor_percentual_a_ser_concedido_2;
    private $codigo_desconto_3;
    private $data_desconto_3;
    private $valor_percentual_a_ser_concedido_3;
    private $codigo_multa;
    private $data_multa;
    private $valor_percentual_a_ser_aplicado;
    private $mensagem_3;
    private $mensagem_4;

    function setCodigoBancoCompensacao($value) {
        $this->codigo_banco_compensacao = $value;
        return $this;
    }
    function setNumeroLoteRemessa($value) {
        $this->numero_lote_remessa = $value;
        return $this;
    }
    function setTipoRegistro($value) {
        $this->tipo_registro = $value;
        return $this;
    }
    function setNumeroSequencialRegistroLote($value) {
        $this->numero_sequencial_registro_lote = $value;
        return $this;
    }
    function setCodigoSegmentoRegistroDetalhe($value) {
        $this->codigoSegmentoRegistroDetalhe = $value;
        return $this;
    }
    function setCodigoMovimento($value) {
        $this->codigo_movimento = $value;
        return $this;
    }
    function setCodigoDesconto2($value) {
        $this->codigo_desconto_2 = $value;
        return $this;
    }
    function setDataDesconto2($value) {
        $this->data_desconto_2 = $value;
        return $this;
    }
    function setValorPercentualASerConcedido2($value) {
        $this->valor_percentual_a_ser_concedido_2 = $value;
        return $this;
    }
    function setCodigoDesconto3($value) {
        $this->codigo_desconto_3 = $value;
        return $this;
    }
    function setDataDesconto3($value) {
        $this->data_desconto_3 = $value;
        return $this;
    }
    function setValorPercentualASerConcedido3($value) {
        $this->valor_percentual_a_ser_concedido_3 = $value;
        return $this;
    }
    function setCodigoMulta($value) {
        $this->codigo_multa = $value;
        return $this;
    }
    function setDataMulta($value) {
        $this->data_multa = $value;
        return $this;
    }
    function setValorPercentualASerAplicado($value) {
        $this->valor_percentual_a_ser_aplicado = $value;
        return $this;
    }
    function setMensagem3($value) {
        $this->mensagem_3 = $value;
        return $this;
    }
    function setMensagem4($value) {
        $this->mensagem_4 = $value;
        return $this;
    }
    

    function build()
    {
        $this->campos = [];
        $this->addCampo($this->codigo_banco_compensacao,"N", 3); 
        $this->addCampo($this->numero_lote_remessa,"N", 4); 
        $this->addCampo($this->tipo_registro,"N", 1); 
        $this->addCampo($this->numero_sequencial_registro_lote,"N", 5); 
        $this->addCampo($this->codigoSegmentoRegistroDetalhe,"N", 1); 
        $this->addCampo(" ","A", 1); 
        $this->addCampo($this->codigo_movimento,"N", 2); 
        $this->addCampo($this->codigo_desconto_2,"N", 1); 
        $this->addCampo($this->data_desconto_2,"N", 8); 
        $this->addCampo($this->valor_percentual_a_ser_concedido_2,"N", 15); 
        $this->addCampo($this->codigo_desconto_3,"N", 1); 
        $this->addCampo($this->data_desconto_3,"N", 8); 
        $this->addCampo($this->valor_percentual_a_ser_concedido_3,"N", 15); 
        $this->addCampo($this->codigo_multa,"N", 1); 
        $this->addCampo($this->data_multa,"N", 8); 
        $this->addCampo($this->valor_percentual_a_ser_aplicado,"N", 15); 
        $this->addCampo(" ","A", 10); 
        $this->addCampo($this->mensagem_3,"A", 40); 
        $this->addCampo($this->mensagem_4,"A", 40); 
        $this->addCampo(" ","A", 61);         
    }
}
