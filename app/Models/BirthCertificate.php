<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BirthCertificate extends Model
{
    protected $table = 'birth_certificates'; // Nome da tabela no banco de dados
    protected $fillable = ['registration_number', 'issue_date', 'place_of_birth','person_id' ]; // Atributos que podem ser preenchidos em massa

    // Definindo o relacionamento com a pessoa
    public function person()
    {
        return $this->belongsTo( // Define que a certidão de nascimento pertence a uma pessoa
            Person::class, // Classe do modelo relacionado
            'person_id', // Chave estrangeira na tabela birth_certificates que referencia a tabela people
            'id' // Chave primária na tabela people
        );
    }
}
