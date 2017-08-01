<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use App\InformationSystem;

class CreateInformationSystems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('information_systems', function (Blueprint $table) {
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

        $filename = str_replace("\\", "/", storage_path('information_systems.csv'));
        $query = "LOAD DATA LOCAL INFILE '".$filename."' INTO TABLE information_systems
           CHARACTER SET cp1251
           FIELDS TERMINATED BY '~'
           ENCLOSED BY '`'
           LINES TERMINATED BY '|';";
        DB::unprepared($query);

        Schema::table('information_systems', function (Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();
        });

        $information_systems = DB::table('information_systems')->get();
        foreach ($information_systems as $information_system) {
            DB::table('information_systems')
                ->where('id', $information_system->id)
                ->update(['created_at' => $information_system->datetime]);
            if ($information_system->done_user_id == '' or $information_system->done_user_id == 0) {
                DB::table('information_systems')
                    ->where('id', $information_system->id)
                    ->update(['done_user_id' => null]);
            }
        }

        Schema::table('information_systems', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->change();
            $table->integer('category_id')->unsigned()->change();
            $table->integer('done_user_id')->unsigned()->change();
            $table->integer('company_id')->unsigned()->change();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('done_user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('information_system_categories');
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
        Schema::dropIfExists('information_systems');
    }
}
