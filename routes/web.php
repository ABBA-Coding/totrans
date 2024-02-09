<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

// Artisan group
Route::prefix('artisan')
    ->group(function () {

        //---------------------config---------------------//
        Route::get('/config/cache', 'ArtisanController@configCache');
        Route::get('/config/clear', 'ArtisanController@configClear');

        //---------------------route---------------------//
        Route::get('/route/cache', 'ArtisanController@routeCache');
        Route::get('/route/clear', 'ArtisanController@routeClear');

        //---------------------cache---------------------//
        Route::get('/cache/clear', 'ArtisanController@cacheClear');

        //---------------------view---------------------//
        Route::get('/view/cache', 'ArtisanController@viewCache');
        Route::get('/view/clear', 'ArtisanController@viewClear');

        //---------------------optimize---------------------//
        Route::get('/optimize', 'ArtisanController@optimize');
        Route::get('/optimize/clear', 'ArtisanController@optimizeClear');

        //---------------------storage-link---------------------//
        Route::get('/storage/link', 'ArtisanController@storageLink');
    });


// Frontend group
Route::namespace('Frontend')
    ->group(function () {
         Route::group([
            'prefix' => LaravelLocalization::setLocale(),
            'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
        ], function () {
            Route::get('/calculator', 'IndexController@calculator')->name('calculator');

             Route::group([
                 'middleware' => 'guest',
             ], function () {
                 Route::get('/login', 'ProfileController@login')->name('profile.login');
                 Route::post('/login', 'ProfileController@loginPost')->name('profile.login.post');

                 Route::get('/sign-up', 'ProfileController@signUp')->name('profile.sign-up');
                 Route::get('/sign-up/secondary', 'ProfileController@signUpSecondary')->name('profile.sign-up.secondary');
                 Route::post('/sign-up', 'ProfileController@signUpPost')->name('profile.sign-up.post');
             });

             Route::group([
                 'middleware' => 'auth',
             ], function () {
                 Route::get('/', 'ProfileController@home')->name('profile.home');
                 Route::get('/profile/orders', 'ProfileController@orders')->name('profile.orders');
                 Route::get('/profile/settings', 'ProfileController@settings')->name('profile.settings');
                 Route::post('/profile/settings', 'ProfileController@settingsPost')->name('profile.settings.post');
                 Route::post('/logout', 'ProfileController@logout')->name('profile.logout');
             });
        });
    });


// Admin group
Route::namespace('Admin')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::group([
            'middleware' => 'guest',
        ], function () {
            Route::get('/login', 'AuthController@showLogin')->name('login.show');
            Route::post('/login', 'AuthController@postLogin')->name('login.post');
        });

        Route::group([
            'middleware' => 'admin'
        ], function () {
            Route::post('logout', 'HomeController@logout')->name('logout');
            Route::post('destroy/image', 'HomeController@destroyImage')->name('destroy-image');

            // Главная
            Route::get('/', 'HomeController@home')->name('home');

            // Пользователи
            Route::get('users/', 'UserController@index')->name('user.index');
            Route::get('users/form/{id?}', 'UserController@form')->name('user.form');
            Route::post('users/form/{id?}', 'UserController@post')->name('user.post');
        });
    });

/*--------------------------------------------------------------------------------
    Clients ROUTES  => START
--------------------------------------------------------------------------------*/
Route::prefix('admin/clients')->namespace('Admin')->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('/', 'ClientController@index')->name('admin.clients.index');
        Route::get('/form/{id?}', 'ClientController@form')->name('admin.clients.form');
        Route::post('/form/{id?}', 'ClientController@post')->name('admin.clients.post');
        Route::delete('/{id}', 'ClientController@destroy')->name('admin.clients.destroy');
    });
});
/*--------------------------------------------------------------------------------
    Clients ROUTES  => END
--------------------------------------------------------------------------------*/

/*--------------------------------------------------------------------------------
    Setting ROUTES  => START
--------------------------------------------------------------------------------*/
Route::prefix('admin/settings')->namespace('Admin')->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('/', 'SettingController@index')->name('admin.settings.index');
        Route::get('/create', 'SettingController@create')->name('admin.settings.create');
        Route::post('/', 'SettingController@store')->name('admin.settings.store');
        Route::get('/{id}/edit', 'SettingController@edit')->name('admin.settings.edit');
        Route::post('/{id}', 'SettingController@update')->name('admin.settings.update');
        Route::delete('/{id}', 'SettingController@destroy')->name('admin.settings.destroy');
    });
});
/*--------------------------------------------------------------------------------
    Setting ROUTES  => END
--------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------
    Feedback ROUTES  => START
--------------------------------------------------------------------------------*/
Route::prefix('admin/feedback')->namespace('Admin')->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('/', 'FeedbackController@index')->name('admin.feedback.index');
        Route::get('/{id}', 'FeedbackController@show')->name('admin.feedback.show');
        Route::delete('/{id}', 'FeedbackController@destroy')->name('admin.feedback.destroy');
    });
});
/*--------------------------------------------------------------------------------
    Feedback ROUTES  => END
--------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------
    Activity ROUTES  => START
--------------------------------------------------------------------------------*/
Route::prefix('admin/activities')->namespace('Admin')->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('/', 'ActivityController@index')->name('admin.activities.index');
        Route::get('/create', 'ActivityController@create')->name('admin.activities.create');
        Route::post('/', 'ActivityController@store')->name('admin.activities.store');
        Route::get('/{id}/edit', 'ActivityController@edit')->name('admin.activities.edit');
        Route::post('/{id}', 'ActivityController@update')->name('admin.activities.update');
        Route::delete('/{id}', 'ActivityController@destroy')->name('admin.activities.destroy');
    });
});
/*--------------------------------------------------------------------------------
    Activity ROUTES  => END
--------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------
    Country ROUTES  => START
--------------------------------------------------------------------------------*/
Route::prefix('admin/countries')->namespace('Admin')->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('/', 'CountryController@index')->name('admin.countries.index');
        Route::get('/create', 'CountryController@create')->name('admin.countries.create');
        Route::post('/', 'CountryController@store')->name('admin.countries.store');
        Route::get('/{id}/edit', 'CountryController@edit')->name('admin.countries.edit');
        Route::post('/{id}', 'CountryController@update')->name('admin.countries.update');
        Route::delete('/{id}', 'CountryController@destroy')->name('admin.countries.destroy');
    });
});
/*--------------------------------------------------------------------------------
    Country ROUTES  => END
--------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------
    City ROUTES  => START
--------------------------------------------------------------------------------*/
Route::prefix('admin/countries/{country_id}/cities')->namespace('Admin')->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('/', 'CityController@index')->name('admin.cities.index');
        Route::get('/create', 'CityController@create')->name('admin.cities.create');
        Route::post('/', 'CityController@store')->name('admin.cities.store');
        Route::get('/{id}/edit', 'CityController@edit')->name('admin.cities.edit');
        Route::post('/{id}', 'CityController@update')->name('admin.cities.update');
        Route::delete('/{id}', 'CityController@destroy')->name('admin.cities.destroy');
    });
});
/*--------------------------------------------------------------------------------
    City ROUTES  => END
--------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------
    Includes ROUTES  => START
--------------------------------------------------------------------------------*/
Route::prefix('admin/includes')->namespace('Admin')->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('/', 'IncludesController@index')->name('admin.includes.index');
        Route::get('/create', 'IncludesController@create')->name('admin.includes.create');
        Route::post('/', 'IncludesController@store')->name('admin.includes.store');
        Route::get('/{id}/edit', 'IncludesController@edit')->name('admin.includes.edit');
        Route::post('/{id}', 'IncludesController@update')->name('admin.includes.update');
        Route::delete('/{id}', 'IncludesController@destroy')->name('admin.includes.destroy');
    });
});
/*--------------------------------------------------------------------------------
    Includes ROUTES  => END
--------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------
    States ROUTES  => START
--------------------------------------------------------------------------------*/
Route::prefix('admin/states')->namespace('Admin')->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('/', 'StateController@index')->name('admin.states.index');
        Route::get('/create', 'StateController@create')->name('admin.states.create');
        Route::post('/', 'StateController@store')->name('admin.states.store');
        Route::get('/{id}/edit', 'StateController@edit')->name('admin.states.edit');
        Route::post('/{id}', 'StateController@update')->name('admin.states.update');
        Route::delete('/{id}', 'StateController@destroy')->name('admin.states.destroy');
    });
});
/*--------------------------------------------------------------------------------
    States ROUTES  => END
--------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------
    Inner States ROUTES  => START
--------------------------------------------------------------------------------*/
Route::prefix('admin/states/{parent_id}/children')->namespace('Admin')->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('/', 'InnerStateController@index')->name('admin.states.inner.index');
        Route::get('/create', 'InnerStateController@create')->name('admin.states.inner.create');
        Route::post('/', 'InnerStateController@store')->name('admin.states.inner.store');
        Route::get('/{id}/edit', 'InnerStateController@edit')->name('admin.states.inner.edit');
        Route::post('/{id}', 'InnerStateController@update')->name('admin.states.inner.update');
        Route::delete('/{id}', 'InnerStateController@destroy')->name('admin.states.inner.destroy');
    });
});
/*--------------------------------------------------------------------------------
    Inner States ROUTES  => END
--------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------
    Manager ROUTES  => START
--------------------------------------------------------------------------------*/
Route::prefix('admin/managers')->namespace('Admin')->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('/', 'ManagerController@index')->name('admin.managers.index');
        Route::get('/create', 'ManagerController@create')->name('admin.managers.create');
        Route::post('/', 'ManagerController@store')->name('admin.managers.store');
        Route::get('/{id}/edit', 'ManagerController@edit')->name('admin.managers.edit');
        Route::post('/{id}', 'ManagerController@update')->name('admin.managers.update');
        Route::delete('/{id}', 'ManagerController@destroy')->name('admin.managers.destroy');
    });
});
/*--------------------------------------------------------------------------------
    Manager ROUTES  => END
--------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------
    Application ROUTES  => START
--------------------------------------------------------------------------------*/
Route::prefix('admin/applications')->namespace('Admin')->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('/', 'ApplicationController@index')->name('admin.applications.index');
        Route::get('/create', 'ApplicationController@create')->name('admin.applications.create');
        Route::post('/', 'ApplicationController@store')->name('admin.applications.store');
        Route::get('/{id}/edit', 'ApplicationController@edit')->name('admin.applications.edit');
        Route::post('/{id}', 'ApplicationController@update')->name('admin.applications.update');
        Route::delete('/{id}', 'ApplicationController@destroy')->name('admin.applications.destroy');
    });
});
/*--------------------------------------------------------------------------------
    Application ROUTES  => END
--------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------
    AdditionalFunction ROUTES  => START
--------------------------------------------------------------------------------*/
Route::prefix('admin/additional-functions')->namespace('Admin')->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('/', 'AdditionalFunctionController@index')->name('admin.additional-functions.index');
        Route::get('/create', 'AdditionalFunctionController@create')->name('admin.additional-functions.create');
        Route::post('/', 'AdditionalFunctionController@store')->name('admin.additional-functions.store');
        Route::get('/{id}/edit', 'AdditionalFunctionController@edit')->name('admin.additional-functions.edit');
        Route::post('/{id}', 'AdditionalFunctionController@update')->name('admin.additional-functions.update');
        Route::delete('/{id}', 'AdditionalFunctionController@destroy')->name('admin.additional-functions.destroy');
    });
});
/*--------------------------------------------------------------------------------
    AdditionalFunction ROUTES  => END
--------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------
    Batch ROUTES  => START
--------------------------------------------------------------------------------*/
Route::prefix('admin/batches')->namespace('Admin')->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('/', 'BatchController@index')->name('admin.batches.index');
        Route::get('/create', 'BatchController@create')->name('admin.batches.create');
        Route::post('/', 'BatchController@store')->name('admin.batches.store');
        Route::get('/{id}/edit', 'BatchController@edit')->name('admin.batches.edit');
        Route::post('/{id}', 'BatchController@update')->name('admin.batches.update');
        Route::delete('/{id}', 'BatchController@destroy')->name('admin.batches.destroy');
    });
});
/*--------------------------------------------------------------------------------
    Batch ROUTES  => END
--------------------------------------------------------------------------------*/
