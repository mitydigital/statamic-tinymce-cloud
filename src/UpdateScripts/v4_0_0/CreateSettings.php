<?php


namespace MityDigital\StatamicTinymceCloud\UpdateScripts\v4_0_0;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Statamic\UpdateScripts\UpdateScript;

class CreateSettings extends UpdateScript
{
    public function shouldUpdate($newVersion, $oldVersion)
    {
        return $this->isUpdatingTo('4.0.0');
    }
    public function update()
    {
        if (File::exists(base_path('content/tinymce-cloud.yaml'))) {
            File::ensureDirectoryExists(resource_path('addons'));
            File::move(
                base_path('content/tinymce-cloud.yaml'),
                resource_path('addons/statamic-tinymce-cloud.yaml'),
            );
        }
    }
}