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

use ASF\LayoutBundle\Twig\Extension\FormExtension;

/**
 * Manage and display Forms
 *
 * @package BraincraftedBootstrapBundle
 * @subpackage Twig
 * @author Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright 2012-2013 Florian Eckerstorfer
 * @license http://opensource.org/licenses/MIT The MIT License
 * @link http://bootstrap.braincrafted.com Bootstrap for Symfony2
 */
class FormExtensionTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var BootstrapFormExtension
	 */
    protected $extension;
    
    /**
     * Set up
     */
    public function setUp()
    {
        $this->extension = new FormExtension();
    }
    
    /**
     * @covers ASF\LayoutBundle\Twig\Extension\FormExtension::getFunctions()
     */
    public function testGetFunctions()
    {
        $this->assertCount(16, $this->extension->getFunctions());
    }
    
    /**
     * @covers ASF\LayoutBundle\Twig\Extension\FormExtension::setStyle()
     * @covers ASF\LayoutBundle\Twig\Extension\FormExtension::getStyle()
     */
    public function testSetStyleGetStyle()
    {
        $this->extension->setStyle('inline');
        $this->assertEquals('inline', $this->extension->getStyle());
    }
    
    /**
     * @covers ASF\LayoutBundle\Twig\Extension\FormExtension::setColSize()
     * @covers ASF\LayoutBundle\Twig\Extension\FormExtension::getColSize()
     */
    public function testSetColSizeGetColSize()
    {
        $this->extension->setColSize('sm');
        $this->assertEquals('sm', $this->extension->getColSize());
    }
    
    /**
     * @covers ASF\LayoutBundle\Twig\Extension\FormExtension::setWidgetCol()
     * @covers ASF\LayoutBundle\Twig\Extension\FormExtension::getWidgetCol()
     */
    public function testSetWidgetColGetWidgetCol()
    {
        $this->extension->setWidgetCol(5);
        $this->assertEquals(5, $this->extension->getWidgetCol());
    }
    
    /**
     * @covers ASF\LayoutBundle\Twig\Extension\FormExtension::setLabelCol()
     * @covers ASF\LayoutBundle\Twig\Extension\FormExtension::getLabelCol()
     */
    public function testSetLabelColGetLabelCol()
    {
        $this->extension->setLabelCol(4);
        $this->assertEquals(4, $this->extension->getLabelCol());
    }
    
    /**
     * @covers ASF\LayoutBundle\Twig\Extension\FormExtension::setSimpleCol()
     * @covers ASF\LayoutBundle\Twig\Extension\FormExtension::getSimpleCol()
     */
    public function testSetSimpleColGetSimpleCol()
    {
        $this->extension->setSimpleCol(8);
        $this->assertEquals(8, $this->extension->getSimpleCol());
    }
    
    /**
     * @covers ASF\LayoutBundle\Twig\Extension\FormExtension::backupFormSettings()
     * @covers ASF\LayoutBundle\Twig\Extension\FormExtension::restoreFormSettings()
     */
    public function testBackupFormSettingsRestoreFormSettings()
    {
        $this->extension->setStyle('horizontal');
        $this->extension->setColSize('sm');
        $this->extension->setWidgetCol(1);
        $this->extension->setLabelCol(2);
        $this->extension->setSimpleCol(3);
        $this->extension->backupFormSettings();
        $this->extension->setStyle('inline');
        $this->extension->setColSize('lg');
        $this->extension->setWidgetCol(4);
        $this->extension->setLabelCol(5);
        $this->extension->setSimpleCol(6);
        $this->extension->restoreFormSettings();
        $this->assertEquals('horizontal', $this->extension->getStyle());
        $this->assertEquals('sm', $this->extension->getColSize());
        $this->assertEquals(1, $this->extension->getWidgetCol());
        $this->assertEquals(2, $this->extension->getLabelCol());
        $this->assertEquals(3, $this->extension->getSimpleCol());
        // Nothing happens if we try to restore form settings but none exist
        $this->extension->restoreFormSettings();
    }
    
    /**
     * @covers ASF\LayoutBundle\Twig\Extension\FormExtension::getName()
     */
    public function testGetName()
    {
        $this->assertEquals('braincrafted_bootstrap_form', $this->extension->getName());
    }
}