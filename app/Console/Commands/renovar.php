<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class renovar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    

    protected $signature = 'renovar:db';
   

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Vacía la base de datos y la llena con datos de SWAPI';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // vaciar la base de datos
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        // truncar todas las tablas
        DB::statement('SET FOREIGN_KEY_CHECKS=1');


        // llenar la BD con datos de SWAPI
        $this->cargarDatosDesdeSWAPI();
    }

    private function cargarDatosDesdeSWAPI(){
        // Aquí realizas las solicitudes HTTP a SWAPI y llenas tu base de datos
        // Puedes utilizar el paquete HTTP integrado de Laravel para hacer las solicitudes
        $response = Http::get('https://api.swapi.dev/api/starships');
        $starships = $response->json()['results'];
    }
}
