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
        Schema::create('applicantsreferees', function (Blueprint $table) {
            $table->increments('id'); 
            $table->string('applicants_id', 14);
            $table->string('fullname', 75);
            $table->string('phone_no', 11);
            $table->string('email_address', 100);
            $table->string('contact_address', 200)->nullable();
            $table->string('rank', 45)->nullable();
            $table->string('attachment_url', 300)->default('');
            $table->string('note', 300)->nullable();
            $table->date('date_commented')->nullable();
            $table->boolean('recommendation_status')->nullable();
            $table->boolean('mail_sent')->nullable();
            $table->boolean('responded')->default(false);
            $table->timestamps(); 

            // Define foreign key relationship if 'applicants_id' references another table (e.g., applicants)
            $table->foreign('applicants_id')->references('appno')->on('applicants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicantsreferees');
    }
};
