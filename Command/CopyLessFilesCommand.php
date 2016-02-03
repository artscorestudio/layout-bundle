<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\LayoutBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\Console\Command\Command;

/**
 * Copy Less Files Command
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class CopyLessFilesCommand extends ContainerAwareCommand
{
    /**
     * @var array
     */
    protected $twbs_config;

    /**
     * {@inheritDoc}
     * @see \Symfony\Component\Console\Command\Command::configure()
     */
    protected function configure()
    {
        $this->setName('asf:twbs:less:copy')
            ->setDescription('Install icons ansd copy principal Twitter Bootstrap files (bootstrap.less, theme.less and variables.less)');
    }
    
    /**
     * {@inheritDoc}
     * @see \Symfony\Component\Console\Command\Command::execute()
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->twbs_config = $this->getContainer()->getParameter('asf_layout.supported_assets')['twbs'];
        
        if ( !isset($this->twbs_config['customize']['less']['dest_dir']) ) {
            $output->writeln(sprintf('<error>Please check bundle\'s documentation for customize Twitter Bootstrap less files.</error>'));
            return;
        }
        
        $dest_dir = $this->twbs_config['customize']['less']['dest_dir'];
        $src_dir = sprintf('%s/%s', $this->twbs_config['assets_dir'], 'less');
        
        $finder = new Finder();
        $fs = new Filesystem();
        
        try {
            if ( !$fs->exists($dest_dir) )
                $fs->mkdir($dest_dir);
        
        } catch (IOException $e) {
            $output->writeln(sprintf('<error>Could not create directory %s.</error>', $dest_dir));
            return;
        }
        
        if (false === file_exists($src_dir)) {
            $output->writeln(sprintf(
                '<error>Fonts directory "%s" does not exist. Did you install Twitter Bootstrap ? '.
                'If you used something other than Composer you need to manually change the path in '.
                '"asf.twbs.assets_dir".</error>',
                $src_dir
                ));
            return;
        }
        
        $finder->files()->in($src_dir);
        $path = $this->generateRelativePath($dest_dir, $src_dir);

        foreach ($finder as $file) {
            $copy = false;
            if ( !isset($this->twbs_config['customize']['less']['files']) ) {
                $copy = true;
            } elseif ( in_array($file->getBaseName(), $this->twbs_config['customize']['less']['files']) ) {
                $copy = true;
            }
            
            $dest = sprintf('%s/%s', $dest_dir, $file->getBaseName());
            
            if ( $copy == true && !$fs->exists($dest)) {
                try {
                    $fs->copy($file, $dest);
                    $this->replacePathInFile('/@import "/', '@import "'.$path, $dest, $this->twbs_config['customize']['less']['files']);
                } catch (IOException $e) {
                    $output->writeln(sprintf('<error>Could not copy %s</error>', $file->getBaseName()));
                    return;
                }
            }
        }

        $output->writeln(sprintf('[OK] Twitter Bootstrap less files was successfully copied.', $dest_dir));
    }
    
    /**
     * Returns the relative path $from to $to.
     * 
     * @see https://github.com/braincrafted/bootstrap-bundle/blob/develop/Util/PathUtil.php
     * 
     * @param string $from
     * @param string $to
     * 
     * @return string
     */
    protected function generateRelativePath($from, $to)
    {
        // some compatibility fixes for Windows paths
        $from = is_dir($from) ? rtrim($from, '\/') . '/' : $from;
        $to   = is_dir($to)   ? rtrim($to, '\/') . '/'   : $to;
        $from = str_replace('\\', '/', $from);
        $to   = str_replace('\\', '/', $to);
        
        $from     = explode('/', $from);
        $to       = explode('/', $to);
        $relPath  = $to;
        
        foreach ($from as $depth => $dir) {
            // find first non-matching dir
            if ($dir === $to[$depth]) {
                // ignore this directory
                array_shift($relPath);
            } else {
                // get number of remaining dirs to $from
                $remaining = count($from) - $depth;
                if ($remaining > 1) {
                    // add traversals up to first matching dir
                    $padLength = (count($relPath) + $remaining - 1) * -1;
                    $relPath = array_pad($relPath, $padLength, '..');
                    break;
                } else {
                    $relPath[0] = './' . $relPath[0];
                }
            }
        }
        
        return implode('/', $relPath);
    }
    
    /**
     * Replace $pattern by $replace in $file
     * 
     * @param string $search
     * @param string $replace
     * @param string $dest
     * @param array  $excluded_files
     */
    protected function replacePathInFile($pattern, $replace, $file, $excluded_files)
    {
        $content = file_get_contents($file);
        $content = preg_replace($pattern, $replace, $content);
        foreach($excluded_files as $filename){
            $content = preg_replace('/'.str_replace('/', '\\/', $replace.$filename).'/', str_replace('/', '', $pattern.$filename), $content);
        }
        file_put_contents($file, $content);
    }
}