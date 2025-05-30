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
        Schema::create('birth_certificates', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number')->unique();
            $table->date('issue_date'); 
            $table->string('place_of_birth'); 

            $table->foreignId('person_id') // chave estrangeira que referencia a tabela people
                ->unique() // garante que cada pessoa só pode ter uma certidão de nascimento
                ->constrained('people') // define a tabela referenciada
                ->onDelete('cascade');  // se a pessoa for deletada, a certidão de nascimento também será deletada

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('birth_certificates');
    }
};
