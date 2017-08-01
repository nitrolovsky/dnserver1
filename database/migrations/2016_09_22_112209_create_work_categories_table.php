<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        $filename = str_replace("\\", "/", storage_path('work_categories.csv'));
        $query = "LOAD DATA LOCAL INFILE '".$filename."' INTO TABLE work_categories
           CHARACTER SET cp1251
           FIELDS TERMINATED BY '~'
           ENCLOSED BY ''
           LINES TERMINATED BY '\n';";
        DB::unprepared($query);

        Schema::table('work_categories', function (Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('work_categories');
    }
}
