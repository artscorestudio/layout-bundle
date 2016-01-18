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
use Symfony\Bundle\FrameworkBundle\Tests\TestCase as BaseTestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Test class for container aware test subjects
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
abstract class ContainerAwareTestCase extends BaseTestCase
{
	/**
	 * @var Kernel
	 */
	protected $kernel;
	
	/**
	 * @var ContainerInterface
	 */
	protected $container;
	
	/**
	 * {@inheritDoc}
	 * @see PHPUnit_Framework_TestCase::setUp()
	 */
	protected function setUp()
	{
		parent::setUp();
		
		require_once __DIR__ . '/Fixtures/app/AppKernel.php';
		
		$this->kernel = $this->createKernel();
		$this->kernel->boot();
		
		$this->container = new ContainerBuilder();
	}
	
	/**
	 * @return Kernel
	 */
	protected function createKernel()
	{
		$class = $this->getKernelClass();
		$options = $this->getKernelOptions();
		
		return new $class(
			isset($options['environment']) ? $options['environment'] : 'test',
			isset($options['debug']) ? $options['debug'] : true
		);
	}
	
	/**
	 * @return string
	 */
	protected function getKernelClass()
	{
		return \AppKernel::class;
	}
	
	/**
	 * @return array
	 */
	protected function getKernelOptions()
	{
		return array('environment' => 'test', 'debug' => true);
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