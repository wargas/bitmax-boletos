<?php

namespace App\Models;

use App\Libraries\BitmaxBoleto;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Boleto extends Model
{
    protected $fillable = [
        'cliente_id',
        'vencimento',
        'seu_numero',
        'nosso_numero',
        'valor',
        'status',
        'txid',
        'url_pix',
    ];

    
    protected $appends = [
    #"barcode", 
    "linha_digitavel"
];
    public function cliente() {
        return $this->belongsTo(Clienteview::class, 'contrato_id');
    }

    public function linha_digitavel(): Attribute {
        $boleto = BitmaxBoleto::fromDB($this);
        return Attribute::make(
            get: fn ($value) => $boleto->getNumeroFebraban()
        );
    }

    public function barcode(): Attribute {
        $boleto = BitmaxBoleto::fromDB($this);
        return Attribute::make(
            get: fn ($value) => $boleto->getNumeroFebraban()
        );
    }

    //vgetNumeroFebraban()

}
