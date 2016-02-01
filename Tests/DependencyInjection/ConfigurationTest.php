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
	    $this->assertArrayHasKey('jqueryui', $config['supported_assets']);
	}
	
	/**
	 * Check if asf_layout.supported_assets.jqueryui.js exists
	 */
	public function testJqueryUIJsPathParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayHasKey('js', $config['supported_assets']['jqueryui']);
	}
	
	/**
	 * Check asf_layout.supported_assets.jqueryui.js default value
	 */
	public function testJqueryUIJsParameterValueInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertEquals('%kernel.root_dir%/../vendor/components/jqueryui/jquery-ui.min.js', $config['supported_assets']['jqueryui']['js']);
	}
	
	/**
	 * Check if asf_layout.supported_assets.jqueryui.css exists
	 */
	public function testJqueryUICssPathParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayHasKey('css', $config['supported_assets']['jqueryui']);
	}
	
	/**
	 * Check asf_layout.supported_assets.jqueryui.css key default value
	 */
	public function testJqueryUICssParameterValueInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertEquals('%kernel.root_dir%/../vendor/components/jqueryui/themes/ui-lightness/jquery-ui.min.css', $config['supported_assets']['jqueryui']['css']);
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
	 * Check if asf_layout.supported_assets.select2.js exists
	 */
	public function testSelect2JsPathParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayHasKey('js', $config['supported_assets']['select2']);
	}
	
	/**
	 * Check asf_layout.supported_assets.select2.js default value
	 */
	public function testSelect2JsParameterValueInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertEquals('%kernel.root_dir%/../vendor/select2/select2/dist/js/select2.full.min.js', $config['supported_assets']['select2']['js']);
	}
	
	/**
	 * Check if asf_layout.supported_assets.select2.css exists
	 */
	public function testSelect2CssPathParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayHasKey('css', $config['supported_assets']['select2']);
	}
	
	/**
	 * Check asf_layout.supported_assets.select2.css default value
	 */
	public function testSelect2CssParameterValueInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertEquals('%kernel.root_dir%/../vendor/select2/select2/dist/css/select2.min.css', $config['supported_assets']['select2']['css']);
	}
	
	/**
	 * Check if asf_layout.supported_assets.bazinga_js_translator exists
	 */
	public function testBazingaJsTranslationParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayHasKey('bazinga_js_translator', $config['supported_assets']);
	}
	
	/**
	 * Check if asf_layout.supported_assets.pazinga_js_translation.bz_translator_js exists
	 */
	public function testBazingaJsTranslationBzTranslatorJsParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayHasKey('bz_translator_js', $config['supported_assets']['bazinga_js_translator']);
	}
	
	/**
	 * Check asf_layout.supported_assets.bazinga_js_translator.bz_translator_js default value
	 */
	public function testBazingaJsTranslationBzTranslatorJsParameterValueInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertEquals('bundles/bazingajstranslation/js/translator.min.js', $config['supported_assets']['bazinga_js_translator']['bz_translator_js']);
	}
	
	/**
	 * Check if asf_layout.supported_assets.bazinga_js_translation.bz_translator_config exists
	 */
	public function testBazingaJsTranslationBzTranslatorConfigParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayHasKey('bz_translator_config', $config['supported_assets']['bazinga_js_translator']);
	}
	
	/**
	 * Check asf_layout.supported_assets.bazinga_js_translator.bz_translator_config default value
	 */
	public function testBazingaJsTranslationBzTranslatorConfigParameterValueInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertEquals("js/translations/config.js", $config['supported_assets']['bazinga_js_translator']['bz_translator_config']);
	}
	
	/**
	 * Check if asf_layout.supported_assets.bazinga_js_translation.bz_translations_files exists
	 */
	public function testBazingaJsTranslationBzTranslationFilesParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayHasKey('bz_translations_files', $config['supported_assets']['bazinga_js_translator']);
	}
	
	/**
	 * Check asf_layout.supported_assets.bazinga_js_translator.bz_translations_files default value
	 */
	public function testBazingaJsTranslationBzTranslationsFilesParameterValueInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertEquals("js/translations/*/*.js", $config['supported_assets']['bazinga_js_translator']['bz_translations_files']);
	}
	
	/**
	 * Check if asf_layout.supported_assets.speaking_url exists
	 */
	public function testSpeakingURLParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayHasKey('speaking_url', $config['supported_assets']);
	}
	
	/**
	 * Check if asf_layout.supported_assets.speaking_url.path exists
	 */
	public function testSpeakingURLPathParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayHasKey('path', $config['supported_assets']['speaking_url']);
	}
	
	/**
	 * Check asf_layout.supported_assets.speaking_url.path default value
	 */
	public function testSpeakingURLPathParameterValueInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertEquals('%kernel.root_dir%/../vendor/pid/speakingurl/speakingurl.min.js', $config['supported_assets']['speaking_url']['path']);
	}
	
	/**
	 * Check if asf_layout.supported_assets.fos_js_routing exists
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
	    $this->assertTrue($config['supported_assets']['fos_js_routing']);
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