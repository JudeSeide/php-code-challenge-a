<?php

namespace App\Services\Geolocation;

use Exception;

class IpApiService extends GeolocationService
{

    const SERVICE = 'ip-api';

    public function locate($ip_address = '')
    {
        $response = $this->request($ip_address);

        return $this->buildResponse(
            $response['query'],
            $response['city'],
            $response['regionName'],
            $response['country'],
            self::SERVICE
        );
    }

    public function getLatLong($ip_address = '')
    {
        $response = $this->request($ip_address);

        return [
            'ip' => $response['query'],
            'city' => $response['city'],
            'lat' => $response['lat'],
            'long' => $response['lon']
        ];
    }

    private function request($ip_address = '')
    {
        $url = config('app.geolocation.ip-api') . '/' . $ip_address;

        $response = $this->client->get($url);

        if ($response->getStatusCode() != 200) {
            throw new Exception('Something went wrong with ip-api');
        }

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

}