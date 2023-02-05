<?php

namespace App\Libraries\Remessa;

class Campo
{
    var $value;
    var $type;
    var $size;
    function __construct($value, $type, $size)
    {
        $this->value = $value;
        $this->type = $type;
        $this->size = $size;
    }


    function getFormatedValue()
    {
        if ($this->type == 'A') {
            return str_pad($this->value, $this->size, ' ', STR_PAD_RIGHT);
        }
        if ($this->type == 'N') {
            return str_pad($this->value, $this->size, '0', STR_PAD_LEFT);
        }
    }

    public static function rmAct($string)
    {
        return preg_replace(array("/(á|à|ã|â|ä)/", "/(Á|À|Ã|Â|Ä)/", "/(é|è|ê|ë)/", "/(É|È|Ê|Ë)/", "/(í|ì|î|ï)/", "/(Í|Ì|Î|Ï)/", "/(ó|ò|õ|ô|ö)/", "/(Ó|Ò|Õ|Ô|Ö)/", "/(ú|ù|û|ü)/", "/(Ú|Ù|Û|Ü)/", "/(ñ)/", "/(Ñ)/"), explode(" ", "a A e E i I o O u U n N"), $string);
    }
}
