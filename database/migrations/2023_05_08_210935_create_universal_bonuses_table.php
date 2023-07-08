<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUniversalBonusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('universal_bonuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('prosents');
            $table->integer('count_person');
            $table->integer('user_ball');
            $table->integer('min_tree_ball');
            $table->integer('min_tree_count');
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
        Schema::dropIfExists('universal_bonuses');
    }
}
