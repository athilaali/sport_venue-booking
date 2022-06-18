<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VenueSeeder extends Seeder
{

    protected $SPORTS_TYPES = [
        'Cricket',
        'Football',
        'Badminton',
        'Hockey',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $max_index = count($this->SPORTS_TYPES) - 1;
        $count = 100;

        while ($count >= 0) {
            $random_index = rand(0, $max_index);

            DB::table('venues')->insert([
                'name' => Str::random(10),
                'type' => $this->SPORTS_TYPES[$random_index],
            ]);
            $count--;
        }
    }
}
