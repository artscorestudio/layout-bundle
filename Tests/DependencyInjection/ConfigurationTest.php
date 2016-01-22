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

use Symfony\Component\Config\Definition\Processor;
use ASF\LayoutBundle\DependencyInjection\Configuration;

/**
 * This test case check if the default bundle's configuration from bundle's Configuration class is OK
 *  
 * @author Nicolas Claverie <info@artscore-studio.fr
 *
 */
class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * Test supports children parameter with invalid format
	 */
	public function testSupportsParameterWithInvalidFormat()
	{
		$this->setExpectedException('Symfony\Component\Config\Definition\Exception\InvalidTypeException');
		$config = $this->process(array(array(
			'supports' => array(
				'jquery' => '1'
			)
		)));
	}
	
	/**
	 * Test if jquery default configuration is valid 
	 */
	public function testConfigurationWithInvalidJqueryConfiguration()
	{
		$this->setExpectedException('Symfony\Component\Config\Definition\Exception\InvalidConfigurationException');
		$config = $this->process(array(array(
			'supports' => array(
				'jquery' => true
			),
			'jquery_config' => array(
				'path' => ''
			)
		)));
	}
	
	/**
	 * Processes an array of configurations.
	 * 
	 * @param array $configs An array of configuration items to process
	 * 
	 * @return array The processed configuration
	 */
	public function process($configs)
	{
		$processor = new Processor();
		return $processor->processConfiguration(new Configuration(), $configs);
	}
}