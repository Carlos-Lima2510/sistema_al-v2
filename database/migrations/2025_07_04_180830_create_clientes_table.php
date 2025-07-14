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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id('id_cliente');
            $table->string('nombre_cliente');
            $table->string('email')->nullable();
            $table->integer('telefono')->unique();
            $table->string('direccion')->nullable()->unique();
            $table->char('numero_identificacion', 10)->nullable()->unique();
            $table->enum('tipo_cliente', ['Minorista', 'Mayorista', 'Frecuente', 'Nuevo']);
            $table->text('notas')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
