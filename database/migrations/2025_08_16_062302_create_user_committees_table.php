<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('user_committees', function (Blueprint $table) {
            $table->id();
            $table->string('scheme_code'); // FK to schemes
            $table->string('user_committee_name');
            $table->date('date_of_formation')->nullable();
            $table->string('user_committee_bank_account_name')->nullable();
            $table->string('user_committee_bank_account_number')->nullable();

            // Key positions
            $table->string('chair_name')->nullable();
            $table->string('chair_contact')->nullable();
            $table->string('vice_chair_name')->nullable();
            $table->string('vice_chair_contact')->nullable();
            $table->string('secretary_name')->nullable();
            $table->string('secretary_contact')->nullable();
            $table->string('deputy_secretary_name')->nullable();
            $table->string('deputy_secretary_contact')->nullable();
            $table->string('treasurer_name')->nullable();
            $table->string('treasurer_contact')->nullable();

            // Dalit members
            $table->integer('dalit_female_key')->default(0);
            $table->integer('dalit_male_key')->default(0);
            $table->integer('dalit_female_member')->default(0);
            $table->integer('dalit_male_member')->default(0);

            // Janjati members
            $table->integer('janjati_female_key')->default(0);
            $table->integer('janjati_male_key')->default(0);
            $table->integer('janjati_female_member')->default(0);
            $table->integer('janjati_male_member')->default(0);

            // Other members
            $table->integer('others_female_key')->default(0);
            $table->integer('others_male_key')->default(0);
            $table->integer('others_female_member')->default(0);
            $table->integer('others_male_member')->default(0);

            // Registration & Contract
            $table->string('registration_status')->nullable();
            $table->string('registration_number')->nullable();
            $table->date('contract_date')->nullable();
            $table->date('contract_expiry_date')->nullable();
            $table->text('remarks')->nullable();

            $table->timestamps();

            // Foreign key
            $table->foreign('scheme_code')->references('scheme_code')->on('schemes')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_committees');
    }
};
