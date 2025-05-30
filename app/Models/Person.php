<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'people'; 
    protected $fillable = ['cpf', 'name', 'rg', 'birth_date']; 

    public function birthCertificate()
    {
        return $this->hasOne( // Define que a pessoa tem uma certidão de nascimento
            BirthCertificate::class, // Classe do modelo relacionado
            'person_id', // Chave estrangeira na tabela birth_certificates que referencia a tabela people
            'id' // Chave primária na tabela people
        );
    }
}
