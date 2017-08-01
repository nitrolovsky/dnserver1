<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInformationSystemCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('information_system_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        $filename = str_replace("\\", "/", storage_path('information_system_categories.csv'));
        $query = "LOAD DATA LOCAL INFILE '".$filename."' INTO TABLE information_system_categories
           CHARACTER SET cp1251
           FIELDS TERMINATED BY '~'
           ENCLOSED BY ''
           LINES TERMINATED BY '\n';";
        DB::unprepared($query);

        Schema::table('information_system_categories', function (Blueprint $table) {
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
        Schema::drop('information_system_categories');
    }
}
