<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index():Renderable
    {
        $events = Event::all();

        $events_own = Event::query()
            ->whereHas('eventusers', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->get();

        return view('home', compact('events', 'events_own'));
    }
}
