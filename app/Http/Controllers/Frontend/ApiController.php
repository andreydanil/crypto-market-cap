<?php

namespace App\Http\Controllers\Frontend;

use App\CoinDailyHistory;
use App\Http\Controllers\Controller;
use App\Http\Requests\AjaxFormRequest;
use App\Library\CoinRepository;
use Log;

class ApiController extends Controller
{
    /**
     * @param AjaxFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function history(AjaxFormRequest $request)
    {
        $symbol = $request->get('symbol');
        $limit = $request->get('limit');

        $rows = $this->getDailyHistory($symbol, $limit)->toArray();
        $result = array_map(function ($r) {
            return [
                'date' => $r['date'],
                'price' => (float)$r['value'],
                'price_fmt' => number_format($r['value'], 2),
                'volume' => (float)$r['volume'],
                'volume_fmt' => number_format($r['volume']),
            ];
        }, $rows);
        return response()->json($result);
    }

    /**
     * Returns daily price-volume historical data
     *
     * @param string $symbol
     * @param int $limit
     * @return mixed
     * @throws \Exception
     */
    private function getDailyHistory($symbol, $limit = 30)
    {
        $symbol = strtoupper($symbol);

        try {
            $daysSinceUpdate = CoinRepository::calcUpdateDelta($symbol, 365 * 2);
            if ($daysSinceUpdate > 0) {
                CoinRepository::updateDailyHistory($symbol, 'USD', $daysSinceUpdate);
            }
        } catch (\Exception $e) {
            // gobble gobble
            Log::error($e->getMessage());
        }

        return CoinDailyHistory::whereSymbol($symbol)->orderByDesc('date')->take($limit)->get();
    }
}