<?php

namespace App\Libraries\Remessa\Lines;

use App\Libraries\Remessa\Campo;

abstract class LineAbstract {
    public $campos = [];

    function addCampo($value, $type, $size) {
        $campo =  new Campo($value, $type, $size);
        $this->campos[] = $campo;
    }

    
    function getLineText() {
        $text = '';
        foreach($this->campos as $campo) {
            $text .= $campo->getFormatedValue();
        }

        return $text;
    }

    function modulo11($value, $base=9, $r=0)
    {
        $soma = 0;
        $fator = 2;
        $dv = 0;

        // Separacao dos numeros
        for ($i = strlen($value); $i > 0; $i--) {
            // pega cada numero isoladamente
            $numeros[$i] = substr($value,$i-1,1);
            // Efetua multiplicacao do numero pelo falor
            $parcial[$i] = $numeros[$i] * $fator;
            // Soma dos digitos
            $soma += $parcial[$i];
            if ($fator == $base) {
                // restaura fator de multiplicacao para 2
                $fator = 1;
            }
            $fator++;
        }

        // Calculo do modulo 11
        if ($r == 0) {
            $soma *= 10;
            $digito = $soma % 11;
            if ($digito == 10) {
                $digito = 0;
            }
            $dv = $digito;
        } elseif ($r == 1){
            $resto = $soma % 11;
            $dv = $resto;
        }

       return $value.$dv;
    }	

    abstract function build();

    
}