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
        Schema::create('schemes', function (Blueprint $table) {
            $table->id();
            $table->string('province'); // New province column
            $table->string('district');
            $table->string('mun');
            $table->integer('ward_no');
            $table->string('scheme_code')->unique();
            $table->string('scheme_name');
            $table->enum('sector', ['Water Supply', 'MUS']);
            $table->enum('scheme_technology', ['Gravity', 'Solar Lift'])->nullable();
            $table->enum('scheme_type', ['New', 'Rehab']);
            $table->year('scheme_start_year');
            $table->boolean('source_registration_status')->default(false);
            $table->integer('no_subscheme')->nullable();
            $table->year('completed_year')->nullable();
            $table->date('completion_date')->nullable();
            $table->boolean('source_conservation')->default(false);
            $table->date('agreement_signed_date')->nullable();
            $table->date('schedule_end_date')->nullable();
            $table->date('started_date')->nullable();
            $table->date('planned_completion_date')->nullable();
            $table->date('actual_completed_date')->nullable();
            $table->enum('progress_status', ['Completed', 'Ongoing', 'Dropout']);
            $table->text('justification_for_delay')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schemes');
    }
};
