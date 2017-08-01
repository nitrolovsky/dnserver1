<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('work_id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('date')->nullable();
            $table->text('text')->nullable();
        });

        $filename = str_replace("\\", "/", storage_path('work_comments.csv'));
        $query = "LOAD DATA LOCAL INFILE '".$filename."' INTO TABLE work_comments
           CHARACTER SET cp1251
           FIELDS TERMINATED BY '~'
           ENCLOSED BY '`'
           LINES TERMINATED BY '|';";
        DB::unprepared($query);

        Schema::table('work_comments', function (Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();
        });

        $work_comments = DB::table('work_comments')->get();
        foreach ($work_comments as $work_comment) {
            DB::table('work_comments')
                ->where('id', $work_comment->id)
                ->update(['created_at' => $work_comment->date]);
        }

        Schema::table('work_comments', function (Blueprint $table) {
            $table->integer('work_id')->unsigned()->change();
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
        Schema::dropIfExists('work_comments');
    }
}
