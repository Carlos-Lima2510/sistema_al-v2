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
        Schema::create('codigo_color', function (Blueprint $table) {
            $table->id('id_codigo_color');
            $table->string('codigo');
            $table->string('nombre_color');
            $table->unsignedBigInteger('id_marca_material');

            $table->foreign('id_marca_material')
                ->references('id_marca_material')
                ->on('marca_material')
                ->onDelete('cascade');
            
            $table->unique(['codigo','id_marca_material']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('codigo_color');
    }
};
