<?php
/**
 * This file is part of Artscore Studio Framework package
 * 
 * (c) 2012-2014 Nicolas Claverie <info@artscore-studio.fr>
 * 
 * This dource file is subject to the MIT Licence that is bundled 
 * with this source code in the file LICENSE.
 */
namespace ASF\LayoutBundle\Session;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Flash Messages
 *
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class FlashMessage
{
	protected $session;
	
	public function __construct(SessionInterface $session)
	{
		$this->session = $session;
	}
	
	public function alert($message)
	{
		$this->session->getFlashBag()->add('alert', $message);
	}
	
	public function success($message)
	{
		$this->session->getFlashBag()->add('success', $message);
	}
	
	public function info($message)
	{
		$this->session->getFlashBag()->add('info', $message);
	}
	
	public function warning($message)
	{
		$this->session->getFlashBag()->add('warning', $message);
	}
	
	public function danger($message)
	{
		$this->session->getFlashBag()->add('danger', $message);
	}
	
	public function reset()
	{
		$this->session->getFlashBag()->clear();
	}
}