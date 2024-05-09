<?php

namespace MityDigital\StatamicTinymceCloud\Fieldtypes;

use MityDigital\StatamicTinymceCloud\ConfigurationDefaults;
use Statamic\Fields\Fieldtype;
use Statamic\Statamic;

class TinymceCloud extends Fieldtype
{
    protected $icon = 'textarea';

    protected $categories = ['text', 'special'];

    /**
     * @return string
     */
    public static function title(): string
    {
        return __('statamic-tinymce-cloud::addon.name');
    }

    /**
     * @return array
     */
    public function preload(): array
    {
        // prepare defaults
        $defaults = ConfigurationDefaults::load();

        // add the config file
        Statamic::externalScript('/vendor/statamic-tinymce-cloud/config.js');

        return [
            'init' => $this->config('config'),
            'key' => config('statamic-tinymce-cloud.api_key', ''),
            'cloud_channel' => $defaults->get('cloud_channel', 7)
        ];
    }

    protected function configFieldItems(): array
    {
        // prepare defaults
        $defaults = ConfigurationDefaults::load();

        // get the configs
        $configs = collect($defaults->get('defaults', []));

        // get the default
        $default = null;
        if ($configs->count()) {
            $default = $configs->first()['name'];
        }

        return [
            'config' => [
                'display' => __('statamic-tinymce-cloud::fieldtype.config'),
                'type' => 'select',
                'default' => $default,
                'options' => $configs
                    ->mapWithKeys(fn(array $config) => [
                        $config['name'] => $config['name']
                    ])
                    ->sort()
                    ->toArray(),
                'width' => 33,
                'validate' => ['required']
            ],
        ];
    }
}
