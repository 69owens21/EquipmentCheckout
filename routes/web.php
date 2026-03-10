<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| 1. PUBLIC / GUEST ROUTES
|--------------------------------------------------------------------------
| These routes are handled by Laravel Breeze (login, register, etc.)
| they are imported at the bottom of the file via auth.php.
*/

// =========================================================================
// 2. AUTHENTICATED ROUTES (Must be logged in to access anything below)
// =========================================================================
Route::middleware('auth')->group(function () {

    /**
     * MAIN INVENTORY PAGE
     * Accessible by: Students and Admins
     */
    Route::get('/', function () {
        // We only show items that are NOT currently in the repair shop
        $inventory = Equipment::where('status', '!=', 'Broken')->get();
        return view('welcome', ['equipment' => $inventory]);
    })->name('home');

    /**
     * REPAIR SHOP PAGE
     * Accessible by: ADMIN ONLY
     */
    Route::get('/repairs', function () {
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Unauthorized Access.');
        }

        $brokenItems = Equipment::where('status', 'Broken')->get();
        return view('repairs', ['broken' => $brokenItems]);
    });

    /**
     * ADD NEW EQUIPMENT FORM
     * Accessible by: ADMIN ONLY
     */
    Route::get('/equipment/create', function () {
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Unauthorized.');
        }
        return view('create-equipment');
    });

    /**
     * SAVE NEW EQUIPMENT TO DATABASE
     * Accessible by: ADMIN ONLY
     */
    Route::post('/equipment/store', function (Request $request) {
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Unauthorized Action.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'serial_number' => 'required|string|unique:equipment',
            'type' => 'required|string',
        ]);

        Equipment::create([
            'name' => $request->name,
            'serial_number' => $request->serial_number,
            'type' => $request->type,
            'status' => 'Available',
        ]);

        return redirect('/')->with('success', 'New equipment added successfully!');
    });

    /**
     * SEND TO REPAIR LOGIC
     * Accessible by: ADMIN ONLY
     */
    Route::post('/repair/{id}', function(Request $request, $id) {
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Unauthorized.');
        }

        $item = Equipment::findOrFail($id);
        $item->update([
            'status' => 'Broken',
            'repair_notes' => $request->input('notes'),
            'return_date' => $request->input('return_date'),
        ]);

        return redirect('/repairs')->with('success', 'Item sent to repair queue.');
    });

    /**
     * CHECK OUT LOGIC
     * Accessible by: Students and Admins
     */
    Route::post('/checkout/{id}', function ($id) {
        $item = Equipment::findOrFail($id);
        $item->update(['status' => 'Checked Out']);
        return back();
    });

    /**
     * CHECK IN LOGIC (Mark as Fixed)
     * Accessible by: Students and Admins
     */
    Route::post('/checkin/{id}', function ($id) {
        $item = Equipment::findOrFail($id);
        $item->update([
            'status' => 'Available',
            'repair_notes' => null, // Clear notes once fixed
            'return_date' => null,  // Clear date once fixed
        ]);
        return back();
    });

});

/*
|--------------------------------------------------------------------------
| 3. BREEZE / PROFILE MANAGEMENT
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// The "Engine" for Auth (Login, Register, Logout)
require __DIR__.'/auth.php';
