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
        Schema::create('vehicle_entrances', function (Blueprint $table) {
            $table->id();
            //Crea un ID el cual será nuestra llave primaria para cada una de las entradas de veículo
            $table->string('plates');
            //Crea una columna para almacenar las placas del veiculo de tipo string
            $table->string('reason');
            //Crea una tabla para almacenar la razon de la visita de tipo string
            $table->timestamp('check_in_time');
            //Crea una tabla para almacenar la hora de entrada del veículo de tipo timestamp
            $table->timestamp('check_out_time');
            //Crea una tabla para almacenar la hora de salida del veículo de tipo timestamp
            $table->foreignId('cluster_id')->constrained('clusters', 'id')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users', 'id')->onDelete('cascade')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_entrances');
    }
};
