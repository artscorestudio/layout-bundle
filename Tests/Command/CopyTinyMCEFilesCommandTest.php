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
class CopyTinyMCEFilesCommandTest extends \PHPUnit_Framework_TestCase
{
    const FIXTURES_DIR = __DIR__ . '/../Fixtures/Command';
    
    /**
     * @var m\Mock|\Symfony\Component\DependencyInjection\ContainerInterface
     */
    private $container;
    
    /**
     * @var m\Mock|\Symfony\Component\HttpKernel\KernelInterface
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
        $this->kernel->shouldReceive('boot');
        $this->kernel->shouldReceive('getContainer')->andReturn($this->container);
    }
    
    /**
     * {@inheritDoc}
     * @see PHPUnit_Framework_TestCase::tearDown()
     */
    public function tearDown()
    {
        if ( true === file_exists(self::FIXTURES_DIR.'/Resources/') ) {
            array_map('unlink', glob(self::FIXTURES_DIR.'/Resources/public/tinymce/themes/modern/*.js'));
            array_map('unlink', glob(self::FIXTURES_DIR.'/Resources/public/tinymce/*.js'));
            
            if ( true === file_exists(self::FIXTURES_DIR.'/Resources/public/tinymce/themes/modern') )
                rmdir(self::FIXTURES_DIR.'/Resources/public/tinymce/themes/modern');
            
            if ( true === file_exists(self::FIXTURES_DIR.'/Resources/public/tinymce/themes') )
                rmdir(self::FIXTURES_DIR.'/Resources/public/tinymce/themes');
            
            rmdir(self::FIXTURES_DIR.'/Resources/public/tinymce/');
            rmdir(self::FIXTURES_DIR.'/Resources/public/');
            rmdir(self::FIXTURES_DIR.'/Resources/');
        }
    }
    
    /**
     * Test the command for copy less fiels in custom bundle
     */
    public function testExecute()
    {
        $this->container
            ->shouldReceive('getParameter')
            ->with('asf_layout.assets')
            ->andReturn(array(
                'tinymce' => array(
                    'tinymce_dir' => self::FIXTURES_DIR."/vendor/tinymce/tinymce",
                    'js' => "tinymce.min.js",
                    'config' => array(
                        'selector' => '.tinymce-content'
                    ),
                    'customize' => array(
                        'dest_dir' => self::FIXTURES_DIR."/Resources/public/tinymce",
                        'base_url' => '/js/tinymce',
                        'exclude_files' => array()
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
        $application->add(new CopyTinyMCEFilesCommand());
    
        $command = $application->find('asf:tinymce:copy');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array('command' => $command->getName()));
    
        $this->assertRegExp('/\[OK\] TinyMCE files was successfully copied./', $commandTester->getDisplay());
    }
    
    /**
     * Test with an invalid path to the TinyMCE path
     */
    public function testExecuteWithInvalidTinyMCESrcPaths()
    {
        $this->container
            ->shouldReceive('getParameter')
            ->with('asf_layout.assets')
            ->andReturn(array(
                'tinymce' => array(
                    'tinymce_dir' => self::FIXTURES_DIR."/vendor/tinymce/invalid_tinymce",
                    'js' => "tinymce.min.js",
                    'config' => array(
                        'selector' => '.tinymce-content'
                    ),
                    'customize' => array(
                        'dest_dir' => self::FIXTURES_DIR."/Resources/public/tinymce",
                        'base_url' => '/js/tinymce',
                        'exclude_files' => array()
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
        $application->add(new CopyTinyMCEFilesCommand());
    
        $command = $application->find('asf:tinymce:copy');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array('command' => $command->getName()));
    
        $this->assertRegExp('/Did you install TinyMCE ?/', $commandTester->getDisplay());
    }
    
    /**
     * Test with an error raised "Could not create directory" 
     */
    public function testExecuteWithErrorCouldNotCreateDirectory()
    {
        $this->container
            ->shouldReceive('getParameter')
            ->with('asf_layout.assets')
            ->andReturn(array(
                'tinymce' => array(
                    'tinymce_dir' => self::FIXTURES_DIR."/vendor/tinymce/invalid_tinymce",
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
        $application->add(new CopyTinyMCEFilesCommand());
    
        $command = $application->find('asf:tinymce:copy');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array('command' => $command->getName()));
    
        $this->assertRegExp('/Could not create directory/', $commandTester->getDisplay());
    }
}