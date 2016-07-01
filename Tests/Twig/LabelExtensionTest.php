<?php
/**
 * This file is part of Artscore Studio Framework package.
 * 
 * (c) 2012-2014 Nicolas Claverie <info@artscore-studio.fr>
 * 
 * This dource file is subject to the MIT Licence that is bundled 
 * with this source code in the file LICENSE.
 */

namespace ASF\LayoutBundle\Tests\Twig;

use ASF\LayoutBundle\Twig\LabelExtension;

/**
 * LabelExtensionTest.
 *
 * @category   TwigExtension
 *
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2012-2013 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 *
 * @link       http://bootstrap.braincrafted.com Bootstrap for Symfony2
 */
class LabelExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var BootstrapLabelExtension
     */
    protected $extension;

    /**
     */
    public function setUp()
    {
        $this->extension = new LabelExtension();
    }

    /**
     * @covers ASF\LayoutBundle\Twig\LabelExtension::getFunctions()
     */
    public function testGetFunctions()
    {
        $this->assertCount(6, $this->extension->getFunctions());
    }

    /**
     * @covers ASF\LayoutBundle\Twig\LabelExtension::labelFunction
     */
    public function testLabelFunction()
    {
        $this->assertEquals(
            '<span class="label label-default">Hello World</span>',
            $this->extension->labelFunction('Hello World'),
            '->labelFunction() returns the HTML code for the given label.'
            );

        $this->assertEquals(
            '<span class="label label-success">Hello World</span>',
            $this->extension->labelFunction('Hello World', 'success'),
            '->labelFunction() returns the HTML code for the given success label.'
            );
    }
    /**
     * @covers ASF\LayoutBundle\Twig\LabelExtension::labelSuccessFunction
     */
    public function testLabelSuccessFunction()
    {
        $this->assertEquals(
            '<span class="label label-success">Foobar</span>',
            $this->extension->labelSuccessFunction('Foobar')
            );
    }
    /**
     * @covers ASF\LayoutBundle\Twig\LabelExtension::labelWarningFunction
     */
    public function testLabelWarningFunction()
    {
        $this->assertEquals(
            '<span class="label label-warning">Foobar</span>',
            $this->extension->labelWarningFunction('Foobar')
            );
    }
    /**
     * @covers ASF\LayoutBundle\Twig\LabelExtension::labelDangerFunction
     */
    public function testLabelDangerFunction()
    {
        $this->assertEquals(
            '<span class="label label-danger">Foobar</span>',
            $this->extension->labelDangerFunction('Foobar')
            );
    }
    /**
     * @covers ASF\LayoutBundle\Twig\LabelExtension::labelInfoFunction
     */
    public function testLabelInfoFunction()
    {
        $this->assertEquals(
            '<span class="label label-info">Foobar</span>',
            $this->extension->labelInfoFunction('Foobar')
            );
    }
    
    /**
     * @covers ASF\LayoutBundle\Twig\LabelExtension::labelPrimaryFunction
     */
    public function testLabelPrimaryFunction()
    {
        $this->assertEquals(
            '<span class="label label-primary">Foobar</span>',
            $this->extension->labelPrimaryFunction('Foobar')
            );
    }

    /**
     * @covers ASF\LayoutBundle\Twig\LabelExtension::getName()
     */
    public function testGetName()
    {
        $this->assertEquals('asf_layout_twbs_label', $this->extension->getName());
    }
}
