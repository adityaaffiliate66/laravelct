<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coin extends Model
{
    protected $fillable = [
        'coin_id',
        'coin_name',
        'coin_symbol',
        'coin_rank',
        'price_usd',
        'price_btc',
        'volume_usd_24h',
        'market_cap_usd',
        'available_supply',
        'total_supply',
        'max_supply',
        'percent_change_1h',
        'percent_change_24h',
        'percent_change_7d'
    ];
}
