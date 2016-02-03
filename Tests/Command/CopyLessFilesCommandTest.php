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
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * Copy Less Files Command Unit Tests
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class CopyLessFilesCommandTest extends KernelTestCase
{
    /**
     * Test the command for copy less fiels in custom bundle
     */
    public function testExecute()
    {
        $kernel = $this->createKernel();
        $kernel->boot();
    
        $application = new Application($kernel);
        $application->add(new CopyLessFilesCommand());
    
        $command = $application->find('asf:twbs:less:copy');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array('command' => $command->getName()));
    
        $this->assertRegExp('/\[OK\] Twitter Bootstrap less files was successfully copied./', $commandTester->getDisplay());
    }
}