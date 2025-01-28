<?php

namespace App\Http\Controllers;

use App\Models\User;  // Add this line
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{
    /**
     * Display a listing of the vehicles.
     */
    public function index(Request $request)
    {
        $vehicles = Vehicle::query();
    
        // Apply filters if present
        if ($request->has('filter')) {
            $filters = $request->input('filter');
            if (!empty($filters['vehicle_no'])) {
                $vehicles->where('vehicle_no', 'like', '%' . $filters['vehicle_no'] . '%');
            }
            if (!empty($filters['user_id'])) {
                $vehicles->where('user_id', $filters['user_id']);
            }
            if (!empty($filters['make'])) {
                $vehicles->where('make', 'like', '%' . $filters['make'] . '%');
            }
            if (!empty($filters['model'])) {
                $vehicles->where('model', 'like', '%' . $filters['model'] . '%');
            }
            if (!empty($filters['color'])) {
                $vehicles->where('color', 'like', '%' . $filters['color'] . '%');
            }
        }
    
        $vehicles = $vehicles->paginate(10);
    
        return view('vehicles.index', compact('vehicles'));
    }
    

    /**
     * Show the form for creating a new vehicle.
     */
    public function create()
    {
        // Fetch all users to display in the dropdown
        $users = User::all();

        // Return the view with the users
        return view('vehicles.create', compact('users'));
    }

    /**
     * Store a newly created vehicle in storage.
     */
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'vehicle_no' => 'required|string|max:255',
        'user_id' => 'required|exists:users,id',
        'make' => 'required|string|max:255',
        'model' => 'required|string|max:255',
        'manufacture_year' => 'required|integer',
        'color' => 'required|string|max:255',
    ]);

    Vehicle::create($validatedData);

    return redirect()->route('vehicles.index')->with('success', 'Vehicle created successfully.');
}

    /**
     * Show the form for editing the specified vehicle.
     */
    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id); // Find the vehicle by ID
        $users = User::all(); // Get all users, or filter based on your needs
    
        return view('vehicles.edit', compact('vehicle', 'users'));
    }

    /**
     * Update the specified vehicle in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $validatedData = $request->validate([
            'vehicle_no' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'manufacture_year' => 'required|integer',
            'color' => 'required|string|max:255',
        ]);
    
        $vehicle->update($validatedData);
    
        return redirect()->route('vehicles.index')->with('success', 'Vehicle updated successfully.');
    }

    /**
     * Remove the specified vehicle from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        
    
        // Attempt to delete the vehicle
        try {
            $vehicle->delete();
    
            return redirect()->route('vehicles.index')
                ->with('success', 'Vehicle deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('vehicles.index')
                ->with('error', 'There was an issue deleting the vehicle.');
        }
    }
    
}
