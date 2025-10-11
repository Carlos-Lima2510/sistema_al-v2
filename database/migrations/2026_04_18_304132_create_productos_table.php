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
        Schema::create('productos', function (Blueprint $table) {
            $table->id('id_producto');
            $table->unsignedBigInteger('id_categoria');
            $table->unsignedBigInteger('id_marca_material');
            $table->decimal('costo_base');
            $table->boolean('activo');
            $table->text('descripcion');
            $table->dateTime('fecha_registro');

            $table->foreign('id_categoria')
                ->references('id_categoria')
                ->on('categoria')
                ->onDelete('cascade');

            $table->foreign('id_marca_material')
                ->references('id_marca_material')
                ->on('marca_material')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
