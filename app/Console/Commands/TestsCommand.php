<?php 

namespace App\Console\Commands;

use App\Libraries\PIX\PIX;
use App\Libraries\Pix\PIXDinamico;
use Illuminate\Console\Command;


class TestsCommand extends Command {
    protected $name = "testes";

    public function __invoke()
    {
        $pix = new PIXDinamico(60, "pix.santander.com.br/qr/v2/cobv/a3f05d36-c3ae-45aa-93c6-6a8cc3927e7f");

        $this->info($pix->getValue());
    }
}