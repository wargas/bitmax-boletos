<?php

namespace App\Libraries\Remessa\Lines;

class LineHeaderLote extends LineAbstract {

    private $codigo_banco_compensacao = 33;
    private $numero_lote_remessa = 1;
    private $tipo_registro = 1;
    private $tipo_operacao = 'R';
    private $tipo_servico = 1;
    private $numero_versao_layout_lote = 30;
    private $tipo_inscricao_empresa = 2;
    private $numero_inscricao_empresa = '11340883000103';
    private $codigo_transmissao = 400400000177808;
    private $nome_beneficiario = 'BITMAX TELECOM LTDA';
    private $mensagem_1 = 'mensagem_1';
    private $mensagem_2 = 'mensagem_2';
    private $numero_remessa_retorno;
    private $data_gravacao_remessa_retorno;

    function build()
    {
        $this->campos = [];
        $this->addCampo($this->codigo_banco_compensacao, "N", 3);
        $this->addCampo($this->numero_lote_remessa, "N", 4);
        $this->addCampo($this->tipo_registro, "N", 1);
        $this->addCampo($this->tipo_operacao, "A", 1 );
        $this->addCampo($this->tipo_servico, "N", 2);
        $this->addCampo(" ", "A", 2);
        $this->addCampo($this->numero_versao_layout_lote, "N", 3);
        $this->addCampo(" ", "A", 1 );
        $this->addCampo($this->tipo_inscricao_empresa, "N", 1);
        $this->addCampo($this->numero_inscricao_empresa, "N", 15);
        $this->addCampo(" ", "A", 20 );
        $this->addCampo($this->codigo_transmissao, "N", 15   );
        $this->addCampo(" ", "A", 5);
        $this->addCampo($this->nome_beneficiario, "A", 30);
        $this->addCampo($this->mensagem_1, "A", 40);
        $this->addCampo($this->mensagem_2, "A", 40);
        $this->addCampo($this->numero_remessa_retorno, "N", 8);
        $this->addCampo($this->data_gravacao_remessa_retorno, "N", 8);
        $this->addCampo(" ", "A", 41);
    }

    public function setCodigoBancoCompensacao($value) {
        $this->codigo_banco_compensacao = $value;
        return $this;
    }

    public function setNumeroLoteRemessa($value) {
        $this->numero_lote_remessa = $value;
        return $this;
    }

    public function setTipoRegistro($value) {
        $this->tipo_registro = $value;
        return $this;
    }

    public function setTipoOperacao($value) {
        $this->tipo_operacao = $value;
        return $this;
    }

    public function setTipoServico($value) {
        $this->tipo_servico = $value;
        return $this;
    }

    public function setNumeroVersaoLayoutLote($value) {
        $this->numero_versao_layout_lote = $value;
        return $this;
    }

    public function setTipoInscricaoEmpresa($value) {
        $this->tipo_inscricao_empresa = $value;
        return $this;
    }

    public function setNumeroInscricaoEmpresa($value) {
        $this->numero_inscricao_empresa = $value;
        return $this;
    }

    public function setCodigoTransmissao($value) {
        $this->codigo_transmissao = $value;
        return $this;
    }

    public function setNomeBeneficiario($value) {
        $this->nome_beneficiario = $value;
        return $this;
    }

    public function setMensagem1($value) {
        $this->mensagem_1 = $value;
        return $this;
    }

    public function setMensagem2($value) {
        $this->mensagem_2 = $value;
        return $this;
    }

    public function setNumeroRemessaRetorno($value) {
        $this->numero_remessa_retorno = $value;
        return $this;
    }

    public function setDataGravacaoRemessaRetorno    ($value) {
        $this->data_gravacao_remessa_retorno = $value;
        return $this;
    }
}
