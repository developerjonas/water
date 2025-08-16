<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('household_sanitations', function (Blueprint $table) {
            $table->id();

            // Link to Scheme
            $table->foreignId('scheme_id')->constrained('schemes')->onDelete('cascade');

            $table->string('district')->nullable();
            $table->string('palika')->nullable();
            $table->string('donor')->nullable();
            $table->string('scheme_start_year')->nullable();
            $table->string('scheme_name')->nullable();

            // Household sanitation data
            $table->integer('hh_beneficiaries')->nullable();
            $table->integer('hh_having_toilets')->nullable();
            $table->integer('hh_having_chang')->nullable(); // e.g., bathrooms or bathing spaces
            $table->integer('hh_having_handwash_station')->nullable();
            $table->integer('hh_having_filter')->nullable();
            $table->integer('hh_having_waste_disposal_system')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('household_sanitations');
    }
};

