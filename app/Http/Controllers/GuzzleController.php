<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Database\QueryException;
use GuzzleHttp\Client;
use App\Coin;

class GuzzleController extends Controller
{
    const BASE_URL = 'https://api.coinmarketcap.com/v1/';


    private function buildRequest($endpoint, $params = array())
    {
        $client = new Client();
        $url = $this->buildUrl(self::BASE_URL . $endpoint, $params);
        $request = $client->request('GET', $url);
        return $this->jsonDecode($request->getBody()->getContents());
    }

    private function buildUrl($url, $params = array())
    {
        $output = $url;
        if ($params) {
          $output .= '?' . http_build_query($params);
        }
        return $output;
    }

    public function getTicker($params = array())
    {
        return $this->buildRequest('ticker', $params);
    }

    private function jsonDecode($string)
    {
        return json_decode($string);
    }


    public static function getAllCryptoPrice(){
        $controller = new GuzzleController();

        $coins=$controller->getTicker();
        
        /*
         echo "<pre>";
         print_r($coins);
         echo "</pre>";
         */
         

         foreach ($coins as $coin) {
            $coin_model = new Coin();
            $coin_model->coin_id = $coin->id;
            $coin_model->coin_name = $coin->name;
            $coin_model->coin_symbol = $coin->symbol;
            $coin_model->coin_rank = $coin->rank;
            $coin_model->price_usd = $coin->price_usd;
            $coin_model->price_btc = $coin->price_btc;
            $coin_model->volume_usd_24h = $coin->{'24h_volume_usd'};
            $coin_model->market_cap_usd = $coin->market_cap_usd;
            $coin_model->available_supply = $coin->available_supply;
            $coin_model->total_supply = $coin->total_supply;
            $coin_model->max_supply = $coin->max_supply;
            $coin_model->percent_change_1h = $coin->percent_change_1h;
            $coin_model->percent_change_24h = $coin->percent_change_24h;
            $coin_model->percent_change_7d = $coin->percent_change_7d;
            $coin_model->save();

            echo $coin->name." Added \n";
        }

    }

    public static function updateAllCryptoPrice(){
        $controller = new GuzzleController();

        $coins=$controller->getTicker();
        
        /*
         echo "<pre>";
         print_r($coins);
         echo "</pre>";
         */
         

         foreach ($coins as $index => $coin) 
         {

            //echo $index+1;

            
            DB::table('coins')->where('coin_rank', $coin->rank)
            ->update([
              'coin_id' =>  $coin->id,
              'coin_name' =>$coin->name,
              'coin_symbol' => $coin->symbol,
              'coin_rank' => $coin->rank,
              'price_usd' => $coin->price_usd,
              'price_btc' => $coin->price_btc,
              'volume_usd_24h' => $coin->{'24h_volume_usd'},
              'market_cap_usd' => $coin->market_cap_usd,
              'available_supply' => $coin->available_supply,
              'total_supply' => $coin->total_supply,
              'max_supply' => $coin->max_supply,
              'percent_change_1h' => $coin->percent_change_1h,
              'percent_change_24h' => $coin->percent_change_24h,
              'percent_change_7d' => $coin->percent_change_7d
            ]);

            echo $coin->name." Updated \n";


            /*
            $coin_model = new Coin();
            $coin_model->coin_id = $coin->id;
            $coin_model->coin_name = $coin->name;
            $coin_model->coin_symbol = $coin->symbol;
            $coin_model->coin_rank = $coin->rank;
            $coin_model->price_usd = $coin->price_usd;
            $coin_model->price_btc = $coin->price_btc;
            $coin_model->volume_usd_24h = $coin->{'24h_volume_usd'};
            $coin_model->market_cap_usd = $coin->market_cap_usd;
            $coin_model->available_supply = $coin->available_supply;
            $coin_model->total_supply = $coin->total_supply;
            $coin_model->max_supply = $coin->max_supply;
            $coin_model->percent_change_1h = $coin->percent_change_1h;
            $coin_model->percent_change_24h = $coin->percent_change_24h;
            $coin_model->percent_change_7d = $coin->percent_change_7d;
            $coin_model->save();

            echo $coin->name." Updated \n";
            */
        }

    }


}
