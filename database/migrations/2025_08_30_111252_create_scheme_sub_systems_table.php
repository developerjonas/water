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
        Schema::create('scheme_sub_systems', function (Blueprint $table) {
            $table->id();

            // Foreign key referencing schemes.scheme_code
            $table->string('scheme_code');
            $table->foreign('scheme_code')
                  ->references('scheme_code')
                  ->on('schemes')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();

            $table->string('name'); // DWS name
            $table->integer('sequence')->nullable(); // Order if needed
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scheme_sub_systems');
    }
};
