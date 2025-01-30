<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Location;
use App\Models\RfidCard;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Faker\Factory;

class UserController extends Controller
{
    public function index()
    {

//        $faker = \Faker\Factory::create();
//        $uniqueEmail = $faker->unique()->safeEmail();
        $users = QueryBuilder::for(User::class)
            ->allowedFilters([
                AllowedFilter::partial('name'),
                AllowedFilter::partial('email'),
                AllowedFilter::partial('cnic'),
                AllowedFilter::exact('location_id'),
            ])
            ->with('location')
            ->latest()
            ->paginate(10);

        return view('users.index', compact('users'));
    }

    public function create()
    {
        $locations = Location::orderBy('city')->get();
        return view('users.create', compact('locations'));
    }

    public function show(User $user)
    {
        $user->load([
            'location',
            'rfidCards.assignmentHistories.assignedBy',
            'vehicles',
            'familyMembers',
            'entries' => function ($query) {
                $query->with(['rfidCard', 'vehicle'])
                    ->latest()
                    ->take(10);
            }
        ]);


        return view('users.show', compact('user'));
    }

    public function store(StoreUserRequest $request)
    {
        try {
            $user = User::create($request->validated());

            session()->flash('success', 'User created successfully.');
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            session()->flash('error', 'Error creating user. Please try again.');
            return redirect()->back()->withInput();
        }
    }

    public function edit(User $user)
    {
        try {
            $locations = Location::orderBy('city')->get();
            return view('users.edit', compact('user', 'locations'));
        } catch (\Exception $e) {
            session()->flash('error', 'Error loading user data. Please try again.');
            return redirect()->route('users.index');
        }
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $validatedData = $request->validated();

            // Only update password if provided
            if (empty($validatedData['password'])) {
                unset($validatedData['password']);
            }

            $user->update($validatedData);

            session()->flash('success', 'User updated successfully.');
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            session()->flash('error', 'Error updating user. Please try again.');
            return redirect()->back()->withInput();
        }
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();

            session()->flash('success', 'User deleted successfully.');
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            session()->flash('error', 'Error deleting user. Please try again.');
            return redirect()->back();
        }
    }


    public function search_by_rfid_card(Request $request)
    {
        $card_number = $request->card_number;
        $card = RfidCard::where('card_number', $card_number)->first();  // Retrieve card directly
    
        if ($card) {
            // If card exists, check its status
            $is_card_active = null;
            if ($card->status == "active") {
                $is_card_active = "active";
            } elseif ($card->status == "expired") {
                $is_card_active = "expired";
            } elseif ($card->status == "inactive") {
                $is_card_active = "inactive";
            }
    
            return to_route('users.show', [
                'user' => $card->user_id, 
                'is_card_active' => $is_card_active, 
                'rfid_card_id' => $card->id,
                'user_id' => $card->user_id
            ]);
        } else {
            // Add a debug log here
        
    
            // If card doesn't exist, return with error message
            return back()->with('error',
             'اس فرد کی کوئی معلومات موجود نہیں ہے ، براہ کرم دوبارہ کوشش کریں، اگر پھر بھی موجود نہ ہو تو یہ مشکوک افراد میں شامل ہو سکتا ہے اور اس کی تصدیق شروع کی جائے۔');
        }
        
    }
    
   }

