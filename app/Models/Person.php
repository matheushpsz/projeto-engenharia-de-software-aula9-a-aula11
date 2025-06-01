<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
USe App\Models\BirthCertificate; // Importa o modelo BirthCertificate
use App\Models\CreditCard; // Importa o modelo CreditCard

class Person extends Model
{
    protected $table = 'people'; 
    protected $fillable = ['cpf', 'name', 'rg', 'birth_date']; 

    // Define a relação com o modelo BirthCertificate
    public function birthCertificate()
    {
        return $this->hasOne( // Define que a pessoa tem uma certidão de nascimento
            BirthCertificate::class, // Classe do modelo relacionado
            'person_id', // Chave estrangeira na tabela birth_certificates que referencia a tabela people
            'id' // Chave primária na tabela people
        );
    }
    // Função para definir o relacionamento com CreditCard
    public function creditCards()
    {
        return $this->hasMany( // Define que a pessoa tem vários cartões de crédito
            CreditCard::class, // Classe do modelo relacionado
            'person_id', // Chave estrangeira na tabela credit_cards que referencia a tabela people
            'id' // Chave primária na tabela people
        );
    }
}
