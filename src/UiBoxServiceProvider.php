<?php

namespace Toproplus\UiBox;

use Illuminate\Support\ServiceProvider;

class UiBoxServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(UiBox $extension)
    {
        if (! UiBox::boot()) {
            return ;
        }

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'uibox');
        }

        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes(
                [$assets => public_path('vendor/laravel-admin-ext/uibox')],
                'uibox'
            );
        }

        $this->app->booted(function () {
            UiBox::routes(__DIR__.'/../routes/web.php');
        });
    }
}