<?php

return [
    'init'          => 'Editor Configuration',
    'init_instruct' => 'This is your TinyMCE 5 configuration object that you normally pass to TinyMCE\'s "init".<br><br>
                        Your Tiny Cloud API Key is not required in this init configuration - this should be set in your
                        .env file.<br><br>
                        Refer to the
                        <a href="https://www.tiny.cloud/docs/" target="_blank">TinyMCE 5 Documentation</a> for full
                        configuration details, and take care to ensure your object is not malformed.<br><br>When using
                        external plugins, ensure your plugin.min.js files are publicly accessible, and included in your
                        using init configuration using a relative path from the root of the site, or a complete
                        absolute URL.'
];
