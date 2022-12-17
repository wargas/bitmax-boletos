<?php

namespace App\Libraries\Remessa\Lines;

class LineQ extends LineAbstract
{
    private $codigo_banco_compensacao = 33;
    private $numero_lote_remessa = 1;
    private $tipo_registro = 3;
    private $numero_sequencial_registro_lote;
    private $codigo_segmento_registro_detalhe = "Q";
    private $codigo_movimento_remessa = 1;
    private $tipo_inscricao_pagador;
    private $numero_inscricao_pagador;
    private $nome_pagador;
    private $endereco_pagador;
    private $bairro_pagador;
    private $cep_pagador;
    private $sufixo_cep_pagador;
    private $cidade_pagador;
    private $unidade_federacao_pagador;
    private $tipo_inscricao_beneficiario_final = 0;
    private $numero_inscricao_beneficiario_final = 0;
    private $nome_beneficiario_final = " ";

    

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
        $this->addCampo($this->tipo_inscricao_pagador, "N", 1);
        $this->addCampo($this->numero_inscricao_pagador, "N", 15);
        $this->addCampo($this->nome_pagador, "A", 40);
        $this->addCampo($this->endereco_pagador, "A", 40);
        $this->addCampo($this->bairro_pagador, "A", 15);
        $this->addCampo($this->cep_pagador, "N", 5);
        $this->addCampo($this->sufixo_cep_pagador, "N", 3);
        $this->addCampo($this->cidade_pagador, "A", 15);
        $this->addCampo($this->unidade_federacao_pagador, "A", 2);
        $this->addCampo($this->tipo_inscricao_beneficiario_final, "N", 1);
        $this->addCampo($this->numero_inscricao_beneficiario_final, "N", 15);
        $this->addCampo($this->nome_beneficiario_final, "A", 40);
        $this->addCampo("0", "N", 3);
        $this->addCampo("0", "N", 3);
        $this->addCampo("0", "N", 3);
        $this->addCampo("0", "N", 3);
        $this->addCampo(" ", "A", 19);
    }

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

    function setCodigoMovimentoRemessa($value)
    {
        $this->codigo_movimento_remessa = $value;
        return $this;
    }

    function setTipoInscricaoPagador($value)
    {
        $this->tipo_inscricao_pagador = $value;
        return $this;
    }

    function setNumeroInscricaoPagador($value)
    {
        $this->numero_inscricao_pagador = $value;
        return $this;
    }

    function setNomePagador($value)
    {
        $this->nome_pagador = $value;
        return $this;
    }

    function setEnderecoPagador($value)
    {
        $this->endereco_pagador = $value;
        return $this;
    }

    function setBairroPagador($value)
    {
        $this->bairro_pagador = $value;
        return $this;
    }

    function setCepPagador($value)
    {
        $this->cep_pagador = $value;
        return $this;
    }

    function setSufixoCepPagador($value)
    {
        $this->sufixo_cep_pagador = $value;
        return $this;
    }

    function setCidadePagador($value)
    {
        $this->cidade_pagador = $value;
        return $this;
    }

    function setUnidadeFederacaoPagador($value)
    {
        $this->unidade_federacao_pagador = $value;
        return $this;
    }

    function setTipoInscricaoBeneficiarioFinal($value)
    {
        $this->tipo_inscricao_beneficiario_final = $value;
        return $this;
    }

    function setNumeroInscricaoBeneficiarioFinal($value)
    {
        $this->numero_inscricao_beneficiario_final = $value;
        return $this;
    }

    function setNomeBeneficiarioFinal($value)
    {
        $this->nome_beneficiario_final = $value;
        return $this;
    }
}
