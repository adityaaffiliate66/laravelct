<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('coin_id');
            $table->string('coin_name');
            $table->string('coin_symbol');
            $table->string('coin_rank');
            $table->string('price_usd');
            $table->string('price_btc');
            $table->string('volume_usd_24h');
            $table->string('market_cap_usd');
            $table->string('available_supply');
            $table->string('total_supply');
            $table->string('max_supply')->nullable();;
            $table->string('percent_change_1h');
            $table->string('percent_change_24h');
            $table->string('percent_change_7d');
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
        Schema::dropIfExists('coins');
    }
}
