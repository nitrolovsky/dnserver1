<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrinterConsumableCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('printer_consumable_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('printer_consumable_id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('date')->nullable();
            $table->text('text')->nullable();
        });

        $filename = str_replace("\\", "/", storage_path('printer_consumable_comments.csv'));
        $query = "LOAD DATA LOCAL INFILE '".$filename."' INTO TABLE printer_consumable_comments
           CHARACTER SET cp1251
           FIELDS TERMINATED BY '~'
           ENCLOSED BY '`'
           LINES TERMINATED BY '|';";
        DB::unprepared($query);

        Schema::table('printer_consumable_comments', function (Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();
        });

        $printer_consumable_comments = DB::table('printer_consumable_comments')->get();
        foreach ($printer_consumable_comments as $printer_consumable_comment) {
            DB::table('printer_consumable_comments')
                ->where('id', $printer_consumable_comment->id)
                ->update(['created_at' => $printer_consumable_comment->date]);
        }

        Schema::table('printer_consumable_comments', function (Blueprint $table) {
            $table->integer('printer_consumable_id')->unsigned()->change();
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
        Schema::dropIfExists('printer_consumable_comments');
    }
}
