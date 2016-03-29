# Enable/Disable supported assets

Layout bundle comes with a list of supported assets. The available assets are :
* [jQuery](#jquery)
* [jQuery UI](#jqueryui)
* [Twitter Bootstrap](#twbs)
* [Select2 jQuery Plugin for select box](#select2)
* [Bazinga Js TranslationBundle for get bundle's translations in javascript](#bazinga)
* [Speaking URL for generate a slug](#speakingurl)
* [TinyMCE](#tinymce)

The support of an assets means that you have just to enable it in bundle's configuration, add it in the composer.json file of your Symfony project and in your Twig template.

> By default, just jQuery and Twitter Bootstrap assets are enabled so don't forget to update your composer.json file.

## <a name="jquery"></a>Enable/disable jQuery

> New wave javascript

### Adding jQuery in your project's composer.json file

I suggest using [component/jquery](https://github.com/components/jquery)shim repository for jquery. You can add it by enter the follow command :

```bash
$ composer require components/jquery "2.2.*"
```

You can enable it by two different ways. First, just passing *true* :

```yaml
# app/config/config.yml
asf_layout:
    assets:
        jquery: true
```

This configuration is like following (second way) :

```yaml
# app/config/config.yml
asf_layout:
    assets:
        jquery:
            path: "%kernel.root_dir%/../vendor/components/jquery/jquery.min.js"
```

If you do not want to use this repository, please don't forget to change the path to your jquery file like this :

```yaml
# app/config/config.yml
asf_layout:
    assets:
        jquery:
            path: "/path/to/your/jquery/file"
```

Update your Twig template :

```twig
{% javascripts '@jquery' %}
	<script src="{{ asset_url }}"></script>
{% endjavascripts %}
```

### Disable jQuery

Just edit config.yml :

```yaml
asf_layout:
    assets:
        jquery: false
```

## <a name="jqueryui"></a>Enable/disable jQuery UI

> jQuery UI is a curated set of user interface interactions, effects, widgets, and themes built on top of jQuery. Whether you're building highly interactive web applications, or you just need to add a date picker to a form control, jQuery UI is the perfect choice.

### Adding jQuery UI in your project's composer.json file

I suggest using [component/jqueryui](https://github.com/components/jqueryui) shim repository for jquery. You can add it by enter the follow command :

```bash
$ composer require components/jqueryui "1.11.*"
```

You can enable it by two different ways. First, just passing *true* :

```yaml
# app/config/config.yml
asf_layout:
    assets:
        jqueryui: true
```

This configuration is like following (second way) :

```yaml
# app/config/config.yml
asf_layout:
    assets:
        jqueryui:
            js: "%kernel.root_dir%/../vendor/components/jqueryui/jquery-ui.min.js"
            css: "%kernel.root_dir%/../vendor/components/jqueryui/themes/ui-lightness/jquery-ui.min.css"
```

If you do not want to use this repository, please don't forget to change the path to your jquery ui files like this :

```yaml
# app/config/config.yml
asf_layout:
    assets:
        jqueryui:
            js: "/path/to/your/jqueryui/js/file"
            css: "/path/to/your/jqueryui/css/file"
```

Update your Twig template :

```twig
{% stylesheets '@jqueryui_css' %}
	<link href="{{ asset_url }}" rel="stylesheet" type="text/css" />
{% endstylesheets %}

{% javascripts '@jqueryui_js' %}
	<script src="{{ asset_url }}"></script>
{% endjavascripts %}
```

### Disable jQuery UI

Just edit config.yml :

```yaml
asf_layout:
    assets:
        jqueryui: false
```

## <a name="twbs"></a>Enable/disable Twitter Bootstrap

> Bootstrap is the most popular HTML, CSS, and JS framework for developing responsive, mobile first projects on the web.

### Adding jQuery UI in your project's composer.json file

I suggest using [component/bootstrap](https://github.com/components/bootstrap) shim repository for Twitter Bootstrap. You can add it by enter the follow command :

```bash
$ composer require components/bootstrap "3.3.*"
```

You can enable it by two different ways. First, just passing *true* :

```yaml
# app/config/config.yml
asf_layout:
    assets:
        twbs: true
```

This configuration is like following (second way) :

```yaml
# app/config/config.yml
asf_layout:
    assets:
        twbs:
            assets_dir: "%kernel.root_dir%/../vendor/components/bootstrap/"
            icon_prefix: "glyphicon"
            fonts_dir: "%kernel.root_dir%/../web/fonts"
            js: "%kernel.root_dir%/../vendor/components/bootstrap/js/bootstrap.min.js"
            less: ["@ASFLayoutBundle/Resources/public/supports/bootstrap/less/bootstrap.less", @ASFLayoutBundle/Resources/public/supports/bootstrap/less/theme.less]
            css: ~
```

If you do not want to use this repository, please don't forget to change the path to your Twitter Bootstrap files like this :
```yaml
# app/config/config.yml
asf_layout:
    assets:
        twbs:
            js: "/path/to/your/twbs/js/file"
            less: "/path/to/your/twbs/less/file"
            css: "/path/to/your/twbs/css/file"
```

Update your Twig template :

```twig
# With less files
{% stylesheets '@twbs_css' filter="less" %}
	<link href="{{ asset_url }}" rel="stylesheet" type="text/css" />
{% endstylesheets %}

# OR with CSS files
{% stylesheets '@twbs_css' %}
	<link href="{{ asset_url }}" rel="stylesheet" type="text/css" />
{% endstylesheets %}


{% javascripts '@twbs_js' %}
	<script src="{{ asset_url }}"></script>
{% endjavascripts %}
```

### Disable Twitter Bootstrap

Just edit config.yml :

```yaml
asf_layout:
    assets:
        twbs: false
```

For more information about Twitter Bootstrap, please check this documentation chapter : [Configure Twitter Bootstrap](twitter-bootstrap.md).

## <a name="select2"></a>Enable/disable Select2

> Select2 is a jQuery based replacement for select boxes.

### Adding Select2 in your project's composer.json file

I suggest using [select2/select2](https://github.com/select2/select2) repository. You can add it by enter the follow command :

```bash
$ composer require select2/select2 "4.0.*"
```

You can enable it by two different ways. First, just passing *true* :

```yaml
# app/config/config.yml
asf_layout:
    assets:
        select2: true
```

This configuration is like following (second way) :

```yaml
# app/config/config.yml
asf_layout:
    assets:
        select2:
            js: "%kernel.root_dir%/../vendor/select2/select2/dist/js/select2.full.min.js"
            css: "%kernel.root_dir%/../vendor/select2/select2/dist/css/select2.min.css"
```

If you do not want to use this repository, please don't forget to change the path to your select2 file like this :

```yaml
# app/config/config.yml
asf_layout:
    assets:
        select2:
            js: "/path/to/your/select2/js/file"
            css: "/path/to/your/select2/css/file"
```

Update your Twig template :

```twig
# OR with CSS files
{% stylesheets '@select2_css' %}
	<link href="{{ asset_url }}" rel="stylesheet" type="text/css" />
{% endstylesheets %}


{% javascripts '@select2_js' %}
	<script src="{{ asset_url }}"></script>
{% endjavascripts %}
```

### Disable select2

Just edit config.yml :

```yaml
asf_layout:
    assets:
        select2: false
```

## <a name="bazinga"></a>Enable/disable BazingaJsTranslation

> A pretty nice way to expose your Symfony2 translation messages to your client applications.

### Adding BazingJsTranslation in your project's composer.json file

I suggest using [willdurand/BazingaJsTranslationBundle](https://github.com/willdurand/BazingaJsTranslationBundle) repository. You can add it by enter the follow command :

```bash
$ composer require willdurand/BazingaJsTranslationBundle "2.5.*"
```

You can enable it by two different ways. First, just passing *true* :

```yaml
# app/config/config.yml
asf_layout:
    assets:
        bazing_js_translator: true
```

This configuration is like following (second way) :

```yaml
# app/config/config.yml
asf_layout:
    assets:
        bazing_js_translator:
            bz_translator_js: "bundles/bazingajstranslation/js/translator.min.js"
            bz_translator_config: "js/translations/config.js"
            bz_translations_files: "js/translations/*/*.js"
```

If you do not want to use this repository, please don't forget to change the path to your BazingJsTranslation file like this :

```yaml
# app/config/config.yml
asf_layout:
    assets:
        bazing_js_translation:
            js: "/path/to/your/BazingJsTranslation/js/file"
```

Update your Twig template :

```twig
# OR with CSS files
{% javascripts '@bz_translator_js' 'bz_translator_config' 'bz_translations_files' %}
	<script src="{{ asset_url }}"></script>
{% endjavascripts %}
```

### Disable BazingaJsTranslation

Just edit config.yml :

```yaml
asf_layout:
    assets:
        bazing_js_translation: false
```

## <a name="speakingurl"></a>Enable/disable speakingURL

> Generate a slug with a lot of options; create a so-called Semantic URL or 'Clean URL' or 'Pretty URL' or 'nice-looking URL' or 'Speaking URL' or 'user-friendly URL' or 'SEO-friendly URL' from a string. This module aims to transliterate the input string.

### Adding speakingURL in your project's composer.json file

I suggest using [pid/speaking](https://github.com/pid/speakingurl) repository. You can add it by enter the follow command :

```bash
$ composer require pid/speaking "8.0.*"
```

You can enable it by two different ways. First, just passing *true* :

```yaml
# app/config/config.yml
asf_layout:
    assets:
        speakingurl: true
```

This configuration is like following (second way) :

```yaml
# app/config/config.yml
asf_layout:
    assets:
        speakingurl:
            path: "%kernel.root_dir%/../vendor/pid/speakingurl/speakingurl.min.js"
```

If you do not want to use this repository, please don't forget to change the path to your speakingURL file like this :

```yaml
# app/config/config.yml
asf_layout:
    assets:
        speakingurl:
            js: "/path/to/your/speaking_url/js/file"
```

Update your Twig template :

```twig
# OR with CSS files
{% javascripts '@speakingurl_js' %}
	<script src="{{ asset_url }}"></script>
{% endjavascripts %}
```

### Disable speakingURL

Just edit config.yml :

```yaml
asf_layout:
    assets:
        speakingurl: false
```

## <a name="fosjsrouting"></a>Enable/disable FOSJsRouting Bundle

> A pretty nice way to expose your Symfony2 routing to client applications. 

### Adding FOSJsRoutingBundle in your project's composer.json file

I suggest using [friendsofsymfony/jsrouting-bundle](https://github.com/FriendsOfSymfony/FOSJsRoutingBundle) repository. You can add it by enter the follow command :

```bash
$ composer require friendsofsymfony/jsrouting-bundle "2.0.*"
```

```yaml
# app/config/config.yml
asf_layout:
    assets:
        fos_js_routing: true
```

Update your Twig template :

```twig
{% block javascripts %}
	<script src="{{ asset('bundles/fosjsrouting/js/router.js') }}"></script>
	<script src="{{ path('fos_js_routing_js', {'callback': 'fos.Router.setData'}) }}"></script>
{% endblock %}
```

### Disable FOSJsRouting

Just edit config.yml :

```yaml
asf_layout:
    assets:
        fos_js_routing: false
```

## <a name="tinymce"></a>Enable/disable TinyMCE

> JavaScript library for WYSIWYG HTML editing 

### Adding TinyMCE in your project's composer.json file

I suggest using [tinymce/tinymce](https://github.com/tinymce/tinymce-dist) repository. You can add it by enter the follow command :

```bash
$ composer require tinymce/tinymce ">=4"
```

You can enable it by two different ways. First, just passing *true* :

```yaml
# app/config/config.yml
asf_layout:
    assets:
        tinymce: true
```

This configuration is like following (second way) :

```yaml
# app/config/config.yml
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

Update your Twig template :

```twig
{% javascripts '@tinymce_js' %}
	<script src="{{ asset_url }}"></script>
{% endjavascripts %}
{{ tinymce_init() }}
```

### Disable TinyMCE

Just edit config.yml :

```yaml
asf_layout:
    assets:
        tinymce: false
```

For more information about TinyMCE, please check this documentation chapter : [Configure TinyMCE](tinymce.md).