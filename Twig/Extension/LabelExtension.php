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

/**
 * LabelExtension
 *
 * @category   TwigExtension
 * @package    BraincraftedBootstrapBundle
 * @subpackage Twig
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2012-2013 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       http://bootstrap.braincrafted.com Bootstrap for Symfony2
 */
class LabelExtension extends \Twig_Extension
{
    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        $options = array('pre_escape' => 'html', 'is_safe' => array('html'));

        return array(
            new \Twig_SimpleFunction('label', array($this, 'labelFunction'), $options),
            new \Twig_SimpleFunction('label_primary', array($this, 'labelPrimaryFunction'), $options),
            new \Twig_SimpleFunction('label_success', array($this, 'labelSuccessFunction'), $options),
            new \Twig_SimpleFunction('label_info', array($this, 'labelInfoFunction'), $options),
            new \Twig_SimpleFunction('label_warning', array($this, 'labelWarningFunction'), $options),
            new \Twig_SimpleFunction('label_danger', array($this, 'labelDangerFunction'), $options)
        );
    }

    /**
     * Returns the HTML code for a label.
     *
     * @param string $text The text of the label
     * @param string $type The type of label
     *
     * @return string The HTML code of the label
     */
    public function labelFunction($text, $type = 'default')
    {
        return sprintf('<span class="label%s">%s</span>', ($type ? ' label-' . $type : ''), $text);
    }

    /**
     * @param string $text
     *
     * @return string
     */
    public function labelPrimaryFunction($text)
    {
        return $this->labelFunction($text, 'primary');
    }

    /**
     * Returns the HTML code for a success label.
     *
     * @param string $text The text of the label
     *
     * @return string The HTML code of the label
     */
    public function labelSuccessFunction($text)
    {
        return $this->labelFunction($text, 'success');
    }

    /**
     * Returns the HTML code for a warning label.
     *
     * @param string $text The text of the label
     *
     * @return string The HTML code of the label
     */
    public function labelWarningFunction($text)
    {
        return $this->labelFunction($text, 'warning');
    }

    /**
     * Returns the HTML code for a important label.
     *
     * @param string $text The text of the label
     *
     * @return string The HTML code of the label
     */
    public function labelDangerFunction($text)
    {
        return $this->labelFunction($text, 'danger');
    }

    /**
     * Returns the HTML code for a info label.
     *
     * @param string $text The text of the label
     *
     * @return string The HTML code of the label
     */
    public function labelInfoFunction($text)
    {
        return $this->labelFunction($text, 'info');
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'asf_layout_twbs_label';
    }
}
