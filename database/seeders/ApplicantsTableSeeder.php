<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ApplicantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('applicants')->insert([
            [
                'appno' => 'S00200000326',
                'application_type' => 'Postgraduate',
                'school_id' => 'SCH01',
                'fullname' => 'John Doe',
                'sex' => 'Male',
                'date_of_birth' => '2000-01-01',
                'country' => 'Nigeria',
                'state_of_origin' => 'Benue',
                'lga' => 'Makurdi',
                'email_address' => 'johndoe@example.com',
                'phone_no' => '09038847567',
                'contact_address' => '123 Main St',
                'home_town' => 'Akpehe',
                'passport'=> 'null',
                'credentials'=> 'null',
                'date_initiated' => now(),
                'date_completed' => null,
                'status' => 'Pending',
                'qualification' => 'Master\'s Degree',
                'sessions' => '2025/2026',
                'refereers_needed' => 2,
                'ref_completion_status' => false,
                'first_choice' => 'CS',
                'programme_id' => 1,
                'department' => 'IT',
                'faculty' => 'pass',
                'next_stage' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'appno' => 'S00200000349',
                'application_type' => 'Postgraduate',
                'school_id' => 'SCH02',
                'fullname' => 'Jane Smith',
                'sex' => 'Female',
                'date_of_birth' => '1995-05-15',
                'country' => 'Nigeria',
                'state_of_origin' => 'Kaduna',
                'lga' => 'Soba',
                'email_address' => 'janesmith@example.com',
                'phone_no' => '08047663789',
                'contact_address' => '456 Elm St',
                'home_town' => 'Toronto',
                'passport'=> 'null',
                'credentials'=> 'null',
                'date_initiated' => now(),
                'date_completed' => null,
                'status' => 'Pending',
                'qualification' => 'Bachelor\'s Degree',
                'sessions' => '2025/2026',
                'refereers_needed' => 2,
                'ref_completion_status' => false,
                'first_choice' => 'MBA',
                'programme_id' => 2,
                'department' => 'Finance',
                'faculty' => 'pass',
                'next_stage' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
