<?php
/**
 * NewsRepository.php
 *
 * @author     Dr. Max Ehsan <contact@kaijuscripts.com>
 * @copyright  2017 Dr. Max Ehsan
 */

namespace App\Library;


use Carbon\Carbon;
use DB;
use Log;

class NewsRepository
{
    public static function needsUpdate($minutes = 60)
    {
        $lastUpdated = DB::table('news')->max('last_updated');

        if (isset($lastUpdated)) {
            if (Carbon::parse($lastUpdated)->diffInMinutes(Carbon::now()) <= $minutes) {
                return false;
            }
        }

        return true;
    }

    public static function updateNews()
    {
        try {
            $crypto = new CryptoCompare();
            $data = $crypto->news();
            foreach ($data as $d) {
                DB::table('news')->updateOrInsert(
                    [
                        'hashid' => $d['hashid'],
                    ],
                    [
                        'hashid' => $d['hashid'],
                        'published_on' => $d['published_on'],
                        'title' => $d['title'],
                        'url' => $d['url'],
                        'body' => $d['body'],
                        'last_updated' => Carbon::now()
                    ]
                );
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}