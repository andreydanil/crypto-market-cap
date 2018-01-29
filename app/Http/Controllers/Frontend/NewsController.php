<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Library\Consts;
use App\Library\NewsRepository;
use App\News;
use Log;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // refresh data if needed
        if (NewsRepository::needsUpdate(Consts::NEWS_REFRESH_INTERVAL)) {
            try {
                NewsRepository::updateNews();
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }
        }

        $limit = 10;
        if ($limit <= 0) {
            $limit = 10;
        }
        if ($limit > 25) {
            $limit = 25;
        }
        $news = News::orderByDesc('published_on')->simplePaginate($limit);
        return view('frontend.news', compact('news'));
    }

    /**
     * Redirect to external URL
     *
     * @param string $id Hash id of the resource
     * @return \Illuminate\Http\Response
     */
    public function go($id)
    {
        $news = News::where('hashid', $id)->firstOrFail();
        return redirect()->away($news->url);
    }
}