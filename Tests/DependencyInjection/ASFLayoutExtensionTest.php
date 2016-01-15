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

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Bundle's Extension Test Suites
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class ASFLayoutExtensionTest extends TestCase
{
	/**
	 * @var \Symfony\Component\DependencyInjection\ContainerBuilder
	 */
	protected $container;
	
	/**
	 * {@inheritDoc}
	 * @see PHPUnit_TestCase::setUp()
	 */
	protected function setUp()
	{
		parent::setUp();
		
		$this->container = new ContainerBuilder();
	}
	
	/**
	 * {@inheritDoc}
	 * @see PHPUnit_TestCase::tearDown()
	 */
	protected function tearDown()
	{
		unset($this->container);
		parent::tearDown();
	}
	
	/**
	 * Test bundle's default configuration
	 */
	public function testDefaultConfiguration()
	{
		
	}
}