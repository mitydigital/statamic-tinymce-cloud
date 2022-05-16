<?php

use MityDigital\StatamicTinymceCloud\Http\Controllers\TinymceCloudDefaultsController;

Route::get('tinymce-cloud',
    [TinymceCloudDefaultsController::class, 'edit'])->name('tinymce-cloud.defaults.edit')
    ->can('view tinymce cloud configuration');

Route::post('tinymce-cloud',
    [TinymceCloudDefaultsController::class, 'update'])->name('tinymce-cloud.defaults.update')
    ->can('view tinymce cloud configuration');
