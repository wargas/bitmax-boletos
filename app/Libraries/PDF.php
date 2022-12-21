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
}