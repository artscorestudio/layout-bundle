<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ASF\LayoutBundle\Tests\Twig;

use ASF\LayoutBundle\Twig\TinyMCEExtension;

/**
 * TinyMCE Extension for generate tinymce init.
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 */
class TinyMCEExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ASF\LayoutBundle\Twig\TinyMCEExtension
     */
    protected $extension;

    /**
     * Set Up.
     */
    public function setUp()
    {
        $this->extension = new TinyMCEExtension(array(
            'tinymce' => array(
                'config' => array('selector' => '.tinymce-content'),
                'customize' => array('base_url' => '/js/tinymce'),
            ),
        ));
    }

    /**
     * @covers ASF\LayoutBundle\Twig\TinyMCEExtension::getFunctions()
     */
    public function testGetFunctions()
    {
        $this->assertCount(1, $this->extension->getFunctions());
    }

    /**
     * @covers ASF\LayoutBundle\Twig\TinyMCEExtension::getName()
     */
    public function testGetName()
    {
        $this->assertEquals('asf_layout_tinymce', $this->extension->getName());
    }
}
