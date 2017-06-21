<?php

namespace App\Services\Geolocation;

use Exception;

class GeolocationServiceFactory
{

    public function getLocationService($name = '')
    {
        $name = $name ?: config('app.geolocation.default');

        switch ($name) {

            case 'ip-api' :
                return app()->make(IpApiService::class);
                break;

            case 'freegeoip' :
                return app()->make(FreeGeoIpService::class);
                break;

            default :
                throw new Exception('Unknown location service');
        }

    }

}