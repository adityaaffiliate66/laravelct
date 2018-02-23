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
            $table->integer('coin_rank');
            $table->float('price_usd');
            $table->float('price_btc');
            $table->bigInteger('volume_usd_24h');
            $table->bigInteger('market_cap_usd');
            $table->bigInteger('available_supply');
            $table->bigInteger('total_supply');
            $table->bigInteger('max_supply')->nullable();;
            $table->float('percent_change_1h');
            $table->float('percent_change_24h');
            $table->float('percent_change_7d');
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
