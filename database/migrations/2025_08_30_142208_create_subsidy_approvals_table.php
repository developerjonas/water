<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('subsidy_approvals', function (Blueprint $table) {
            $table->id();
            $table->string('scheme_code'); // Link to schemes
            $table->boolean('approve_subsidy')->default(false);
            $table->text('remarks')->nullable();
            $table->timestamps();

            $table->foreign('scheme_code')
                ->references('scheme_code')
                ->on('schemes')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subsidy_approvals');
    }
};
