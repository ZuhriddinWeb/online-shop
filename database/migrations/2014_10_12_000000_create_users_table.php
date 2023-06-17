<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->integer('parent_id')->nullable();
            $table->string('role')->nullable();
            $table->string('fname');
            $table->string('lname');
            $table->string('passport');
            $table->string('phone');
            $table->string('promo_code');
            $table->string('code')->nullable();
            $table->integer('status')->nullable();
            $table->string('phone_two')->nullable(); 
            $table->string('address')->nullable();            
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
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
