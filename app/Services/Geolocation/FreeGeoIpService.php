<?php

namespace App\Services\Geolocation;

use Exception;

class FreeGeoIpService extends GeolocationService
{

    const SERVICE = 'freegeoip';

    public function locate($ip_address = '')
    {
        $response = $this->request($ip_address);

        return $this->buildResponse(
            $response['ip'],
            $response['city'],
            $response['region_name'],
            $response['country_name'],
            self::SERVICE
        );
    }

    public function getLatLong($ip_address = '')
    {
        $response = $this->request($ip_address);

        return [
            'ip' => $response['ip'],
            'city' => $response['city'],
            'lat' => $response['latitude'],
            'long' => $response['longitude']
        ];
    }

    private function request($ip_address = '')
    {
        $url = config('app.geolocation.freegeoip') . '/' . $ip_address;

        $response = $this->client->get($url);

        if ($response->getStatusCode() != 200) {
            throw new Exception('Something went wrong with freegeoip');
        }

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }
}