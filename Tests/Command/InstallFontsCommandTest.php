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

use ASF\LayoutBundle\Command\InstallFontsCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Install Command Unit Tests
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class InstallFontsCommandTest extends \PHPUnit_Framework_TestCase
{
	const FIXTURES_DIR = "{__DIR__}/Fixtures";
	
    /**
     * {@inheritDoc}
     * @see PHPUnit_Framework_TestCase::tearDown()
     */
    public function tearDown()
    {
        if ( true === file_exists(self::FIXTURES_DIR.'/web/') ) {
            array_map('unlink', glob(self::FIXTURES_DIR.'/web/fonts/*.eot'));
            rmdir(self::FIXTURES_DIR.'/web/fonts/');
            rmdir(self::FIXTURES_DIR.'/web/');
        }
    }
    
    /**
     * @param ContainerInterface $container
     * @param Application        $application
     * @return \Symfony\Component\Console\Tester\CommandTester
     */
    private function createCommandTester(ContainerInterface $container, Application $application = null)
    {
        if ( null === $application ) {
            $application = new Application();
        }
    
        $application->setAutoExit(false);
    
        $command = new InstallFontsCommand();
        $command->setContainer($container);
    
        $application->add($command);
    
        return new CommandTester($application->find('asf:twbs:fonts:install'));
    }
    
    /**
     * @covers ASF\LayoutBundle\Command\InstallFontsCommand
     */
    public function testExecute()
    {
        $container = $this->getMock('Symfony\Component\DependencyInjection\ContainerInterface');
        $container->expects($this->once())
            ->method('getParameter')
            ->with('asf_layout.assets')
            ->willReturn(array(
                'twbs' => array(
                    'twbs_dir' => self::FIXTURES_DIR."/vendor/components/bootstrap",
                    'fonts_dir' => self::FIXTURES_DIR.'/web/fonts',
                    'customize' => array(
                        'less' => array(
                            'dest_dir' => self::FIXTURES_DIR."/Resources/public/twbs",
                            'files' => array("bootstrap.less")
                        )
                    )
                )
            ));
            
        $commandTester = $this->createCommandTester($container);
        $exitCode = $commandTester->execute(array(
            'command' => 'asf:twbs:less:copy'
        ), array(
            'decorated' => false,
            'interactive' => false
        ));
        
        $this->assertRegExp('/\[OK\] Twitter Bootstrap Glyphicons icons was successfully created./', $commandTester->getDisplay());
    }
    
    /**
     * @covers ASF\LayoutBundle\Command\InstallFontsCommand
     */
    public function testExecuteWithInvalidTwbsSrcPaths()
    {
        $container = $this->getMock('Symfony\Component\DependencyInjection\ContainerInterface');
        $container->expects($this->once())
            ->method('getParameter')
            ->with('asf_layout.assets')
            ->willReturn(array(
                'twbs' => array(
                    'twbs_dir' => self::FIXTURES_DIR."/vendor/components/invalid_bootstrap",
                    'fonts_dir' => self::FIXTURES_DIR.'/web/fonts'
                )
            ));
        
        $commandTester = $this->createCommandTester($container);
        $exitCode = $commandTester->execute(array(
            'command' => 'asf:twbs:less:copy'
        ), array(
            'decorated' => false,
            'interactive' => false
        ));
        
        $this->assertRegExp('/Did you install Twitter Bootstrap ?/', $commandTester->getDisplay());
    }
    
    /**
     * @covers ASF\LayoutBundle\Command\InstallFontsCommand
     */
    public function testExecuteWithErrorCouldNotCreateDirectory()
    {
        $container = $this->getMock('Symfony\Component\DependencyInjection\ContainerInterface');
        $container->expects($this->once())
            ->method('getParameter')
            ->with('asf_layout.assets')
            ->willReturn(array(
                'twbs' => array(
                    'twbs_dir' => self::FIXTURES_DIR."/vendor/components/invalid_bootstrap",
                    'fonts_dir' => ''
                )
            ));
        
        $commandTester = $this->createCommandTester($container);
        $exitCode = $commandTester->execute(array(
            'command' => 'asf:twbs:less:copy'
        ), array(
            'decorated' => false,
            'interactive' => false
        ));
    
        $this->assertRegExp('/Could not create directory/', $commandTester->getDisplay());
    }
}