<?php
    use Illuminate\Support\Facades\Route;
    use App\Models\Equipment;

    Route::get('/', function() {
        $allEquipment = Equipment::all();

        return view('welcome', ['equipment' => $allEquipment]);
    });
