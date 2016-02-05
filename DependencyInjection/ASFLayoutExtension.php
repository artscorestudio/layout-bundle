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
		    $container->setParameter('asf_layout.assets', $config['assets']);
		    $container->setParameter('asf_layout.enable_assetic_support', $config['enable_assetic_support']);
		    $loader->load('services/twig.xml');
		}
		
		if ( $config['enable_flash_messages'] ) {
		    $loader->load('services/session.xml');
		}
	}
	
	/**
	 * {@inheritDoc}
	 * @see \Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface::prepend()
	 */
	public function prepend(ContainerBuilder $container)
	{
		$bundles = $container->getParameter('kernel.bundles');
		
		$configs = $container->getExtensionConfig($this->getAlias());
		$config = $this->processConfiguration(new Configuration(), $configs);
		
		if ( !array_key_exists('FOSJsRoutingBundle', $bundles) && $config['assets']['fos_js_routing'] == true )
		    throw new InvalidConfigurationException('You have enabled the support of FOSJsRouting but it is not enabled. Install it or disable FOSJsRoutingBundle support in Layout bundle.');
		
		if ( !array_key_exists('TwigBundle', $bundles) && $config['enable_twig_support'] == true )
		    throw new InvalidConfigurationException('You have enabled the support of Twig but Twig is not enabled. Install it or disable TwigBundle support in Layout bundle.');
		else 
		    $this->configureTwigBundle($container, $config);
		
        if ( !array_key_exists('AsseticBundle', $bundles) && $config['enable_assetic_support'] == true )
            throw new InvalidConfigurationException('You have enabled the support of Assetic but Assetic is not enabled. Please install symfony/assetic-bundle.');
		
		if ( array_key_exists('AsseticBundle', $bundles) && count($config['assets']) > 0 && $config['enable_assetic_support'] == true )
			$this->configureAsseticBundle($container, $config);
	}
	
	/**
	 * Configure twig bundle
	 * 
	 * @param ContainerBuilder $container
	 * @param array $config
	 */
	public function configureTwigBundle(ContainerBuilder $container, array $config)
	{
	    foreach(array_keys($container->getExtensions()) as $name) {
	        switch($name) {
	            case 'twig':
	                if ( isset($config['assets']['twbs']['form_theme']) &&  $config['assets']['twbs']['form_theme'] !== false ) {
	                    $container->prependExtensionConfig($name, array(
	                        'form_themes' => array(
	                            'resources' => $config['assets']['twbs']['form_theme']
	                        )
	                    ));
	                }
	                break;
	        }
	    }
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
    				if ( $config['assets']['jquery']['path'] !== false ) {
    					$container->prependExtensionConfig($name, array(
    						'assets' => array(
    							'jquery' => $config['assets']['jquery']['path']
    						)
    					));
    				}
    				
    				// Add jQuery UI in assets
    				if ( isset($config['assets']['jqueryui']) && $config['assets']['jqueryui']['js'] !== false && $config['assets']['jqueryui']['css'] !== false) {
    				    $container->prependExtensionConfig($name, array(
    				        'assets' => array(
    				            'jqueryui_js' => $config['assets']['jqueryui']['js'],
    				            'jqueryui_css' => $config['assets']['jqueryui']['css']
    				        )
    				    ));
    				} elseif ( isset($config['assets']['jqueryui']) && $config['assets']['jqueryui']['js'] === false && $config['assets']['jqueryui']['css'] !== false ) {
    				    throw new InvalidConfigurationException('You have enabled jQuery UI supports but js parameter is missing.');
    				} elseif ( isset($config['assets']['jqueryui']) && $config['assets']['jqueryui']['js'] !== false && $config['assets']['jqueryui']['css'] === false ) {
    				    throw new InvalidConfigurationException('You have enabled jQuery UI supports but css parameter is missing.');
    				}
    				
    				// Add Twitter Bootstrap assets
    				if ( count($config['assets']['twbs']) > 0 ) {
                        
    				    $twbs = $config['assets']['twbs'];
    				    
    				    // Twitter Bootstrap javascript files
    				    $container->prependExtensionConfig($name, array(
    				        'assets' => array(
    				            'twbs_js' => array(
    				                'inputs' => $twbs['js']
    				            )
    				        )
    				    ));
    				    
    				    // Twitter Bootstrap Less files or CSS files
    				    if ( count($twbs['less']) > 0 && ($twbs['css'] != false && count($twbs['css']) > 0) )
    				        throw new InvalidConfigurationException('You can\'t have less files and css files in your Twitter Bootstrap Configuration, choose one.');
    				    elseif ( count($twbs['less']) > 0 && count($twbs['css']) == 0 ) {

        				    $container->prependExtensionConfig($name, array(
        				        'assets' => array(
        				            'twbs_css' => array(
        				                'inputs' => $twbs['less']
        				            )
        				        )
        				    ));
    				    } elseif ( count($twbs['less']) == 0 && count($twbs['css']) > 0 ) {
    				        $container->prependExtensionConfig($name, array(
    				            'assets' => array(
    				                'twbs_css' => array(
    				                    'inputs' => $twbs['css']
    				                )
    				            )
    				        ));
    				    }
    				}
    				
    				// Add select2 files
    				if ( isset($config['assets']['select2']) && $config['assets']['select2']['js'] !== false && $config['assets']['select2']['css'] !== false) {
    				    $container->prependExtensionConfig($name, array(
    				        'assets' => array(
    				            'select2_js' => $config['assets']['select2']['js'],
    				            'select2_css' => $config['assets']['select2']['css']
    				        )
    				    ));
    				} elseif ( isset($config['assets']['select2']) && $config['assets']['select2']['js'] === false && $config['assets']['select2']['css'] !== false ) {
    				    throw new InvalidConfigurationException('You have enabled select2 supports but js parameter is missing.');
    				} elseif ( isset($config['assets']['select2']) && $config['assets']['select2']['js'] !== false && $config['assets']['select2']['css'] === false ) {
    				    throw new InvalidConfigurationException('You have enabled select2 supports but css parameter is missing.');
    				}
    				
    				// Add Basinga js translation in assets
    				if ( isset($config['assets']['bazinga_js_translator']) && $config['assets']['bazinga_js_translator'] !== false ) {
    				    $bz_config = $config['assets']['bazinga_js_translator'];
    				    $container->prependExtensionConfig($name, array(
    				        'assets' => array(
    				            'bz_translator_js' => $bz_config['bz_translator_js'],
    				            'bz_translator_config' => $bz_config['bz_translator_config'],
    				            'bz_translations_files' => $bz_config['bz_translations_files']
    				        )
    				    ));
    				}
    				
    				// Add Speaking URL in assets
    				if ( isset($config['assets']['speaking_url']) && $config['assets']['speaking_url']['path'] !== false ) {
    				    $container->prependExtensionConfig($name, array(
    				        'assets' => array(
    				            'speakingurl_js' => $config['assets']['speaking_url']['path']
    				        )
    				    ));
    				}
    				
					break;
			}
		}
	}
}