<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEntryRequest;
use App\Http\Requests\UpdateEntryRequest;
use App\Models\Entry;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EntryController extends Controller
{

    public function store(Request $request)
    {

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'rfid_card_id' => 'required|exists:rfid_cards,id',
            'entry_type' => 'required|in:time_in,time_out',
            'access_status' => 'required|boolean',
            'gate_id' => 'required|in:1,2,3',
        ]);

        $time_in = null;
        $time_out = null;

        if (request()->has('entry_type')) {
            if (request()->input('entry_type') === "time_in") {
                $time_in = Carbon::now();
            } elseif (request()->input('entry_type') === "time_out") {
                $time_out = Carbon::now();
            }
        }
        $vehicle_id = null;
        if (request()->has('vehicle_id')) {
            if ($request->vehicle_id == "NULL") {
                $vehicle_id = null;
            } else {
                $vehicle_id = $request->vehicle_id;
            }

        }

        $entry = Entry::create([
            'user_id' => $request->user_id,
            'rfid_card_id' => $request->rfid_card_id,
            'time_in' => $time_in,
            'time_out' => $time_out,
            'access_granted' => $request->access_status,
            'gate_id' => $request->gate_id,
            'vehicle_id' => $vehicle_id,
            'verified_at' => now(), // Record the current time as verification time
        ]);

        return to_route('dashboard')->with('success', 'Entry recorded successfully.');
//        return redirect()->back()
    }
}
