<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use App\Post;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category_id')->nullable();
            $table->text('simple_text')->nullable();
            $table->text('full_text')->nullable();
            $table->text('text')->nullable();
            $table->string('date')->nullable();
            $table->string('enabled')->nullable();
        });

        $filename = str_replace("\\", "/", storage_path('posts.csv'));
        $query = "LOAD DATA LOCAL INFILE '".$filename."' INTO TABLE posts
           CHARACTER SET cp1251
           FIELDS TERMINATED BY '~'
           ENCLOSED BY '`'
           LINES TERMINATED BY '|';";
        DB::unprepared($query);

        Schema::table('posts', function (Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();
            $table->integer('category_id')->unsigned()->change();
            $table->dateTime('date')->change();
        });

        $posts = DB::table('posts')->get();
        foreach ($posts as $post) {
            DB::table('posts')
                ->where('id', $post->id)
                ->update(['created_at' => $post->date]);
            DB::table('posts')
                ->where('enabled', 'like', '%True%')
                ->update(['enabled' => 1]);
            DB::table('posts')
                ->where('enabled', 'like', '%False%')
                ->update(['enabled' => 0]);
        }

        Schema::table('posts', function (Blueprint $table) {
             $table->dropColumn('date');
             $table->foreign('category_id')->references('id')->on('post_categories');
             $table->boolean('enabled')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('posts');
    }
}
