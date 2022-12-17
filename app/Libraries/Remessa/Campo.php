<?php

namespace App\Libraries\Remessa;

class Campo {
    var $value;
    var $type;
    var $size;
    function __construct($value, $type, $size) 
    {
        $this->value = $value;
        $this->type = $type;
        $this->size = $size;
    }


    function getFormatedValue() {
        if($this->type == 'A') {
            return str_pad($this->value, $this->size, ' ',STR_PAD_RIGHT);
        }
        if($this->type == 'N') {
            return str_pad($this->value, $this->size, '0',STR_PAD_LEFT);
        }
    }

    
}