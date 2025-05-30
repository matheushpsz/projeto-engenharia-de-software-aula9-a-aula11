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
        Schema::table('products', function (Blueprint $table) { // Altera a tabela products
            $table->unsignedBigInteger('category_id')->nullable()->after('id'); // Adiciona a coluna category_id após a coluna id
            //aqui nullable é pois ja criamos a tabela products e ela ja possui dados, então não podemos obrigar que todos os produtos tenham uma categoria
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null'); // Define a chave estrangeira
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};


/* 
Essa migration é responsável por adicionar a coluna category_id na tabela products
e não criar uma nova tabela. A coluna category_id será uma chave estrangeira que referencia a tabela categories.

*/