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
        Schema::create('variantes', function (Blueprint $table) {
            $table->id('id_variantes');
            $table->unsignedBigInteger('id_producto');
            $table->unsignedBigInteger('id_codigo_color');
            $table->decimal('precio_unitario');
            $table->decimal('precio_por_mayor');
            $table->integer('stock');

            $table->foreign('id_codigo_color')
                ->references('id_codigo_color')
                ->on('codigo_color')
                ->onDelete('cascade');

            $table->foreign('id_producto')
                ->references('id_producto')
                ->on('productos')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variantes');
    }
};
