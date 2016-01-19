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

use ASF\LayoutBundle\Tests\ContainerAwareTestCase;
use ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension;

/**
 * Bundle's Extension Test Suites
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class ASFLayoutExtensionTest extends ContainerAwareTestCase
{
	/**
	 * @var ASFLayoutExtension
	 */
	protected $extension;
	
	public function setUp()
	{
		parent::setUp();
		
		$this->extension = new ASFLayoutExtension();
	}
	
	/**
	 * Test bundle's default configuration
	 */
	public function testDefaultConfiguration()
	{
		$configs = $this->container->getExtensionConfig($this->extension->getAlias());
		$this->extension->load($configs, $this->container);
		
		$this->assertTrue($this->container->hasParameter($this->extension->getAlias().'.supports'));
	}
}