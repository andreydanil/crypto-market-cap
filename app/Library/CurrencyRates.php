<?php
/**
 * CurrencyRates.php
 *
 * @author     Dr. Max Ehsan <contact@kaijuscripts.com>
 * @copyright  2017 Dr. Max Ehsan
 */

namespace App\Library;

use DateTime;

class CurrencyRates extends CryptoApiBase
{
    const URL = 'https://api.fixer.io/';
    private $_verify_ssl;

    /**
     * Get latest currency exchange rates.
     *
     * @param string $base
     * @param array $targets
     * @return CurrencyRate
     * @throws \Exception
     */
    public function latest($base = 'USD', $targets = [])
    {
        return $this->query('latest', $base, $targets);
    }

    /**
     * Get historical currency exchange rates.
     *
     * @param  string $date 'latest' for latest, 'Y-m-d' date for historical.
     * @param  string $base
     * @param  array $targets
     * @return CurrencyRate
     * @throws \Exception
     */
    protected function query($date, $base, array $targets)
    {
        $url = self::URL . $date;
        $query = [];
        if ($base != 'EUR') {
            $query['base'] = $base;
        }

        // add symbols to query string
        if (!empty($targets)) {
            $query['symbols'] = implode(',', $targets);
        }

        $response = $this->fetchJson($url, $query, true);

        if (isset($response['rates']) && is_array($response['rates']) &&
            isset($response['base']) && isset($response['date'])) {
            return new CurrencyRate(
                $response['base'],
                new DateTime($response['date']),
                $response['rates']
            );
        } elseif (isset($response['error'])) {
            throw new \Exception($response['error']);
        } else {
            throw new \Exception('Response body is malformed.');
        }
    }
}