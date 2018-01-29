<?php
/**
 * CoinPresenter.php
 *
 * @author     Dr. Max Ehsan <contact@kaijuscripts.com>
 * @copyright  2017 Dr. Max Ehsan
 */

namespace App\Presenters;

use Carbon\Carbon;
use McCool\LaravelAutoPresenter\BasePresenter;

class NewsPresenter extends BasePresenter
{
    public function published_on()
    {
        return Carbon::instance($this->wrappedObject->published_on)->diffForHumans(Carbon::now());
    }
}