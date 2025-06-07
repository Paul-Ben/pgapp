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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $departments = [
            ['code' => 'ACC', 'f_code' => 'MS', 'name' => 'ACCOUNTING'],
            ['code' => 'ADV', 'f_code' => 'CM', 'name' => 'ADVERTISING'],
            ['code' => 'ANP', 'f_code' => 'BAMS', 'name' => 'ANATOMIC PATHOLOGY'],
            ['code' => 'ANT', 'f_code' => 'BAMS', 'name' => 'ANATOMY'],
            ['code' => 'ARC', 'f_code' => 'AC', 'name' => 'ARCHITECTURE'],
            ['code' => 'ASS', 'f_code' => 'ED', 'name' => 'ARTS AND SOCIAL SCIENCE EDUCATION'],
            ['code' => 'ATC', 'f_code' => 'TI', 'name' => 'AGRICULTURAL TECHNOLOGY AND CONSUMER SCIENCES'],
            ['code' => 'BCH', 'f_code' => 'SC', 'name' => 'BIOCHEMISTRY'],
            ['code' => 'BIO', 'f_code' => 'SC', 'name' => 'BIOLOGICAL SCIENCES'],
            ['code' => 'BKS', 'f_code' => 'AT', 'name' => 'BOOKSHOP'],
            ['code' => 'BRC', 'f_code' => 'CM', 'name' => 'BROADCASTING'],
            ['code' => 'BSM', 'f_code' => 'MS', 'name' => 'BUSINESS ADMINISTRATION'],
            ['code' => 'BSR', 'f_code' => 'AT', 'name' => 'BURSARY'],
            ['code' => 'BTE', 'f_code' => 'TI', 'name' => 'BUSINESS TECHNOLOGY AND ENTREPRENEURSHIP EDUC'],
            ['code' => 'CCE', 'f_code' => 'AT', 'name' => 'CENTRE FOR CONTINUING EDUCATION'],
            ['code' => 'CHM', 'f_code' => 'SC', 'name' => 'CHEMISTRY'],
            ['code' => 'CHP', 'f_code' => 'BAMS', 'name' => 'CHEMICAL PATHOLOGY'],
            ['code' => 'CMH', 'f_code' => 'SSxx', 'name' => 'COMMUNITY HEALTH'],
            ['code' => 'CML', 'f_code' => 'LW', 'name' => 'COMMERCIAL LAW'],
            ['code' => 'CSP', 'f_code' => 'CCSP', 'name' => 'CONSERVATION SCIENCE AND PRACTICE'],
            ['code' => 'CUR', 'f_code' => 'ED', 'name' => 'CURRICULUM AND TEACHING'],
            ['code' => 'DCM', 'f_code' => 'CM', 'name' => 'DEVELOPMENT COMMUNICATION'],
            ['code' => 'ECH', 'f_code' => 'BAMS', 'name' => 'EPIDEMIOLOGY AND COMMUNITY HEALTH'],
            ['code' => 'ECO', 'f_code' => 'SS', 'name' => 'ECONOMICS'],
            ['code' => 'EDF', 'f_code' => 'ED', 'name' => 'EDUCATIONAL FOUNDATIONS'],
            ['code' => 'ENG', 'f_code' => 'AR', 'name' => 'ENGLISH LANGUAGE AND LITERATURE'],
            ['code' => 'GDS', 'f_code' => 'GS', 'name' => 'GENDER STUDIES'],
            ['code' => 'GEO', 'f_code' => 'ES', 'name' => 'GEOGRAPHY'],
            ['code' => 'HKH', 'f_code' => 'ED', 'name' => 'HUMAN KINETICS & HEALTH EDUCATION'],
            ['code' => 'HMT', 'f_code' => 'BAMS', 'name' => 'HAEMATHOLOGY'],
            ['code' => 'HST', 'f_code' => 'AR', 'name' => 'HISTORY'],
            ['code' => 'ICT', 'f_code' => 'AT', 'name' => 'DIRECTORATE OF ICT'],
            ['code' => 'ILJ', 'f_code' => 'LW', 'name' => 'INTERNATIONAL LAW & JURISPRUDENCE'],
            ['code' => 'IND', 'f_code' => 'TI', 'name' => 'INDUSTRIAL TECHNOLOGY'],
            ['code' => 'JMS', 'f_code' => 'CM', 'name' => 'JOURNALISM AND MEDIA STUDIES'],
            ['code' => 'LAN', 'f_code' => 'AR', 'name' => 'LANGUAGES AND LINGUISTICS'],
            ['code' => 'LAW', 'f_code' => 'LW', 'name' => 'LAW'],
            ['code' => 'LBY', 'f_code' => 'AT', 'name' => 'LIBRARY'],
            ['code' => 'LIS', 'f_code' => 'SS', 'name' => 'LIBRARY AND INFORMATION SCIENCE'],
            ['code' => 'MBC', 'f_code' => 'BAMS', 'name' => 'MEDICAL BIOCHEMISTRY'],
            ['code' => 'MCM', 'f_code' => 'CM', 'name' => 'MASS COMMUNICATION'],
            ['code' => 'MED', 'f_code' => 'BAMS', 'name' => 'MEDICINE'],
            ['code' => 'MLS', 'f_code' => 'BAMS', 'name' => 'MEDICAL LABORATORY SCIENCE'],
            ['code' => 'MMB', 'f_code' => 'BAMS', 'name' => 'MEDICAL MICROBIOLOGY'],
            ['code' => 'MTC', 'f_code' => 'SC', 'name' => 'MATHEMATICS AND COMPUTER SCIENCE'],
            ['code' => 'NUR', 'f_code' => 'BAMS', 'name' => 'NURSING SCIENCE'],
            ['code' => 'OBG', 'f_code' => 'BAMS', 'name' => 'DEPARTMENT OF OBSTETRICS AND GYNAECOLOGY'],
            ['code' => 'OVC', 'f_code' => 'AT', 'name' => 'OFFICE OF THE VC'],
            ['code' => 'PCT', 'f_code' => 'BAMS', 'name' => 'PHARMACOLOGY AND THERAPEUTICS'],
            ['code' => 'PGY', 'f_code' => 'BAMS', 'name' => 'PHYSIOLOGY'],
            ['code' => 'PHL', 'f_code' => 'AR', 'name' => 'PHILOSOPHY'],
            ['code' => 'PHM', 'f_code' => 'PS', 'name' => 'PHARMACY'],
            ['code' => 'PHY', 'f_code' => 'SC', 'name' => 'PHYSICS'],
            ['code' => 'POL', 'f_code' => 'SS', 'name' => 'POLITICAL SCIENCE'],
            ['code' => 'PSF', 'f_code' => 'CCE', 'name' => 'PEACE, SECURITY AND FORENSIC STUDIES'],
            ['code' => 'PSY', 'f_code' => 'SS', 'name' => 'PSYCHOLOGY'],
            ['code' => 'PUB', 'f_code' => 'MS', 'name' => 'PUBLIC ADMINISTRATION'],
            ['code' => 'PUL', 'f_code' => 'LW', 'name' => 'PUBLIC LAW'],
            ['code' => 'PUR', 'f_code' => 'CM', 'name' => 'PUBLIC RELATIONS'],
            ['code' => 'PVL', 'f_code' => 'LW', 'name' => 'PRIVATE LAW'],
            ['code' => 'RAC', 'f_code' => 'AR', 'name' => 'RELIGIOUS AND CULTURAL STUDIES'],
            ['code' => 'RAD', 'f_code' => 'BAMS', 'name' => 'RADIOLOGY AND RADIATION SCIENCE'],
            ['code' => 'RAP', 'f_code' => 'AR', 'name' => 'PHILOSOPHY'],
            ['code' => 'REF', 'f_code' => 'REM', 'name' => 'PRILIMINARY FRENCH'],
            ['code' => 'REG', 'f_code' => 'AT', 'name' => 'REGISTRY'],
            ['code' => 'REM', 'f_code' => 'SC', 'name' => 'PRELIMINARY SCIENCE'],
            ['code' => 'REV', 'f_code' => 'REM', 'name' => 'PRILIMINARY VOC AND TECH'],
            ['code' => 'SCM', 'f_code' => 'CM', 'name' => 'STRATEGIC COMMUNICATION'],
            ['code' => 'SME', 'f_code' => 'ED', 'name' => 'SCIENCE AND MATHEMATICS EDUCATION'],
            ['code' => 'SOC', 'f_code' => 'SS', 'name' => 'SOCIOLOGY'],
            ['code' => 'STS', 'f_code' => 'AT', 'name' => 'BSU STAFF SCHOOL'],
            ['code' => 'THE', 'f_code' => 'AR', 'name' => 'THEATRE ARTS'],
            ['code' => 'URP', 'f_code' => 'ES', 'name' => 'URBAN AND REGIONAL PLANNING'],
            ['code' => 'VOC', 'f_code' => 'ED', 'name' => 'VOCATIONAL AND TECHNICAL'],
        ];
        DB::transaction(function () use ($departments) {
            DB::table('departments')->insert($departments);
        });

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
