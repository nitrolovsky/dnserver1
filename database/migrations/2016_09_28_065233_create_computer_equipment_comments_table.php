<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComputerEquipmentCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('computer_equipment_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('computer_equipment_id')->nullable();
            $table->text('text')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->string('date')->nullable();
        });

        $filename = str_replace("\\", "/", storage_path('computer_equipment_comments.csv'));
        $query = "LOAD DATA LOCAL INFILE '".$filename."' INTO TABLE computer_equipment_comments
           CHARACTER SET cp1251
           FIELDS TERMINATED BY '~'
           ENCLOSED BY '`'
           LINES TERMINATED BY '|';";
        DB::unprepared($query);

        Schema::table('computer_equipment_comments', function (Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();
        });

        $computer_equipment_comments = DB::table('computer_equipment_comments')->get();
        foreach ($computer_equipment_comments as $computer_equipment_comment) {
            DB::table('computer_equipment_comments')
                ->where('id', $computer_equipment_comment->id)
                ->update(['created_at' => $computer_equipment_comment->date]);
        }

        Schema::table('computer_equipment_comments', function (Blueprint $table) {
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
        Schema::dropIfExists('computer_equipment_comments');
    }
}
