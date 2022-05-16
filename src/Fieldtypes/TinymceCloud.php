<?php

namespace MityDigital\StatamicTinymceCloud\Fieldtypes;

use MityDigital\StatamicTinymceCloud\ConfigurationDefaults;
use Statamic\Fields\Fieldtype;

class TinymceCloud extends Fieldtype
{
    protected $icon = 'textarea';

    protected $categories = ['text', 'special'];

    /**
     * @return string
     */
    public static function title(): string
    {
        return __('tinymce-cloud::addon.name');
    }

    /**
     * @return array
     */
    public function preload(): array
    {
        // prepare defaults
        $defaults = ConfigurationDefaults::load();

        // get the selected config
        $config = collect($defaults->get('defaults'))->firstWhere('name', $this->config('config'));

        if (!$config) {
            $config = '{}';
        }

        // decode the config
        $config = json_decode($config['configuration'], true);

        return [
            'init'          => $config,
            'key'           => config('tinymce-cloud.api_key', ''),
            'cloud_channel' => $defaults->get('cloud_channel', 6)
        ];
    }

    protected function configFieldItems(): array
    {
        // prepare defaults
        $defaults = ConfigurationDefaults::load();

        // get the cofnigs
        $configs = collect($defaults->get('defaults', []));

        // get the default
        $default = null;
        if ($configs->count()) {
            $default = $configs->first()['name'];
        }

        return [
            'config' => [
                'display'  => __('tinymce-cloud::fieldtype.config'),
                'type'     => 'select',
                'default'  => $default,
                'options'  => $configs
                    ->mapWithKeys(fn(array $config) => [
                        $config['name'] => $config['name']
                    ])
                    ->sort()
                    ->toArray(),
                'width'    => 33,
                'validate' => ['required']
            ],
        ];
    }
}
