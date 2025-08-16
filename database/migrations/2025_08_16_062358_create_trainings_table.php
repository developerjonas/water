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
    Schema::create('trainings', function (Blueprint $table) {
        $table->id();
        $table->foreignId('scheme_id')->constrained()->cascadeOnDelete(); // Link to schemes
        $table->string('training_type'); // e.g. Mason Training, Refresher Training
        $table->string('training_name'); // Specific name of training
        $table->date('training_start_date')->nullable();
        $table->date('training_end_date')->nullable();
        $table->integer('training_days')->nullable();
        $table->string('training_place')->nullable();
        $table->string('facilitator_name')->nullable();

        // Participants details
        $table->integer('num_participating_schools')->nullable();
        $table->integer('teacher_count')->nullable();
        $table->integer('child_club_count')->nullable();
        $table->integer('school_mgmt_committee_count')->nullable();

        // Social breakdown
        $table->integer('dalit_male')->nullable();
        $table->integer('dalit_female')->nullable();
        $table->integer('dalit_total')->nullable();
        $table->integer('janjati_male')->nullable();
        $table->integer('janjati_female')->nullable();
        $table->integer('janjati_total')->nullable();
        $table->integer('other_male')->nullable();
        $table->integer('other_female')->nullable();
        $table->integer('other_total')->nullable();
        $table->integer('male_total')->nullable();
        $table->integer('female_total')->nullable();
        $table->integer('total')->nullable();

        $table->integer('num_schemes_participants')->nullable();
        $table->text('other')->nullable(); // for extra notes
        $table->softDeletes();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainings');
    }
};
