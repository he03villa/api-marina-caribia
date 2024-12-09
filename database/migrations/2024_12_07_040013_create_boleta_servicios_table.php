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
        Schema::create('boleta_servicios', function (Blueprint $table) {
            $table->id();
            $table->longText('id_boleta_servicio');
            $table->unsignedBigInteger('destino');
            $table->unsignedBigInteger('agencia');
            $table->unsignedBigInteger('embarcacion');
            $table->unsignedBigInteger('piloto');
            $table->unsignedBigInteger('servicio');
            $table->date('fecha_inicio');
            $table->time('hora_inicio');
            $table->date('fecha_final');
            $table->time('hora_final');
            $table->longText('observaciones')->nullable();
            $table->enum('estado', ['Aprobado', 'Pendiente', 'Rechazado'])->default('Pendiente');
            $table->foreign('destino')->references('id')->on('puerto_or_destinos');
            $table->foreign('agencia')->references('id')->on('agencias');
            $table->foreign('embarcacion')->references('id')->on('lanchas');
            $table->foreign('piloto')->references('id')->on('pilotos');
            $table->foreign('servicio')->references('id')->on('servicios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boleta_servicios');
    }
};
