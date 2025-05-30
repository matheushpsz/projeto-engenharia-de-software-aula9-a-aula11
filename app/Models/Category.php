<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories'; // Nome da tabela no banco de dados
    protected $fillable = ['name', 'description']; // Atributos que podem ser preenchidos em massa

    // Definindo o relacionamento com os produtos
    public function products()
    {
        return $this->hasMany( // Define que a categoria tem muitos produtos
            Product::class, // Classe do modelo relacionado
            'category_id', // Chave estrangeira na tabela products que referencia a tabela categories
            'id' // Chave primária na tabela categories
        );
    }
    /*
    Não precisamos criar uma migration para alterar a tabela `categories` 
    porque o relacionamento é feito apenas no código (model), não no banco de dados.  
    Só precisamos garantir que a tabela `products` tenha a coluna `category_id`
     para ligar cada produto a uma categoria. 
    */
}
