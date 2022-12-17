<?php

namespace App\Libraries\Remessa\Lines;

class LineTrailerArquivo extends LineAbstract
{
    private $codigo_banco_compensacao = 33;
    private $numero_lote_remessa = 9999;
    private $tipo_registro = 9;
    private $quantidade_lotes_arquivo;
    private $quantidade_registros_arquivo;

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

    function setQuantidadeLotesArquivo($value)
    {
        $this->quantidade_lotes_arquivo = $value;
        return $this;
    }

    function setQuantidadeRegistrosArquivo($value)
    {
        $this->quantidade_registros_arquivo = $value;
        return $this;
    }


    function build()
    {
        $this->campos = [];
        $this->addCampo($this->codigo_banco_compensacao, "N", 3);
        $this->addCampo($this->numero_lote_remessa, "N", 4);
        $this->addCampo($this->tipo_registro, "N", 1);
        $this->addCampo(0, "N", 9);
        $this->addCampo($this->quantidade_lotes_arquivo, "N", 6);
        $this->addCampo($this->quantidade_registros_arquivo, "N", 6);
        $this->addCampo(" ", "A", 211);
    }
}
