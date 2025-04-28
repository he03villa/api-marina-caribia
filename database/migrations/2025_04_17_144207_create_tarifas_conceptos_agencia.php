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
        Schema::create('tarifas_conceptos_agencia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('concepto_servicio_id')->constrained()->onDelete('cascade');
            $table->foreignId('agencia_id')->constrained()->onDelete('cascade');
            $table->double('tarifa', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarifas_conceptos_agencia');
    }
};
