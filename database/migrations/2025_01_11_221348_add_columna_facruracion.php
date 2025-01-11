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
        Schema::table('boleta_servicios', function (Blueprint $table) {
            $table->enum('facturacion', ['Por Facturar', 'Facturado'])->default('Por Facturar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('boleta_servicios', function (Blueprint $table) {
            $table->dropColumn('facturacion');
        });
    }
};
