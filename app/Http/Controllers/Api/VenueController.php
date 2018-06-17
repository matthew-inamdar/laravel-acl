<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreVenueRequest;
use App\Http\Requests\UpdateVenueRequest;
use App\Models\Venue;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\Filter;
use Spatie\QueryBuilder\QueryBuilder;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize(Venue::class);

        $allowedFilters = [Filter::exact('id'), 'name'];
        $allowedIncludes = ['spaces.events'];

        $venues = QueryBuilder::for(Venue::class)
            ->allowedFilters($allowedFilters)
            ->allowedIncludes($allowedIncludes)
            ->paginate();

        return response()->json($venues);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreVenueRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreVenueRequest $request)
    {
        $this->authorize(Venue::class);

        $venue = Venue::create([
            'name' => $request->name,
        ]);

        return response()->json($venue->load('spaces'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Venue $venue
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Venue $venue)
    {
        $this->authorize($venue);

        $allowedIncludes = ['spaces', 'spaces.events'];

        $venue = QueryBuilder::for(Venue::where('id', $venue->id))
            ->allowedIncludes($allowedIncludes)
            ->first();

        return response()->json($venue);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateVenueRequest $request
     * @param  \App\Models\Venue $venue
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateVenueRequest $request, Venue $venue)
    {
        $this->authorize($venue);

        $venue->update([
            'name' => $request->name,
        ]);

        return response()->json($venue);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Venue $venue
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     */
    public function destroy(Venue $venue)
    {
        $this->authorize($venue);

        $venue->delete();

        return response()->json(['message' => 'Venue deleted']);
    }
}
