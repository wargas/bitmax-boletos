<?php

namespace App\Libraries\Remessa\Lines;

class LineP extends LineAbstract
{

    private $codigo_banco_compensacao = 33;
    private $numero_lote_remessa = 1;
    private $tipo_registro = 3;
    private $numero_sequencial_registro_lote;
    private $codigo_segmento_registro_detalhe = "P";
    private $codigo_movimento_remessa = 1;
    private $agencia_destinataria = 4004;
    private $digito_agencia_destinataria = 5;
    private $numero_conta_corrente = 13001562;
    private $digito_verificador_conta = 6;
    private $conta_cobranca_destinataria_fidc = 13001562;
    private $digito_conta_cobranca_destinataria_fidc = 6;
    private $identificacao_boleto_no_banco;
    private $tipo_cobranca = 5;
    private $forma_cadastramento = 1;
    private $tipo_documento = 2;
    private $numero_documento;
    private $data_vencimento_boleto;
    private $valor_nominal_boleto;
    private $agencia_encarregada_cobranca_fidc = 0;
    private $digito_agencia_beneficiario_fidc = 0;
    private $especie_boleto = 4;
    private $identificacao_boleto_aceito_nao_aceito = 'N';
    private $data_emissao_boleto;
    private $codigo_juros_mora = 2;
    private $data_juros_mora;
    private $valor_mora_dia_ou_taxa_mensal = '001';
    private $codigo_desconto_1 = 0;
    private $data_desconto_1 = 0;
    private $valor_ou_percentual_desconto_concedido = 0;
    private $percentual_iof_a_ser_recolhido = 0;
    private $valor_abatimento = 0;
    private $identificacao_boleto_empresa = " ";
    private $codigo_para_protesto = 0;
    private $numero_dias_para_protesto = 0;
    private $codigo_para_baixa_devolucao = 2;
    private $numero_dias_para_baixa_devolucao = 0;
    private $codigo_moeda = 0;

    

    function build()
    {
        $this->campos = [];
        $this->addCampo($this->codigo_banco_compensacao, "N", 3);
        $this->addCampo($this->numero_lote_remessa, "N", 4);
        $this->addCampo($this->tipo_registro, "N", 1);
        $this->addCampo($this->numero_sequencial_registro_lote, "N", 5);
        $this->addCampo($this->codigo_segmento_registro_detalhe, "A", 1);
        $this->addCampo(" ", "A", 1);
        $this->addCampo($this->codigo_movimento_remessa, "N", 2);
        $this->addCampo($this->agencia_destinataria, "N", 4);
        $this->addCampo($this->digito_agencia_destinataria, "N", 1);
        $this->addCampo($this->numero_conta_corrente, "N", 9);
        $this->addCampo($this->digito_verificador_conta, "N", 1);
        $this->addCampo($this->conta_cobranca_destinataria_fidc, "N", 9);
        $this->addCampo($this->digito_conta_cobranca_destinataria_fidc, "N", 1);
        $this->addCampo(" ", "A", 2);
        $this->addCampo($this->identificacao_boleto_no_banco, "N", 13);
        $this->addCampo($this->tipo_cobranca, "A", 1);
        $this->addCampo($this->forma_cadastramento, "N", 1);
        $this->addCampo($this->tipo_documento, "N", 1);
        $this->addCampo(" ", "A", 1);
        $this->addCampo(" ", "A", 1);
        $this->addCampo($this->numero_documento, "A", 15);
        $this->addCampo($this->data_vencimento_boleto, "N", 8);
        $this->addCampo($this->valor_nominal_boleto, "N", 15);
        $this->addCampo($this->agencia_encarregada_cobranca_fidc, "N", 4);
        $this->addCampo($this->digito_agencia_beneficiario_fidc, "N", 1);
        $this->addCampo(" ", "A", 1);
        $this->addCampo($this->especie_boleto, "N", 2);
        $this->addCampo($this->identificacao_boleto_aceito_nao_aceito, "A", 1);
        $this->addCampo($this->data_emissao_boleto, "N", 8);
        $this->addCampo($this->codigo_juros_mora, "N", 1);
        $this->addCampo($this->data_juros_mora, "N", 8);
        $this->addCampo($this->valor_mora_dia_ou_taxa_mensal, "N", 15);
        $this->addCampo($this->codigo_desconto_1, "N", 1);
        $this->addCampo($this->data_desconto_1, "N", 8);
        $this->addCampo($this->valor_ou_percentual_desconto_concedido, "N", 15);
        $this->addCampo($this->percentual_iof_a_ser_recolhido, "N", 15);
        $this->addCampo($this->valor_abatimento, "N", 15);
        $this->addCampo($this->identificacao_boleto_empresa, "A", 25);
        $this->addCampo($this->codigo_para_protesto, "N", 1);
        $this->addCampo($this->numero_dias_para_protesto, "N", 2);
        $this->addCampo($this->codigo_para_baixa_devolucao, "N", 1);
        $this->addCampo(0, "N", 1);
        $this->addCampo($this->numero_dias_para_baixa_devolucao, "N", 2);
        $this->addCampo($this->codigo_moeda, "N", 2);
        $this->addCampo(" ", "A", 11);
    }

    public function setCodigoBancoCompensacao($value)
    {
        $this->codigo_banco_compensacao = $value;
        return $this;
    }

    public function setNumeroLoteRemessa($value)
    {
        $this->numero_lote_remessa = $value;
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

    public function setAgenciaDestinataria($value)
    {
        $this->agencia_destinataria = $value;
        return $this;
    }

    public function setDigitoAgenciaDestinataria($value)
    {
        $this->digito_agencia_destinataria = $value;
        return $this;
    }

    public function setNumeroContaCorrente($value)
    {
        $this->numero_conta_corrente = $value;
        return $this;
    }

    public function setDigitoVerificadorConta($value)
    {
        $this->digito_verificador_conta = $value;
        return $this;
    }

    public function setContaCobrancaDestinatariaFidc($value)
    {
        $this->conta_cobranca_destinataria_fidc = $value;
        return $this;
    }

    public function setDigitoContaCobrancaDestinatariaFidc($value)
    {
        $this->digito_conta_cobranca_destinataria_fidc = $value;
        return $this;
    }

    public function setIdentificacaoBoletoNoBanco($value)
    {
        $this->identificacao_boleto_no_banco = $this->modulo11($value);
        return $this;
    }

    public function setTipoCobranca($value)
    {
        $this->tipo_cobranca = $value;
        return $this;
    }

    public function setFormaCadastramento($value)
    {
        $this->forma_cadastramento = $value;
        return $this;
    }

    public function setTipoDocumento($value)
    {
        $this->tipo_documento = $value;
        return $this;
    }

    public function setNumeroDocumento($value)
    {
        $this->numero_documento = $value;
        return $this;
    }

    public function setDataVencimentoBoleto($value)
    {
        $this->data_vencimento_boleto = $value;
        return $this;
    }

    public function setValorNominalBoleto($value)
    {
        $this->valor_nominal_boleto = $value;
        return $this;
    }

    public function setAgenciaEncarregadaCobrancaFidc($value)
    {
        $this->agencia_encarregada_cobranca_fidc = $value;
        return $this;
    }

    public function setDigitoAgenciaBeneficiarioFidc($value)
    {
        $this->digito_agencia_beneficiario_fidc = $value;
        return $this;
    }

    public function setEspecieBoleto($value)
    {
        $this->especie_boleto = $value;
        return $this;
    }

    public function setIdentificacaoBoletoAceitoNaoAceito($value)
    {
        $this->identificacao_boleto_aceito_nao_aceito = $value;
        return $this;
    }

    public function setDataEmissaoBoleto($value)
    {
        $this->data_emissao_boleto = $value;
        return $this;
    }

    public function setCodigoJurosMora($value)
    {
        $this->codigo_juros_mora = $value;
        return $this;
    }

    public function setDataJurosMora($value)
    {
        $this->data_juros_mora = $value;
        return $this;
    }

    public function setValorMoraDiaOuTaxaMensal($value)
    {
        $this->valor_mora_dia_ou_taxa_mensal = $value;
        return $this;
    }

    public function setCodigoDesconto1($value)
    {
        $this->codigo_desconto_1 = $value;
        return $this;
    }

    public function setDataDesconto1($value)
    {
        $this->data_desconto_1 = $value;
        return $this;
    }

    public function setValorOuPercentualDescontoConcedido($value)
    {
        $this->valor_ou_percentual_desconto_concedido = $value;
        return $this;
    }

    public function setPercentualIofASerRecolhido($value)
    {
        $this->percentual_iof_a_ser_recolhido = $value;
        return $this;
    }

    public function setValorAbatimento($value)
    {
        $this->valor_abatimento = $value;
        return $this;
    }

    public function setIdentificacaoBoletoEmpresa($value)
    {
        $this->identificacao_boleto_empresa = $value;
        return $this;
    }

    public function setCodigoParaProtesto($value)
    {
        $this->codigo_para_protesto = $value;
        return $this;
    }

    public function setNumeroDiasParaProtesto($value)
    {
        $this->numero_dias_para_protesto = $value;
        return $this;
    }

    public function setCodigoParaBaixaDevolucao($value)
    {
        $this->codigo_para_baixa_devolucao = $value;
        return $this;
    }

    public function setNumeroDiasParaBaixaDevolucao($value)
    {
        $this->numero_dias_para_baixa_devolucao = $value;
        return $this;
    }

    public function setCodigoMoeda($value)
    {
        $this->codigo_moeda = $value;
        return $this;
    }

    
}
