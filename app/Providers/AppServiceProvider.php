<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Tag;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(\App\Services\TagsSynchronizer::class, function () {
            return new \App\Services\TagsSynchronizer;
        });

        $this->app->singleton(\App\Services\Pushall::class, function () {
            return new \App\Services\Pushall(config('app.pushall.api.key'), config('app.pushall.api.id'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layout.sidebar', function ($view) {
            $view->with('tagsCloud', Tag::tagsCloud());
        });
        Blade::aliasComponent('admin.link', 'admin');
    }
}
