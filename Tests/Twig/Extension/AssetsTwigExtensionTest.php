<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\LayoutBundle\Tests\Twig\Extension;

use ASF\LayoutBundle\Twig\Extension\AssetsExtension;
use ASF\LayoutBundle\DependencyInjection\ASFLayoutExtension;
use \Mockery as m;
use Symfony\Component\Config\Definition\Processor;
use ASF\LayoutBundle\DependencyInjection\Configuration;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Supoprted assets Twig Extension
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class AssetsTwigExtensionTest extends KernelTestCase
{
    /**
     * @var \Twig_Environment
     */
    protected $twig;
    
    /**
     * @var m\Mock|\ASF\LayoutBundle\Twig\Extension\AssetsExtension
     */
    protected $twigExtension;
    
    
    
    /**
     * {@inheritDoc}
     * @see PHPUnit_Framework_TestCase::setUp()
     */
    public function setUp()
    {
        self::bootKernel();
        
        $this->twigExtension = static::$kernel->getContainer()->get('asf_layout.twig.extension.assets');
        $this->twig = static::$kernel->getContainer()->get('templating');
    }
    
    /**
     * Assert that AssetsExtension have two function declared
     */
    public function testGetFunctions()
    {
        $this->assertCount(2, $this->twigExtension->getFunctions());
    }
    
    /**
     * Test getStylesheets function with default configuration values
     */
    public function testGetStylesheetsWithDefaultsAssets()
    {
        $this->assertRegExp('/<link href/', $this->twigExtension->getStylesheets($this->twig));
    }
    
    /**
     * Test getJavascripts function with default configuration values
     */
    public function testGetJavascriptsWithDefaultsAssets()
    {
        $this->assertRegExp('/<script /', $this->twigExtension->getJavascripts($this->twig));
    }
    
    /**
     * Test getName returned value
     */
    public function testGetName()
    {
        $this->assertEquals('asf_layout_assets_twig_extension', $this->twigExtension->getName());
    }
}