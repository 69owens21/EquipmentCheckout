<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Equipment;
use Illuminate\Http\Request;

// ==========================================
// 1. SECURED EQUIPMENT ROUTES
// (The 'auth' middleware means you MUST be logged in to use these)
// ==========================================
Route::middleware('auth')->group(function () {

    // MAIN INVENTORY PAGE
    Route::get('/', function () {
        $inventory = Equipment::where('status', '!=', 'Broken')->get();
        return view('welcome', ['equipment' => $inventory]);
    })->name('home');

// REPAIR SHOP ROUTE (Admin Only)
    Route::get('/repairs', function () {
        // If the user is NOT an admin, kick them back to the home page with an error
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Unauthorized Access');
        }

        $brokenItems = Equipment::where('status', 'Broken')->get();
        return view('repairs', ['broken' => $brokenItems]);
    });

    // SEND TO REPAIR
    Route::post('/repair/{id}', function(Request $request, $id) {
        $item = Equipment::findOrFail($id);

        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Unauthorized Access');
        }

        $item->update([
            'status' => 'Broken',
            'repair_notes' => $request->input('notes'),
            'return_date' => $request->input('return_date'),
        ]);
        return back();
    });

    // CHECK OUT
    Route::post('/checkout/{id}', function ($id) {
        $item = Equipment::findOrFail($id);
        $item->update(['status' => 'Checked Out']);
        return back();
    });

    // CHECK IN
    Route::post('/checkin/{id}', function ($id) {
        $item = Equipment::findOrFail($id);
        $item->update(['status' => 'Available']);
        return back();
    });

});

// ==========================================
// 2. LARAVEL BREEZE PROFILE ROUTES
// ==========================================
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
