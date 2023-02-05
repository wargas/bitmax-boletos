<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Clienteview extends Model {

    protected $table = 'view_clientes';
    // protected $fillable = [
    //     'nome',
    //     'documento',
    //     'endereco',
    //     'cidade',
    //     'cep',
    //     'uf',        
    // ];

    public function boletos() {
        return $this->hasMany(Boleto::class);
    }
}