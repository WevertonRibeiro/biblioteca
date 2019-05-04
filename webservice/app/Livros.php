<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Livros extends Model
{
    protected $fillable = [
        'titulo', 'descricao', 'ano', 'autor', 'editora', 'status', 'imagem'
    ];
}
