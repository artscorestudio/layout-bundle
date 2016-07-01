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

use ASF\LayoutBundle\Twig\FlashMessagesExtension;

/**
 * FlashMessagesExtensionTest.
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 */
class FlashMessagesExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ASF\LayoutBundle\Twig\FlashMessagesExtension
     */
    protected $extension;

    /**
     * Set Up.
     */
    public function setUp()
    {
        $this->extension = new FlashMessagesExtension();
    }

    /**
     * @covers ASF\LayoutBundle\Twig\FlashMessagesExtension::getFunctions()
     */
    public function testGetFunctions()
    {
        $this->assertCount(1, $this->extension->getFunctions());
    }

    /**
     * @covers ASF\LayoutBundle\Twig\FlashMessagesExtension::FlashMessages
     */
    public function testFlashMessages()
    {
    }

    /**
     * @covers ASF\LayoutBundle\Twig\FlashMessagesExtension::getName()
     */
    public function testGetName()
    {
        $this->assertEquals('asf_flash_messages', $this->extension->getName());
    }
}
