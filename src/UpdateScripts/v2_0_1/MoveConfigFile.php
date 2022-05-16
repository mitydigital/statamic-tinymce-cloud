<?php

namespace MityDigital\StatamicTinymceCloud\UpdateScripts\v2_0_1;

use Illuminate\Support\Facades\Artisan;
use Statamic\UpdateScripts\UpdateScript;

class MoveConfigFile extends UpdateScript
{
    public function shouldUpdate($newVersion, $oldVersion)
    {
        return $this->isUpdatingTo('2.0.1');
    }

    public function update()
    {
        // check if the config is cached
        if ($configurationIsCached = app()->configurationIsCached()) {
            Artisan::call('config:clear');
        }

        // if the config file exists within the 'config/statamic' path, move it just to 'config'
        if (file_exists(config_path('statamic/tinymce-cloud.php'))) {
            if (file_exists(config_path('statamic-tinymce-cloud.php'))) {
                // cannot copy
                $this->console()->alert('The Tiny Cloud config file could not be moved to `config/statamic-tinymce-cloud.php` - it already exists!');
                $this->console()->alert('You will need to manually make sure your `config/statamic-tinymce-cloud.php` file is correctly configured.');
            } else {
                // move the config file
                rename(config_path('statamic/tinymce-cloud.php'), config_path('statamic-tinymce-cloud.php'));

                // output
                $this->console()->info('Tiny Cloud config file has been moved to `config/statamic-tinymce-cloud.php`!');
            }
        }

        // re-cache config if it was cached
        if ($configurationIsCached) {
            Artisan::call('config:cache');
        }
    }
}