<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) 2012-2015 Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\LayoutBundle\Twig\Extension;

use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;

/**
 * External assets extension
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class SupportsExtension extends \Twig_Extension implements \Twig_Extension_InitRuntimeInterface
{
	/**
	 * @var \Twig_Environment
	 */
	private $environment;
	
	/**
	 * @var array
	 */
	protected $supportedAssets;
	
	/**
	 * @var boolean
	 */
	protected $asseticSupportEnabled;
	
	/**
	 * (non-PHPdoc)
	 * @see Twig_Extension::initRuntime()
	 */
	public function initRuntime(\Twig_Environment $environment)
	{
		$this->environment = $environment;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Twig_Extension::getFunctions()
	 */
	public function getFunctions()
	{
		return array(
			new \Twig_SimpleFunction('asf_layout_stylesheets', array($this, 'getStylesheets'), array('is_safe' => array('html'))),
			new \Twig_SimpleFunction('asf_layout_javascripts', array($this, 'getJavascripts'), array('is_safe' => array('html'))),
		);
	}
	
	/**
	 * Render stylesheet block for Asf Layout bundle
	 */
	public function getStylesheets()
	{
		// Twig template configuration
	    $view_options = array(
	        'jqueryui' => false,
	        'twbs'     => false,
	        'select2'  => false
	    );
	    
	    // Check jQuery UI configuration
	    if ( isset($this->supportedAssets['jqueryui']) && $this->supportedAssets['jqueryui']['css'] !== false && $this->asseticSupportEnabled == false )
            throw new InvalidConfigurationException('You have to enable Assetic Bundle.');
        elseif ( isset($this->supportedAssets['jqueryui']) &&  $this->supportedAssets['jqueryui']['css'] !== false )
            $view_options['jqueryui'] = true;
        
        // Check Twitter Bootstrap configuration
        if ( (is_array($this->supportedAssets['twbs']['less']) || is_array($this->supportedAssets['twbs']['css']))
                && (count($this->supportedAssets['twbs']['less']) > 0 || count($this->supportedAssets['twbs']['css']) > 0) 
                && $this->asseticSupportEnabled == false )
            throw new InvalidConfigurationException('You have to enable Assetic Bundle.');
        elseif ( is_array($this->supportedAssets['twbs']['less']) && count($this->supportedAssets['twbs']['less']) > 0) {
            $view_options['twbs'] = true; $view_options['is_less'] = true;
        } elseif ( is_array($this->supportedAssets['twbs']['css']) && count($this->supportedAssets['twbs']['css']) > 0 ) {
            $view_options['twbs'] = true; $view_options['is_less'] = false;
        }
            
        // Check Select2 configuration
        if ( isset($this->supportedAssets['select2']) && $this->supportedAssets['select2']['css'] !== false && $this->asseticSupportEnabled == false )
            throw new InvalidConfigurationException('You have to enable Assetic Bundle.');
        elseif ( isset($this->supportedAssets['select2']) && $this->supportedAssets['select2']['css'] !== false )
            $view_options['select2'] = true;
        
        return $this->environment->render('ASFLayoutBundle:supports:stylesheets.html.twig', $view_options);
	}
	
	/**
	 * Render javascripts block for Asf Layout bundle
	 */
	public function getJavascripts()
	{
	    // Twig template configuration
	    $view_options = array(
	        'jquery'   => false,
	        'jqueryui' => false,
	        'twbs'     => false,
	        'select2'  => false,
	        'bazinga_js_translation' => false,
	        'speaking_url' => false,
	        'fos_js_routing' => $this->supportedAssets['fos_js_routing']
	    );
	    
	    // Check jQuery configuration
	    if ( $this->supportedAssets['jquery']['path'] !== false && $this->asseticSupportEnabled == false )
	        throw new InvalidConfigurationException('You have to enable Assetic Bundle.');
	    elseif ( $this->supportedAssets['jquery']['path'] !== false )
	       $view_options['jquery'] = true;
	    
	    // Check jQuery UI configuration
	    if ( isset($this->supportedAssets['jqueryui']) && $this->supportedAssets['jqueryui']['js'] !== false && $this->asseticSupportEnabled == false )
	       throw new InvalidConfigurationException('You have to enable Assetic Bundle.');
        elseif ( isset($this->supportedAssets['jqueryui']) && $this->supportedAssets['jqueryui']['js'] !== false )
            $view_options['jqueryui'] = true;
	    
        // Check Twitter Bootstrap configuration
        if ( is_array($this->supportedAssets['twbs']['js']) && count($this->supportedAssets['twbs']['js']) > 0 && $this->asseticSupportEnabled == false )
            throw new InvalidConfigurationException('You have to enable Assetic Bundle.');
        elseif ( is_array($this->supportedAssets['twbs']['js']) && count($this->supportedAssets['twbs']['js']) > 0 )
            $view_options['twbs'] = true;
        
        // Check select2 configuration
        if ( isset($this->supportedAssets['select2']) && $this->supportedAssets['select2']['js'] !== false && $this->asseticSupportEnabled == false )
            throw new InvalidConfigurationException('You have to enable Assetic Bundle.');
        elseif ( isset($this->supportedAssets['select2']) && $this->supportedAssets['select2']['js'] !== false )
            $view_options['select2'] = true;
        
        // Check bazinga js translation configuration
        if ( isset($this->supportedAssets['bazinga_js_translator']) && $this->supportedAssets['bazinga_js_translator']['bz_translator_js'] !== false
            && $this->supportedAssets['bazinga_js_translator']['bz_translator_config'] !== false
            && $this->supportedAssets['bazinga_js_translator']['bz_translations_files'] !== false
            && $this->asseticSupportEnabled == false )
            throw new InvalidConfigurationException('You have to enable Assetic Bundle.');
        elseif ( isset($this->supportedAssets['bazinga_js_translator']) && $this->supportedAssets['bazinga_js_translator']['bz_translator_js'] !== false
            && $this->supportedAssets['bazinga_js_translator']['bz_translator_config'] !== false
            && $this->supportedAssets['bazinga_js_translator']['bz_translations_files'] !== false )
            $view_options['bazinga_js_translation'] = true;
        
        // Check speaking_url configuration
        if ( isset($this->supportedAssets['speaking_url']) && $this->supportedAssets['speaking_url']['path'] !== false && $this->asseticSupportEnabled == false )
            throw new InvalidConfigurationException('You have to enable Assetic Bundle.');
        elseif ( isset($this->supportedAssets['speaking_url']) && $this->supportedAssets['speaking_url']['path'] !== false )
            $view_options['speaking_url'] = true;
        
        return $this->environment->render('ASFLayoutBundle:supports:javascripts.html.twig', $view_options);
	}
	
	/**
	 * Set supported assets
	 * 
	 * @param array $supported_assets
	 * @param boolean $enable_assetic_support
	 */
	public function setSupportedAssets(array $supported_assets, $assetic_support_enabled)
	{
	    $this->supportedAssets = $supported_assets;
	    $this->asseticSupportEnabled = $assetic_support_enabled;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Twig_ExtensionInterface::getName()
	 */
	public function getName()
	{
		return 'asf_layout_supports_twig_extension';
	}
}