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
        Schema::create('stands', function (Blueprint $table) {
            $table->id();
            //Crea un ID el cual será nuestra llave primaria para cada una de las casetas de vigilancia
            $table->integer('number');
            //Una columna para almacenar el numero de la cadeta de tipo entero
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
        Schema::dropIfExists('stands');
    }
};
