<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use App\Models\Location;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Carbon\Carbon;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = QueryBuilder::for(Location::class)
            ->allowedFilters([
                AllowedFilter::exact('branch_id'),
                AllowedFilter::exact('fiscal_year'),
                AllowedFilter::exact('created_by_user_id'),
                AllowedFilter::exact('updated_by_user_id'),
                AllowedFilter::exact('annual_target_amount'),
            ])
            ->paginate(10);


        return view('locations.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('locations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLocationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLocationRequest $request, Location $location)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        //
    }
}
