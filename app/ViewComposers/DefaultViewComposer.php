<?php

namespace App\ViewComposers;

use App\Coin;
use App\Library\CoinRepository;
use App\Library\Consts;
use Cache;
use Illuminate\View\View;

class DefaultViewComposer
{
    private function register(View $view, $setting)
    {
        $view->with(strtolower($setting), env($setting));
    }

    /**
     * Bind data with view
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('theme_color', env(Consts::THEME_COLOR, 'blue'));
        $view->with('coins_count', Cache::remember('coins_count', Consts::CACHE_DURATION_LONG, function () {
            return number_format(Coin::count());
        }));
        $view->with(Consts::SESSION_MAX_COINS, session(Consts::SESSION_MAX_COINS, 10));
        $view->with(strtolower(Consts::APP_NAME), env(Consts::APP_NAME, 'CoinIndex'));
        $view->with('ga_id', env(Consts::GOOGLE_ANALYTICS_ID));
        $this->register($view, Consts::ADSENSE_PUB_ID);
        $this->register($view, Consts::ADSENSE_SLOT1_ID);
        $this->register($view, Consts::ADSENSE_SLOT2_ID);
        $this->register($view, Consts::CHANGELLY_AFF_ID);
        $this->register($view, Consts::DONATE_BTC);
        $this->register($view, Consts::DONATE_ETH);
        $this->register($view, Consts::DONATE_LTC);
        $view->with('show_donate_button',
            (env(Consts::DONATE_BTC) !== null) &&
            (env(Consts::DONATE_ETH) !== null) &&
            (env(Consts::DONATE_LTC) !== null));
        $view->with('disqus_enabled', config('disqus.enabled', false));
        $view->with('coins_approx', CoinRepository::approxCoinCount());
    }
}