<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdemServico extends Model
{
    use HasFactory;
    protected $table = 'ordens_de_servico';
    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }
    public function fotosCelulares(){
        return $this->hasMany(FotoCelular::class);
    }
    public function celular(){
        return $this->hasOne(Celular::class);
    }
    public function pecasUtilizadas(){
        return $this->hasMany(PecaUtilizada::class);
    }
}
