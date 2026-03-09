<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Equipment;

Route::get('/', function () {
    $equipment = Equipment::all();
    return view('welcome', compact('equipment'));
});
// REGULAR USER ROUTES
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// ADMIN ONLY ROUTES
Route::get('/admin/inventory', function () {
    return view('admin.inventory');
})->middleware(['auth', 'admin'])->name('admin.inventory');

// PROFILE ROUTES
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
