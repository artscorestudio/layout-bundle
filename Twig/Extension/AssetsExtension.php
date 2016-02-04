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
class AssetsExtension extends \Twig_Extension implements \Twig_Extension_InitRuntimeInterface
{
	/**
	 * @var \Twig_Environment
	 */
	protected $environment;
	
	/**
	 * @var array
	 */
	protected $assets;
	
	/**
	 * @var boolean
	 */
	protected $isAsseticEnabled;
	
	/**
	 * @var string
	 */
	protected $stylesheetsView = '';
	
	/**
	 * @var string
	 */
	protected $javascripts_view = '';
	
	/**
	 * @param array $supported_assets
	 * @param boolean $is_assetic_enabled
	 */
	public function __construct(array $supported_assets, $is_assetic_enabled)
	{
	    $this->assets = $supported_assets;
	    $this->isAsseticEnabled = $is_assetic_enabled;
	}
	
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
	    // Check jQuery UI configuration
	    $this->renderJqueryUICss();
        
        // Check Twitter Bootstrap configuration
        $this->renderTwbsCss();
            
        // Check Select2 configuration
        $this->renderSelect2Css();
        
        return $this->stylesheetsView;
	}
	
	/**
	 * Render javascripts block for Asf Layout bundle
	 */
	public function getJavascripts()
	{
	    // Check jQuery configuration
	    $this->renderJquery();
	     
	    // Check Twitter Bootstrap configuration
	    $this->renderTwbsJs();
	
	    // Check jQuery UI configuration
	    $this->renderJqueryUIJs();
	
	    // Check select2 configuration
	    $this->renderSelect2Js();
	
	    // Check bazinga js translation configuration
	    $this->renderBazingaJsTranslator();
	
	    // Check speaking_url configuration
	    $this->renderSpeakingURL();
	
	    // Check fos_js_routing
	    $this->renderFOSJsRouting();
	    
	    return $this->javascripts_view;
	}
	
	/**
	 * Render Jquery UI stylesheet
	 * 
	 * @throws InvalidConfigurationException
	 */
	protected function renderJqueryUICss()
	{
	    if ( isset($this->assets['jqueryui']) && $this->assets['jqueryui']['css'] !== false && $this->isAsseticEnabled == false )
	        throw new InvalidConfigurationException('You have to enable Assetic Bundle.');
	    
	    elseif ( isset($this->assets['jqueryui']) &&  $this->assets['jqueryui']['css'] !== false )
	        $this->stylesheetsView .= $this->environment->render('ASFLayoutBundle:assets:jqueryui_css.html.twig');
	}
	
	/**
	 * Render Twitter Bootstrap stylesheets
	 * 
	 * @throws InvalidConfigurationException
	 */
	public function renderTwbsCss()
	{
	    if ( (is_array($this->assets['twbs']['less']) || is_array($this->assets['twbs']['css']))
	        && (count($this->assets['twbs']['less']) > 0 || count($this->assets['twbs']['css']) > 0)
	        && $this->isAsseticEnabled == false ) {
	        throw new InvalidConfigurationException('You have to enable Assetic Bundle.');
	        
	   } elseif ( is_array($this->assets['twbs']['less']) && count($this->assets['twbs']['less']) > 0) {
	         $this->stylesheetsView .= $this->environment->render('ASFLayoutBundle:assets:twbs_less.html.twig');
	         
	    } elseif ( is_array($this->assets['twbs']['css']) && count($this->assets['twbs']['css']) > 0 ) {
	         $this->stylesheetsView .= $this->environment->render('ASFLayoutBundle:assets:twbs_css.html.twig');
	    }
	}
	
	/**
	 * Render Select2 stylesheets
	 * 
	 * @throws InvalidConfigurationException
	 */
	public function renderSelect2Css()
	{
	    if ( isset($this->assets['select2']) && $this->assets['select2']['css'] !== false && $this->isAsseticEnabled == false )
	        throw new InvalidConfigurationException('You have to enable Assetic Bundle.');
	    
	    elseif ( isset($this->assets['select2']) && $this->assets['select2']['css'] !== false )
	        $this->stylesheetsView .= $this->environment->render('ASFLayoutBundle:assets:select2_css.html.twig');
	}
	
	/**
	 * Render jQuery script tag
	 * 
	 * @throws InvalidConfigurationException : You have to enable Assetic Bundle.
	 */
	public function renderJquery()
	{
	    if ( $this->assets['jquery']['path'] !== false && $this->isAsseticEnabled == false )
	        throw new InvalidConfigurationException('You have to enable Assetic Bundle.');
        elseif ( $this->assets['jquery']['path'] !== false )
	        $this->javascripts_view .= $this->environment->render('ASFLayoutBundle:assets:jquery.html.twig');
	}
	
	/**
	 * Render Twitter Bootstrap Js
	 * 
	 * @throws InvalidConfigurationException
	 */
	public function renderTwbsJs()
	{
	    if ( is_array($this->assets['twbs']['js']) && count($this->assets['twbs']['js']) > 0 && $this->isAsseticEnabled == false )
	        throw new InvalidConfigurationException('You have to enable Assetic Bundle.');
	    elseif ( is_array($this->assets['twbs']['js']) && count($this->assets['twbs']['js']) > 0 )
	        $this->javascripts_view .= $this->environment->render('ASFLayoutBundle:assets:twbs_js.html.twig');
	}
	
	/**
	 * Render jQuery UI script tag
	 * 
	 * @throws InvalidConfigurationException
	 */
	public function renderJqueryUIJs()
	{
	    if ( isset($this->assets['jqueryui']) && $this->assets['jqueryui']['js'] !== false && $this->isAsseticEnabled == false )
	       throw new InvalidConfigurationException('You have to enable Assetic Bundle.');
        elseif ( isset($this->assets['jqueryui']) && $this->assets['jqueryui']['js'] !== false )
	       $this->javascripts_view .= $this->environment->render('ASFLayoutBundle:assets:jqueryui_js.html.twig');
	}
	
	/**
	 * Render Select2 javascript
	 * *
	 * @throws InvalidConfigurationException
	 */
	public function renderSelect2Js()
	{
	    if ( isset($this->assets['select2']) && $this->assets['select2']['js'] !== false && $this->isAsseticEnabled == false )
	        throw new InvalidConfigurationException('You have to enable Assetic Bundle.');
	    elseif ( isset($this->assets['select2']) && $this->assets['select2']['js'] !== false )
	        $this->javascripts_view .= $this->environment->render('ASFLayoutBundle:assets:select2_js.html.twig');
	}
	
	/**
	 * Render Bazinga Js Translator script tag
	 * 
	 * @throws InvalidConfigurationException
	 */
	public function renderBazingaJsTranslator()
	{
	    if ( isset($this->assets['bazinga_js_translator']) && $this->assets['bazinga_js_translator']['bz_translator_js'] !== false
	        && $this->assets['bazinga_js_translator']['bz_translator_config'] !== false
	        && $this->assets['bazinga_js_translator']['bz_translations_files'] !== false
	        && $this->isAsseticEnabled == false )
	        throw new InvalidConfigurationException('You have to enable Assetic Bundle.');
	    elseif ( isset($this->assets['bazinga_js_translator']) && $this->assets['bazinga_js_translator']['bz_translator_js'] !== false
	        && $this->assets['bazinga_js_translator']['bz_translator_config'] !== false
	        && $this->assets['bazinga_js_translator']['bz_translations_files'] !== false )
	            $this->javascripts_view .= $this->environment->render('ASFLayoutBundle:assets:bazinga_js_translation.html.twig');
	}
	
	/**
	 * Render Speaking URL script tag
	 * 
	 * @throws InvalidConfigurationException
	 */
	public function renderSpeakingURL()
	{
	    if ( isset($this->assets['speaking_url']) && $this->assets['speaking_url']['path'] !== false && $this->isAsseticEnabled == false )
	        throw new InvalidConfigurationException('You have to enable Assetic Bundle.');
	    elseif ( isset($this->assets['speaking_url']) && $this->assets['speaking_url']['path'] !== false )
	        $this->javascripts_view .= $this->environment->render('ASFLayoutBundle:assets:speakingurl_js.html.twig');
	}
	
	/**
	 * Render FOSJsRoutingBundle script tag
	 *
	 * @throws InvalidConfigurationException
	 */
	public function renderFOSJsRouting()
	{
	    if ( isset($this->assets['fos_js_routing']) && true === $this->assets['fos_js_routing'] && $this->isAsseticEnabled == false )
	        throw new InvalidConfigurationException('You have to enable Assetic Bundle.');
	    elseif ( isset($this->assets['fos_js_routing']) && $this->assets['fos_js_routing'] === true )
	        $this->javascripts_view .= $this->environment->render('ASFLayoutBundle:assets:fos_js_routing.html.twig');
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Twig_ExtensionInterface::getName()
	 */
	public function getName()
	{
		return 'asf_layout_assets_twig_extension';
	}
}