<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\LayoutBundle\Composer;

use Composer\Script\CommandEvent;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\PhpExecutableFinder;

/**
 * ScriptHandler
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class ScriptHandler
{
    /**
     * Composer variables are declared static so that an event could update
     * a composer.json and set new options, making them immediately available
     * to forthcoming listeners.
     */
    protected static $options = array(
        'symfony-app-dir' => 'app',
        'symfony-web-dir' => 'web',
        'symfony-bin-dir' => 'bin',
        'symfony-assets-install' => 'hard'
    );
    
    public static function install(CommandEnvent $event)
    {
        $options = self::getOptions($event);
        $consolePathOptionsKey = array_key_exists('symfony-bin-dir', $options) ? 'symfony-bin-dir' : 'symfony-app-dir';
        $consolePath = $options[$consolePathOptionsKey];
        
        if (!is_dir($consolePath)) {
            printf(
                'The %s (%s) specified in composer.json was not found in %s, can not build bootstrap file.%s',
                $consolePathOptionsKey,
                $consolePath,
                getcwd(),
                PHP_EOL
                );
            return;
        }
        
        static::executeCommand($event, $consolePath, 'asf:bootstrap:install', $options['process-timeout']);
    }
    
    /**
     * @param CommandEvent $event
     * @param string       $consolePath
     * @param string       $cmd
     * @param number       $timeout
     * @throws \RuntimeException
     */
    public static function executeCommand(CommandEvent $event, $consolePath, $cmd, $timeout = 300)
    {
        $php = escapeshellarg(self::getPhp(false));
        $console = escapeshellarg($consolePath.'/console');
        if ( $event->getID()->isDecorated() )
            $console .= ' --ansi';
        
        $process = new Process($php.' '.$console.' '.$cmd, null, null, null, $timeout);
        $process->run(function($type, $buffer) {
            echo $buffer;
        });
        
        if ( !$process->isSuccessful() ) {
            throw new \RuntimeException(sprintf('An error occured when executing the "%s" command.', escapeshellarg($cmd)));
        }
    }
    
    protected static function getOptions(CommandEvent $event)
    {
        $options = array_merge(static::$options, $event->getComposer()->getPackage()->getExtra());
    
        $options['symfony-assets-install'] = getenv('SYMFONY_ASSETS_INSTALL') ?: $options['symfony-assets-install'];
    
        $options['process-timeout'] = $event->getComposer()->getConfig()->get('process-timeout');
    
        return $options;
    }
    
    /**
     * @param string $includeArgs
     * @throws \RuntimeException
     */
    protected static function getPhp($includeArgs = true)
    {
        $phpFinder = new PhpExecutableFinder();
        if (!$phpPath = $phpFinder->find($includeArgs)) {
            throw new \RuntimeException('The php executable could not be found, add it to your PATH environment variable and try again');
        }

        return $phpPath;
    }
}