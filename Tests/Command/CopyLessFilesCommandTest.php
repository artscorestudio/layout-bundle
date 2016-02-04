<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\LayoutBundle\Tests\Command;

use ASF\LayoutBundle\Command\CopyLessFilesCommand;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use \Mockery as m;
use Symfony\Component\HttpKernel\Kernel;

/**
 * Copy Less Files Command Unit Tests
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class CopyLessFilesCommandTest extends \PHPUnit_Framework_TestCase
{
    const FIXTURES_DIR = __DIR__ . '/../Fixtures/Command';
    
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    private $container;
    
    /**
     * @var \Symfony\Component\HttpKernel\KernelInterface
     */
    private $kernel;
    
    /**
     * {@inheritDoc}
     * @see PHPUnit_Framework_TestCase::setUp()
     */
    public function setUp()
    {
        $this->container = m::mock('Symfony\Component\DependencyInjection\ContainerInterface');
        
        $this->kernel = m::mock('Symfony\Component\HttpKernel\KernelInterface');
        $this->kernel->shouldReceive('getName')->andReturn('app');
        $this->kernel->shouldReceive('getEnvironment')->andReturn('prod');
        $this->kernel->shouldReceive('isDebug')->andReturn(false);
        $this->kernel->shouldReceive('getContainer')->andReturn($this->container);
    }
    
    /**
     * {@inheritDoc}
     * @see PHPUnit_Framework_TestCase::tearDown()
     */
    public function tearDown()
    {
        if ( true === file_exists(__DIR__.'../Fixtures/Resources/public/supports/twbs') ) {
            unlink(__DIR__.'../Fixtures/Resources/public/supports/twbs');
        }
    }
    
    /**
     * Test the command for copy less fiels in custom bundle
     */
    public function testExecute()
    {
        $this->container
            ->shouldReceive('getParameter')
            ->with('asf_layout.supported_assets')
            ->andReturn(array(
                'twbs' => array(
                    'assets_dir' => self::FIXTURES_DIR."/vendor/components/bootstrap",
                    'fonts_dir' => self::FIXTURES_DIR.'/web',
                    'customize' => array(
                        'less' => array(
                            'dest_dir' => self::FIXTURES_DIR."/Resources/public/twbs",
                            'files' => ["bootstrap.less"]
                        )
                    )
                )
            ));
        
        if (Kernel::VERSION_ID >= 20500) {
            $this->container->shouldReceive('enterScope')->with('request');
            $this->container->shouldReceive('set')->withArgs(
                array(
                    'request',
                    \Mockery::type('Symfony\Component\HttpFoundation\Request'),
                    'request'
                )
                );
        }
        
        $application = new Application($this->kernel);
        $application->add(new CopyLessFilesCommand());
    
        $command = $application->find('asf:twbs:less:copy');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array('command' => $command->getName()));
    
        $this->assertRegExp('/\[OK\] Twitter Bootstrap less files was successfully copied./', $commandTester->getDisplay());
    }
}