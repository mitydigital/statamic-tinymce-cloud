<?php

namespace MityDigital\StatamicTinymceCloud\Rules;

use Illuminate\Contracts\Validation\Rule;

class ConfigIsValidRule implements Rule
{
    protected string|null $message = null;

    /**
     * Checks that the code sample provided is valid for TinyMCE
     *
     * @param $attribute
     * @param $value
     *
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        // if the code attribute exists, and it has a value, check it is valid
        if (array_key_exists('code', $value)) {

            if ($value['code']) {

                $code = $value['code'];

                json_decode($code);

                return json_last_error() === JSON_ERROR_NONE;
            } else {
                $this->message = __('statamic-tinymce-cloud::rules.config_is_valid_required');
            }
        }

        // made it this far, it's not valid
        return false;
    }

    /**
     * @return string
     */
    public function message(): string
    {
        if ($this->message) {
            return $this->message;
        }

        return __('statamic-tinymce-cloud::rules.config_is_valid');
    }
}