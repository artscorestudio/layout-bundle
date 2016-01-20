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
use ASF\LayoutBundle\DependencyInjection\Configuration;
use Symfony\Component\Yaml\Parser;

/**
 * Bundle's Extension Test Suites
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class ASFLayoutExtensionTest extends \PHPUnit_Framework_TestCase
{	
	/**
	 * @var ContainerBuilder
	 */
	protected $configuration;
	
	/**
	 * Test if bundle default configuration parameters are in container has container's parameter
	 */
	public function testIfBundleConfigurationParametersAreInContainer()
	{
		$loader = new ASFLayoutExtension();
		$container = new ContainerBuilder();
		$config = $this->getEmptyConfig();
		$loader->load(array($config), $container);
		
		// Test if bundle's configuration parameter asf_layout.supports.jquery is in container parameters
		$this->assertTrue($container->hasParameter($loader->getAlias().'.supports.jquery'));
		
		// Test if bundle's configuration parameter asf_layout.jquery_path is in container parameters
		$this->assertTrue($container->hasParameter($loader->getAlias().'.jquery_path'));
	}
	
	/**
	 * Test if bundle's default configuration are properly loaded with an empty app configuration (yaml)
	 */
	public function testUserLoadThrowsExceptionUnlessSupportsJquerySet()
	{
		$loader = new ASFLayoutExtension();
		$config = $this->getEmptyConfig();
		
		$loader->load(array($config), new ContainerBuilder());
	}
	
	/**
	 * getEmptyConfig
	 *
	 * @return array
	 */
	protected function getEmptyConfig()
	{
		$yaml = <<<EOF
supports: ~
EOF;
		$parser = new Parser();
		return $parser->parse($yaml);
	}
}