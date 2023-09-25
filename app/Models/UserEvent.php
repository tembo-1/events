<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEvent extends Model
{
    protected $table = 'userevents';

    protected $fillable = [
        'event_id',
        'user_id',
    ];

    protected static function boot() {
        parent::boot();

        static::creating(function ($event) {
            $event->user_id = auth()->id();
        });
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function event()
    {
        return $this->belongsTo('App\Models\Event');
    }
}
