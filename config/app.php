<?php

return [


    'geolocation' => [

        'default' => 'freegeoip',

        'ip-api' => env('IP_API', 'http://ip-api.com/json'),

        'freegeoip' => env('FREE_GEO_IP', 'http://freegeoip.net/json')

    ],


    'weather' => [

        'url' => env('WEATHER_URL', 'http://api.openweathermap.org/data/2.5/weather'),

        'api_key' => env('WEATHER_API_KEY', '6103b0f582e78c7382bc6b0cdc06deb8')

    ]


];