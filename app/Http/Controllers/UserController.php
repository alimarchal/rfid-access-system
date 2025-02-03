<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\RfidCard;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Faker\Factory;

class UserController extends Controller
{
    // Display users list
    public function index()
    {
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

    // Show create form
    public function create()
    {
        $locations = Location::orderBy('city')->get();
        return view('users.create', compact('locations'));
    }

    // Store new user
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'father_name' => 'nullable|string|max:100',
            'cnic' => 'nullable|string|max:15|unique:users,cnic',
            'mobile' => 'nullable|string|max:15',
            'telephone' => 'nullable|string|max:15',
            'location_id' => 'nullable|exists:locations,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $faker = Factory::create();

            $userData = $validator->validated();
            $userData['email'] = $faker->unique()->safeEmail();
            $userData['password'] = bcrypt($faker->password(8, 12));

            User::create($userData);

            return redirect()->route('users.index')
                ->with('success', 'User created successfully. Credentials were auto-generated.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error creating user: ' . $e->getMessage());
        }
    }

    // Show user details
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

    // Show edit form
    public function edit(User $user)
    {
        if(auth()->user()->role == "Guard"){
            abort(403);
        }
        $locations = Location::orderBy('city')->get();
        return view('users.edit', compact('user', 'locations'));
    }

    // Update user
    public function update(Request $request, User $user)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'father_name' => 'nullable|string|max:100',
            'cnic' => 'nullable|string|max:15|unique:users,cnic,' . $user->id,
            'mobile' => 'nullable|string|max:15',
            'telephone' => 'nullable|string|max:15',
            'location_id' => 'nullable|exists:locations,id',
            'password' => 'nullable|string|min:8',
             'profile_photo_path' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $data = $validator->validated();

            if (!empty($data['password'])) {
                $data['password'] = bcrypt($data['password']);
            } else {
                unset($data['password']);
            }

            $user->update($data);

            return redirect()->route('users.index')
                ->with('success', 'User updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error updating user: ' . $e->getMessage());
        }
    }

    // Delete user
    public function destroy(User $user)
    {
        if(auth()->user()->role == "Guard"){
            abort(403);
        }
        try {
            $user->delete();
            return redirect()->route('users.index')
                ->with('success', 'User deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error deleting user: ' . $e->getMessage());
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
             'اس فرد کی کوئی معلومات موجود نہ ہے ، براہ کرم دوبارہ کوشش کریں، اگر پھر بھی موجود نہ ہو تو یہ مشکوک افراد میں شامل ہو سکتا ہے اور اس کی تصدیق شروع کی جائے۔');
        }

    }

   }