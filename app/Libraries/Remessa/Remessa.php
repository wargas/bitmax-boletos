<?php 

namespace App\Libraries\Remessa;

use App\Libraries\Remessa\Lines\LineAbstract;

class Remessa {


    
    
    public $lines = [];

    /**
     * @param LineAbstract $line
     * @return Remessa
     */

    function addLine(LineAbstract $line) {
        $line->build();
        $this->lines[] = $line;
        return $this;
    }
   
    function addLines(...$lines) {
        foreach($lines as $line) {
            $this->addLine($line);
        }
        return $this;
    }


    function getText() {
        $arrayText = [];

        foreach($this->lines as $line) {
            $arrayText[] = $line->getLineText();
        }

        return implode("\r\n", $arrayText);
    }

    function writeFile(string $filename) {
        file_put_contents($filename, $this->getText());
    }

    function download(string $filename = "arquivo-remessa") {
        
        header("Content-type: plain/text");
        header("Content-Disposition: attachment; filename={$filename}.txt");
        header("Pragma: no-cache");
        header("Expires: 0");

        echo $this->getText();
    }
}