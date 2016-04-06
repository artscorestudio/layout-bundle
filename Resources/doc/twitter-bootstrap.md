# Configure Twitter Bootstrap

## Copy fonts

If you want to automatically copy fonts in web folder, add this commands in *post-install-cmd* and *post-update-cmd* statements in your project's composer.json file.

```json
# composer.json
{
    "scripts": {
        "post-install-cmd": [
            "Incenteev\\ParameterHandler\\ScriptHandler::buildParameters",
            "ASF\\LayoutBundle\\Composer\\ScriptHandler::installTwbs"
        ],
        "post-update-cmd": [
            "Incenteev\\ParameterHandler\\ScriptHandler::buildParameters",
            "ASF\\LayoutBundle\\Composer\\ScriptHandler::installTwbs"
        ]
    },
}
```

You can do it by hand :

```bash
$ php bin/console asf:twbs:fonts:install
```

## Javascript files

You can use compiled bootstrap javascript file :

```yaml
asf_layout:
    enable_assetic_support: true
    assets:
        twbs:
            js: "%kernel.root_dir%/../vendor/components/bootstrap/js/bootstrap.min.js"
```

Or use just needed files :

```yaml
asf_layout:
    enable_assetic_support: true
    assets:
        twbs:
            js: ["%kernel.root_dir%/../vendor/components/bootstrap/js/modal.min.js", "%kernel.root_dir%/../vendor/components/bootstrap/js/affix.min.js"]
```

## Use Layout bundle form theme

By default, Layout bundle embed en form theme who extends bootstrap3_layout.html.twig.

If you want to use your own form theme, just override bundle's form theme like following :

```yaml
# /app/config/config.yml
asf_layout:
    assets:
        twbs:
            form_theme: "custom_form_theme.html.twig"
```

If you don't want to pass throught Layout bundle, just set twig form_theme param like explains in the [Symfony documentation][1].

## Use less files

If you want to use directly less files for customize Twitter Bootstrap for exemple, you have to enable less filter in Assetic like the following :

Less configuration on *nix operating systems :

```yaml
# /app/config/config.yml
assetic:
    filters:
        cssrewrite: ~
        less:
            node: "/usr/local/bin/node"
            node_paths: ["/usr/local/lib/node_modules/"]
```

Less configuration on Macosx operating systems :

```yaml
# /app/config/config.yml
assetic:
    filters:
        cssrewrite: ~
        less:
            node: "/opt/local/bin/node"
            node_paths: ["/opt/local/lib/node_modules/"]
```

Less configuration on Microsoft Windows operating systems (Windows 7+) :

```yaml
# /app/config/config.yml
assetic:
    filters:
        cssrewrite: ~
        less:
            node: "C:\\Program Files\\nodejs\\node.exe"
            node_paths: ["C:\\Users\\__USERNAME__\\AppData\\Roaming\\npm\\node_modules"]
```

After that, you can fill in the less parameter in Layout bundle and add the default Twitter Bootstrap files like following :

```yaml
asf_layout:
    enable_assetic_support: true
    assets:
        twbs:
            js: "/path/to/js"
            less: ["/path/vendor/bootstrap/less/bootstrap.less", "/path/vendor/bootstrap/less/theme.less"]
``` 

> Be carreful, you cannot have *asf_layout.assets.less* parameter set and *asf_layout.assets.css* also set, an exception will throw. 

### Customize less files

If you want to automatically copy Twitter Bootstrap less files your custom Symfony bundle, a command line tool exist for do this for you. Indeed, if you copy/paste less files in your custom bundle, the "@import" statements in thisfiles will be wrong. To remedy this problem, the command line tool automatically updates the "@import" statements.

Before using the command line tool, you must specify the path of the target folder and files to copy. For that, you can pass this via the "app/config/config.yml" file.

```yaml
asf_layout:
    assets:
        twbs:
            customize:
                less:
                    dest_dir : "%kernel.root_dir%/../src/AcmeDemoBundle/Resources/public/bootstrap"
                    files : ["bootstrap.less", "theme.less", "variables.less"]
``` 

You can now fire the command line tool :

```bash
$ php bin/console asf:twbs:less:copy
```

> Nota 1 : The command check if the file exists in the target folder. If the file exists, then it will not copy it.

> Nota 2 : If you do not specify files in the paramter *asf_layout.twbs.customize.files*, the command line tool copy all less files.

Update the paths to your custom files in bundle's configuration.

```yaml
asf_layout:
    assets:
        twbs:
            less: ["@AcmeDemoBundle/Resources/public/bootstrap/less/bootstrap.less", "@AcmeDemoBundle/Resources/public/bootstrap/less/theme.less"]
``` 

Finally, update your Twig template :

```twig
# With less files
{% stylesheets '@twbs_css' filter="less" %}
	<link href="{{ asset_url }}" rel="stylesheet" type="text/css" />
{% endstylesheets %}
```

[1]: http://symfony.com/doc/current/cookbook/form/form_customization.html#form-theming-in-twig