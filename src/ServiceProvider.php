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

    protected $routes = [
        'cp' => __DIR__.'/../routes/cp.php'
    ];

    protected $updateScripts = [
        // v2.0.1
        \MityDigital\StatamicTinymceCloud\UpdateScripts\v2_0_1\MoveConfigFile::class
    ];

    protected $vite = [
        'input' => [
            'resources/js/tinymce-cloud.js',
        ],
        'publicDirectory' => 'resources/dist',
    ];

    public function bootAddon()
    {
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
