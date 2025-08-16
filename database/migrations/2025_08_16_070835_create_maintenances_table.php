<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();

            // Link to Scheme
            $table->foreignId('scheme_id')->constrained('schemes')->onDelete('cascade');

            $table->string('district')->nullable();
            $table->string('palika')->nullable();
            $table->string('donor')->nullable();
            $table->string('scheme_start_year')->nullable();
            $table->string('scheme_name')->nullable();

            // Maintenance fund & tap info
            $table->string('bank_name')->nullable();
            $table->string('account_no')->nullable();
            $table->string('account_name')->nullable();
            $table->decimal('fund_collected_last_year', 15, 2)->nullable();
            $table->decimal('fund_collection_per_hh', 15, 2)->nullable();
            $table->decimal('total_fund_collection_this_year', 15, 2)->nullable();
            $table->decimal('total_fund_till_date', 15, 2)->nullable();
            $table->decimal('expenditure_till_date', 15, 2)->nullable();
            $table->integer('hh_beneficiaries')->nullable();
            $table->integer('total_taps')->nullable();
            $table->decimal('maintenance_fund_per_tap', 15, 2)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};
