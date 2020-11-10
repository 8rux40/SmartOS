<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoCelular extends Model
{
    use HasFactory;
    protected $table = 'fotos_celulares';
    public function ordemServico(){
        return $this->belongsTo(OrdemServico::class);
    }
}
