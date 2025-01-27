<?php

namespace App\Http\Controllers;
use App\Models\Location;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;


class UserController
{
    public function index()
    {
        $users = User::with('location')->paginate(10);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $locations = Location::all();
        return view('users.form', compact('locations'));
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->validated());

        return redirect()->route('users.show', $user)
            ->with('success', 'User created successfully');
    }

    public function show(User $user)
    {
        $user->load(['rfidCards', 'vehicles', 'familyMembers', 'entries']);
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $locations = Location::all();
        return view('users.form', compact('user', 'locations'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());

        return redirect()->route('users.show', $user)
            ->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
}
