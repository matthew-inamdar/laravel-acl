<?php

namespace App\Http\Controllers\Api;

use App\Models\Event;
use App\Models\Space;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return response()->json($event);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}
