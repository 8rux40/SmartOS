<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    
    protected $table = 'clientes';
    protected $fillable = [
        'nome', 'cpf', 'numero_tel', 'numero_cel', 'endereco', 'email'
    ];

    public function ordensServico(){
        return $this->hasMany(OrdemServico::class);
    }
}
