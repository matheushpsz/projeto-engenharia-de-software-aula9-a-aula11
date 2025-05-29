<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products'; // Nome da tabela no banco de dados
    protected $fillable = ['name', 'description', 'price']; // Atributos que podem ser preenchidos em massa
}


/* 
Model é uma ferramenta do ORM que permite trabalhar com os objetos,
Cada model representa um MODELO  DE TABElA de banco de dados.
e permite interagir com os dados de forma orientada a objetos.
Os atribudos da classe model são os campos da tabela do banco de dados.

*/