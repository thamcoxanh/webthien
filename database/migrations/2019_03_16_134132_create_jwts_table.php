<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJwtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jwts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('token');
            $table->string('user_id');
            $table->string('client_id')->nullable();
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
        Schema::dropIfExists('jwts');
    }
    class Jwt extends Model
    {
        protected $fillable = ['token', 'user_id','client_id'];
    }
}
