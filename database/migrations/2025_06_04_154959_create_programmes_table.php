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
        Schema::create('programmes', function (Blueprint $table) {
            $table->id();
             $table->string('code', 10)->unique(); // Using code as primary key
            $table->string('d_code', 10); // Department code
            $table->string('name'); // Programme name
            $table->integer('min_score'); // Minimum score
            $table->boolean('archive')->default(false); // Archive flag (0/1)
            $table->string('f_code', 10); // Faculty code
            $table->boolean('has_peo')->default(false); // Has PEO flag (0/1)
            $table->string('category'); // Programme category
            
            // Optional timestamps if you need them
            $table->timestamps();
            
            // Indexes for better performance
            $table->index('d_code');
            $table->index('f_code');
            $table->index('category');
        });

       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programmes');
    }
};
