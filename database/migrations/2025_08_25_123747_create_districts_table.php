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
        Schema::create('districts', function (Blueprint $table) {
            $table->id(); // keep primary key for districts
            $table->string('province_code', 10); // FK to provinces.code
            $table->string('district_code', 10)->unique(); // district code
            $table->string('name'); // district name
            $table->boolean('is_active')->default(false); // active flag
            $table->timestamps();

            // Foreign key constraint to provinces.code
            $table->foreign('province_code')
                ->references('province_code')
                ->on('provinces')
                ->cascadeOnDelete();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('districts');
    }
};
