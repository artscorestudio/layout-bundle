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

use Symfony\Bundle\FrameworkBundle\Console\Application;
use ASF\LayoutBundle\Command\InstallFontsCommand;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Install Command Unit Tests
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class InstallFontsCommandTest extends KernelTestCase
{
    /**
     * Test the command for copy fonts (Glyphicons) in web folder
     */
    public function testExecute()
    {
        $kernel = $this->createKernel();
        $kernel->boot();
        
        $application = new Application($kernel);
        $application->add(new InstallFontsCommand());
        
        $command = $application->find('asf:twbs:fonts:install');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array('command' => $command->getName()));
        
        $this->assertRegExp('/\[OK\] Twitter Bootstrap Glyphicons icons was successfully created./', $commandTester->getDisplay());
    }
}