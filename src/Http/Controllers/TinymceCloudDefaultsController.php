<?php

namespace MityDigital\StatamicTinymceCloud\Http\Controllers;

use Illuminate\Http\Request;
use MityDigital\StatamicTinymceCloud\ConfigurationDefaults;
use Statamic\Http\Controllers\CP\CpController;
use Statamic\Support\Arr;

class TinymceCloudDefaultsController extends CpController
{


    /**
     * Load the edit view for defining the TinyMCE default options.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function edit()
    {
        $blueprint = ConfigurationDefaults::blueprint();

        $fields = $blueprint
            ->fields()
            ->addValues(ConfigurationDefaults::load()->all())
            ->preProcess();

        return view('tinymce-cloud::defaults', [
            'title'     => __('tinymce-cloud::defaults.title'),
            'action'    => cp_route('tinymce-cloud.defaults.update'),
            'blueprint' => $blueprint->toPublishArray(),
            'meta'      => $fields->meta(),
            'values'    => $fields->values(),
        ]);
    }

    /**
     * Validate and save the configuration defaults
     *
     * @param  Request  $request
     */
    public function update(Request $request)
    {
        // load the blueprint
        $blueprint = ConfigurationDefaults::blueprint();

        // for the blueprint fields, add the request values, and validate
        $fields = $blueprint->fields()->addValues($request->all());
        $fields->validate();

        // remove null values from the processed fields
        $values = Arr::removeNullValues($fields->process()->values()->all());

        // send the values to the defaults, and save to the config yaml
        ConfigurationDefaults::load($values)->save();
    }
}
