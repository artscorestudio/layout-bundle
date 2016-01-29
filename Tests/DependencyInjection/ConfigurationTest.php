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
     * Check if asf_layout.enable_twig_support is set to true by default
     */
	public function testEnableTwigSupportParameterInDefaultConfiguration()
	{
		$processor = new Processor();
		$config = $processor->processConfiguration(new Configuration(), array());
		$this->assertTrue($config['enable_twig_support']);
	}
	
	/**
	 * Check if asf_layout.enable_assetic_support is set to true by default
	 */
	public function testEnableAsseticSupportParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertTrue($config['enable_assetic_support']);
	}
	
	/**
	 * Check if asf_layout.supported_assets key is set
	 */
	public function testSupportedAssetsParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayHasKey('supported_assets', $config);
	}
	
	/**
	 * Check if asf_layout.supported_key.jquery key is set
	 */
	public function testJqueryParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayHasKey('jquery', $config['supported_assets']);
	}
	
	/**
	 * Check if asf_layout.supported_key.jquery.path key is set
	 */
	public function testJqueryPathParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayHasKey('path', $config['supported_assets']['jquery']);
	}
	
	/**
	 * Check if asf_layout.supported_key.jquery.path key is set to "%kernel.root_dir%/../vendor/components/jquery/jquery.min.js"
	 */
	public function testJqueryPathParameterValueInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertEquals('%kernel.root_dir%/../vendor/components/jquery/jquery.min.js', $config['supported_assets']['jquery']['path']);
	}
	
	/**
	 * Check if asf_layout.supported_key.jqueryui key is set
	 */
	public function testJqueryUIParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayHasKey('jqueryui', $config['supported_assets']);
	}
	
	/**
	 * Check if asf_layout.supported_key.jqueryui.js key is set
	 */
	public function testJqueryUIJsPathParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayHasKey('js', $config['supported_assets']['jqueryui']);
	}
	
	/**
	 * Check if asf_layout.supported_key.jqueryui.js key is set to "%kernel.root_dir%/../vendor/components/jqueryui/jquery-ui.min.js"
	 */
	public function testJqueryUIJsParameterValueInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertEquals('%kernel.root_dir%/../vendor/components/jqueryui/jquery-ui.min.js', $config['supported_assets']['jqueryui']['js']);
	}
	
	/**
	 * Check if asf_layout.supported_key.jqueryui.css key is set
	 */
	public function testJqueryUICssPathParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayHasKey('css', $config['supported_assets']['jqueryui']);
	}
	
	/**
	 * Check if asf_layout.supported_key.jqueryui.css key is set to "%kernel.root_dir%/../vendor/components/jqueryui/themes/ui-lightness/jquery-ui.min.css"
	 */
	public function testJqueryUICssParameterValueInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertEquals('%kernel.root_dir%/../vendor/components/jqueryui/themes/ui-lightness/jquery-ui.min.css', $config['supported_assets']['jqueryui']['css']);
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