<?php

namespace App;

use App\Presenters\NewsPresenter;
use Illuminate\Database\Eloquent\Model;
use McCool\LaravelAutoPresenter\HasPresenter;

class News extends Model implements HasPresenter
{
    protected $guarded = ['id'];
    protected $dates = ['published_on', 'last_updated'];

    /**
     * Get the presenter class.
     *
     * @return string
     */
    public function getPresenterClass()
    {
        return NewsPresenter::class;
    }
}
