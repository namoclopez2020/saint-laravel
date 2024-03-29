<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nombre');
            $table->string('codigo')->unique();
            $table->string('costo_anterior');
            $table->string('costo_promedio');
            $table->string('costo_actual');
            $table->string('precio1');
            $table->string('precio2');
            $table->string('precio3');
            $table->foreignId('categorie_id')
            ->constrained('categories')->onDelete('cascade');
            $table->boolean('es_serial');
            $table->foreignId('warehouse_id')
            ->constrained('warehouses')->onDelete('cascade');
            $table->string('impuesto')->default('0');
            $table->boolean('usa_empaque');
            $table->string('medida_paq')->nullable();
            $table->string('medida_und');
            $table->integer('fraccion')->unsigned()->default(0);
            $table->string('stock_paq')->nullable();
            $table->string('stock_und')->nullable();
            $table->string('min_paq')->default('0');
            $table->string('min_und')->default('0'); 

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
