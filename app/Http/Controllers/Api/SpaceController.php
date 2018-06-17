<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreSpaceRequest;
use App\Http\Requests\UpdateSpaceRequest;
use App\Models\Space;
use App\Models\Venue;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\Filter;
use Spatie\QueryBuilder\QueryBuilder;

class SpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Models\Venue $venue
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Venue $venue)
    {
        $this->authorize([Space::class, $venue]);

        $allowedFilters = [Filter::exact('id'), 'name'];
        $allowedIncludes = ['events'];

        $spaces = QueryBuilder::for($venue->spaces()->getQuery())
            ->allowedFilters($allowedFilters)
            ->allowedIncludes($allowedIncludes)
            ->paginate();

        return response()->json($spaces);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreSpaceRequest $request
     * @param \App\Models\Venue $venue
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreSpaceRequest $request, Venue $venue)
    {
        $this->authorize([Space::class, $venue]);

        $space = $venue->spaces()->create(['name' => $request->name]);

        return response()->json($space);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Space $space
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Space $space)
    {
        $this->authorize($space);

        $allowedIncludes = ['events'];

        $space = QueryBuilder::for(Space::where('id', $space->id))
            ->allowedIncludes($allowedIncludes)
            ->first();

        return response()->json($space);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateSpaceRequest $request
     * @param  \App\Models\Space $space
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateSpaceRequest $request, Space $space)
    {
        $this->authorize($space);

        $space->update(['name' => $request->name]);

        return response()->json($space);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Space $space
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     */
    public function destroy(Space $space)
    {
        $this->authorize($space);

        $space->delete();

        return response()->json(['message' => 'Space deleted']);
    }
}
