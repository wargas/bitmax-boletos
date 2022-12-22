<?php

namespace App\Libraries;

use Exception;

class PDF extends \FPDF
{

    public function Cell($w, $h = 0, $txt = '', $border = 0, $ln = 0, $align = '', $fill = false, $link = '')
    {
        try {
            $txt = iconv("UTF-8", "ISO-8859-1", $txt);
        } catch (Exception $e) {
        }
        parent::Cell($w, $h, $txt, $border, $ln, $align, $fill, $link);
    }

    //reescrever image para aceitar imagem de base64
    public function Image($file, $x = null, $y = null, $w = 0, $h = 0, $type = '', $link = '')
    {
        if(str_starts_with($file, 'data:image')) {

            $posWrap = strpos($file, ',');

            $head = substr($file, 0, $posWrap);
            $data = substr($file, $posWrap);

            $type = preg_replace("/^data:image\/(png|jpg|jpeg|gif);base64/", "$1", $head);

            $file = tempnam(sys_get_temp_dir(), 'fpdf');
            file_put_contents($file, base64_decode($data));            
        }

       
       parent::Image($file, $x, $y, $w, $h, $type, $link);
    }
}