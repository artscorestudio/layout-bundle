# Enable/Disable supported assets

Layout bundle comes with a list of supported assets. The available assets are :
* [jQuery](#jquery)
* [Twitter Bootstrap](#twbs)
* [jQuery UI](#jqueryui)
* [Select2 jQuery Plugin for select box](#select2)
* [Bazinga Js TranslationBundle for get bundle's translations in javascript](#bazinga)
* [Speaking URL for generate a slug](#speakingurl)
* [TinyMCE](#tinymce)
* [jQuery Input Tags](#jquery_input_tags)
* [PrismJs](#prismjs)
* [Three.js](#threejs)

The support of an assets means that you have just to enable it in bundle's configuration, add it in the composer.json file of your Symfony project and in your Twig template. Enable external libraries in LayoutBundle allows them to automatically add it in the lists of assets of AsseticBundle. [For more information about AsseticBundle, please see its documentation][11].

> By default, just jQuery and Twitter Bootstrap assets are enabled so don't forget to update your composer.json file.

## <a name="jquery"></a>Enable/disable jQuery (required)

> New wave javascript

### Adding jQuery in your project's composer.json file

I suggest using [component/jquery][1] shim repository for jQuery. You can add it by enter the follow command :

```bash
$ composer require components/jquery "2.2.*"
```

You can enable it by two different ways. First, just passing *true* in LayoutBundle configuration :

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

## <a name="twbs"></a>Enable/disable Twitter Bootstrap (required)

> Bootstrap is the most popular HTML, CSS, and JS framework for developing responsive, mobile first projects on the web.

### Adding Twitter Bootstrap in your project's composer.json file

I suggest using [component/bootstrap][3] shim repository for Twitter Bootstrap. You can add it by enter the follow command :

```bash
$ composer require components/bootstrap "3.3.*"
```

You can enable it by two different ways. First, just passing *true* in LayoutBundle configuration :

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
            twbs_dir: "%kernel.root_dir%/../vendor/components/bootstrap/"
            js: "js/bootstrap.min.js"
            less: ["less/bootstrap.less", "less/theme.less"]
            icon_prefix: "glyphicon"
            fonts_dir: "%kernel.root_dir%/../web/fonts"
            icon_tag: "span"
            form_theme: "ASFLayoutBundle:form:form_div_layout.html.twig"
            
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

For more information about Twitter Bootstrap, please check this documentation chapter : [Configure Twitter Bootstrap][4].

## <a name="jqueryui"></a>Enable/disable jQuery UI (optionnal)

> jQuery UI is a curated set of user interface interactions, effects, widgets, and themes built on top of jQuery. Whether you're building highly interactive web applications, or you just need to add a date picker to a form control, jQuery UI is the perfect choice.

### Adding jQuery UI in your project's composer.json file

I suggest using [component/jqueryui][2] shim repository for jQuery UI. You can add it by enter the follow command :

```bash
$ composer require components/jqueryui "1.11.*"
```

You can enable it by two different ways. First, just passing *true* in LayoutBundle configuration :

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

If you do not want to use this repository, please don't forget to change the path to your jQuery UI files like this :

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

## <a name="select2"></a>Enable/disable Select2 (optionnal)

> Select2 is a jQuery based replacement for select boxes.

### Adding Select2 in your project's composer.json file

I suggest using [select2/select2][5] repository. You can add it by enter the follow command :

```bash
$ composer require select2/select2 "4.0.*"
```

You can enable it by two different ways. First, just passing *true* in LayoutBundle configuration :

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

If you do not want to use this repository, please don't forget to change the path to your select2 files like this :

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

## <a name="bazinga"></a>Enable/disable BazingaJsTranslation (optionnal)

> A pretty nice way to expose your Symfony2 translation messages to your client applications.

### Adding BazingJsTranslation in your project's composer.json file

I suggest using [willdurand/BazingaJsTranslationBundle][6] repository. You can add it by enter the follow command :

```bash
$ composer require willdurand/BazingaJsTranslationBundle "2.5.*"
```

You can enable it by two different ways. First, just passing *true* in LayoutBundle configuration :

```yaml
# app/config/config.yml
asf_layout:
    assets:
        bazinga_js_translation: true
```

This configuration is like following (second way) :

```yaml
# app/config/config.yml
asf_layout:
    assets:
        bazinga_js_translation:
            bz_translator_js: "bundles/bazingajstranslation/js/translator.min.js"
            bz_translator_config: "js/translations/config.js"
            bz_translations_files: "js/translations/*/*.js"
```

If you do not want to use this repository, please don't forget to change the path to your BazingJsTranslation files like this :

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

## <a name="speakingurl"></a>Enable/disable speakingURL (optionnal)

> Generate a slug with a lot of options; create a so-called Semantic URL or 'Clean URL' or 'Pretty URL' or 'nice-looking URL' or 'Speaking URL' or 'user-friendly URL' or 'SEO-friendly URL' from a string. This module aims to transliterate the input string.

### Adding speakingURL in your project's composer.json file

I suggest using [pid/speaking][7] repository. You can add it by enter the follow command :

```bash
$ composer require pid/speaking "8.0.*"
```

You can enable it by two different ways. First, just passing *true* in LayoutBundle configuration :

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

## <a name="fosjsrouting"></a>Enable/disable FOSJsRouting Bundle (optionnal)

> A pretty nice way to expose your Symfony2 routing to client applications. 

### Adding FOSJsRoutingBundle in your project's composer.json file

I suggest using [friendsofsymfony/jsrouting-bundle][8] repository. You can add it by enter the follow command :

```bash
$ composer require friendsofsymfony/jsrouting-bundle "2.0.*"
```

Enable it in LayoutBundle configuration :

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

## <a name="tinymce"></a>Enable/disable TinyMCE (optionnal)

> JavaScript library for WYSIWYG HTML editing 

### Adding TinyMCE in your project's composer.json file

I suggest using [tinymce/tinymce][9] repository. You can add it by enter the follow command :

```bash
$ composer require tinymce/tinymce ">=4"
```

You can enable it by two different ways. First, just passing *true* in LayoutBundle configuration :

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

For more information about TinyMCE, please check this documentation chapter : [Configure TinyMCE][10].

## <a name="jquery_input_tags"></a>Enable/disable jQuery Tags Input (optionnal)

> Do you use tags to organize content on your site? This plugin will turn your boring tag list into a magical input that turns each tag into a style-able object with its own delete link. The plugin handles all the data - your form just sees a comma-delimited list of tags!

### Adding jQuery Tags Input in your project's composer.json file

I suggest to installl juqery Input Tags like a component (with [robloach/component-installer][12]) . Open composer.json of your project and add this lines :

```json
{
	"require": {
		"components/jquery-tags-input": "dev-master",
	},
	"repositories" : [{
        "type": "package",
        "package": {
            "name": "components/jquery-tags-input",
            "type": "component",
            "version": "dev-master",
            "dist" : {
				"url" : "https://github.com/xoxco/jQuery-Tags-Input/archive/master.zip",
				"type" : "zip"
			},
			"source" : {
				"url" : "https://github.com/xoxco/jQuery-Tags-Input.git",
				"type" : "git",
				"reference" : "dev-master"
			},
			"extra": {
			    "component": {
			        "scripts": [
			            "dist/jquery.tagsinput.min.js"
			        ],
			        "styles": [
			            "dist/jquery.tagsinput.min.css"
			        ]
			    }
			}
        }
    }],
```

````bash
$ composer update
```

You can enable it by two different ways. First, just passing *true* in LayoutBundle configuration :

```yaml
# app/config/config.yml
asf_layout:
    assets:
        jquery_tags_input: true
```

This configuration is like following (second way) :

```yaml
# app/config/config.yml
asf_layout:
    assets:
        jquery_tags_input:
            js: "%kernel.root_dir%/../vendor/components/jquery-tags-input/dist/jquery.tagsinput.min.js"
            css: "%kernel.root_dir%/../vendor/components/jquery-tags-input/dist/jquery.tagsinput.min.css"
```

If you do not want to use this repository, please don't forget to change the path to your jQuery UI files like this :

```yaml
# app/config/config.yml
asf_layout:
    assets:
        jquery_tags_input:
            js: "/path/to/your/jquery_tags_input/js/file"
            css: "/path/to/your/jquery_tags_input/css/file"
```

Update your Twig template :

```twig
{% stylesheets '@jquerytagsinput_css' %}
	<link href="{{ asset_url }}" rel="stylesheet" type="text/css" />
{% endstylesheets %}

{% javascripts '@jquerytagsinput_js' %}
	<script src="{{ asset_url }}"></script>
{% endjavascripts %}
```

### Disable jQuery Tags Input

Just edit config.yml :

```yaml
asf_layout:
    assets:
        jquery_tags_input: false
```

## <a name="prismjs"></a>Enable/disable PrismJs (optionnal)

> Prism is a lightweight, robust, elegant syntax highlighting library.

### Adding PrismJS in your project's composer.json file

I suggest to install juqery Input Tags like a component (with [robloach/component-installer][12]) . Open composer.json of your project and add this lines :

```json
{
	"require": {
		"components/prismjs": "dev-master",
	},
	"repositories" : [{
        "type": "package",
        "package": {
            "name": "components/prismjs",
            "type": "component",
            "version": "dev-master",
            "dist" : {
				"url" : "https://github.com/PrismJS/prism/archive/gh-pages.zip",
				"type" : "zip"
			},
			"source" : {
				"url" : "https://github.com/PrismJS/prism.git",
				"type" : "git",
				"reference" : "dev-master"
			},
			"extra": {
			    "component": {
			        "scripts": [
			            "prism.js"
			        ],
			        "styles": [
			            "themes/prism.css"
			        ]
			    }
			}
        }
    }],
```

````bash
$ composer update
```

You can enable it by two different ways. First, just passing *true* in LayoutBundle configuration :

```yaml
# app/config/config.yml
asf_layout:
    assets:
        prism_js: true
```

This configuration is like following (second way) :

```yaml
# app/config/config.yml
asf_layout:
    assets:
        prism_js:
            js: "%kernel.root_dir%/../vendor/components/prismjs/prism.js"
            css: "%kernel.root_dir%/../vendor/components/prismjs/themes/prism.css"
```

If you do not want to use this repository, please don't forget to change the path to your jQuery UI files like this :

```yaml
# app/config/config.yml
asf_layout:
    assets:
        prism_js:
            js: "/path/to/your/prism_js/js/file"
            css: "/path/to/your/prism_js/css/file"
```

Update your Twig template :

```twig
{% stylesheets '@prismjs_css' %}
	<link href="{{ asset_url }}" rel="stylesheet" type="text/css" />
{% endstylesheets %}

{% javascripts '@prismjs_js' %}
	<script src="{{ asset_url }}"></script>
{% endjavascripts %}
```

### Disable PrismJs

Just edit config.yml :

```yaml
asf_layout:
    assets:
        prism_js: false
```

## <a name="threejs"></a>Enable/disable Three.js (optionnal)

> JavaScript 3D library.

### Adding Three.js in your project's composer.json file

I suggest to install juqery Input Tags like a component (with [robloach/component-installer][12]) . Open composer.json of your project and add this lines :

````bash
$ composer require components/three.js
```

You can enable it by two different ways. First, just passing *true* in LayoutBundle configuration :

```yaml
# app/config/config.yml
asf_layout:
    assets:
        three_js: true
```

This configuration is like following (second way) :

```yaml
# app/config/config.yml
asf_layout:
    assets:
        three_js:
            js: "%kernel.root_dir%/../vendor/components/threejs/three.js"
```

If you do not want to use this repository, please don't forget to change the path to your three.js file like this :

```yaml
# app/config/config.yml
asf_layout:
    assets:
        three_js:
            js: "/path/to/your/three_js/js/file"
```

Update your Twig template :

```twig
{% javascripts '@threejs_js' %}
	<script src="{{ asset_url }}"></script>
{% endjavascripts %}
```

### Disable PrismJs

Just edit config.yml :

```yaml
asf_layout:
    assets:
        three_js: false
```

[1]:  https://packagist.org/packages/components/jquery
[2]:  https://packagist.org/packages/components/jqueryui
[3]:  https://packagist.org/packages/components/bootstrap
[4]:  twitter-bootstrap.md
[5]:  https://packagist.org/packages/select2/select2
[6]:  https://packagist.org/packages/willdurand/js-translation-bundle
[7]:  https://packagist.org/packages/pid/speakingurl
[8]:  https://packagist.org/packages/friendsofsymfony/jsrouting-bundle
[9]:  https://packagist.org/packages/tinymce/tinymce
[10]: tinymce.md
[11]: http://symfony.com/doc/current/cookbook/assetic/asset_management.html
[12]: https://github.com/RobLoach/component-installer