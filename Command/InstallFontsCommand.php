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
class InstallFontsCommand extends ContainerAwareCommand
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
        $this->setName('asf:twbs:fonts:install')
            ->setDescription('Copy Twitter Bootstrap icons fonts in web directory.');
    }
    
    /**
     * {@inheritDoc}
     * @see \Symfony\Component\Console\Command\Command::execute()
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
    	$assets = $this->getContainer()->getParameter('asf_layout.assets');
        $this->twbs_config = $assets['twbs'];
        
        $dest_dir = $this->twbs_config['fonts_dir'];
        $src_dir = sprintf('%s/%s', $this->twbs_config['twbs_dir'], 'fonts');
        
        $finder = new Finder();
        $fs = new Filesystem();
        
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
                '"asf_layout.twbs.twbs_dir".</error>',
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
        
        $output->writeln(sprintf('[OK] Twitter Bootstrap Glyphicons icons was successfully created.', $dest_dir));
    }
}