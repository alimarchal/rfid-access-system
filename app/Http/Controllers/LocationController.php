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
    public function index()
    {
        $locations = QueryBuilder::for(Location::class)
            ->allowedFilters([
                AllowedFilter::partial('city'),
                AllowedFilter::partial('district'),
            ])
            ->latest()
            ->paginate(10);

        return view('locations.index', compact('locations'));
    }

    public function create()
    {
        return view('locations.create');
    }

    public function store(StoreLocationRequest $request)
    {
        try {
            Location::create($request->validated());

            return redirect()
                ->route('locations.index')
                ->with('success', 'Location created successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error creating location. Please try again.');
        }
    }

    public function edit(Location $location)
    {
        return view('locations.edit', compact('location'));
    }

    public function update(UpdateLocationRequest $request, Location $location)
    {
        try {
            $location->update($request->validated());

            return redirect()
                ->route('locations.index')
                ->with('success', 'Location updated successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error updating location. Please try again.');
        }
    }

    public function destroy(Location $location)
    {
        try {
            $location->delete();

            return redirect()
                ->route('locations.index')
                ->with('success', 'Location deleted successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Error deleting location. Please try again.');
        }
    }
}
