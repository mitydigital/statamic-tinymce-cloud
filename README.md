# TimyMCE Fieldtype for Statamic 3 using Tiny Cloud

![Statamic 3.0+](https://img.shields.io/badge/Statamic-3.0+-FF269E?style=for-the-badge&link=https://statamic.com)

This is a TinyMCE 5 Fieldtype for Statamic 3 utilising the cloud-hosted version of TinyMCE.

This requires a free API key from [tiny.cloud](https://www.tiny.cloud), and simplifies your build steps as the cloud
version will always run the latest version from Tiny, and doesn't need to be included in your app's bundle.

![TinyMCE as a fieldtype in Statamic 3](https://github.com/mitydigital/statamic-tinymce-cloud/blob/master/docs/tinymce-in-statamic.png?raw=true)

## What can it do?

TinyMCE provides a superb WYSIWYG editing experience for content authors, and can be easily extended through custom
plugins - which is great when you need an editor to insert content from other parts of your application.

This TinyMCE fieldtype allows you to:

- Define a default ``init`` configuration
- Apply and adjust the ``init`` configuration for each Blueprint or Fieldset usage
- Can be configured using all of TinyMCE's init configuration options that run with TinyMCE's Vue component, including
  support for custom external plugins and stylesheets

### Why use the Tiny Cloud-hosted version of TinyMCE?

TinyMCE can be either self-hosted or hosted through Tiny Cloud.

This fieldtype uses the Tiny Cloud method.

This means that as Tiny release updates to TinyMCE, the cloud-hosted version will receive them without you needing to
update your dependencies, re-build and re-deploy your codebase.

When using the Tiny Cloud version of TinyMCE, you still can configure TinyMCE as if you were running the self-hosted
version, and take advantage of your own external plugins too - these need to be built as part of your project, and
hosted with your project.

To use the Tiny Cloud version of TinyMCE, you need a [free API key from Tiny](https://www.tiny.cloud). When you have
your key set up, you can also take advantage of Tiny's Premium plugins if needed.

## Installation

This Fieldtype is for **Statamic 3**.

Install it via the composer command

```
composer require mitydigital/statamic-tinymce-cloud
```

Publish the configuration file. This will create `tinymce-cloud.php` in your config/statamic folder.

```
php artisan vendor:publish --tag="statamic-tinymce-cloud-config"
```

## Configuration

Add `TINYMCE_CLOUD_APIKEY` to your .env file, and set your API key from [tiny.cloud](https://www.tiny.cloud).

```
TINYMCE_CLOUD_APIKEY="YOUR_API_KEY"
```

Within Statamic, under Tools, you will see **TinyMCE Cloud**. This is where you can set your default `init`
configuration. When you add the fieldtype to a Blueprint or Fieldset, this configuration will be used as the default,
and you can then adjust on a field usage basis. In other words, one Blueprint could have a fully-featured editor, while
another Blueprint could have a slimmed down feature set.

![TinyMCE default configuration in Statamic 3](https://github.com/mitydigital/statamic-tinymce-cloud/blob/master/docs/tinymce-cloud-configuration.png?raw=true)

Refer to [TinyMCE's documentation](https://www.tiny.cloud/docs/) for full configuration options.

Note that Statamic 3 uses Vue, and in turn, this fieldtype uses the TinyMCE Vue component which does **not** require
your API key to be part of the ``init`` call. Your API key is passed as a separate property to the component.

The Tiny Cloud API key has been added to the .env file, rather than the Statamic configuration screen, to make it easier
to keep environment settings separate from initialisation configuration, especially when different keys may be used for
different environments, allowing you to keep environment configuration settings outside of your source control.

This `init` configuration is written to the `tinymce-cloud.yaml` file within Statamic's content folder, and can be
safely included in your site's source control.

## Using external plugins ##

[External plugins](https://www.tiny.cloud/docs/configure/integration-and-setup/#external_plugins) can be added to your
TinyMCE configuration using the `external_plugins` configuration option.

Using external plugins is identical to when you use a self-hosted version of TinyMCE. Take care to ensure your plugin
definition URLs are publicly accessible, and either relative to the site's root or absolute.

```javascript
{
    // ...
    "external_plugins": {
        "my_plugin_name": "/plugins/my_plugin_name/plugin.min.js"
    },
    "toolbar": "... my_plugin_name ...",
    // ...
}
```

The building of your plugin files needs to be part of your site's build steps. Make sure that the build files end up in
your site's public folder.

# Support

Find a bug, or have a feature
request? [Open an issue on Github](https://github.com/mitydigital/statamic-tinymce-cloud/issues).

## License

This fieldtype is licensed under the MIT license.
