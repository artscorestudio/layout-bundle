# Artscore Studio Layout Bundle

Layout Bundle is a Symfony 2/3 component providing frontend and backend layouts in your Symfony 2/3 application based on jQuery and Twitter Bootstrap. This package is a part of Artscore Studio Framework.

Why ? For my personnal developments, I use jQuery and Twitter Bootstrap. When I started new Symfony project, I wanted to get jQuery and Twitter Bootstrap in basic Twig template just by installing a bundle and boom ! I have a User Interface in place !

But this bundle allows you to enable or disable external libraries or add more libraries supports. We will see this later.

> IMPORTANT NOTICE: This bundle is still under development. Any changes will be done without prior notice to consumers of this package. Of course this code will become stable at a certain point, but for now, use at your own risk.

> BE CARREFUL : This bundle does not include external libraries, you must install the libraries via Compoer, in accordance with best practices of Symfony documentation.
 
## Prerequisites

This version of the bundle requires :
* [Symfony 2.8+ LTS / 3.0+][1]
* Assetic bundle 2.7+ (suggest [symfony/assetic-bundle][2])
* jQuery 2.2+ (suggest [components/jquery][3])
* Twitter Bootstrap 3.3+ (suggest [components/bootstrap][4])

If you want to use all features of this bundle, you have to add this packages in your project's composer.json file :

* jQuery UI 1.11+ (suggest [components/jqueryui][5])
* Select2 4.0+ (suggest [select2/select2][6])
* Bazinga Js Translation 2.5+ (suggest [willdurand/js-translation-bundle][7])
* Speaking URL 0.11+ (suggest [pid/speakingurl][8])
* FOS Js Routing Bundle 2+ ([friendsofsymfony/jsrouting-bundle][9])
* TinyMCE 4+ (suggest [tinymce/tinymce][10])
* APYDataGrid Bundle (suggest [artscorestudio/APYDataGridBundle][21])

### Translations

If you wish to use default texts provided in this bundle, you have to make sure you have translator enabled in your config.

```yaml
# app/config/config.yml
framework:
    translator: ~
```

For more information about translations, check [Symfony documentation][11].

## Installation

### Step 1 : Download ASFLayoutBundle using composer

Require the bundle with composer :

```bash
$ composer require artscorestudio/layout-bundle "dev-master"
```

Composer will install the bundle to your project's *vendor/artscorestudio/layout-bundle* directory. It also install dependencies. 

### Step 2 : Enable the bundle

Enable the bundle in the kernel :

```php
// app/AppKernel.php

public function registerBundles()
{
   $bundles = array(
      // ...
      new ASF\LayoutBundle\ASFLayoutBundle()
      // ...
   );
}
```

### Step 3 : Configure the bundle for a quickly use of it with jQuery and Twitter Bootstrap

For a quickly access to a basic template based on jQuery and Twitter Bottstrap, just add jQuery and Twitter Bootstrap in your project's composer.json file.

For install jQuery, add it to your project's composer.json file :

```bash
$ composer require components/jquery "2.2.*"
```

And for install Twitter Bootstrap, add it to your project's composer.json file :

```bash
$ composer require components/bootstrap "3.3.*"
```

By default, Layout bundle use Less files directly. Enable Less by install it on your system and add it in your project's config.yml file.

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

Less configuration on MacOS X operating systems :

```yaml
# /app/config/config.yml
assetic:
    filters:
        cssrewrite: ~
        less:
            node: "/opt/local/bin/node"
            node_paths: ["/opt/local/lib/node_modules/"]
```

For enable all supported assets, please check [Enable/Disable supported assets][12] in this documentation.

### Step 4 : Extend model layouts

Open your base template and extend model templates from Layout bundle :

```twig
// app/Resources/views/base.html.twig
{% extends ASFLayoutBundle::frontend_layout.html.twig %}
```

And it's done ! If you go in your favorite browser, you have basic template for your project based on jQuery and Twitter Bootstrap.
You can use it as this or overriding it !

LayoutBundle provides another base layout call *backend_layout.html.twig*. For more informations about provided layouts, please see [Layout models provided by ASFLayoutBundle][13].

### Next Steps

Now you have completed the basic installation and configuration of the ASFLayoutBundle, you are ready to learn about more advanced features and usages of the bundle.

The following documents are available :
* [Enable/Disable supported assets][12]
* [Configure Twitter Bootstrap][14]
* [Configure TinyMCE][15]
* [Layout models][13]
* [Flash Messages][16]
* [Form Types][17]
* [Knp Menu template][18]
* [APYDataGrid bundle support][22]
* [ASFLayoutBundle Configuration Reference][19]
* [ASFLayoutBundle Commands Reference][20]

[1]:  https://symfony.com/download
[2]:  https://packagist.org/packages/symfony/assetic-bundle 
[3]:  https://packagist.org/packages/components/jquery
[4]:  https://packagist.org/packages/components/bootstrap
[5]:  https://packagist.org/packages/components/jqueryui
[6]:  https://packagist.org/packages/select2/select2
[7]:  https://packagist.org/packages/willdurand/js-translation-bundle
[8]:  https://packagist.org/packages/pid/speakingurl
[9]:  https://packagist.org/packages/friendsofsymfony/jsrouting-bundle
[10]: https://packagist.org/packages/tinymce/tinymce
[11]: https://symfony.com/doc/current/book/translation.html
[12]: enable-external-library.md
[13]: layout-models.md
[14]: twitter-bootstrap.md
[15]: tinymce.md
[16]: flash-messages.md
[17]: form.md
[18]: knp-menu-template.md
[19]: configuration.md
[20]: commands.md
[21]: https://github.com/artscorestudio/APYDataGridBundle
[22]: apy-datagrid-bundle.md