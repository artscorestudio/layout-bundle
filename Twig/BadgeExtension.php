<?php
/**
 * This file is part of Artscore Studio Framework package.
 * 
 * (c) 2012-2014 Nicolas Claverie <info@artscore-studio.fr>
 * 
 * This dource file is subject to the MIT Licence that is bundled 
 * with this source code in the file LICENSE.
 */

namespace ASF\LayoutBundle\Twig;

/**
 * BadgeExtension.
 *
 * @category   TwigExtension
 *
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2012-2013 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 *
 * @link       http://bootstrap.braincrafted.com Bootstrap for Symfony2
 */
class BadgeExtension extends \Twig_Extension
{
    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('badge', array($this, 'badgeFunction'), array(
                'pre_escape' => 'html',
                'is_safe' => array('html'),
            )),
        );
    }

    /**
     * Returns the HTML code for a badge.
     *
     * @param string $text The text of the badge
     *
     * @return string The HTML code of the badge
     */
    public function badgeFunction($text)
    {
        return sprintf('<span class="badge">%s</span>', $text);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'asf_layout_twbs_badge';
    }
}
