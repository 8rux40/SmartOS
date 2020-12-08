<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdemServico extends Model
{
    use HasFactory;

    protected $table = 'ordens_de_servico';
    protected $fillable = [
        'status',
        'termo_garantia',
        'descricao_problema', 
        'descricao_problema_reparador',
        'descricao_servico_executado',
        'valor_total',
        'valor_orcamento',
        'valor_servico',
        'data_abertura',
        'data_fechamento',
    ];

    public const ORCAMENTO_PENDENTE = 1;
    public const ORCAMENTO_INFORMADO = 2;
    public const ABERTA = 3;
    public const CONCLUIDA = 4;
    public const CANCELADA = 5;

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }
    public function fotosCelulares(){
        return $this->hasMany(FotoCelular::class);
    }
    public function celular(){
        return $this->belongsTo(Celular::class);
    }
    public function pecasUtilizadas(){
        return $this->hasMany(PecaUtilizada::class);
    }
}
