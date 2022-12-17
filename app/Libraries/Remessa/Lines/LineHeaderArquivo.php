<?php

namespace App\Libraries\Remessa\Lines;

class LineHeaderArquivo extends LineAbstract
{

    private $codigo_banco_compensacao = 33;
    private $lote_servico = 0;
    private $tipo_registro = 0;
    private $tipo_inscricao_empresa = 2;
    private $numero_inscricao_empresa = '11340883000103';
    private $codigo_transmissao = 400400000177808;
    private $nome_empresa = 'BITMAX TELECOM LTDA';
    private $nome_banco = 'BANCO SANTANDER';
    private $codigo_remessa = 1;
    private $data_geracao_arquivo;
    private $numero_sequencial_arquivo;
    private $numero_versao_layout_arquivo = 40;

    function build()
    {
        $this->campos = [];
        $this->addCampo($this->codigo_banco_compensacao, "N", 3);
        $this->addCampo($this->lote_servico, "N", 4);
        $this->addCampo($this->tipo_registro, "N", 1);
        $this->addCampo(" ", "A", 8);
        $this->addCampo($this->tipo_inscricao_empresa, "N", 1);
        $this->addCampo($this->numero_inscricao_empresa, "N", 15);
        $this->addCampo($this->codigo_transmissao, "N", 15);
        $this->addCampo(" ", "A", 25);
        $this->addCampo($this->nome_empresa, "A", 30);
        $this->addCampo($this->nome_banco, "A", 30);
        $this->addCampo(" ", "A", 10);
        $this->addCampo($this->codigo_remessa, "N", 1);
        $this->addCampo($this->data_geracao_arquivo, "N", 8);
        $this->addCampo(" ", "A", 6);
        $this->addCampo($this->numero_sequencial_arquivo, "N", 6);
        $this->addCampo($this->numero_versao_layout_arquivo, "N", 3);
        $this->addCampo(" ", "A", 74);
    }


    public function setCodigoBancoCompensacao($value) {
        $this->codigo_banco_compensacao = $value;
        return $this;
    } 

    public function setLoteServico($value) {
        $this->lote_servico = $value;
        return $this;
    } 

    public function setTipoRegistro($value) {
        $this->tipo_registro = $value;
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

    public function setNomeEmpresa($value) {
        $this->nome_empresa = $value;
        return $this;
    } 

    public function setNomeBanco($value) {
        $this->nome_banco = $value;
        return $this;
    } 

    public function setCodigoRemessa($value) {
        $this->codigo_remessa = $value;
        return $this;
    } 

    public function setDataGeracaoArquivo($value) {
        $this->data_geracao_arquivo = $value;
        return $this;
    } 

    public function setNumeroSequencialArquivo($value) {
        $this->numero_sequencial_arquivo = $value;
        return $this;
    } 

    public function setNumeroVersaoLayoutArquivo($value) {
        $this->numero_versao_layout_arquivo = $value;
        return $this;
    }     
    
}
