# Form Type provided by ASFLayoutBundle

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

[2]: http://symfony.com/doc/current/reference/forms/types/datetime.html
[3]: enable-external-library.md#jqueryui