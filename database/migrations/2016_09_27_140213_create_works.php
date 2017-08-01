<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('works', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id')->nullable();
            $table->string('datetime')->nullable();
            $table->string('category_id')->nullable();
            $table->text('text')->nullable();
            $table->string('done_at')->nullable();
            $table->string('status')->nullable();
            $table->text('done_comment')->nullable();
            $table->string('done_user_id')->nullable();
            $table->string('cancel_date')->nullable();
            $table->string('company_id')->nullable();
        });

        $filename = str_replace("\\", "/", storage_path('works.csv'));
        $query = "LOAD DATA LOCAL INFILE '".$filename."' INTO TABLE works
           CHARACTER SET cp1251
           FIELDS TERMINATED BY '~'
           ENCLOSED BY '`'
           LINES TERMINATED BY '|';";
        DB::unprepared($query);

        Schema::table('works', function (Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();
        });

        $works = DB::table('works')->get();
        foreach ($works as $work) {
            DB::table('works')
                ->where('id', $work->id)
                ->update(['created_at' => $work->datetime]);
            if ($work->user_id == '' or $work->user_id == 0) {
                DB::table('works')
                    ->where('id', $work->id)
                    ->update(['user_id' => null]);
            }
            if ($work->done_user_id == '' or $work->done_user_id == 0) {
                DB::table('works')
                    ->where('id', $work->id)
                    ->update(['done_user_id' => null]);
            }
        }

        Schema::table('works', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->change();
            $table->integer('category_id')->unsigned()->change();
            $table->integer('done_user_id')->unsigned()->change();
            $table->integer('company_id')->unsigned()->change();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('done_user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('work_categories');
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
        Schema::dropIfExists('works');
    }
}
