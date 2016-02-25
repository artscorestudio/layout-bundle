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

use ASF\LayoutBundle\Twig\Extension\BadgeExtension;

/**
 * BadgeExtensionTest
 *
 * @category   TwigExtension
 * @package    BraincraftedBootstrapBundle
 * @subpackage Twig
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2012-2013 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       http://bootstrap.braincrafted.com Bootstrap for Symfony2
 */
class BadgeExtensionTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var ASF\LayoutBundle\Twig\Extension\BadgeExtension
	 */
	protected $extension;
	
	/**
	 * Set Up
	 */
	public function setUp()
	{
		$this->extension = new BadgeExtension();
	}
	
	/**
	 * @covers ASF\LayoutBundle\Twig\Extension\BadgeExtension::getFunctions()
	 */
	public function testGetFunctions()
	{
		$this->assertCount(1, $this->extension->getFunctions());
	}
	
	/**
	 * @covers ASF\LayoutBundle\Twig\Extension\BadgeExtension::badgeFunction
	 */
	public function testBadgeFunction()
	{
		$this->assertEquals(
			'<span class="badge">Hello World</span>',
			$this->extension->badgeFunction('Hello World'),
			'->badgeFunction() returns the HTML code for the given badge.'
		);
	}
	
	/**
	 * @covers ASF\LayoutBundle\Twig\Extension\BadgeExtension::getName()
	 */
	public function testGetName()
	{
		$this->assertEquals('asf_layout_twbs_badge', $this->extension->getName());
	}
}