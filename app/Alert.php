<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    protected $fillable = [
        'user_id', 'symbol', 'operator', 'field', 'value', 'action', 'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function triggers()
    {
        return $this->hasMany(TriggeredAlert::class, 'alert_id');
    }
}