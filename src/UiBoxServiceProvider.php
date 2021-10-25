<?php

namespace Toproplus\UiBox;

use Illuminate\Support\ServiceProvider;
use Encore\Admin\Admin;

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
                [$assets => public_path('vendor/toproplus/laravel-admin-ext-uibox')],
                'uibox'
            );
        }

        $this->app->booted(function () {
            UiBox::routes(__DIR__.'/../routes/web.php');
        });

        $admin = new Admin();
        $admin::booting(function () use ($admin) {
            $admin::js('vendor/toproplus/laravel-admin-ext-uibox/js/uibox.js');
            $admin::css('vendor/toproplus/laravel-admin-ext-uibox/css/uibox.css');
        });
    }
}