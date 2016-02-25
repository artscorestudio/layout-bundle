<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\LayoutBundle\Tests\Session;

use \Mockery as m;
use ASF\LayoutBundle\Session\FlashMessage;

/**
 * Flash Messages Tests
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class FlashMessageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * m\MockInteface|\Symfony\Component\HttpFoundation\Session\SessionInterface
     */
    protected $session;
    
    /**
     * m\MockInteface|\Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface
     */
    protected $flashBag;
    
    /**
     * @var \ASF\LayoutBundle\Session\FlashMessage
     */
    protected $flash;
    
    /**
     * {@inheritDoc}
     * @see PHPUnit_Framework_TestCase::setUp()
     */
    public function setUp()
    {
        $this->flashBag = m::mock('Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface');
        $this->session = m::mock('Symfony\Component\HttpFoundation\Session\SessionInterface');
        $this->session->shouldReceive('getFlashBag')->withNoArgs()->atLeast()->once()->andReturn($this->flashBag);
        $this->flash = new FlashMessage($this->session);
    }
    
    /**
     * @covers ASF\LayoutBundle\Session\FlashMessage::alert
     */
    public function testAlert()
    {
        $this->flashBag->shouldReceive('add')->with('alert', 'Alert Message')->once();
        $this->flash->alert('Alert Message');
    }
    
    /**
     * @covers ASF\LayoutBundle\Session\FlashMessage::success
     */
    public function testSuccess()
    {
        $this->flashBag->shouldReceive('add')->with('success', 'Success Message')->once();
        $this->flash->success('Success Message');
    }
    
    /**
     * @covers ASF\LayoutBundle\Session\FlashMessage::info
     */
    public function testInfo()
    {
        $this->flashBag->shouldReceive('add')->with('info', 'Info Message')->once();
        $this->flash->info('Info Message');
    }
    
    /**
     * @covers ASF\LayoutBundle\Session\FlashMessage::warning
     */
    public function testWarning()
    {
        $this->flashBag->shouldReceive('add')->with('warning', 'Warning Message')->once();
        $this->flash->warning('Warning Message');
    }
    
    /**
     * @covers ASF\LayoutBundle\Session\FlashMessage::danger
     */
    public function testDanger()
    {
        $this->flashBag->shouldReceive('add')->with('danger', 'Danger Message')->once();
        $this->flash->danger('Danger Message');
    }
}