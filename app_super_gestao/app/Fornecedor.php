<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


// fornecedors
// fornecedores
class Fornecedor extends Model
{
    protected $table = 'fornecedores';

    protected $fillable = ['nome', 'site', 'uf', 'email'];
}
