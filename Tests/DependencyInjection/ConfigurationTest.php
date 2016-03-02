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
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
	public function testEnableTwigSupportParameterInDefaultConfiguration()
	{
		$processor = new Processor();
		$config = $processor->processConfiguration(new Configuration(), array());
		$this->assertTrue($config['enable_twig_support']);
	}
	
	/**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
	public function testEnableAsseticSupportParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertTrue($config['enable_assetic_support']);
	}
	
	/**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
	public function testEnableFlashMessagesSupportParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertTrue($config['enable_flash_messages']);
	}
	
	/**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
	public function testSupportedAssetsParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayHasKey('assets', $config);
	}
	
	/**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
	public function testJqueryParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayHasKey('jquery', $config['assets']);
	}
	
	/**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
	public function testJqueryPathParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayHasKey('path', $config['assets']['jquery']);
	}
	
	/**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
	public function testJqueryPathParameterValueInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertRegExp('/components\/jquery/', $config['assets']['jquery']['path']);
	}
	
	/**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
	public function testJqueryUIParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayNotHasKey('jqueryui', $config['assets']);
	}
	
	/**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
	public function testTwbsDirParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayHasKey('twbs_dir', $config['assets']['twbs']);
	}
	
	/**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
	public function testTwbsDirParameterValueInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertRegExp('/components\/bootstrap/', $config['assets']['twbs']['twbs_dir']);
	}
	
	/**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
	public function testTwbsIconPrefixParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayHasKey('icon_prefix', $config['assets']['twbs']);
	}
	
	/**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
	public function testTwbsIconPrefixParameterValueInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertEquals('glyphicon', $config['assets']['twbs']['icon_prefix']);
	}
	
	/**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
	public function testTwbsIconTagParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayHasKey('icon_tag', $config['assets']['twbs']);
	}
	
	/**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
	public function testTwbsIconTagParameterValueInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertEquals('span', $config['assets']['twbs']['icon_tag']);
	}
	
	/**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
	public function testTwbsFormThemeParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayHasKey('form_theme', $config['assets']['twbs']);
	}
	
	/**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
	public function testTwbsFormThemeParameterValueInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertEquals('ASFLayoutBundle:Form:fields.html.twig', $config['assets']['twbs']['form_theme']);
	}
	
	/**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
	public function testTwbsFontsDirParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayHasKey('fonts_dir', $config['assets']['twbs']);
	}
	
	/**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
	public function testTwbsFontsDirParameterValueInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertEquals('%kernel.root_dir%/../web/fonts', $config['assets']['twbs']['fonts_dir']);
	}
	
	/**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
	public function testTwbsJsPathParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayHasKey('js', $config['assets']['twbs']);
	}
	
	/**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
	public function testTwbsJsParameterValueInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertEquals('js/bootstrap.min.js', $config['assets']['twbs']['js'][0]);
	}
	
	/**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
	public function testTwbsLessParameterValueInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    
	    $default_values = array(
	        "less/bootstrap.less",
            "less/theme.less"
	    );
	    
	    $defaults_exists = true;
	    foreach($config['assets']['twbs']['less'] as $key => $value) {
	        if ( $value != $default_values[$key] )
	            $defaults_exists = false;
	    }
	    $this->assertTrue($defaults_exists);
	}
	
	/**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
	public function testTwbsCSSParameterValueInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	     
	    $default_values = array();
	    $this->assertCount(0, $config['assets']['twbs']['css']);
	}
	
	/**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
	public function testSelect2ParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayNotHasKey('select2', $config['assets']);
	}
	
	/**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
	public function testBazingaJsTranslationParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayNotHasKey('bazinga_js_translator', $config['assets']);
	}
	
	/**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
	public function testSpeakingURLParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayNotHasKey('speakingurl', $config['assets']);
	}
	
	/**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
	public function testFOSJsRoutingParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayHasKey('fos_js_routing', $config['assets']);
	}
	
	/**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
	public function testFOSJsRoutingParameterValueInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertFalse($config['assets']['fos_js_routing']);
	}
	
	/**
     * @covers ASF\LayoutBundle\DependencyInjection\Configuration
     */
	public function testTinyMCEParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayNotHasKey('tinymce', $config['assets']);
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