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
	
	/**
	 * @var \Twig_Environment
	 */
	protected $environment;
	
	public function __construct($session)
	{
		$this->session = $session;
	}
	
	public function initRuntime(\Twig_Environment $environment)
	{
		$this->environment = $environment;
	}
	
	/**
	 * Functions delcarations
	 *
	 * @see Twig_Extension::getFunctions()
	 */
	public function getFunctions()
	{
		return array(
			'asf_flash_alerts' => new \Twig_Function_Method($this, 'flashMessages', array('is_safe' => array('html'))),
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
	 * @param array $options
	 * - button_close : display a close button
	 * - trans_domain set the domain for translation
	 * @return string
	 */
	public function flashMessages(array $options = array())
	{
		$params = array_merge(array(
			'button_close' => true, 'trans_domain' => null
		), $options);
		
		$template = $this->environment->loadTemplate('ASFLayoutBundle:session:flash-messages.html.twig');
		
		return $template->renderBlock('flash_messages', array_merge($this->environment->getGlobals(), $params));
	}
}