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

use ASF\LayoutBundle\Twig\Extension\SupportsExtension;

/**
 * Supoprted assets Twig Extension
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class SupportsTwigExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \ASF\LayoutBundle\Twig\Extension\SupportsExtension
     */
    protected $twigExtension;
    
    /**
     * {@inheritDoc}
     * @see PHPUnit_Framework_TestCase::setUp()
     */
    public function setUp()
    {
        $this->twigExtension = new SupportsExtension();
    }
    
    /**
     * Assert that SupportsExtension have two function declared
     */
    public function testGetFunctions()
    {
        $this->assertCount(2, $this->twigExtension->getFunctions());
    }
    
    /**
     * Test getJavascript function with invalid jquery path
     */
    public function testGetJavascriptsWithInvalidJqueryPath()
    {
        $this->setExpectedException('Symfony\Component\Config\Definition\Exception\InvalidConfigurationException');
        $supported_assets = array(
            'jquery' => array(
                'path' => '/path/jquery.min.js'
            )
        );
        $enable_assetic_support = true;
        
        $this->twigExtension->setSupportedAssets($supported_assets, $enable_assetic_support);
        $this->twigExtension->getJavascripts();
    }
    
    /**
     * Test getJavascript function with invalid jquery UI  js path
     */
    public function testGetJavascriptsWithInvalidJqueryUIJsPath()
    {
        $this->setExpectedException('Symfony\Component\Config\Definition\Exception\InvalidConfigurationException');
        $supported_assets = array(
            'jquery' => array(
                'path' => "%kernel.root_dir%/../vendor/components/jquery/jquery.min.js"
            ),
            'jqueryui' => array(
                'js' => '/path/jqueryui.min.js'
            )
        );
        $enable_assetic_support = true;
    
        $this->twigExtension->setSupportedAssets($supported_assets, $enable_assetic_support);
        $this->twigExtension->getJavascripts();
    }
    
    /**
     * Test getStylesheets function with invalid jquery UI css path
     */
    public function testGetStylesheetsWithInvalidJqueryUICssPath()
    {
        $this->setExpectedException('Symfony\Component\Config\Definition\Exception\InvalidConfigurationException');
        $supported_assets = array(
            'jqueryui' => array(
                'css' => '/path/jqueryui.min.css'
            )
        );
        $enable_assetic_support = true;
    
        $this->twigExtension->setSupportedAssets($supported_assets, $enable_assetic_support);
        $this->twigExtension->getStylesheets();
    }
}