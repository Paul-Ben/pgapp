<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $faculties = [
            ['code' => 'AC', 'name' => 'ARCHITECTURE'],
            ['code' => 'AR', 'name' => 'ARTS'],
            ['code' => 'AT', 'name' => 'ADMINISTRATION AND TECHNICAL'],
            ['code' => 'BACS', 'name' => 'BASIC CLINICAL SCIENCES'],
            ['code' => 'BAMS', 'name' => 'BASIC MEDICAL SCIENCES'],
            ['code' => 'CCE', 'name' => 'CENTER FOR CONTINUING EDUCATION'],
            ['code' => 'CCSP', 'name' => 'CENTRE FOR CONSERVATION SCIENCE AND PRACTICE'],
            ['code' => 'CM', 'name' => 'COMMUNICATION AND MEDIA STUDIES'],
            ['code' => 'ED', 'name' => 'EDUCATION'],
            ['code' => 'ES', 'name' => 'ENVIRONMENTAL SCIENCE'],
            ['code' => 'GS', 'name' => 'CENTRE FOR GENDER STUDIES'],
            ['code' => 'HS', 'name' => 'HEALTH SCIENCE'],
            ['code' => 'LW', 'name' => 'LAW'],
            ['code' => 'MED', 'name' => 'MEDICINE AND SURGERY'],
            ['code' => 'MS', 'name' => 'ADMINISTRATION AND MANAGEMENT'],
            ['code' => 'PS', 'name' => 'PHARMACEUTICAL SCIENCE'],
            ['code' => 'SC', 'name' => 'SCIENCE'],
            ['code' => 'SS', 'name' => 'SOCIAL SCIENCES'],
            ['code' => 'TI', 'name' => 'TECHNOLOGY AND INDUSTRIAL STUDIES'],
        ];

        DB::table('faculties')->insert($faculties);
        
        
    }
}
