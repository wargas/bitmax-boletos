<?php

namespace App\Libraries;

use \OpenBoleto\Banco\Santander;
use \OpenBoleto\Agente;

class Boleto
{

    /**
     * @return \OpenBoleto\BoletoAbstract;
     */
    public static function defaultBoleto()
    {
        return new Santander([
            'cedente' => self::getCedente(),
            'agencia' => 4004,
            'carteira' => 101,
            'conta' => 177808,
            'contaDv' => 0,
            'agenciaDv' => 5,
            'carteiraDv' => 1,
            'descricaoDemonstrativo' => array(
                'Fornecimento de internet'
            ),
            'instrucoes' => array(
                'Após o dia 30/11 cobrar 2% de mora e 1% de juros ao dia.',
                'Não receber após o vencimento.',
            ),

        ]);
    }

    /**
     * @return \OpenBoleto\Agente
     */
    public static function getCedente()
    {
        return new Agente(
            'INFOLINK',
            '11.340.883/0001-03',
            'R JOAQUIM FERREIRA DE ARAUJO 192 LETRA A ',
            '56210-000',
            'Santa Filomena',
            'PE'
        );
    }
}
