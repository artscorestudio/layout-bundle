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

use ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\Definition\Processor;
use ASF\LayoutBundle\DependencyInjection\Configuration;

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
	
	public function setUp()
	{
		parent::setUp();
		
		$this->kernel = new \AppKernel('test', true);
		$this->kernel->boot();
	}
	
	public function testLoadCinfoguration()
	{
		//$bag = \Mock
	}
	
	/**
	 * Test jQuery path (empty parameter)
	 */
	public function testJqueryPathHasEmptyParameter()
	{
		$this->setExpectedException('Symfony\Component\Config\Definition\Exception\InvalidConfigurationException');
		$loader = new ASFLayoutExtension();
		$loader->load(array(array(
			'supports' => array(
				'jquery' => true
			),
			'jquery_config' => array(
				'path' => ''
			)
		)), new ContainerBuilder());
	}
	
	/**
	 * Test jQuery path (file not found)
	 */
	public function testJqueryPathResourceNotFound()
	{
		$config = $this->processConfiguration(array(array(
			'supports' => array(
				'jquery' => true
			),
			'jquery_config' => array(
				'path' => '/path/to/jquery.min.js'
			)
		)));
		
		//$loader = new ASFLayoutExtension();
		$loader = $this->getMockBuilder('ASF\LayoutBundle\DependencyInjection\ASFExtension')->getMock();
		$loader->method('configureSupportsBundle')->with($this->getContainer(), $config);
		$this->assertInstanceOf('Symfony\Component\Config\Definition\Exception\InvalidConfigurationException', $loader->configureSupportsBundle());
	}
	
	/**
	 * @return ContainerBuilder
	 */
	public function getContainer()
	{
		$container = new ContainerBuilder();
		$container->setParameter('kernel.root_dir', $this->kernel->getContainer()->getParameter('kernel.root_dir'));
		$container->setParameter('kernel.bundles', $this->kernel->getContainer()->getParameter('kernel.bundles'));
		
		return $container;
	}
	
	/**
	 * Processes an array of configurations.
	 *
	 * @param array $configs An array of configuration items to process
	 *
	 * @return array The processed configuration
	 */
	public function processConfiguration($configs)
	{
		$processor = new Processor();
		return $processor->processConfiguration(new Configuration(), $configs);
	}
}