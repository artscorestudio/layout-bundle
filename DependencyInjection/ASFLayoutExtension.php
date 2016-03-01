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
		$loader->load('services/form.xml');
		
		if ( $config['enable_twig_support'] == true ) {
		    $container->setParameter('asf_layout.assets', $config['assets']);
		    $container->setParameter('asf_layout.enable_assetic_support', $config['enable_assetic_support']);
		    $container->setParameter('asf_layout.assets.twbs.icon_prefix', $config['assets']['twbs']['icon_prefix']);
		    $container->setParameter('asf_layout.assets.twbs.icon_tag', $config['assets']['twbs']['icon_tag']);
		    $loader->load('services/twig.xml');
		}
		
		if ( $config['enable_flash_messages'] ) {
		    $loader->load('services/flash_messages.xml');
		}
		
		if ( isset($config['assets']['tinymce']) && $config['assets']['tinymce'] != false ) {
		    $loader->load('services/tinymce.xml');
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
	                        'form_themes' => array($config['assets']['twbs']['form_theme'])
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
    				$this->addJqueryInAssetic($container, $config['assets']['jquery']);
    				
    				// Add Twitter Bootstrap assets
    				$this->addTwbsInAssetic($container, $config['assets']['twbs']);

    				// Add jQuery UI in assets
    				if ( isset($config['assets']['jqueryui']) ) {
    				    $this->addJqueryUIInAssetic($container, $config['assets']['jqueryui']);
    				}
    				
    				// Add select2 files
    				if ( isset($config['assets']['select2']) ) {
    				    $this->addSelect2InAssetic($container, $config['assets']['select2']);
    				}
    				
    				// Add Basinga js translation in assets
    				if ( isset($config['assets']['bazinga_js_translation']) ) {
    				    $this->addBazingaJsTranslationInAssetic($container, $config['assets']['bazinga_js_translation']);
    				}
    				
    				// Add Speaking URL in assets
    				if ( isset($config['assets']['speakingurl']) ) {
    				    $this->addSpeakingURLInAssetic($container, $config['assets']['speakingurl']);
    				}
    				
    				// Add TinyMCE in assets
    				if ( isset($config['assets']['tinymce']) ) {
    				    $this->addTinyMCEInAssetic($container, $config['assets']['tinymce']);
    				}
					break;
			}
		}
	}
	
	/**
	 * Adding jQuery in Assetic
	 * 
	 * @param ContainerBuilder $container
	 * @param array            $config
	 */
	protected function addJqueryInAssetic(ContainerBuilder $container, array $config)
	{
	    if ( $config['path'] !== false ) {
	        $container->prependExtensionConfig('assetic', array(
	            'assets' => array(
	                'jquery' => $config['path']
	            )
	        ));
	    }
	}
	
	/**
	 * Adding jQuery UI in Assetic
	 * 
	 * @param  ContainerBuilder $container
	 * @param  array            $config
	 * @throws InvalidConfigurationException : "Js path not set or CSS path not set"
	 */
	protected function addJqueryUIInAssetic(ContainerBuilder $container, array $config)
	{
	    if ( $config['js'] !== false && $config['css'] !== false) {
	        $container->prependExtensionConfig('assetic', array(
	            'assets' => array(
	                'jqueryui_js' => $config['js'],
	                'jqueryui_css' => $config['css']
	            )
	        ));
	        
	    } elseif ( $config['js'] === false && $config['css'] !== false ) {
	        throw new InvalidConfigurationException('You have enabled jQuery UI supports but js parameter is missing.');
	        
	    } elseif ( $config['js'] !== false && $config['css'] === false ) {
	        throw new InvalidConfigurationException('You have enabled jQuery UI supports but css parameter is missing.');
	    }
	}
	
	/**
	 * Adding Twitter Bootstrap in Assetic
	 * 
	 * @param  ContainerBuilder $container
	 * @param  array            $config
	 * @throws InvalidConfigurationException : You can't have less files and css files configured
	 */
	protected function addTwbsInAssetic(ContainerBuilder $container, array $config)
	{
	    if ( $config['twbs_dir'] !== false && !is_null($config['twbs_dir']) ) {

	        // Twitter Bootstrap javascript files
	        $inputs = array();
	        foreach($config['js'] as $file) {
	            $inputs[] = $config['twbs_dir'].'/'.$file;
	        }
	        
	        $container->prependExtensionConfig('assetic', array(
	            'assets' => array(
	                'twbs_js' => array(
	                    'inputs' => $inputs
	                )
	            )
	        ));
	    
	        // Twitter Bootstrap Less files or CSS files
	        if ( count($config['less']) > 0 && count($config['css']) > 0 ) {
	            throw new InvalidConfigurationException('You can\'t have less files and css files in your Twitter Bootstrap Configuration, choose one.');
	            
	        } elseif ( count($config['less']) > 0 ) {
	            $inputs = array();
	            foreach($config['less'] as $file) {
	                $inputs[] = $config['twbs_dir'].'/'.$file;
	            }
	            
	            $container->prependExtensionConfig('assetic', array(
	                'assets' => array(
	                    'twbs_css' => array(
	                        'inputs' => $inputs
	                    )
	                )
	            ));
	            
	        } elseif ( count($config['css']) > 0 ) {
	            $inputs = array();
	            foreach($config['css'] as $file) {
	                $inputs[] = $config['twbs_dir'].'/'.$file;
	            }
	            
                $container->prependExtensionConfig('assetic', array(
                    'assets' => array(
                        'twbs_css' => array(
                            'inputs' => $inputs
                        )
                    )
                ));
                
	        }
	    }
	}
	
	/**
	 * Adding Select2 in Assetic
	 * 
	 * @param  ContainerBuilder $container
	 * @param  array            $config
	 * @throws InvalidConfigurationException : "Js path not set or CSS path not set"
	 */
	protected function addSelect2InAssetic(ContainerBuilder $container, array $config)
	{
	    if ( $config['js'] !== false && $config['css'] !== false) {
	        $container->prependExtensionConfig('assetic', array(
	            'assets' => array(
	                'select2_js' => $config['js'],
	                'select2_css' => $config['css']
	            )
	        ));
	        
	    } elseif ( $config['js'] === false && $config['css'] !== false ) {
	        throw new InvalidConfigurationException('You have enabled select2 supports but js parameter is missing.');
	        
	    } elseif ( $config['js'] !== false && $config['css'] === false ) {
	        throw new InvalidConfigurationException('You have enabled select2 supports but css parameter is missing.');
	        
	    }
	}
	
	/**
	 * Adding Bazinga Js Translation in Assetic
	 * 
	 * @param ContainerBuilder $container
	 * @param array            $config
	 */
	protected function addBazingaJsTranslationInAssetic(ContainerBuilder $container, array $config)
	{
	    if ( $config['bz_translator_js'] !== false ) {
	        $container->prependExtensionConfig('assetic', array(
	            'assets' => array(
	                'bz_translator_js' => $config['bz_translator_js'],
	                'bz_translator_config' => $config['bz_translator_config'],
	                'bz_translations_files' => $config['bz_translations_files']
	            )
	        ));
	    }
	}
	
	/**
	 * Adding Speaking URL in Assetic
	 * 
	 * @param ContainerBuilder $container
	 * @param array            $config
	 */
	protected function addSpeakingURLInAssetic(ContainerBuilder $container, array $config)
	{
	    if ( $config['path'] !== false ) {
	        $container->prependExtensionConfig('assetic', array(
	            'assets' => array(
	                'speakingurl_js' => $config['path']
	            )
	        ));
	    }
	}
	
	/**
	 * Adding TinyMCE In Assetic
	 * 
	 * @param ContainerBuilder $container
	 * @param array            $config
	 */
	protected function addTinyMCEInAssetic(ContainerBuilder $container, array $config)
	{
	    if ( $config['tinymce_dir'] !== false ) {
	        $container->prependExtensionConfig('assetic', array(
	            'assets' => array(
	                'tinymce_js' => $config['tinymce_dir'].'/'.$config['js'],
	                'config' => $config['config']
	            )
	        ));
	    }
	}
}