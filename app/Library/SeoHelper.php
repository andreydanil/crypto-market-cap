<?php
/**
 * SeoHelper.php
 *
 * @author     Dr. Max Ehsan <contact@kaijuscripts.com>
 * @copyright  2017 Dr. Max Ehsan
 */

namespace App\Library;

final class SeoHelper
{
    public static function metaDescription($coin = null)
    {
        if (!isset($coin)) {
            return 'We bring you all the latest streaming pricing data in the world of cryptocurrencies. Whether you are just interested in the Bitcoin price or you want to see the latest Ethereum volume, we have all the data available at your fingertips. Join our website, get daily market updates and gain access to the latest news and best reviews in the cryptocurrency arena.';
        }

        $template = <<<'EOT'
Live @NAME@ prices from all markets and @SYMBOL@ coin market Capitalization. Stay up to date with the latest @NAME@  price movements and discussion. Check out our snapshot charts and see when there is an opportunity to buy or sell @NAME@.
EOT;
        $result = str_replace('@NAME@', $coin->name, $template);
        $result = str_replace('@SYMBOL@', $coin->symbol, $result);
        return $result;
    }

    public static function metaKeywords($coin = null)
    {
        $keywords = ['cryptocurrency', 'cryptocoin', 'bitcoin', 'ethereum', 'litecoin', 'market cap'];
        if (isset($coin)) {
            $name = strtolower($coin->name);
            if (!in_array($name, $keywords))
                $keywords[] = $name;
        }

        return implode(',', $keywords);
    }

    public static function title($coin = null)
    {
        if (isset($coin)) {
            return "{$coin->name} ({$coin->symbol}) - Live {$coin->name} price, charts and market capitalization";
        }
        return 'Live cryptocurrency prices, market capitalization, trades, volumes, news and reviews';
    }
}