<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PecaUtilizada extends Model
{
    use HasFactory;
    protected $table = 'pecas_utilizadas';
    //protected $primarykey = 'peca_utilizada_id';
    protected $with = ['peca'];
    protected $fillable = ['peca_id','ordem_servico_id','quantidade_utilizada'];

    public function ordemServico(){
        return $this->belongsTo(OrdemServico::class);
    }
    public function peca(){
        return $this->belongsTo(Peca::class)->withTrashed();
    }
}
