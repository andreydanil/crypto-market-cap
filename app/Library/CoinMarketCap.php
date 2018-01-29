<?php
/**
 * CoinMarketCap.php
 *
 * @author     Dr. Max Ehsan <contact@kaijuscripts.com>
 * @copyright  2017 Dr. Max Ehsan
 */

namespace App\Library;


use Carbon\Carbon;

final class CoinMarketCap extends CryptoApiBase
{
    const API_URL = 'https://api.coinmarketcap.com/v1/';

    /**
     * @param int $limit
     * @return mixed
     * @throws \HttpException
     */
    public function tickers($limit = 0)
    {
        $url = self::API_URL . 'ticker/';
        $data = $this->fetchJson($url, ['limit' => $limit]);
        $int_fields = ['rank',];
        $float_fields = ['price_usd', 'price_btc', 'market_cap_usd', '24h_volume_usd', 'available_supply',
            'total_supply', 'max_supply', 'percent_change_1h', 'percent_change_24h', 'percent_change_7d'];

        foreach ($data as &$item) {
            $item['symbol'] = strtoupper($item['symbol']);

            foreach ($int_fields as $f) {
                if (array_key_exists($f, $item))
                    $item[$f] = intval($item[$f]);
            }

            foreach ($float_fields as $f) {
                if (array_key_exists($f, $item))
                    $item[$f] = floatval($item[$f]);
            }
            //$item['last_updated'] = date('c', intval($item['last_updated']));
            $item['last_updated'] = Carbon::createFromTimestampUTC(intval($item['last_updated']));
        }

        return $data;
    }

    /**
     * @return mixed
     * @throws \HttpException
     */
    public function globals()
    {
        $url = self::API_URL . 'global/';
        $data = $this->fetchJson($url);

        $data['total_market_cap_usd'] = floatval($data['total_market_cap_usd']);
        $data['total_24h_volume_usd'] = floatval($data['total_24h_volume_usd']);
        $data['bitcoin_percentage_of_market_cap'] = floatval($data['bitcoin_percentage_of_market_cap']);
        $data['active_currencies'] = intval($data['active_currencies']);
        $data['active_assets'] = intval($data['active_assets']);
        $data['active_markets'] = intval($data['active_markets']);
        $data['last_updated'] = Carbon::createFromTimestampUTC(intval($data['last_updated']));

        return $data;
    }
}