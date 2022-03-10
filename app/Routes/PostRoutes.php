<?php

namespace App\Routes;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use Uutkukorkmaz\RouteOrganizer\RegistersRouteGroup;

class PostRoutes implements RegistersRouteGroup {

    public static function register() {
        Route::group(["prefix" => "posts", "as" => "posts.", "controller" => PostController::class], function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('{post}/edit', 'edit')->name('edit');
        });
    }

}
