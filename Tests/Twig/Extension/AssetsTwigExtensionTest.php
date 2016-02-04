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

/**
 * Supoprted assets Twig Extension
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class AssetsTwigExtensionTest extends \PHPUnit_Framework_TestCase
{   
    /**
     * @var m\Mock|\ASF\LayoutBundle\Twig\Extension\AssetsExtension
     */
    protected $extension;
    
    /**
     * {@inheritDoc}
     * @see PHPUnit_Framework_TestCase::setUp()
     */
    public function setUp()
    {
        $this->extension = new AssetsExtension();
    }
    
    /**
     * Assert that AssetsExtension have two function declared
     */
    public function testGetFunctions()
    {
        $this->assertCount(2, $this->extension->getFunctions());
    }
    
    public function testGetStylesheetsWithDefaultsAssets()
    {
        $this->extension->setSupportedAssets(array(
            'jquery' => 'jquery.min.js',
        ), true);
        
        $this->assertRegExp('/jquery.min.js/', $this->extension->getStylesheets());
    }
    
    /**
     * Test getName returned value
     */
    public function testGetName()
    {
        $this->assertEquals('asf_layout_assets_twig_extension', $this->extension->getName());
    }
}