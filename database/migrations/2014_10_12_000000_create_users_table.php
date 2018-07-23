<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $currenttime = \Carbon\Carbon::now()->toDateTimeString();


        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('email2')->nullable();
            $table->string('status')->default('A');
            $table->string('language')->default('en');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert(array(
            array('name' => 'Khaw Huai Chee', 'email' => 'huaichee89@mail.com', 'password' =>'$2y$10$lyC6vT8rKz9vGPrPf4rYzuyMXwjWUfnmutgh9vSwb79/EY1wh8/sy', 'created_at' => $currenttime, 'updated_at' => $currenttime),
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
