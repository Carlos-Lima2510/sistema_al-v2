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
        Schema::create('variante_especificaciones', function (Blueprint $table) {
            $table->id('id_variante_especificaciones');
            $table->unsignedBigInteger('id_variantes');
            $table->unsignedBigInteger('id_especificaciones');
            $table->string('valor', 100);

            $table->foreign('id_variantes')
                ->references('id_variantes')
                ->on('variantes')
                ->onDelete('cascade');
            
            $table->foreign('id_especificaciones')
                ->references('id_especificaciones')
                ->on('especificaciones')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variante_especificacions');
    }
};
