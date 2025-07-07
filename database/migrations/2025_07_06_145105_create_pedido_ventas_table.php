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
        Schema::create('pedido_ventas', function (Blueprint $table) {
            $table->id('id_pedido_venta');
            $table->unsignedBigInteger('id_cliente');
            $table->dateTime('fecha_pedido');
            $table->enum('metodo_pago', ['Efectivo', 'Transferencia', 'Tarjeta']);
            $table->enum('estado', ['Pendiente', 'En proceso', 'Completado', 'Cancelado']);
            $table->decimal('total');
            $table->text('observaciones')->nullable();

            $table->foreign('id_cliente')
                ->references('id_cliente')
                ->on('clientes')
                ->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedido_ventas');
    }
};
