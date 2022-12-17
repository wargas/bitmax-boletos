<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Boleto extends Model
{
    protected $fillable = [
        'cliente_id',
        'vencimento',
        'nosso_numero',
        'valor',
        'status',
    ];

    public function cliente() {
        return $this->belongsTo(Cliente::class);
    }
}
