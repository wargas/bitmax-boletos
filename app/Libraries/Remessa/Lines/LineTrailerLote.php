<?php

namespace App\Libraries\Remessa\Lines;

class LineTrailerLote extends LineAbstract
{

    private $codigo_banco_compensacao = 33;
    private $numero_lote_remessa = 1;
    private $tipo_registro = 5;
    private $quantidade_registros_lote;

    function setCodigoBancoCompensacao($value)
    {
        $this->codigo_banco_compensacao = $value;
        return $value;
    }

    function setNumeroLoteRemessa($value)
    {
        $this->numero_lote_remessa = $value;
        return $value;
    }

    function setTipoRegistro($value)
    {
        $this->tipo_registro = $value;
        return $value;
    }

    function setQuantidadeRegistrosLote($value)
    {
        $this->quantidade_registros_lote = $value;
        return $value;
    }



    function build()
    {
        $this->campos = [];
        $this->addCampo($this->codigo_banco_compensacao, "N", 3);
        $this->addCampo($this->numero_lote_remessa, "N", 4);
        $this->addCampo($this->tipo_registro, "N", 1);
        $this->addCampo(0, "N", 9);
        $this->addCampo($this->quantidade_registros_lote, "N", 6);
        $this->addCampo(" ", "A", 217);
    }
}
