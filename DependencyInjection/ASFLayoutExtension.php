<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\LayoutBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;

/**
 * Bundle extension
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class ASFLayoutExtension extends Extension implements PrependExtensionInterface
{
	/**
	 * {@inheritDoc}
	 * @see \Symfony\Component\DependencyInjection\Extension\ExtensionInterface::load()
	 */
	public function load(array $configs, ContainerBuilder $container)
	{
		$configuration = new Configuration();
		$config = $this->processConfiguration($configuration, $configs);
        
		$loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
		
		if ( $config['enable_twig_support'] == true ) {
		    $loader->load('services/twig.xml');
		    $container->setParameter('asf_layout.supported_assets', $config['supported_assets']);
		}
	}
	
	/**
	 * 
	 * @param ContainerBuilder $container
	 */
	public function prepend(ContainerBuilder $container)
	{
		$bundles = $container->getParameter('kernel.bundles');
		
		$configs = $container->getExtensionConfig($this->getAlias());
		$config = $this->processConfiguration(new Configuration(), $configs);
		
		if ( array_key_exists('AsseticBundle', $bundles) && count($config['supported_assets']) > 0 )
			$this->configureAsseticBundle($container, $config);
		
		if ( !array_key_exists('TwigBundle', $bundles) && $config['enable_twig_support'] == true )
            throw new InvalidConfigurationException('You have enabled the support of Twig but Twig is not enabled.');
	}
	
	/**
	 * Add assets to Assetic Bundle
	 * 
	 * @param ContainerBuilder $container
	 * @param array $config
	 */
	public function configureAsseticBundle(ContainerBuilder $container, array $config)
	{
		foreach(array_keys($container->getExtensions()) as $name) {
			switch($name) {
				case 'assetic':
					// Add jQuery in assets
    				if ( $config['supported_assets']['jquery']['path'] !== false ) {
    					$container->prependExtensionConfig($name, array(
    						'assets' => array(
    							'jquery' => $config['supported_assets']['jquery']['path']
    						)
    					));
    				}
					break;
			}
		}
	}
}