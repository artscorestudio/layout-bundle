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
use Symfony\Bundle\AsseticBundle\DependencyInjection\AsseticExtension;
use Symfony\Bundle\TwigBundle\DependencyInjection\TwigExtension;
use FOS\JsRoutingBundle\DependencyInjection\FOSJsRoutingExtension;

/**
 * Bundle's Extension Test Suites
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class ASFLayoutExtensionTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var \ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension
	 */
	private $extension;
	
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
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::load
	 */
	public function testLoadExtension()
	{
		$this->extension->load(array(), $this->getContainer());
	}
	
	/**
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::load
	 */
	public function testWithoutAssets()
	{
	    $config = $this->getDefaultConfig();
	    $config['assets'] = array(
	        'jquery' => false,
	        'twbs' => false,
	        'jqueryui' => false,
	        'select2' => false,
	        'bazinga_js_translation' => false,
	        'speakingurl' => false,
	        'tinymce' => false,
	        'fos_js_routing' => false
	    );
	    
	    $this->extension->load(array($config), $this->getContainer());
	}
	
	/**
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::prepend
	 */
	public function testPrependExtension()
	{	
		$this->extension->prepend($this->getContainer());
	}
	
	/**
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::prepend
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::configureTwigBundle
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::configureAsseticBundle
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::<protected>
	 * 
	 * @expectedException Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
	 */
	public function testPrependExtensionWithoutFOSJsRoutingBundle()
	{
	    $this->setExpectedException('Symfony\Component\Config\Definition\Exception\InvalidConfigurationException');
	    
	    $bundles = array(
    	    'AsseticBundle' => 'Symfony\Bundle\AsseticBundle\AsseticBundle',
    	    'TwigBundle' => 'Symfony\Bundle\TwigBundle\TwigBundle',
    	);
	    
	    $extensions = array(
    		'assetic' => new AsseticExtension(),
    		'twig' => new TwigExtension()
	    );
	    
	    $config = $this->getDefaultConfig();
	    $config['assets']['fos_js_routing'] = true;
	    
	    $container = $this->getContainer($bundles, $extensions, $config);
	    
	    $container->method('getExtensionConfig')->with('asf_layout')->willReturn($config);
	    $this->extension->prepend($container);
	}
	
	/**
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::prepend
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::configureTwigBundle
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::configureAsseticBundle
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::<protected>
	 * 
	 * @expectedException Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
	 */
	public function testJqueryPathHasEmptyParameter()
	{
		$this->setExpectedException('Symfony\Component\Config\Definition\Exception\InvalidConfigurationException');

	    $config = $this->getDefaultConfig();
	    $config['assets']['jquery']['path'] = '';
	    
	    $this->extension->load(array($config), $this->getContainer());
	}
	
	/**
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::prepend
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::configureTwigBundle
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::configureAsseticBundle
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::<protected>
	 * 
	 * @expectedException Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
	 */
	public function testJqueryUICSSPathHasEmptyParameter()
	{
	    $this->setExpectedException('Symfony\Component\Config\Definition\Exception\InvalidConfigurationException');

	    $config = $this->getDefaultConfig();
	    $config['assets']['jqueryui']['css'] = '';
	    
	    $this->extension->load(array($config), $this->getContainer());
	}
	
	/**
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::prepend
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::configureTwigBundle
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::configureAsseticBundle
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::<protected>
	 * 
	 * @expectedException Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
	 */
	public function testJqueryUIJsPathHasEmptyParameter()
	{
	    $this->setExpectedException('Symfony\Component\Config\Definition\Exception\InvalidConfigurationException');

	    $config = $this->getDefaultConfig();
	    $config['assets']['jqueryui']['js'] = '';
	    
	    $this->extension->load(array($config), $this->getContainer());
	}
	
	/**
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::prepend
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::configureTwigBundle
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::configureAsseticBundle
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::<protected>
	 * 
	 * @expectedException Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
	 */
	public function testTwbsAssetsDirHasEmptyParameter()
	{
	    $this->setExpectedException('Symfony\Component\Config\Definition\Exception\InvalidConfigurationException');
	
	    $config = $this->getDefaultConfig();
	    $config['assets']['twbs']['twbs_dir'] = '';
	     
	    $this->extension->load(array($config), $this->getContainer());
	}
	
	/**
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::prepend
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::configureTwigBundle
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::configureAsseticBundle
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::<protected>
	 * 
	 * @expectedException Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
	 */
	public function testTwbsLessAndCSSFilesSet()
	{
	    $this->setExpectedException('Symfony\Component\Config\Definition\Exception\InvalidConfigurationException');

	    $config = $this->getDefaultConfig();
	    $config['assets']['twbs']['css'] = array('/mock/path');
	    
	    $this->extension->configureAsseticBundle($this->getContainer(), $config);
	}
	
	/**
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::prepend
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::configureTwigBundle
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::configureAsseticBundle
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::<protected>
	 * 
	 * @expectedException Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
	 */
	public function testSelect2CssPathHasEmptyParameter()
	{
	    $this->setExpectedException('Symfony\Component\Config\Definition\Exception\InvalidConfigurationException');

	    $config = $this->getDefaultConfig();
	    $config['assets']['select2']['css'] = '';
	    
	    $this->extension->load(array($config), $this->getContainer());
	}
	
	/**
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::prepend
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::configureTwigBundle
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::configureAsseticBundle
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::<protected>
	 * 
	 * @expectedException Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
	 */
	public function testSelect2JsPathHasEmptyParameter()
	{
	    $this->setExpectedException('Symfony\Component\Config\Definition\Exception\InvalidConfigurationException');

	    $config = $this->getDefaultConfig();
	    $config['assets']['select2']['js'] = '';
	    
	    $this->extension->load(array($config), $this->getContainer());
	}
	
	/**
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::prepend
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::configureTwigBundle
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::configureAsseticBundle
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::<protected>
	 * 
	 * @expectedException Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
	 */
	public function testSpeakingURLPathHasEmptyParameter()
	{
	    $this->setExpectedException('Symfony\Component\Config\Definition\Exception\InvalidConfigurationException');

	    $config = $this->getDefaultConfig();
	    $config['assets']['speakingurl']['path'] = '';
	    
	    $this->extension->load(array($config), $this->getContainer());
	}
	
	/**
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::prepend
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::configureTwigBundle
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::configureAsseticBundle
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::<protected>
	 * 
	 * @expectedException Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
	 */
	public function testBazingaJsTranslatorBzTranslatorJsHasEmptyParameter()
	{
	    $this->setExpectedException('Symfony\Component\Config\Definition\Exception\InvalidConfigurationException');

	    $config = $this->getDefaultConfig();
	    $config['assets']['bazinga_js_translation']['bz_translator_js'] = '';
	     
	    $this->extension->load(array($config), $this->getContainer());
	}
	
	/**
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::prepend
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::configureTwigBundle
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::configureAsseticBundle
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::<protected>
	 * 
	 * @expectedException Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
	 */
	public function testBazingaJsTranslatorBzTranslatorConfigHasEmptyParameter()
	{
	    $this->setExpectedException('Symfony\Component\Config\Definition\Exception\InvalidConfigurationException');
	    
	    $config = $this->getDefaultConfig();
	    $config['assets']['bazinga_js_translation']['bz_translator_config'] = '';
	    
	    $this->extension->load(array($config), $this->getContainer());
	}
	
	/**
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::load
	 */
	public function testJqueryUIParameterSetToTrue()
	{
	    $config = $this->getDefaultConfig();
	    $config['assets']['jqueryui'] = true;
	     
	    $this->extension->load(array($config), $this->getContainer());
	}
	
	/**
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::load
	 */
	public function testSelect2ParameterSetToTrue()
	{
	    $config = $this->getDefaultConfig();
	    $config['assets']['select2'] = true;
	
	    $this->extension->load(array($config), $this->getContainer());
	}
	
	/**
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::load
	 */
	public function testBazingaJsTranslatorParameterSetToTrue()
	{
	    $config = $this->getDefaultConfig();
	    $config['assets']['bazinga_js_translation'] = true;
	
	    $this->extension->load(array($config), $this->getContainer());
	}
	
	/**
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::load
	 */
	public function testSpeakingURLParameterSetToTrue()
	{
	    $config = $this->getDefaultConfig();
	    $config['assets']['speakingurl'] = true;
	
	    $this->extension->load(array($config), $this->getContainer());
	}
	
	/**
	 * @covers ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension::load
	 */
	public function testTinyMCEParameterSetToTrue()
	{
	    $config = $this->getDefaultConfig();
	    $config['assets']['tinymce'] = true;
	    
	    $this->extension->load(array($config), $this->getContainer());
	}
	
	/**
	 * Return a mock object of ContainerBuilder
	 * 
	 * @return \Symfony\Component\DependencyInjection\ContainerBuilder
	 */
	protected function getContainer($bundles = null, $extensions = null, $asfLayoutConfig = null)
	{
	    $bag = $this->getMock('Symfony\Component\DependencyInjection\ParameterBag\ParameterBag');
	    $bag->method('add');
	    
	    if ( is_null($bundles) ) {
    	    $bundles = $bundles = array(
    	        'AsseticBundle' => 'Symfony\Bundle\AsseticBundle\AsseticBundle',
    	        'TwigBundle' => 'Symfony\Bundle\TwigBundle\TwigBundle',
    	        'FOSJsRoutingBundle' => 'FOS\JsRoutingBundle\FOSJsRoutingBundle',
    	    );
	    }
	    
	    if ( is_null($extensions) ) {
    	    $extensions = array(
    	        'assetic' => new AsseticExtension(),
    	        'twig' => new TwigExtension(),
    	    	'fos_js_routing' => new FOSJsRoutingExtension(),
    	    );
	    }
	    
	    $container = $this->getMock('Symfony\Component\DependencyInjection\ContainerBuilder');
	    $container->method('getParameter')->with('kernel.bundles')->willReturn($bundles);
	    $container->method('getExtensions')->willReturn($extensions);
	    
	    if ( !is_null($asfLayoutConfig) ) {
		    $container->method('getExtensionConfig')->with('asf_layout')->willReturn($asfLayoutConfig);
	    }
	    
	    $container->method('getExtensionConfig')->willReturn(array());
	    $container->method('prependExtensionConfig');
	    $container->method('setAlias');
	    $container->method('getExtension');
	    
	    $container->method('addResource');
	    $container->method('setParameter');
	    $container->method('getParameterBag')->willReturn($bag);
	    $container->method('setDefinition');
	    $container->method('setParameter');
	    
	    return $container;
	}
	
	/**
	 * Return bundle's default configuration
	 * 
	 * @return array
	 */
	protected function getDefaultConfig()
	{
	    return array(
	        'enable_flash_messages' => true,
	        'assets' => array(
	            'jquery' => array(
	                'path' => "%kernel.root_dir%/../vendor/components/jquery/jquery.min.js"
	            ),
	            'twbs' => array(
	                'twbs_dir' => "%kernel.root_dir%/../vendor/components/bootstrap",
	                'js' => array("%kernel.root_dir%/../vendor/components/bootstrap/js/bootstrap.min.js"),
	                'less' => array(
	                    "%kernel.root_dir%/../vendor/components/bootstrap/less/bootstrap.less",
	                    "%kernel.root_dir%/../vendor/components/bootstrap/less/theme.less"
	                ),
	                'css' => array(),
	                'icon_prefix' => 'glyphicon',
	                'icon_tag' => 'span',
	                'fonts_dir' => '%kernel.root_dir%/../web/fonts',
	                'form_theme' => 'ASFLayoutBundle:Form:fields.html.twig'
	            )
	        )
	    );
	}
}