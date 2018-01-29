<?php

namespace App\Http\Controllers\Frontend;

use App\Coin;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchFormRequest;
use App\Library\CoinRepository;
use App\Library\Consts;
use Artisan;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Show the homepage.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $top_coins = [];
        $limit = 5;
        foreach (CoinRepository::topCoins($limit) as $coin) {
            $top_coins[$coin->symbol] = [
                'name' => $coin->name,
                'logo' => $coin->logo,
                'price' => '$' . number_format($coin->price_usd, 2),
                'change' => number_format($coin->percent_change_24h, 2),
            ];
        }

        $limit = 8;
        $gainers = CoinRepository::topMovers($limit, 'DESC');
        $losers = CoinRepository::topMovers($limit, 'ASC');

        return view('frontend.home', compact('top_coins', 'gainers', 'losers'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function market()
    {
        $pageSize = (int)session(Consts::SESSION_MAX_COINS, 10);

        // refresh data if needed
        if (CoinRepository::needsUpdate(Consts::COINDATA_REFRESH_INTERVAL)) {
            try {
                CoinRepository::updateCoinData();
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }
        }

        $coins = Coin::valid()->sortable(['market_cap_usd' => 'desc'])->simplePaginate($pageSize);
        return view('frontend.market', compact('coins'));
    }

    /**
     * View cryptocurrency data
     *
     * @param string $symbol
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function coin($symbol)
    {
        $coin = Coin::whereSymbol($symbol)->firstOrFail();
        //$crumbs = ['Market' => route('home.market'), $coin->name => ''];
        return view('frontend.coin', compact('coin'));
    }

    /**
     * @param int $size
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function setPageSize($size)
    {
        if ($size < 10) {
            $size = 10;
        } elseif ($size > 100) {
            $size = 100;
        }
        session()->put(Consts::SESSION_MAX_COINS, (int)$size);
        return redirect()->back();
    }

    public function terms()
    {
        return view('static.terms');
    }

    public function privacy()
    {
        return view('static.privacy');
    }

    public function disclaimer()
    {
        return view('static.disclaimer');
    }

    public function search(SearchFormRequest $request)
    {
        $coins = CoinRepository::searchCoins($request->get('search_term'), 100);

        return view('frontend.search_results', compact('coins'));
    }

    /**
     * Runs cron job via controller
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function cron()
    {
        $exitCode = Artisan::call('schedule:run');
        return response('Success');
    }

    /**
     * Resets cache
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function reset()
    {
        $exitCode = Artisan::call('view:clear');
        $exitCode = Artisan::call('cache:clear');
        $exitCode = Artisan::call('route:clear');
        $exitCode = Artisan::call('route:cache');

        return response('Cache has been successfully reset');
    }
}
