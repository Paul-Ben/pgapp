<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProgrammesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Path to your CSV file
        $csvFile = base_path('database/data/programme.csv');
        
        // Read the CSV file
        $fileHandle = fopen($csvFile, 'r');
        
        // Skip the header row
        fgetcsv($fileHandle);
        
        // Prepare the data for insertion
        $data = [];
        while (($row = fgetcsv($fileHandle)) !== false) {
            $data[] = [
                'code' => $row[0],
                'd_code' => $row[1],
                'name' => $row[2],
                'min_score' => (int)$row[3],
                'archive' => (bool)$row[4],
                'f_code' => $row[5],
                'has_peo' => (bool)$row[6],
                'category' => $row[7],
                'created_at' => now(),
                'updated_at' => now(),
            ];
            
            // Insert in chunks of 100 for better performance
            if (count($data) >= 100) {
                DB::table('programmes')->insert($data);
                $data = [];
            }
        }
        
        // Insert any remaining records
        if (!empty($data)) {
            DB::table('programmes')->insert($data);
        }
        
        fclose($fileHandle);
    }
    
}
