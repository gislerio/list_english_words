<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

Route::get('/api/docs', function () {
    $routes = collect(Route::getRoutes())->map(function ($route) {
        return [
            'method' => implode('|', $route->methods()),
            'uri' => $route->uri(),
            'name' => $route->getName(),
        ];
    });

    return View::make('api_docs', ['routes' => $routes]);
});
