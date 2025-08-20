<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_records', function (Blueprint $table) {
            $table->id();

            // scheme_code as a foreign key
            $table->string('scheme_code');
            $table->foreign('scheme_code')->references('scheme_code')->on('schemes')->onDelete('cascade');

            $table->string('scheme_name')->nullable(); // Optional if you want to store scheme_name
            $table->string('water_system_name');
            $table->string('location_type')->nullable(); // Community, School Health Center/Clinic, Public Institutions
            $table->string('water_point_name')->nullable();
            $table->string('source_details')->nullable(); // Spring To Gravity Flow, Spring To Solar Pump
            $table->string('hardware_details')->nullable(); // Community Tap Stand(s), On-Plot Tap Stand(s)

            $table->json('photos')->nullable(); // Multiple photos
            $table->string('plaque_photo')->nullable(); // Single plaque photo

            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_records');
    }
};
