<?php

namespace MityDigital\StatamicTinymceCloud\Fieldtypes;

use MityDigital\StatamicTinymceCloud\ConfigurationDefaults;
use Statamic\Facades\CP\Toast;
use Statamic\Fields\Fieldtype;
use Statamic\Support\Str;
use Statamic\Yaml\ParseException;
use Symfony\Component\Yaml\Yaml as SymfonyYaml;

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

        // get the selected config
        $config = collect($defaults->get('defaults'))->firstWhere('name', $this->config('config'));

        if (!$config) {
            $config = [];
        }

        try {
            // try to parse the object
            $config = \Statamic\Facades\YAML::parse(Str::squish($config['configuration']), SymfonyYaml::PARSE_OBJECT_FOR_MAP);
        } catch (ParseException $e) {
            // invalid yaml
            Toast::error(__('statamic-tinymce-cloud::fieldtype.config_not_valid'));

            // reset config to an empty array
            $config = [];
        }

        return [
            'init' => $config,
            'key' => config('statamic-tinymce-cloud.api_key', ''),
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
