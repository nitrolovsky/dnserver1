<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCamerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cameras', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id')->nullable();
            $table->string('datetime')->nullable();
            $table->text('text')->nullable();
            $table->string('done_at')->nullable();
            $table->string('status')->nullable();
            $table->string('done_user_id')->nullable();
            $table->string('category_id')->nullable();
            $table->text('done_comment')->nullable();
            $table->string('company_id')->nullable();
        });

        $filename = str_replace("\\", "/", storage_path('cameras.csv'));
        $query = "LOAD DATA LOCAL INFILE '".$filename."' INTO TABLE cameras
           CHARACTER SET cp1251
           FIELDS TERMINATED BY '~'
           ENCLOSED BY '`'
           LINES TERMINATED BY '|';";
        DB::unprepared($query);

        Schema::table('cameras', function (Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();
        });

        $cameras = DB::table('cameras')->get();
        foreach ($cameras as $camera) {
            DB::table('cameras')
                ->where('id', $camera->id)
                ->update(['created_at' => $camera->datetime]);
            if ($camera->done_user_id == '' or $camera->done_user_id == 0) {
                DB::table('cameras')
                    ->where('id', $camera->id)
                    ->update(['done_user_id' => null]);
            }
        }

        Schema::table('cameras', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->change();
            $table->integer('category_id')->unsigned()->change();
            $table->integer('done_user_id')->unsigned()->change();
            $table->integer('company_id')->unsigned()->change();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('done_user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('camera_categories');
            $table->foreign('company_id')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cameras');
    }
}
