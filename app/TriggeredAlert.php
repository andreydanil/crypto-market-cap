<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TriggeredAlert extends Model
{
    protected $guarded = ['id'];
    protected $dates = ['triggered_on'];

    public function alert()
    {
        return $this->belongsTo(Alert::class, 'alert_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
