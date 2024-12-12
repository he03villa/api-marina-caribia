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
        Schema::create('trabajadors', function (Blueprint $table) {
            $table->id();
            $table->longText('nombre');
            $table->string('identificacion')->unique();
            $table->unsignedBigInteger('id_cargo');
            $table->enum('sexo', ['Masculino', 'Femenino'])->default('Masculino');
            $table->enum('estado', ['Activo', 'Inactivo'])->default('Activo');
            $table->foreign('id_cargo')->references('id')->on('cargos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trabajadors');
    }
};
