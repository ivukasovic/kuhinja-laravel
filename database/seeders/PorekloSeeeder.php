<?php

namespace Database\Seeders;

use App\Models\Poreklo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PorekloSeeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Poreklo::create([
            'zemljaPorekla' => 'Kina'
        ]);

        Poreklo::create([
            'zemljaPorekla' => 'Grcka'
        ]);

        Poreklo::create([
            'zemljaPorekla' => 'Italija'
        ]);
    }
}
