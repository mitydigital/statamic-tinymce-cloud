<?php

return [
    'tinymce'       => 'TinyMCE',
    'title'         => 'TinyMCE Configuration Defaults',
    'init'          => 'Default TinyMCE Configuration',
    'init_instruct' => 'The default configuration will be used as your initial configuration template when you create a
                        new field instance. This is the configuration object that you normally pass to TinyMCE\'s
                        "init" call.<br><br>You do not need to include your API Key in your configuration. This should
                        be set in your .env file as "TINYMCE_CLOUD_APIKEY".<br><br>Refer to the
                        <a href="https://www.tiny.cloud/docs/" target="_blank">TinyMCE 5 Documentation</a> for full
                        configuration details, and take care to ensure your object is not malformed.<br><br>When using
                        external plugins, ensure your plugin.min.js files are publicly accessible, and included in your
                        using init configuration using a relative path from the root of the site, or a complete
                        absolute URL.'
];
