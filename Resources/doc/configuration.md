# ASFLayoutBundle Configuration Reference

## Default configurations

The configuration below is the configuration by default for each assets when they are enabled. If you want to override it, please check the documentation [Enable/Disable supported assets](enable-external-library.md).

```yaml
asf_layout:
    enable_twig_support: true
    enable_assetic_support: true
    assets:
        jquery:
            path: "%kernel.root_dir%/../vendor/components/jquery/jquery.min.js"
        jqueryui:
            js: "%kernel.root_dir%/../vendor/components/jqueryui/jquery-ui.min.js"
            css: "%kernel.root_dir%/../vendor/components/jqueryui/themes/ui-lightness/jquery-ui.min.css"
        twbs:
            assets_dir: "%kernel.root_dir%/../vendor/components/bootstrap/"
            icon_prefix: "glyphicon"
            fonts_dir: "%kernel.root_dir%/../web/fonts"
            js: "%kernel.root_dir%/../vendor/components/bootstrap/js/bootstrap.min.js"
            less: ["@ASFLayoutBundle/Resources/public/supports/bootstrap/less/bootstrap.less", @ASFLayoutBundle/Resources/public/supports/bootstrap/less/theme.less]
            css: ~
        select2:
            js: "%kernel.root_dir%/../vendor/select2/select2/dist/js/select2.full.min.js"
            css: "%kernel.root_dir%/../vendor/select2/select2/dist/css/select2.min.css"
        bazing_js_translator:
            bz_translator_js: "bundles/bazingajstranslation/js/translator.min.js"
            bz_translator_config: "js/translations/config.js"
            bz_translations_files: "js/translations/*/*.js"
        speaking_url:
            path: "%kernel.root_dir%/../vendor/pid/speakingurl/speakingurl.min.js"
        fos_js_routing: false
```

## Bundle's configuration on installation

On the installation of the bundle, the configuration is like following :

```yaml
asf_layout:
    enable_twig_support: true
    enable_assetic_support: true
    assets:
        jquery: true
        jqueryui: false
        twbs: true
        select2: false
        bazing_js_translation: false
        speaking_url: false
        fos_js_routing: false
```

## Enable an assets with defalt configuration

If you want to enable a supported assets and use the default configuration (see above : Default Configuration), you can just enabled it like following :

```yaml
asf_layout:
    enable_twig_support: true
    enable_assetic_support: true
    assets:
        jquery: true
        jqueryui: true
        twbs: true
        select2: true
        bazing_js_translation: true
        speaking_url: true
        fos_js_routing: true
```