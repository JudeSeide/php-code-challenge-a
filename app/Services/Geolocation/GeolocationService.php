<?php

namespace App\Services\Geolocation;

use GuzzleHttp\Client;

abstract class GeolocationService
{
    /**
     * @var Client
     */
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public abstract function locate($ip_address = '');

    public abstract function getLatLong($ip_address = '');

    protected function buildResponse($ip, $city, $region, $country, $service)
    {
        return [

            'ip' => $ip,

            'geo' => compact('service', 'city', 'region', 'country')
        ];
    }

}