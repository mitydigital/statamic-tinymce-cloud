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

    protected $updateScripts = [
        // v2.0.1
        \MityDigital\StatamicTinymceCloud\UpdateScripts\v2_0_1\MoveConfigFile::class
    ];

    public function bootAddon()
    {
        // views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'tinymce-cloud');

        // translations
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'tinymce-cloud');

        // update nav
        Nav::extend(function ($nav) {
            $nav->tools(__('tinymce-cloud::addon.name'))
                ->route('tinymce-cloud.defaults.edit')
                ->icon('textarea')
                ->can('view tinymce cloud configuration');
        });

        // register permission
        Permission::register('view tinymce cloud configuration')
            ->label(__('tinymce-cloud::permissions.configuration'));

        // Register the TinymceCloud Custom Field
        TinymceCloud::register();
    }
}
