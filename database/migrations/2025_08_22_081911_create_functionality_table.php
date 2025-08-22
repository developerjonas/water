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
        Schema::create('functionality', function (Blueprint $table) {
            $table->id();

            // General Info
            $table->string('province')->nullable();
            $table->string('district')->nullable();
            $table->string('municipality')->nullable();
            $table->string('ward_no')->nullable();
            $table->string('scheme_year')->nullable();
            $table->string('scheme_completion_date')->nullable();

            // UC Info
            $table->string('female_members')->nullable();
            $table->string('male_members')->nullable();
            $table->string('total_members')->nullable();
            $table->string('janjati_members')->nullable();
            $table->string('dalit_members')->nullable();
            $table->string('other_members')->nullable();
            $table->string('uc_meeting_status')->nullable();
            $table->string('uc_latest_meeting_date')->nullable();

            // VMW Info
            $table->string('vmw_name')->nullable();
            $table->string('trained_vmw')->nullable();
            $table->string('vmw_status')->nullable();
            $table->string('vmw_salary')->nullable();

            // Financial Info
            $table->string('maintenance_fund_per_house')->nullable();
            $table->string('expected_monthly_collection')->nullable();
            $table->string('total_fund_deposited')->nullable();
            $table->string('fund_location')->nullable(); // Bank, Cooperative, etc.
            $table->string('total_expenditure')->nullable();
            $table->string('record_status')->nullable();

            // Scheme Functionality
            $table->string('total_households')->nullable();
            $table->string('total_taps')->nullable();
            $table->string('functional_taps')->nullable();
            $table->string('non_functional_taps')->nullable();
            $table->string('reason_non_functional')->nullable();
            $table->string('scheme_registration_status')->nullable();
            $table->string('notice_board_status')->nullable();

            // RVT & Conservation
            $table->string('rvt_status')->nullable();
            $table->string('resource_conservation_practice')->nullable();
            $table->string('households_with_filter')->nullable();
            $table->string('households_with_garbage_dump')->nullable();
            $table->string('households_with_drying_rack')->nullable();

            // Media Uploads (store file paths)
            $table->string('rvt_photo')->nullable();
            $table->string('monitoring_photo')->nullable();
            $table->string('solar_lift_photo')->nullable();
            $table->string('tap_photo')->nullable();
            $table->string('garbage_dryer_photo')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('functionality');
    }
};
