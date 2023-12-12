<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelacionController 
{
    public function index()
    {
        // Obtener todas las relaciones de la tabla starship_piloto
        $relaciones = DB::table('piloto_starship')->get();

        // Devolver las relaciones en formato JSON
        return response()->json($relaciones);
    }
}
