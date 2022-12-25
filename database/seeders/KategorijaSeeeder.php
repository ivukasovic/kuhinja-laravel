<?php

namespace Database\Seeders;

use App\Models\Kategorija;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategorijaSeeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kategorija::create([
            'kategorijaNaziv' => 'Dorucak'
        ]);

        Kategorija::create([
            'kategorijaNaziv' => 'Rucak'
        ]);

        Kategorija::create([
            'kategorijaNaziv' => 'Vecera'
        ]);

        Kategorija::create([
            'kategorijaNaziv' => 'Dezert'
        ]);


    }
}
