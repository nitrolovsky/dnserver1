<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use App\User;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('login')->unique();
            $table->string('password');
            $table->string('fio')->nullable();
            $table->string('duty_id')->nullable();
            $table->string('department_id')->nullable();
            $table->string('cabinet')->nullable();
            $table->string('phone')->nullable();
            $table->string('loginhash')->nullable();
            $table->string('access')->nullable();
            $table->string('email')->nullable();
            $table->string('datebirth')->nullable();
            $table->string('company_id')->nullable();
            $table->string('mobile')->nullable();
        });

        $filename = str_replace("\\", "/", storage_path('users.csv'));
        $query = "LOAD DATA LOCAL INFILE '".$filename."' INTO TABLE users
           CHARACTER SET cp1251
           FIELDS TERMINATED BY '~'
           ENCLOSED BY ''
           LINES TERMINATED BY '\n';";
        DB::unprepared($query);

        Schema::table('users', function (Blueprint $table) {
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            $table->string('birth_day')->nullable();
            $table->string('birth_month')->nullable();
        });

        $users = DB::table('users')->get();
        foreach ($users as $user) {
            if ($user->duty_id == '' or $user->duty_id == '0') {
                DB::table('users')
                    ->where('id', $user->id)
                    ->update(['duty_id' => null]);
            }
            if ($user->department_id == '' or $user->department_id == 0) {
                DB::table('users')
                    ->where('id', $user->id)
                    ->update(['department_id' => null]);
            }
            if ($user->cabinet == '' or $user->cabinet == '---') {
                DB::table('users')
                    ->where('id', $user->id)
                    ->update(['cabinet' => null]);
            }
            if ($user->phone == '' or $user->phone == '---' or $user->phone == '-----') {
                DB::table('users')
                    ->where('id', $user->id)
                    ->update(['phone' => null]);
            }
            if ($user->loginhash == '') {
                DB::table('users')
                    ->where('id', $user->id)
                    ->update(['loginhash' => null]);
            }
            if ($user->access == '') {
                DB::table('users')
                    ->where('id', $user->id)
                    ->update(['access' => null]);
            }
            if ($user->datebirth == '') {
                DB::table('users')
                    ->where('id', $user->id)
                    ->update(['datebirth' => null]);
            }
            if ($user->mobile == '' or $user->mobile == 0) {
                DB::table('users')
                    ->where('id', $user->id)
                    ->update(['mobile' => null]);
            }
            if ($user->datebirth != null) {
                $datebirth = new DateTime($user->datebirth);
                DB::table('users')
                    ->where('id', $user->id)
                    ->update([
                        'birth_day' => $datebirth->format('d'),
                        'birth_month' => $datebirth->format('m')
                    ]);
            }
        }

        Schema::table('users', function (Blueprint $table) {
            $table->integer('duty_id')->unsigned()->change();
            $table->integer('department_id')->unsigned()->change();
            $table->date('datebirth')->change();
            $table->integer('company_id')->unsigned()->change();
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('duty_id')->references('id')->on('duties');
        });

        $last_user = DB::table('users')->orderBy('id', 'desc')->first();
        for ($i = 1; $i <= $last_user->id; $i++) {
            $user = DB::table('users')->find($i);
            if ($user === null) {
                DB::table('users')->insert([
                    'id' => $i,
                    'login' => 'login' . $i,
                    'password' => md5('login' . $i),
                    'fio' => 'Пользователь № ' . $i . ' удален'
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
        Schema::drop('users');
    }
}
