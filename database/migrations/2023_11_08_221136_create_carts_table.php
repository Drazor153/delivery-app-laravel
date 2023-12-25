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
        Schema::create('carro', function (Blueprint $table) {
            // $table->timestamps();
            $table->id('id_carro');
            $table->string('email_usuario', 45);
            $table->integer('precio_total')->default(0);
            $table->string('fecha_pago')->nullable();
            $table->string('estado_delivery', 45)->nullable();

            // $table->timestamps();

        });

        Schema::create('linea_producto', function (Blueprint $table) {
            // $table->timestamps();
            $table->id('id_linea');
            $table->integer('id_carro');
            $table->string('codigo_producto', 10);
            $table->integer('cantidad');
            $table->integer('precio_linea');

            // $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carro');
        Schema::dropIfExists('linea_producto');
    }
};
