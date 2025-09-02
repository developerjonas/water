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
        Schema::create('donors', function (Blueprint $table) {
            $table->id();

            $table->string('donor_code')->unique()->comment('Unique identifier for each donor');

            $table->string('name')->comment('Donor name');
            $table->json('contact_person')->nullable()->comment('JSON array for multiple contacts');
            $table->string('email')->nullable()->unique()->comment('Primary email of donor');
            $table->string('phone')->nullable()->unique()->comment('Primary phone number of donor');
            $table->string('address')->nullable()->comment('Address of donor');
            $table->text('remarks')->nullable()->comment('Additional notes or remarks');

            $table->softDeletes();
            $table->timestamps();

            // Indexes for faster search
            $table->index('donor_code');
            $table->index('name');
            $table->index('email');
            $table->index('phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donors');
    }
};
