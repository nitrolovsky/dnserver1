<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInformationSystemCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('information_system_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('information_system_id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('date')->nullable();
            $table->text('text')->nullable();
        });

        $filename = str_replace("\\", "/", storage_path('information_system_comments.csv'));
        $query = "LOAD DATA LOCAL INFILE '".$filename."' INTO TABLE information_system_comments
           CHARACTER SET cp1251
           FIELDS TERMINATED BY '~'
           ENCLOSED BY '`'
           LINES TERMINATED BY '|';";
        DB::unprepared($query);

        Schema::table('information_system_comments', function (Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();
        });

        $information_system_comments = DB::table('information_system_comments')->get();
        foreach ($information_system_comments as $information_system_comment) {
            DB::table('information_system_comments')
                ->where('id', $information_system_comment->id)
                ->update(['created_at' => $information_system_comment->date]);
        }

        Schema::table('information_system_comments', function (Blueprint $table) {
            $table->integer('information_system_id')->unsigned()->change();
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
        Schema::dropIfExists('information_system_comments');
    }
}
