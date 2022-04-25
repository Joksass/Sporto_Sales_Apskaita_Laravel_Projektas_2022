<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Coaches;

class CoachesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coaches::create([
            'name_surname' => 'Sigitas G',
            'specialization' => 'Fitneso Treneris',
        ]);
        Coaches::create([
            'name_surname' => 'Donaldas D',
            'specialization' => 'TRX/Fitneso Treneris',
        ]);
    }
}
