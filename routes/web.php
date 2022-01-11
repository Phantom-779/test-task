<?php

use App\Http\Controllers\CurrenciesController;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

Route::get('GET/currencies', 'CurrenciesController@Get_currency');
Route::get('GET/currencies/{id}', 'CurrenciesController@Get_currency_byID');