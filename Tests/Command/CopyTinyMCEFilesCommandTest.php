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

use ASF\LayoutBundle\Command\CopyTinyMCEFilesCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Copy Less Files Command Unit Tests
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class CopyTinyMCEFilesCommandTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var string
	 */
	protected $fixturesPath;
	
	/**
	 * {@inheritDoc}
	 * @see PHPUnit_Framework_TestCase::setUp()
	 */
	public function setUp()
	{
		$this->fixturesPath = __DIR__.'/Fixtures';
	}
	
    /**
     * {@inheritDoc}
     * @see PHPUnit_Framework_TestCase::tearDown()
     */
    public function tearDown()
    {
        if ( true === file_exists($this->fixturesPath.'/Resources/') ) {
            array_map('unlink', glob($this->fixturesPath.'/Resources/public/tinymce/themes/modern/*.js'));
            array_map('unlink', glob($this->fixturesPath.'/Resources/public/tinymce/*.js'));
            
            if ( true === file_exists($this->fixturesPath.'/Resources/public/tinymce/themes/modern') )
                rmdir($this->fixturesPath.'/Resources/public/tinymce/themes/modern');
            
            if ( true === file_exists($this->fixturesPath.'/Resources/public/tinymce/themes') )
                rmdir($this->fixturesPath.'/Resources/public/tinymce/themes');
            
            rmdir($this->fixturesPath.'/Resources/public/tinymce/');
            rmdir($this->fixturesPath.'/Resources/public/');
            rmdir($this->fixturesPath.'/Resources/');
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
    
        $command = new CopyTinyMCEFilesCommand();
        $command->setContainer($container);
    
        $application->add($command);
    
        return new CommandTester($application->find('asf:tinymce:copy'));
    }
    
    /**
     * @covers ASF\LayoutBundle\Command\CopyTinyMCEFilesCommand
     */
    public function testExecute()
    {
        $container = $this->getMock('Symfony\Component\DependencyInjection\ContainerInterface');
        $container->expects($this->once())
            ->method('getParameter')
            ->with('asf_layout.assets')
            ->willReturn(array(
                'tinymce' => array(
                    'tinymce_dir' => $this->fixturesPath."/vendor/tinymce/tinymce",
                    'js' => "tinymce.min.js",
                    'config' => array(
                        'selector' => '.tinymce-content'
                    ),
                    'customize' => array(
                        'dest_dir' => $this->fixturesPath."/Resources/public/tinymce",
                        'base_url' => '/js/tinymce',
                        'exclude_files' => array()
                    )
                )
            ));
            
        $commandTester = $this->createCommandTester($container);
        $exitCode = $commandTester->execute(array(
            'command' => 'asf:tinymce:copy'
        ), array(
            'decorated' => false,
            'interactive' => false
        ));
    
        $this->assertRegExp('/\[OK\] TinyMCE files was successfully copied./', $commandTester->getDisplay());
    }
    
    /**
     * @covers ASF\LayoutBundle\Command\CopyTinyMCEFilesCommand
     */
    public function testExecuteWithInvalidTinyMCESrcPaths()
    {
        $container = $this->getMock('Symfony\Component\DependencyInjection\ContainerInterface');
        $container->expects($this->once())
            ->method('getParameter')
            ->with('asf_layout.assets')
            ->willReturn(array(
                'tinymce' => array(
                    'tinymce_dir' => $this->fixturesPath."/vendor/tinymce/invalid_tinymce",
                    'js' => "tinymce.min.js",
                    'config' => array(
                        'selector' => '.tinymce-content'
                    ),
                    'customize' => array(
                        'dest_dir' => $this->fixturesPath."/Resources/public/tinymce",
                        'base_url' => '/js/tinymce',
                        'exclude_files' => array()
                    )
                )
            ));
        
        $commandTester = $this->createCommandTester($container);
        $exitCode = $commandTester->execute(array(
            'command' => 'asf:tinymce:copy'
        ), array(
            'decorated' => false,
            'interactive' => false
        ));
    
        $this->assertRegExp('/Did you install TinyMCE ?/', $commandTester->getDisplay());
    }
    
    /**
     * @covers ASF\LayoutBundle\Command\CopyTinyMCEFilesCommand
     */
    public function testExecuteWithErrorCouldNotCreateDirectory()
    {
        $container = $this->getMock('Symfony\Component\DependencyInjection\ContainerInterface');
        $container->expects($this->once())
            ->method('getParameter')
            ->with('asf_layout.assets')
            ->willReturn(array(
                'tinymce' => array(
                    'tinymce_dir' => $this->fixturesPath."/vendor/tinymce/invalid_tinymce",
                    'js' => "tinymce.min.js",
                    'config' => array(
                        'selector' => '.tinymce-content'
                    ),
                    'customize' => array(
                        'dest_dir' => '',
                        'base_url' => '/js/tinymce',
                        'exclude_files' => array()
                    )
                )
            ));
        
        $commandTester = $this->createCommandTester($container);
        $exitCode = $commandTester->execute(array(
            'command' => 'asf:tinymce:copy'
        ), array(
            'decorated' => false,
            'interactive' => false
        ));
        
        $this->assertRegExp('/Could not create directory/', $commandTester->getDisplay());
    }
}