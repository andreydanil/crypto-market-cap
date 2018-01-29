<?php
/**
 * CryptoCompareHelper.php
 *
 * @author      Dr. Max Ehsan <contact@kaijuscripts.com>
 * @copyright   2017 Dr. Max Ehsan
 */

namespace App\Library;

class CryptoCompareHelper
{
    const BASE_URL = 'https://min-api.cryptocompare.com/data/';

    public static function build_url($func)
    {
        switch ($func) {
            case 'allexchanges':
            case 'coinlist':
            case 'coinsnapshot':
            case 'miningcontracts':
            case 'miningequipment':
                return self::BASE_URL . 'all/' . $func;
                break;
            case 'topexchanges':
            case 'volumes':
            case 'pairs':
                return self::BASE_URL . 'top/' . $func;
                break;
            case 'minute':
            case 'hour':
            case 'day':
                return self::BASE_URL . 'histo' . $func;
                break;
            default:
                return self::BASE_URL . $func;
                break;
        }
    }

    public static function timestamp_to_datetime($ts)
    {
        return date('Y-m-d H:i:s', (int)$ts);
    }

    public static function timestamp_to_date($ts)
    {
        return date('Y-m-d', (int)$ts);
    }
}