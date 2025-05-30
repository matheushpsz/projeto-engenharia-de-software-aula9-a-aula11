<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();// cria id auto incrementável, que é a chave primária da tabela
            //devemos preecher os campos com os tipos de dados que serão utilizados no banco de dados com base na estrutura do model
            $table->string('name'); 
            $table->text('description')->nullable(); 
            $table->decimal('price', 10, 2); 
           
            $table->timestamps();// cria campos que armazenam a data de criação e atualização do registro
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};


/*
Migration é uma funcionalidade do laravel que cria automaticamente as tabelas do banco de dados, isto é, todo codigo SQL,
baseado na estrutura do model, ou seja, os atributos da classe model são os campos da tabela do banco de dados. Contudo, vale resaltar que
as migrations não são responsáveis por adicionar valores ao banco de dados.

*/