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
        Schema::create('producto', function (Blueprint $table) {
            // $table->id();
            // $table->timestamps();
            $table->string('codigo', 10)->primary();
            $table->string('nombre', 45);
            $table->integer('precio');
            $table->string('imagen', 100);
            $table->string('descripcion', 500);
            $table->integer('stock');
            $table->boolean('activo')->default(1);

            // $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto');
    }
};
