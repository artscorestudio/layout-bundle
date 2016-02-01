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

use \Mockery as m; 
use ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Bundle's Extension Test Suites
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class ASFLayoutExtensionTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var \AppKernel
	 */
	protected $kernel;
	
	/**
	 * @var \ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension
	 */
	protected $extension;
	
	/**
	 * {@inheritDoc}
	 * @see PHPUnit_Framework_TestCase::setUp()
	 */
	public function setUp()
	{
		parent::setUp();

		$this->extension = new ASFLayoutExtension();
	}
	
	/**
	 * Test the load method in bundle's extension
	 */
	public function testLoadExtension()
	{
		$this->extension->load(array(), $this->getContainer());
	}
	
	/**
	 * Test bundle with jQuery disabled
	 */
	public function testWithoutJquery()
	{
	    $config = $this->getPrependDefaultConfig();
	    $config['supported_assets']['jquery'] = false;
	     
	    $this->extension->load(array($config), $this->getContainer());
	}
	
	/**
	 * Test bundle with jQuery UI disabled
	 */
	public function testWithoutJqueryUI()
	{
	    $config = $this->getPrependDefaultConfig();
	    $config['supported_assets']['jqueryui'] = false;
	
	    $this->extension->load(array($config), $this->getContainer());
	}
	
	/**
	 * Test bundle with Twitter Bootstrap disabled
	 */
	public function testWithoutTwbs()
	{
	    $config = $this->getPrependDefaultConfig();
	    $config['supported_assets']['twbs'] = false;
	
	    $this->extension->load(array($config), $this->getContainer());
	}
	
	/**
	 * Test bundle with Select2 disabled
	 */
	public function testWithoutSelect2()
	{
	    $config = $this->getPrependDefaultConfig();
	    $config['supported_assets']['select2'] = false;
	
	    $this->extension->load(array($config), $this->getContainer());
	}
	
	/**
	 * Test bundle with Bazinga Js Translator disabled
	 */
	public function testWithoutBazingaJsTranslator()
	{
	    $config = $this->getPrependDefaultConfig();
	    $config['supported_assets']['bazinga_js_translator'] = false;
	
	    $this->extension->load(array($config), $this->getContainer());
	}
	
	/**
	 * Test bundle with Speaking URL disabled
	 */
	public function testWithoutSpeakingURL()
	{
	    $config = $this->getPrependDefaultConfig();
	    $config['supported_assets']['speaking_url'] = false;
	
	    $this->extension->load(array($config), $this->getContainer());
	}
	
	/**
	 * Test the prepend method in bundle's extension
	 */
	public function testPrependExtension()
	{	
		$this->extension->prepend($this->getContainer());
	}
	
	/**
	 * Test preprend method without Twig Bundle enabled - InvalidConfigurationException Exception expected
	 */
	public function testPrependExtensionWithoutTwigBundle()
	{
	    $this->setExpectedException('Symfony\Component\Config\Definition\Exception\InvalidConfigurationException');
	    
	    $bundles = array('AsseticBundle' => 'Symfony\Bundle\AsseticBundle\AsseticBundle');
	    $extensions = array('assetic' => array());
	    
	    $this->extension->prepend($this->getContainer($bundles, $extensions));
	}
	
	/**
	 * Test preprend method without Assetic Bundle enabled - InvalidConfigurationException Exception expected
	 */
	public function testPrependExtensionWithoutAsseticBundle()
	{
	    $this->setExpectedException('Symfony\Component\Config\Definition\Exception\InvalidConfigurationException');
	    
	    $bundles = array('TwigBundle' => 'Symfony\Bundle\TwigBundle\TwigBundle');
	    $extensions = array('twig' => array());
	    
	    $this->extension->prepend($this->getContainer($bundles, $extensions));
	}
	
	/**
	 * @expected InvalidConfigurationException : Parameter asf_layout.supported_assets.jquery.path cannot be empty
	 */
	public function testJqueryPathHasEmptyParameter()
	{
		$this->setExpectedException('Symfony\Component\Config\Definition\Exception\InvalidConfigurationException');

	    $config = $this->getDefaultConfig();
	    $config['supported_assets']['jquery']['path'] = '';
	    
	    $this->extension->load(array($config), $this->getContainer());
	}
	
	/**
	 * @expected InvalidConfigurationException : Parameter asf_layout.supported_assets.jqueryui.css cannot be empty
	 */
	public function testJqueryUICSSPathHasEmptyParameter()
	{
	    $this->setExpectedException('Symfony\Component\Config\Definition\Exception\InvalidConfigurationException');

	    $config = $this->getDefaultConfig();
	    $config['supported_assets']['jqueryui']['css'] = '';
	    
	    $this->extension->load(array($config), $this->getContainer());
	}
	
	/**
	 * @expected InvalidConfigurationException : Parameter asf_layout.supported_assets.jqueryui.js cannot be empty
	 */
	public function testJqueryUIJsPathHasEmptyParameter()
	{
	    $this->setExpectedException('Symfony\Component\Config\Definition\Exception\InvalidConfigurationException');

	    $config = $this->getDefaultConfig();
	    $config['supported_assets']['jqueryui']['js'] = '';
	    
	    $this->extension->load(array($config), $this->getContainer());
	}
	
	/**
	 * @expected InvalidConfigurationException : You can't have less files and css files in your Twitter Bootstrap Configuration, choose one.
	 */
	public function testTwbsLessAndCSSFilesSet()
	{
	    $this->setExpectedException('Symfony\Component\Config\Definition\Exception\InvalidConfigurationException');

	    $config = $this->getDefaultConfig();
	    $config['supported_assets']['twbs']['css'] = array('/mock/path');
	    
	    $this->extension->load(array($config), $this->getContainer());
	}
	
	/**
	 * @expected InvalidConfigurationException : Parameter asf_layout.supported_assets.select2.css cannot be empty
	 */
	public function testSelect2CssPathHasEmptyParameter()
	{
	    $this->setExpectedException('Symfony\Component\Config\Definition\Exception\InvalidConfigurationException');

	    $config = $this->getDefaultConfig();
	    $config['supported_assets']['select2']['css'] = '';
	    
	    $this->extension->load(array($config), $this->getContainer());
	}
	
	/**
	 * @expected InvalidConfigurationException : Parameter asf_layout.supported_assets.select2.js cannot be empty
	 */
	public function testSelect2JsPathHasEmptyParameter()
	{
	    $this->setExpectedException('Symfony\Component\Config\Definition\Exception\InvalidConfigurationException');

	    $config = $this->getDefaultConfig();
	    $config['supported_assets']['select2']['js'] = '';
	    
	    $this->extension->load(array($config), $this->getContainer());
	}
	
	/**
	 * @expected InvalidConfigurationException : Parameter asf_layout.supported_assets.speaking_url.path cannot be empty
	 */
	public function testSpeakingURLPathHasEmptyParameter()
	{
	    $this->setExpectedException('Symfony\Component\Config\Definition\Exception\InvalidConfigurationException');

	    $config = $this->getDefaultConfig();
	    $config['supported_assets']['speaking_url']['path'] = '';
	    
	    $this->extension->load(array($config), $this->getContainer());
	}
	
	/**
	 * @expected InvalidConfigurationException : Parameter asf_layout.supported_assets.bazinga_js_translator.bz_translator_js cannot be empty
	 */
	public function testBazingaJsTranslatorBzTranslatorJsHasEmptyParameter()
	{
	    $this->setExpectedException('Symfony\Component\Config\Definition\Exception\InvalidConfigurationException');

	    $config = $this->getDefaultConfig();
	    $config['supported_assets']['bazinga_js_translator']['bz_translator_js'] = '';
	     
	    $this->extension->load(array($config), $this->getContainer());
	}
	
	/**
	 * @expected InvalidConfigurationException : Parameter asf_layout.supported_assets.bazinga_js_translator.bz_translator_config cannot be empty
	 */
	public function testBazingaJsTranslatorBzTranslatorConfigHasEmptyParameter()
	{
	    $this->setExpectedException('Symfony\Component\Config\Definition\Exception\InvalidConfigurationException');
	    
	    $config = $this->getDefaultConfig();
	    $config['supported_assets']['bazinga_js_translator']['bz_translator_config'] = '';
	    
	    $this->extension->load(array($config), $this->getContainer());
	}
	
	/**
	 * Return a mock object of ContainerBuilder
	 * 
	 * @return \Symfony\Component\DependencyInjection\ContainerBuilder
	 */
	protected function getContainer($bundles = null, $extensions = null)
	{
	    $bag = m::mock('Symfony\Component\DependencyInjection\ParameterBag\ParameterBag');
	    $bag->shouldReceive('add');
	    
	    if ( is_null($bundles) ) {
    	    $bundles = $bundles = array(
    	        'AsseticBundle' => 'Symfony\Bundle\AsseticBundle\AsseticBundle',
    	        'TwigBundle' => 'Symfony\Bundle\TwigBundle\TwigBundle'
    	    );
	    }
	    
	    if ( is_null($extensions) ) {
    	    $extensions = array(
    	        'assetic' => array(),
    	        'twig' => array()
    	    );
	    }
	    
	    $container = m::mock('Symfony\Component\DependencyInjection\ContainerBuilder');
	    $container->shouldReceive('getParameter')->with('kernel.bundles')->andReturn($bundles);
	    $container->shouldReceive('getExtensions')->andReturn($extensions);
	    $container->shouldReceive('getExtensionConfig')->andReturn(array());
	    $container->shouldReceive('prependExtensionConfig');
	    
	    $container->shouldReceive('addResource');
	    $container->shouldReceive('setParameter');
	    $container->shouldReceive('hasExtension')->andReturn(false);
	    $container->shouldReceive('getParameterBag')->andReturn($bag);
	    $container->shouldReceive('setDefinition');
	    $container->shouldReceive('setParameter');
	    
	    return $container;
	}
	
	
	/**
	 * Return bundle's default configuration
	 *
	 * @return array
	 */
	protected function getPrependDefaultConfig()
	{
	    return array(
	        'enable_twig_support' => true,
	        'enable_assetic_support' => true,
	        'supported_assets' => array(
	            'jquery' => array(
	                'path' => "%kernel.root_dir%/../vendor/components/jquery/jquery.min.js"
	            ),
	            'jqueryui' => array(
	                'js' => "%kernel.root_dir%/../vendor/components/jqueryui/jquery-ui.min.js",
	                'css' => "%kernel.root_dir%/../vendor/components/jqueryui/themes/ui-lightness/jquery-ui.min.css"
	            ),
	            'twbs' => array(
	                'js' => "[%kernel.root_dir%/../vendor/components/bootstrap/js/bootstrap.min.js]",
	                'less' => "[@ASFLayoutBundle/Resources/public/supports/bootstrap/less/bootstrap.less, @ASFLayoutBundle/Resources/public/supports/bootstrap/less/theme.less]",
	                'css' => "[]"
	            ),
	            'select2' => array(
	                'js' => "%kernel.root_dir%/../vendor/select2/select2/dist/js/select2.full.min.js",
	                'css' => "%kernel.root_dir%/../vendor/select2/select2/dist/css/select2.min.css"
	            ),
	            'bazinga_js_translator' => array(
	                'bz_translator_js' => "%kernel.root_dir%/../web/bundles/bazingajstranslation/js/translator.min.js",
	                'bz_translator_config' => "%kernel.root_dir%/../web/js/translations/config.js",
	                'bz_translations_files' => "%kernel.root_dir%/../web/js/translations/*/*.js"
	            ),
	            'speaking_url' => array(
	                'path' => "%kernel.root_dir%/../vendor/pid/speakingurl/speakingurl.min.js"
	            ),
	            'fos_js_routing' => true
	        )
	    );
	}
	
	/**
	 * Return bundle's default configuration
	 * 
	 * @return array
	 */
	protected function getDefaultConfig()
	{
	    return array(
	        'enable_twig_support' => true,
	        'enable_assetic_support' => true,
	        'supported_assets' => array(
	            'jquery' => array(
	                'path' => "%kernel.root_dir%/../vendor/components/jquery/jquery.min.js"
	            ),
	            'jqueryui' => array(
	                'js' => "%kernel.root_dir%/../vendor/components/jqueryui/jquery-ui.min.js",
	                'css' => "%kernel.root_dir%/../vendor/components/jqueryui/themes/ui-lightness/jquery-ui.min.css"
	            ),
	            'twbs' => array(
	                'js' => array("%kernel.root_dir%/../vendor/components/bootstrap/js/bootstrap.min.js"),
	                'less' => array(
	                    "@ASFLayoutBundle/Resources/public/supports/bootstrap/less/bootstrap.less",
	                    "@ASFLayoutBundle/Resources/public/supports/bootstrap/less/theme.less"
	                ),
	                'css' => array()
	            ),
	            'select2' => array(
	                'js' => "%kernel.root_dir%/../vendor/select2/select2/dist/js/select2.full.min.js",
	                'css' => "%kernel.root_dir%/../vendor/select2/select2/dist/css/select2.min.css"
	            ),
	            'bazinga_js_translator' => array(
	                'bz_translator_js' => "%kernel.root_dir%/../web/bundles/bazingajstranslation/js/translator.min.js",
	                'bz_translator_config' => "%kernel.root_dir%/../web/js/translations/config.js",
	                'bz_translations_files' => "%kernel.root_dir%/../web/js/translations/*/*.js"
	            ),
	            'speaking_url' => array(
	                'path' => "%kernel.root_dir%/../vendor/pid/speakingurl/speakingurl.min.js"
	            ),
	            'fos_js_routing' => true
	        )
	    );
	}
}