# Configure Twitter Bootstrap

## Manage the fonts

For the moment, if you want to use default fonts in Twitter Bootstrap, just copy fonts folder in your web folder. 

## Javascript files

You can use compiled bootstrap javascript file :

```yaml
asf_layout:
    enable_assetic_support: true
    supported_assets:
        twbs:
            js: "%kernel.root_dir%/../vendor/components/bootstrap/js/bootstrap.min.js"
```

Or use just needed files :

```yaml
asf_layout:
    enable_assetic_support: true
    supported_assets:
        twbs:
            js: ["%kernel.root_dir%/../vendor/components/bootstrap/js/modal.min.js", "%kernel.root_dir%/../vendor/components/bootstrap/js/affix.min.js"]
```

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
    supported_assets:
        twbs:
            js: "/path/to/js"
            less: ["/path/vendor/bootstrap/less/bootstrap.less", "/path/vendor/bootstrap/less/theme.less"]
``` 

> Be carreful, you cannot have *asf_layout.supported_assets.less* parameter set and *asf_layout.supported_assets.css* also set, an exception will throw. 

Layout bundle have a copy of bootstrap.less, theme.less and variable.less files in *@ASFLayoutBundle/Resources/public/supports/bootstrap/less* folder. The particularity of this files is they are prepared with *@import* delaration like this :

```less
// /vendor/artscorestudio/layout-bundle/Resources/public/supports/bootstrap/less/bootstrap.less
@import "../../../../../../../../mixins.less";
```

If you extends Layout bundle, you can copy/paste this files and modify path according to your bundle. [With the Symfony extending bundle system](http://symfony.com/doc/current/cookbook/bundles/override.html), you have just to create this files for overrinding their contents.

> Be carreful, do not use Layout bundle files directly ! If the bundle is updated, your changes will be lost !