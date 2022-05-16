<?php

namespace MityDigital\StatamicTinymceCloud\Rules;

use Illuminate\Contracts\Validation\Rule;

class ConfigNameUniqueRule implements Rule
{
    /**
     * Checks that the Name attribute of each entry is unique (i.e. there are no double ups)
     *
     * @param $attribute
     * @param $value
     *
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        // get the names
        $names = collect($value)
            ->pluck('name');

        // if the count of unique differs from the actual count
        if ($names->count() != $names->unique()->count()) {
            return false;
        }

        return true;
    }

    /**
     * @return string
     */
    public function message(): string
    {
        return __('statamic-tinymce-cloud::rules.config_name_unique');
    }
}