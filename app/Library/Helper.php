<?php
/**
 * Helper.php
 *
 * @author     Dr. Max Ehsan <contact@kaijuscripts.com>
 * @copyright  2017 Dr. Max Ehsan
 */

namespace App\Library;

class Helper
{
    public static function uniqueid($length = 13)
    {
        if (function_exists('random_bytes')) {
            $bytes = random_bytes(ceil($length / 2));
        } elseif (function_exists('openssl_random_pseudo_bytes')) {
            $bytes = openssl_random_pseudo_bytes(ceil($length / 2));
        } else {
            return base_convert(uniqid(), 16, 36);
        }

        return substr(bin2hex($bytes), 0, $length);
    }

    public static function arrowSignal($change = 0)
    {
        $fmt = '<sup><i class="ti-arrow-%s text-%s"></i></sup> %s';
        if ($change == 0) return '';
        if ($change > 0) {
            return sprintf($fmt, 'up', 'info', $change);
        } elseif ($change < 0) {
            return sprintf($fmt, 'down', 'danger', $change);
        }
    }
}