<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComputerEquipmentCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('computer_equipment_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        $filename = str_replace("\\", "/", storage_path('computer_equipment_categories.csv'));
        $query = "LOAD DATA LOCAL INFILE '".$filename."' INTO TABLE computer_equipment_categories
           CHARACTER SET cp1251
           FIELDS TERMINATED BY '~'
           ENCLOSED BY ''
           LINES TERMINATED BY '\n';";
        DB::unprepared($query);

        Schema::table('computer_equipment_categories', function (Blueprint $table) {
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
        Schema::drop('computer_equipment_categories');
    }
}
