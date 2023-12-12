<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Piloto;

class PilotosSeeder extends Seeder
{
    
    public function run(): void
    {
        Piloto::create(['name' => 'Luke Skywalker']);
        Piloto::create(['name' => 'C-3PO']);
        Piloto::create(['name' => 'R2-D2']);
        Piloto::create(['name' => 'Darth Vader']);
        Piloto::create(['name' => 'Leia Organa']);
        Piloto::create(['name' => 'Owen Lars']);
        Piloto::create(['name' => 'Beru Whitesun lars']);
        Piloto::create(['name' => 'R5-D4']);
        Piloto::create(['name' => 'Biggs Darklighter']);
        Piloto::create(['name' => 'Obi-Wan Kenobi']);

    }
}
