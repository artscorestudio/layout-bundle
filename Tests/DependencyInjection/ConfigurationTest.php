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
use Symfony\Component\Config\Definition\Processor;
use ASF\LayoutBundle\DependencyInjection\Configuration;

/**
 * Bundle's Configuration Test Suites
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class ConfigurationTest extends TestCase
{
	/**
	 * @var \Symfony\Component\Config\Definition\Processor
	 */
	protected $processor;
	
	/**
	 * {@inheritDoc}
	 * @see PHPUnit_TestCase::setUp()
	 */
	public function setUp()
	{
		parent::setUp();
		
		$this->processor = new Processor();
	}
	
	public function tearDown()
	{
		unset($this->processor);
		parent::tearDown();
	}
	
	/**
	 * Test Default Configuration
	 */
	public function testDefaultConfiguration()
	{
		$default_configuration = new Configuration();
		$configuration = $this->processor->processConfiguration($default_configuration, array());
		
		$this->assertArrayHasKey('supports', $configuration, 'The bundle\'s default configuration must have arrayNode "support" for list all external User Interface libraries supported by Layout bundle.');
		
	}
}