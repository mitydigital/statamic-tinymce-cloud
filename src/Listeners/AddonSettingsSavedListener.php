<?php

namespace MityDigital\StatamicTinymceCloud\Listeners;

use Statamic\Events\AddonSettingsSaved;
use Statamic\Facades\File;

class AddonSettingsSavedListener
{
    public function handle(AddonSettingsSaved $event)
    {
        if( $event->settings->addon()->id() === 'mitydigital/statamic-tinymce-cloud') {
            // create the config file
            $config = 'const tinymceCloudConfig = {};';

            foreach ($event->settings->get('defaults') as $item) {
                if (is_array($item['configuration']) && array_key_exists('code', $item['configuration'])) {
                    // 5.7 and later, it is an array
                    $config .= "\r\n".'tinymceCloudConfig["'.addslashes($item['name']).'"] = '.$item['configuration']['code'].';';
                } else {
                    // pre 5.7, it would be a string
                    $config .= "\r\n".'tinymceCloudConfig["'.addslashes($item['name']).'"] = '.$item['configuration'].';';
                }
            }

            // save the config file
            File::put(public_path('vendor/statamic-tinymce-cloud/config.js'), $config);
        }
    }
}
