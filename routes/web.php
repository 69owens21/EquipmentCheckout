<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Equipment;
use Illuminate\Http\Request; // <--- THIS LINE IS THE FIX

// MAIN INVENTORY PAGE
Route::get('/', function () {
    $inventory = Equipment::where('status', '!=', 'Broken')->get();
    return view('welcome', ['equipment' => $inventory]);
});

// REPAIR SHOP ROUTE
Route::get('/repairs', function () {
    $brokenItems = Equipment::where('status', 'Broken')->get();
    return view('repairs', ['broken' => $brokenItems]);
});

// SEND TO REPAIR
// Note: I added a leading slash to '/repair/{id}' to keep it consistent
Route::post('/repair/{id}', function(Request $request, $id) {
    $item = Equipment::findOrFail($id);

    $item->update([
        'status' => 'Broken',
        'repair_notes' => $request->input('notes'),
        'return_date' => $request->input('return_date'),
    ]);
    return back();
});
