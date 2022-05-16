<?php

use MityDigital\StatamicTinymceCloud\Http\Controllers\TinymceCloudDefaultsController;

Route::get('tinymce-cloud',
    [TinymceCloudDefaultsController::class, 'edit'])->name('statamic-tinymce-cloud.defaults.edit')
    ->can('view tinymce cloud configuration');

Route::post('tinymce-cloud',
    [TinymceCloudDefaultsController::class, 'update'])->name('statamic-tinymce-cloud.defaults.update')
    ->can('view tinymce cloud configuration');
