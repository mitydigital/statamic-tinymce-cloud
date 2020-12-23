<?php

namespace MityDigital\StatamicTinymceCloud\Fieldtypes;

use MityDigital\StatamicTinymceCloud\ConfigurationDefaults;
use Statamic\Fields\Fieldtype;

class TinymceCloud extends Fieldtype
{
    protected $icon = 'textarea';

    protected $categories = ['text', 'media'];

    public function __construct()
    {
        // prepare defaults
        $defaults = ConfigurationDefaults::load();

        // build the config fields
        $this->configFields = [
            'init' => [
                'display'      => __('statamic-tinymce-cloud::field.init'),
                'instructions' => __('statamic-tinymce-cloud::field.init_instruct'),
                'type'         => 'code',
                'mode'         => 'javascript',
                'default'      => $defaults->get('default_init')
            ],
        ];
    }

    /**
     * @return string
     */
    public static function title()
    {
        return 'TinyMCE Cloud';
    }

    /**
     * @return array
     */
    public function preload()
    {
        return [
            'init' => json_decode($this->config('init'), true),
            'key'  => config('statamic.tinymce-cloud.api_key', '')
        ];
    }


}
