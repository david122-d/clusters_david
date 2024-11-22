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
        Schema::create('clusters', function (Blueprint $table) {
            $table->id();
            //Crea un ID el cual será nuestra llave primaria para cada una de los clusters
            $table->string('name');
            //Crea una columna de para almacenar el nombre de tipo string
            $table->timestamps();
            //Crea una columna para almacenar las fechas de creacion de la tabla de tipo date

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clusters');
    }
};
