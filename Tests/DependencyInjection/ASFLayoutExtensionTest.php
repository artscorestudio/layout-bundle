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

/**
 * Bundle's Extension Test Suites
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class ASFLayoutExtensionTest extends \PHPUnit_Framework_TestCase
{	
	/**
	 * @var ASFLayoutExtension
	 */
	protected $extension;
	
	/**
	 * @var ContainerBuilder
	 */
	protected $container;
	
	/**
	 * {@inheritDoc}
	 * @see \ASF\LayoutBundle\Tests\ContainerAwareTestCase::setUp()
	 */
	public function setUp()
	{
		parent::setUp();
		
		/*$this->container = new ContainerBuilder();
		$this->container->setParameter('kernel.cache_dir', $this->kernel->getContainer()->getParameter('kernel.cache_dir'));
		$this->container->setParameter('kernel.bundles', $this->kernel->getContainer()->getParameter('kernel.bundles'));
		*/
		$this->extension = new ASFLayoutExtension();
	}
	
	/**
	 * Test bundle's default configuration
	 */
	public function testDefaultConfiguration()
	{
		$configs = array();
		
		$this->extension->load(array($configs), $this->container);
		
		$this->assertTrue($this->container->hasParameter($this->extension->getAlias().'.supports.jquery'));
	}
}