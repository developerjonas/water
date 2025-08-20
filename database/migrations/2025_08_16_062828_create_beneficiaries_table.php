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
        Schema::create('beneficiaries', function (Blueprint $table) {
            $table->id();

            // Foreign key to schemes table using scheme_code
            $table->string('scheme_code')->comment('Foreign key to schemes.scheme_code');

            // Household Beneficiaries
            $table->integer('dalit_hh_poor')->default(0);
            $table->integer('dalit_hh_nonpoor')->default(0);
            $table->integer('aj_hh_poor')->default(0);
            $table->integer('aj_hh_nonpoor')->default(0);
            $table->integer('other_hh_poor')->default(0);
            $table->integer('other_hh_nonpoor')->default(0);

            // Individual Beneficiaries
            $table->integer('dalit_female')->default(0);
            $table->integer('dalit_male')->default(0);
            $table->integer('aj_female')->default(0);
            $table->integer('aj_male')->default(0);
            $table->integer('others_female')->default(0);
            $table->integer('others_male')->default(0);

            // School Beneficiaries
            $table->integer('base_population')->default(0);
            $table->integer('boys_student')->default(0);
            $table->integer('girls_student')->default(0);
            $table->integer('teachers_staff')->default(0);

            // Timestamps
            $table->timestamps();

            // Index for fast lookups
            $table->index('scheme_code');

            // Foreign key constraint
            $table->foreign('scheme_code')
                  ->references('scheme_code')
                  ->on('schemes')
                  ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beneficiaries');
    }
};
