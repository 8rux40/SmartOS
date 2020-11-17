<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Celular extends Model
{
    use HasFactory;

    protected $table = 'celulares';
    protected $fillable = [
        'imei', 'imei2', 'marca', 'modelo', 'cliente_id'
    ];

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }

    public function ordensServico(){
        return $this->hasMany(OrdemServico::class);
    }
}
