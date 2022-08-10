<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'imagem'];

    public function rules()
    {
           return [
               'nome' => 'required|unique:marcas,nome, '.$this->id.'|min:3',
               'imagem' => 'required'
           ];
           /*
           unique:marcas,nome, '.$this->id.'
           1) tabela
           2) nome da coluna que será pesqusada na tabela
           3) id do registro que será desconsiderado na pesquisa
            */

    }

    public function feedback()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'nome.unique' => 'O nome da marca já existe',
            'nome.min' => 'O nome deve ter no mínimo 3 caracteres'
        ];
    }
}
