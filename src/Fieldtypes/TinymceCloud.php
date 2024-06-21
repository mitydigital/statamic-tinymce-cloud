<?php

namespace MityDigital\StatamicTinymceCloud\Fieldtypes;

use Illuminate\Support\Arr;
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

        // get the init mode from the config (and fallback to 'immediate' for older setups)
        $init_mode = $this->config('init_mode', 'immediate');
        if ($init_mode === 'inherit') {
            // get from the default
            foreach ($defaults->get('defaults') as $default) {
                if ($default['name'] === $this->config('config'))
                {
                    $init_mode = Arr::get($default, 'init_mode', 'immediate');
                    break;
                }
            }
        }

        // if init is deferred, get the content css
        if ($init_mode === 'defer') {
            // get from the default
            foreach ($defaults->get('defaults') as $default) {
                if ($default['name'] === $this->config('config'))
                {
                    if ($content_css = Arr::get($default, 'content_css', null)) {
                        Statamic::externalStyle($content_css);
                    }
                    break;
                }
            }
        }

        return [
            'init' => $this->config('config'),
            'init_mode' => $init_mode,
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
                'instructions' => __('statamic-tinymce-cloud::fieldtype.config_instructions'),
                'type' => 'select',
                'default' => $default,
                'options' => $configs
                    ->sortBy(fn(array $config) => strtolower($config['name']))
                    ->mapWithKeys(fn(array $config) => [
                        $config['name'] => $config['name']
                    ])
                    ->toArray(),
                'width' => 33,
                'validate' => ['required']
            ],
            'init_mode' => [
                'display' => __('statamic-tinymce-cloud::fieldtype.init_mode'),
                'instructions' => __('statamic-tinymce-cloud::fieldtype.init_mode_instructions'),
                'type' => 'select',
                'validate' => ['required'],
                'options' => [
                    'inherit' => __('statamic-tinymce-cloud::fieldtype.init_mode_inherit'),
                    'defer' => __('statamic-tinymce-cloud::fieldtype.init_mode_defer'),
                    'immediate' => __('statamic-tinymce-cloud::fieldtype.init_mode_immediate'),
                ],
                'default' => 'inherit'
            ],
        ];
    }
}
