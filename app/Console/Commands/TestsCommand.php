<?php 

namespace App\Console\Commands;

use App\Libraries\PIX\PIX;
use App\Libraries\Pix\PIXDinamico;
use Illuminate\Console\Command;


class TestsCommand extends Command {
    protected $name = "testes";

    public function __invoke()
    {
       $items = collect(glob('**'));

        $items->
            map(function($item) {
                return strtoupper($item);
            })
            ->each(function($item) {
            $this->info($item);
        });
    }
}