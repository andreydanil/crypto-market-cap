<?php
/**
 * CoinPresenter.php
 *
 * @author     Dr. Max Ehsan <contact@kaijuscripts.com>
 * @copyright  2017 Dr. Max Ehsan
 */

namespace App\Presenters;

use McCool\LaravelAutoPresenter\BasePresenter;

class CoinPresenter extends BasePresenter
{
    public function market_cap_usd()
    {
        return number_format($this->wrappedObject->market_cap_usd ?? 0);
    }

    public function price_usd()
    {
        return number_format($this->wrappedObject->price_usd ?? 0, 2);
    }

    public function percent_change_1h()
    {
        return number_format($this->wrappedObject->percent_change_1h ?? 0, 2);
    }

    public function percent_change_24h()
    {
        return number_format($this->wrappedObject->percent_change_24h ?? 0, 2);
    }

    public function percent_change_7d()
    {
        return number_format($this->wrappedObject->percent_change_7d ?? 0, 2);
    }

    public function volume_usd_24h()
    {
        return number_format($this->wrappedObject->volume_usd_24h ?? 0);
    }

    public function logo()
    {
        return $this->wrappedObject->logo ?? 'coin.png';
    }
}