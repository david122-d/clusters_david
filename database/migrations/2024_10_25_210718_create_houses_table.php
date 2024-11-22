<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Laravel\Prompts\Table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->id();
            //Crea un ID el cual será nuestra llave primaria para cada una de las casas
            $table->integer('number');
            //Crea una columna en la tabla para almacenar el numero de la casa de tipo entero
            $table->string('owner_name');
            //Crea una columna para almacenar el nombre del propietario de la casa de tipo string
            $table->enum('maintenance',['paied', 'unpaid'])->default('unpaid');            
            //Crea una columna para almacenar el estatus del pagode mantenimineto de la casa de tipo enum para que solo puedan haber ciertos valores de tipo string
            $table->foreignId('cluster_id')->constrained('clusters', 'id')->onDelete('cascade');
            $table->timestamps();
            //Crea una columna para almacenar el las fechas de creacion de la tabla de tipo date

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('houses');
    }
};
