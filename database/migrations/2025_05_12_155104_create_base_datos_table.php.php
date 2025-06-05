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
                Schema::connection('servidores')->create('database.base_datos', function (Blueprint $table) {
            $table->id(); // Columna 'id' auto-incremental
            $table->string('nombre_servidor');
            $table->string('nombre_database');
            $table->string('ip_database');
            $table->string('puerto');
            $table->foreignId('ambiente_id')->nullable()->constrained('public.ambientes');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
                // Elimina la tabla si se revierte la migración
                Schema::connection('servidores')->dropIfExists('database.base_datos');
    }
};
