<?php

use App\Models\Facturas;
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
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->longText('numero_factura');
            $table->foreignId('boleta_servicio_id')->constrained()->onDelete('cascade');
            $table->double('total', 12, 2)->default(0);
            $table->enum('estado', [Facturas::PAGADA, FacturaS::PENDIENTE, FacturaS::CANCELADA])->default(FacturaS::PENDIENTE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};
