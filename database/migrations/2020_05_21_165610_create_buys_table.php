<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buys', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('provider_id')->constrained('providers')->onDelete('cascade');
            $table->string('costo_total_compra');
            $table->string('pagado');
            $table->integer('metodo_pago');
            $table->foreignId('office_id')->constrained('offices')->onDelete('cascade');
            $table->integer('status_compra');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buys');
    }
}
