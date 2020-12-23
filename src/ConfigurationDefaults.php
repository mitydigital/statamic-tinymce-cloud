<?php

namespace MityDigital\StatamicTinymceCloud;

use Illuminate\Support\Collection;
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
     * Save configuration defaults collection to yaml.
     */
    public function save()
    {
        File::put($this->path(), YAML::dump($this->items));
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
                            'handle' => 'default_init',
                            'field'  => [
                                'display'      => __('statamic-tinymce-cloud::defaults.init'),
                                'instructions' => __('statamic-tinymce-cloud::defaults.init_instruct'),
                                'type'         => 'code',
                                'mode'         => 'javascript',

                                'validate' => ['required', 'json']
                            ],
                        ]
                    ],
                ]
            ],
        ]);
    }
}
