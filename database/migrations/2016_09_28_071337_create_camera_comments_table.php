<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCameraCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('camera_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('camera_id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('date')->nullable();
            $table->text('text')->nullable();
        });

        $filename = str_replace("\\", "/", storage_path('camera_comments.csv'));
        $query = "LOAD DATA LOCAL INFILE '".$filename."' INTO TABLE camera_comments
           CHARACTER SET cp1251
           FIELDS TERMINATED BY '~'
           ENCLOSED BY '`'
           LINES TERMINATED BY '|';";
        DB::unprepared($query);

        Schema::table('camera_comments', function (Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();
        });

        $camera_comments = DB::table('camera_comments')->get();
        foreach ($camera_comments as $camera_comment) {
            DB::table('camera_comments')
                ->where('id', $camera_comment->id)
                ->update(['created_at' => $camera_comment->date]);
        }

        Schema::table('camera_comments', function (Blueprint $table) {
            $table->integer('camera_id')->unsigned()->change();
            $table->integer('user_id')->unsigned()->change();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('camera_comments');
    }
}
