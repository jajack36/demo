<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQueryLimitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('query_limit', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('offset')->default(0);
            $table->integer('limit')->default(10000);
            $table->timestamps();

            $table->index(["id"], 'idx_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('query_limit');
    }
}
