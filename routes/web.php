<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->get('geolocation[/{ip_address}]',
    [
        'as' => 'geolocation',
        'uses' => 'GeoLocationController@locate'
    ]
);

//$app->group(['middleware' => 'geolocation'], function () use ($app) {

    $app->get('weather[/{ip_address}]',
        [
            'as' => 'weather',
            'uses' => 'WeatherController@getForecast'
        ]
    );

//});
