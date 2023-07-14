<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Csv\Exception as CSVException;
use League\Csv\Reader;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        try {
            $csv = Reader::createFromPath(database_path('seeds/data.csv'), 'r');
            foreach ($csv as $row) {
                DB::table('locations')->insert([
                    'name' => $row[0],
                    'latitude' => $row[1],
                    'longitude' => $row[2]
                ]);
            }
        } catch (CSVException $e) {
            // Handle CSV related exceptions
            echo "Error reading CSV file: " . $e->getMessage();
        } catch (\Exception $e) {
            // Handle other exceptions
            echo "Error: " . $e->getMessage();
        }

    }
}
