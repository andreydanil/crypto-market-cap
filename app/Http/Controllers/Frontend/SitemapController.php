<?php

namespace App\Http\Controllers\Frontend;

use App;
use App\Coin;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;

class SitemapController extends Controller
{
    private function render($format)
    {
        // create new sitemap object
        $sitemap = app()->make('sitemap');

        //$sitemap->setCache('_sitemap.' . config('app.url'), 60);

        // check if there is cached sitemap and build new only if is not
        if (!$sitemap->isCached()) {
            // add item to the sitemap (url, date, priority, freq)
            $sitemap->add(URL::to('/'), Carbon::now()->toIso8601String(), '1.0', 'hourly');

            $sitemap->add(route('home.market'), Carbon::now()->toIso8601String(), '0.9', 'hourly');
            $sitemap->add(route('news.index'), Carbon::now()->toIso8601String(), '0.5', 'hourly');
            $sitemap->add(route('contact.index'), Carbon::now()->toIso8601String(), '0.1');
            $sitemap->add(route('static.privacy'), Carbon::now()->toIso8601String(), '0.1');
            $sitemap->add(route('static.terms'), Carbon::now()->toIso8601String(), '0.1');
            $sitemap->add(route('static.disclaimer'), Carbon::now()->toIso8601String(), '0.1');

            $symbols = Coin::all();
            foreach ($symbols as $symbol) {
                $sitemap->add(route('home.coin', $symbol['symbol']), Carbon::instance($symbol['last_updated'])->toIso8601String(), '0.5');
            }

            if ($format != 'xml') $sitemap->add(route('sitemap.xml'), Carbon::now()->toIso8601String(), '0.1');
            if ($format != 'txt') $sitemap->add(route('sitemap.txt'), Carbon::now()->toIso8601String(), '0.1');
            if ($format != 'html') $sitemap->add(route('sitemap.html'), Carbon::now()->toIso8601String(), '0.1');
        }

        // show your sitemap (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf')
        return $sitemap->render($format);
    }

    public function html()
    {
        return $this->render('html');
    }

    public function xml()
    {
        return $this->render('xml');
    }

    public function txt()
    {
        return $this->render('txt');
    }
}