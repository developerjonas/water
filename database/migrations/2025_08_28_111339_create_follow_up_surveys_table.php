<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('follow_up_surveys', function (Blueprint $table) {
            $table->id();

            // 1. Survey Information
            $table->string('follow_up_type'); // First / Second
            $table->string('enumerator_name');
            $table->date('follow_up_date');
            $table->string('key_respondent_name');
            $table->string('key_respondent_position');
            $table->string('key_respondent_contact', 20)->nullable();
            $table->string('wusc_official_name');

            // Scheme relation (scheme_code is unique in schemes table)
            $table->string('scheme_code');
            $table->foreign('scheme_code')->references('scheme_code')->on('schemes')->onDelete('cascade');

            // 3. Project Coverage
            $table->integer('total_households');
            $table->integer('total_taps');
            $table->integer('functional_taps')->default(0);
            $table->integer('non_functional_taps_closure')->default(0);
            $table->integer('non_functional_taps_no_water')->default(0);
            $table->text('reasons_non_functionality')->nullable();
            $table->boolean('is_mus')->default(false);
            $table->integer('households_with_kitchen_gardens')->default(0);
            $table->decimal('avg_kitchen_garden_size', 5, 2)->nullable();

            // 4. WUSC Information
            $table->boolean('is_wusc')->default(false);
            $table->integer('total_wusc_officials')->default(0);
            $table->integer('female_officials')->default(0);
            $table->integer('dalit_officials')->default(0);
            $table->integer('janajati_officials')->default(0);
            $table->string('wusc_chairperson_name')->nullable();
            $table->string('wusc_chairperson_contact', 20)->nullable();
            $table->string('wusc_vice_chairperson_name')->nullable();
            $table->string('wusc_vice_chairperson_contact', 20)->nullable();
            $table->string('wusc_secretary_name')->nullable();
            $table->string('wusc_secretary_contact', 20)->nullable();
            $table->string('wusc_treasurer_name')->nullable();
            $table->string('wusc_treasurer_contact', 20)->nullable();

            // 5. Caretaker Information
            $table->boolean('is_caretaker')->default(false);
            $table->string('caretaker_name')->nullable();
            $table->string('caretaker_contact', 20)->nullable();
            $table->boolean('caretaker_regular')->default(false);
            $table->boolean('caretaker_trained')->default(false);
            $table->boolean('caretaker_paid')->default(false);
            $table->decimal('caretaker_honorarium', 10, 2)->nullable();

            // 6. Governance & Functionality
            $table->boolean('is_wusc_registered')->default(false);
            $table->string('registration_number')->nullable();
            $table->boolean('ag_assembly_regular')->default(false);
            $table->date('last_general_assembly_date')->nullable();
            $table->boolean('meetings_regular')->default(false);
            $table->string('meeting_frequency')->nullable();
            $table->integer('meetings_last_year')->default(0);
            $table->boolean('wusc_reformed')->default(false);
            $table->string('record_minutes')->nullable();
            $table->string('record_income_expense')->nullable();
            $table->boolean('has_om_plan')->default(false);
            $table->boolean('fund_collection_regular')->default(false);
            $table->decimal('monthly_tariff', 8, 2)->nullable();
            $table->decimal('total_om_fund', 12, 2)->nullable();

            // 7. Infrastructure Condition
            $table->string('status_intake')->nullable();
            $table->string('status_pipeline')->nullable();
            $table->string('status_rvt')->nullable();
            $table->string('status_tap_stands')->nullable();
            $table->string('status_other_structures')->nullable();
            $table->string('photo_1')->nullable();
            $table->string('photo_2')->nullable();

            // 8. Issues and Improvements
            $table->text('major_problems')->nullable();
            $table->text('enumerator_suggestions')->nullable();
            $table->text('improvements_done')->nullable();

            // 9. GPS Location
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('follow_up_surveys');
    }
};
