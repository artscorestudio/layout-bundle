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
	 * Check if asf_layout.supported_assets.jquery key is set
	 */
	public function testJqueryParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayHasKey('jquery', $config['supported_assets']);
	}
	
	/**
	 * Check if asf_layout.supported_assets.jquery.path key is set
	 */
	public function testJqueryPathParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayHasKey('path', $config['supported_assets']['jquery']);
	}
	
	/**
	 * Check if asf_layout.supported_assets.jquery.path key is set to "%kernel.root_dir%/../vendor/components/jquery/jquery.min.js"
	 */
	public function testJqueryPathParameterValueInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertEquals('%kernel.root_dir%/../vendor/components/jquery/jquery.min.js', $config['supported_assets']['jquery']['path']);
	}
	
	/**
	 * Check if asf_layout.supported_assets.jqueryui key is set
	 */
	public function testJqueryUIParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayHasKey('jqueryui', $config['supported_assets']);
	}
	
	/**
	 * Check if asf_layout.supported_assets.jqueryui.js key is set
	 */
	public function testJqueryUIJsPathParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayHasKey('js', $config['supported_assets']['jqueryui']);
	}
	
	/**
	 * Check if asf_layout.supported_assets.jqueryui.js key is set to "%kernel.root_dir%/../vendor/components/jqueryui/jquery-ui.min.js"
	 */
	public function testJqueryUIJsParameterValueInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertEquals('%kernel.root_dir%/../vendor/components/jqueryui/jquery-ui.min.js', $config['supported_assets']['jqueryui']['js']);
	}
	
	/**
	 * Check if asf_layout.supported_assets.jqueryui.css key is set
	 */
	public function testJqueryUICssPathParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayHasKey('css', $config['supported_assets']['jqueryui']);
	}
	
	/**
	 * Check if asf_layout.supported_assets.jqueryui.css key is set to "%kernel.root_dir%/../vendor/components/jqueryui/themes/ui-lightness/jquery-ui.min.css"
	 */
	public function testJqueryUICssParameterValueInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertEquals('%kernel.root_dir%/../vendor/components/jqueryui/themes/ui-lightness/jquery-ui.min.css', $config['supported_assets']['jqueryui']['css']);
	}
	
	/**
	 * Check if asf_layout.supported_assets.twbs.js key is set
	 */
	public function testTwbsJsPathParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayHasKey('js', $config['supported_assets']['twbs']);
	}
	
	/**
	 * Check if asf_layout.supported_assets.twbs.js key is set to ""%kernel.root_dir%/../vendor/components/bootstrap/js/bootstrap.min.js""
	 */
	public function testTwbsJsParameterValueInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertEquals('%kernel.root_dir%/../vendor/components/bootstrap/js/bootstrap.min.js', $config['supported_assets']['twbs']['js'][0]);
	}
	
	/**
	 * Check if asf_layout.supported_assets.twbs.less key is set 
	 */
	public function testTwbsLessParameterValueInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    
	    $default_values = array(
	        "@ASFLayoutBundle/Resources/public/supports/bootstrap/less/bootstrap.less",
            "@ASFLayoutBundle/Resources/public/supports/bootstrap/less/theme.less"
	    );
	    
	    foreach($config['supported_assets']['twbs']['less'] as $key => $value) {
	        $this->assertEquals($default_values[$key], $value);
	    }
	}
	
	/**
	 * Check if asf_layout.supported_assets.twbs.css key is set
	 */
	public function testTwbsCSSParameterValueInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	     
	    $default_values = array();
	    $this->assertCount(0, $config['supported_assets']['twbs']['css']);
	}
	
	/**
	 * Check if asf_layout.supported_assets.select2.js key is set
	 */
	public function testSelect2JsPathParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayHasKey('js', $config['supported_assets']['select2']);
	}
	
	/**
	 * Check if asf_layout.supported_assets.select2.js key is set to "%kernel.root_dir%/../vendor/select2/select2/dist/js/select2.full.min.js"
	 */
	public function testSelect2JsParameterValueInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertEquals('%kernel.root_dir%/../vendor/select2/select2/dist/js/select2.full.min.js', $config['supported_assets']['select2']['js']);
	}
	
	/**
	 * Check if asf_layout.supported_assets.select2.css key is set
	 */
	public function testSelect2CssPathParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayHasKey('css', $config['supported_assets']['select2']);
	}
	
	/**
	 * Check if asf_layout.supported_assets.select2.css key is set to ""%kernel.root_dir%/../vendor/select2/select2/dist/css/select2.min.css""
	 */
	public function testSelect2CssParameterValueInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertEquals('%kernel.root_dir%/../vendor/select2/select2/dist/css/select2.min.css', $config['supported_assets']['select2']['css']);
	}
	
	/**
	 * Check if asf_layout.supported_assets.pazinga_js_translation.bz_translator_js key is set
	 */
	public function testBazingaJsTranslationBzTranslatorJsParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayHasKey('bz_translator_js', $config['supported_assets']['bazinga_js_translation']);
	}
	
	/**
	 * Check if asf_layout.supported_assets.bazinga_js_translation.bz_translator_js key is set to "%kernel.root_dir%/../web/bundles/bazingajstranslation/js/translator.min.js"
	 */
	public function testBazingaJsTranslationBzTranslatorJsParameterValueInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertEquals('%kernel.root_dir%/../web/bundles/bazingajstranslation/js/translator.min.js', $config['supported_assets']['bazinga_js_translation']['bz_translator_js']);
	}
	
	/**
	 * Check if asf_layout.supported_assets.pazinga_js_translation.bz_translator_config key is set
	 */
	public function testBazingaJsTranslationBzTranslatorConfigParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayHasKey('bz_translator_js', $config['supported_assets']['bz_translator_config']);
	}
	
	/**
	 * Check if asf_layout.supported_assets.bazinga_js_translation.bz_translator_config key is set to "%kernel.root_dir%/../web/js/translations/config.js"
	 */
	public function testBazingaJsTranslationBzTranslatorConfigParameterValueInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertEquals("%kernel.root_dir%/../web/js/translations/config.js", $config['supported_assets']['bazinga_js_translation']['bz_translator_config']);
	}
	
	/**
	 * Check if asf_layout.supported_assets.pazinga_js_translation.bz_translations_files key is set
	 */
	public function testBazingaJsTranslationBzTranslationFilesParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayHasKey('bz_translator_js', $config['supported_assets']['bz_translations_files']);
	}
	
	/**
	 * Check if asf_layout.supported_assets.bazinga_js_translation.bz_translations_files key is set
	 */
	public function testBazingaJsTranslationBzTranslationsFilesParameterValueInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertEquals("%kernel.root_dir%/../web/js/translations/*/*.js", $config['supported_assets']['bazinga_js_translation']['bz_translations_files']);
	}
	
	/**
	 * Check if asf_layout.supported_assets.speaking_url key is set
	 */
	public function testSpeakingURLParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayHasKey('speaking_url', $config['supported_assets']);
	}
	
	/**
	 * Check if asf_layout.supported_assets.speaking_url.path key is set
	 */
	public function testSpeakingURLPathParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayHasKey('path', $config['supported_assets']['speaking_url']);
	}
	
	/**
	 * Check if asf_layout.supported_assets.speaking_url.path key is set to "%kernel.root_dir%/../vendor/pid/speakingurl/speakingurl.min.js"
	 */
	public function testSpeakingURLPathParameterValueInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertEquals('%kernel.root_dir%/../vendor/pid/speakingurl/speakingurl.min.js', $config['supported_assets']['speaking_url']['path']);
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
	
	/**
	 * Check if asf_layout.supported_assets.bazinga_js_translation key is set
	 */
	public function testBazingaJsTranslationParameterInDefaultConfiguration()
	{
	    $processor = new Processor();
	    $config = $processor->processConfiguration(new Configuration(), array());
	    $this->assertArrayHasKey('bazinga_js_translation', $config['supported_assets']);
	}
}