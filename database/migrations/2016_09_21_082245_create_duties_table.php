<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateDutiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('duties', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
        });

        $filename = str_replace("\\", "/", storage_path('duties.csv'));
        $query = "LOAD DATA LOCAL INFILE '".$filename."' INTO TABLE duties
           CHARACTER SET cp1251
           FIELDS TERMINATED BY '~'
           ENCLOSED BY ''
           LINES TERMINATED BY '\n';";
        DB::unprepared($query);

        Schema::table('duties', function (Blueprint $table) {
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
        Schema::drop('duties');
    }
}
