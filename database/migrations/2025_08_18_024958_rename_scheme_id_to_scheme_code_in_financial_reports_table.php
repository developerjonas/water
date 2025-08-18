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
        Schema::table('financial_reports', function (Blueprint $table) {
            // Drop foreign key if exists
            $table->dropForeign(['scheme_id']);

            // Rename column
            $table->renameColumn('scheme_id', 'scheme_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('financial_reports', function (Blueprint $table) {
            $table->renameColumn('scheme_code', 'scheme_id');

            // Optionally re-add foreign key if needed
            $table->foreign('scheme_id')->references('id')->on('schemes')->onDelete('cascade');
        });
    }
};
