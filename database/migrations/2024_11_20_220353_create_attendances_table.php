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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relación con el usuario
            $table->date('fecha'); // Fecha de la asistencia
            $table->time('hora_entrada')->nullable(); // Hora de llegada
            $table->time('hora_salida')->nullable(); // Hora de salida
            $table->time('hora_inicio_comida')->nullable(); // Hora de inicio de comida
            $table->time('hora_fin_comida')->nullable(); // Hora de fin de comida
            $table->boolean('on_time')->default(true); // Si llegó a tiempo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('attendances');
    }


};
