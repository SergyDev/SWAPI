<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class StarshipController extends Controller
{
    public function getStarships()
    {
        $client = new Client();
        $response = $client->get('https://swapi.dev/api/starships');
        $starshipsData = json_decode($response->getBody(), true);

        $starships = $starshipsData['results'];

        foreach ($starships as $starship) {
            $pilotNames = [];
            foreach ($starship['pilots'] as $pilotUrl) {
                $pilotResponse = $client->get($pilotUrl);
                $pilotData = json_decode($pilotResponse->getBody(), true);
                $pilotNames[] = $pilotData['name'];
            }
            $starship['pilotNames'] = $pilotNames;
        }

        return response()->json(['starships' => $starships]);
    }
}


