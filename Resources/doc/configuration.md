# ASFLayoutBundle Configuration Reference

## Default configurations

The configuration below is the configuration by default for each assets when they are enabled. If you want to override it, please check the documentation [Enable/Disable supported assets][1].

```yaml
asf_layout:
    assets:
        jquery:
            path: "%kernel.root_dir%/../vendor/components/jquery/jquery.min.js"
        jqueryui:
            js: "%kernel.root_dir%/../vendor/components/jqueryui/jquery-ui.min.js"
            css: "%kernel.root_dir%/../vendor/components/jqueryui/themes/ui-lightness/jquery-ui.min.css"
        twbs:
            twbs_dir: "%kernel.root_dir%/../vendor/components/bootstrap/"
            js: js/bootstrap.min.js"
            less: ["less/bootstrap.less", "less/theme.less"]
            icon_prefix: "glyphicon"
            icon_tag: "span"
            fonts_dir: "%kernel.root_dir%/../web/fonts"
            form_theme: "ASFLayoutBundle:form:form_div_layout.html.twig"
        select2:
            js: "%kernel.root_dir%/../vendor/select2/select2/dist/js/select2.full.min.js"
            css: "%kernel.root_dir%/../vendor/select2/select2/dist/css/select2.min.css"
        bazinga_js_translation:
            bz_translator_js: "bundles/bazingajstranslation/js/translator.min.js"
            bz_translator_config: "js/translations/config.js"
            bz_translations_files: "js/translations/*/*.js"
        speaking_url:
            path: "%kernel.root_dir%/../vendor/pid/speakingurl/speakingurl.min.js"
        fos_js_routing: false
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

## Bundle's configuration on installation

On the installation of the bundle, the configuration is like following :

```yaml
asf_layout:
    assets:
        jquery: true
        twbs: true
        jqueryui: false
        select2: false
        bazing_js_translation: false
        speaking_url: false
        fos_js_routing: false
        tinymce: false
```

## Enable an assets with default configuration

If you want to enable a supported assets and use the default configuration (see above : Default Configuration), you have to enabled it like following and install packages like explain in section of this documentation [Enable/Disable supported assets][1] :

```yaml
asf_layout:
    assets:
        jquery: true
        jqueryui: true
        twbs: true
        select2: true
        bazing_js_translation: true
        speaking_url: true
        fos_js_routing: true
        tinymce: true
```

[1]: enable-external-library.md