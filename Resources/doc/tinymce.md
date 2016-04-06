# Configure Twitter Bootstrap

## Copy files

If you want to automatically copy tinyMCE files in web folder or in custom bundle, add this commands in *post-install-cmd* and *post-update-cmd* statements in your project's composer.json file.

```json
# composer.json
{
    "scripts": {
        "post-install-cmd": [
            "Incenteev\\ParameterHandler\\ScriptHandler::buildParameters",
            "ASF\\LayoutBundle\\Composer\\ScriptHandler::installTinyMCE"
        ],
        "post-update-cmd": [
            "Incenteev\\ParameterHandler\\ScriptHandler::buildParameters",
            "ASF\\LayoutBundle\\Composer\\ScriptHandler::installTinyMCE"
        ]
    },
}

## Configure TinyMCE

The following is the default configuration for integrate TinyMCE in your Symfony project :

```yaml
asf_layout:
    assets:
        tinymce:
            tinymce_dir: "%kernel.root_dir%/../vendor/tinymce/tinymce"
            js: "tinymce.min.js"
            config:
                selector: ".tinymce-content"
            customize:
                dest_dir: "%kernel.root_dir%/../web/js/tinymce"
                base_url: "/js/tinymce"
                exclude_files: ['bower.json', 'changelog.txt', 'composer.json', 'license.txt', 'package.json', 'readme.md']
```

If you want to integrate TinyMCE in your layout, the tinyMCE files must be accessible in the web folder of your project. For this, fire the following command will install TinyMCE in */web/js/tinymce/* folder :

```bash
$ php bin/console asf:tinymce:copy
```

After that just add TinyMCE in your layout :

```twig
{% javascripts '@tinymce_js' %}
	<script src="{{ asset_url }}"></script>
{% endjavascripts %}
{{ tinymce_init() }}
```

### The Twig function tinymce_init()

The Twig function tinymce_init() return the following (with default bundle configuration) :

```twig
<script type="text/javascript">
$(function($, window, document) {
    tinymce.baseURL = "/js/tinymce";
    tinymce.init({
    	"selector": ".tinymce-content"
    });
}(window.jQuery, window, document));
</script>
```

The TinyMCE configuration parameters can be set through bundle's configuration according to the parameter :

```yaml
asf_layout:
    assets:
        tinymce:
            config:
                selector: ".tinymce-content"
                theme_url: "/path/to/theme"
                # [...]
```

> Don't forget to set the base_url parameter ! If not, TinyMCE search themes folders (and others) from web root.

You have another way to configure TinyMCE, overriding the Twig template used by *tinymce_init()* function.

The ASFLayout Twig template for insert TinyMCE configuration used by *tinymce_init()* Twig function :

```twig
# /vendor/artscorestudio/layout-bundle/Resources/views/tinymce/init_js.html.twig
<script type="text/javascript">
$(function($, window, document) {
    tinymce.baseURL = "{{ tinymce_base_url }}";
    tinymce.init({{ tinymce_config|json_encode(constant('JSON_UNESCAPED_SLASHES'))|raw }});
}(window.jQuery, window, document));
</script>
```

Your custom template :

```twig
# /src/acme/DemoBundle/Resources/views/tinymce/init_js.html.twig
<script type="text/javascript">
$(function($, window, document) {
    tinymce.baseURL = "{{ tinymce_base_url }}";
    tinymce.init({
        selector: ".tinymce",
        external_plugins: {
            'testing': 'http://www.testing.com/plugin.min.js',
            'maths': 'http://www.maths.com/plugin.min.js'
        }
    });
}(window.jQuery, window, document));
</script>
```

For this way, read the Symfony documentation : [How to Use Bundle Inheritance to Override Parts of a Bundle][1].

[1]: http://symfony.com/doc/current/cookbook/bundles/inheritance.html