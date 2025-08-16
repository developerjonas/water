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
        Schema::create('user_committee_infos', function (Blueprint $table) {
            $table->id();

            // Link to Scheme
            $table->foreignId('scheme_id')->constrained('schemes')->onDelete('cascade');

            $table->string('district')->nullable();
            $table->string('palika')->nullable();

            // Committee member details
            $table->string('name')->nullable();
            $table->string('position')->nullable();
            $table->string('ethnicity_gender')->nullable(); // e.g., "Dalit Male"
            $table->string('contact_no')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_committee_infos');
    }
};
