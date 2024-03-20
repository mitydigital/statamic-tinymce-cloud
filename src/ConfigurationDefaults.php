<?php

namespace MityDigital\StatamicTinymceCloud;

use Illuminate\Support\Collection;
use MityDigital\StatamicTinymceCloud\Rules\ConfigNameUniqueRule;
use Statamic\Facades\Blueprint;
use Statamic\Facades\File;
use Statamic\Facades\YAML;

class ConfigurationDefaults extends Collection
{
    /**
     * Load configuration defaults collection.
     *
     * @param  array|Collection|null  $items
     */
    public function __construct($items = null)
    {
        if (!is_null($items)) {
            $items = collect($items)->all();
        }

        $this->items = $items ?? $this->getDefaults();
    }

    /**
     * Get configuration defaults from yaml.
     *
     * @return array
     */
    protected function getDefaults()
    {
        return collect(YAML::file(__DIR__.'/../content/tinymce-cloud.yaml')->parse())
            ->merge(YAML::file($this->path())->parse())
            ->all();
    }

    /**
     * Get configuration defaults yaml path.
     *
     * @return string
     */
    protected function path()
    {
        return base_path('content/tinymce-cloud.yaml');
    }

    /**
     * Load configuration defaults collection.
     *
     * @param  array|Collection|null  $items
     *
     * @return static
     */
    public static function load($items = null)
    {
        return new static($items);
    }

    /**
     * Get configuration defaults blueprint.
     *
     * @return \Statamic\Fields\Blueprint
     */
    public static function blueprint()
    {
        return Blueprint::make()->setContents([
            'sections' => [
                'main' => [
                    'fields' => [
                        [
                            'handle' => 'cloud_channel',
                            'field' => [
                                'display' => __('statamic-tinymce-cloud::defaults.cloud_channel'),
                                'instructions' => __('statamic-tinymce-cloud::defaults.cloud_channel_instruct'),
                                'type' => 'select',
                                'default' => '7',

                                'options' => [
                                    '5' => 'TinyMCE 5',
                                    '6' => 'TinyMCE 6',
                                    '7' => 'TinyMCE 7'
                                ],

                                'validate' => ['required']
                            ],
                        ],
                        [
                            'handle' => 'defaults',
                            'field' => [
                                'display' => __('statamic-tinymce-cloud::defaults.init'),
                                'instructions' => __('statamic-tinymce-cloud::defaults.init_instruct'),
                                'type' => 'replicator',
                                'sets' => [
                                    'configuration' => [
                                        'display' => __('statamic-tinymce-cloud::defaults.config_defaults'),
                                        'fields' => [
                                            [
                                                'handle' => 'name',
                                                'field' => [
                                                    'display' => __('statamic-tinymce-cloud::defaults.config_name'),
                                                    'instructions' => __('statamic-tinymce-cloud::defaults.config_name_instruct'),
                                                    'type' => 'text',
                                                    'validate' => ['required']
                                                ],
                                            ],
                                            [
                                                'handle' => 'configuration',
                                                'field' => [
                                                    'type' => 'code',
                                                    'mode' => 'yaml',

                                                    'display' => __('statamic-tinymce-cloud::defaults.config_code'),
                                                    'instructions' => __('statamic-tinymce-cloud::defaults.config_code_instruct'),
                                                    'instructions_position' => 'below',

                                                    'validate' => [
                                                        'required'
                                                    ]
                                                ]
                                            ]
                                        ]
                                    ]
                                ],
                                'validate' => ['required', new ConfigNameUniqueRule()]
                            ],
                        ]
                    ],
                ]
            ],
        ]);
    }

    /**
     * Save configuration defaults collection to yaml.
     */
    public function save()
    {

        // create the config file
        $config = 'const tinymceCloudConfig = {};';

        foreach ($this->items['defaults'] as $item) {
            $config .= "\r\n".'tinymceCloudConfig["'.addslashes($item['name']).'"] = '.$item['configuration'].';';
        }

        // save the config file
        File::put(public_path('vendor/statamic-tinymce-cloud/config.js'), $config);

        // save the yaml config
        File::put($this->path(), YAML::dump($this->items));
    }
}
