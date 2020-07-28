<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
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
            $table->id();
            $table->string('firstName');
            $table->string('lastName');
            $table->integer('role')->default(0);//0:normal,1:admin
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');            
            $table->unsignedBigInteger('position_id');
            $table->foreign('position_id')->references('id')->on('positions');
            $table->rememberToken();
            $table->timestamps();
        });

        //Insert the default admin user
        DB::table('users')->insert(
            array(
                'firstName' => 'admin',
                'lastName' => 'user',
                'email' => 'admin@example.com',
                'position_id' => 1,
                'role'=>1,
                'password' => bcrypt('password'),
                'remember_token' => Str::random(10)
            )
        );

        //Insert the default normal user
        DB::table('users')->insert(
            array(
                'firstName' => 'normal',
                'lastName' => 'user',
                'email' => 'normal@example.com',
                'position_id' => 4,
                'password' => bcrypt('password'),
                'remember_token' => Str::random(10)
            )
        );

  
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
