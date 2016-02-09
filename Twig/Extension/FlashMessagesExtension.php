<?php
/**
 * This file is part of Artscore Studio Framework package
 * 
 * (c) 2012-2014 Nicolas Claverie <info@artscore-studio.fr>
 * 
 * This dource file is subject to the MIT Licence that is bundled 
 * with this source code in the file LICENSE.
 */
namespace ASF\LayoutBundle\Twig\Extension;

/**
 * Manage and display flash messages
 *
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class FlashMessagesExtension extends \Twig_Extension
{
	protected $session;
	
	public function __construct($session)
	{
		$this->session = $session;
	}
	
	/**
	 * Functions delcarations
	 *
	 * @see Twig_Extension::getFunctions()
	 */
	public function getFunctions()
	{
		return array(
			new \Twig_SimpleFunction('asf_flash_alerts', array($this, 'flashMessages'), array(
			    'needs_environment' => true,
			    'is_safe' => array('html')
			)),
		);
	}
	
	/**
	 * Return the extension's name
	 *
	 * @see Twig_ExtensionInterface::getName()
	 */
	public function getName()
	{
		return 'asf_flash_messages';
	}
	
	/**
	 * @param string $message
	 */
	public function addError($message)
	{
		$this->session->getFlashBag()->add('danger', $message);
	}
	
	/**
	 * @param string $message
	 */
	public function addWarning($message)
	{
		$this->session->getFlashBag()->add('warning', $message);
	}
	
	/**
	 * @param string $message
	 */
	public function addSuccess($message)
	{
		$this->session->getFlashBag()->add('success', $message);
	}
	
	/**
	 * @param string $message
	 */
	public function addInfo($message)
	{
		$this->session->getFlashBag()->add('info', $message);
	}
	
	/**
	 * Return HTML of flash messages according to flash-messages.html.twig
	 *
	 * @param \Twig_Environment $environment
	 * @param array $options
	 * - button_close : display a close button
	 * - trans_domain set the domain for translation
	 * @return string
	 */
	public function flashMessages($environment, array $options = array())
	{
		$params = array_merge(array(
			'close_button' => true, 'trans_domain' => null
		), $options);
		
		$template = $environment->loadTemplate('ASFLayoutBundle:session:flash-messages.html.twig');
		
		return $template->renderBlock('flash_messages', array_merge($environment->getGlobals(), $params));
	}
}