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
	        'jqueryui' => false
	    );
	    
	    // Check jQuery UI configuration
	    if ( $this->supportedAssets['jqueryui']['css'] !== false && !file_exists($this->supportedAssets['jqueryui']['css']) )
            throw new InvalidConfigurationException('You have enabled the support of jQuery UI but you do not specify the path to the CSS file or the file is not reachable.');
        elseif ( $this->supportedAssets['jqueryui']['css'] !== false && $this->asseticSupportEnabled === true )
            $view_options['jqueryui'] = true;
	    
        return $this->environment->render('ASFLayoutBundle:supports:stylesheets.html.twig', $view_options);
	}
	
	/**
	 * Render javascripts block for Asf Layout bundle
	 */
	public function getJavascripts()
	{
	    // Twig template configuration
	    $view_options = array(
	        'jquery' => false,
	        'jqueryui' => false
	    );
	    
	    // Check jQuery configuration
	    if ( $this->supportedAssets['jquery']['path'] !== false && !file_exists($this->supportedAssets['jquery']['path']) )
            throw new InvalidConfigurationException('You have enabled the support of jQuery but you do not specify the path to the file or the file is not reachable.');
	    elseif ( $this->supportedAssets['jquery']['path'] !== false && $this->asseticSupportEnabled === true )
	       $view_options['jquery'] = true;
	    
	    // Check jQuery UI configuration
	    if ( $this->supportedAssets['jqueryui']['js'] !== false && !file_exists($this->supportedAssets['jqueryui']['js']) )
	       throw new InvalidConfigurationException('You have enabled the support of jQuery UI but you do not specify the path to the javascript file or the file is not reachable.');
        elseif ( $this->supportedAssets['jqueryui']['js'] !== false && $this->asseticSupportEnabled === true )
            $view_options['jqueryui'] = true;
	    
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