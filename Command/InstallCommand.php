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

/**
 * Install Command
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class InstallCommand extends ContainerAwareCommand
{
    /**
     * {@inheritDoc}
     * @see \Symfony\Component\Console\Command\Command::configure()
     */
    protected function configure()
    {
        $this->setName('asf:bootstrap:install')
            ->setDescription('Install icons ansd copy principal Twitter Bootstrap files (bootstrap.less, theme.less and variables.less)');
    }
    
    /**
     * {@inheritDoc}
     * @see \Symfony\Component\Console\Command\Command::execute()
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->installFonts($input, $output);
        $this->installLessFiles($input, $output);
        
    }
    
    /**
     * Copy Twitter Bootstrap default fonts in web directory
     * 
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function installFonts(InputInterface $input, OutputInterface $output)
    {
        $dest_dir = $this->getFontsDir();
        $src_dir = sprintf('%s/%s', $this->getContainer()->getParameter('asf.twbs.assets_dir'), 'fonts');
        
        $finder = new Finder();
        $filesystem = new Filesystem();
        
        try {
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
        
        foreach ($finder as $file) {
            $dest = sprintf('%s/%s', $dest_dir, $file->getBaseName());
            try {
                $fs->copy($file, $dest);
            } catch (IOException $e) {
                $output->writeln(sprintf('<error>Could not copy %s</error>', $file->getBaseName()));
                return;
            }
        }
        
        $output->writeln(sprintf('Copied icon fonts to <comment>%s</comment>.', $dest_dir));
    }
    
    /**
     * Copy Twitter Bootstrap Fiels in bundle's Resources/public/support/bootstrap/less directory
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function installLessFiles(InputInterface $input, OutputInterface $output)
    {
        $dest_dir = __DIR__ . '/../ResourceS/public/supports/bootstrap';
        $src_dir = sprintf('%s/%s', $this->getContainer()->getParameter('asf.twbs.assets_dir'), 'less');
        
        $finder = new Finder();
        $filesystem = new Filesystem();
    
        try {
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
    
        foreach ($finder as $file) {
            $dest = sprintf('%s/%s', $dest_dir, $file->getBaseName());
            try {
                $fs->copy($file, $dest);
            } catch (IOException $e) {
                $output->writeln(sprintf('<error>Could not copy %s</error>', $file->getBaseName()));
                return;
            }
        }
    
        $output->writeln(sprintf('Copied less files to <comment>%s</comment>.', $dest_dir));
    }
    
    /**
     * Return the fonts directory configured in bundle's Configuration
     */
    protected function getFontsDir()
    {
        return $this->getContainer()->getParameter('asf_layout.twbs.fonts_dir');
    }
}