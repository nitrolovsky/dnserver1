<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use App\Department;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('parent_id')->nullable();
        });

        $filename = str_replace("\\", "/", storage_path('departments.csv'));
        $query = "LOAD DATA LOCAL INFILE '".$filename."' INTO TABLE departments
           CHARACTER SET cp1251
           FIELDS TERMINATED BY '~'
           ENCLOSED BY ''
           LINES TERMINATED BY '\n';";
        DB::unprepared($query);

        Schema::table('departments', function (Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();
        });

        $departments = DB::table('departments')->get();
        foreach ($departments as $department) {
            if ($department->parent_id == 0 or $department->parent_id == '') {
                DB::table('departments')
                    ->where('id', $department->id)
                    ->update(['parent_id' => null]);
            }
        }

        Schema::table('departments', function (Blueprint $table) {
            $table->integer('parent_id')->unsigned()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('departments');
    }
}
