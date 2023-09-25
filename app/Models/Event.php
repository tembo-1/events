<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'title',
        'text',
    ];

    /**
     * @var string[]
     */
    protected $hidden = ['pivot'];

    protected static function boot() {
        parent::boot();

        static::creating(function ($event) {
            $event->creator_id = auth()->id();
            $event->created_at = now();
        });
    }

    public function eventusers()
    {
        return $this->hasMany('App\Models\UserEvent');
    }
}
