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
		$bundles = $bundles = array(
		    'AsseticBundle' => 'Symfony\Bundle\AsseticBundle\AsseticBundle',
		    'TwigBundle' => 'Symfony\Bundle\TwigBundle\TwigBundle'
		);
		
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
	 * Test preprend method without Twig Bundle enabled - InvalidConfigurationException Exception expected
	 */
	public function testPrependExtensionWithoutTwigBundle()
	{
	    $this->setExpectedException('Symfony\Component\Config\Definition\Exception\InvalidConfigurationException');
	    $bundles = array('AsseticBundle' => 'Symfony\Bundle\AsseticBundle\AsseticBundle');
	    
	    $extensions = array(
	        'assetic' => array()
	    );
	    
	    $container = m::mock('Symfony\Component\DependencyInjection\ContainerBuilder');
	    $container->shouldReceive('getParameter')->with('kernel.bundles')->andReturn($bundles);
	    $container->shouldReceive('getExtensions')->andReturn($extensions);
	    $container->shouldReceive('getExtensionConfig')->andReturn(array());
	    $container->shouldReceive('prependExtensionConfig');
	    
	    $this->extension->prepend($container);
	}
	
	/**
	 * Test jQuery path (empty parameter) - InvalidConfigurationException Exception expected
	 */
	public function testJqueryPathHasEmptyParameter()
	{
		$this->setExpectedException('Symfony\Component\Config\Definition\Exception\InvalidConfigurationException');
		$container = m::mock('Symfony\Component\DependencyInjection\ContainerBuilder');
		$extension = new ASFLayoutExtension();
		$extension->load(array(array(
			'supported_assets' => array(
				'jquery' => array(
				    'path' => ''
				)
			)
		)), $container);
	}
}