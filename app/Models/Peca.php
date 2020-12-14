<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Peca extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'pecas';
    protected $dates = ['deleted_at'];
    protected $fillable = ['titulo','codigo','preco','quantidade_pecas','descricao'];

    public function pecasUtilizadas(){
        return $this->hasMany(PecaUtilizada::class);
    }
}
