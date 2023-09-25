<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\Event\AcceptRequest;
use App\Http\Requests\Site\Event\RejectRequest;
use App\Models\Event;
use App\Models\UserEvent;
use App\Services\Site\EventService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function show($id)
    {
        $event = Event::find($id);
        $events = Event::all();

        $events_own = Event::query()
            ->whereHas('eventusers', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->get();

        $userevents = UserEvent::query()
            ->where('event_id', $id)
            ->get();

        $flag = UserEvent::query()
            ->where([
                ['user_id', auth()->id()],
                ['event_id', $id],
            ])
            ->first();

        return view('event', compact('events', 'event', 'userevents', 'events_own', 'flag'));
    }

    /**
     * @param  AcceptRequest  $request
     * @param  EventService  $service
     * @return RedirectResponse
     */
    public function accept(AcceptRequest $request, EventService $service):RedirectResponse
    {
        $data = $request->validated();

        toastr()->info($service->accept($data), [
            'allowHtml' => true,
        ]);

        return back();
    }

    /**
     * @param  RejectRequest  $request
     * @param  EventService  $service
     * @return RedirectResponse
     */
    public function reject(RejectRequest $request, EventService $service):RedirectResponse
    {
        $data = $request->validated();

        toastr()->info($service->reject($data));

        return back();
    }

    public function index()
    {
        return response()->json(Event::all());
    }
}
