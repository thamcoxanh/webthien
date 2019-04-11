<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('category_id')->nullable();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->text('images')->nullable();
            $table->text('file')->nullable();
            $table->string('price')->nullable();
            $table->string('type')->nullable();
            $table->string('price_paypal')->nullable();
            $table->string('time_play')->nullable();
            $table->string('icon')->nullable();
            $table->timestamps();
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
