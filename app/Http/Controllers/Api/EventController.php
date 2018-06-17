<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Models\Space;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Spatie\QueryBuilder\Filter;
use Spatie\QueryBuilder\QueryBuilder;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Models\Space $space
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Space $space)
    {
        $this->authorize([Event::class, $space]);

        $allowedFilters = [
            Filter::exact('id'),
            'name',
            Filter::exact('start_at'),
            Filter::exact('duration_in_minutes'),
        ];

        $events = QueryBuilder::for($space->events()->getQuery())
            ->allowedFilters($allowedFilters)
            ->paginate();

        return response()->json($events);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreEventRequest $request
     * @param \App\Models\Space $space
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreEventRequest $request, Space $space)
    {
        $this->authorize([Event::class, $space]);

        $event = $space->events()->create([
            'name' => $request->name,
            'start_at' => Carbon::createFromFormat('Y-m-d H:i', $request->start_at),
            'duration_in_minutes' => $request->duration_in_minutes,
        ]);

        return response()->json($event);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Event $event)
    {
        $this->authorize($event);

        return response()->json($event);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateEventRequest $request
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $this->authorize($event);

        $event->update([
            'name' => $request->name,
            'start_at' => Carbon::createFromFormat('Y-m-d H:i', $request->start_at),
            'duration_in_minutes' => $request->duration_in_minutes,
        ]);

        return response()->json($event);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     */
    public function destroy(Event $event)
    {
        $this->authorize($event);

        $event->delete();

        return response()->json(['message' => 'Event deleted']);
    }
}
