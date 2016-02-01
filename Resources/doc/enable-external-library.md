# Enable/Disable supported assets

Layout bundle comes with a list of supported assets. The available assets are :
* [jQuery](https://jquery.com/)
* [jQuery UI](http://jqueryui.com/)
* [Twitter Bootstrap](http://getbootstrap.com/)
* [Select2 jQuery Plugin for select box](https://github.com/select2/select2)
* [Bazinga Js TranslationBundle for get bundle's translations in javascript](https://github.com/willdurand/BazingaJsTranslationBundle)
* [Speaking URL for generate a slug](https://github.com/pid/speakingurl)

The support of an assets means that you have just to enable it in bundle's configuration and to add it in the composer.json file of your Symfony project.

> By default, this assets are enabled so don't forget to update your composer.json file.

## Enable/disable jQuery

> New wave javascript

### Adding jQuery in your project's composer.json file

I suggest using [component/jquery](https://github.com/components/jquery)shim repository for jquery. You can add it by enter the follow command :

```bash
$ composer require components/jquery "2.2.*"
```

If you do not want to use this repository, please don't forget to change the path to your jquery file like this :

```yaml
# app/config/config.yml
asf_layout:
    supported_assets:
        jquery:
            path: "/path/to/your/jquery/file"
```

### Disable jQuery

Just edit config.yml :

```yaml
asf_layout:
    supported_assets:
        jquery: false
```

## Enable/disable jQuery UI

> jQuery UI is a curated set of user interface interactions, effects, widgets, and themes built on top of jQuery. Whether you're building highly interactive web applications, or you just need to add a date picker to a form control, jQuery UI is the perfect choice.

### Adding jQuery UI in your project's composer.json file

I suggest using [component/jqueryui](https://github.com/components/jqueryui) shim repository for jquery. You can add it by enter the follow command :

```bash
$ composer require components/jqueryui "1.11.*"
```

If you do not want to use this repository, please don't forget to change the path to your jquery ui files like this :

```yaml
# app/config/config.yml
asf_layout:
    supported_assets:
        jqueryui:
            js: "/path/to/your/jqueryui/js/file"
            css: "/path/to/your/jqueryui/css/file"
```

### Disable jQuery UI

Just edit config.yml :

```yaml
asf_layout:
    supported_assets:
        jqueryui: false
```

## Enable/disable Twitter Bootstrap

> Bootstrap is the most popular HTML, CSS, and JS framework for developing responsive, mobile first projects on the web.

### Adding jQuery UI in your project's composer.json file

I suggest using [component/bootstrap](https://github.com/components/bootstrap) shim repository for Twitter Bootstrap. You can add it by enter the follow command :

```bash
$ composer require components/bootstrap "3.3.*"
```

If you do not want to use this repository, please don't forget to change the path to your Twitter Bootstrap files like this :
```yaml
# app/config/config.yml
asf_layout:
    supported_assets:
        twbs:
            js: "/path/to/your/twbs/js/file"
            less: "/path/to/your/twbs/less/file"
            css: "/path/to/your/twbs/css/file"
```

### Disable Twitter Bootstrap

Just edit config.yml :

```yaml
asf_layout:
    supported_assets:
        twbs: false
```

For more information about Twitter Bootstrap, please check this documentation chapter : [Configure Twitter Bootstrap](twitter-bootstrap.md).

## Enable/disable Select2

> Select2 is a jQuery based replacement for select boxes.

### Adding Select2 in your project's composer.json file

I suggest using [select2/select2](https://github.com/select2/select2) repository. You can add it by enter the follow command :

```bash
$ composer require select2/select2 "4.0.*"
```

If you do not want to use this repository, please don't forget to change the path to your select2 file like this :

```yaml
# app/config/config.yml
asf_layout:
    supported_assets:
        select2:
            js: "/path/to/your/select2/js/file"
            css: "/path/to/your/select2/css/file"
```

### Disable select2

Just edit config.yml :

```yaml
asf_layout:
    supported_assets:
        select2: false
```

## Enable/disable BazingaJsTranslation

> A pretty nice way to expose your Symfony2 translation messages to your client applications.

### Adding BazingJsTranslation in your project's composer.json file

I suggest using [willdurand/BazingaJsTranslationBundle](https://github.com/willdurand/BazingaJsTranslationBundle) repository. You can add it by enter the follow command :

```bash
$ composer require willdurand/BazingaJsTranslationBundle "2.5.*"
```

If you do not want to use this repository, please don't forget to change the path to your BazingJsTranslation file like this :

```yaml
# app/config/config.yml
asf_layout:
    supported_assets:
        bazing_js_translation:
            js: "/path/to/your/BazingJsTranslation/js/file"
```

### Disable BazingaJsTranslation

Just edit config.yml :

```yaml
asf_layout:
    supported_assets:
        bazing_js_translation: false
```

## Enable/disable speakingURL

> Generate a slug with a lot of options; create a so-called Semantic URL or 'Clean URL' or 'Pretty URL' or 'nice-looking URL' or 'Speaking URL' or 'user-friendly URL' or 'SEO-friendly URL' from a string. This module aims to transliterate the input string.

### Adding speakingURL in your project's composer.json file

I suggest using [pid/speaking](https://github.com/pid/speakingurl) repository. You can add it by enter the follow command :

```bash
$ composer require pid/speaking "8.0.*"
```

If you do not want to use this repository, please don't forget to change the path to your speakingURL file like this :

```yaml
# app/config/config.yml
asf_layout:
    supported_assets:
        speaking_url:
            js: "/path/to/your/speaking_url/js/file"
```

### Disable speakingURL

Just edit config.yml :

```yaml
asf_layout:
    supported_assets:
        speaking_url: false
```