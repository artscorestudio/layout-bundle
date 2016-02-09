<?php
/**
 * This file is part of Artscore Studio Framework package
 * 
 * (c) 2012-2014 Nicolas Claverie <info@artscore-studio.fr>
 * 
 * This dource file is subject to the MIT Licence that is bundled 
 * with this source code in the file LICENSE.
 */
namespace ASF\LayoutBundle\Twig\Extension;

use Twig_Filter_Method;
use Twig_Function_Method;

/**
 * IconExtension
 *
 * @author Nicolas Claverie <info@artscore-studio.fr>
 * @link   based on http://bootstrap.braincrafted.com Bootstrap for Symfony2
 */
class IconExtension extends \Twig_Extension
{
    /**
     * @var array
     */
    protected $twbsConfig;

    /**
     * @param array $twbs_config
     */
    public function __construct($twbs_config)
    {
        $this->twbsConfig = $twbs_config;
    }

    /**
     * {@inheritDoc}
     */
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('parse_icons', array($this, 'parseIconsFilter'), array(
                'pre_escape' => 'html', 
                'is_safe' => array('html')
            ))
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('icon', array($this, 'iconFunction'), array(
                'pre_escape' => 'html', 
                'is_safe' => array('html')
            ))
        );
    }

    /**
     * Parses the given string and replaces all occurrences of .icon-[name] with the corresponding icon.
     *
     * @param string $text The text to parse
     *
     * @return string The HTML code with the icons
     */
    public function parseIconsFilter($text)
    {
        $that = $this;

        return preg_replace_callback(
            '/\.icon-([a-z0-9+-]+)/',
            function ($matches) use ($that) {
                return $that->iconFunction($matches[1]);
            },
            $text
        );
    }

    /**
     * Returns the HTML code for the given icon.
     *
     * @param string $icon The name of the icon
     *
     * @return string The HTML code for the icon
     */
    public function iconFunction($icon)
    {
        $icon = str_replace('+', ' '.$this->twbsConfig['icon_prefix'].'-', $icon);

        return sprintf('<%1$s class="%2$s %2$s-%3$s"></%1$s>', $this->twbsConfig['icon_tag'], $this->twbsConfig['icon_prefix'], $icon);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'asf_layout_twbs_icon';
    }
}
