<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFamilyMemberRequest;
use App\Http\Requests\UpdateFamilyMemberRequest;
use App\Models\FamilyMember;
use App\Models\User;

class FamilyMemberController extends Controller
{
    public function index()
    {
        // Fetch all family members with their associated users
        $familyMembers = FamilyMember::with('user')->latest()->paginate(10);
        return view('family-members.index', compact('familyMembers'));
    }

    public function create()
    {
        // Fetch all users for the dropdown
        $users = User::orderBy('name')->get();
        return view('family-members.create', compact('users'));
    }

    public function store(StoreFamilyMemberRequest $request)
    {
        try {
            // Create the family member with validated data
            FamilyMember::create($request->validated());

            return redirect()
            ->route('users.show', $request->user_id)
                ->with('success', 'Family member created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error creating family member: ' . $e->getMessage());
        }
    }

    public function show(FamilyMember $familyMember)
    {
        // Load the associated user
        $familyMember->load('user');
        return view('family-members.show', compact('familyMember'));
    }

    public function edit(FamilyMember $familyMember)
    {
        // Fetch all users for the dropdown
        $users = User::orderBy('name')->get();
        return view('family-members.edit', compact('familyMember', 'users'));
    }

    public function update(UpdateFamilyMemberRequest $request, FamilyMember $familyMember)
    {
        try {
            // Update the family member with validated data
            $familyMember->update($request->validated());

            return redirect()->route('users.show', $request->user_id)
                ->with('success', 'Family member updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error updating family member: ' . $e->getMessage());
        }
    }

    public function destroy(FamilyMember $familyMember)
    {
        try {
            // Delete the family member
            $familyMember->delete();

            return redirect()->route('family-members.index')
                ->with('success', 'Family member deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error deleting family member: ' . $e->getMessage());
        }
    }

      public function family_members_create_via_user(Request $request, User $user)
    {
        try {
            $users = User::where('id', $user->id)
                ->orderBy('name')
                ->get();

            return view('famil-members-create', compact('users'));
        } catch (Exception $e) {
            Log::error('Error in RFID card create form: ' . $e->getMessage());
            session()->flash('error', 'Error loading create form. Please try again.');
            return back();
        }
    }
}