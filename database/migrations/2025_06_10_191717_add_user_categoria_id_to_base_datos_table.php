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
        Schema::connection('servidores')->table('database.base_datos', function (Blueprint $table) {
            $table->foreignId('user_categoria_id')->nullable(); // Agregar el campo user_categoria_id
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('servidores')->table('database.base_datos', function (Blueprint $table) {
            $table->dropColumn('user_categoria_id'); // Eliminar el campo user_categoria_id
        });
    }
};
