<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request; 
use App\Http\Controllers\RelacionController;
use App\Models\Piloto;
use App\Models\Starship;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/swapi/pilotos', function () {
    $response = Http::get('https://swapi.dev/api/people/');
    $pilotos = $response->json()['results'];

    // Agregar un identificador único
    $pilotos = array_map(function ($piloto, $index) {
        $piloto['id'] = $index + 1;
        return $piloto;
    }, $pilotos, array_keys($pilotos));

    return response()->json($pilotos);
});

Route::get('/swapi/starships', function () {
    $response = Http::get('https://swapi.dev/api/starships/');
    $starships = $response->json()['results'];

    // Agregar un identificador único
    $starships = array_map(function ($starship, $index) {
        $starship['id'] = $index + 1;
        return $starship;
    }, $starships, array_keys($starships));

    return response()->json($starships);
});


Route::match(['get', 'post'], '/relacion', function (Request $request ) {

    $pilotoId = $request->input('pilotoId');
    $starshipId = $request->input('starshipId');
    $pilotoName = $request->input('pilotoName');
    $starshipName = $request->input('starshipName');
    
    $piloto = Piloto::find($pilotoId);
    $starship = Starship::find($starshipId);

    // Validar que los IDs existan
    if (!$piloto || !$starship) {
        return response()->json(['error' => 'Piloto o Starship no encontrados'], 404);
    }

    // Crear la relación en la base de datos
    $piloto->starships()->attach($starshipId, [
        'piloto_name' => $pilotoName,
        'starship_name' => $starshipName,
    ]);

    return response()->json(['message' => 'Relación añadida con éxito']);
});

Route::get('/relaciones', [RelacionController::class, 'index']);

// Route::post('/eliminar-relacion', function (Request $request) {
//     $pilotoId = $request->input('pilotoId');
//     $starshipId = $request->input('starshipId');

//     // Buscar la relación en la base de datos
//     $relacion = Piloto::find($pilotoId)->starships()->where('starship_id', $starshipId)->first();

//     // Validar que la relación exista
//     if (!$relacion) {
//         return response()->json(['error' => 'Relación no encontrada'], 404);
//     }

//     // Eliminar la relación
//     $relacion->delete();

//     return response()->json(['message' => 'Relación eliminada con éxito']);
// });

Route::post('/eliminar-relacion', function (Request $request) {
    $pilotoId = $request->input('pilotoId');
    $starshipId = $request->input('starshipId');
    $piloto = Piloto::find($pilotoId);

    if (!$piloto) return response()->json(['error' => 'Piloto o Starship no encontrados'], 404);


    $piloto->starships()->detach($starshipId);

    return response()->json(['message' => 'Relación eliminada con éxito']);
});
