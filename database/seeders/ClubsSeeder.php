<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Clubs;

class ClubsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Clubs::create([ 'club' => 'Vilniaus g. 1',]);
        Clubs::create([ 'club' => 'Trakų g. 1',]);
    }
}
