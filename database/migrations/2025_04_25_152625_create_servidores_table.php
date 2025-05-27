<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServidoresTable extends Migration
{
    public function up()
    {

        Schema::connection('servidores')->create('servidores.servidores', function (Blueprint $table) {
            $table->id(); // Columna 'id' auto-incremental
            $table->string('nombre_servidores');
            $table->string('ip_servidores');
            $table->string('puerto');
            $table->foreignId('ambiente_id')->nullable()->constrained('public.ambientes');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        // Elimina la tabla si se revierte la migración
        Schema::connection('servidores')->dropIfExists('servidores.servidores');
    }
}
