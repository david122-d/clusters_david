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
        Schema::create('amenities', function (Blueprint $table) {
            $table->id();
            //Crea un ID el cual será nuestra llave primaria para cada una de las amenidades
            $table->string('name');
            //Crea una columna para almacenar el nombre de la amenidad de tipo string
            $table->string('type');
            //Crea una columna para almacenar el tipo de la amenidad de tipo string
            $table->enum('status',['activa', 'inactiva','En mantenimiento'])->default('inactiva');
            //Crea una columna para almacenar el estatus de la amenidad de tipo enum para que solo puedan haber ciertos valores de tipo string
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
        Schema::dropIfExists('amenities');
    }
};
