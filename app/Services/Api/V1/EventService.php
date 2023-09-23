<?php

namespace App\Services\Api\V1;

use App\Models\Event;
use App\Models\UserEvent;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class EventService
{
    private function existence($id)
    {
        try {
            return Event::findOrFail($id);
        }
        catch (ModelNotFoundException $exception)
        {
            return 'Events not found';
        }
    }

    private function belong(Event $event)
    {
        if ($event->creator_id == auth()->id()) {
            return true;
        }

        return false;
    }

    /**
     * @param  array  $data
     * @return JsonResponse
     */
    public function store(array $data):JsonResponse
    {
        try {
            return response()->json(['error' => null, 'result' => Event::create($data)]);
        }
        catch (Exception $exception) {
            return response()->json(['error' => $exception->getCode(), 'message' => $exception->getMessage()]);
        }
    }

    public function accept(array $data):JsonResponse
    {
        try {
            return response()->json(['error' => null, 'result' => UserEvent::create($data)]);
        }
        catch (Exception $exception) {
            return response()->json(['error' => $exception->getCode(), 'message' => $exception->getMessage()]);
        }
    }

    public function reject(array $data):JsonResponse
    {
        try {
            UserEvent::query()
                ->where($data)
                ->delete();

            return response()->json(['error' => null, 'result' => 'Event successfully cancelled']);
        }
        catch (Exception $exception)
        {
            return response()->json(['error' => $exception->getCode(), 'message' => $exception->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $result = $this->existence($id);

        if (!($result instanceof Event)) {
            return response()->json(['error' => 404, 'message' => $result]);
        }

        if (!$this->belong($result)) {
            return response()->json(['error' => 403, 'message' => 'The event can only be deleted by the creator']);
        }

        Event::destroy($id);

        return response()->json(['error' => null, 'result' => 'Event successfully deleted']);
    }
}
