<?php

use Illuminate\Database\Seeder;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rooms')->insert([
            'name' => 'A204',
            'capacity' => 24,
            'building_id' => 1,
        ]);

        DB::table('rooms')->insert([
            'name' => 'A224',
            'capacity' => 30,
            'building_id' => 1,
        ]);

        DB::table('rooms')->insert([
            'name' => 'B050',
            'capacity' => 16,
            'building_id' => 1,
        ]);

        DB::table('rooms')->insert([
            'name' => 'C221',
            'capacity' => 30,
            'building_id' => 1,
        ]);

        DB::table('rooms')->insert([
            'name' => 'C231',
            'capacity' => 30,
            'building_id' => 1,
        ]);

        DB::table('rooms')->insert([
            'name' => 'H006',
            'capacity' => 35,
            'building_id' => 2,
        ]);        
    }
}
