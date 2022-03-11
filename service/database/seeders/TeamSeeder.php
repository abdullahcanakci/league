<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teamsFile = database_path('/seeders/teams.csv');

        try {
            $fileHandle = fopen($teamsFile, 'r');

            $columns =  fgetcsv($fileHandle);

            $columnMapper = fn ($row, $name) => $row[array_search($name, $columns)];

            while (($row = fgetcsv($fileHandle)) !== false) {
                Team::create([
                    'name' => $columnMapper($row, 'name')
                ]);
            }
        } catch (\Throwable $th) {
            throw $th;
        } finally {
            fclose($fileHandle);
        }
    }
}
