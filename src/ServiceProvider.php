<?php

namespace MityDigital\StatamicTinymceCloud;

use MityDigital\StatamicTinymceCloud\Fieldtypes\TinymceCloud;
use Statamic\Facades\CP\Nav;
use Statamic\Facades\File;
use Statamic\Facades\Permission;
use Statamic\Facades\YAML;
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    protected $fieldtypes = [
        TinymceCloud::class
    ];

    protected $updateScripts = [
        // v3.0.0
        \MityDigital\StatamicTinymceCloud\UpdateScripts\v3_0_0\CreateSettings::class
    ];

    protected $vite = [
        'input' => [
            'resources/js/tinymce-cloud.js',
        ],
        'publicDirectory' => 'resources/dist',
    ];

    public function bootAddon()
    {
        // Register the TinymceCloud Custom Field
        TinymceCloud::register();
    }
}
