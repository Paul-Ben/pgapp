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
            ['id' => 1, 'code' => 'AC', 'name' => 'ARCHITECTURE'],
            ['id' => 2, 'code' => 'AR', 'name' => 'ARTS'],
            ['id' => 3, 'code' => 'AT', 'name' => 'ADMINISTRATION AND TECHNICAL'],
            ['id' => 4, 'code' => 'BACS', 'name' => 'BASIC CLINICAL SCIENCES'],
            ['id' => 5, 'code' => 'BAMS', 'name' => 'BASIC MEDICAL SCIENCES'],
            ['id' => 6, 'code' => 'CCE', 'name' => 'CENTER FOR CONTINUING EDUCATION'],
            ['id' => 7, 'code' => 'CCSP', 'name' => 'CENTRE FOR CONSERVATION SCIENCE AND PRACTICE'],
            ['id' => 8, 'code' => 'CM', 'name' => 'COMMUNICATION AND MEDIA STUDIES'],
            ['id' => 9, 'code' => 'ED', 'name' => 'EDUCATION'],
            ['id' => 10, 'code' => 'ES', 'name' => 'ENVIRONMENTAL SCIENCE'],
            ['id' => 11, 'code' => 'GS', 'name' => 'CENTRE FOR GENDER STUDIES'],
            ['id' => 12, 'code' => 'HS', 'name' => 'HEALTH SCIENCE'],
            ['id' => 13, 'code' => 'LW', 'name' => 'LAW'],
            ['id' => 14, 'code' => 'MED', 'name' => 'MEDICINE AND SURGERY'],
            ['id' => 15, 'code' => 'MS', 'name' => 'ADMINISTRATION AND MANAGEMENT'],
            ['id' => 16, 'code' => 'PS', 'name' => 'PHARMACEUTICAL SCIENCE'],
            ['id' => 17, 'code' => 'SC', 'name' => 'SCIENCE'],
            ['id' => 18, 'code' => 'SS', 'name' => 'SOCIAL SCIENCES'],
            ['id' => 19, 'code' => 'TI', 'name' => 'TECHNOLOGY AND INDUSTRIAL STUDIES'],
        ];

        foreach ($faculties as $faculty) {
            DB::table('faculties')->insert([
                'id' => $faculty['id'],
                'code' => $faculty['code'],
                'name' => $faculty['name'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
        
    }
}
