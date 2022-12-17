<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Remessa extends Model {
    protected $fillable = ["sequencial", "data_criacao", "status"];
}