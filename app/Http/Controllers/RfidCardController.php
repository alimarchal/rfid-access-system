<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRfidCardRequest;
use App\Http\Requests\UpdateRfidCardRequest;
use App\Models\RfidCard;
use App\Models\User;

class RfidCardController extends Controller
{
    public function index()
    {
        $rfidCards = RfidCard::with(['user', 'entries'])->paginate(10);
        return view('rfid-cards.index', compact('rfidCards'));
    }


    public function create()
    {
        $users = User::active()->get();
        return view('rfid-cards.form', compact('users'));
    }


    public function store(StoreRfidCardRequest $request)
    {
        RfidCard::create($request->validated());

        return redirect()->route('rfid-cards.index')
            ->with('success', 'RFID card registered');
    }

    public function edit(RfidCard $rfidCard)
    {
        $users = User::active()->get();
        return view('rfid-cards.form', compact('rfidCard', 'users'));
    }

    public function update(UpdateRfidCardRequest $request, RfidCard $rfidCard)
    {
        $rfidCard->update($request->validated());

        return redirect()->route('rfid-cards.index')
            ->with('success', 'RFID card updated');
    }

// In controller
    public function reassign(RfidCard $rfidCard, Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'expiry_date' => 'nullable|date|after:today'
        ]);

        $rfidCard->update([
            'user_id' => $request->user_id,
            'status' => 'active',
            'expiry_date' => $request->expiry_date ?? now()->addYear(),
        ]);

        return back()->with('success', 'RFID card reassigned successfully');
    }



    public function destroy(RfidCard $rfidCard)
    {
        $rfidCard->delete();
        return redirect()->route('rfid-cards.index')
            ->with('success', 'RFID card deactivated');
    }
}
