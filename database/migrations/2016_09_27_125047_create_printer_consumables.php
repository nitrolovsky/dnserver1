<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrinterConsumables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('printer_consumables', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id')->nullable();
            $table->string('datetime')->nullable();
            $table->text('text')->nullable();
            $table->string('done_at')->nullable();
            $table->string('status')->nullable();
            $table->string('done_user_id')->nullable();
            $table->string('category_id')->nullable();
            $table->text('done_comment')->nullable();
            $table->string('company_id')->nullable();
        });

        $filename = str_replace("\\", "/", storage_path('printer_consumables.csv'));
        $query = "LOAD DATA LOCAL INFILE '".$filename."' INTO TABLE printer_consumables
           CHARACTER SET cp1251
           FIELDS TERMINATED BY '~'
           ENCLOSED BY '`'
           LINES TERMINATED BY '|';";
        DB::unprepared($query);

        Schema::table('printer_consumables', function (Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();
        });

        $printer_consumables = DB::table('printer_consumables')->get();
        foreach ($printer_consumables as $printer_consumable) {
            DB::table('printer_consumables')
                ->where('id', $printer_consumable->id)
                ->update(['created_at' => $printer_consumable->datetime]);
            if ($printer_consumable->done_user_id == '' or $printer_consumable->done_user_id == 0) {
                DB::table('printer_consumables')
                    ->where('id', $printer_consumable->id)
                    ->update(['done_user_id' => null]);
            }
        }

        Schema::table('printer_consumables', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->change();
            $table->integer('category_id')->unsigned()->change();
            $table->integer('done_user_id')->unsigned()->change();
            $table->integer('company_id')->unsigned()->change();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('done_user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('printer_consumable_categories');
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
        Schema::dropIfExists('printer_consumables');
    }
}
