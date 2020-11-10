<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peca extends Model
{
    use HasFactory;
    protected $table = 'pecas';
    public function pecasUtilizadas(){
        return $this->belongsToMany(PecaUtilizada::class);
    }
}
