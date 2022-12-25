<?php

namespace Database\Seeders;

use App\Models\Jelo;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JeloSeeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $brojac = 0;

        while ($brojac < 30){
            Jelo::create([
                'nazivJela' => $faker->sentence,
                'cena' => rand(500, 3000),
                'porekloId' => rand(1,3),
                'kategorijaId' => rand(1,4)
            ]);
            $brojac++;
        }
    }
}
