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
		$bag = m::mock('Symfony\Component\DependencyInjection\ParameterBag\ParameterBag');
		$bag->shouldReceive('add');
		
		$container = m::mock('Symfony\Component\DependencyInjection\ContainerBuilder');
		$container->shouldReceive('hasExtension')->andReturn(false);
		$container->shouldReceive('addResource');
		$container->shouldReceive('getParameterBag')->andReturn($bag);
		$container->shouldReceive('setDefinition');
		$container->shouldReceive('setParameter');
		
		$this->extension->load(array(), $container);
	}
	
	/**
	 * Test the prepend method in bundle's extension
	 */
	public function testPrependExtension()
	{
		$bundles = $bundles = array(
		    'AsseticBundle' => 'Symfony\Bundle\AsseticBundle\AsseticBundle',
		    'TwigBundle' => 'Symfony\Bundle\TwigBundle\TwigBundle'
		);
		
		$extensions = array(
			'assetic' => array(),
		    'twig' => array()
		);
		
		$container = m::mock('Symfony\Component\DependencyInjection\ContainerBuilder');
		$container->shouldReceive('getParameter')->with('kernel.bundles')->andReturn($bundles);
		$container->shouldReceive('getExtensions')->andReturn($extensions);
		$container->shouldReceive('getExtensionConfig')->andReturn(array());
		$container->shouldReceive('prependExtensionConfig');
		
		$this->extension->prepend($container);
	}
	
	/**
	 * Test preprend method without Twig Bundle enabled - InvalidConfigurationException Exception expected
	 */
	public function testPrependExtensionWithoutTwigBundle()
	{
	    $this->setExpectedException('Symfony\Component\Config\Definition\Exception\InvalidConfigurationException');
	    $bundles = array('AsseticBundle' => 'Symfony\Bundle\AsseticBundle\AsseticBundle');
	    
	    $extensions = array(
	        'assetic' => array()
	    );
	    
	    $container = m::mock('Symfony\Component\DependencyInjection\ContainerBuilder');
	    $container->shouldReceive('getParameter')->with('kernel.bundles')->andReturn($bundles);
	    $container->shouldReceive('getExtensions')->andReturn($extensions);
	    $container->shouldReceive('getExtensionConfig')->andReturn(array());
	    $container->shouldReceive('prependExtensionConfig');
	    
	    $this->extension->prepend($container);
	}
	
	/**
	 * Test preprend method without Twig Bundle enabled - InvalidConfigurationException Exception expected
	 */
	public function testPrependExtensionWithoutAsseticBundle()
	{
	    $this->setExpectedException('Symfony\Component\Config\Definition\Exception\InvalidConfigurationException');
	    $bundles = array('TwigBundle' => 'Symfony\Bundle\TwigBundle\TwigBundle');
	     
	    $extensions = array(
	        'twig' => array()
	    );
	     
	    $container = m::mock('Symfony\Component\DependencyInjection\ContainerBuilder');
	    $container->shouldReceive('getParameter')->with('kernel.bundles')->andReturn($bundles);
	    $container->shouldReceive('getExtensions')->andReturn($extensions);
	    $container->shouldReceive('getExtensionConfig')->andReturn(array());
	    $container->shouldReceive('prependExtensionConfig');
	     
	    $this->extension->prepend($container);
	}
	
	/**
	 * Test jQuery path (empty parameter) - InvalidConfigurationException Exception expected
	 */
	public function testJqueryPathHasEmptyParameter()
	{
		$this->setExpectedException('Symfony\Component\Config\Definition\Exception\InvalidConfigurationException');
		$container = m::mock('Symfony\Component\DependencyInjection\ContainerBuilder');
		$extension = new ASFLayoutExtension();
		$extension->load(array(array(
			'supported_assets' => array(
				'jquery' => array(
				    'path' => ''
				)
			)
		)), $container);
	}
	
	/**
	 * Test jQuery UI configuration css parameter is missing - InvalidConfigurationException Exception expected
	 */
	public function testJqueryUICssPathHasEmptyParameter()
	{
	    $this->setExpectedException('Symfony\Component\Config\Definition\Exception\InvalidConfigurationException');
	    $container = m::mock('Symfony\Component\DependencyInjection\ContainerBuilder');
	    $extension = new ASFLayoutExtension();
	    $extension->load(array(array(
	        'supported_assets' => array(
	            'jqueryui' => array(
	                'js' => "%kernel.root_dir%/../vendor/components/jqueryui/jquery-ui.min.js",
	                'css' => ''
	            )
	        )
	    )), $container);
	}
	
	/**
	 * Test jQuery UI configuration css parameter is missing - InvalidConfigurationException Exception expected
	 */
	public function testJqueryUIJsPathHasEmptyParameter()
	{
	    $this->setExpectedException('Symfony\Component\Config\Definition\Exception\InvalidConfigurationException');
	    $container = m::mock('Symfony\Component\DependencyInjection\ContainerBuilder');
	    $extension = new ASFLayoutExtension();
	    $extension->load(array(array(
	        'supported_assets' => array(
	            'jqueryui' => array(
	                'js' => "",
	                'css' => "%kernel.root_dir%/../vendor/components/jqueryui/themes/ui-lightness/jquery-ui.min.css"
	            )
	        )
	    )), $container);
	}
	
	/**
	 * Test Twitter Bootstrap configuration js parameter is missing - InvalidConfigurationException Exception expected
	 */
	public function testTwbsJsPathHasEmptyParameter()
	{
	    $this->setExpectedException('Symfony\Component\Config\Definition\Exception\InvalidConfigurationException');
	    $container = m::mock('Symfony\Component\DependencyInjection\ContainerBuilder');
	    $extension = new ASFLayoutExtension();
	    $extension->load(array(array(
	        'supported_assets' => array(
	            'twbs' => array(
	                'js' => ""
	            )
	        )
	    )), $container);
	}
	
	/**
	 * Test Twitter Bootstrap less and css files set error
	 */
	public function testTwbsLessAndCSSFilesSet()
	{
	    $this->setExpectedException('Symfony\Component\Config\Definition\Exception\InvalidConfigurationException');
	    $bundles = $bundles = array(
            'AsseticBundle' => 'Symfony\Bundle\AsseticBundle\AsseticBundle',
	        'TwigBundle' => 'Symfony\Bundle\TwigBundle\TwigBundle'
	    );
	    
	    $extensions = array(
	        'assetic' => array(),
	        'twig' => array()
	    );
	    
	    $container = m::mock('Symfony\Component\DependencyInjection\ContainerBuilder');
	    $container->shouldReceive('getParameter')->with('kernel.bundles')->andReturn($bundles);
	    $container->shouldReceive('getExtensions')->andReturn($extensions);
	    $container->shouldReceive('getExtensionConfig')->andReturn(array());
	    $container->shouldReceive('prependExtensionConfig');

	    $this->extension->configureAsseticBundle($container, array(
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
	                'less' => array('/a/path', '/double/path'),
	                'css' => array('another/path', '/path')
	            )
	        )
	    ));
	}
	
	/**
	 * Test Select2 configuration css parameter is missing - InvalidConfigurationException Exception expected
	 */
	public function testSelect2CssPathHasEmptyParameter()
	{
	    $this->setExpectedException('Symfony\Component\Config\Definition\Exception\InvalidConfigurationException');
	    $bundles = $bundles = array(
	        'AsseticBundle' => 'Symfony\Bundle\AsseticBundle\AsseticBundle',
	        'TwigBundle' => 'Symfony\Bundle\TwigBundle\TwigBundle'
	    );
	     
	    $extensions = array(
	        'assetic' => array(),
	        'twig' => array()
	    );
	     
	    $container = m::mock('Symfony\Component\DependencyInjection\ContainerBuilder');
	    $container->shouldReceive('getParameter')->with('kernel.bundles')->andReturn($bundles);
	    $container->shouldReceive('getExtensions')->andReturn($extensions);
	    $container->shouldReceive('getExtensionConfig')->andReturn(array());
	    $container->shouldReceive('prependExtensionConfig');
	    
	    $this->extension->configureAsseticBundle($container, array(
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
	                'less' => array('/a/path', '/double/path'),
	                'css' => array('another/path', '/path')
	            ),
	            'select2' => array(
	                'js' => "%kernel.root_dir%/../vendor/select2/select2/dist/js/select2.full.min.js",
	                'css' => ''
	            )
	        )
	    ));
	}
	
	/**
	 * Test Select2 configuration css parameter is missing - InvalidConfigurationException Exception expected
	 */
	public function testSelect2JsPathHasEmptyParameter()
	{
	    $this->setExpectedException('Symfony\Component\Config\Definition\Exception\InvalidConfigurationException');
	    $bundles = $bundles = array(
	        'AsseticBundle' => 'Symfony\Bundle\AsseticBundle\AsseticBundle',
	        'TwigBundle' => 'Symfony\Bundle\TwigBundle\TwigBundle'
	    );
	    
	    $extensions = array(
	        'assetic' => array(),
	        'twig' => array()
	    );
	    
	    $container = m::mock('Symfony\Component\DependencyInjection\ContainerBuilder');
	    $container->shouldReceive('getParameter')->with('kernel.bundles')->andReturn($bundles);
	    $container->shouldReceive('getExtensions')->andReturn($extensions);
	    $container->shouldReceive('getExtensionConfig')->andReturn(array());
	    $container->shouldReceive('prependExtensionConfig');
	     
	    $this->extension->configureAsseticBundle($container, array(
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
	                'less' => array('/a/path', '/double/path'),
	                'css' => array('another/path', '/path')
	            ),
	            'select2' => array(
	                'js' => "",
	                'css' => "%kernel.root_dir%/../vendor/select2/select2/dist/css/select2.min.css"
	            )
	        )
	    ));
	}
}