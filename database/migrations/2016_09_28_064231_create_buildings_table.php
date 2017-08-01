<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuildingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buildings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('number')->nullable();
            $table->string('name_object')->nullable();
            $table->string('address')->nullable();
            $table->string('section')->nullable();
            $table->string('target')->nullable();
            $table->string('delivery_date')->nullable();
            $table->string('return_date')->nullable();
            $table->text('note')->nullable();
            $table->integer('status')->unsigned()->nullable();
            $table->integer('done_user_id')->unsigned()->nullable();
            $table->datetime('done_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('done_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buildings');
    }
}
