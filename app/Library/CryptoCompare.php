<?php
/**
 * CryptoCompare.php
 *
 * @author      Dr. Max Ehsan <contact@kaijuscripts.com>
 * @copyright   2017 Dr. Max Ehsan
 */

namespace App\Library;

use Carbon\Carbon;
use lastguest\Murmur;

final class CryptoCompare extends CryptoApiBase
{
    /**
     * Get general information about all the coins available on cryptocompare.com
     *
     * @return array
     * @throws \Exception
     */
    public function coinList()
    {
        $url = CryptoCompareHelper::build_url('coinlist');
        $data = $this->fetchJson($url);
        $this->checkSuccess($data);
        $base_image_url = $data['BaseImageUrl'];
        $base_link_url = $data['BaseLinkUrl'];
        $coins = (array)$data['Data'];

        foreach ($coins as &$coin) {
            array_walk($coin, function (&$item, $key) use ($base_image_url, $base_link_url) {
                switch ($key) {
                    case 'Url':
                        $item = $base_link_url . $item;
                        break;
                    case 'ImageUrl':
                        $item = $base_image_url . $item;
                        break;
                    case 'TotalCoinSupply':
                    case 'FullyPremined':
                    case 'SortOrder':
                        $item = intval($item);
                        break;
                }
                if (strtolower($item) == 'n/a') {
                    $item = null;
                }
            });
        }

        return $coins;
    }

    /**
     * @param array $data
     * @throws \Exception
     */
    private function checkSuccess(array $data)
    {
        if (array_key_exists('Response', $data)) {
            if (strtolower($data['Response']) != 'success') {
                throw new \Exception($data['Message']);
            }
        } elseif (array_key_exists('Type', $data)) {
            if (intval($data['Type']) < 100) {
                throw new \Exception($data['Message']);
            }
        }
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function allExchanges()
    {
        return $this->fetchData('exchanges');
    }

    /**
     * @param string $func
     * @param array $query
     * @param string $key
     * @param bool $checkResponse
     * @return mixed
     * @throws \Exception
     */
    private function fetchData($func, $query = [], $key = 'Data', $checkResponse = true)
    {
        $url = CryptoCompareHelper::build_url($func);
        $data = $this->fetchJson($url, $query);

        if ($checkResponse) {
            $this->checkSuccess($data);
        }

        if (array_key_exists($key, $data)) {
            return $data[$key];
        }

        return null;
    }

    /**
     * Get top pairs by volume for a currency (always uses aggregated data)
     *
     * @param string $fsym
     * @param int $limit
     * @return mixed
     * @throws \Exception
     */
    public function topPairs($fsym, $limit = 10)
    {
        return $this->fetchData('pairs', ['fsym' => $fsym, 'limit' => $limit]);
    }

    /**
     * @param string $tsym
     * @return mixed
     * @throws \Exception
     */
    public function topVolumes($tsym)
    {
        return $this->fetchData('volumes', ['tsym' => $tsym]);
    }

    /**
     * @param string $fsym
     * @param string $tsym
     * @return mixed
     * @throws \Exception
     */
    public function topExchanges($fsym, $tsym)
    {
        return $this->fetchData('topexchanges', ['fsym' => $fsym, 'tsym' => $tsym]);
    }

    /**
     * @param array $fsyms
     * @param array $tsyms
     * @return mixed
     * @throws \Exception
     */
    public function priceMultiFull(array $fsyms, array $tsyms)
    {
        return $this->fetchData('pricemultifull',
            ['fsyms' => strtoupper(implode(',', $fsyms)), 'tsyms' => strtoupper(implode(',', $tsyms))],
            'RAW', false);
    }

    /**
     * Get blockchain information, aggregated data as well as data for the individual exchanges available
     * for the specified currency pair.
     *
     * @param string $fsym FROM symbol
     * @param string $tsym TO symbol
     * @return mixed
     * @throws \Exception
     */
    public function coinSnapshot($fsym, $tsym)
    {
        return $this->fetchData('coinsnapshot', ['fsym' => strtoupper($fsym), 'tsym' => strtoupper($tsym)]);
    }

    /**
     * @param string $fsym
     * @param string $tsym
     * @param int $aggregate
     * @param int|null $limit
     * @return mixed
     * @throws \Exception
     */
    public function histoDay($fsym, $tsym, $aggregate = 1, $limit = null)
    {
        return $this->getHistoricalData('day', $fsym, $tsym, 'all', true, $aggregate, $limit);
    }

    /**
     * @param string $freq Frequency of the data. Can be set to 'minute', 'hour' or 'day'.
     * @param string $fsym FROM symbol
     * @param string $tsym TO symbol
     * @param string $e Default returns average price across all exchanges. Can be set to the name of a single exchange.
     * @param bool $try_conversion If the crypto does not trade directly into the toSymbol requested, BTC will be
     *                             used for conversion. If set to false, it will try to get values without using
     *                             any conversion at all.
     * @param int $aggregate Aggregates the minute prices into bins of the specified size
     * @param int $limit Number of prices. The limit settings depend on the freq selected
     * @param bool $to_ts
     * @return mixed
     * @throws \Exception
     */
    private function getHistoricalData($freq, $fsym, $tsym, $e = 'all', $try_conversion = true, $aggregate = 1, $limit = null, $to_ts = false)
    {
        $query = [
            'fsym' => $fsym,
            'tsym' => $tsym,
            'try_conversion' => $try_conversion ? 'true' : 'false',
        ];

        if ($aggregate > 1) $query['aggregate'] = $aggregate;
        if ($limit !== null) $query['limit'] = $limit;
        if ($e != 'all') $query['e'] = $e;
        if ($to_ts !== false) $query['to_ts'] = $to_ts;

        $data = $this->fetchData($freq, $query);
        $this->checkSuccess($data);
        foreach ($data as &$d) {
            $d['date'] = CryptoCompareHelper::timestamp_to_date($d['time']);
        }

        return $data;
    }

    /**
     * @param string $fsym
     * @param string $tsym
     * @param int $aggregate
     * @param int|null $limit
     * @return mixed
     * @throws \Exception
     */
    public function histoMinute($fsym, $tsym, $aggregate = 1, $limit = null)
    {
        return $this->getHistoricalData('minute', $fsym, $tsym, 'all', true, $aggregate, $limit);
    }

    /**
     * @param string $fsym
     * @param string $tsym
     * @param int $aggregate
     * @param int|null $limit
     * @return mixed
     * @throws \Exception
     */
    public function histoHour($fsym, $tsym, $aggregate = 1, $limit = null)
    {
        return $this->getHistoricalData('hour', $fsym, $tsym, 'all', true, $aggregate, $limit);
    }

    /**
     * @return array
     * @throws \HttpException
     */
    public function news()
    {
        $rows = $this->fetchJson(CryptoCompareHelper::build_url('news/'));
        foreach ($rows as &$item) {
            //$item['published_on'] = CryptoCompareHelper::timestamp_to_datetime($item['published_on']);
            $item['published_on'] = Carbon::createFromTimestampUTC($item['published_on']);
            $item['tags'] = array_map(function ($s) {
                return trim($s);
            }, explode('|', strtolower($item['tags'])));
            $item['hashid'] = Murmur::hash3($item['guid']);
        }

        return $rows;
    }

    /**
     * @return mixed
     * @throws \HttpException
     */
    public function newsProviders()
    {
        return $this->fetchJson(CryptoCompareHelper::build_url('news/providers'));
    }
}