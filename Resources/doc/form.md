# Form Type provided by ASFLayoutBundle

## Collection Form type

You probably know [CollectionType Field](http://symfony.com/doc/current/reference/forms/types/collection.html) for display a list of entities in your forms. This type of field use javascript for add/remove items in your collection and CSS rules. ASFLayoutBundle provides a collection form type based on javascript (jQuery) and Twitter Bootstrap for a simple integration in your layout.

For use it, you can call it in your form like this :

```php
<?php
namespace Acme\DemoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;

class FooFormType extends AbstractType
{
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('organizations', 'base_collection', array(
			'type' => 'organization_form_type',
			'label' => 'List of organizations',
			'allow_add' => true,
			'allow_delete' => true,
			'prototype' => true,
			'containerId' => 'organizations-collection'
		));
	}
}
```