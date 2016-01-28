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
		return $this->environment->render('ASFLayoutBundle:supports:stylesheets_layout.html.twig');
	}
	
	/**
	 * Render javascripts block for Asf Layout bundle
	 */
	public function getJavascripts()
	{
	    if ( $this->supportedAssets['jquery']['path'] !== false && !file_exists($this->supportedAssets['jquery']['path']) )
            throw new InvalidConfigurationException('You have enabled the support of jQuery but you do not specify the path to the file or the file is not reachable.');
	    elseif ($this->supportedAssets['jquery']['path'] !== false)
            return $this->environment->render('ASFLayoutBundle:supports:jquery.html.twig');
	}
	
	/**
	 * Set supported assets
	 * 
	 * @param array $supported_assets
	 */
	public function setSupportedAssets(array $supported_assets)
	{
	    $this->supportedAssets = $supported_assets;
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