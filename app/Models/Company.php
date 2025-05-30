<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies'; // Nome da tabela no banco de dados
    protected $fillable = ['legal_name', 'fantasy_name', 'cnpj']; // Atributos que podem ser preenchidos em massa
}
