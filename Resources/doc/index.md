# Artscore Studio Layout Bundle

Layout Bundle is a Symfony 3 component providing frontend and backend layouts in your Symfony 3 application based on jQuery and Twitter Bootstrap. This package is a part of Artscore Studio Framework.

IMPORTANT NOTICE: This bundle is still under development. Any changes will be done without prior notice to consumers of this package. Of course this code will become stable at a certain point, but for now, use at your own risk.

## Prerequisites

This version of the bundle requires Symfony 3.0+.

### Translations

If you wish to use default texts provided in this bundle, you have to make sure you have translator enabled in your config.

```yaml
# app/config/config.yml
framework:
    translator: ~
```

For more inforamtion about translations, check [Symfony documentation](https://symfony.com/doc/current/book/translation.html).

## Installation

### Step 1 : Dwonload AsfLayoutBundle using composer

Require the bundle with composer :

```bash
$ composer require artscorestudio/layout-bundle "dev-master"
```

Composer will install the bundle to your project's *vendor/artscorestudio/layout-bundle* directory.

### Step 2 : Enable the bundle

Enable the bundle in the kernel :

```php
// app/AppKernel.php

public function registerBundles()
{
	$bundles = array(
		// ...
		new Asf\LayoutBundle\ASFLayoutBundle()
		// ...
	);
}
```

### Next Steps

Now you have completed the basic installation and configuration of the AsfLayoutBundle, you are ready to learn about more advanced features and usages of the bundle.

The following documents are available :

* [ASFLayoutBundle Configuration Reference](configuration.md)