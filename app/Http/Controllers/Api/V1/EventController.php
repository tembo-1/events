<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Event\AcceptRequest;
use App\Http\Requests\Api\V1\Event\RejectRequest;
use App\Http\Requests\Api\V1\Event\StoreRequest;
use App\Http\Resources\Api\V1\EventCollection;
use App\Models\Event;
use App\Services\Api\V1\EventService;
use Illuminate\Http\JsonResponse;

class EventController extends Controller
{
    public function store(StoreRequest $request, EventService $service):JsonResponse
    {
        $data = $request->validated();

        return $service->store($data);
    }

    public function index():JsonResponse
    {
        return response()->json(['error' => null, EventCollection::make(Event::all())]);
    }

    public function accept(AcceptRequest $request, EventService $service):JsonResponse
    {
        $data = $request->validated();

        return $service->accept($data);
    }

    public function reject(RejectRequest $request, EventService $service):JsonResponse
    {
        $data = $request->validated();

        return $service->reject($data);
    }

    public function destroy($id, EventService $service)
    {
        return $service->destroy($id);
    }
}
