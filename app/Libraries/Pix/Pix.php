<?php 

namespace App\Libraries\Pix;

use \Crc16\Crc16;

class PIX extends Crc16 {

    protected $value;

    public function crc() {
        $value = $this->value.'6304';
        
        $code = self::CCITT_FALSE($value);

        return strtoupper(str_pad(dechex($code), 4, "0", STR_PAD_LEFT));
    }

    public function fieldString($id, $value) {
        $size = strlen($value);
        return str_pad($id, 2, "0", 0).str_pad($size, 2, "0", 0).$value;
    }

    public function addValue($id, $value) {
        $this->value .= $this->fieldString($id, $value);
    }

    public function getValue() {
        return $this->value;
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