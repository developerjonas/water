<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('photo_banks', function (Blueprint $table) {
            $table->id();
            $table->string('water_system_name');
            $table->string('community_name');
            $table->enum('location_type', ['Community', 'School']);
            $table->string('water_point_name')->nullable();
            $table->integer('hh_count')->default(0);
            $table->integer('taps_count')->default(0);
            $table->integer('total_users')->default(0);
            $table->integer('unique_users')->default(0);
            $table->decimal('latitude', 9, 6)->nullable();
            $table->decimal('longitude', 9, 6)->nullable();
            $table->json('photos')->nullable(); // Multiple photos as JSON
            $table->string('plaque_photo')->nullable(); // Single plaque photo
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('photo_banks');
    }
};
