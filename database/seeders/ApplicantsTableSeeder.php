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
                'appno' => Str::random(10),
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
                'session' => '2025/2026',
                'refereers_needed' => true,
                'ref_completion_status' => false,
                'first_choice' => 'CS',
                'second_choice' => 'IT',
                'password' => 'pass',
                'next_stage' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'appno' => Str::random(10),
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
                'session' => '2025/2026',
                'refereers_needed' => true,
                'ref_completion_status' => false,
                'first_choice' => 'MBA',
                'second_choice' => 'Finance',
                'password' => 'pass',
                'next_stage' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
