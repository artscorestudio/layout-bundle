<?php
/**
 * This file is part of Artscore Studio Framework Package
 *
 * (c) 2012-2015 Artscore Studio <info@artscore-studio.fr>
 *
 * This source file is subject to the MIT Licence that is bundled
 * with this source code in the file LICENSE.
 */
namespace ASF\LayoutBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Base Collection Form Type
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class BaseCollectionFormType extends AbstractType
{
	/* (non-PHPdoc)
	 * @see \Symfony\Component\Form\AbstractType::buildView()
	 */
	public function buildView(FormView $view, FormInterface $form, array $options)
	{
		$view->vars['containerId'] = $options['containerId'];
		$view->vars['collection_item_widget'] = $options['collection_item_widget'];
		$view->vars['item_id'] = '__name__';
	}
	 
	/* (non-PHPdoc)
	 * @see \Symfony\Component\Form\AbstractType::setDefaultOptions()
	 */
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
			'containerId' => 'base-collection',
			'collection_item_widget' => 'collection_item_widget'
		));
	}

	/**
	 * (non-PHPdoc)
	 * @see \Symfony\Component\Form\AbstractType::getParent()
	 */
	public function getParent()
	{
	    return 'collection';
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Symfony\Component\Form\FormTypeInterface::getName()
	 */
	public function getName()
	{
		return 'base_collection';
	}
}