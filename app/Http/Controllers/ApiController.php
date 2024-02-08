<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

// class ApiController extends Controller
// {
//     private $apiKey = 'dmQTolkKqPweR9bCGxHev6ARuSC7AkMq';

//     public function getWeather($city)
//     {
//         $response = Http::get("http://dataservice.accuweather.com/forecasts/v1/daily/5day/{$city}", [
//             'apikey' => $this->apiKey,
//         ]);

//         return $response->json();
//     }
// }
class ApiController extends Controller
{
    private $apiKey = 'dmQTolkKqPweR9bCGxHev6ARuSC7AkMq';

    private function getLocationKey($city)
    {
        $response = Http::get("http://dataservice.accuweather.com/locations/v1/cities/search", [
            'apikey' => $this->apiKey,
            'q' => $city
        ]);

        $data = $response->json();

        return $data[0]['Key'];
    }

    public function getWeather($city)
    {
        $locationKey = $this->getLocationKey($city);

        $response = Http::get("http://dataservice.accuweather.com/forecasts/v1/daily/5day/{$locationKey}", [
            'apikey' => $this->apiKey,
        ]);

        return $response->json();
    }
}