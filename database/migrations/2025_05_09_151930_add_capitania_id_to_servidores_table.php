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
        Schema::connection('servidores')->table('servidores.servidores', function (Blueprint $table) {
            $table->integer('capitania_id')->nullable(); // Agregar el campo capitania_id
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('servidores')->table('servidores.servidores', function (Blueprint $table) {
            $table->dropColumn('capitania_id'); // Eliminar el campo capitania_id
        });
    }
};
