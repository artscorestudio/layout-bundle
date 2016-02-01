# Artscore Studio Layout Bundle

Layout Bundle is a Symfony 3 component providing frontend and backend layout models in your Symfony 3 application based on jQuery and Twitter Bootstrap. This package is a part of Artscore Studio Framework.

Why ? For my personnal developments, I use jQuery and Twitter Bootstrap. When I started new Symfony project, I wanted to get jQuery and Twitter Bootstrap in basic Twig template just by installing a bundle and boom ! I have a User Interface in place !

But this bundle allows you to enable or disable external libraries or add more libraries supports. We will see this later.

> IMPORTANT NOTICE: This bundle is still under development. Any changes will be done without prior notice to consumers of this package. Of course this code will become stable at a certain point, but for now, use at your own risk.

> BE CARREFUL : This bundle does not include external libraries, you must install the libraries via Compoer, in accordance with best practices of Symfony documentation.
 
## Prerequisites

This version of the bundle requires :
* Symfony 3.0+
* jQuery 2.2+ (suggest [components/jquery](https://github.com/components/jquery)
* Twitter Bootstrap 3.3+ (suggest [components/bootstrap](https://github.com/components/bootstrap) [not yet implemented]

### Translations

If you wish to use default texts provided in this bundle, you have to make sure you have translator enabled in your config.

```yaml
# app/config/config.yml
framework:
    translator: ~
```

For more information about translations, check [Symfony documentation](https://symfony.com/doc/current/book/translation.html).

## Installation

### Step 1 : Dwonload ASFLayoutBundle using composer

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

For a quickly access to a basic template based on jQuery and Twitter Bottstrap, enable it in your application configuration file :

```yaml
// app/config/config.yml
asf_layout:
	supports:
		jquery: true
		twbs: true
		
	jquery_config:
		path: "%kernel.root_dir%/../vendor/components/jquery/jquery.min.js"
		
	twbs_config:
	    [...] TODO
    
### Step 4 : Add jQuery and Twitter Bootstrap in your composer.json file

For install jQuery, add it to your project's composer.json file :

```bash
$ composer require components/jquery "2.2.*"
```

And for install Twitter Bootstrap, add it to your project's composer.json file :

```bash
$ composer require components/bootstrap "3.3.*"
```

### Step 3 : Extend model layouts

Open your base template and extend model templates from Layout bundle :

```twig
// app/Resources/views/base.html.twig
{% extends ASFLayoutBundle::frontend_layout.html.twig %}
```

And it's done ! If you go in your favorite browser, you have basic template for your project based on jQuery and Twitter Bootstrap.
You can use it as this or overriding it !

### Next Steps

Now you have completed the basic installation and configuration of the ASFLayoutBundle, you are ready to learn about more advanced features and usages of the bundle.

The following documents are available :
* [Enable/Disable supported assets](enable-external-library.md)
* [Configure Twitter Bootstrap](twitter-bootstrap.md)
* [Layout models](layout-models.ms)
* [ASFLayoutBundle Configuration Reference](configuration.md)