<?php
/**
 * This file is part of Artscore Studio Framework package
 * 
 * (c) 2012-2014 Nicolas Claverie <info@artscore-studio.fr>
 * 
 * This dource file is subject to the MIT Licence that is bundled 
 * with this source code in the file LICENSE.
 */
namespace ASF\LayoutBundle\Tests\Twig\Extension;

use ASF\LayoutBundle\Twig\Extension\IconExtension;

/**
 * BootstrapIconExtensionTest
 *
 * This test is only useful if you consider that it will be run by Travis on every supported PHP
 * configuration. We live in a world where should not have too manually test every commit with every
 * version of PHP. And I know exactly that I will commit short array syntax all the time and break
 * compatibility with PHP 5.3
 *
 * @package    BraincraftedBootstrapBundle
 * @subpackage Twig
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2012-2013 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       http://bootstrap.braincrafted.com Bootstrap for Symfony2
 */
class IconExtensionTest extends \PHPUnit_Framework_TestCase
{
	/**
     * @covers ASF\LayoutBundle\Twig\Extension\IconExtension::getFilters()
     */
    public function testGetFilters()
    {
        $this->assertCount(1, $this->getIconExtension()->getFilters());
    }
    
    /**
     * @covers ASF\LayoutBundle\Twig\Extension\IconExtension::getFunctions()
     */
    public function testGetFunctions()
    {
        $this->assertCount(1, $this->getIconExtension()->getFunctions());
    }
    
    /**
     * @covers ASF\LayoutBundle\Twig\Extension\IconExtension::iconFunction
     */
    public function testIconFilter()
    {
        $this->assertEquals(
            '<span class="glyphicon glyphicon-heart"></span>',
            $this->getIconExtension('glyphicon')->iconFunction('heart'),
            '->iconFunction() returns the HTML code for the given icon.'
        );
        $this->assertEquals(
            '<span class="fa fa-heart"></span>',
            $this->getIconExtension('fa')->iconFunction('heart'),
            '->iconFunction() uses the iconPrefix passed into the IconExtension constructor.'
        );
    }
    
    /**
     * @covers ASF\LayoutBundle\Twig\Extension\IconExtension::iconFunction
     */
    public function testIconFilterWithDifferntPrefix()
    {
        $this->assertEquals(
            '<span class="glyphicon glyphicon-heart"></span>',
            $this->getIconExtension('default')->iconFunction('heart', 'glyphicon'),
            '->iconFunction() returns the HTML code for the given icon.'
        );
        $this->assertEquals(
            '<span class="fa fa-heart"></span>',
            $this->getIconExtension('default')->iconFunction('heart', 'fa'),
            '->iconFunction() uses the iconPrefix passed into the IconExtension constructor.'
        );
    }
    
    /**
     * @covers ASF\LayoutBundle\Twig\Extension\IconExtension::parseIconsFilter
     */
    public function testParseIconsFilter()
    {
        $this->assertEquals(
            '<span class="glyphicon glyphicon-heart"></span> foobar',
            $this->getIconExtension('glyphicon')->parseIconsFilter('.icon-heart foobar'),
            '->parseIconsFilter() returns the HTML code with the replaced icons.'
        );
        $this->assertEquals(
            '<span class="fa fa-heart"></span> foobar',
            $this->getIconExtension('fa')->parseIconsFilter('.icon-heart foobar'),
            '->parseIconsFilter() uses the iconPrefix passed into the IconExtension constructor.'
        );
    }
    
    /**
     * @covers ASF\LayoutBundle\Twig\Extension\IconExtension::parseIconsFilter
     */
    public function testParseIconsFilterWithDifferntPrefix()
    {
        $this->assertEquals(
            '<span class="glyphicon glyphicon-heart"></span> foobar',
            $this->getIconExtension('default')->parseIconsFilter('.glyphicon-heart foobar'),
            '->parseIconsFilter() returns the HTML code with the replaced icons.'
        );
        $this->assertEquals(
            '<span class="fa fa-heart"></span> foobar',
            $this->getIconExtension('default')->parseIconsFilter('.fa-heart foobar'),
            '->parseIconsFilter() uses the iconPrefix passed into the IconExtension constructor.'
        );
    }
    
    /**
     * @covers ASF\LayoutBundle\Twig\Extension\IconExtension::getName()
     */
    public function testGetName()
    {
        $this->assertEquals('asf_layout_twbs_icon', $this->getIconExtension()->getName());
    }
    
    /**
     * @param string $iconPrefix
     * @return \ASF\LayoutBundle\Twig\Extension\IconExtension
     */
    private function getIconExtension($iconPrefix = null)
    {
        return new IconExtension($iconPrefix);
    }
}