<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoods extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
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

        $filename = str_replace("\\", "/", storage_path('goods.csv'));
        $query = "LOAD DATA LOCAL INFILE '".$filename."' INTO TABLE goods
           CHARACTER SET cp1251
           FIELDS TERMINATED BY '~'
           ENCLOSED BY '`'
           LINES TERMINATED BY '|';";
        DB::unprepared($query);

        Schema::table('goods', function (Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();
        });

        $goods = DB::table('goods')->get();
        foreach ($goods as $good) {
            DB::table('goods')
                ->where('id', $good->id)
                ->update(['created_at' => $good->datetime]);
            if ($good->user_id == '' or $good->user_id == 0) {
                DB::table('goods')
                    ->where('id', $good->id)
                    ->update(['user_id' => null]);
            }
            if ($good->done_user_id == '' or $good->done_user_id == 0) {
                DB::table('goods')
                    ->where('id', $good->id)
                    ->update(['done_user_id' => null]);
            }
        }

        Schema::table('goods', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->change();
            $table->integer('category_id')->unsigned()->change();
            $table->integer('done_user_id')->unsigned()->change();
            $table->integer('company_id')->unsigned()->change();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('done_user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('good_categories');
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
        Schema::dropIfExists('goods');
    }
}
