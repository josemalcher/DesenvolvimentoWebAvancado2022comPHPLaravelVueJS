<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


// fornecedors
// fornecedores
class Fornecedor extends Model
{
    use SoftDeletes;

    protected $table = 'fornecedores';
    protected $fillable = ['nome', 'site', 'uf', 'email'];

    public function produtos()
    {
        // return $this->hasMany('App\Item', 'fornecedor_id', 'id'); / modelo se não estivesse no padrão
        return $this->hasMany('App\Item');
    }
}
