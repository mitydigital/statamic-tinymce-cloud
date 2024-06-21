<?php

return [
    'tinymce' => 'TinyMCE',

    'title' => 'TinyMCE Configuration Defaults',

    'cloud_channel' => 'Cloud Channel',
    'cloud_channel_instructions' => 'The Cloud Channel defines which version of TinyMCE is loaded. This is global for your
                                     entire site.',

    'init' => 'Default TinyMCE Configurations',
    'init_instructions' => 'You can create as many configuration sets as you need. This is your usual TinyMCE configuration
                            object. When you use a TinyMCE Cloud fieldtype configuration, you can select one of your
                            defaults to use for that field.<br><br>The first set in the list will become the default, but
                            the options will get sorted alphabetically just for ease of use.<br><br>You do not need to
                            include your API Key in your configuration. This should be set in your .env file as
                            "TINYMCE_CLOUD_APIKEY".<br><br>Refer to the
                            <a href="https://www.tiny.cloud/docs/" target="_blank">TinyMCE Documentation</a> for full
                            configuration details, and take care to ensure your object is not malformed.
                            <br><br>When using external plugins, ensure your plugin.min.js files are publicly accessible,
                            and included in your using init configuration using a relative path from the root of the site,
                            or a complete absolute URL.<br><br><strong>Init Mode</strong><br>Deferred initialisation
                            requires the author click a button to build that instance of the editor. This may be
                            useful for sites using a replicator to help minimise unnecessary editor loads.<br><br>
                            This will become the default for this configuration, but can be overridden at the fieldtype
                            level.',

    'config_defaults' => 'Default Configuration Option',

    'config_name' => 'Name',
    'config_name_instructions' => 'You will be able to select this configuration from the Blueprint editor. When set,
                                   changing this value may cause issues for previously created content.',

    'config_code' => 'Configuration',
    'config_code_instructions' => 'Don\'t forget that you need to ensure your configuration is valid.',

    'init_mode' => 'Init mode',
    'init_mode_instructions' => 'Should the TinyMCE instance be initialised immediately, or deferred?',
    'init_mode_immediate' => 'Immediate',
    'init_mode_defer' => 'Deferred',

    'content_css' => 'Content CSS',
    'content_css_instructions' => 'An optional custom CSS file to help with the preview of content. Must be a relative
                                   URL to the site\'s domain, or a full absolute URL.<br><br>For best results and
                                   isolation within the Statamic CP, you may want to wrap your custom CSS with a class,
                                   prefixed with <code>.tinymce_cloud_[name] { ... }</code>. For names with a space,
                                   ensure your class "[name]" is written as a dash-delimited slug.',
];
