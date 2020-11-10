<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Celular extends Model
{
    use HasFactory;
    protected $table = 'celulares';
    public function ordensServico(){
        return $this->belongsToMany(OrdemServico::class);
    }
}
