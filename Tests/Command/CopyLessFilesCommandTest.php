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
 * Copy Less Files Command Unit Tests.
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 */
class CopyLessFilesCommandTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    protected $fixturesPath;

    /**
     * {@inheritdoc}
     *
     * @see PHPUnit_Framework_TestCase::setUp()
     */
    public function setUp()
    {
        $this->fixturesPath = __DIR__.'/Fixtures';
    }

    /**
     * {@inheritdoc}
     *
     * @see PHPUnit_Framework_TestCase::tearDown()
     */
    public function tearDown()
    {
        if (true === file_exists($this->fixturesPath.'/Resources/')) {
            array_map('unlink', glob($this->fixturesPath.'/Resources/public/twbs/*.less'));
            rmdir($this->fixturesPath.'/Resources/public/twbs/');
            rmdir($this->fixturesPath.'/Resources/public/');
            rmdir($this->fixturesPath.'/Resources/');
        }
    }

    /**
     * @param ContainerInterface $container
     * @param Application        $application
     *
     * @return \Symfony\Component\Console\Tester\CommandTester
     */
    private function createCommandTester(ContainerInterface $container, Application $application = null)
    {
        if (null === $application) {
            $application = new Application();
        }

        $application->setAutoExit(false);

        $command = new CopyLessFilesCommand();
        $command->setContainer($container);

        $application->add($command);

        return new CommandTester($application->find('asf:twbs:less:copy'));
    }

    /**
     * @covers ASF\LayoutBundle\Command\CopyLessFilesCommand
     */
    public function testExecute()
    {
        $container = $this->getMock('Symfony\Component\DependencyInjection\ContainerInterface');
        $container->expects($this->once())
            ->method('getParameter')
            ->with('asf_layout.assets')
            ->willReturn(array(
                'twbs' => array(
                    'twbs_dir' => $this->fixturesPath.'/vendor/components/bootstrap',
                    'fonts_dir' => $this->fixturesPath.'/web',
                    'customize' => array(
                        'less' => array(
                            'dest_dir' => $this->fixturesPath.'/Resources/public/twbs',
                            'files' => array('bootstrap.less'),
                        ),
                    ),
                ),
            ));

        $commandTester = $this->createCommandTester($container);
        $exitCode = $commandTester->execute(array(
            'command' => 'asf:twbs:less:copy',
        ), array(
            'decorated' => false,
            'interactive' => false,
        ));

        $this->assertRegExp('/\[OK\] Twitter Bootstrap less files was successfully copied./', $commandTester->getDisplay());
    }

    /**
     * @covers ASF\LayoutBundle\Command\CopyLessFilesCommand
     */
    public function testExecuteWithInvalidTwbsSrcPaths()
    {
        $container = $this->getMock('Symfony\Component\DependencyInjection\ContainerInterface');
        $container->expects($this->once())
            ->method('getParameter')
            ->with('asf_layout.assets')
            ->willReturn(array(
                'twbs' => array(
                    'twbs_dir' => $this->fixturesPath.'/vendor/components/invalid_bootstrap',
                    'fonts_dir' => $this->fixturesPath.'/web/fonts',
                    'customize' => array(
                        'less' => array(
                            'dest_dir' => $this->fixturesPath.'/Resources/public/twbs',
                            'files' => array('bootstrap.less'),
                        ),
                    ),
                ),
            ));

        $commandTester = $this->createCommandTester($container);
        $exitCode = $commandTester->execute(array(
            'command' => 'asf:twbs:less:copy',
        ), array(
            'decorated' => false,
            'interactive' => false,
        ));

        $this->assertRegExp('/Did you install Twitter Bootstrap ?/', $commandTester->getDisplay());
    }

    /**
     * @covers ASF\LayoutBundle\Command\CopyLessFilesCommand
     */
    public function testExecuteWithNoTargetDirectorySpecified()
    {
        $container = $this->getMock('Symfony\Component\DependencyInjection\ContainerInterface');
        $container->expects($this->once())
            ->method('getParameter')
            ->with('asf_layout.assets')
            ->willReturn(array(
                'twbs' => array(
                    'twbs_dir' => $this->fixturesPath.'/vendor/components/invalid_bootstrap',
                    'fonts_dir' => $this->fixturesPath.'/web/fonts',
                ),
            ));

        $commandTester = $this->createCommandTester($container);
        $exitCode = $commandTester->execute(array(
            'command' => 'asf:twbs:less:copy',
        ), array(
            'decorated' => false,
            'interactive' => false,
        ));

        $this->assertRegExp('/Target directory not specified./', $commandTester->getDisplay());
    }

    /**
     * @covers ASF\LayoutBundle\Command\CopyLessFilesCommand
     */
    public function testExecuteWithErrorCouldNotCreateDirectory()
    {
        $container = $this->getMock('Symfony\Component\DependencyInjection\ContainerInterface');
        $container->expects($this->once())
            ->method('getParameter')
            ->with('asf_layout.assets')
            ->willReturn(array(
                'twbs' => array(
                    'twbs_dir' => $this->fixturesPath.'/vendor/components/invalid_bootstrap',
                    'fonts_dir' => $this->fixturesPath.'/web/fonts',
                    'customize' => array(
                        'less' => array(
                            'dest_dir' => '',
                            'files' => array('bootstrap.less'),
                        ),
                    ),
                ),
            ));

        $commandTester = $this->createCommandTester($container);
        $exitCode = $commandTester->execute(array(
            'command' => 'asf:twbs:less:copy',
        ), array(
            'decorated' => false,
            'interactive' => false,
        ));

        $this->assertRegExp('/Could not create directory/', $commandTester->getDisplay());
    }
}
