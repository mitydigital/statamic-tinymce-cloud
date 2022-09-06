<?php

return [
    'tinymce' => 'TinyMCE',

    'title' => 'TinyMCE Configuration Defaults',

    'cloud_channel'          => 'Cloud Channel',
    'cloud_channel_instruct' => 'The Cloud Channel defines which version of TinyMCE is loaded. This is global for your 
                                 entire site.',

    'init'          => 'Default TinyMCE Configurations',
    'init_instruct' => 'You can create as many configuration sets as you need. This is your usual TinyMCE configuration 
                        object. When you use a TinyMCE Cloud fieldtype configuration, you can select one of your 
                        defaults to use for that field.<br><br>The first set in the list will become the default, but 
                        the options will get sorted alphabetically just for ease of use.<br><br>You do not need to 
                        include your API Key in your configuration. This should be set in your .env file as 
                        "TINYMCE_CLOUD_APIKEY".<br><br>Refer to the 
                        <a href="https://www.tiny.cloud/docs/" target="_blank">TinyMCE Documentation</a> for full
                        configuration details, and take care to ensure your object is not malformed.<br><br>
                        <strong>IMPORTANT:</strong> your configuration will be parsed as YAML, and cannot include 
                        a \'+\' to join longer lines together. You may like to run your config through a validator, 
                        such as <a href="https://jsonlint.com/" target="_blank">JSON Lint</a> to highlight any issues.
                        <br><br>When using external plugins, ensure your plugin.min.js files are publicly accessible, 
                        and included in your using init configuration using a relative path from the root of the site, 
                        or a complete absolute URL.',

    'config_defaults' => 'Default Configuration Option',

    'config_name'          => 'Name',
    'config_name_instruct' => 'You will be able to select this configuration from the Blueprint editor. When set, 
                               changing this value may cause issues for previously created content.',

    'config_code'          => 'Configuration',
    'config_code_instruct' => 'Don\'t forget that you need to ensure your configuration is valid.',
];
