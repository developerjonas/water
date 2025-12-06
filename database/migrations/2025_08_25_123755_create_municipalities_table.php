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
        Schema::create('municipalities', function (Blueprint $table) {
            $table->id(); // internal PK
            $table->string('district_code', 10); // FK to districts.code
            $table->string('municipality_code', 50)->unique(); // optional municipality code
            $table->string('name'); // municipality name
            $table->boolean('is_active')->default(false); // active flag
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('district_code')
                ->references('district_code')
                ->on('districts')
                ->cascadeOnDelete();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('municipalities');
    }
};
