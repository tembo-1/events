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
    /**
     * @param  StoreRequest  $request
     * @param  EventService  $service
     * @return JsonResponse
     */
    public function store(StoreRequest $request, EventService $service):JsonResponse
    {
        $data = $request->validated();

        return response()->json($service->store($data));
    }

    /**
     * @return JsonResponse
     */
    public function index():JsonResponse
    {
        return response()->json(['error' => null, EventCollection::make(Event::all())]);
    }

    /**
     * @param  AcceptRequest  $request
     * @param  EventService  $service
     * @return JsonResponse
     */
    public function accept(AcceptRequest $request, EventService $service)
    {
        $data = $request->validated();

        return response()->json($service->accept($data));
    }

    /**
     * @param  RejectRequest  $request
     * @param  EventService  $service
     * @return JsonResponse
     */
    public function reject(RejectRequest $request, EventService $service):JsonResponse
    {
        $data = $request->validated();

        return response()->json($service->reject($data));
    }

    /**
     * @param $id
     * @param  EventService  $service
     * @return JsonResponse
     */
    public function destroy($id, EventService $service):JsonResponse
    {
        return response()->json($service->destroy($id));
    }
}
