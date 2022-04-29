<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AbonnementTypes;

class AbonnementTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AbonnementTypes::Create([
            'abonnement' => 'Studento',
            'lenght' => '1',
            'price' => '25',
        ]);
        AbonnementTypes::Create([
            'abonnement' => 'Studento + Treneris',
            'coach' => 'Sigitas',
            'coach_specialization' => 'Fitnesas',
            'lenght' => '1',
            'price' => '40',
        ]);
        AbonnementTypes::Create([
            'abonnement' => 'Suaugusio',
            'lenght' => '1',
            'price' => '30',
        ]);
        AbonnementTypes::Create([
            'abonnement' => 'Saugusio + Treneris',
            'coach' => 'Donaldas',
            'coach_specialization' => 'TRX ir Fitnesas',
            'lenght' => '1',
            'price' => '45',
        ]);
    }
}
