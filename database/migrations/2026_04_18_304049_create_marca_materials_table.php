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
        Schema::create('marca_material', function (Blueprint $table) {
            $table->id('id_marca_material');
            $table->unsignedBigInteger('id_marca');
            $table->unsignedBigInteger('id_tipo_material');

            $table->foreign('id_marca')
                ->references('id_marca')
                ->on('marca')
                ->onDelete('cascade');

            $table->foreign('id_tipo_material')
                ->references('id_tipo_material')
                ->on('tipo_material')
                ->onDelete('cascade');

            $table->unique(['id_marca','id_tipo_material']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marca_material');
    }
};
