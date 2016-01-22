<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\LayoutBundle\Tests\DependencyInjection;

use \Mockery as m; 
use ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Bundle's Extension Test Suites
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class ASFLayoutExtensionTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var \AppKernel
	 */
	protected $kernel;
	
	/**
	 * @var \ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension
	 */
	protected $extension;
	
	/**
	 * {@inheritDoc}
	 * @see PHPUnit_Framework_TestCase::setUp()
	 */
	public function setUp()
	{
		parent::setUp();
		
		$this->kernel = new \AppKernel('test', true);
		$this->kernel->boot();
		
		$this->extension = new ASFLayoutExtension();
	}
	
	/**
	 * Test the load method in bundle's extension
	 */
	public function testLoadExtension()
	{
		$bag = m::mock('Symfony\Component\DependencyInjection\ParameterBag\ParameterBag');
		$bag->shouldReceive('add');
		
		$container = m::mock('Symfony\Component\DependencyInjection\ContainerBuilder');
		$container->shouldReceive('hasExtension')->andReturn(false);
		$container->shouldReceive('addResource');
		$container->shouldReceive('getParameterBag')->andReturn($bag);
		$container->shouldReceive('setDefinition');
		$container->shouldReceive('setParameter');
		
		$this->extension->load(array(), $container);
	}
	
	/**
	 * Test the prepend method in bundle's extension
	 */
	public function testPrependExtension()
	{
		$bundles = $this->kernel->getContainer()->getParameter('kernel.bundles');
		$extensions = array(
			'assetic' => array(),
			'twig' => array()
		);
		
		$container = m::mock('Symfony\Component\DependencyInjection\ContainerBuilder');
		$container->shouldReceive('getParameter')->with('kernel.bundles')->andReturn($bundles);
		$container->shouldReceive('getExtensions')->andReturn($extensions);
		$container->shouldReceive('getExtensionConfig')->andReturn(array());
		$container->shouldReceive('prependExtensionConfig');
		
		$this->extension->prepend($container);
	}
	
	/**
	 * Test jQuery path (empty parameter)
	 */
	public function testJqueryPathHasEmptyParameter()
	{
		$this->setExpectedException('Symfony\Component\Config\Definition\Exception\InvalidConfigurationException');
		$container = m::mock('Symfony\Component\DependencyInjection\ContainerBuilder');
		$extension = new ASFLayoutExtension();
		$extension->load(array(array(
			'supports' => array(
				'jquery' => true
			),
			'jquery_config' => array(
				'path' => ''
			)
		)), $container);
	}
	
	/**
	 * Test jQuery path (file not found)
	 */
	public function testJqueryPathResourceNotFound()
	{
		$this->setExpectedException('Symfony\Component\Config\Definition\Exception\InvalidConfigurationException');
		
		$config = array(array(
			'supports' => array(
				'jquery' => true
			),
			'jquery_config' => array(
				'path' => '/path/to/jquery.min.js'
			)
		));
		
		$bundles = $this->kernel->getContainer()->getParameter('kernel.bundles');
		$extensions = array(
			'assetic' => array(),
			'twig' => array()
		);
		
		$container = m::mock('Symfony\Component\DependencyInjection\ContainerBuilder');
		$container->shouldReceive('getParameter')->with('kernel.bundles')->andReturn($bundles);
		$container->shouldReceive('getParameter')->with('kernel.root_dir')->andReturn($this->kernel->getContainer()->getParameter('kernel.root_dir'));
		$container->shouldReceive('getExtensions')->andReturn($extensions);
		$container->shouldReceive('getExtensionConfig')->with('asf_layout')->andReturn($config);
		$container->shouldReceive('prependExtensionConfig');
		
		$this->extension->prepend($container);
	}
}