<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\JsonResponse;

class DocumentationController extends Controller
{
    public function index(): JsonResponse
    {
        $routes = collect(Route::getRoutes())->map(function ($route) {
            return [
                'method' => implode('|', $route->methods()),
                'uri' => $route->uri(),
                'name' => $route->getName(),
                'action' => $route->getActionName(),
            ];
        });

        return response()->json(['endpoints' => $routes]);
    }
}

