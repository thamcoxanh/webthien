<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('time')->nullable();
            $table->string('date')->nullable();
            $table->string('client_id')->nullable();
            $table->string('week');
            $table->text('year')->nullable();
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
        Schema::dropIfExists('history_users');
    }
  
}
