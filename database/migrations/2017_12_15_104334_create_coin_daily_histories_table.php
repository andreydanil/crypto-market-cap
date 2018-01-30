<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoinDailyHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coin_daily_histories', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('symbol', 20)->index();
            $table->date('date')->index();
            $table->unsignedBigInteger('timestamp')->default(0);
            $table->decimal('value', 20, 10)->default(0);
            $table->unsignedBigInteger('volume')->default(0);
            $table->dateTime('last_updated')->useCurrent();

            $table->unique(['symbol', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coin_daily_histories');
    }
}
