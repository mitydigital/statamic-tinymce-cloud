<?php

namespace MityDigital\StatamicTinymceCloud;

use MityDigital\StatamicTinymceCloud\Fieldtypes\TinymceCloud;
use Statamic\Facades\CP\Nav;
use Statamic\Facades\Permission;
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    protected $fieldtypes = [
        TinymceCloud::class
    ];

    protected $scripts = [
        __DIR__.'/../resources/dist/js/tinymce-cloud.js'
    ];

    protected $routes = [
        'cp' => __DIR__.'/../routes/cp.php'
    ];

    public function boot()
    {
        parent::boot();

        // set up config publishing
        $this->publishes([
            __DIR__.'/../config/tinymce-cloud.php' => config_path('statamic/tinymce-cloud.php'),
        ], 'statamic-tinymce-cloud-config');

        // views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'statamic-tinymce-cloud');

        // translations
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'statamic-tinymce-cloud');

        // update nav
        Nav::extend(function ($nav) {
            $nav->tools(__('statamic-tinymce-cloud::addon.name'))
                ->route('statamic-tinymce-cloud.defaults.edit')
                ->icon('textarea')
                ->can('view tinymce cloud configuration');
        });

        // register permission
        Permission::register('view tinymce cloud configuration')
            ->label(__('statamic-tinymce-cloud::permissions.configuration'));

        // Register the TinymceCloud Custom Field
        TinymceCloud::register();
    }
}
