<?php

namespace App\Http\Controllers\Api;

use App\Models\Venue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\Filter;
use Spatie\QueryBuilder\QueryBuilder;

class VenueController extends Controller
{
    /**
     * VenueController constructor.
     */
    public function __construct()
    {
        $this->authorizeResource(Venue::class);
    }

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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $venue = Venue::create([
            'name' => $request->name,
        ]);

        return response()->json($venue);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Venue $venue
     * @return \Illuminate\Http\Response
     */
    public function show(Venue $venue)
    {
        $allowedIncludes = ['spaces', 'spaces.events'];

        $venue = QueryBuilder::for(Venue::where('id', $venue->id))
            ->allowedIncludes($allowedIncludes)
            ->first();

        return response()->json($venue);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Venue $venue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venue $venue)
    {
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
     * @throws \Exception
     */
    public function destroy(Venue $venue)
    {
        $venue->delete();

        return response()->json(['message' => 'Venue deleted']);
    }
}
