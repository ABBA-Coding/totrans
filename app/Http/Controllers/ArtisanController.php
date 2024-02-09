<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;

class ArtisanController extends Controller
{
    public function configCache()
    {
        Artisan::call('config:cache');

        return 'config:cache';
    }

    public function configClear()
    {
        Artisan::call('config:clear');

        return 'config:clear';
    }

    public function routeCache()
    {
        Artisan::call('route:cache');

        return 'route:cache';
    }

    public function routeClear()
    {
        Artisan::call('route:clear');

        return 'route:clear';
    }

    public function cacheClear()
    {
        Artisan::call('cache:clear');

        return 'cache:clear';
    }

    public function viewCache()
    {
        Artisan::call('view:cache');

        return 'view:cache';
    }

    public function viewClear()
    {
        Artisan::call('view:clear');

        return 'view:clear';
    }

    public function optimize()
    {
        Artisan::call('optimize');

        return 'optimize';
    }

    public function optimizeClear()
    {
        Artisan::call('optimize:clear');

        return 'optimize:clear';
    }

    public function storageLink()
    {
        Artisan::call('storage:link');

        return 'storage:link';
    }
}
