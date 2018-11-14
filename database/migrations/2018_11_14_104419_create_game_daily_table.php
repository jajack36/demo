<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameDailyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_daily', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id', 20)->default('');
            $table->decimal('amount', 10, 2)->default(0);
            $table->decimal('result', 10, 2)->default(0);
            $table->date('bet_time');
            $table->timestamps();

            $table->index(["user_id"], 'idx_user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_daily');
    }
}
