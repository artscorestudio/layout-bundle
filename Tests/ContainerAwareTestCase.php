<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\LayoutBundle\Tests;

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Test class for container aware test subjects
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
abstract class ContainerAwareTestCase extends TestCase
{
	/**
	 * @var Kernel
	 */
	protected $kernel;
	
	/**
	 * @var ContainerBuilder
	 */
	protected $container;
	
	/**
	 * {@inheritDoc}
	 * @see PHPUnit_Framework_TestCase::setUp()
	 */
	protected function setUp()
	{
		parent::setUp();
		
		$this->kernel = new \AppKernel('test', true);
		$this->kernel->boot();
		$this->container = $this->kernel->getContainer();
		var_dump( $this->container->get('asf_layout.supports.jquery') );
	}
	
	/**
	 * {@inheritDoc}
	 * @see PHPUnit_Framework_TestCase::tearDown()
	 */
	protected function tearDown()
	{
		if ( null !== $this->kernel ) {
			$this->kernel->shutdown();
		}
		
		parent::tearDown();
	}
}