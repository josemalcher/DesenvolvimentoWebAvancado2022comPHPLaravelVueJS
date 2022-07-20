<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = ['nome', 'descricao', 'peso', 'unidade_id'];

    public function produtoDetalhe()
    {
        return $this->hasOne('App\ProdutoDetalhe');

        // Produto tem 1 produto detalhe

        // 1 registro relacionado em produto_detalhe (fk) -> produto_id
        // produtos (pk) -> id
    }
}
