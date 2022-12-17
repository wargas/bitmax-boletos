<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model {
    protected $fillable = [
        'nome',
        'documento',
        'endereco',
        'cidade',
        'cep',
        'uf',        
    ];

    public function boletos() {
        return $this->hasMany(Boleto::class);
    }
}