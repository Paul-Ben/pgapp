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
        Schema::create('applicants', function (Blueprint $table) {
            $table->string('appno', 20)->primary();
            $table->string('application_type', 50)->nullable();
            $table->string('school_id', 5)->nullable();
            $table->string('fullname', 75)->nullable();
            $table->string('sex', 6)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('country', 50)->nullable();
            $table->string('state_of_origin', 50)->nullable();
            $table->string('lga', 50)->nullable();
            $table->string('email_address', 21)->nullable();
            $table->string('phone_no', 20)->nullable();
            $table->string('contact_address', 52)->nullable();
            $table->string('home_town', 7)->nullable();
            $table->string('passport')->nullable();
            $table->string('credentials')->nullable();
            $table->dateTime('date_initiated')->nullable();
            $table->dateTime('date_completed')->nullable();
            $table->string('status', 20)->nullable();
            $table->string('qualification', 20)->nullable();
            $table->string('session', 10)->nullable();
            $table->boolean('refereers_needed')->default(false);
            $table->boolean('ref_completion_status')->default(false);
            $table->string('first_choice', 10)->nullable();
            $table->string('second_choice', 10)->nullable();
            $table->string('password', 45)->nullable();
            $table->unsignedInteger('next_stage')->default(1);
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicants');
    }
};
