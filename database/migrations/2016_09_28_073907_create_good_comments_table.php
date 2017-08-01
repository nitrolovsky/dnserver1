<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('good_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('good_id')->nullable();
            $table->text('text')->nullable();
            $table->string('user_id')->nullable();
            $table->string('date')->nullable();
        });

        $filename = str_replace("\\", "/", storage_path('good_comments.csv'));
        $query = "LOAD DATA LOCAL INFILE '".$filename."' INTO TABLE good_comments
           CHARACTER SET cp1251
           FIELDS TERMINATED BY '~'
           ENCLOSED BY '`'
           LINES TERMINATED BY '|';";
        DB::unprepared($query);

        Schema::table('good_comments', function (Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();
        });

        $good_comments = DB::table('good_comments')->get();
        foreach ($good_comments as $good_comment) {
            DB::table('good_comments')
                ->where('id', $good_comment->id)
                ->update(['created_at' => $good_comment->date]);
        }

        Schema::table('good_comments', function (Blueprint $table) {
            $table->integer('good_id')->unsigned()->change();
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
        Schema::dropIfExists('good_comments');
    }
}
