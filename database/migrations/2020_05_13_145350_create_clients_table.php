<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nombre');
            $table->string('telefono');
            $table->string('direccion');
            $table->string('email');
            $table->foreignId('documento_id')
            ->constrained('tipo_doc')->onDelete('cascade');
           
            $table->string('nro_documento');
            $table->string('grupo');
            $table->string('pedidos');
            $table->string('credito_max');
            $table->string('credito_restante');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
