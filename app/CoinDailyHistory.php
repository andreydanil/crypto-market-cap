<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoinDailyHistory extends Model
{
    protected $guarded = ['id'];
    protected $dates = ['last_updated'];
}
