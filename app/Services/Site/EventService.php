<?php

namespace App\Services\Site;

use App\Models\UserEvent;
use Exception;

class EventService
{
    /**
     * @param  array  $data
     * @return string
     */
    public function accept(array $data):string
    {
        try {
            UserEvent::create($data);

            return 'Successfully signed';
        }
        catch (Exception $exception) {
            return 'You have already subscribed to this event';
        }
    }

    /**
     * @param  array  $data
     * @return string
     */
    public function reject(array $data):string
    {
        try {
            UserEvent::query()
                ->where($data)
                ->delete();

            return 'You successfully refused to participate';
        }
        catch (Exception $exception) {
            return 'Oh, something went wrong, contact the manager';
        }
    }
}
