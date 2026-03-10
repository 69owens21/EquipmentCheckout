<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('equipment', function (Blueprint $table) {
            $table->id(); // This automatically creates an auto-incrementing primary key
            $table->string('name'); // e.g., "MacBook Pro 14", "Dell Monitor"
            $table->string('serial_number')->unique(); // Ensures no two items have the same serial
            $table->string('type'); // e.g., "Laptop", "Camera", "Adapter"
            $table->string('status')->default('Available'); // Automatically sets new items to 'Available'
            $table->text('repair_notes')->nullable();
            $table->date('return_date')->nullable();
            $table->timestamps(); // Automatically creates 'created_at' and 'updated_at' columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};
