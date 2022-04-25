<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Abonnements;

class AbonnementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Abonnements::create([
            'abonnement' => 'Studento',
            'lenght' => '1',
            'price' => '25',
        ]);
        Abonnements::create([
            'abonnement' => 'Studento + Treneris',
            'lenght' => '1',
            'price' => '40',
        ]);
        Abonnements::create([
            'abonnement' => 'Suaugusio',
            'lenght' => '1',
            'price' => '30',
        ]);
        Abonnements::create([
            'abonnement' => 'Suaugusio + Treneris',
            'lenght' => '1',
            'price' => '45',
        ]);
    }
}
