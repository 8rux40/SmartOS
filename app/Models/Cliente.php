<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'clientes';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'nome', 'cpf', 'numero_tel', 'numero_cel', 'endereco', 'email'
    ];

    public function celulares(){
        return $this->hasMany(Celular::class);
    }

    public function ordensServico(){
        return $this->hasMany(OrdemServico::class);
    }
}
