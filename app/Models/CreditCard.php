<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Person; // Importa o modelo Person

class CreditCard extends Model
{
protected $table = 'credit_cards'; 
protected $fillable = ['card_number', 'expiration_date', 'cvv','person_id']; // Atributos que podem ser preenchidos em massa

    // Define a relação com o modelo Person
    // Esta função estabelece que cada cartão de crédito pertence a uma pessoa específica
    // através da chave estrangeira person_id na tabela credit_cards.

//função responsável por definir a relação com o modelo Person
    public function person()
    {
        return $this->belongsTo( // Define que o cartão de crédito pertence a uma pessoa
            Person::class, // Classe do modelo relacionado
            'person_id', // Chave estrangeira na tabela credit_cards que referencia a tabela people
            'id' // Chave primária na tabela people
        );
    }
}
