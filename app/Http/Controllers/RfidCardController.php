<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRfidCardRequest;
use App\Http\Requests\UpdateRfidCardRequest;
use App\Models\RfidCard;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class RfidCardController extends Controller
{
    public function index(Request $request)
    {
        try {
            $rfidCards = QueryBuilder::for(RfidCard::class)
                ->allowedFilters([
                    AllowedFilter::exact('status'),
                    AllowedFilter::exact('user_id'),
                    'card_number',
                ])
                ->with(['user' => function ($query) {
                    $query->select('id', 'name', 'email');
                }])
                ->latest()
                ->paginate(10)
                ->withQueryString();

            return view('rfid-cards.index', compact('rfidCards'));
        } catch (Exception $e) {
            Log::error('Error in RFID cards index: ' . $e->getMessage());
            session()->flash('error', 'Error retrieving RFID cards. Please try again.');
            return back();
        }
    }

    public function create()
    {
        try {
            $users = User::select('id', 'name')
                ->orderBy('name')
                ->get();

            return view('rfid-cards.create', compact('users'));
        } catch (Exception $e) {
            Log::error('Error in RFID card create form: ' . $e->getMessage());
            session()->flash('error', 'Error loading create form. Please try again.');
            return back();
        }
    }

    public function store(StoreRfidCardRequest $request)
    {
        DB::beginTransaction();
        try {
            // Log the incoming request data
            Log::info('Creating RFID card with data:', $request->validated());

            // Create the RFID card with explicit data
            $rfidCard = new RfidCard();
            $rfidCard->user_id = $request->user_id;
            $rfidCard->card_number = $request->card_number;
            $rfidCard->status = $request->status;
            $rfidCard->expiry_date = $request->expiry_date;
            $rfidCard->save();

            // Log successful card creation
            Log::info('RFID card created successfully:', ['id' => $rfidCard->id]);

            // Create assignment history record
            $assignmentHistory = $rfidCard->assignmentHistories()->create([
                'user_id' => $request->user_id,
                'assigned_by' => auth()->id() ?? 1,
                'assigned_at' => now(),
            ]);

            // Log successful history creation
            Log::info('Assignment history created:', ['id' => $assignmentHistory->id]);

            DB::commit();

            return redirect()
                ->route('users.show', $request->user_id)
                ->with('success', 'RFID card has been created successfully.');

        } catch (Exception $e) {
            DB::rollBack();

            // Log detailed error information
            Log::error('RFID card creation failed', [
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()
                ->withInput()
                ->with('error', 'Error creating RFID card: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified RFID card.
     *
     * @param RfidCard $rfidCard
     * @return \Illuminate\View\View
     */
    public function show(RfidCard $rfidCard)
    {
        try {
            $rfidCard->load(['user:id,name,email', 'assignmentHistories.assignedBy:id,name']);
            return view('rfid-cards.show', compact('rfidCard'));
        } catch (Exception $e) {
            Log::error('Error showing RFID card: ' . $e->getMessage());
            return back()->with('error', 'Error retrieving RFID card details.');
        }
    }

    /**
     * Show the form for editing the specified RFID card.
     *
     * @param RfidCard $rfidCard
     * @return \Illuminate\View\View
     */
    public function edit(RfidCard $rfidCard)
    {
        try {
            $users = User::active()
                ->select('id', 'name')
                ->orderBy('name')
                ->get();

            return view('rfid-cards.edit', compact('rfidCard', 'users'));
        } catch (Exception $e) {
            Log::error('Error in RFID card edit form: ' . $e->getMessage());
            return back()->with('error', 'Error loading edit form. Please try again.');
        }
    }

    /**
     * Update the specified RFID card in storage.
     *
     * @param UpdateRfidCardRequest $request
     * @param RfidCard $rfidCard
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRfidCardRequest $request, RfidCard $rfidCard)
    {
        try {
            DB::beginTransaction();

            $oldUserId = $rfidCard->user_id;
            $newUserId = $request->validated()['user_id'];

            $rfidCard->update($request->validated());

            // Record assignment history if user changed
            if ($oldUserId !== $newUserId) {
                $rfidCard->assignmentHistories()->create([
                    'user_id' => $newUserId,
                    'assigned_at' => now(),
                    'assigned_by' => auth()->id(),
                ]);
            }

            DB::commit();

            return redirect()
                ->route('rfid-cards.index')
                ->with('success', 'RFID card has been updated successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error updating RFID card: ' . $e->getMessage());

            return back()
                ->withInput()
                ->with('error', 'Error updating RFID card. Please try again.');
        }
    }

    /**
     * Reassign the RFID card to a different user.
     *
     * @param Request $request
     * @param RfidCard $rfidCard
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reassign(Request $request, RfidCard $rfidCard)
    {
        try {
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
                'expiry_date' => 'nullable|date|after:today'
            ]);

            DB::beginTransaction();

            $rfidCard->update([
                'user_id' => $validated['user_id'],
                'status' => 'active',
                'expiry_date' => $validated['expiry_date'] ?? now()->addYear(),
            ]);

            $rfidCard->assignmentHistories()->create([
                'user_id' => $validated['user_id'],
                'assigned_at' => now(),
                'assigned_by' => auth()->id(),
            ]);

            DB::commit();

            return back()->with('success', 'RFID card has been reassigned successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error reassigning RFID card: ' . $e->getMessage());

            return back()
                ->withInput()
                ->with('error', 'Error reassigning RFID card. Please try again.');
        }
    }

    /**
     * Remove the specified RFID card from storage.
     *
     * @param RfidCard $rfidCard
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(RfidCard $rfidCard)
    {
        try {
            DB::beginTransaction();

            // Soft delete the card
            $rfidCard->delete();

            // Update status to inactive
            $rfidCard->update(['status' => 'inactive']);

            DB::commit();

            return redirect()
                ->route('rfid-cards.index')
                ->with('success', 'RFID card has been deactivated successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error deactivating RFID card: ' . $e->getMessage());

            return back()->with('error', 'Error deactivating RFID card. Please try again.');
        }
    }


    public function rfid_card_create_via_user(Request $request, User $user)
    {
        try {
            $users = User::where('id', $user->id)
                ->orderBy('name')
                ->get();

            return view('rfid-cards.create', compact('users'));
        } catch (Exception $e) {
            Log::error('Error in RFID card create form: ' . $e->getMessage());
            session()->flash('error', 'Error loading create form. Please try again.');
            return back();
        }
    }



}
