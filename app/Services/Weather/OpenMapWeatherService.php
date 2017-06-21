<?php

namespace App\Services\Weather;

use Exception;
use GuzzleHttp\Client;

class OpenMapWeatherService
{

    const ZERO_KELVIN = -273.15;

    /**
     * @var Client
     */
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function forecast(array $data)
    {

        $response = $this->request($data['lat'], $data['long']);

        return [

            'ip' => $data['ip'],
            'city' => $data['city'],

            'temperature' => [

                'current' => $response['main']['temp'] + self::ZERO_KELVIN,

                'low' => $response['main']['temp_min'] + self::ZERO_KELVIN,

                'high' => $response['main']['temp_max'] + self::ZERO_KELVIN,

            ],

            'wind' => [

                'speed' => $response['wind']['speed'],

                'direction' => $response['wind']['deg']

            ]

        ];

    }

    private function request($lat, $lon)
    {
        $url = config('app.weather.url') . "?lat=$lat&lon=$lon&appid=" . config('app.weather.api_key');

        $response = $this->client->get($url);

        if ($response->getStatusCode() != 200) {
            throw new Exception('Something went wrong with open map weather');
        }

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

}