<?php
/**
 * CryptoApiBase.php
 *
 * @author     Dr. Max Ehsan <contact@kaijuscripts.com>
 * @copyright  2017 Dr. Max Ehsan
 */

namespace App\Library;


use GuzzleHttp\Client;
use HttpException;

abstract class CryptoApiBase
{
    protected $verify_ssl;

    public function __construct($verify_ssl = false)
    {
        $this->verify_ssl = $verify_ssl;
    }

    /**
     * @param string $url
     * @param array $query
     * @param bool $assoc
     * @return mixed
     * @throws HttpException
     */
    protected function fetchJson($url, array $query = [], $assoc = true)
    {
        $options = [
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36',
                'Accept' => 'application/json',
                'Accept-Encoding' => 'gzip',
            ],
        ];
        if (count($query) > 0) {
            $options = ['query' => $query];
        }

        $client = new Client(['verify' => $this->verify_ssl]);
        $response = $client->request('GET', $url, $options);
        if ($response->getStatusCode() != 200) {
            throw new HttpException($response->getStatusCode());
        }

        return json_decode($response->getBody(), $assoc);
    }
}