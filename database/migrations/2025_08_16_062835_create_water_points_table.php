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

            // Link to Scheme via scheme_code
            $table->string('scheme_code');
            $table->foreign('scheme_code')->references('scheme_code')->on('schemes')->onDelete('cascade');

            $table->string('district')->nullable();
            $table->string('municipality')->nullable(); // Palika
            $table->integer('ward_no')->nullable();
            $table->string('water_system_name')->nullable();
            $table->string('sub_system')->nullable();
            $table->string('community_name')->nullable();
            $table->string('location_type')->nullable();
            $table->string('water_point_name')->nullable();

            // Population and user stats
            $table->integer('hh')->default(0);
            $table->integer('taps')->default(0);
            $table->integer('population')->default(0);
            $table->integer('total_water_users')->default(0);
            $table->integer('unique_water_users')->default(0);

            // Institutions
            $table->integer('schools')->default(0);
            $table->integer('students')->default(0);
            $table->integer('health_centers')->default(0);
            $table->integer('healthposts')->default(0);

            $table->text('remarks')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->string('photo_url')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('water_points');
    }
};
