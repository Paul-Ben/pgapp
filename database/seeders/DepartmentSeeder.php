<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $departments = [
            ['id' => 1, 'code' => 'ACC', 'faculty_id' => 15, 'name' => 'ACCOUNTING'],
            ['id' => 2, 'code' => 'ADV', 'faculty_id' => 8, 'name' => 'ADVERTISING'],
            ['id' => 3, 'code' => 'ANP', 'faculty_id' => 5, 'name' => 'ANATOMIC PATHOLOGY'],
            ['id' => 4, 'code' => 'ANT', 'faculty_id' => 5, 'name' => 'ANATOMY'],
            ['id' => 5, 'code' => 'ARC', 'faculty_id' => 1, 'name' => 'ARCHITECTURE'],
            ['id' => 6, 'code' => 'ASS', 'faculty_id' => 9, 'name' => 'ARTS AND SOCIAL SCIENCE EDUCATION'],
            ['id' => 7, 'code' => 'ATC', 'faculty_id' => 19, 'name' => 'AGRICULTURAL TECHNOLOGY AND CONSUMER SCIENCES'],
            ['id' => 8, 'code' => 'BCH', 'faculty_id' => 17, 'name' => 'BIOCHEMISTRY'],
            ['id' => 9, 'code' => 'BIO', 'faculty_id' => 17, 'name' => 'BIOLOGICAL SCIENCES'],
            ['id' => 11, 'code' => 'BRC', 'faculty_id' => 8, 'name' => 'BROADCASTING'],
            ['id' => 12, 'code' => 'BSM', 'faculty_id' => 15, 'name' => 'BUSINESS ADMINISTRATION'],
            ['id' => 14, 'code' => 'BTE', 'faculty_id' => 19, 'name' => 'BUSINESS TECHNOLOGY AND ENTREPRENEURSHIP EDUC'],
            ['id' => 15, 'code' => 'CCE', 'faculty_id' => 6, 'name' => 'CENTRE FOR CONTINUING EDUCATION'],
            ['id' => 16, 'code' => 'CHM', 'faculty_id' => 17, 'name' => 'CHEMISTRY'],
            ['id' => 17, 'code' => 'CHP', 'faculty_id' => 5, 'name' => 'CHEMICAL PATHOLOGY'],
            ['id' => 18, 'code' => 'CMH', 'faculty_id' => 5, 'name' => 'COMMUNITY HEALTH'],
            ['id' => 19, 'code' => 'CML', 'faculty_id' => 13, 'name' => 'COMMERCIAL LAW'],
            ['id' => 20, 'code' => 'CSP', 'faculty_id' => 7, 'name' => 'CONSERVATION SCIENCE AND PRACTICE'],
            ['id' => 21, 'code' => 'CUR', 'faculty_id' => 9, 'name' => 'CURRICULUM AND TEACHING'],
            ['id' => 22, 'code' => 'DCM', 'faculty_id' => 8, 'name' => 'DEVELOPMENT COMMUNICATION'],
            ['id' => 23, 'code' => 'ECH', 'faculty_id' => 5, 'name' => 'EPIDEMIOLOGY AND COMMUNITY HEALTH'],
            ['id' => 24, 'code' => 'ECO', 'faculty_id' => 18, 'name' => 'ECONOMICS'],
            ['id' => 25, 'code' => 'EDF', 'faculty_id' => 9, 'name' => 'EDUCATIONAL FOUNDATIONS'],
            ['id' => 26, 'code' => 'ENG', 'faculty_id' => 2, 'name' => 'ENGLISH LANGUAGE AND LITERATURE'],
            ['id' => 27, 'code' => 'GDS', 'faculty_id' => 11, 'name' => 'GENDER STUDIES'],
            ['id' => 28, 'code' => 'GEO', 'faculty_id' => 10, 'name' => 'GEOGRAPHY'],
            ['id' => 29, 'code' => 'HKH', 'faculty_id' => 9, 'name' => 'HUMAN KINETICS & HEALTH EDUCATION'],
            ['id' => 30, 'code' => 'HMT', 'faculty_id' => 5, 'name' => 'HAEMATHOLOGY'],
            ['id' => 31, 'code' => 'HST', 'faculty_id' => 2, 'name' => 'HISTORY'],
            ['id' => 33, 'code' => 'ILJ', 'faculty_id' => 13, 'name' => 'INTERNATIONAL LAW & JURISPRUDENCE'],
            ['id' => 34, 'code' => 'IND', 'faculty_id' => 19, 'name' => 'INDUSTRIAL TECHNOLOGY'],
            ['id' => 35, 'code' => 'JMS', 'faculty_id' => 8, 'name' => 'JOURNALISM AND MEDIA STUDIES'],
            ['id' => 36, 'code' => 'LAN', 'faculty_id' => 2, 'name' => 'LANGUAGES AND LINGUISTICS'],
            ['id' => 37, 'code' => 'LAW', 'faculty_id' => 13, 'name' => 'LAW'],
            ['id' => 39, 'code' => 'LIS', 'faculty_id' => 18, 'name' => 'LIBRARY AND INFORMATION SCIENCE'],
            ['id' => 40, 'code' => 'MBC', 'faculty_id' => 5, 'name' => 'MEDICAL BIOCHEMISTRY'],
            ['id' => 41, 'code' => 'MCM', 'faculty_id' => 8, 'name' => 'MASS COMMUNICATION'],
            ['id' => 42, 'code' => 'MED', 'faculty_id' => 5, 'name' => 'MEDICINE'],
            ['id' => 43, 'code' => 'MLS', 'faculty_id' => 5, 'name' => 'MEDICAL LABORATORY SCIENCE'],
            ['id' => 44, 'code' => 'MMB', 'faculty_id' => 5, 'name' => 'MEDICAL MICROBIOLOGY'],
            ['id' => 45, 'code' => 'MTC', 'faculty_id' => 17, 'name' => 'MATHEMATICS AND COMPUTER SCIENCE'],
            ['id' => 46, 'code' => 'NUR', 'faculty_id' => 5, 'name' => 'NURSING SCIENCE'],
            ['id' => 47, 'code' => 'OBG', 'faculty_id' => 5, 'name' => 'DEPARTMENT OF OBSTETRICS AND GYNAECOLOGY'],
            ['id' => 49, 'code' => 'PCT', 'faculty_id' => 5, 'name' => 'PHARMACOLOGY AND THERAPEUTICS'],
            ['id' => 50, 'code' => 'PGY', 'faculty_id' => 5, 'name' => 'PHYSIOLOGY'],
            ['id' => 51, 'code' => 'PHL', 'faculty_id' => 2, 'name' => 'PHILOSOPHY'],
            ['id' => 52, 'code' => 'PHM', 'faculty_id' => 16, 'name' => 'PHARMACY'],
            ['id' => 53, 'code' => 'PHY', 'faculty_id' => 17, 'name' => 'PHYSICS'],
            ['id' => 54, 'code' => 'POL', 'faculty_id' => 18, 'name' => 'POLITICAL SCIENCE'],
            ['id' => 55, 'code' => 'PSF', 'faculty_id' => 6, 'name' => 'PEACE, SECURITY AND FORENSIC STUDIES'],
            ['id' => 56, 'code' => 'PSY', 'faculty_id' => 18, 'name' => 'PSYCHOLOGY'],
            ['id' => 57, 'code' => 'PUB', 'faculty_id' => 15, 'name' => 'PUBLIC ADMINISTRATION'],
            ['id' => 58, 'code' => 'PUL', 'faculty_id' => 13, 'name' => 'PUBLIC LAW'],
            ['id' => 59, 'code' => 'PUR', 'faculty_id' => 8, 'name' => 'PUBLIC RELATIONS'],
            ['id' => 60, 'code' => 'PVL', 'faculty_id' => 13, 'name' => 'PRIVATE LAW'],
            ['id' => 61, 'code' => 'RAC', 'faculty_id' => 2, 'name' => 'RELIGIOUS AND CULTURAL STUDIES'],
            ['id' => 62, 'code' => 'RAD', 'faculty_id' => 5, 'name' => 'RADIOLOGY AND RADIATION SCIENCE'],
            ['id' => 63, 'code' => 'RAP', 'faculty_id' => 2, 'name' => 'PHILOSOPHY'],
            ['id' => 66, 'code' => 'REM', 'faculty_id' => 17, 'name' => 'PRELIMINARY SCIENCE'],
            ['id' => 68, 'code' => 'SCM', 'faculty_id' => 8, 'name' => 'STRATEGIC COMMUNICATION'],
            ['id' => 69, 'code' => 'SME', 'faculty_id' => 9, 'name' => 'SCIENCE AND MATHEMATICS EDUCATION'],
            ['id' => 70, 'code' => 'SOC', 'faculty_id' => 18, 'name' => 'SOCIOLOGY'],
            ['id' => 72, 'code' => 'THE', 'faculty_id' => 2, 'name' => 'THEATRE ARTS'],
            ['id' => 73, 'code' => 'URP', 'faculty_id' => 10, 'name' => 'URBAN AND REGIONAL PLANNING'],
            ['id' => 74, 'code' => 'VOC', 'faculty_id' => 9, 'name' => 'VOCATIONAL AND TECHNICAL'],
        ];

        foreach ($departments as $department) {
            DB::table('departments')->insert([
                'id' => $department['id'],
                'code' => $department['code'],
                'faculty_id' => $department['faculty_id'],
                'name' => $department['name'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

    }
}
