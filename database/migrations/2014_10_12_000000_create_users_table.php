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
        Schema::create('usuario', function (Blueprint $table) {
            $table->string('email', 45)->primary();
            $table->string('nombre', 25);
            $table->string('apellido', 25);
            $table->string('telefono', 10);
            $table->string('direccion', 45);
            $table->string('rut', 10);
            $table->string('password', 64);
            $table->integer('saldo');

            $table->integer('carro_activo')->nullable();

            $table->timestamps();
            // $table->timestamp('email_verified_at')->nullable();
            // $table->rememberToken();
        });

        Schema::create('admin', function (Blueprint $table) {
            $table->string('email', 45)->primary();
            $table->string('nombre', 25);
            $table->string('password', 64);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario');
        Schema::dropIfExists('admin');
    }
};
