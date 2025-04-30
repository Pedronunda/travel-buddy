<?php
namespace App\Services;
use Illuminate\Support\Facades\Http;
class OpenWeatherService
{
    protected $apiKey;
    public function __construct()
    {
        $this->apiKey = config('services.openweather.key');
    }
    public function getWeather($lat, $lon)
    {
        $response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
            'lat' => $lat,
            'lon' => $lon,
            'appid' => $this->apiKey,
            'units' => 'metric',
        ]);
        return $response->json();
    }
}