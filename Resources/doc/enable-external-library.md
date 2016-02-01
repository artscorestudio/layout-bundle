# Enable/Disable supported assets

Layout bundle comes with a list of supported assets. The available assets are :
* [jQuery](https://jquery.com/)
* [jQuery UI](http://jqueryui.com/) [not yet implemented]
* [Twitter Bootstrap](http://getbootstrap.com/) [not yet implemented]

The support of an assets means that you have just to enable it in bundle's configuration and to add it in the composer.json file of your Symfony project.

> By default, this assets are enabled so don't forget to update your composer.json file.

## Enable/disable jQuery

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