<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('training_participants', function (Blueprint $table) {
            $table->id();
            $table->string('training_code'); // reference to the training
            $table->string('full_name');
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            
            $table->string('school_name')->nullable();
            $table->string('teacher_name')->nullable();
            $table->string('child_club')->nullable();
            $table->string('school_management_committee')->nullable();
            
            $table->integer('number_of_schemes')->default(0);
            $table->string('event_name')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('training_participants');
    }
};
