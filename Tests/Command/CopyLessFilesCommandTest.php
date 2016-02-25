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
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * Copy Less Files Command Unit Tests
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 * @covers ASF\LayoutBundle\Command\CopyLessFilesCommand
 */
class CopyLessFilesCommandTest extends \PHPUnit_Framework_TestCase
{
    const FIXTURES_DIR = __DIR__ . '/Fixtures';
    
    /**
     * {@inheritDoc}
     * @see PHPUnit_Framework_TestCase::tearDown()
     */
    public function tearDown()
    {
        if ( true === file_exists(self::FIXTURES_DIR.'/Resources/') ) {
            array_map('unlink', glob(self::FIXTURES_DIR.'/Resources/public/twbs/*.less'));
            rmdir(self::FIXTURES_DIR.'/Resources/public/twbs/');
            rmdir(self::FIXTURES_DIR.'/Resources/public/');
            rmdir(self::FIXTURES_DIR.'/Resources/');
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
    
        $command = new CopyLessFilesCommand();
        $command->setContainer($container);
        
        $application->add($command);
        
        return new CommandTester($application->find('asf:twbs:less:copy'));
    }
    
    /**
     * Test the command for copy less files in custom bundle
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
                    'fonts_dir' => self::FIXTURES_DIR.'/web',
                    'customize' => array(
                        'less' => array(
                            'dest_dir' => self::FIXTURES_DIR."/Resources/public/twbs",
                            'files' => ["bootstrap.less"]
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
        
        $this->assertRegExp('/\[OK\] Twitter Bootstrap less files was successfully copied./', $commandTester->getDisplay());
    }
    
    /**
     * Test with an invalid path to the Twitter Bootstrap path
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
        
        $this->assertRegExp('/Did you install Twitter Bootstrap ?/', $commandTester->getDisplay());
    }
    
    /**
     * Test with an no target directory specified
     */
    public function testExecuteWithNoTargetDirectorySpecified()
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
    
        $this->assertRegExp('/Target directory not specified./', $commandTester->getDisplay());
    }
    
    /**
     * Test with an error raised "Could not create directory" 
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
                    'fonts_dir' => self::FIXTURES_DIR.'/web/fonts',
                    'customize' => array(
                        'less' => array(
                            'dest_dir' => '',
                            'files' => array('bootstrap.less')
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
    
        $this->assertRegExp('/Could not create directory/', $commandTester->getDisplay());
    }
}