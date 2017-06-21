<?php

namespace App\Http\Controllers;

use App\Services\Geolocation\GeolocationServiceFactory;
use Illuminate\Http\Request;

class GeoLocationController extends Controller
{

    /**
     * @var GeolocationServiceFactory
     */
    private $location_service_factory;

    public function __construct()
    {
        $this->location_service_factory = app()->make(GeolocationServiceFactory::class);
    }

    public function locate(Request $request, $ip_address = '')
    {
        $location_service = $this->location_service_factory->getLocationService($request->get('service'));

        return $location_service->locate($ip_address);
    }
}
