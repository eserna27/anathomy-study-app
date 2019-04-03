<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', "StudentController@main")
  ->name('students.main');

Route::resource('regions', 'RegionController', [
    'only' => ['index', 'show']
]);

Route::resource('systems', 'SystemController', [
    'only' => ['index', 'show']
]);

Route::get('/home', 'HomeController@index')->name('home');

Route::namespace('Admin')
  ->prefix('admin')
  ->name('admin.')
  ->group(function () {
    Route::get('/login', 'LoginController@login')->name('login');
    Route::post('/login', 'LoginController@log')->name('log');
    Route::get('/', 'HomeController@home')->name('home');
    Route::resource('regions', 'RegionsController', [
        'only' => ['index', 'show', 'store', 'destroy', 'edit', 'update']
    ]);
    Route::resource('systems', 'SystemsController', [
        'only' => ['index', 'show', 'store', 'destroy', 'edit', 'update']
    ]);
    Route::resource('systems.regions', 'SystemRegionController', [
      'only' => ['show']
    ]);
    Route::resource('systems.regions.elements', 'ElementsController', [
      'only' => ['show']
    ]);
    Route::resource('systems.elements', 'ElementsController', [
      'only' => ['store', 'create', 'show', 'destroy', 'edit', 'update']
    ]);
    Route::resource('elements.regions', 'ElementsRegionsController', [
      'only' => ['store', 'destroy']
    ]);
    Route::resource('elements.definitions', 'ElementsDefinitionsController', [
      'only' => ['create', 'store', 'index', 'edit', 'update']
    ]);
});
