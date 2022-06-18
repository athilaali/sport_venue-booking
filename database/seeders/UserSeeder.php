<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 10;

        while ($count >= 0) {
            DB::table('users')->insert([
                'name' => Str::random(10),
                'email' => Str::random(10) . '@gmail.com',
                'phone' => $this->randomPhoneNum(),
                'password' => Hash::make('password'),
            ]);

            $count--;
        }
    }

    function randomNumberSequence($requiredLength = 7, $highestDigit = 8)
    {
        $sequence = '';
        for ($i = 0; $i < $requiredLength; ++$i) {
            $sequence .= mt_rand(0, $highestDigit);
        }
        return $sequence;
    }

    public function randomPhoneNum()
    {
        $numberPrefixes = ['0812', '0813', '0814', '0815', '0816', '0817', '0818', '0819', '0909', '0908'];
        return $numberPrefixes[array_rand($numberPrefixes)] . $this->randomNumberSequence();
    }
}
