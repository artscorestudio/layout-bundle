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

use ASF\CoreBundle\DependencyInjection\ASFExtension;
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
class ASFLayoutExtension extends ASFExtension implements PrependExtensionInterface
{
	/**
	 * {@inheritDoc}
	 * @see \Symfony\Component\DependencyInjection\Extension\ExtensionInterface::load()
	 */
	public function load(array $configs, ContainerBuilder $container)
	{
		$configuration = new Configuration();
		$config = $this->processConfiguration($configuration, $configs);

		$this->mapsParameters($container, $this->getAlias(), $config);
		
		$loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
		
		if ( count($config['supports']) > 0 ) {
			$loader->load('services/supports.xml');
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
		
		if ( array_key_exists('AsseticBundle', $bundles) && count($config['supports']) > 0 ) {
			$this->configureSupportsBundle($container, $config);
		}
	}
	
	/**
	 * Add assets to Assetic Bundle
	 * 
	 * @param ContainerBuilder $container
	 * @param array $config
	 */
	public function configureSupportsBundle(ContainerBuilder $container, array $config)
	{
		foreach(array_keys($container->getExtensions()) as $name) {
			switch($name) {
				case 'twig':
					// Add supports assets list in twig variables
					$container->prependExtensionConfig($name, array(
						'globals' => array(
							'asf_layout_supports' => $config['supports']
						)
					));
					break;
				case 'assetic':
					// Add jQuery in assets
    				if ( isset($config['supports']['jquery']) && true === $config['supports']['jquery'] && isset($config['jquery_config']['path']) && true === $this->checkPath($config['jquery_config']['path'], $container) ) {
    					
    					$container->prependExtensionConfig($name, array(
    						'assets' => array(
    							'jquery' => $config['jquery_config']['path']
    						)
    					));
    					
    				} elseif ( isset($config['supports']['jquery']) && true === $config['supports']['jquery'] && (!isset($config['jquery_config']['path']) || empty($config['jquery_config']['path']) || false === $this->checkPath($config['jquery_config']['path'], $container) )  ) {
    					throw new InvalidConfigurationException('You have enabled the support of jQuery but you do not specify the path to the file or the file is not reachable.');
    				}
					break;
			}
		}
	}
}