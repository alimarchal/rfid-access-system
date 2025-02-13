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
    AssignmentHistoryController,
    AdministrationController,
    ReportController,

};
Route::get('/', function () {
    return to_route('login');
});
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::resource('vehicles', VehicleController::class);
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');


    Route::resource('/administration/locations', LocationController::class);
    Route::resource('/administration/users', UserController::class);
    Route::resource('/locations', LocationController::class);
    Route::resource('/users', UserController::class);
    Route::post('/search-rfid-card', [UserController::class, 'search_by_rfid_card'])->name('search_by_rfid_card');
    Route::resource('rfid-cards', RfidCardController::class);
    Route::get('rfid-cards/create/user/{user}', [RfidCardController::class, 'rfid_card_create_via_user'])->name('rfid-card.rfid_card_create_via_user');
    Route::post('rfid-cards/{rfidCard}/reassign', [RfidCardController::class, 'reassign'])->name('rfid-cards.reassign');
    Route::resource('vehicles',VehicleController::class);
    Route::get('vehicles/create/user/{user}', [VehicleController::class, 'vehicles_create_via_user'])->name('vehicles.vehicles_create_via_user');

//    Route::resource('entries', EntryController::class);
    Route::post('/entries', [EntryController::class, 'store'])->name('entries.store');
// Family Members
    Route::resource('family-members', FamilyMemberController::class);
    Route::get('family-members/create/user/{user}', [RfidCardController::class, 'family_members_create_via_user'])->name('family-members.rfid_card_create_via_user');

    // Assignment History
    Route::resource('assignment-histories', AssignmentHistoryController::class)->only(['index', 'show']);

    Route::get('/administration', [AdministrationController::class, 'index'])->name('administration');


     Route::get('reports', [ReportController::class, 'index'])->name('reports');
     Route::get('reports/all-reports', [ReportController::class, 'allReports'])->name('reports.all-reports');
     Route::get('/reports/access-activity', [ReportController::class, 'accessActivity'])->name('reports.access-activity');

     Route::get('reports/family-access', [ReportController::class, 'familyMemberAccessReport'])->name('reports.family.access');
     Route::get('reports/rfid-report', [ReportController::class, 'RfidReport'])->name('rfid.report');
     Route::get('reports/guard-activity', [ReportController::class, 'guardReport'])->name('reports.guard.activity');
     Route::get('reports/aggregate-report', [ReportController::class, 'AgriReport'])->name('reports.aggregate.report');
    });
