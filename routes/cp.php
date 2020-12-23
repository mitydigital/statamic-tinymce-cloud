<?php

Route::get('tinymce-cloud', 'TinymceCloudDefaultsController@edit')->name('statamic-tinymce-cloud.defaults.edit');
Route::post('tinymce-cloud', 'TinymceCloudDefaultsController@update')->name('statamic-tinymce-cloud.defaults.update');
