<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sanitation_metrics', function (Blueprint $table) {
            $table->id();
            $table->string('scheme_code')->comment('Foreign key to schemes.scheme_code');

            // Household counts
            $table->integer('households_total')->default(0);
            $table->integer('households_with_toilet')->default(0);
            $table->integer('households_with_drying_rack')->default(0);
            $table->integer('households_with_handwashing_station')->default(0);
            $table->integer('households_using_filter')->default(0);
            $table->integer('households_with_waste_disposal_pit')->default(0);

            // Sanitation status as string
            $table->string('total_sanitation_status')->default("No");

            // Optional remarks
            $table->text('remarks')->nullable();

            $table->timestamps();

            // Foreign key
            $table->foreign('scheme_code')->references('scheme_code')->on('schemes')->onDelete('cascade');
            $table->index('scheme_code');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sanitation_metrics');
    }
};
