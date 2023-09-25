<?php

namespace App\Services\Api\V1;

use App\Models\Event;
use App\Models\UserEvent;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

class EventService
{

    /**
     * @param $id
     * @return string|Model
     */
    private function existence($id):string|Model
    {
        try {
            return Event::findOrFail($id);
        }
        catch (ModelNotFoundException $exception) {
            return 'Events not found';
        }
    }

    /**
     * @param  Event  $event
     * @return bool
     */
    private function belong(Event $event):bool
    {
        if ($event->creator_id == auth()->id()) {
            return true;
        }

        return false;
    }

    /**
     * @param  array  $data
     * @return Collection
     */
    public function store(array $data):Collection
    {
        try {
            return collect(['error' => null, 'result' => Event::create($data)]);
        }
        catch (Exception $exception) {
            return collect(['error' => $exception->getCode(), 'message' => $exception->getMessage()]);
        }
    }

    /**
     * @param  array  $data
     * @return Collection
     */
    public function accept(array $data):Collection
    {
        try {
            return collect(['error' => null, 'result' => UserEvent::create($data)]);
        }
        catch (Exception $exception) {
            return collect(['error' => $exception->getCode(), 'message' => $exception->getMessage()]);
        }
    }

    /**
     * @param  array  $data
     * @return Collection
     */
    public function reject(array $data):Collection
    {
        try {
            UserEvent::query()
                ->where($data)
                ->delete();

            return collect(['error' => null, 'result' => 'Event successfully cancelled']);
        }
        catch (Exception $exception) {
            return collect(['error' => $exception->getCode(), 'message' => $exception->getMessage()]);
        }
    }

    /**
     * @param $id
     * @return Collection
     */
    public function destroy($id):Collection
    {
        $result = $this->existence($id);

        if (!($result instanceof Event)) {
            return collect(['error' => 404, 'message' => $result]);
        }

        if (!$this->belong($result)) {
            return collect(['error' => 403, 'message' => 'The event can only be deleted by the creator']);
        }

        Event::destroy($id);

        return collect(['error' => null, 'result' => 'Event successfully deleted']);
    }
}
