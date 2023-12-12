<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Starship;

class StarshipsSeeder extends Seeder
{

    public function run(): void
    {
        Starship::create(['name' => 'CR90 corvette']);
        Starship::create(['name' => 'Star Destroyer']);
        Starship::create(['name' => 'Sentinel-class landing craft']);
        Starship::create(['name' => 'Death Star']);
        Starship::create(['name' => 'Millennium Falcon']);
        Starship::create(['name' => 'Y-wing']);
        Starship::create(['name' => 'X-wing']);
        Starship::create(['name' => 'TIE Advanced x1']);
        Starship::create(['name' => 'Executor']);
        Starship::create(['name' => 'Rebel transport']);
    }
}
