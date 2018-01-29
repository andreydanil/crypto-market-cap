<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = [
        'symbol', 'rate'
    ];

    protected $dates = ['last_updated',];
}
