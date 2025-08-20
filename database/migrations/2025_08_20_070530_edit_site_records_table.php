<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('site_records', function (Blueprint $table) {
            // Change photos and plaque_photo to JSON
            $table->json('photos')->nullable()->change();
            $table->json('plaque_photo')->nullable()->change();

            // Change latitude and longitude to decimal(10,7)
            $table->decimal('latitude', 10, 7)->nullable()->change();
            $table->decimal('longitude', 10, 7)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_records', function (Blueprint $table) {
            $table->text('photos')->nullable()->change();
            $table->text('plaque_photo')->nullable()->change();
            $table->bigInteger('latitude')->nullable()->change();
            $table->bigInteger('longitude')->nullable()->change();
        });
    }
};
