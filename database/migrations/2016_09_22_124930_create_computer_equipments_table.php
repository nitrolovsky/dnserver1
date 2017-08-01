<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use App\ComputerEquipment;

class CreateComputerEquipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('computer_equipments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id')->nullable();
            $table->string('datetime')->nullable();
            $table->string('category_id')->nullable();
            $table->text('text')->nullable();
            $table->string('done_datetime')->nullable();
            $table->string('status')->nullable();
            $table->text('done_comment')->nullable();
            $table->string('done_user_id')->nullable();
            $table->string('cancel_date')->nullable();
            $table->string('company_id')->nullable();
        });

        $filename = str_replace("\\", "/", storage_path('computer_equipments.csv'));
        $query = "LOAD DATA LOCAL INFILE '".$filename."' INTO TABLE computer_equipments
           CHARACTER SET cp1251
           FIELDS TERMINATED BY '~'
           ENCLOSED BY '`'
           LINES TERMINATED BY '|';";
        DB::unprepared($query);

        Schema::table('computer_equipments', function (Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();
            $table->datetime('done_at')->nullable();
        });

        $computer_equipments = DB::table('computer_equipments')->get();
        foreach ($computer_equipments as $computer_equipment) {
            DB::table('computer_equipments')
                ->where('id', $computer_equipment->id)
                ->update(['created_at' => $computer_equipment->datetime]);

            if ($computer_equipment->done_user_id == '' or $computer_equipment->done_user_id == 0) {
                DB::table('computer_equipments')
                    ->where('id', $computer_equipment->id)
                    ->update(['done_user_id' => null]);
            }

            if ($computer_equipment->done_datetime == '' or $computer_equipment->done_datetime == 0) {
                DB::table('computer_equipments')
                    ->where('id', $computer_equipment->id)
                    ->update(['done_datetime' => null]);
            }
            if ($computer_equipment->done_datetime != null) {
                $done_datetime = new DateTime(substr($computer_equipment->done_datetime, 0, 18));
                DB::table('computer_equipments')
                    ->where('id', $computer_equipment->id)
                    ->update(['done_at' => $done_datetime->format('Y-m-d H:i:s')]);
            }
        }

        Schema::table('computer_equipments', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->change();
            $table->integer('category_id')->unsigned()->change();
            $table->integer('done_user_id')->unsigned()->change();
            $table->integer('company_id')->unsigned()->change();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('computer_equipment_categories');
            $table->foreign('done_user_id')->references('id')->on('users');
            $table->foreign('company_id')->references('id')->on('companies');
        });

        $last = DB::table('computer_equipments')->orderBy('id', 'desc')->first();
        for ($i = 1; $i <= $last->id; $i++) {
            $computer_equipment = DB::table('computer_equipments')->find($i);
            if ($computer_equipment === null) {
                DB::table('computer_equipments')->insert([
                    'id' => $i,
                    'text' => 'Заявка № ' . $i . ' удалена.',
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('computer_equipments');
    }
}
