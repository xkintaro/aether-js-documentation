<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;
use App\Http\View\Composers\NavigationComposer;

// Pages
use App\Models\Page;
use App\Observers\PageObserver;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        View::composer('components.navbar', NavigationComposer::class);

        Page::observe(PageObserver::class);
    }
}
