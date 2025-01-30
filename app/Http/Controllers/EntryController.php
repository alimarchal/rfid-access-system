<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEntryRequest;
use App\Http\Requests\UpdateEntryRequest;
use App\Models\Entry;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EntryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'rfid_card_id' => 'required|exists:rfid_cards,id',
            'entry_type' => 'required|in:time_in,time_out',
            'access_status' => 'required|boolean',
            'gate_id' => 'required|in:1,2,3',
        ]);

        $time_in = null;
        $time_out = null;
        if(request()->has('entry_type') == "time_in")
        {
            $time_in = Carbon::now();
        }
        elseif(request()->has('entry_type') == "time_out") {
            $time_in = App\Http\Controllers\Carbon::now();
        }
        // dd($request->all());
        $entry = Entry::create([
            'user_id' => $request->user_id,
            'rfid_card_id' => $request->rfid_card_id,
            'time_in' => $time_in,
            'time_out' => $time_out,
            'access_granted' => $request->access_status,
            'gate_id' => $request->gate_id,
            'verified_at' => now(), // Record the current time as verification time
        ]);

        return redirect()->back()->with('status', 'Entry recorded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Entry $entry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Entry $entry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEntryRequest $request, Entry $entry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entry $entry)
    {
        //
    }
}