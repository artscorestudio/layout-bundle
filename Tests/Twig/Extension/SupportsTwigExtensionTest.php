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
}