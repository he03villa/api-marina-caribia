<?php

use App\Models\TarifasConcepto;
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
        Schema::create('tarifas_conceptos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('concepto_servicio_id')->constrained()->onDelete('cascade');
            $table->foreignId('puerto_or_destino_id')->constrained()->onDelete('cascade');
            $table->enum('tipo_cliente', [TarifasConcepto::REGULAR, TarifasConcepto::PLENA, TarifasConcepto::OCEANICA, TarifasConcepto::SEABOARD, TarifasConcepto::GRUPO, TarifasConcepto::SOCIEDAD, TarifasConcepto::CARSEA, TarifasConcepto::RM, TarifasConcepto::RMP, TarifasConcepto::CMA])->default(TarifasConcepto::REGULAR);
            $table->double('tarifa', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarifas_conceptos');
    }
};
