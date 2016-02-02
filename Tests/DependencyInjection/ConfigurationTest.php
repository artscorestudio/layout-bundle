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
	 * Check if asf_layout.supported_assets key exists
	 */
	public function testSupportedAssetsParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayHasKey('supported_assets', $config);
	}
	
	/**
	 * Check if asf_layout.supported_assets.jquery exists
	 */
	public function testJqueryParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayHasKey('jquery', $config['supported_assets']);
	}
	
	/**
	 * Check if asf_layout.supported_assets.jquery.path exists
	 */
	public function testJqueryPathParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayHasKey('path', $config['supported_assets']['jquery']);
	}
	
	/**
	 * Check asf_layout.supported_assets.jquery.path default value
	 */
	public function testJqueryPathParameterValueInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertEquals('%kernel.root_dir%/../vendor/components/jquery/jquery.min.js', $config['supported_assets']['jquery']['path']);
	}
	
	/**
	 * Check if asf_layout.supported_assets.jqueryui exists
	 */
	public function testJqueryUIParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayNotHasKey('jqueryui', $config['supported_assets']);
	}
	
	/**
	 * Check if asf_layout.supported_assets.twbs.assets_dir exists
	 */
	public function testTwbsAssetsDirParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayHasKey('assets_dir', $config['supported_assets']['twbs']);
	}
	
	/**
	 * Check asf_layout.supported_assets.twbs.assets_dir default value
	 */
	public function testTwbsAssetsDirParameterValueInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertEquals('%kernel.root_dir%/../vendor/components/bootstrap', $config['supported_assets']['twbs']['assets_dir']);
	}
	
	/**
	 * Check if asf_layout.supported_assets.twbs.icon_prefix exists
	 */
	public function testTwbsIconPrefixParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayHasKey('icon_prefix', $config['supported_assets']['twbs']);
	}
	
	/**
	 * Check asf_layout.supported_assets.twbs.icon_prefix default value
	 */
	public function testTwbsIconPrefixParameterValueInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertEquals('glyphicon', $config['supported_assets']['twbs']['icon_prefix']);
	}
	
	/**
	 * Check if asf_layout.supported_assets.twbs.fonts_dir exists
	 */
	public function testTwbsFontsDirParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayHasKey('fonts_dir', $config['supported_assets']['twbs']);
	}
	
	/**
	 * Check asf_layout.supported_assets.twbs.fonts_dir default value
	 */
	public function testTwbsFontsDirParameterValueInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertEquals('%kernel.root_dir%/../web/fonts', $config['supported_assets']['twbs']['fonts_dir']);
	}
	
	/**
	 * Check if asf_layout.supported_assets.twbs.js exists
	 */
	public function testTwbsJsPathParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayHasKey('js', $config['supported_assets']['twbs']);
	}
	
	/**
	 * Check asf_layout.supported_assets.twbs.js default value
	 */
	public function testTwbsJsParameterValueInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertEquals('%kernel.root_dir%/../vendor/components/bootstrap/js/bootstrap.min.js', $config['supported_assets']['twbs']['js'][0]);
	}
	
	/**
	 * Check if asf_layout.supported_assets.twbs.less exists 
	 */
	public function testTwbsLessParameterValueInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    
	    $default_values = array(
	        "@ASFLayoutBundle/Resources/public/supports/bootstrap/less/bootstrap.less",
            "@ASFLayoutBundle/Resources/public/supports/bootstrap/less/theme.less"
	    );
	    
	    $defaults_exists = true;
	    foreach($config['supported_assets']['twbs']['less'] as $key => $value) {
	        if ( $value != $default_values[$key] )
	            $defaults_exists = false;
	    }
	    $this->assertTrue($defaults_exists);
	}
	
	/**
	 * Check if asf_layout.supported_assets.twbs.css exists
	 */
	public function testTwbsCSSParameterValueInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	     
	    $default_values = array();
	    $this->assertCount(0, $config['supported_assets']['twbs']['css']);
	}
	
	/**
	 * Check if asf_layout.supported_assets.select2 not exists
	 */
	public function testSelect2ParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayNotHasKey('select2', $config['supported_assets']);
	}
	
	/**
	 * Check if asf_layout.supported_assets.bazinga_js_translator not exists
	 */
	public function testBazingaJsTranslationParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayNotHasKey('bazinga_js_translator', $config['supported_assets']);
	}
	
	/**
	 * Check if asf_layout.supported_assets.speaking_url not exists
	 */
	public function testSpeakingURLParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayNotHasKey('speaking_url', $config['supported_assets']);
	}
	
	/**
	 * Check if asf_layout.supported_assets.fos_js_routing not exists
	 */
	public function testFOSJsRoutingParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayHasKey('fos_js_routing', $config['supported_assets']);
	}
	
	/**
	 * Check asf_layout.supported_assets.fos_js_routing default value
	 */
	public function testFOSJsRoutingParameterValueInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertFalse($config['supported_assets']['fos_js_routing']);
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