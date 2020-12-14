<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Celular extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'celulares';
    protected $dates = ['deleted_at'];
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
