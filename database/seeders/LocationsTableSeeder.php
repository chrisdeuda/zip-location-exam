<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use League\Csv\Exception as CSVException;
use League\Csv\Reader;

class LocationsTableSeeder extends Seeder
{


    private function getCsvFilePath(): string
    {
        return database_path('seeds/data.csv');
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $imported = 0;
        $failed = 0;

        try {
            $csv = Reader::createFromPath($this->getCsvFilePath(), 'r');

            DB::transaction(function () use ($csv, &$imported, &$failed) {
                foreach ($csv as $row) {
                    try {
                        DB::table('locations')->insert([
                            'name' => $row[0],
                            'latitude' => $row[1],
                            'longitude' => $row[2]
                        ]);
                        $imported++;
                    } catch (\Exception $e) {
                        Log::error('Failed to import row: ' . implode(', ', $row));
                        $failed++;
                    }
                }
            });

            echo "Imported: " . $imported . " records\n";
            echo "Failed: " . $failed . " records\n";
        } catch (CSVException $e) {
            echo "Error reading CSV file: " . $e->getMessage();
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
        }

    }
}
