<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\LayoutBundle\Twig\Extension;

/**
 * TinyMCE Extension for generate tinymce init
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class TinyMCEExtension extends \Twig_Extension
{
    /**
     * @var array
     */
    protected $assets;
    
    /**
     * @param array $assets
     */
    public function __construct($assets)
    {
        $this->assets = $assets;
    }
    
    /**
     * {@inheritDoc}
     * @see Twig_Extension::getFunctions()
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('tinymce_init', array($this, 'tinymceInitJs'), array(
                'needs_environment' => true,
                'is_safe' => array('html')
            ))
        );
    }
    
    /**
     * Return the tinyMCE init js
     */
    public function tinymceInitJs(\Twig_Environment $environment)
    {
        return $environment->render('ASFLayoutBundle:tinymce:init_js.html.twig', array(
            'tinymce_config' => $this->assets['tinymce']['config'],
            'tinymce_base_url' => $this->assets['tinymce']['customize']['base_url']
        ));
    }
    
    /**
     * {@inheritDoc}
     * @see Twig_ExtensionInterface::getName()
     */
    public function getName()
    {
        return 'asf_layout_tinymce';
    }
}
