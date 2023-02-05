<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boletos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('contrato_id')->unsigned();
            $table->bigInteger('fatura_id')->unsigned();
            $table->date('emissao');
            $table->date('vencimento');
            $table->date('data_pago');
            $table->date('data_credito');
            $table->string('seu_numero');
            $table->string('nosso_numero');
            $table->decimal('valor', 8, 2);
            $table->decimal('valor_pago', 8, 2);
            $table->string('competencia');
            $table->string('status');
            $table->string('txid');
            $table->string('url_pix');
            $table->timestamps();
            // $table->foreign('cliente_id')->references('id')->on('clientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boletos');
    }
};
