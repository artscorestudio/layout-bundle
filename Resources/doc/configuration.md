# ASFLayoutBundle Configuration Reference

All available configuration options are listed below with their default values.

```yaml
asf_layout:
    enable_twig_support: true
    enable_assetic_support: true
    supported_assets:
        jquery:
            path: "%kernel.root_dir%/../vendor/components/jquery/jquery.min.js"
        jqueryui:
            js: "%kernel.root_dir%/../vendor/components/jqueryui/jquery-ui.min.js"
            css: "%kernel.root_dir%/../vendor/components/jqueryui/themes/ui-lightness/jquery-ui.min.css"
        twbs:
            js: "%kernel.root_dir%/../vendor/components/bootstrap/js/bootstrap.min.js"
            less: ["@ASFLayoutBundle/Resources/public/supports/bootstrap/less/bootstrap.less", @ASFLayoutBundle/Resources/public/supports/bootstrap/less/theme.less]
            css: ~
        select2:
            js: "%kernel.root_dir%/../vendor/select2/select2/dist/js/select2.full.min.js"
            css: "%kernel.root_dir%/../vendor/select2/select2/dist/css/select2.min.css"
```