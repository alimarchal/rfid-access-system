<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardController,
    UserController,
    RfidCardController,
    VehicleController,
    EntryController,
    FamilyMemberController,
    LocationController,
    AssignmentHistoryController
};

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/dashboard', function () { return view('dashboard');})->name('dashboard');
    Route::resource('/location', LocationController::class);
});


// Users
Route::resource('users', UserController::class);

// RFID Cards
Route::resource('rfid-cards', RfidCardController::class);
Route::post('rfid-cards/{rfidCard}/reassign', [RfidCardController::class, 'reassign'])->name('rfid-cards.reassign');

// Vehicles
Route::resource('vehicles', VehicleController::class);

// Entries
Route::resource('entries', EntryController::class)->only(['index', 'show']);

// Family Members
Route::resource('users.family-members', FamilyMemberController::class)->shallow();

// Locations
Route::resource('locations', LocationController::class);

// Assignment History
Route::resource('assignment-histories', AssignmentHistoryController::class)->only(['index', 'show']);
