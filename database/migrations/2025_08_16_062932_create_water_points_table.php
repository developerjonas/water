<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('water_points', function (Blueprint $table) {
            $table->id();

            // -------------------
            // Reference to Scheme
            // -------------------
            $table->string('scheme_code')->comment('Foreign key to schemes.scheme_code');

            // -------------------
            // Water Point Details
            // -------------------
            $table->string('sub_system_name')->nullable()->comment('Water Sub-System / Sub-Scheme Name');
            $table->string('water_point_name')->nullable()->comment('Water Point Name');
            $table->enum('location_type', [
                'community',
                'school',
                'health_center',
                'public_institution',
                'other'
            ])->nullable()->comment('Type of water point location');

            // -------------------
            // Users
            // -------------------
            $table->integer('woman')->default(0)->comment('Number of female users');
            $table->integer('man')->default(0)->comment('Number of male users');
            $table->integer('total_water_users')->default(0)->comment('Calculated as woman + man');

            // -------------------
            // Tap Construction Status
            // -------------------
            $table->enum('tap_construction_status', ['yes', 'no'])->default('no');

            // -------------------
            // Remarks
            // -------------------
            $table->text('remarks')->nullable();

            $table->timestamps();

            // -------------------
            // Index
            // -------------------
            $table->index('scheme_code');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('water_points');
    }
};
