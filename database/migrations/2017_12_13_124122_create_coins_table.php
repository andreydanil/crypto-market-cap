<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coins', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('coin_id', 32)->nullable()->index();
            $table->string('name', 180)->index();
            $table->string('symbol', 32)->unique();
            $table->string('logo', 180)->nullable();
            $table->decimal('price_usd', 16, 4)->nullable();
            $table->decimal('price_btc', 16, 4)->nullable();
            $table->decimal('volume_usd_24h', 24, 2)->nullable();
            $table->decimal('market_cap_usd', 24, 2)->nullable();
            $table->decimal('available_supply', 24, 2)->nullable();
            $table->decimal('total_supply', 24, 2)->nullable();
            $table->decimal('max_supply', 24, 2)->nullable();
            $table->decimal('percent_change_1h', 12, 4)->nullable();
            $table->decimal('percent_change_24h', 12, 4)->nullable();
            $table->decimal('percent_change_7d', 12, 4)->nullable();
            $table->string('proof_type', 120)->nullable();
            $table->string('website')->nullable();
            $table->string('twitter')->nullable();
            $table->text('description')->nullable();
            $table->text('features')->nullable();
            $table->text('technology')->nullable();
            $table->text('algorithm')->nullable();
            $table->date('start_date')->nullable();
            $table->timestamp('last_updated')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coins');
    }
}
