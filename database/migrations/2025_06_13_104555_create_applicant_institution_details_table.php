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
        Schema::create('applicant_institution_details', function (Blueprint $table) {
           
            $table->id();
            $table->string('applicants_id');
            $table->string('institution_name')->nullable();
            $table->string('field_of_study')->nullable();
            $table->date('date_started')->nullable();
            $table->date('date_ended')->nullable();
            $table->string('certificate_awarded')->nullable();
            $table->timestamps();

            $table->foreign('applicants_id')
                ->references('appno')
                ->on('applicants')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicant_institution_details');
    }
};
