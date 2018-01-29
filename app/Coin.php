<?php

namespace App;

use App\Presenters\CoinPresenter;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use McCool\LaravelAutoPresenter\HasPresenter;

class Coin extends Model implements HasPresenter

{
    use Sortable;

    public $sortable = [
        'symbol', 'price_usd', 'volume_usd_24h', 'market_cap_usd', 'percent_change_1h', 'percent_change_24h', 'percent_change_7d'
    ];
    protected $guarded = ['id'];
    protected $dates = ['last_updated'];

    public function getPresenterClass()
    {
        return CoinPresenter::class;
    }

    public function scopeValid($query)
    {
        return $query->whereNotNull('coin_id')->whereNotNull('price_usd');
    }
}
