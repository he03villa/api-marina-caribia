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
            $table->unsignedBigInteger('moto_nave')->nullable();
            $table->foreign('moto_nave')->references('id')->on('moto_naves');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('boleta_servicios', function (Blueprint $table) {
            $table->dropColumn('moto_nave');
        });
    }
};
