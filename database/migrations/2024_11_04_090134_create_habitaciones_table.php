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
        Schema::create('habitaciones', function (Blueprint $table) {
            $table->id();
            $table->string('identificador', 5)->unique();
            $table->integer('piso');
            $table->string('tipo', 13);
            $table->string('disponibilidad', 11);
            $table->integer('numPersonas');
            $table->float('precio');
            $table->foreignId('sede_id')->references('id')->on('sedes')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('habitaciones');
    }
};
