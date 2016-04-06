# Knp Menu template

Layout bundle provides a knp menu template. For use it, you have to install [KnpMenuBundle][1].

## Install KnpMenuBundle

Open a command console, enter your project directory and execute the following command to download the latest stable version of this bundle :

```bash
$ composer require knplabs/knp-menu-bundle "^2.0"
```

Then, enable the bundle by adding the following line in the app/AppKernel.php file of your project :

```php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...

            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
        );

        // ...
    }

    // ...
}
```

Finally, configure the bundle for use LayoutBundle template for Knp Menus :

```yaml
knp_menu:
    twig:
        template: "ASFLayoutBundle:menu:knpmenu_template.html.twig"
```

[1]: http://symfony.com/doc/current/bundles/KnpMenuBundle/index.html
