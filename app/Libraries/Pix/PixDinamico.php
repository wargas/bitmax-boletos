<?php 

namespace App\Libraries\Pix;


class PIXDinamico extends PIX {

    public function __construct(float $valor, string $url)
    {
        $this->addValue(0, "01");
        $this->addValue(1, "12");

        $gui = $this->fieldString(0, "br.gov.bcb.pix");
        $url = $this->fieldString(25, $url);

        $this->addValue(26, $gui.$url);

        $this->addValue(52, "0000");
        $this->addValue(53, "986");
        $this->addValue(54, number_format($valor, 2, '.', ''));
        $this->addValue(58, "BR");
        $this->addValue(59, "BITMAX TELECOM LTDA ME");
        $this->addValue(60, "SANTA FILOMENA");
        $this->addValue(62, "0503***");

        $crc = $this->crc();
        $this->addValue(63, $crc);
    }
}

/*
000201
010212
2690
    0014br.gov.bcb.pix
    2568pix.santander.com.br/qr/v2/cobv/a3f05d36-c3ae-45aa-93c6-6a8cc3927e7f
52040000
5303986
540560.00
5802BR
5922BITMAX TELECOM LTDA ME
6014SANTA FILOMENA
62070503***
63040E64
**/