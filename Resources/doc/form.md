# Form Type provided by ASFLayoutBundle

## Collection Form type

You probably know [CollectionType Field][1] for display a list of entities in your forms. This type of field use javascript for add/remove items in your collection and CSS rules. ASFLayoutBundle provides a collection form type based on javascript (jQuery) and Twitter Bootstrap for a simple integration in your layout.

For use it, you can call it in your form like this :

```php
<?php
namespace Acme\DemoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use ASF\CoreBundle\Form\Type\BaseCollectionType;

class FooFormType extends AbstractType
{
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('organizations', BaseCollectionType::class, array(
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

BaseCollectionType inherite from [Symfony CollectionType Field][1]. 

## DatePicker Form type

You probably know [DateTimeType Field][2] for display and modify a date and time in your forms. You probably know the jQuery UI date picker feature. This is the Symfony Form type how mix this two features. [For use it, you must to enable jQuery UI in the bundle configuration][3].

```php
<?php
namespace Acme\DemoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use ASF\CoreBundle\Form\Type\DatePickerType;

class FooFormType extends AbstractType
{
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('datetime', DatePickerType::class);
	}
}
```

DatePickerType inherite from [Symfony DateTimeType Field][2]. 


[1]: http://symfony.com/doc/current/reference/forms/types/collection.html
[2]: http://symfony.com/doc/current/reference/forms/types/datetime.html
[3]: enable-external-library.md#jqueryui