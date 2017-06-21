<?php

namespace App\Http\Controllers;

use App\Services\Geolocation\GeolocationServiceFactory;
use App\Services\Weather\OpenMapWeatherService;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    /**
     * @var GeolocationServiceFactory
     */
    private $location_service_factory;

    /**
     * @var OpenMapWeatherService
     */
    private $weather_service;

    public function __construct()
    {
        $this->location_service_factory = app()->make(GeolocationServiceFactory::class);
        $this->weather_service = app()->make(OpenMapWeatherService::class);
    }

    public function getForecast(Request $request, $ip_address = null)
    {
        $location_service = $this->location_service_factory->getLocationService($request->get('service'));

        $data = $location_service->getLatLong($ip_address);

        return $this->weather_service->forecast($data);
    }
}
