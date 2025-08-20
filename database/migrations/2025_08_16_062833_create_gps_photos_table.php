<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gps_photos', function (Blueprint $table) {
            $table->id();

            // Scheme reference
            $table->string('scheme_code');
            $table->foreign('scheme_code')->references('scheme_code')->on('schemes')->onDelete('cascade');

            $table->string('scheme_name')->nullable(); // Optional, auto-populated from scheme_code
            $table->string('water_system_name');
            $table->string('location_type')->nullable(); // Community, School Health Center/Clinic, Public Institutions
            $table->string('source_type')->nullable(); // Spring To Gravity Flow, Spring To Solar Pump
            $table->string('hardware_type')->nullable(); // Community Tap Stand(s), On-Plot Tap Stand(s)

            $table->json('structure_photos')->nullable(); // Multiple photos
            $table->json('plaque_photos')->nullable(); // Multiple plaque photos

            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            $table->text('remarks')->nullable(); // Any optional remarks

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gps_photos');
    }
};
