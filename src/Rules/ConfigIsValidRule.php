<?php

namespace MityDigital\StatamicTinymceCloud\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;
use Statamic\Yaml\ParseException;
use Symfony\Component\Yaml\Yaml as SymfonyYaml;

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

                // squish the code (remove white spaces, new lines, tabs, etc)
                $code = Str::squish($value['code']);

                try {
                    // try to parse the object
                    \Statamic\Facades\YAML::parse($code, SymfonyYaml::PARSE_OBJECT_FOR_MAP);
                } catch (ParseException $e) {
                    // invalid yaml
                    return false;
                }

                // this far, it parsed
                return true;
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
